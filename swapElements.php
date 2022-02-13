<?php

function swapElements(&$array, $firstElement, $secondElement)
{
    list($array[$firstElement], $array[$secondElement]) = array($array[$secondElement], $array[$firstElement]);
}