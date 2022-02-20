<?php

require_once "ExpressionTree.php";
require_once "ExpressionTreeOperand.php";

class ExpressionTreeOperation
{
    public string $name;
    public ExpressionTreeOperand|ExpressionTreeOperation|null $left = null;
    public ExpressionTreeOperand|ExpressionTreeOperation|null $right = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function calc(): int
    {
        $leftChild = $this->left;
        $rightChild = $this->right;

        if ($this->isOperation($leftChild)) {
            $leftChild = new ExpressionTreeOperand($leftChild->calc());
        }

        if ($this->isOperation($rightChild)) {
            $rightChild = new ExpressionTreeOperand($rightChild->calc());
        }

        return match ($this->name) {
            "+" => $leftChild->value + $rightChild->value,
            "-" => $leftChild->value - $rightChild->value,
            "*" => $leftChild->value * $rightChild->value,
            "/" => $leftChild->value / $rightChild->value,
            "^" => pow($leftChild->value, $rightChild->value),
            default => false
        };
    }

    public function isOperation($object): bool
    {
        return get_class($object) === "ExpressionTreeOperation";
    }
}