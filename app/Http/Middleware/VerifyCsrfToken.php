<?php

declare(strict_types=1); // Declare strict typing for the class.

namespace App\Http\Middleware;

/**
 * Middleware class for verifying CSRF tokens.
 */

final class VerifyCsrfToken
{
    public function validate(?string $formToken, ?string $sessionToken): bool
    {
        if ($formToken === '' || $sessionToken === '') {
            return false;
        }

        return hash_equals($sessionToken, $formToken);
    }
}
