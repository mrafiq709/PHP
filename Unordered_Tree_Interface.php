<?php

/**
 * Tree Interface
 */
interface TreeInterface{
    public function init(array $array);
    public function getNode($id);
    public function getNodes($id); // Nodes[]
    public function getParent($id); // Node
    public function toString(); // Print nested <ul, li>
}

/**
 * Node Structures of the tree
 */
class Node{
    // Node Id
    public $id;

    // Parent Id of the Node
    public $parent_id;

    // Node Name
    public $name;

    // Children of the Node
    public $children;

    /**
     * constructor.
     * 
     * @param $i        node id.
     * @param $pId      parent Id of the node.
     * @param $n        node name.
     * @param $child    Childern of the node.
     */
    function __construct($i, $pId, $n, $child = 0){

        $this->id = $i;
        $this->parent_id = $pId;
        $this->name = $n;
        $this->children = $child;
    }
}

/**
 * Tree class [Main Class]
 */
class Tree implements TreeInterface{

    // Hold the initialized Tree.
    private $initializeTree;

    // Hold the single node value when it will be assigend.
    private $singleNode;

    /**
     * Initialization of Tree structure
     * 
     * @param $array        raw value of tree.
     * @param $parent_id    if there is no parent (initially there is no parent), 
     *                      then it will be 0. Then it will call recursively by pasing
     *                      current node id as a parent_id of it's child.
     */
    public function init(array $array, $parent_id = 0)
    {
        // Store the Tree structure
        $branch = array();
    
        // Iteration of $array
        foreach ($array as $element) {
            
            // check which one parent of the child node, then assign in it.
            if ($element->parent_id == $parent_id) {

                // call again for checking if it has child
                $children = $this->init($array, $element->id);

                // If has child then assign it as children of the current node
                if ($children) {
                    $element->children = $children;
                }

                // Finally store the element in the branch
                $branch[] = $element;
            }
        }

        // And return structured Tree.
        return $this->initializeTree = $branch;
    }

    /**
     * Get Single Node
     * 
     * @param $id   id of the node.
     */
    public function getNode($id)
    {
        // Calling recursive function getNodeRecursion for getting the node.
        $this->getNodeRecursion($this->initializeTree, $id);
    }

    /**
     * Get the Nodes and it's childen accoring to Id
     * 
     * @param $id   id of the node.
     */
    public function getNodes($id)
    {
        // Calling recursive function getNodesRecursion for getting the nodes and it's children.
        $this->getNodesRecursion($this->initializeTree, $id);
    }

    /**
     * Get the Parent Node accoring to Id
     * 
     * @param $id   id of the node.
     */
    public function getParent($id)
    {
        // get the node first for getting it's parent_id
        $this->getNode($id);

        // If parent_id is 0, then it's the inital node
        if($this->singleNode->parent_id === 0)
        {
            // print parent node
            echo 'Parent: 0' . '<br/>';
        }
        else
        {
            // pass the parent_id to getNode funtion and get the parent node
            $this->getNode($this->singleNode->parent_id);

            // print parent node
            echo 'Parent: ' . $this->singleNode->name . '<br/>';
        }

    }

    /**
     * Print the Tree as Unorderd List
     */
    public function toString()
    {
        // Calling recursive funtion getUnorderedList to print the Tree as nested <ul, li>.
        $this->getUnorderedList($this->initializeTree);
    }

    /**
     * print the Tree as nested <ul, li>
     * 
     * @param $array    initialized Tree structure
     */
    private function getUnorderedList($array)
    {
        // Iteration of $array
        foreach($array as $key => $value){

            // check if current node has any children
            if(is_array($value->children)){

                // Print the parent node
                echo '<li>' . $value->name .'</li>';

                // add <ul></ul> for children
                echo '<ul>';
                $this->getUnorderedList($value->children);
                echo '</ul>';
            }
            else
            {
                // print root/children node
                echo '<li>' . $value->name .'</li>';
            }
        }
    }

    /**
     * Find the single node according to $id and initialize the $singleNode variable
     * 
     * @param $array    initialized Tree structure
     * @param $id       id of the node
     */
    private function getNodeRecursion($array, $id){
        
        // Iteration of $array
        foreach($array as $key => $value){

            if($value->id === $id)
            {
                $this->singleNode = new Node(
                    $value->id,
                    $value->parent_id,
                    $value->name,
                    $value->children == 0 ? 0 : 1
                );
                return;
            }
            //If $value is an array.
            else if(is_array($value->children)){
                $this->getNodeRecursion($value->children, $id);
            }
        }
    }

    /**
     * Find and print the Nodes and it's children according to node id
     * 
     * @param @arr  initialized Tree structure
     * @param @id   id of the node
     */
    private function getNodesRecursion(array $arr, $id)
    {
        // Iteration of $arr
        foreach($arr as $element)
        {
            // check the current element is the expected element or not
            if($element->id == $id)
            {
                // print the Nodes and it's Child
                echo json_encode($element, JSON_PRETTY_PRINT);
                return;
            }
            else if($element->children)
            {
                // if current element has any child, then call for children iteration
                $this->getNodesRecursion($element->children, $id);
            }
        }
    }
}

// Example:
$nodes = [];

// Input nodes
array_push($nodes, new Node(1, 0, 'A'));
array_push($nodes, new Node(2, 1, 'A1'));
array_push($nodes, new Node(3, 1, 'A2'));
array_push($nodes, new Node(4, 0, 'B'));
array_push($nodes, new Node(5, 4, 'B1'));
array_push($nodes, new Node(6, 4, 'B2'));
array_push($nodes, new Node(7, 2, 'C1'));
array_push($nodes, new Node(8, 3, 'C2'));

// create Tree object
$tree = new Tree();

// initialization of the tree with nodes
$tree->init($nodes);

/**
 * Uncomment the bellow line to test the getNode function
 */
//$tree->getNode(2);

/**
 * Uncomment the bellow line to test the getNodes function
 */
//$tree->getNodes(2);

/**
 * Uncomment the bellow line to test the getParent function
 */
//$tree->getParent(1);

// Print the Tree as Unordered List
$tree->toString();


?>