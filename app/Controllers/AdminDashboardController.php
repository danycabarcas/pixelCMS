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
        
        // Si por alguna razón un admin entra por el dominio equivocado, 
        // podrías validarlo aquí. Pero SiteSelector ya nos da la empresa del host.
        
        return $this->view('admin.dashboard', [
            'title' => 'Dashboard Co-Administrador',
            'empresa' => $empresa
        ], 'admin');
    }
}
