<?php

class CircleAreaLib
{
  public function getCircleArea(/*int*/ $diagonal): float|int
  {
    $area = (M_PI * $diagonal ** 2) / 4;

    return $area;
  }
}

class SquareAreaLib
{
  public function getSquareArea(/*int*/ $diagonal): float|int
  {
    $area = ($diagonal ** 2) / 2;

    return $area;
  }
}