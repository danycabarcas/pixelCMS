<?php

namespace App\Core;

class Router
{
    private array $routes = [];
    private array $namedRoutes = [];

    public function get(string $uri, array|callable $action, string $name = ''): self
    {
        return $this->addRoute('GET', $uri, $action, $name);
    }

    public function post(string $uri, array|callable $action, string $name = ''): self
    {
        return $this->addRoute('POST', $uri, $action, $name);
    }

    private function addRoute(string $method, string $uri, array|callable $action, string $name): self
    {
        $pattern = $this->uriToPattern($uri);
        $this->routes[] = [
            'method'  => $method,
            'uri'     => $uri,
            'pattern' => $pattern,
            'action'  => $action,
            'middleware' => [],
        ];
        if ($name) {
            $this->namedRoutes[$name] = $uri;
        }
        return $this;
    }

    public function middleware(string|array $middleware): self
    {
        $last = count($this->routes) - 1;
        $middlewares = is_array($middleware) ? $middleware : [$middleware];
        $this->routes[$last]['middleware'] = array_merge(
            $this->routes[$last]['middleware'],
            $middlewares
        );
        return $this;
    }

    private function uriToPattern(string $uri): string
    {
        $pattern = preg_replace('/\{([a-zA-Z_]+)\}/', '(?P<$1>[^/]+)', $uri);
        return '#^' . $pattern . '$#';
    }

    public function dispatch(Request $request): void
    {
        $method = $request->method();
        $uri    = $request->uri();

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            if (preg_match($route['pattern'], $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                foreach ($route['middleware'] as $mw) {
                    $this->runMiddleware($mw, $request);
                }
                $this->runAction($route['action'], $params, $request);
                return;
            }
        }
        $this->notFound();
    }

    private function runMiddleware(string $name, Request $request): void
    {
        $middlewareMap = [
            'auth'        => \App\Middleware\AuthMiddleware::class,
        ];

        if (isset($middlewareMap[$name])) {
            $mw = new $middlewareMap[$name]();
            $mw->handle($request);
        }
    }

    private function runAction(array|callable $action, array $params, Request $request): void
    {
        if (is_callable($action)) {
            call_user_func($action, $request, ...$params);
            return;
        }

        [$controllerClass, $method] = $action;
        $controller = new $controllerClass();
        call_user_func_array([$controller, $method], [$request, ...$params]);
    }

    public function route(string $name, array $params = []): string
    {
        if (!isset($this->namedRoutes[$name])) {
            throw new \RuntimeException("Ruta con nombre '{$name}' no encontrada.");
        }
        $uri = $this->namedRoutes[$name];
        foreach ($params as $key => $value) {
            $uri = str_replace('{' . $key . '}', $value, $uri);
        }
        return $uri;
    }

    private function notFound(): void
    {
        http_response_code(404);
        echo "404 Not Found";
    }
}
