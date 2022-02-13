<?php

$array = [1, 2, 3, 4, 5, 6, 7, 8, 8, 9, 10]; // массив для тестирования функции removeItemsWithVal

function removeItemsWithVal(&$array, $value)
{
    $modifiedArray = [];
    foreach ($array as $item) {
        if ($item != $value)
            $modifiedArray[] = $item;
    }
    $array = $modifiedArray;
}

echo "Removing elements based on value:" . PHP_EOL;
echo implode(", ", $array) . PHP_EOL;
removeItemsWithVal($array, 8);
echo implode(", ", $array) . PHP_EOL;