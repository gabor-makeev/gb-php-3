<?php

function getMultipliers($num)
{
  global $result;
  $result = [];
  $currentNumber = $num;
  $probe = 2;

  while ($currentNumber != 1) {
    global $result;
    if ($currentNumber % $probe !== 0) {
      $probe++;
    } else {
      $currentNumber /= $probe;
      $result[] = $probe;
    }
  }
  return max($result);
}

echo getMultipliers(600851475143);