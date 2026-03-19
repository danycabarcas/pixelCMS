<?php
namespace App\Middleware;
use App\Core\Application;

class AuthMiddleware {
    public function execute($params = []) {
        $path = Application::$app->request->getPath();
        $user_id = Application::$app->session->get('user_id');
        $user_role = Application::$app->session->get('user_role');

        if (!$user_id) {
            Application::$app->response->redirect('/login');
            exit;
        }

        // --- SISTEMA DE BLINDAJE POR ROLES ---
        
        // 1. Si la ruta es del Panel Maestro (/master) SOLO el superadmin entra.
        if (strpos($path, '/master') === 0 && $user_role !== 'superadmin') {
            Application::$app->response->redirect('/admin/dashboard');
            exit;
        }

        // 2. Podríamos añadir más reglas aquí de ser necesario.
    }
}
