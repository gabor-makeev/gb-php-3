<?php

require_once 'CheckoutStrategy.php';

class YandexCheckoutStrategy implements CheckoutStrategy
{
  public function makePayment($totalSum, $phoneNumber)
  {
    $commissionFee = $totalSum * 0.02;
    echo "Общая сумма: " . $totalSum . " + 2% комиссии ($commissionFee)" . PHP_EOL;
    echo "Номер телефона покупателя: " . $phoneNumber . PHP_EOL;
    echo "Оплата была успешно проведена с помощью сервиса Yandex";
  }
}