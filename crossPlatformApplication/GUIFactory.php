<?php

// abstract GUIFactory interface

interface GUIFactory
{
  public function createButton(): Button;

  public function createCheckbox(): Checkbox;
}