<?php

require_once "ExpressionTree.php";

$x = 10;
$y = 3;
$z = 2;
$et = new ExpressionTree("($x + 42)^2+7*$y-$z");
echo $et->calc() . PHP_EOL;

$et = new ExpressionTree("($x + 42)^2+7*($y-$z)");
echo $et->calc() . PHP_EOL;

$et = new ExpressionTree("42+7-$z");
echo $et->calc() . PHP_EOL;

$et = new ExpressionTree("(2+$x)-(2-$z+($y+2))");
echo $et->calc() . PHP_EOL;

$et = new ExpressionTree("2 + 8 - (2 - 5 + (8 * 5) / 3)");
echo $et->calc() . PHP_EOL;