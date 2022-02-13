<?php

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