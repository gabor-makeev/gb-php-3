<?php

require_once "showArr.php";
require_once "arrInit.php";
require_once "swapElements.php";
require_once "randomizeArr.php";

$arr = [];
arrInit($arr);

function bubbleSort($array): void
{
    $count = sizeof($array) - 1;

    showArr($array);

    for ($i = 0; $i < $count; $i++) {
        for ($j = 0; $j < $count; $j++) {
            if ($array[$j] > $array[$j + 1]) {
                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temp;
            }
        }
    }
    showArr($array);
}

echo "Bubble Sorting:" . PHP_EOL;
bubbleSort($arr);

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

echo "Shaker Sorting:" . PHP_EOL;
shakerSort($arr);

function quickSort(&$array, $low, $high)
{
    $i = $low;
    $j = $high;
    $pivot = $array[($low + $high) / 2];

    do {
        while ($array[$i] < $pivot) ++$i;
        while ($array[$j] > $pivot) --$j;

        if ($i <= $j) {
            swapElements($array, $i, $j);
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

echo "Quick Sorting:" . PHP_EOL;
showArr($arr);
quickSort($arr, 0, count($arr) - 1);
showArr($arr);

echo "New randomized array: " . PHP_EOL;
randomizeArr($arr);
showArr($arr);

