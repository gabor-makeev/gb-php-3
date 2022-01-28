<?php

class Target
{
    public function request(): string
    {
        return "Target: the default target's behaviour";
    }
}

class Adaptee
{
    public function specificRequest(): string
    {
        return ".eetpadA eht fo ruoivaheb laicepS";
    }
}

class Adapter extends Target
{

    private $adaptee;

    public function __construct(Adaptee $adaptee)
    {
        $this->adaptee = $adaptee;
    }

    public function request(): string
    {
        return "Adapter: (TRANSLATED) " . strrev($this->adaptee->specificRequest());
    }
}

function clientCode(Target $target)
{
    echo $target->request() . PHP_EOL;
}

echo "Here is the code of the target class:" . PHP_EOL;
$target = new Target();
clientCode($target);

echo "Here is the code of the Adaptee:" . PHP_EOL;
$adaptee = new Adaptee();
echo $adaptee->specificRequest() . PHP_EOL;

echo "Here is the code of the adaptedAdaptee:" . PHP_EOL;
$adaptedAdaptee = new Adapter($adaptee);
clientCode($adaptedAdaptee);