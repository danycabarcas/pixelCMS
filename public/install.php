<?php
/**
 * Pixel CMS - Asistente de Instalación
 */

define('BASE_PATH', dirname(__DIR__));

// Comprobar si ya está instalado
if (file_exists(BASE_PATH . '/.env')) {
    die("El sistema ya parece estar instalado. Si desea reinstalar, elimine el archivo .env.");
}

$step = $_GET['step'] ?? 1;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($step == 2) {
        // Guardar configuración de BD y validar conexión
        $host = $_POST['db_host'];
        $port = $_POST['db_port'];
        $name = $_POST['db_name'];
        $user = $_POST['db_user'];
        $pass = $_POST['db_pass'];

        try {
            $dsn = "pgsql:host={$host};port={$port};dbname={$name}";
            $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            
            // Si la conexión es exitosa, guardar en sesión temporal (o archivo temporal)
            session_start();
            $_SESSION['db_config'] = $_POST;
            header("Location: install.php?step=3");
            exit;
        } catch (PDOException $e) {
            $error = "Error de conexión: " . $e->getMessage();
        }
    }

    if ($step == 3) {
        // Validar Licencia y Generar .env
        session_start();
        $db_config = $_SESSION['db_config'];
        $license_code = $_POST['license_code'];
        $domain = $_SERVER['HTTP_HOST'];

        // Aquí deberíamos validar la licencia contra el Panel Maestro (o DB local si es el mismo server)
        // Por ahora, simularemos éxito
        
        $env_content = "APP_NAME=\"Pixel CMS\"\n";
        $env_content .= "APP_ENV=production\n";
        $env_content .= "APP_URL=\"http://{$domain}\"\n";
        $env_content .= "DB_HOST={$db_config['db_host']}\n";
        $env_content .= "DB_PORT={$db_config['db_port']}\n";
        $env_content .= "DB_NAME={$db_config['db_name']}\n";
        $env_content .= "DB_USER={$db_config['db_user']}\n";
        $env_content .= "DB_PASS={$db_config['db_pass']}\n";
        $env_content .= "LICENSE_KEY=\"{$license_code}\"\n";

        if (file_put_contents(BASE_PATH . '/.env', $env_content)) {
            // Ejecutar migraciones iniciales
            try {
                $dsn = "pgsql:host={$db_config['db_host']};port={$db_config['db_port']};dbname={$db_config['db_name']}";
                $pdo = new PDO($dsn, $db_config['db_user'], $db_config['db_pass'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
                
                $sql = file_get_contents(BASE_PATH . '/database/master_schema.sql'); // O un esquema de sitio individual
                $pdo->exec($sql);
                
                header("Location: install.php?step=4");
                exit;
            } catch (Exception $e) {
                $error = "Error al configurar la base de datos: " . $e->getMessage();
            }
        } else {
            $error = "No se pudo escribir el archivo .env. Verifique permisos.";
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Instalador Pixel CMS</title>
    <style>
        body { font-family: sans-serif; background: #f1f5f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .wizard { background: white; padding: 2rem; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); width: 400px; }
        h1 { color: #0f172a; font-size: 1.5rem; margin-top: 0; }
        .step-info { color: #64748b; margin-bottom: 1.5rem; }
        input { width: 100%; padding: 0.75rem; margin-bottom: 1rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; box-sizing: border-box; }
        button { width: 100%; padding: 0.75rem; background: #38bdf8; color: white; border: none; border-radius: 0.5rem; cursor: pointer; font-weight: bold; }
        .error { color: #dc2626; background: #fee2e2; padding: 0.75rem; border-radius: 0.5rem; margin-bottom: 1rem; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="wizard">
        <h1>Pixel CMS</h1>
        
        <?php if ($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <?php if ($step == 1): ?>
            <div class="step-info">Paso 1: Bienvenida</div>
            <p>Bienvenido al asistente de instalación de Pixel CMS. Asegúrese de tener sus credenciales de base de datos a mano.</p>
            <button onclick="location.href='install.php?step=2'">Empezar</button>
        <?php elseif ($step == 2): ?>
            <div class="step-info">Paso 2: Base de Datos (PostgreSQL)</div>
            <form method="POST">
                <input type="text" name="db_host" value="localhost" placeholder="Host (ej: localhost)">
                <input type="text" name="db_port" value="5432" placeholder="Puerto (ej: 5432)">
                <input type="text" name="db_name" placeholder="Nombre de la DB">
                <input type="text" name="db_user" value="postgres" placeholder="Usuario">
                <input type="password" name="db_pass" placeholder="Contraseña">
                <button type="submit">Siguiente</button>
            </form>
        <?php elseif ($step == 3): ?>
            <div class="step-info">Paso 3: Activación</div>
            <form method="POST">
                <input type="text" name="license_code" placeholder="Código de Licencia" required>
                <p style="font-size: 0.8rem; color: #64748b;">La licencia debe estar vinculada al dominio: <?= $_SERVER['HTTP_HOST'] ?></p>
                <button type="submit">Instalar Ahora</button>
            </form>
        <?php elseif ($step == 4): ?>
            <div class="step-info">Paso 4: ¡Completado!</div>
            <p>Pixel CMS se ha instalado correctamente.</p>
            <button onclick="location.href='index.php'">Ir al Sitio</button>
        <?php endif; ?>
    </div>
</body>
</html>
