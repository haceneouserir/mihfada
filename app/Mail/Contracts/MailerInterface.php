<?php

declare(strict_types=1); // Declare strict typing for the class.

namespace App\Mail\Contracts;

interface MailerInterface
{
    public function send(array $data): bool;
}