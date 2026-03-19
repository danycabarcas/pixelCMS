<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Database;

class TransparencyController extends Controller
{
    public function index()
    {
        // La sección de transparencia es una lista de categorías requeridas por MINTIC
        $categories = [
            ['id' => 1, 'title' => '1. Información de la entidad', 'url' => '/transparencia/entidad'],
            ['id' => 2, 'title' => '2. Normatividad', 'url' => '/transparencia/normatividad'],
            ['id' => 3, 'title' => '3. Contratación', 'url' => '/transparencia/contratacion'],
            ['id' => 4, 'title' => '4. Planeación', 'url' => '/transparencia/planeacion'],
            ['id' => 5, 'title' => '5. Trámites y servicios', 'url' => '/servicios'],
            ['id' => 6, 'title' => '6. Participa', 'url' => '/participa'],
            ['id' => 7, 'title' => '7. Datos abiertos', 'url' => '/datos-abiertos'],
            ['id' => 8, 'title' => '8. Información específica para grupos de interés', 'url' => '/grupos-interes'],
            ['id' => 9, 'title' => '9. Obligación de reporte de información', 'url' => '/reportes'],
            ['id' => 10, 'title' => '10. Atención y servicios a la ciudadanía', 'url' => '/atencion'],
        ];

        return $this->view('site.transparency.index', [
            'title'      => 'Transparencia y Acceso a la Información Pública',
            'categories' => $categories
        ], 'site');
    }
}
