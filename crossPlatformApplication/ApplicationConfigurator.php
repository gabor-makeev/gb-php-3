<?php

require_once 'Application.php';
require_once 'WinFactory.php';
require_once 'MacFactory.php';

class ApplicationConfigurator
{
  public function main() {
    $config = explode(' ', php_uname())[0];

    if ($config === "Windows") {
      $factory = new WinFactory();
    } else if ($config === "Darwin") {
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