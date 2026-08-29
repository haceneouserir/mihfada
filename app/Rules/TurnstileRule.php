<?php

declare(strict_types=1); // Declare strict typing for the class.

namespace App\Rules;

/**
 * Rule class for verifying Cloudflare Turnstile responses.
 */

final readonly class TurnstileRule
{
  public function __construct(private string $secretKey) {}
  public function verify(?string $response, ?string $ip): bool
  {
    if ($response === '') {
      return false;
    }
    // Initialize a cURL session to verify the Turnstile response with Cloudflare's API.
    $ch = curl_init('https://challenges.cloudflare.com/turnstile/v0/siteverify');

    // Set cURL options for the POST request to the Turnstile verification endpoint.
    curl_setopt_array($ch, [
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => http_build_query([
        'secret' => $this->secretKey,
        'response' => $response,
        'remoteip' => $ip,
      ]),
      CURLOPT_RETURNTRANSFER => true, // Return the response as a string instead of outputting it directly.
      CURLOPT_TIMEOUT => 10, // Set a timeout for the request to avoid hanging indefinitely.
      CURLOPT_CONNECTTIMEOUT => 5, // Set a connection timeout to avoid hanging on slow connections.
    ]);

    $result = curl_exec($ch);

    if ($result === false) {
      unset($ch); // Clean up the cURL handle to free resources.
      return false;
    }

    $status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    unset($ch);

    if ($status !== 200) {
      return false;
    }

    try {
      $json = json_decode($result, true, flags: JSON_THROW_ON_ERROR);
    } catch (\JsonException $e) {
      return false;
    }

    return ($json['success'] ?? false) === true; // Return true if the verification was successful, false otherwise.
  }
}
