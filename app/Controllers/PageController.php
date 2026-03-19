<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Database;

class PageController extends Controller
{
    public function index()
    {
        $db = Database::getInstance();
        $pages = $db->query("SELECT * FROM paginas ORDER BY titulo ASC");
        return $this->view('admin.pages.index', ['pages' => $pages], 'admin');
    }

    public function edit(Request $request, $id)
    {
        $db = Database::getInstance();
        $page = $db->queryOne("SELECT * FROM paginas WHERE id = :id", ['id' => $id]);
        
        return $this->view('admin.pages.editor', ['page' => $page], 'editor');
    }

    public function save(Request $request, $id)
    {
        $db = Database::getInstance();
        $data = $request->all();
        
        $db->execute("
            UPDATE paginas 
            SET content_html = :html, content_css = :css, updated_at = NOW() 
            WHERE id = :id
        ", [
            'id'   => $id,
            'html' => $data['html'],
            'css'  => $data['css']
        ]);
        
        return $this->json(['success' => true]);
    }

    public function show(Request $request, $slug)
    {
        $db = Database::getInstance();
        $page = $db->queryOne("SELECT * FROM paginas WHERE slug = :slug", ['slug' => $slug]);
        
        if (!$page) {
            return $this->redirect('/404');
        }
        
        return $this->view('site.page', ['page' => $page], 'site');
    }
}
