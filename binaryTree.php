<?php

require_once "MathOperation.php";
use JetBrains\PhpStorm\Pure;

class BinaryNode
{
    public $value;
    public ?BinaryNode $left = NULL;
    public ?BinaryNode $right = NULL;

    public function __construct($value)
    {
        $this->value = $value;
    }
}

class BinaryTree
{
    protected ?BinaryNode $root = NULL;

    public function isEmpty(): bool
    {
        return is_null($this->root);
    }

    public function insert($value)
    {
        $node = new BinaryNode($value);
        $this->insertNode($node, $this->root);
    }

    protected function insertNode(BinaryNode $node, &$subtree): BinaryTree
    {
        if (is_null($subtree)) {
            $subtree = $node;
        } else {
            if ($node->value < $subtree->value) {
                $this->insertNode($node, $subtree->left);
            } elseif ($node->value > $subtree->value) {
                $this->insertNode($node, $subtree->right);
            }
        }
        return $this;
    }

    protected function &findNode($value, &$subtree): mixed
    {
        if (is_null($subtree)) {
            return false;
        }

        if ($subtree->value > $value) {
            return $this->findNode($value, $subtree->left);
        } elseif ($subtree->value < $value) {
            return $this->findNode($value, $subtree->right);
        } else {
            return $subtree;
        }
    }

    public function delete($value): BinaryTree
    {
        if ($this->isEmpty()) {
            echo "tree is empty";
        }

        $node = &$this->findNode($value, $this->root);
        if ($node) {
            $this->deleteNode($node);
        }
        return $this;
    }

    protected function deleteNode(BinaryNode &$node)
    {
        if (is_null($node->left) && (is_null($node->right))) {
            $node = NULL;
        } elseif (is_null($node->left)) {
            $node = $node->right;
        } elseif (is_null($node->right)) {
            $node = $node->left;
        } else {
            if (is_null($node->right->left)) {
                $node->right->left = $node->left;
                $node = $node->right;
            } else {
                $node->value = $node->right->left->value;
                $this->deleteNode($node->right->left);
            }
        }
    }
}



//$m = new MathOperation(1, 2, "+");
//echo $m->calculate();

$numbers = [2, 5, 7, 8, 10, 12, 1];
$binaryTree = new BinaryTree();

foreach ($numbers as $number) {
    $binaryTree->insert($number);
}

$binaryTree->delete(12);

var_dump($binaryTree);

