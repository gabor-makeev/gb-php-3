<?php

class Application
{
  private GUIFactory $factory;
  private Button $button;

  public function __construct(GUIFactory $factory)
  {
    $this->factory = $factory;
  }

  public function createUI()
  {
    $this->button = $this->factory->createButton();
  }

  public function paint(): string
  {
    return $this->button->paint();
  }
}