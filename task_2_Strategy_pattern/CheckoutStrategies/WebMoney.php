<?php

require_once 'CheckoutStrategy.php';

class WebMoneyCheckoutStrategy implements CheckoutStrategy
{
  public function makePayment($totalSum, $phoneNumber)
  {
    $commissionFee = $totalSum * 0.01;
    echo "Общая сумма: " . $totalSum . " + 1% комиссии ($commissionFee)" . PHP_EOL;
    echo "Номер телефона покупателя: " . $phoneNumber . PHP_EOL;
    echo "Оплата была успешно проведена с помощью сервиса WebMoney";
  }
}