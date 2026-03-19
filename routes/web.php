<?php
/**
 * PixelCMS - The CORRECTED Route Map
 * Core Engine
 */
use App\Core\Application;
use App\Controllers\AdminDashboardController;
use App\Controllers\AdminNewsController;
use App\Controllers\AdminCategoryController;
use App\Controllers\PageController;
use App\Controllers\CmsController;
use App\Middleware\AuthMiddleware;

// 1. Instanciar el Router a través del núcleo Master
$router = Application::$app->router;

// --- EJE DE NAVEGACIÓN ADMINISTRATIVA (PRO) ---
$router->get('/admin/dashboard', [AdminDashboardController::class, 'index'], [AuthMiddleware::class]);
$router->get('/admin/perfil', [AdminDashboardController::class, 'perfil'], [AuthMiddleware::class]);

// --- MÓDULO DE PÁGINAS ---
$router->get('/admin/pages', [PageController::class, 'index'], [AuthMiddleware::class]);
$router->get('/admin/pages/create', [PageController::class, 'create'], [AuthMiddleware::class]);
$router->post('/admin/pages/create', [PageController::class, 'create'], [AuthMiddleware::class]);

// --- MÓDULO DE NOTICIAS (Magazine Senior) ---
$router->get('/admin/noticias', [AdminNewsController::class, 'index'], [AuthMiddleware::class]);
$router->get('/admin/noticias/crear', [AdminNewsController::class, 'create'], [AuthMiddleware::class]);
$router->post('/admin/noticias/crear', [AdminNewsController::class, 'create'], [AuthMiddleware::class]);
$router->post('/admin/noticias/categoria/crear', [AdminNewsController::class, 'storeCategory'], [AuthMiddleware::class]);

// --- GESTIÓN DE CATEGORÍAS ---
$router->get('/admin/categorias', [AdminCategoryController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/categorias/guardar', [AdminCategoryController::class, 'store'], [AuthMiddleware::class]);
$router->post('/admin/categorias/eliminar', [AdminCategoryController::class, 'delete'], [AuthMiddleware::class]);

// --- RUTAS PÚBLICAS (EL PORTAL) ---
$router->get('/', [CmsController::class, 'index']);
