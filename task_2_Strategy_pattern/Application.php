<?php

require_once 'Checkout.php';
require_once 'CheckoutStrategies/QiwiCheckoutStrategy.php';
require_once 'CheckoutStrategies/YandexCheckoutStrategy.php';
require_once 'CheckoutStrategies/WebMoney.php';

$user = [
  'phone' => '+123 456 789',
  'paymentMethod' => 'Yandex',
  'cartTotalSum' => 10000
];

function clientCode(array $user)
{
  switch ($user['paymentMethod']) {
    case 'Qiwi':
      $preferredCheckoutStrategy = new QiwiCheckoutStrategy();
      break;
    case 'Yandex':
      $preferredCheckoutStrategy = new YandexCheckoutStrategy();
      break;
    case 'WebMoney':
      $preferredCheckoutStrategy = new WebMoneyCheckoutStrategy();
  }

  $checkout = new Checkout($preferredCheckoutStrategy);
  $checkout->makePayment($user['cartTotalSum'], $user['phone']);
}

clientCode($user);