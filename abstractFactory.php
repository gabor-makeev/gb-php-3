<?php

abstract class AbstractFactory
{
    abstract public function createTable(): Table;

    abstract public function createSofa(): Sofa;

    public function combineTableSofa()
    {
        $table = $this->createTable();
        $sofa = $this->createSofa();
        $sofa->anotherUsefulFunctionB($table);
    }
}

class ArDekoFactory extends AbstractFactory
{
    public function createTable(): Table
    {

        return new ArDekoTable();
    }

    public function createSofa(): Sofa
    {

        return new ArDekoSofa();
    }
}

class ModernFactory extends AbstractFactory
{
    public function createTable(): Table
    {

        return new ModernTable();
    }

    public function createSofa(): Sofa
    {

        return new ModernSofa();
    }
}

interface Table
{
    public function usefulFunctionA(): string;
}

class ArDekoTable implements Table
{
    public function usefulFunctionA(): string
    {

        return "The result of the product A1.";
    }
}

class ModernTable implements Table
{
    public function usefulFunctionA(): string
    {

        return "The result of the product A2.";
    }
}

interface Sofa
{
    public function usefulFunctionB(): string;

    public function anotherUsefulFunctionB(Table $collaborator): string;
}

class ArDekoSofa implements Sofa
{
    public function usefulFunctionB(): string
    {

        return "The result of the product B1.";
    }

    public function anotherUsefulFunctionB(Table $collaborator): string
    {
        $result = $collaborator->usefulFunctionA();

        return "The result of B1 collaborating with the ({$result})";
    }
}

class ModernSofa implements Sofa
{
    public function usefulFunctionB(): string
    {

        return "The result of the product B2.";
    }

    public function anotherUsefulFunctionB(Table $collaborator): string
    {
        $result = $collaborator->usefulFunctionA();

        return "The result of B2 collaborating with the ({$result})";
    }
}

function clientCode(AbstractFactory $factory)
{
    $productTable = $factory->createTable();
    $productSofa = $factory->createSofa();

    echo $productSofa->usefulFunctionB() . "\n";
    echo $productSofa->anotherUsefulFunctionB($productTable) . "\n";
}

echo "Client: Testing client code with the first factory type:\n";
clientCode(new ArDekoFactory());

echo "\n";

echo "Client: Testing the same client code with the second factory type:\n";
clientCode(new ModernFactory());