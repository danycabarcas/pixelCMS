<?php

namespace App\Middleware;

use App\Core\Request;
use App\Core\Session;

class AuthMiddleware
{
    public function handle(Request $request): void
    {
        if (!Session::has('user')) {
            // Para el panel maestro, si no hay sesión, podrías redirigir a login
            // Por ahora, solo es un placeholder para evitar errores
        }
    }
}
