<?php

interface TreeInterface{
    public function init(array $array);
    public function getNode($id);
    public function getNodes($id); // Nodes[]
    public function getParent($id); // Node
    public function toString(); // Print nested <ul, li>
}

class Node{
    public $id;
    public $parent_id;
    public $name;
    public $children;

    function __construct($i, $pId = 0, $n, $child = false){

        $this->id = $i;
        $this->parent_id = $pId;
        $this->name = $n;
        $this->children = $child;
    }
}

class Tree implements TreeInterface{

    private $initializeTree;

    public function init(array $array, $parent_id = 0)
    {
        $branch = array();
    
        foreach ($array as $element) {
            
            if ($element->parent_id == $parent_id) {
                $children = $this->init($array, $element->id);
                if ($children) {
                    $element->children = $children;
                }
                $branch[] = $element;
            }
        }

        return $this->initializeTree = $branch;
    }

    public function getNode($id)
    {
        $this->getNodeRecursion($this->initializeTree, $id);
    }

    public function getNodes($id)
    {
        $this->getNodesRecursion($this->initializeTree, $id);
    }

    public function getParent($id)
    {
        
    }

    public function toString()
    {
        echo json_encode($this->initializeTree, JSON_PRETTY_PRINT);
    }

    private function getNodesRecursion(array $arr, $id)
    {
        foreach($arr as $element)
        {
            if($element->id == $id)
            {
                echo json_encode($element, JSON_PRETTY_PRINT);
                return;
            }
            else if($element->children)
            {
                $this->getNodesRecursion($element->children, $id);
            }
        }
    }

    private function getNodeRecursion(array $arr, $id)
    {
        foreach($arr as $element)
        {
            if($element->id == $id)
            {
                echo json_encode(new Node(
                    $element->id, 
                    $element->parent_id, 
                    $element->name,
                    $element->children == true ? true : false
                ), JSON_PRETTY_PRINT);
                return;
            }
            else if($element->children)
            {
                $this->getNodesRecursion($element->children, $id);
            }
        }
    }
}

// Example:
$nodes = [];

array_push($nodes, new Node(1, 0, 'A'));
array_push($nodes, new Node(2, 1, 'A1'));
array_push($nodes, new Node(3, 1, 'A2'));
array_push($nodes, new Node(4, 0, 'B'));

$tree = new Tree();

$tree->init($nodes);

//$tree->getNode(3);

//$tree->getNodes(1);

$tree->toString();


?>