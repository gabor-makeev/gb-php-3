<?php

require_once "functions.php"; // из данного файла берутся такие функции как arrInit, swapElements, showArr

// В следующих файлах реализованы алгоритмы сортировки:
require_once "bubbleSort.php";
require_once "shakerSort.php";
require_once "quickSort.php";
require_once "heapSort.php";

$arrSize = 10000;

/**
 * Массивы создавал на 10000 элементов так как 1000000 занимал много времени,
 * а результаты были достаточно наглядные
 */

$originalArray = [];
$sortingTimeResults = [];
$sortingMethods = ["bubble", "shaker", "quick", "heap"];

arrInit($originalArray, $arrSize);

foreach ($sortingMethods as $sortingMethod) {
    $array = $originalArray;

//    echo "The array before $sortingMethod sorting:";
//    showArr($array); - Вывод массива до сортировки (использовал для проверки работы алгоритма)

    $sortingTimeResults[$sortingMethod]['time_before'] = microtime(true);

    switch ($sortingMethod) {
        case "bubble":
            bubbleSort($array);
            break;
        case "shaker":
            shakerSort($array);
            break;
        case "quick":
            quickSort($array, 0, count($array) - 1);
            break;
        case "heap":
            heapSort($array);
            break;
    }

    $sortingTimeResults[$sortingMethod]['time_after'] = microtime(true);
    $sortingTimeResults[$sortingMethod]['difference'] = $sortingTimeResults[$sortingMethod]['time_after'] - $sortingTimeResults[$sortingMethod]['time_before'];

//    echo "The array after $sortingMethod sorting:";
//    showArr($array); - вывод массива после сортировки (использовал для проверки работы алгоритма)
}

var_dump($sortingTimeResults);

/*
Мои результаты (заметил что в большинстве случаев алгоритм "Быстрой сортировки" побеждает):

array(4) {
  ["bubble"]=>
  array(3) {
    ["time_before"]=>
    float(1644793658.877299)
    ["time_after"]=>
    float(1644793662.396669)
    ["difference"]=>
    float(3.5193698406219482)
  }
  ["shaker"]=>
  array(3) {
    ["time_before"]=>
    float(1644793662.396679)
    ["time_after"]=>
    float(1644793665.725154)
    ["difference"]=>
    float(3.328474998474121)
  }
  ["quick"]=>
  array(3) {
    ["time_before"]=>
    float(1644793665.725197)
    ["time_after"]=>
    float(1644793665.73508)
    ["difference"]=>
    float(0.009882926940917969)
  }
  ["heap"]=>
  array(3) {
    ["time_before"]=>
    float(1644793665.735095)
    ["time_after"]=>
    float(1644793665.766053)
    ["difference"]=>
    float(0.030957937240600586)
  }
}

*/