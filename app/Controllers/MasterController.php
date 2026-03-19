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
                INSERT INTO licencias (empresa_id, dominio, codigo_licencia, fecha_vencimiento, plan_nombre, cuentas_correo, modulos_habilitados)
                VALUES (:empresa_id, :dominio, :codigo_licencia, :fecha_vencimiento, :plan_nombre, :cuentas_correo, :modulos)
            ", [
                'empresa_id'        => $data['empresa_id'],
                'dominio'           => $data['dominio'],
                'codigo_licencia'   => $codigo,
                'fecha_vencimiento' => $data['fecha_vencimiento'],
                'plan_nombre'       => $data['plan_nombre'],
                'cuentas_correo'    => $data['cuentas_correo'],
                'modulos'           => json_encode($data['modulos'] ?? [])
            ]);
            
            return $this->redirect('/master');
        }
        
        $empresas = $db->query("SELECT id, nombre FROM empresas");
        return $this->view('master.licencias.create', [
            'title'    => 'Nueva Licencia',
            'empresas' => $empresas
        ], 'master');
    }
}
