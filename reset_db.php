<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Core\Application;
use App\Core\Database;

define('BASE_PATH', __DIR__);
// Cargar variables de entorno
$app = Application::getInstance();

try {
    $db = Database::getInstance();
    $db->execute("TRUNCATE usuarios");
    
    $hash = password_hash('admin123', PASSWORD_DEFAULT);
    $db->execute("INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)", [
        'Administrador Master', 
        'admin@pixelcms.com', 
        $hash, 
        'superadmin'
    ]);
    
    echo "¡ÉXITO! Usuario admin@pixelcms.com restablecido con password: admin123\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
