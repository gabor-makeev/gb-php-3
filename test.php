<?php

$exp_arr = ["(", "2", "+", "2", ")", "-", "(", "2", "-", "3", "+", "(", "2", "+", "2", ")", ")"];

$only_opening_parentheses = array_filter( $exp_arr, function ($item) {
    return $item === "(";
});

array_splice($exp_arr, -1, 10);
var_dump($exp_arr);
var_dump($only_opening_parentheses);