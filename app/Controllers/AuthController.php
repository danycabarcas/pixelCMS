<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Application;
use App\Core\Database;

use App\Core\SiteSelector;

class AuthController extends Controller {
    public function loginView() {
        $empresa = SiteSelector::identify();
        return $this->view('auth.login', ['empresa' => $empresa], 'auth');
    }

    public function login(Request $request) {
        $data = $request->all();
        $db = Database::getInstance();
        $empresa = SiteSelector::identify();
        
        // Buscamos el usuario en la tabla correcta: users
        $user = $db->query("SELECT * FROM users WHERE username = :user LIMIT 1", [
            'user' => $data['username']
        ])[0] ?? null;

        if ($user && password_verify($data['password'], $user['password'])) {
            // SEGURIDAD: Si no es superadmin y el dominio es de una empresa, 
            // el usuario debe pertenecer a esa empresa.
            if ($user['role'] !== 'superadmin' && $empresa && $user['empresa_id'] != $empresa['id']) {
                return $this->view('auth.login', ['error' => 'No tiene acceso a este portal administrativo.', 'empresa' => $empresa], 'auth');
            }

            Application::$app->session->set('user_id', $user['id']);
            Application::$app->session->set('user_role', $user['role']);
            Application::$app->session->set('empresa_id', $user['empresa_id']);

            // Redirección dinámica: ¿Panel Maestro o Panel Cliente?
            if ($user['role'] === 'superadmin') {
                Application::$app->response->redirect('/master');
            } else {
                Application::$app->response->redirect('/admin/dashboard'); // Panel futuro del cliente
            }
            return;
        }
        
        return $this->view('auth.login', ['error' => 'Usuario o Contraseña incorrectos.', 'empresa' => $empresa], 'auth');
    }

    public function logout() {
        Application::$app->session->remove('user_id');
        Application::$app->session->remove('user_role');
        Application::$app->session->remove('empresa_id');
        Application::$app->response->redirect('/login');
    }
}
