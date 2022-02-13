<?php

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