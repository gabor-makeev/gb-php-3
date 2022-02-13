<?php

// task 1

function showArr($array)
{
    echo PHP_EOL . "[";
    foreach ($array as $idx => $item) {
        echo " $idx = $item ";
    }
    echo "]" . PHP_EOL . PHP_EOL;
}

// array initialization

$arrSize = 10;

function arrInit(&$array): void
{
    global $arrSize;

    for ($i = 0; $i < $arrSize; $i++) {
        $array[] = rand(1, 100);
    }
}

function swapElements(&$array, $firstElement, $secondElement)
{
    list($array[$firstElement], $array[$secondElement]) = array($array[$secondElement], $array[$firstElement]);
}

function randomizeArr(&$array)
{
    foreach ($array as &$item) {
        $item = rand(1, 100);
    }
}

$arr = [];
arrInit($arr);

function bubbleSort(&$array): void
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
}

echo "Bubble Sorting:" . PHP_EOL;
showArr($arr);
bubbleSort($arr);
showArr($arr);

randomizeArr($arr);
echo "Array elements were randomized!" . PHP_EOL;

function shakerSort(&$array)
{
    $count = count($array);
    $left = 0;
    $right = $count - 1;

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
}

echo "Shaker Sorting:" . PHP_EOL;
showArr($arr);
shakerSort($arr);
showArr($arr);

randomizeArr($arr);
echo "Array elements were randomized!" . PHP_EOL;

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

randomizeArr($arr);
echo "Array elements were randomized!" . PHP_EOL;

function heapify(&$array, $countArr, $i)
{
    $largest = $i;
    $left = 2 * $i + 1;
    $right = 2 * $i + 2;

    if ($left < $countArr && $array[$left] > $array[$largest]) {
        $largest = $left;
    }

    if ($right < $countArr && $array[$right] > $array[$largest]) {
        $largest = $right;
    }

    if ($largest != $i) {
        swapElements($array, $i, $largest);
        heapify($array, $countArr, $largest);
    }
}

function heapSort(&$array)
{
    $countArr = count($array);

    for ($i = $countArr / 2 - 1; $i >= 0; $i--)
        heapify($array, $countArr, $i);

    for ($i = $countArr - 1; $i >= 0; $i--) {
        swapElements($array, 0, $i);
        heapify($array, $i, 0);
    }
}

echo "Heap Sorting:" . PHP_EOL;
showArr($arr);
heapSort($arr);
showArr($arr);

// task 2

function removeItemsWithVal(&$array, $value)
{
    $modifiedArray = [];
    foreach ($array as $item) {
        if ($item != $value)
            $modifiedArray[] = $item;
    }
    $array = $modifiedArray;
}

echo "Removing elements based on value:";
$someArr = [ 1, 2, 3, 4, 5, 6, 7, 8, 8, 9, 10];
showArr($someArr);
removeItemsWithVal($someArr, 8);
showArr($someArr);

// task 3

function linearSearch($array, $num): ?int
{
    $count = count($array);

    for ($i = 0; $i < $count; $i++) {
        if ($array[$i] === $num)
            return $i;
        elseif ($array[$i] > $num)
            return null;
    }

    return null;
}

echo "Linear search result: " . linearSearch($someArr, 5) . PHP_EOL;

function binarySearch($array, $num): ?int
{
    $left = 0;
    $right = count($array) - 1;

    while ($left <= $right) {
        $middle = floor(($left + $right) / 2);

        if ($num === $array[$middle]) {
            return $middle;
        } elseif ($array[$middle] < $num) {
            $left = $middle + 1;
        } elseif ($array[$middle] > $num) {
            $right = $middle - 1;
        }
    }
    return null;
}

echo "Binary search result: " . binarySearch($someArr, 5) . PHP_EOL;

function interpolationSearch($array, $num): ?int
{
    $start = 0;
    $last = count($array) - 1;

    while (
        ($start <= $last) &&
        ($num >= $array[$start]) &&
        ($num <= $array[$last])
    ) {
        $pos = floor($start + (($last - $start) / ($array[$last] - $array[$start])) * ($num - $array[$start]));

        if ($array[$pos] === $num) {
            return $pos;
        }

        if ($array[$pos] < $num) {
            $start = $pos + 1;
        }

        else {
            $last = $pos - 1;
        }
    }
    return null;
}

echo "Interpolation search result: " . interpolationSearch($someArr, 5) . PHP_EOL;