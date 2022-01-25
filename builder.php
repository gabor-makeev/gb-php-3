<?php

interface Builder
{
    public function produceGarage(): void;

    public function produceGarden(): void;

    public function produceFancies(): void;

    public function produceFoundament(): void;
}

class ConcreteBuilder1 implements Builder
{
    private $product;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->product = new House();
        $this->produceFoundament();
    }

    public function produceGarage(): void
    {
        $this->product->parts[] = 'Garage';
    }

    public function produceGarden(): void
    {
        $this->product->parts[] = 'Garden';
    }

    public function produceFancies(): void
    {
        $this->product->parts[] = 'Fancies';
    }

    public function produceFoundament(): void
    {
        $this->product->parts[] = 'Foundament';
    }

    public function getProduct(): House
    {
        $result = $this->product;
        $this->reset();

        return $result;
    }
}

class House
{
    public $parts = [];

    public function addPart($part): void
    {
        $this->parts[] = $part;
    }

    public function listParts(): void
    {
        echo "Product parts: " . implode(', ', $this->parts) . "\n\n";
    }

    public function calculateTotal(): float
    {
        $total = 0;

        foreach ($this->parts as $part) {
            $total += $part->calculateTotal();
        }

        return $total;
    }
}

class Director
{
    /**
     * @var Builder
     */
    private $builder;

    public function setBuilder(Builder $builder): void
    {
        $this->builder = $builder;
    }

    public function buildMinimalViableProduct(): void
    {
        $this->builder->produceGarage();
    }

    public function buildFullFeaturedProduct(): void
    {
        $this->builder->produceGarage();
        $this->builder->produceGarden();
        $this->builder->produceFancies();
    }
}

function clientCode(Director $director)
{
    $builder = new HiTechBuilder();
    $director->setBuilder($builder);

    echo "Standard basic product:\n";
    $director->buildMinimalViableProduct();
    $builder->getProduct()->listParts();

    echo "Standard full featured product";
    $director->buildFullFeaturedProduct();
    $builder->getProduct()->listParts();

    echo "Custom product:\n";
    $builder->produceGarage();
    $builder->produceFancies();
    $builder->getProduct()->listParts();
}

$director = new Director();
clientCode($director);