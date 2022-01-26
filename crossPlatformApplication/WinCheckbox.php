<?php

require_once 'Checkbox.php';

class WinCheckbox implements Checkbox
{
  public function paint(): string
  {
    return "rendered a win checkbox";
  }
}