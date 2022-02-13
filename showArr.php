<?php

function showArr($array)
{
    echo PHP_EOL . "[";
    foreach ($array as $idx => $item) {
        echo " $idx = $item ";
    }
    echo "]" . PHP_EOL . PHP_EOL;
}