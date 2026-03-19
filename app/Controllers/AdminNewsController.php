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

    public function storeCategory(Request $request) {
        $db = Database::getInstance();
        $empresaId = Application::$app->session->get('empresa_id');
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (empty($data['nombre'])) {
            header('Content-Type: application/json');
            return json_encode(['success' => false, 'error' => 'Nombre requerido']);
        }

        $slug = $this->generateSlug($data['nombre']);
        
        try {
            $db->execute("
                INSERT INTO categorias_noticias (empresa_id, nombre, slug) 
                VALUES (:eid, :nom, :slug)
            ", [
                'eid' => $empresaId,
                'nom' => $data['nombre'],
                'slug' => $slug
            ]);
            
            $results = $db->query("SELECT id FROM categorias_noticias WHERE slug = :slug AND empresa_id = :eid ORDER BY id DESC LIMIT 1", ['slug' => $slug, 'eid' => $empresaId]);
            $id = $results[0]['id'];
            
            header('Content-Type: application/json');
            return json_encode(['success' => true, 'id' => $id]);
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            return json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function create(Request $request) {
        $db = Database::getInstance();
        $empresaId = Application::$app->session->get('empresa_id');
        
        if ($request->method() === 'POST') {
            $data = $request->all();
            $slug = !empty($data['slug']) ? $data['slug'] : $this->generateSlug($data['titulo']);
            
            // --- MANEJO DE IMAGEN ESTANCA (TENANCY) ---
            $uploadedPath = null;
            if (!empty($_FILES['imagen_portada']['name'])) {
                // Creamos carpeta privada: uploads/empresa_X/noticias/
                $targetDir = dirname(__DIR__, 2) . "/public/uploads/empresa_{$empresaId}/noticias/";
                if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
                
                $fileName = time() . '_' . basename($_FILES['imagen_portada']['name']);
                $targetFile = $targetDir . $fileName;
                
                if (move_uploaded_file($_FILES['imagen_portada']['tmp_name'], $targetFile)) {
                    $uploadedPath = "/uploads/empresa_{$empresaId}/noticias/" . $fileName;
                }
            }
            
            $db->execute("
                INSERT INTO noticias (
                    empresa_id, titulo, slug, resumen, contenido_html, imagen_portada,
                    meta_title, meta_description, categoria_id, tags, status, fecha_publicacion
                ) VALUES (:eid, :tit, :slug, :res, :html, :img, :mtit, :mdes, :cat, :tags, 1, NOW())
            ", [
                'eid'  => $empresaId,
                'tit'  => $data['titulo'],
                'slug' => $slug,
                'res'  => $data['resumen'] ?? '',
                'html' => $data['contenido'],
                'img'  => $uploadedPath,
                'mtit' => $data['meta_title'] ?? $data['titulo'],
                'mdes' => $data['meta_description'] ?? ($data['resumen'] ?? ''),
                'cat'  => !empty($data['categoria_id']) ? $data['categoria_id'] : null,
                'tags' => $data['tags'] ?? ''
            ]);

            return $this->redirect('/admin/noticias');
        }

        // Obtenemos categorías de esta empresa
        $categorias = $db->query("SELECT * FROM categorias_noticias WHERE empresa_id = :eid", ['eid' => $empresaId]);
        
        // Obtenemos una lista de tags únicos usados anteriormente (para la nube de tags)
        $popularTagsResult = $db->query("SELECT tags FROM noticias WHERE empresa_id = :eid AND tags != '' LIMIT 50", ['eid' => $empresaId]);
        
        $tagsArray = [];
        foreach($popularTagsResult as $row) {
            $rowTags = explode(',', $row['tags']);
            foreach($rowTags as $tag) {
                $tag = trim($tag);
                if (!empty($tag)) $tagsArray[$tag] = ($tagsArray[$tag] ?? 0) + 1;
            }
        }
        arsort($tagsArray);
        $popularTags = array_keys(array_slice($tagsArray, 0, 10));

        return $this->view('admin.noticias.create', [
            'title' => 'Nueva Noticia Magazine',
            'categorias' => $categorias,
            'popularTags' => $popularTags
        ], 'admin');
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
