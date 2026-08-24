<?php

declare(strict_types=1); // Declare strict typing for the class.

namespace Config;

final class MailConfig
{
  public static int $SMTP_DEBUG;
  public static string $SMTP_HOST;
  public static string $SMTP_USERNAME;
  public static string $SMTP_PASSWORD;
  public static int $SMTP_PORT;
  public static string $MAIL_FROM;
  public static string $MAIL_FROM_NAME;
  public static string $MAIL_ADDRESS;
  public static string $TURNSTILE_SECRET_KEY;

  public static function init(): void
  {
    self::$SMTP_DEBUG = (int)self::env('SMTP_DEBUG', 0);
    self::$SMTP_HOST = self::env('SMTP_HOST');
    self::$SMTP_USERNAME = self::env('SMTP_USERNAME');
    self::$SMTP_PASSWORD = self::env('SMTP_PASSWORD');
    self::$SMTP_PORT = (int)self::env('SMTP_PORT', 587);
    self::$MAIL_FROM = self::env('MAIL_FROM');
    self::$MAIL_FROM_NAME = self::env('MAIL_FROM_NAME');
    self::$MAIL_ADDRESS = self::env('MAIL_ADDRESS');
    self::$TURNSTILE_SECRET_KEY = self::env('TURNSTILE_SECRET_KEY');
  }

  private static function env(string $key, string|int|null $default = null): string
  {
    $value = $_ENV[$key] ?? $_SERVER[$key] ?? $default ?? null;
    if ($value === null || $value === '') {
      throw new \RuntimeException("Missing required environment variable: {$key}");
    }
    return $value;
  }
}
