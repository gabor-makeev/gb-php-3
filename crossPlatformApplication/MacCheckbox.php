<?php

require_once 'Checkbox.php';

class MacCheckbox implements Checkbox
{
  public function paint(): string
  {
    return "rendered a mac checkbox";
  }
}