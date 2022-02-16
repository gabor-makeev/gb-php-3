<?php

class MathOperation
{
    private int|float $firstValue;
    private int|float $secondValue;
    private string $operation;

    public function __construct($firstValue, $secondValue, $operation)
    {
        $this->firstValue = $firstValue;
        $this->secondValue = $secondValue;
        $this->operation = $operation;
    }

    #[Pure] public function calculate(): bool|int|float
    {
        if ($this->operation === "+")
            return $this->sum();
        elseif ($this->operation === "-")
            return $this->subtract();
        elseif ($this->operation === "*")
            return $this->multiply();
        elseif ($this->operation === "/")
            return $this->divide();

        return false;
    }

    protected function sum(): int|float
    {
        return $this->firstValue + $this->secondValue;
    }

    protected function subtract(): int|float
    {
        return $this->firstValue - $this->secondValue;
    }

    protected function multiply(): int|float
    {
        return $this->firstValue * $this->secondValue;
    }

    protected function divide(): int|float
    {
        return $this->firstValue / $this->secondValue;
    }
}