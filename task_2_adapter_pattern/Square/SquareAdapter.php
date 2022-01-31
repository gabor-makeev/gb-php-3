<?php

require_once 'ISquare.php';

class SquareAdapter implements ISquare
{
  private SquareAreaLib $squareAreaLib;

  public function __construct($squareAreaLib)
  {
    $this->squareAreaLib = $squareAreaLib;
  }

  public function squareArea(/*int*/ $sideSquare): float|int
  {
    /*
      Адаптирую метод squareArea($sideSquare) для работы с методом getSquareArea($diagonal) из класса
      SquareAreaLib внешней библиотеки
    */

    // Нахожу значение диагонали квадрата из имеющихся данных ($SquareAreaLib)
    $diagonal = $sideSquare * sqrt(2);

    /*
      Делегирую расчет значения площади квадрата методу getSquareArea($diagonal)
      из класса SquareAreaLib внешней библиотеки
    */
    return $this->squareAreaLib->getSquareArea($diagonal);
  }
}