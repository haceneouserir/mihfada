<?php

declare(strict_types=1); // Declare strict typing for the class.

namespace App\Traits;

/**
 * Trait for sanitizing input values.
 */

trait Sanitizer
{
  protected function sanitize(string $value): string
  {
    return htmlspecialchars(
      $value,
      flags: ENT_QUOTES,
      encoding: 'UTF-8'
    );
  }
}
