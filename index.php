<?php

$arrSize = 5;
$arr = [];

for ($i = 0; $i < $arrSize; $i++) {
  $arr[] = rand(1, 100);
}

function showArr($array)
{
  echo PHP_EOL . "[";
  foreach ($array as $idx => $item) {
    echo " $idx = $item ";
  }
  echo "]" . PHP_EOL . PHP_EOL;
}

function bubbleSort($array): array
{
  $count = sizeof($array) - 1;

  for ($i = 0; $i < $count; $i++) {
    for ($j = 0; $j < $count; $j++) {
      if ($array[$j] > $array[$j + 1]) {
        $temp = $array[$j];
        $array[$j] = $array[$j + 1];
        $array[$j + 1] = $temp;
      }
    }
  }
  return $array;
}

//echo "Bubble sort example" . PHP_EOL;
//echo "Array before: " . implode(', ', $arr) . PHP_EOL;
//showArr($arr);
//$arr = bubbleSort($arr);
//showArr($arr);

//echo "Array after: " . implode(', ', $arr);

function shakerSort($array)
{
  $count = count($array);
  $left = 0;
  $right = $count - 1;

  showArr($array);

  do {
    for ($i = $left; $i < $right; $i++) {
      if ($array[$i] > $array[$i + 1]) {
        list($array[$i], $array[$i + 1]) = array($array[$i + 1], $array[$i]);
      }
    }
    $right -= 1;
    for ($i = $right; $i > $left; $i--) {
      if ($array[$i] < $array[$i - 1]) {
        list($array[$i], $array[$i - 1]) = array($array[$i - 1], $array[$i]);
      }
    }
    $left += 1;
  } while ($left <= $right);

  showArr($array);

}

//shakerSort($arr);

function quickSort($array, $low, $high)
{

  $i = $low;
  $j = $high;
  $pivot = $array[rand(0, count($array) - 1)];

  do {
    while ($array[$i] < $pivot) ++$i;
    while ($array[$j] > $pivot) --$j;

    if ($i <= $j) {
      $temp = $array[$i];
      $array[$i] = $array[$j];
      $array[$j] = $temp;

      $i++;
      $j--;
    }
  } while ($i < $j);

  if ($low < $j) {
    quickSort($array, $low, $j);
  }

  if ($i < $high) {
    quickSort($array, $i, $high);
  }

}

quickSort($arr, 0, count($arr) - 1);