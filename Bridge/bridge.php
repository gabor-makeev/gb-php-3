<?php

class Figure
{
    /**
     * @var Color
     */
    protected $color;

    public function __construct(Color $color)
    {
        $this->color = $color;
    }

    public function operation(): string
    {
        return "Abstraction: Base operation with:\n" . $this->color->operationImplementation();
    }
}

class Cube extends Figure
{
    public function operation(): string
    {
        return "ExtendedAbstraction: Extended operation with:\n" . $this->color->operationImplementation();
    }
}

interface Color
{
    public function operationImplementation(): string;
}

class ConcreteColorA implements Color
{
    public function operationImplementation(): string
    {
        return "ConcreteImplementationA: Here's the result on the platform A.\n";
    }
}

class ConcreteColorB implements Color
{
    public function operationImplementation(): string
    {
        return "ConcreteImplementationB: Here's the result on the platform B.\n";
    }
}

function clientCode(Figure $abstraction)
{
    echo $abstraction->operation();
}

$implementation = new ConcreteColorA();
$abstraction = new Figure($implementation);
clientCode($abstraction);

echo PHP_EOL;

$implementation = new ConcreteColorB();
$abstraction = new Cube($implementation);
clientCode($abstraction);