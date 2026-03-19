<?php

namespace App\Core;

use Dotenv\Dotenv;

class Application
{
    public static Application $app;
    private static ?Application $instance = null;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;

    private function __construct()
    {
        self::$app = $this;
        $this->session = new Session();
        if (file_exists(BASE_PATH . '/.env')) {
            $dotenv = Dotenv::createImmutable(BASE_PATH);
            $dotenv->load();
        }

        $this->request  = new Request();
        $this->response = new Response();
        $this->router   = new Router($this->request, $this->response);

        date_default_timezone_set($_ENV['APP_TIMEZONE'] ?? 'America/Bogota');
        Session::start();
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function run(): void
    {
        try {
            echo $this->router->resolve();
        } catch (\Throwable $e) {
            http_response_code(500);
            echo '<pre style="background:#1e1e2e;color:#cdd6f4;padding:20px;font-family:monospace;">';
            echo '<strong style="color:#f38ba8;">Error:</strong> ' . htmlspecialchars($e->getMessage()) . "\n";
            echo '<strong style="color:#a6e3a1;">File:</strong> ' . $e->getFile() . ':' . $e->getLine() . "\n";
            echo '<strong style="color:#89b4fa;">Trace:</strong>' . "\n" . htmlspecialchars($e->getTraceAsString());
            echo '</pre>';
        }
    }
}
