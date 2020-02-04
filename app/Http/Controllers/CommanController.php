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
	public function remove(Request $request){
        if(Auth::check()){
            $this->Db_obj->remove($request);
        }else{
            $this->Sesion_obj->remove($request);
        }
    }
    public function printtree(){
	$bt = new BtreeController();  
		$arr=array(50,30,70,60,20,90,35);
		foreach($arr as $val){
			$bt->insert($val); // insert nodes to binary tree
		}
		$tree_array=$bt->root;
		 return view('tree', compact('tree_array'));
		 // $bt->print2D($bt->root); // print Btree with spaces nodes to binary tree
	}
}