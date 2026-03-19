<?php
namespace App\Middleware;
use App\Core\Application;

class AuthMiddleware {
    public function execute() {
        $path = Application::$app->request->getPath();
        
        // No redirigir si ya estamos en /login para evitar bucles
        if ($path === '/login') {
            return;
        }

        if (!Application::$app->session->get('user_id')) {
            Application::$app->response->redirect('/login');
            exit;
        }
    }
}
