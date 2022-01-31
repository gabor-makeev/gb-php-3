<?php

require_once __DIR__ . '/../Notifier.php';

class NotifierDecorator implements Notifier
{
  protected Notifier $notifier;

  public function __construct(Notifier $notifier)
  {
    $this->notifier = $notifier;
  }

  public function send(string $message): void
  {
    $this->notifier->send($message);
  }
}