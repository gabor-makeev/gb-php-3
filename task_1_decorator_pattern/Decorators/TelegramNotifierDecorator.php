<?php

require_once 'NotifierDecorator.php';

class TelegramNotifierDecorator extends NotifierDecorator
{
  public function send(string $message): void
  {
    echo "Telegram message '$message' sent" . PHP_EOL;
    parent::send($message);
  }
}