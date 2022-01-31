<?php

require_once 'ExternalLib.php';
require_once 'Circle/CircleAdapter.php';
require_once 'Square/SquareAdapter.php';

class Application
{
  public function getCircleArea($circumference): float|int
  {
    $circleAreaLib = new CircleAreaLib();
    $circleAdapter = new CircleAdapter($circleAreaLib);

    return $circleAdapter->circleArea($circumference);
  }

  public function getSquareArea($sideSquare): float|int
  {
    $squareAreaLib = new SquareAreaLib();
    $squareAdapter = new SquareAdapter($squareAreaLib);

    return $squareAdapter->squareArea($sideSquare);
  }
}

$application = new Application();

// Данные для тестирования работы программы
$circleCircumference = 10.1;
$squareSideSquare = 25.14;

echo "Circle area: " . $application->getCircleArea($circleCircumference) . PHP_EOL;
echo "Square area: " . $application->getSquareArea($squareSideSquare) . PHP_EOL;