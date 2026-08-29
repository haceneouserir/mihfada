<?php

declare(strict_types=1); // Declare strict typing for the class.

namespace Config;

/**
 * Configuration class for email settings.
 */

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
    self::$SMTP_DEBUG = (int)env('SMTP_DEBUG', 0);
    self::$SMTP_HOST = env('SMTP_HOST');
    self::$SMTP_USERNAME = env('SMTP_USERNAME');
    self::$SMTP_PASSWORD = env('SMTP_PASSWORD');
    self::$SMTP_PORT = (int)env('SMTP_PORT', 587);
    self::$MAIL_FROM = env('MAIL_FROM');
    self::$MAIL_FROM_NAME = env('MAIL_FROM_NAME');
    self::$MAIL_ADDRESS = env('MAIL_ADDRESS');
    self::$TURNSTILE_SECRET_KEY = env('TURNSTILE_SECRET_KEY');
  }
}
