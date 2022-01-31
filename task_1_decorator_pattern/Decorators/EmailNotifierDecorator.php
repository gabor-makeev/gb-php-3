<?php

require_once 'NotifierDecorator.php';

class EmailNotifierDecorator extends NotifierDecorator
{
  public function send(string $message): void
  {
    echo "Email message '$message' sent" . PHP_EOL;
    parent::send($message);
  }
}