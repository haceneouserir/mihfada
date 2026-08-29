<?php

declare(strict_types=1);

if (!function_exists('env')) {
    // Retrieves the value of an environment variable.
    function env(string $key, mixed $default = null): mixed
    {
        $value = $_ENV[$key] ?? $_SERVER[$key] ?? $default ?? null;
        if ($value === null || $value === '') {
            throw new \RuntimeException("Missing required environment variable: {$key}");
        }
        return $value;
    }
}
