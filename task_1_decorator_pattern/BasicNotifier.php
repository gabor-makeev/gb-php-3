<?php

require_once 'Notifier.php';

class BasicNotifier implements Notifier
{
  public function send(string $message): void
  {
    echo "Basic Notifier actions with the '$message' message were performed" . PHP_EOL;
  }
}