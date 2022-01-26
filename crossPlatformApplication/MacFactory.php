<?php

require_once 'GUIFactory.php';
require_once 'MacButton.php';
require_once 'MacCheckbox.php';

class MacFactory implements GUIFactory
{

  public function createButton(): Button
  {
    return new MacButton();
  }

  public function createCheckbox(): Checkbox
  {
    return new MacCheckbox();
  }
}