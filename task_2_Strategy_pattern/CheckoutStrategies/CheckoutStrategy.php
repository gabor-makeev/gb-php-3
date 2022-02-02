<?php

interface CheckoutStrategy
{
  public function makePayment($totalSum, $phoneNumber);
}