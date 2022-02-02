<?php

class Checkout
{
  private CheckoutStrategy $checkoutStrategy;

  public function __construct(CheckoutStrategy $checkoutStrategy)
  {
    $this->checkoutStrategy = $checkoutStrategy;
  }

  public function setCheckoutStrategy(CheckoutStrategy $checkoutStrategy): void
  {
    $this->checkoutStrategy = $checkoutStrategy;
  }

  public function makePayment($totalSum, $phoneNumber): void
  {
    $this->checkoutStrategy->makePayment($totalSum, $phoneNumber);
  }
}