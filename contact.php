<?php

/**
 * Contact form entry point.
 *
 * This file is responsible for handling contact form submissions.
 */
require __DIR__ . '/bootstrap/config.php';
require __DIR__ . '/bootstrap/session.php';

use Config\MailConfig;
use App\Http\Controllers\ContactController;

MailConfig::init();
$controller = new ContactController();
$controller->handle();
