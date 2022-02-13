<?php

function arrInit(&$array, $arrSize): void
{
    $array = [];

    for ($i = 0; $i < $arrSize; $i++) {
        $array[] = rand(1, 100);
    }
}

function swapElements(&$array, $firstElement, $secondElement)
{
    list($array[$firstElement], $array[$secondElement]) = array($array[$secondElement], $array[$firstElement]);
}

function showArr($array)
{
    echo PHP_EOL . "[";
    foreach ($array as $idx => $item) {
        echo " $idx = $item ";
    }
    echo "]" . PHP_EOL . PHP_EOL;
}