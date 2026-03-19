<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';

use App\Core\Application;

$app = Application::getInstance();

// Cargar rutas
$router = $app->router;
require_once BASE_PATH . '/routes/web.php';

$app->run();
