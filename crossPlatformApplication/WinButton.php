<?php

require_once 'Button.php';

class WinButton implements Button
{
  public function paint(): string
  {
    return "rendered a win button";
  }
}