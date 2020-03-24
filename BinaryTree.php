<?php
class BinaryNode
{
    public $value;    // contains the node item
    public $left;     // the left child BinaryNode
    public $right;     // the right child BinaryNode

    public function __construct($item) {
        $this->value = $item;
        // new nodes are leaf nodes
        $this->left = null;
        $this->right = null;
    }

    // perform an in-order traversal of the current node
    public function dump()
    {
        if($this->left !== null)
        {
            $this->left->dump();
        }
        var_dump($this->value);
        if($this->right !== null)
        {
            $this->right->dump();
        }
    }
}

class BinaryTree
{
    protected $root; // the root node of our tree

    public function __construct() {
        $this->root = null;
    }

    public function isEmpty() {
        return $this->root === null;
    }

    public function insert($item)
    {
        $node = new BinaryNode($item);

        if($this->isEmpty())
        {
            $this->root = $node;
        }
        else{
            // insert the node somewhere in the tree starting with the root
            $this->insertNode($node, $this->root);
        }
    }

    protected function insertNode($node, &$subtree)
    {
        if($subtree === null)
        {
            // insert node here if subtree is empty
            $subtree = $node;
        }
        else if($node->value > $subtree->value)
        {
            // Keep trying to insert right
            $this->insertNode($node, $subtree->right);
        }
        else if($node->value < $subtree->value)
        {
            // Keep trying to insert left
            $this->insertNode($node, $subtree->left);
        }else{
            // Reject duplicate
        }
    }

    public function traverse()
    {
        // dump the tree rooted at "root"
        $this->root->dump();
    }
}

$tree = new BinaryTree();

$tree->insert(5);
$tree->insert(10);
$tree->insert(15);

$tree->traverse();

?>