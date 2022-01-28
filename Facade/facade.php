<?php

class Facade
{
    protected $subsystem1;
    protected $subsystem2;

    public function __construct(Subsystem1 $subsystem1 = null, Subsystem2 $subsystem2 = null)
    {
        $this->subsystem1 = $subsystem1 ?: new Subsystem1();
        $this->subsystem2 = $subsystem2 ?: new Subsystem2();
    }

    public function operation(): string
    {
        $result = "Facade initializes subsystems";
        $result .= $this->subsystem1->operation1();
        $result .= $this->subsystem2->operation1();
        $result .= "Facade orders subsystems to perform the action:\n";
        $result .= $this->subsystem1->operationN();
        $result .= $this->subsystem2->operationZ();

        return $result;
    }
}

class Subsystem1
{
    public function operation1(): string
    {
        return "Subsystem1: Ready!\n";
    }

    public function operationN(): string
    {
        return "Subsystem1: Go!\n";
    }
}

class Subsystem2
{
    public function operation1(): string
    {
        return "Subsystem2: Get ready\n";
    }

    public function operationZ(): string
    {
        return "Subsystem2: Fire!\n";
    }
}

function clientCode(Facade $facade)
{
    echo $facade->operation();
}

$subsystem1 = new Subsystem1();
$subsystem2 = new Subsystem2();
$facade = new Facade($subsystem1, $subsystem2);
clientCode($facade);