<?php

/**
 * Bootstrap configuration file for the application.
 *
 * This file is responsible for loading environment variables and setting up the application configuration.
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}
require_once __DIR__ . '/../app/Helpers/env.php';
