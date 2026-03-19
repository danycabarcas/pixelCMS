<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Database;

class MasterController extends Controller
{
    public function index()
    {
        $db = Database::getInstance();
        $empresas = $db->query("SELECT * FROM empresas ORDER BY nombre ASC");
        
        return $this->view('master.index', [
            'title'    => 'Panel Maestro - Pixel CMS',
            'empresas' => $empresas
        ], 'master');
    }

    public function createEmpresa(Request $request)
    {
        if ($request->method() === 'POST') {
            $db = Database::getInstance();
            $data = $request->all();
            
            $db->execute("
                INSERT INTO empresas (nombre, nit, direccion, email_contacto, responsable, whatsapp, contacto_facturacion, contacto_tecnico, created_at)
                VALUES (:nombre, :nit, :direccion, :email_contacto, :responsable, :whatsapp, :facturacion, :tecnico, NOW())
            ", [
                'nombre'           => $data['nombre'],
                'nit'              => $data['nit'],
                'direccion'        => $data['direccion'],
                'email_contacto'   => $data['email_contacto'],
                'responsable'      => $data['responsable'],
                'whatsapp'         => $data['whatsapp'],
                'facturacion'      => $data['contacto_facturacion'],
                'tecnico'          => $data['contacto_tecnico']
            ]);
            
            return $this->redirect('/master');
        }
        
        return $this->view('master.empresas.create', [
            'title' => 'Nueva Empresa Maestro'
        ], 'master');
    }

    public function createLicencia(Request $request)
    {
        $db = Database::getInstance();
        
        if ($request->method() === 'POST') {
            $data = $request->all();
            
            // Generar un código de licencia aleatorio
            $codigo = strtoupper(bin2hex(random_bytes(8)));
            
            $db->execute("
                INSERT INTO licencias (empresa_id, codigo_licencia, fecha_inicio, fecha_vencimiento, modulos_json, status, created_at, periodo_gracia_dias)
                VALUES (:empresa_id, :codigo_licencia, NOW(), :fecha_vencimiento, :modulos, 1, NOW(), :gracia)
            ", [
                'empresa_id'        => $data['empresa_id'],
                'codigo_licencia'   => $codigo,
                'fecha_vencimiento' => $data['fecha_vencimiento'],
                'modulos'           => json_encode($data['modulos'] ?? []),
                'gracia'            => $data['periodo_gracia'] ?? 7
            ]);
            
            return $this->redirect('/master');
        }
        
        $empresas = $db->query("SELECT id, nombre FROM empresas");
        $modulos = $db->query("SELECT * FROM modulos WHERE status = 1 ORDER BY nombre ASC");
        
        return $this->view('master.licencias.create', [
            'title'    => 'Nueva Licencia',
            'empresas' => $empresas,
            'modulos'  => $modulos
        ], 'master');
    }
}
