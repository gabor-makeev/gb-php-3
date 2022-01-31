<?php

require_once 'BasicNotifier.php';
require_once 'Decorators/EmailNotifierDecorator.php';
require_once 'Decorators/TelegramNotifierDecorator.php';
require_once 'Decorators/WhatsAppNotifierDecorator.php';

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

clientCode($user, $message);