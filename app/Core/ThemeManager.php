<?php

namespace App\Core;

class ThemeManager
{
    private static array $config = [];

    public static function load(array $config): void
    {
        self::$config = $config;
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return self::$config[$key] ?? $default;
    }

    public static function getLogoUrl(): string
    {
        return self::get('logo_url', asset('img/logo-web.png'));
    }

    public static function getGovLogoUrl(): string
    {
        return self::get('gov_logo_url', asset('img/logo-gov.co.png'));
    }

    public static function getPrimaryColor(): string
    {
        return self::get('primary_color', '#3366CC');
    }
}
