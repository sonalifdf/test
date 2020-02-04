<?php

namespace App\Http\Controllers;

use Auth;
use App\Cart;
use App\Product;
use Illuminate\Http\Request;

class CartsController extends Controller
{
	
	public function addToCart($id){
		$uid = Auth::user()->id; 
		$product = Cart::where(['pid'=>$id, 'uid'=>$uid])->get();

		$cnt=count($product);
		if($cnt < 1){
			$product_data = Product::find($id);
			$cart = new Cart();
			$cart->uid = $uid;
			$cart->pid = $product_data->id;
			$cart->price = $product_data->price;
			$cart->quantity = 1;
			$cart->save();
			return redirect()->back()->with('success', 'Product added to cart successfully!');
        }else{
			Cart::where('id', $product[0]->id)->update(['quantity' => $product[0]->quantity+1 ]);
			return redirect()->back()->with('success', 'Product added to cart successfully!');
		}
    }
	
	public function addToCartAjaxDb(Request $request)
    {
		if($request->id) {
			$id=$request->id;
			$uid = Auth::user()->id; 
			$product = Cart::where(['pid'=>$id, 'uid'=>$uid])->get();
			$cnt=count($product);
			if($cnt < 1){
				$product_data = Product::find($id);
				$cart = new Cart();
				$cart->uid = $uid;
				$cart->pid = $id;
				$cart->price = $product_data->price;
				$cart->quantity = 1;
				$cart->save();
				// return redirect()->back()->with('success', 'Product added to cart successfully!');
			}else{
				Cart::where('id', $product[0]->id)->update(['quantity' => $product[0]->quantity+1 ]);
				// return redirect()->back()->with('success', 'Product added to cart successfully!');
			}
			
			$val = Cart::where(['uid'=>$uid])->count();
			
			// echo "<span class='badge badge-pill badge-danger'>";
			echo $val;
			// echo "</span>";
		}
    }


    public function update(Request $request)
    {
		$uid = Auth::user()->id;
        if($request->id and $request->quantity)
        {
			$cnt=0;
			$product = Cart::where(['pid'=>$request->id, 'uid'=>$uid])->get();
			$cnt=count($product);
			if($cnt > 0){
				$qty=$request->quantity;
				$info = array('quantity' =>$qty);
				Cart::where(['pid'=>$request->id, 'uid'=>$uid])->update($info);
				session()->flash('success', 'Cart updated successfully');
			}else{
				session()->flash('error', 'Product is not exists in cart.');
			}
        }
    }

    public function remove(Request $request)
    {
		$uid = Auth::user()->id;
		$cnt = Cart::where(['pid'=>$request->id, 'uid'=>$uid])->count();
		if($request->id) {
			if($cnt > 0){
				Cart::where(['uid'=>$uid, 'pid'=>$request->id])->delete();
				session()->flash('success', 'Product removed successfully');
			}else{
				session()->flash('error', 'Product is not exists in cart.');
			}
		}
    }
}
