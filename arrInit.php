<?php

$arrSize = 10;

function arrInit(&$array): void
{
    global $arrSize;

    for ($i = 0; $i < $arrSize; $i++) {
        $array[] = rand(1, 100);
    }
}