<?php
namespace App\Core;
class Router {
    protected array $routes = [];
    public Request $request;
    public Response $response;
    private array $middleware = [];

    public function __construct(Request $request, Response $response) {
        $this->request = $request;
        $this->response = $response;
    }
    public function get($path, $callback, $middleware = []) {
        $this->routes['get'][$path] = $callback;
        $this->middleware['get'][$path] = $middleware;
    }
    public function post($path, $callback, $middleware = []) {
        $this->routes['post'][$path] = $callback;
        $this->middleware['post'][$path] = $middleware;
    }
    public function resolve() {
        $path = $this->request->getPath();
        $method = $this->request->method();
        
        // Limpiar el prefijo /public/ si existe (provocado por algunas redirecciones)
        if (str_starts_with($path, '/public')) {
            $path = substr($path, 7);
            if ($path == '') $path = '/';
        }

        $callback = $this->routes[$method][$path] ?? false;
        
        if ($callback === false) { 
            return "Página no encontrada (404) en: " . $path; 
        }

        // Execute Middleware
        $middlewares = $this->middleware[$method][$path] ?? [];
        foreach ($middlewares as $m) { (new $m())->execute(); }

        if (is_string($callback)) { return View::renderView($callback); }
        if (is_array($callback)) { $callback[0] = new $callback[0](); }
        return call_user_func($callback, $this->request);
    }
}
