<?php
namespace App\Controllers;
use App\Core\Request;
use App\Core\Database;
use App\Core\Application;
use App\Middleware\AuthMiddleware;

class AdminCategoryController extends Controller {

    public function __construct() {
        $this->setLayout('admin');
    }

    public function index(Request $request) {
        $db = Database::getInstance();
        $empresaId = Application::$app->session->get('empresa_id');
        
        $categorias = $db->query("
            SELECT c.*, (SELECT COUNT(*) FROM noticias WHERE categoria_id = c.id) as total_noticias
            FROM categorias_noticias c
            WHERE c.empresa_id = :eid
            ORDER BY c.nombre ASC
        ", ['eid' => $empresaId]);

        return $this->render('admin/noticias/categorias', [
            'categorias' => $categorias,
            'title' => 'Gestión de Categorías'
        ]);
    }

    public function store(Request $request) {
        $db = Database::getInstance();
        $empresaId = Application::$app->session->get('empresa_id');
        $data = $request->all();

        if (empty($data['nombre'])) return $this->redirect('/admin/categorias');

        $slug = $this->generateSlug($data['nombre']);
        
        $db->execute("
            INSERT INTO categorias_noticias (empresa_id, nombre, slug) 
            VALUES (:eid, :nom, :slug)
        ", [
            'eid' => $empresaId,
            'nom' => $data['nombre'],
            'slug' => $slug
        ]);

        return $this->redirect('/admin/categorias');
    }

    public function delete(Request $request) {
        $db = Database::getInstance();
        $empresaId = Application::$app->session->get('empresa_id');
        $id = $request->getBody()['id'] ?? null;

        if ($id) {
            $db->execute("DELETE FROM categorias_noticias WHERE id = :id AND empresa_id = :eid", [
                'id' => $id, 
                'eid' => $empresaId
            ]);
        }
        return $this->redirect('/admin/categorias');
    }

    private function generateSlug($text) {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        return strtolower($text);
    }
}
