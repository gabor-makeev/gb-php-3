<?php

require_once 'ICircle.php';

class CircleAdapter implements ICircle
{
  private CircleAreaLib $circleAreaLib;

  public function __construct($circleAreaLib)
  {
    $this->circleAreaLib = $circleAreaLib;
  }

  public function circleArea(/*int*/ $circumference): float|int
  {
    /*
      Адаптирую метод circleArea($circumference) для работы с методом getCircleArea($diagonal) из класса
      CircleAreaLib внешней библиотеки.
    */

    // Нахожу значение диагонали круга из имеющихся данных ($circumference)
    $diagonal = $circumference / M_PI;

    /*
      Делегирую расчет значения площади круга методу getCircleArea($diagonal)
      из класса CircleAreaLib внешней библиотеки
    */
    return $this->circleAreaLib->getCircleArea($diagonal);
  }
}