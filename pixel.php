<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Application;
use App\Core\Migration;

define('BASE_PATH', __DIR__);

// Inicializar Aplicación (Carga .env y servicios)
$app = Application::getInstance();

$command = $argv[1] ?? 'help';

switch ($command) {
    case 'migrate':
        echo "🚀 Iniciando Migraciones Pixel CMS...\n";
        $migrate = new Migration();
        $migrate->migrate();
        echo "✅ Proceso completado.\n";
        break;
        
    default:
        echo "Pixel CMS Console 1.0\n";
        echo "--------------------------\n";
        echo "Uso: php pixel.php [comando]\n\n";
        echo "Comandos disponibles:\n";
        echo "  migrate    Aplica todas las migraciones SQL pendientes en /migrations\n";
        break;
}
