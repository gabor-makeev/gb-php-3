<?php

require_once "ExpressionParser.php";

class ExpressionTreeNode
{
    public string $operation;
    public int|ExpressionTreeNode $left;
    public int|ExpressionTreeNode $right;
    public string $expression;

    public function __construct($expression)
    {
        $this->expression = $expression;
    }

    public function getParsedExpression(): array
    {
        $parser = new ExpressionParser($this->expression);
        return $parser->getExpression();
    }

    public function getOperations()
    {
        $parsedExpression = $this->getParsedExpression();
        $operations = [];
        $priorityModifier = 0;
        foreach ($parsedExpression as $idx => $lec) {
            if ($lec === "(") {
                $priorityModifier++;
            }
            if ($lec === ")") {
                $priorityModifier--;
            }

            if ($lec === "+") {
                $operations[] = [
                    "name" => $lec,
                    "idx" => $idx,
                    "priority" => 1 + 1
                ];
            }
        }
    }

    public function getOperation()
    {
    }
}

$expressionNode = new ExpressionTreeNode("2 + 2");
$expressionNode->getOperation();