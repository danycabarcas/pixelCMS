<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Core\Application;
use App\Core\Database;

define('BASE_PATH', __DIR__);
$app = Application::getInstance();

try {
    $db = Database::getInstance();
    $columns = $db->query("SELECT table_name, column_name, data_type FROM information_schema.columns WHERE table_schema = 'public' ORDER BY table_name, ordinal_position");
    foreach($columns as $col) {
        echo $col['table_name'] . " -> " . $col['column_name'] . " (" . $col['data_type'] . ")\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
