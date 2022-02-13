<?php

function randomizeArr(&$array)
{
    foreach ($array as &$item) {
        $item = rand(1, 100);
    }
}