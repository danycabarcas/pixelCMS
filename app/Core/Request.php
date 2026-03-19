<?php

namespace App\Core;

class Request
{
    public function method(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method'])) {
            return strtoupper($_POST['_method']);
        }
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    public function uri(): string
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $basePath = parse_url($_ENV['APP_URL'] ?? '', PHP_URL_PATH) ?? '';
        if ($basePath && strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }
        return '/' . ltrim($uri, '/') ?: '/';
    }

    public function all(): array
    {
        return array_merge($_GET, $_POST);
    }
}
