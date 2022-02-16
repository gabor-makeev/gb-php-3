<!-- Здесь будет находится домашнее задание на других ветках -->

<?php

function recur($num)
{
  if ($num === 0) {
    return "finish";
  } else {
    echo $num-- . PHP_EOL;
    recur($num);
  }
}

recur(10);