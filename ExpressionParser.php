<?php

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

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

    public function findBreakpointIdx($parsedExpression): int
    {
        $operatorElements = $this->getExpressionOperatorsPriorities($parsedExpression);
        $elementsWithLowestPriority = $this->getOperatorsWithLowestPriority($operatorElements);

        return end($elementsWithLowestPriority)["index"];
    }

    #[ArrayShape(["leftOperand" => "string", "rightOperand" => "string"])]
    public function findOperands($expression, $breakpointIdx): array
    {
        $leftOperand = [];
        $rightOperand = [];
        foreach ($expression as $idx => $element) {
            if ($idx < $breakpointIdx)
                $leftOperand[] = $element;
            if ($idx > $breakpointIdx)
                $rightOperand[] = $element;
        }

        $this->adjustParentheses($leftOperand);
        $this->adjustParentheses($rightOperand);

        return [
            "leftOperand" => implode("", $leftOperand),
            "rightOperand" => implode("", $rightOperand)
        ];
    }

    protected function getParentheses(array $parsedExpression): array
    {
        $parentheses = [];
        foreach ($parsedExpression as $idx => $element) {
            if (in_array($element, ["(", ")"]))
                $parentheses[] = [
                    "element" => $element,
                    "index" => $idx
                ];
        }
        return $parentheses;
    }

    // getExpressionOperatorsPriorities() finds operators in the parsed expression and returns an array with them prioritized
    #[Pure]
    protected function getExpressionOperatorsPriorities(array $parsedExpression): array
    {
        $priorityModifier = 0;
        $operatorElements = [];

        foreach ($parsedExpression as $elementIdx => $element) {

            if ($element === "(")
                $priorityModifier += 2;

            if ($element === ")")
                $priorityModifier -= 2;

            if ($this->isOperator($element)) {
                $operatorElements[] = [
                    "name" => $element,
                    "priority" => self::OPERATIONS_PRIORITIES[$element] + $priorityModifier,
                    "index" => $elementIdx
                ];
            }
        }

        return $operatorElements;
    }

    // getOperatorsWithLowestPriority() check an array of prioritized operators and returns an array of those of the lowest priority
    protected function getOperatorsWithLowestPriority(array $operators): array
    {
        $elementsWithLowestPriority = [];

        foreach ($operators as $operator) {
            if ($operator["priority"] === $this->getLowestPriorityAmongOperators($operators))
                $elementsWithLowestPriority[] = $operator;
        }

        return $elementsWithLowestPriority;
    }

    // getLowestPriorityAmongOperators() checks an array of prioritized operators and find the value of the lowest priority among them
    protected function getLowestPriorityAmongOperators(array $operators): int
    {
        $lowestPriority = $operators[0]["priority"];

        foreach ($operators as $operatorElement) {
            if ($operatorElement["priority"] < $lowestPriority)
                $lowestPriority = $operatorElement["priority"];
        }

        return $lowestPriority;
    }

    // adjustParentheses() removes a single pair of parentheses/removes 1 parenthesis/equalizes unequal pairs of parentheses
    protected function adjustParentheses(array &$parsedExpression)
    {
        $parentheses = $this->getParentheses($parsedExpression);

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
            $this->equalizeParentheses($parentheses, $parsedExpression);
        }
    }

    // equalizeParentheses() checks opening and closing parenthesis and removes obsolete ones (such can be results of expression split)
    protected function equalizeParentheses(array $parentheses, array &$parsedExpression): void
    {
        $openingParentheses = array_filter($parentheses, function ($item) {
            return $item["element"] === "(";
        });
        $closingParentheses = array_filter($parentheses, function ($item) {
            return $item["element"] === ")";
        });

        if ($openingParentheses > $closingParentheses) {
            $this->removeRepeatedParentheses($openingParentheses, $parsedExpression);
        } elseif ($closingParentheses > $openingParentheses) {
            $this->removeRepeatedParentheses($closingParentheses, $parsedExpression);
        }
    }

    // removeRepeatedParentheses() removes a parenthesis that comes right after another one
    protected function removeRepeatedParentheses($parentheses, &$parsedExpression): void
    {
        foreach ($parentheses as $idx => $parenthesis) {
            if (
                isset($parentheses[$idx + 1])
                && $parenthesis["index"] === $parentheses[$idx + 1]["index"] - 1
            ) {
                array_splice($parsedExpression, $parenthesis["index"], 1);
            }
        }
    }

    // isOperator() checks whether an element of an expression is an operator (using the OPERATIONS_PRIORITIES constant)
    protected function isOperator($element): bool
    {
        foreach (self::OPERATIONS_PRIORITIES as $OPERATIONS_PRIORITY_IDX => $OPERATIONS_PRIORITY) {
            if ($element === $OPERATIONS_PRIORITY_IDX)
                return true;
        }
        return false;
    }

    // parseExpression() parses the string representation of the expression and returns its array representation
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

    // getExpressionWithoutSpaces() returns the string representation of the expression without whitespaces
    protected function getExpressionWithoutSpaces(string $expression): string
    {
        return str_replace(" ", "", $expression);
    }

    // getExpressionAsArray() returns the array representation of a string
    protected function getExpressionAsArray(string $expression): array
    {
        return str_split($expression);
    }
}