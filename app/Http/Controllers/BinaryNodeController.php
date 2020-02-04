<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class BinaryNodeController extends Controller
{
	
	public $value;    // contains the node item
    public $left;     // the left child BinaryNode
    public $right;     // the right child BinaryNode
	
    public function __construct($item)
    {
        $this->value = $item;
        // new nodes are leaf nodes
        $this->left = null;
        $this->right = null;
    }
    
}
