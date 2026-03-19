<?php

/** @var \App\Core\Router $router */

$router->get('/', function() {
    echo "<h1>Bienvenido a Pixel CMS</h1><p>El sistema está funcionando correctamente.</p>";
});

// --- Panel Maestro (Licencias y Empresas) ---
$router->get('/master',                     [\App\Controllers\MasterController::class, 'index']);
$router->get('/master/empresas/crear',      [\App\Controllers\MasterController::class, 'createEmpresa']);
$router->post('/master/empresas/crear',     [\App\Controllers\MasterController::class, 'createEmpresa']);
$router->get('/master/licencias/crear',     [\App\Controllers\MasterController::class, 'createLicencia']);
$router->post('/master/licencias/crear',    [\App\Controllers\MasterController::class, 'createLicencia']);

$router->get('/test', function() {
    echo "Endpoint de prueba funcionando.";
});

// --- CMS Admin (Páginas y Contenido) ---
$router->get('/admin/pages',                [\App\Controllers\PageController::class, 'index']);
$router->get('/admin/pages/edit/{id}',      [\App\Controllers\PageController::class, 'edit']);
$router->post('/admin/pages/save/{id}',     [\App\Controllers\PageController::class, 'save']);

// --- Gestor de Archivos ---
$router->get('/admin/files',                [\App\Controllers\FileManagerController::class, 'index']);
$router->post('/admin/files/upload',        [\App\Controllers\FileManagerController::class, 'upload']);
$router->get('/admin/files/delete/{name}',  [\App\Controllers\FileManagerController::class, 'delete']);

// --- Transparencia MINTIC ---
$router->get('/transparencia',              [\App\Controllers\TransparencyController::class, 'index']);

// --- Sección de Noticias ---
$router->get('/noticias',                   [\App\Controllers\NewsController::class, 'index']);
$router->get('/noticia/{slug}',             [\App\Controllers\NewsController::class, 'show']);

// --- PQRS ---
$router->get('/pqrs',                       [\App\Controllers\PQRSController::class, 'index']);
$router->post('/pqrs/enviar',               [\App\Controllers\PQRSController::class, 'store']);

// --- Renderizado de Páginas Públicas ---
$router->get('/{slug}',                     [\App\Controllers\PageController::class, 'show']);
