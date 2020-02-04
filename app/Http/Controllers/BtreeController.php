<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\BinaryNodeController;

define("counting",10);


class BtreeController extends Controller{
	
	public $root;  
    public function __construct(){  
        $this->root = NULL;  
    } 
    public function insert($data) {
        $newNode = new BinaryNodeController($data);  
        if($this->root == NULL){
            $this->root = $newNode;  
            return;  
        }else{
            $current = $this->root;   //current node point to root of the tree
            $parent = NULL;  
            while(true) {  
                $parent = $current; //parent keep track of the parent node of current node.                   
                if($data < $current->value) {  //If data is less than current's data, node will be inserted to the left of tree    
                    $current = $current->left;  
                    if($current == NULL) {
                        $parent->left = $newNode;  
                          return;  
                    }  
                }else {   //If data is greater than current's data, node will be inserted to the right of tree 
                    $current = $current->right;  
                    if($current == NULL) {  
                        $parent->right = $newNode;  
                        return;  
                    }
                }
            }
        }
    }
	public function  print2D(&$root){
		$this->print2DUtil($root,0);		
	}
	public function  print2DUtil(&$root,$space){
		static $val=0;
		if($root === null){ // Base case 
			return;  
		}
		$space =$space+counting;  // Increase distance between levels
		$this->print2DUtil($root->right,$space);	// Process right child first   	
		echo '<br>'; // Print current node after space  
		for($i=counting;$i < $space; $i++){
			echo '&nbsp;';
		}
		echo $root->value;
		$val++;
		$this->print2DUtil($root->left,$space);	 // Process left child 	
	}
}