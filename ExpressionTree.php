<?php

require_once "ExpressionParser.php";
require_once "ExpressionTreeOperand.php";
require_once "ExpressionTreeOperation.php";

class ExpressionTree
{
    private array $expression;
    private ?ExpressionTreeOperation $root = null;
    private ExpressionParser $parser;

    public function __construct($expression)
    {
        $this->parser = new ExpressionParser($expression);
        $this->expression = $this->parser->getExpression();

        $this->buildTree($this->root, $this->expression);
    }

    public function buildTree(&$expressionTreeNode, $expression)
    {
        $breakpoint = $this->parser->findBreakpointIdx($expression);
        $operands = $this->parser->findOperands($expression, $breakpoint);

        $expressionTreeNode = new ExpressionTreeOperation($expression[$breakpoint]);

        if (is_numeric($operands["leftOperand"])) {
            $expressionTreeNode->left = new ExpressionTreeOperand($operands["leftOperand"]);
        } else {
            $parser = new ExpressionParser($operands["leftOperand"]);
            $this->buildTree($expressionTreeNode->left, $parser->getExpression());
        }

        if (is_numeric($operands["rightOperand"])) {
            $expressionTreeNode->right = new ExpressionTreeOperand($operands["rightOperand"]);
        } else {
            $parser = new ExpressionParser($operands["rightOperand"]);
            $this->buildTree($expressionTreeNode->right, $parser->getExpression());
        }
    }

    public function calc(): int
    {
        return $this->root->calc();
    }
}