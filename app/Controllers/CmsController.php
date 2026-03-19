<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\SiteSelector;

class CmsController extends Controller
{
    public function index()
    {
        $empresa = SiteSelector::identify();

        if (!$empresa) {
            return "Sitio no encontrado o no configurado en el Maestro.";
        }

        // Título del sitio para el ciudadano
        $title = "Portal Oficial - " . ($empresa['nombre'] ?? 'Entidad Pública');

        return $this->view('cms.index', [
            'empresa' => $empresa,
            'title'   => $title
        ], 'govco');
    }
}
