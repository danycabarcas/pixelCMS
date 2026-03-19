#!/bin/bash
W_ROOT="/home/dany/web/cms.pixelapp.com.co/public_html"
sudo mkdir -p "$W_ROOT/app/Core" "$W_ROOT/app/Controllers" "$W_ROOT/app/Middleware" "$W_ROOT/routes" "$W_ROOT/resources/views/layouts" "$W_ROOT/resources/views/master/empresas" "$W_ROOT/resources/views/master/licencias" "$W_ROOT/database" "$W_ROOT/public"

# --- CORE ---
write_f() { sudo tee "$W_ROOT/$1" > /dev/null << 'EOF'
$2
EOF
}

# Request.php
sudo tee "$W_ROOT/app/Core/Request.php" > /dev/null << 'EOF'
<?php
namespace App\Core;
class Request {
    public function getPath() {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false) { return $path; }
        return substr($path, 0, $position);
    }
    public function method() { return strtolower($_SERVER['REQUEST_METHOD']); }
    public function all() {
        $data = [];
        if ($this->method() === 'get') { foreach ($_GET as $key => $value) { $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS); } }
        if ($this->method() === 'post') { foreach ($_POST as $key => $value) { $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS); } }
        return $data;
    }
}
EOF

# Response.php
sudo tee "$W_ROOT/app/Core/Response.php" > /dev/null << 'EOF'
<?php
namespace App\Core;
class Response {
    public function setStatusCode(int $code) { http_response_code($code); }
    public function redirect(string $url) { header("Location: $url"); exit; }
}
EOF

# Session.php
sudo tee "$W_ROOT/app/Core/Session.php" > /dev/null << 'EOF'
<?php
namespace App\Core;
class Session {
    protected const FLASH_KEY = 'flash_messages';
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) { session_name('PIXEL_SESS'); session_start(); }
    }
    public function set($key, $value) { $_SESSION[$key] = $value; }
    public function get($key) { return $_SESSION[$key] ?? false; }
    public function remove($key) { unset($_SESSION[$key]); }
}
EOF

# Controller.php
sudo tee "$W_ROOT/app/Core/Controller.php" > /dev/null << 'EOF'
<?php
namespace App\Core;
class Controller {
    public function view($view, $params = [], $layout = 'master') {
        return View::renderView($view, $params, $layout);
    }
}
EOF

# View.php
sudo tee "$W_ROOT/app/Core/View.php" > /dev/null << 'EOF'
<?php
namespace App\Core;
class View {
    public static function renderView($view, $params = [], $layout = 'master') {
        $layoutContent = self::layoutContent($layout);
        $viewContent = self::renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    protected static function layoutContent($layout) {
        ob_start();
        include_once Application::$ROOT_DIR . "/resources/views/layouts/$layout.php";
        return ob_get_clean();
    }
    protected static function renderOnlyView($view, $params) {
        foreach ($params as $key => $value) { $$key = $value; }
        $view = str_replace('.', '/', $view);
        ob_start();
        include_once Application::$ROOT_DIR . "/resources/views/$view.php";
        return ob_get_clean();
    }
}
EOF

# Layout Master
sudo tee "$W_ROOT/resources/views/layouts/master.php" > /dev/null << 'EOF'
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Pixel CMS Master' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style> :root { --accent: #2563eb; } body { background: #0f172a; color: #f8fafc; font-family: 'Outfit', sans-serif; } </style>
</head>
<body class="flex">
    <aside class="w-64 h-screen bg-slate-900 p-6 border-r border-slate-800">
        <h1 class="text-xl font-bold text-blue-500 mb-8">Pixel CMS <span class="text-xs text-white">SaaS</span></h1>
        <nav class="space-y-4">
            <a href="/master" class="block p-3 hover:bg-slate-800 rounded-lg"><i class="fa-solid fa-building mr-2"></i> Empresas</a>
            <a href="/admin/pages" class="block p-3 hover:bg-slate-800 rounded-lg"><i class="fa-solid fa-file-lines mr-2"></i> Páginas</a>
        </nav>
    </aside>
    <main class="flex-1 p-10 overflow-auto">
        {{content}}
    </main>
</body>
</html>
EOF

# View Master Index
sudo tee "$W_ROOT/resources/views/master/index.php" > /dev/null << 'EOF'
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold">Gestión de Empresas</h1>
    <a href="/master/empresas/crear" class="bg-blue-600 px-6 py-2 rounded-lg font-bold">Nueva Empresa</a>
</div>

<div class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-800 text-slate-400 uppercase text-xs">
            <tr><th class="p-4">NIT</th><th class="p-4">Empresa</th><th class="p-4">Estado</th><th class="p-4">Acciones</th></tr>
        </thead>
        <tbody>
            <?php foreach ($empresas as $e): ?>
            <tr class="border-t border-slate-800">
                <td class="p-4"><?= $e['nit'] ?></td>
                <td class="p-4"><?= $e['nombre'] ?></td>
                <td class="p-4"><span class="px-2 py-1 bg-green-900 text-green-400 rounded text-xs">Activa</span></td>
                <td class="p-4"><i class="fa-solid fa-ellipsis-vertical"></i></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
EOF

# helper
sudo mkdir -p "$W_ROOT/app/Helpers"
sudo tee "$W_ROOT/app/Helpers/helpers.php" > /dev/null << 'EOF'
<?php
function base_url($path = '') { return (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . '/' . ltrim($path, '/'); }
EOF

sudo chown -R dany:dany "$W_ROOT"
chmod -R 755 "$W_ROOT"
