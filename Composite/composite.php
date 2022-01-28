<?php

abstract class Component
{
    /**
     * @var Component
     */
    protected $parent;

    public function setParent(Component $parent)
    {
        $this->parent = $parent;
    }

    public function getParent(): Component
    {
        return $this->parent;
    }

    public function add(Component $component): void
    {
    }

    public function remove(Component $component): void
    {
    }

    public function isComposite(): bool
    {
        return false;
    }

    abstract public function calculate_totals(): string;
}

class Product extends Component
{
    public function calculate_totals(): string
    {
        return "Leaf";
    }
}

class Box extends Component
{
    /**
     * @var \SplObjectStorage
     */
    protected $children;

    public function __construct()
    {
        $this->children = new \SplObjectStorage();
    }

    public function add(Component $component): void
    {
        $this->children->attach($component);
        $component->setParent($this);
    }

    public function remove(Component $component): void
    {
        $this->children->detach($component);
        $component->setParent(null);
    }

    public function isComposite(): bool
    {
        return true;
    }

    public function calculate_totals(): string
    {
        $results = [];
        foreach ($this->children as $child) {
            $results[] = $child->calculate_totals();
        }

        return "Branch(" . implode("+", $results) . ")";
    }
}

function clientCode(Component $component)
{
    echo "RESULT: " . $component->calculate_totals();
}

$simple = new Product();
clientCode($simple);

$tree = new Box();
$branch1 = new Box();
$branch1->add(new Product());
$branch1->add(new Product());
$branch2 = new Box();
$branch2->add(new Product());
$tree->add($branch1);
$tree->add($branch2);
clientCode($tree);

echo PHP_EOL;

function clientCode2(Component $component1, Component $component2)
{
    if ($component1->isComposite()) {
        $component1->add($component2);
    }
    echo "RESULT: " . $component1->calculate_totals();
}

clientCode2($tree, $simple);