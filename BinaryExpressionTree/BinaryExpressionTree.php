<?php

class BinaryExpressionTreeNode
{
    private $value;
    private $left = null;
    private $right = null;

    public function __construct($value)
    {
        $this->value = $value;
    }


}

class BinaryExpressionTree
{
    private string $expression;
    private $root;

    public function __construct($expression)
    {
        $this->expression = $expression;
    }

    public function buildTree()
    {

    }

}