<!-- Здесь будет находится домашнее задание на других ветках -->

<?php

// Factory Method

abstract class BaseFactory
{
    abstract public function factoryMethod(): Delivery;

    public function someOperation(): string
    {
        $product = $this->factoryMethod();
        $result = "Creator: The same creator's code has just worked with " . $product->calculate_delivery();

        return $result;
    }

    public function someOperation2(): string
    {
        $product = $this->factoryMethod();
    }
}

class TruckDeliveryFactory extends BaseFactory
{
    public function factoryMethod(): Delivery
    {

        return new Truck();
    }
}

class SeaDeliveryFactory extends BaseFactory
{
    public function factoryMethod(): Delivery
    {

        return new Ship();
    }
}

interface Delivery
{
    public function calculate_delivery(): string;
}

class Truck implements Delivery
{
    public function calculate_delivery(): string
    {

        return "{Result of the ConcreteProduct1}";
    }
}

class Ship implements Delivery
{
    public function calculate_delivery(): string
    {

        return "{Result of the ConcreteProduct2}";
    }
}

function clientCode(BaseFactory $creator)
{
    echo "Client: I'm not aware of the creator's class, but it still works.\n" . $creator->someOperation();
    echo "Client: I'm not aware of the creator's class, but it still works.\n" . $creator->someOperation2();
}

echo "App: Launched with the ConcreteCreator1.\n";
clientCode(new TruckDeliveryFactory());
echo"\n\n";

echo "App: Launched with the ConcreteCreator2.\n";
clientCode(new SeaDeliveryFactory());

clientCode(new TestDeliveryFactory());