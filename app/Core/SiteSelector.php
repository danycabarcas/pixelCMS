<?php

namespace App\Core;

class SiteSelector
{
    private static $currentCompany = null;

    public static function identify()
    {
        if (self::$currentCompany) return self::$currentCompany;

        $domain = $_SERVER['HTTP_HOST'] ?? '';
        $db = Database::getInstance();

        // Buscamos la empresa por el dominio autorizado
        $empresa = $db->query("
            SELECT e.*, l.modulos_json, l.status as licencia_status 
            FROM empresas e 
            LEFT JOIN licencias l ON l.empresa_id = e.id 
            WHERE e.dominio_autorizado = :dom
            LIMIT 1
        ", ['dom' => $domain])[0] ?? null;

        if ($empresa) {
            $empresa['modulos'] = json_decode($empresa['modulos_json'] ?? '[]', true);
            self::$currentCompany = $empresa;
        }

        return self::$currentCompany;
    }

    public static function isSaaSContext()
    {
        return self::identify() !== null;
    }
}
