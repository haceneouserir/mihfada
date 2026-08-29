<?php

declare(strict_types=1); // Declare strict typing for the class.

namespace App\Http\Requests;

use App\Traits\Sanitizer;
use ElliotJReed\DisposableEmail\DisposableEmail;

/**
 * Request class for validating contact form input.
 */

final class ContactRequest
{
  use Sanitizer;

  public function validate(array $input): array
  {
    $errors = [];
    // Validate input fields
    $name = $this->sanitize($input['name'] ?? '');
    $email = $this->sanitize($input['email'] ?? '');
    $subject = $this->sanitize($input['subject'] ?? '');
    $message = $this->sanitize($input['message'] ?? '');

    // Name validation
    if ($name === '') {
      $errors['name'] = "The full name field is required!";
    } else if (mb_strlen($name) > 30) {
      $errors['name'] = "The full name is greater than 30 characters!";
    }

    // Email validation
    if ($email === '') {
      $errors['email'] = "The email field is required!";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) || DisposableEmail::isDisposable($email)) {
      $errors['email'] = "Invalid email address!";
    }
    // Subject validation
    if ($subject === '') {
      $errors['subject'] = "The subject field is required!";
    } elseif (mb_strlen($subject) > 50) {
      $errors['subject'] = "The subject is greater than 50 characters!";
    }
    // Message validation
    if ($message === '') {
      $errors['message'] = "The message field is required!";
    } elseif (mb_strlen($message) > 500) {
      $errors['message'] = "The message is greater than 500 characters!";
    }

    return [$errors, compact('name', 'email', 'subject', 'message')];
  }
}
