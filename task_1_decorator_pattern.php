<?php

interface Notifier
{
  public function send(String $message): void;
}

class BasicNotifier implements Notifier
{
  public function send(string $message): void
  {
    echo "Basic Notifier actions with the '$message' message were performed" . PHP_EOL;
  }
}

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

class EmailNotifierDecorator extends NotifierDecorator
{
  public function send(string $message): void
  {
    echo "Email message '$message' sent" . PHP_EOL;
    parent::send($message);
  }
}

class TelegramNotifierDecorator extends NotifierDecorator
{
  public function send(string $message): void
  {
    echo "Telegram message '$message' sent" . PHP_EOL;
    parent::send($message);
  }
}

class WhatsAppNotifierDecorator extends NotifierDecorator
{
  public function send(string $message): void
  {
    echo "WhatsApp message '$message' sent" . PHP_EOL;
    parent::send($message);
  }
}

// $user - ассоциативный массив хранящий настройки уведомлений пользователя
$user = [
  'NotificationConfigurations' => [
    'email' => true,
    'telegram' => true,
    'whatsApp' => true
  ]
];
// $message - сообщение, которое должно быть отправлено пользователю
$message = "Some message!";

function clientCode($user, $message)
{
  $notifier = new BasicNotifier();
  if ($user['NotificationConfigurations']['email']) {
    $notifier = new EmailNotifierDecorator($notifier);
  }
  if ($user['NotificationConfigurations']['telegram']) {
    $notifier = new TelegramNotifierDecorator($notifier);
  }
  if ($user['NotificationConfigurations']['whatsApp']) {
    $notifier = new WhatsAppNotifierDecorator($notifier);
  }

  $notifier->send($message);
}

clientCode($user, $message);