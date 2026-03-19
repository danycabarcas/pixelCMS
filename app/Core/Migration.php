<?php
namespace App\Core;

use App\Core\Database;

class Migration
{
    private $db;
    private $migrationsPath;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->migrationsPath = BASE_PATH . '/migrations';
        $this->initMigrationsTable();
    }

    private function initMigrationsTable()
    {
        $this->db->execute("
            CREATE TABLE IF NOT EXISTS migrations (
                id SERIAL PRIMARY KEY,
                migration VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ");
    }

    public function migrate()
    {
        $appliedMigrations = $this->db->query("SELECT migration FROM migrations");
        $appliedMigrations = array_column($appliedMigrations, 'migration');

        $files = scandir($this->migrationsPath);
        $toApply = array_diff($files, array_merge(['.', '..'], $appliedMigrations));

        if (empty($toApply)) {
            echo "✔ No hay migraciones pendientes.\n";
            return;
        }

        foreach ($toApply as $migrationFile) {
            $sql = file_get_contents($this->migrationsPath . '/' . $migrationFile);
            echo "⏳ Aplicando: $migrationFile...\n";
            
            try {
                // Usamos exec para permitir múltiples comandos SQL en un solo archivo
                $this->db->getPDO()->exec($sql);
                $this->db->execute("INSERT INTO migrations (migration) VALUES (:m)", ['m' => $migrationFile]);
                echo "✅ Éxito.\n";
            } catch (\Exception $e) {
                echo "❌ ERROR en $migrationFile: " . $e->getMessage() . "\n";
                break;
            }
        }
    }
}
