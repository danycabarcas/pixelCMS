<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Database;
use App\Core\SiteSelector;
use App\Core\Application;

class AdminDashboardController extends Controller {
    public function index() {
        $db = Database::getInstance();
        $empresa = SiteSelector::identify();
        
        // Si entramos por un dominio que no es el autorizado (ej: localhost o IP)
        // buscamos la empresa por el ID de la sesión del usuario logueado.
        if (!$empresa) {
            $empresaId = Application::$app->session->get('empresa_id');
            if ($empresaId) {
                $empresa = $db->query("SELECT * FROM empresas WHERE id = :id", ['id' => $empresaId])[0] ?? null;
            }
        }
        
        return $this->view('admin.dashboard', [
            'title' => 'Dashboard Gestion de Entidad',
            'empresa' => $empresa
        ], 'admin');
    }
}
