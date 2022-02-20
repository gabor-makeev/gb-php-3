<?php

require_once "ExpressionParser.php";
require_once "ExpressionTreeOperand.php";
require_once "ExpressionTreeOperation.php";

class ExpressionTree
{
    public array $expression;
    public ?ExpressionTreeOperation $root = null;

    public function __construct($expression)
    {
        $parser = new ExpressionParser($expression);
        $this->expression = $parser->getExpression();

        $this->buildTree($this->root, $this->expression);
    }

    public function buildTree(&$expressionTreeNode, $expression)
    {
        $breakpoint = ExpressionParser::findBreakpointIdx($expression);
        $operands = ExpressionParser::findOperands($expression, $breakpoint);

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