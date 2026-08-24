<?php
// Bootstrap the application
require __DIR__ . '/bootstrap/config.php';
require __DIR__ . '/bootstrap/session.php';
use Config\MailConfig;
use App\Http\Controllers\ContactController;
// Initialize mail configuration
MailConfig::init();
// Handle contact form submission
$controller = new ContactController();
$controller->handle();
