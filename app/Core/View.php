<?php

namespace App\Core;

class View
{
    public static function render(string $view, array $data = [], string $layout = 'app'): void
    {
        extract($data);

        $viewPath   = BASE_PATH . '/resources/views/' . str_replace('.', '/', $view) . '.php';
        $layoutPath = BASE_PATH . '/resources/views/layouts/' . $layout . '.php';

        if (!file_exists($viewPath)) {
            throw new \RuntimeException("Vista no encontrada: {$viewPath}");
        }

        ob_start();
        require $viewPath;
        $content = ob_get_clean();

        if ($layout && file_exists($layoutPath)) {
            ob_start();
            require $layoutPath;
            $layoutContent = ob_get_clean();
            echo str_replace('{{content}}', $content, $layoutContent);
        } else {
            echo $content;
        }
    }
}
