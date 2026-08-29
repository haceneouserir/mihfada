<?php

declare(strict_types=1); // Declare strict typing for the class.

namespace App\Support;

/**
 * Class for sending JSON responses.
 */

final class JsonResponse
{
  public static function send(array $data, int $status = 200): never
  {
    http_response_code($status);
    header('Content-Type: application/json, charset: UTF-8');
    echo json_encode($data, JSON_THROW_ON_ERROR);
    exit;
  }
}
