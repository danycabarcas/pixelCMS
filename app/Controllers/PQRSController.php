<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Database;

class PQRSController extends Controller
{
    public function index()
    {
        return $this->view('site.pqrs.index', [], 'site');
    }

    public function store(Request $request)
    {
        $db = Database::getInstance();
        $data = $request->all();
        $radicado = 'RAD-' . strtoupper(bin2hex(random_bytes(4)));

        $db->execute("
            INSERT INTO pqrs (codigo_radicado, nombre_remitente, email_remitente, tipo, asunto, mensaje)
            VALUES (:rad, :nombre, :email, :tipo, :asunto, :mensaje)
        ", [
            'rad'     => $radicado,
            'nombre'  => $data['nombre'],
            'email'   => $data['email'],
            'tipo'    => $data['tipo'],
            'asunto'  => $data['asunto'],
            'mensaje' => $data['mensaje']
        ]);

        return $this->view('site.pqrs.success', ['radicado' => $radicado], 'site');
    }
}
