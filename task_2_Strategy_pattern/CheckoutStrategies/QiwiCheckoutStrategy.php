<?php

require_once 'CheckoutStrategy.php';

class QiwiCheckoutStrategy implements CheckoutStrategy
{
  public function makePayment($totalSum, $phoneNumber)
  {
    $commissionFee = $totalSum * 0.03;
    echo "Общая сумма: " . $totalSum . " + 3% комиссии ($commissionFee)" . PHP_EOL;
    echo "Номер телефона покупателя: " . $phoneNumber . PHP_EOL;
    echo "Оплата была успешно проведена с помощью сервиса Qiwi";
  }
}