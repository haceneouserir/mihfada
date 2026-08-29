<?php

declare(strict_types=1); // Declare strict typing for the class.

namespace App\Mail\Contracts;

/**
 * Interface for mailer classes.
 */

interface MailerInterface
{
    public function send(array $data): bool;
}
