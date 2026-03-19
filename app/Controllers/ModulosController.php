<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Database;

class ModulosController extends Controller
{
    public function index()
    {
        $db = Database::getInstance();
        $modulos = $db->query("SELECT * FROM modulos ORDER BY nombre ASC");
        
        return $this->view('master.modulos.index', [
            'title'   => 'Gestión de Módulos - Pixel CMS',
            'modulos' => $modulos
        ], 'master');
    }

    public function create(Request $request)
    {
        if ($request->method() === 'POST') {
            $db = Database::getInstance();
            $data = $request->all();
            
            $db->execute("
                INSERT INTO modulos (nombre, slug, descripcion, icono, status, created_at)
                VALUES (:nombre, :slug, :descripcion, :icono, :status, NOW())
            ", [
                'nombre'      => $data['nombre'],
                'slug'        => $data['slug'],
                'descripcion' => $data['descripcion'],
                'icono'       => $data['icono'] ?? 'fa-cube',
                'status'      => $data['status'] ?? 1
            ]);
            
            return $this->redirect('/master/modulos');
        }
        
        return $this->view('master.modulos.create', [
            'title' => 'Nuevo Módulo'
        ], 'master');
    }

    public function edit(Request $request, $id)
    {
        $db = Database::getInstance();
        $modulo = $db->query("SELECT * FROM modulos WHERE id = :id", ['id' => $id])[0] ?? null;
        if (!$modulo) return $this->redirect('/master/modulos');

        if ($request->method() === 'POST') {
            $data = $request->all();
            $db->execute("
                UPDATE modulos SET nombre = :nombre, slug = :slug, descripcion = :descripcion, 
                icono = :icono, status = :status
                WHERE id = :id
            ", [
                'nombre'      => $data['nombre'],
                'slug'        => $data['slug'],
                'descripcion' => $data['descripcion'],
                'icono'       => $data['icono'] ?? 'fa-cube',
                'status'      => $data['status'] ?? 1,
                'id'          => $id
            ]);
            
            return $this->redirect('/master/modulos');
        }

        return $this->view('master.modulos.edit', [
            'title'  => 'Editar Módulo',
            'modulo' => $modulo
        ], 'master');
    }
}
