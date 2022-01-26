<?php

require_once 'GUIFactory.php';
require_once 'WinButton.php';
require_once 'WinCheckbox.php';

class WinFactory implements GUIFactory
{

  public function createButton(): Button
  {
    return new WinButton();
  }

  public function createCheckbox(): Checkbox
  {
    return new WinCheckbox();
  }
}