<?php

if (!function_exists('base_url')) {
    function base_url(string $path = ''): string
    {
        $base = rtrim($_ENV['APP_URL'] ?? '', '/');
        return $base . '/' . ltrim($path, '/');
    }
}

if (!function_exists('asset')) {
    function asset(string $path): string
    {
        return base_url('assets/' . ltrim($path, '/'));
    }
}

if (!function_exists('view')) {
    function view(string $view, array $data = [], string $layout = 'app'): void
    {
        \App\Core\View::render($view, $data, $layout);
    }
}
