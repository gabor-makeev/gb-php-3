<?php

interface GUIFactory
{
  public function createButton(): Button;

  public function createCheckbox(): Checkbox;
}

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

interface Button
{
  public function paint(): string;
}

class WinButton implements Button
{
  public function paint(): string
  {
    return "rendered a win button";
  }
}

class MacButton implements Button
{
  public function paint(): string
  {
    return "rendered a mac button";
  }
}

interface Checkbox
{
  public function paint(): string;
}

class WinCheckbox implements Checkbox
{
  public function paint(): string
  {
    return "rendered a win checkbox";
  }
}

class MacCheckbox implements Checkbox
{
  public function paint(): string
  {
    return "rendered a mac checkbox";
  }
}

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

class ApplicationConfigurator
{
  public function main() {
    $config = explode(' ', php_uname())[0];

    if ($config === "Windows") {
      $factory = new WinFactory();
    } else if ($config === "Mac") {
      $factory = new MacFactory();
    } else {
      throw new Exception('Unknown operating system was identified');
    }

    $application = new Application($factory);
    $application->createUI();
    echo $application->paint();
  }
}

$applicationConfigurator = new ApplicationConfigurator();
$applicationConfigurator->main();