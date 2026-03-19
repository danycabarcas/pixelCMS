#!/bin/bash
# Despliegue de Pixel CMS - Panel SaaS Maestro

WEB_ROOT="/home/dany/web/cms.pixelapp.com.co/public_html"
sudo mkdir -p "$WEB_ROOT/app/Core" "$WEB_ROOT/app/Controllers" "$WEB_ROOT/app/Middleware" "$WEB_ROOT/routes" "$WEB_ROOT/resources/views/layouts" "$WEB_ROOT/resources/views/master/empresas" "$WEB_ROOT/resources/views/master/licencias" "$WEB_ROOT/database" "$WEB_ROOT/public"

# --- CORE CLASSES ---
sudo tee "$WEB_ROOT/app/Core/Application.php" << 'EOF'
<?php
namespace App\Core;
use Dotenv\Dotenv;
class Application {
    public static string $ROOT_DIR;
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public ?Database $db = null;
    public function __construct(string $rootDir) {
        self::$ROOT_DIR = $rootDir;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        if (file_exists($rootDir . '/.env')) {
            $dotenv = Dotenv::createImmutable($rootDir);
            $dotenv->load();
            $this->db = Database::getInstance();
        }
    }
    public function run() {
        try { echo $this->router->resolve(); } 
        catch (\Exception $e) { $this->response->setStatusCode($e->getCode() ?: 500); echo $e->getMessage(); }
    }
}
EOF

sudo tee "$WEB_ROOT/app/Core/Router.php" << 'EOF'
<?php
namespace App\Core;
class Router {
    protected array $routes = [];
    public Request $request;
    public Response $response;
    public function __construct(Request $request, Response $response) {
        $this->request = $request;
        $this->response = $response;
    }
    public function get($path, $callback) { $this->routes['get'][$path] = $callback; }
    public function post($path, $callback) { $this->routes['post'][$path] = $callback; }
    public function resolve() {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) { $this->response->setStatusCode(404); return "Página no encontrada"; }
        if (is_string($callback)) { return View::renderView($callback); }
        if (is_array($callback)) { $callback[0] = new $callback[0](); }
        return call_user_func($callback, $this->request);
    }
}
EOF

sudo tee "$WEB_ROOT/app/Core/Database.php" << 'EOF'
<?php
namespace App\Core;
use PDO;
class Database {
    private static ?Database $instance = null;
    private ?PDO $pdo = null;
    private function __construct() {
        $dsn = "pgsql:host=" . $_ENV['DB_HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=" . $_ENV['DB_NAME'];
        $this->pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public static function getInstance() {
        if (self::$instance === null) { self::$instance = new Database(); }
        return self::$instance;
    }
    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function execute($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
}
EOF

# --- MASTER CONTROLLER ---
sudo tee "$WEB_ROOT/app/Controllers/MasterController.php" << 'EOF'
<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Database;
class MasterController extends Controller {
    public function index() {
        $db = Database::getInstance();
        $empresas = $db->query("SELECT * FROM empresas ORDER BY nombre ASC");
        return $this->view('master.index', ['title' => 'Panel Maestro - Pixel CMS', 'empresas' => $empresas], 'master');
    }
}
EOF

# --- ROUTES ---
sudo tee "$WEB_ROOT/routes/web.php" << 'EOF'
<?php
$router->get('/', function() { header('Location: /master'); exit; });
$router->get('/master', [\App\Controllers\MasterController::class, 'index']);
EOF

# --- INDEX ---
sudo tee "$WEB_ROOT/public/index.php" << 'EOF'
<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
$app = new \App\Core\Application(dirname(__DIR__));
$app->run();
EOF

# --- .ENV ---
sudo tee "$WEB_ROOT/.env" << EOF
APP_NAME="Pixel CMS Master"
APP_ENV=production
DB_HOST=localhost
DB_PORT=5432
DB_NAME=postgres
DB_USER=postgres
DB_PASS=Imgx33*t1c.M4gd4l3n4
EOF

# Final permissions
sudo chown -R dany:dany "$WEB_ROOT"
chmod -R 755 "$WEB_ROOT"
