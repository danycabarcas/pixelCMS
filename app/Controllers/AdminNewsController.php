<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Database;
use App\Core\Application;
use App\Core\SiteSelector;

class AdminNewsController extends Controller {
    
    public function index() {
        $db = Database::getInstance();
        $empresaId = Application::$app->session->get('empresa_id');
        
        // Obtenemos solo las noticias de ESTA empresa
        $noticias = $db->query("
            SELECT n.*, c.nombre as categoria_nombre 
            FROM noticias n 
            LEFT JOIN categorias_noticias c ON n.categoria_id = c.id
            WHERE n.empresa_id = :eid 
            ORDER BY n.fecha_publicacion DESC
        ", ['eid' => $empresaId]);

        return $this->view('admin.noticias.index', [
            'title' => 'Gestión de Noticias',
            'noticias' => $noticias
        ], 'admin');
    }

    public function create(Request $request) {
        $db = Database::getInstance();
        $empresaId = Application::$app->session->get('empresa_id');
        
        if ($request->method() === 'POST') {
            $data = $request->all();
            $slug = !empty($data['slug']) ? $data['slug'] : $this->generateSlug($data['titulo']);
            
            $db->execute("
                INSERT INTO noticias (
                    empresa_id, titulo, slug, resumen, contenido_html, 
                    meta_title, meta_description, status, fecha_publicacion
                ) VALUES (:eid, :tit, :slug, :res, :html, :mtit, :mdes, 1, NOW())
            ", [
                'eid'  => $empresaId,
                'tit'  => $data['titulo'],
                'slug' => $slug,
                'res'  => $data['resumen'],
                'html' => $data['contenido'],
                'mtit' => $data['meta_title'] ?? $data['titulo'],
                'mdes' => $data['meta_description'] ?? $data['resumen']
            ]);

            return $this->redirect('/admin/noticias');
        }

        return $this->view('admin.noticias.create', ['title' => 'Nueva Noticia'], 'admin');
    }

    private function generateSlug($text) {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = strtolower($text);
        return empty($text) ? 'n-a' : $text;
    }
}
