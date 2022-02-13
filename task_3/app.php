<?php

$array = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 14, 16, 20]; // массив для тестирования алгоритмов поиска
$searchedValue = 8; // искомое значение

$iterations = 0; // счетчик итераций (шагов)

function linearSearch($array, $num): ?int
{
    global $iterations;

    $count = count($array);

    for ($i = 0; $i < $count; $i++) {
        $iterations = $i;
        if ($array[$i] === $num)
            return $i;
        elseif ($array[$i] > $num)
            return null;
    }

    return null;
}

echo "Linear search result: " . linearSearch($array, $searchedValue) . PHP_EOL;
echo "Number of iterations performed: " . $iterations . PHP_EOL;

function binarySearch($array, $num): ?int
{
    global $iterations;
    $iterations = 0;

    $left = 0;
    $right = count($array) - 1;

    while ($left <= $right) {
        $iterations++;

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

echo "Binary search result: " . binarySearch($array, $searchedValue) . PHP_EOL;
echo "Number of iterations performed: " . $iterations . PHP_EOL;

function interpolationSearch($array, $num): ?int
{
    global $iterations;
    $iterations = 0;

    $start = 0;
    $last = count($array) - 1;

    while (
        ($start <= $last) &&
        ($num >= $array[$start]) &&
        ($num <= $array[$last])
    ) {
        $iterations++;

        $pos = floor($start + (($last - $start) / ($array[$last] - $array[$start])) * ($num - $array[$start]));

        if ($array[$pos] === $num) {
            return $pos;
        }

        if ($array[$pos] < $num) {
            $start = $pos + 1;
        } else {
            $last = $pos - 1;
        }
    }
    return null;
}

echo "Interpolation search result: " . interpolationSearch($array, $searchedValue) . PHP_EOL;
echo "Number of iterations performed: " . $iterations . PHP_EOL;

/*
Мои результаты:

Linear search result: 7
Number of iterations performed: 7

Binary search result: 7
Number of iterations performed: 4

Interpolation search result: 7
Number of iterations performed: 3
*/