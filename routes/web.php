<?php
use App\Middleware\AuthMiddleware;
use App\Controllers\MasterController;
use App\Controllers\PageController;
use App\Controllers\AuthController;

// --- Autenticación ---
$router->get('/login', [AuthController::class, 'loginView']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout']);

// --- Ruta Principal y Error ---
$router->get('/', function() { header('Location: /master'); exit; });
$router->get('/404', function() { return "Error 404: Ruta no encontrada"; });

// --- Panel Maestro (Protegido) ---
$router->get('/master', [MasterController::class, 'index'], [AuthMiddleware::class]);
$router->get('/master/empresas/crear', [MasterController::class, 'createEmpresa'], [AuthMiddleware::class]);
$router->post('/master/empresas/crear', [MasterController::class, 'createEmpresa'], [AuthMiddleware::class]);
$router->get('/master/licencias/crear', [MasterController::class, 'createLicencia'], [AuthMiddleware::class]);
$router->post('/master/licencias/crear', [MasterController::class, 'createLicencia'], [AuthMiddleware::class]);

// --- Módulos Maestro ---
$router->get('/master/modulos', [\App\Controllers\ModulosController::class, 'index'], [AuthMiddleware::class]);
$router->get('/master/modulos/crear', [\App\Controllers\ModulosController::class, 'create'], [AuthMiddleware::class]);
$router->post('/master/modulos/crear', [\App\Controllers\ModulosController::class, 'create'], [AuthMiddleware::class]);

// --- CMS Pages ---
$router->get('/admin/pages', [PageController::class, 'index'], [AuthMiddleware::class]);
$router->get('/admin/pages/create', [PageController::class, 'create'], [AuthMiddleware::class]);
$router->post('/admin/pages/create', [PageController::class, 'create'], [AuthMiddleware::class]);
$router->get('/admin/pages/edit/{id}', [PageController::class, 'edit'], [AuthMiddleware::class]);
$router->post('/admin/pages/save/{id}', [PageController::class, 'save'], [AuthMiddleware::class]);
$router->get('/{slug}', [PageController::class, 'show']);

// --- Otros Módulos ---
$router->get('/admin/files', [\App\Controllers\FileManagerController::class, 'index'], [AuthMiddleware::class]);
$router->get('/transparencia', [\App\Controllers\TransparencyController::class, 'index']);
$router->get('/noticias', [\App\Controllers\NewsController::class, 'index']);
$router->get('/pqrs', [\App\Controllers\PQRSController::class, 'index']);
