<?php

require_once 'Button.php';

class MacButton implements Button
{
  public function paint(): string
  {
    return "rendered a mac button";
  }
}