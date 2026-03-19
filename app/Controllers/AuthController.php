<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Application;
use App\Core\Database;

class AuthController extends Controller {
    public function loginView() {
        return $this->view('auth.login', [], 'auth');
    }

    public function login(Request $request) {
        $data = $request->all();
        $db = Database::getInstance();
        $user = $db->query("SELECT * FROM usuarios WHERE email = :email", ['email' => $data['email']]);
        
        if ($user && password_verify($data['password'], $user[0]['password'])) {
            Application::$app->session->set('user_id', $user[0]['id']);
            Application::$app->response->redirect('/master');
        }
        
        return $this->view('auth.login', ['error' => 'Credenciales inválidas'], 'auth');
    }

    public function logout() {
        Application::$app->session->remove('user_id');
        Application::$app->response->redirect('/login');
    }
}
