<?php

class Notifier
{
    protected $notifier;

    public function __contruct(Notifier $nextNotified = null)
    {
        $this->notifier = $nextNotified;
    }

    public function send($message)
    {
        if ($this->notifier) {
            $this->notifier->send($message);
        }
    }
}

class EmailNotifier extends Notifier
{
    public function send($message)
    {
        parent::send($message);
    }
}

class SlackNotifier extends Notifier
{
    public function send($message)
    {
        parent::send($message);
    }
}

$notifier = new Notifier();
$notifier = new EmailNotifier($notifier);
$notifier = new SlackNotifier($notifier);
$notifier->send("Some message");

interface Component
{
    public function operation(): string;
}

class ConcreteComponent implements Component
{
    public function operation(): string
    {
        return "ConcreteComponent";
    }
}

class Decorator implements Component
{
    /**
     * @var Component
     */
    protected $component;

    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    public function operation(): string
    {
        // @todo add some code for decorator logic here
        return $this->component->operation();
    }
}

class ConcreteDecoratorA extends Decorator
{
    public function operation(): string
    {
        return "ConcreteDecoratorA(" . parent::operation() . ")";
    }
}

class ConcreteDecoratorB extends Decorator
{
    public function operation(): string
    {
        return "ConcreteDecoratorB(" . parent::operation() . ")";
    }
}

function clientCode(Component $component)
{
    echo "RESULT: " . $component->operation();
}

$simple = new ConcreteComponent();
echo "Client: I've got a simple component:\n";
clientCode($simple);
echo PHP_EOL . PHP_EOL;

$decorator1 = new ConcreteDecoratorA($simple);
$decorator2 = new ConcreteDecoratorB($decorator1);
echo "Client: Now I've got a decorated component:" . PHP_EOL;
clientCode($decorator2);