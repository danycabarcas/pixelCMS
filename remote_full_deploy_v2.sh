#!/bin/bash
W_ROOT="/home/dany/web/cms.pixelapp.com.co/public_html"
sudo mkdir -p "$W_ROOT/app/Core" "$W_ROOT/app/Controllers" "$W_ROOT/app/Middleware" "$W_ROOT/routes" "$W_ROOT/resources/views/layouts" "$W_ROOT/resources/views/master/empresas" "$W_ROOT/resources/views/master/licencias" "$W_ROOT/resources/views/admin/pages" "$W_ROOT/resources/views/admin/files" "$W_ROOT/resources/views/site/news" "$W_ROOT/resources/views/site/pqrs" "$W_ROOT/resources/views/site/transparency" "$W_ROOT/database" "$W_ROOT/public"

# --- CORE (Ensure UTF-8 and complete classes) ---

# Database.php (Fix charset)
sudo tee "$W_ROOT/app/Core/Database.php" > /dev/null << 'EOF'
<?php
namespace App\Core;
use PDO;
class Database {
    private static ?Database $instance = null;
    private ?PDO $pdo = null;
    private function __construct() {
        $dsn = "pgsql:host=" . $_ENV['DB_HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=" . $_ENV['DB_NAME'];
        $this->pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    public static function getInstance() {
        if (self::$instance === null) { self::$instance = new Database(); }
        return self::$instance;
    }
    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    public function execute($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
}
EOF

# PageController.php
sudo tee "$W_ROOT/app/Controllers/PageController.php" > /dev/null << 'EOF'
<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Database;
class PageController extends Controller {
    public function index() {
        $db = Database::getInstance();
        $paginas = $db->query("SELECT * FROM paginas ORDER BY titulo ASC");
        return $this->view('admin.pages.index', ['paginas' => $paginas], 'master');
    }
}
EOF

# routes/web.php (All routes)
sudo tee "$W_ROOT/routes/web.php" > /dev/null << 'EOF'
<?php
$router->get('/', function() { header('Location: /master'); exit; });

// --- Master Panel ---
$router->get('/master', [\App\Controllers\MasterController::class, 'index']);

// --- CMS Admin ---
$router->get('/admin/pages', [\App\Controllers\PageController::class, 'index']);
EOF

# admin/pages/index.php
sudo tee "$W_ROOT/resources/views/admin/pages/index.php" > /dev/null << 'EOF'
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold">Páginas del CMS</h1>
    <a href="/admin/pages/create" class="bg-blue-600 px-6 py-2 rounded-lg font-bold">Crear Página</a>
</div>
<div class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-800 text-slate-400 uppercase text-xs">
            <tr><th class="p-4">Título</th><th class="p-4">Slug</th><th class="p-4">Estado</th></tr>
        </thead>
        <tbody>
            <?php foreach ($paginas as $p): ?>
            <tr class="border-t border-slate-800">
                <td class="p-4"><?= $p['titulo'] ?></td>
                <td class="p-4">/<?= $p['slug'] ?></td>
                <td class="p-4">Activa</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
EOF

sudo chown -R dany:dany "$W_ROOT"
chmod -R 755 "$W_ROOT"
