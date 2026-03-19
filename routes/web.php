<?php
/**
 * PixelCMS - Web Routes
 * Core Engine
 */
use App\Core\Application;
use App\Controllers\AdminNewsController;
use App\Controllers\AdminCategoryController;
use App\Middleware\AuthMiddleware;

// Instanciar el Router a través de la aplicación
$router = Application::$app->router;

// RUTAS DE NOTICIAS
$router->get('/admin/noticias', [AdminNewsController::class, 'index'], [AuthMiddleware::class]);
$router->get('/admin/noticias/crear', [AdminNewsController::class, 'create'], [AuthMiddleware::class]);
$router->post('/admin/noticias/crear', [AdminNewsController::class, 'create'], [AuthMiddleware::class]);
$router->post('/admin/noticias/categoria/crear', [AdminNewsController::class, 'storeCategory'], [AuthMiddleware::class]);

// RUTAS DE CATEGORIAS
$router->get('/admin/categorias', [AdminCategoryController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/categorias/guardar', [AdminCategoryController::class, 'store'], [AuthMiddleware::class]);
$router->post('/admin/categorias/eliminar', [AdminCategoryController::class, 'delete'], [AuthMiddleware::class]);
