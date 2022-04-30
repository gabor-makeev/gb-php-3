<?php

class ExpressionTreeOperand
{
    public int|float $value;

    public function __construct(int|float $value)
    {
        $this->value = $value;
    }
}