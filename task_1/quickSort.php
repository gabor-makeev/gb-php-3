<?php

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