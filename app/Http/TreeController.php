<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BtreeController;
use App\Http\Controllers\BinaryNodeController;

class CommanController extends Controller
{
    public function __construct()
    {
        $this->Db_obj = new CartsController;
        $this->Sesion_obj = new ProductsController;
    }
    public function addToCart(Request $request){
        if(Auth::check()){
            return $this->Db_obj->addToCart($request);
        }else{
            return $this->Sesion_obj->addToCart($request);
        }
    }
    public function update(Request $request){
        if(Auth::check()){
            $this->Db_obj->update($request);
        }else{
            $this->Sesion_obj->update($request);
        }
    }
	
    public function Btree_print(){
		
		$node = new BinaryNodeController(1);
		$node->left=new BinaryNodeController(2);
		$node->right=new BinaryNodeController(3);
		$node->left->left=new BinaryNodeController(4);
		$node->left->right=new BinaryNodeController(5);
		$node->right->left=new BinaryNodeController(6);
		$node->right->right=new BinaryNodeController(7);
		$node->left->left->left = new BinaryNodeController(8);  
		$node->left->left->right = new BinaryNodeController(9);  
		$node->left->right->left = new BinaryNodeController(10);  
		$node->left->right->right = new BinaryNodeController(11);  
		$node->right->left->left = new BinaryNodeController(12);  
		$node->right->left->right = new BinaryNodeController(13);  
		$node->right->right->left = new BinaryNodeController(14);  
		$node->right->right->right = new BinaryNodeController(15); 
		$ins = new BtreeController();
		$ins->print2D($node);
		
		// $ins = new BtreeController();
		// $ins->insert(50);
		// $ins->insert(30);
		// $ins->insert(70);
		// $ins->insert(60);
		// $ins->insert(10);
		// $ins->insert(90);

		// $ins->inorderTraversal($ins->root); 
	}
	
	// function inorderTraversal($node) {  
          
 
        // if($this->root == NULL){  
            // print("Tree is empty <br>");  
            // return;  
        // }  
        // else {  
            
            // if($node->left != NULL){  
              // $this->inorderTraversal($node->left);   
			// }
            // if($node->right != NULL){
              // $this->inorderTraversal($node->right);  
			// }
            // print("$node->value  ");
        // }        
    // }  
	
	
    public function remove(Request $request){
        if(Auth::check()){
            $this->Db_obj->remove($request);
        }else{
            $this->Sesion_obj->remove($request);
        }
    }

}
