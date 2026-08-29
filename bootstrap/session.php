<?php

/**
 * Session initialization file.
 *
 * This file is responsible for starting the session and generating a CSRF token if it doesn't exist.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}
