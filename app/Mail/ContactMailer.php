<?php

declare(strict_types=1); // Declare strict typing for the class.

namespace App\Mail;

use App\Mail\Abstracts\AbstractMailer;
use Config\MailConfig;

final class ContactMailer extends AbstractMailer
{
  #[\Override] // This attribute indicates that the method overrides a method in the parent class.
  public function send(array $data): bool
  {
    $this->mail->addAddress(MailConfig::$MAIL_ADDRESS);
    $this->mail->addReplyTo($data['email'], $data['name']);
    $this->mail->Subject = $data['subject'];
    $this->mail->Body = $data['message'];
    return $this->mail->send();
  }
}
