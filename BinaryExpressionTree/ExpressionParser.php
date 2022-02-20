<?php

class ExpressionParser
{
    private array $expression;

    public function __construct(string $expression)
    {
        $this->expression = $this->parseExpression($expression);
    }

    public function getExpression(): array
    {
        return $this->expression;
    }

    protected function parseExpression(string $expression): array
    {
        $expressionWithoutSpaces = $this->getExpressionWithoutSpaces($expression);
        $expressionAsArray = $this->getExpressionAsArray($expressionWithoutSpaces);

        $parsedExpression = [];

        foreach ($expressionAsArray as $idx => &$item) {
            if (
                is_numeric($item)
                && isset($expressionAsArray[$idx + 1])
                && is_numeric($expressionAsArray[$idx + 1])
            ) {
                $parsedExpression[] = $item . $expressionAsArray[$idx + 1];
                array_splice($expressionAsArray, $idx + 1, 1);
            } else {
                $parsedExpression[] = $item;
            }
        }
        return $parsedExpression;
    }

    protected function getExpressionWithoutSpaces(string $expression): string
    {
        return str_replace(" ", "", $expression);
    }

    protected function getExpressionAsArray(string $expression): array
    {
        return str_split($expression);
    }
}