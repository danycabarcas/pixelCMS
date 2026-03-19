<?php
namespace App\Components;
use App\Core\Database;

class NewsComponent {
    
    /**
     * Renderiza un bloque de noticias dinámico
     * $style: hero_wall, split_list, bg_hero, compact_list
     * $filter: ['tag' => '#portada', 'category' => 'Convocatorias']
     */
    public static function render($style = 'hero_wall', $filter = [], $limit = 5) {
        $db = Database::getInstance();
        $empresaId = $_SESSION['empresa_id'] ?? 1; // Fallback
        
        $params = ['eid' => $empresaId];
        $where = "WHERE n.empresa_id = :eid AND n.status = 1";
        
        if (!empty($filter['tag'])) {
            $where .= " AND n.tags LIKE :tag";
            $params['tag'] = '%' . $filter['tag'] . '%';
        }
        
        if (!empty($filter['category'])) {
            $where .= " AND c.slug = :cat";
            $params['cat'] = $filter['category'];
        }

        $noticias = $db->query("
            SELECT n.*, c.nombre as categoria_nombre 
            FROM noticias n 
            LEFT JOIN categorias_noticias c ON n.categoria_id = c.id
            $where 
            ORDER BY n.fecha_publicacion DESC
            LIMIT $limit
        ", $params);

        if (empty($noticias)) return "<!-- No hay noticias para este filtro -->";

        // Cargar la vista correspondiente al estilo
        ob_start();
        include dirname(__DIR__, 2) . "/resources/views/components/news/{$style}.php";
        return ob_get_clean();
    }
}
