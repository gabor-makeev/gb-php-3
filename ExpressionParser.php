<?php

use JetBrains\PhpStorm\ArrayShape;

class ExpressionParser
{
    private array $expression;
    const OPERATIONS_PRIORITIES = [
        "+" => 1,
        "-" => 1,
        "*" => 2,
        "/" => 2,
        "^" => 3
    ];

    public function __construct(string $expression)
    {
        $this->expression = $this->parseExpression($expression);
    }

    public function getExpression(): array
    {
        return $this->expression;
    }

    public static function adjustParentheses(array &$parsedExpression)
    {
        $parentheses = [];
        foreach ($parsedExpression as $idx => $element) {
            if (in_array($element, ["(", ")"]))
                $parentheses[] = [
                    "element" => $element,
                    "index" => $idx
                ];
        }

        if (
            count($parentheses) === 2
            && $parentheses[1]["index"] === count($parsedExpression) - 1
            && $parentheses[0]["index"] === 0
        ) {
            array_splice($parsedExpression, $parentheses[1]["index"], 1);
            array_splice($parsedExpression, $parentheses[0]["index"], 1);
        }

        if (count($parentheses) === 1) {
            array_splice($parsedExpression, $parentheses[0]["index"], 1);
        }

        if (count($parentheses) % 2 !== 0) {
            $openingParentheses = array_filter($parentheses, function ($item) {
                return $item["element"] === "(";
            });
            $closingParentheses = array_filter($parentheses, function ($item) {
                return $item["element"] === ")";
            });

            if ($openingParentheses > $closingParentheses) {
                foreach ($openingParentheses as $idx => $openingParenthesis) {
                    if (isset($openingParentheses[$idx + 1]) && $openingParenthesis["index"] === $openingParentheses[$idx + 1]["index"] - 1) {
                        array_splice($parsedExpression, $openingParenthesis["index"], 1);
                    }
                }
            }

            if ($closingParentheses > $openingParentheses) {
                foreach ($closingParentheses as $idx => $closingParenthesis) {
                    if (isset($closingParentheses[$idx + 1]) && $closingParenthesis["index"] === $closingParentheses[$idx + 1]["index"] - 1) {
                        array_splice($parsedExpression, $closingParenthesis["index"], 1);
                    }
                }
            }
        }
    }

    public static function findBreakpointIdx($expression): int
    {
        $priorityModifier = 0;
        $elementsWithLowestPriority = [];
        $operatorElements = [];

        foreach ($expression as $elementIdx => $element) {

            if ($element === "(")
                $priorityModifier = 3;

            if ($element === ")")
                $priorityModifier = 0;

            if (self::isOperator($element)) {
                $operatorElements[] = [
                    "name" => $element,
                    "priority" => self::OPERATIONS_PRIORITIES[$element] + $priorityModifier,
                    "index" => $elementIdx
                ];
            }
        }

        $lowestPriority = $operatorElements[0]["priority"];
        foreach ($operatorElements as $operatorElement) {
            if ($operatorElement["priority"] < $lowestPriority)
                $lowestPriority = $operatorElement["priority"];
        }

        foreach ($operatorElements as $operatorElement) {
            if ($operatorElement["priority"] === $lowestPriority)
                $elementsWithLowestPriority[] = $operatorElement;
        }

        return end($elementsWithLowestPriority)["index"];
    }

    #[ArrayShape(["leftOperand" => "string", "rightOperand" => "string"])] public static function findOperands($expression, $breakpointIdx): array
    {
        $leftOperand = [];
        $rightOperand = [];
        foreach ($expression as $idx => $element) {
            if ($idx < $breakpointIdx)
                $leftOperand[] = $element;
            if ($idx > $breakpointIdx)
                $rightOperand[] = $element;
        }

        self::adjustParentheses($leftOperand);
        self::adjustParentheses($rightOperand);

        return [
            "leftOperand" => implode("", $leftOperand),
            "rightOperand" => implode("", $rightOperand)
        ];
    }

    public static function isOperator($element): bool
    {
        foreach (self::OPERATIONS_PRIORITIES as $OPERATIONS_PRIORITY_IDX => $OPERATIONS_PRIORITY) {
            if ($element === $OPERATIONS_PRIORITY_IDX)
                return true;
        }
        return false;
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