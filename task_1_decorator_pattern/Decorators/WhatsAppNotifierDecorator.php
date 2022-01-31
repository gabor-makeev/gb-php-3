<?php

require_once 'NotifierDecorator.php';

class WhatsAppNotifierDecorator extends NotifierDecorator
{
  public function send(string $message): void
  {
    echo "WhatsApp message '$message' sent" . PHP_EOL;
    parent::send($message);
  }
}