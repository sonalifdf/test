<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products', compact('products'));
    }

    public function cart()
    {
		$products=array();
		$src_by="";
		if(Auth::check()){
			$uid = Auth::user()->id;
			// $products = DB::table('carts')->where(['uid' => $uid])->get()->toArray();
			
			 $products = DB::table('carts')
                            ->select('products.id','products.name','products.description','products.photo','products.price','carts.quantity')
                            ->join('products','products.id','=','carts.pid')
                            ->where(['carts.uid' => $uid])
                            ->get()->toArray();
			
			$src_by='cart';
		}else{
			$products=session('cart');
			$src_by='session';
		}
		
		return view('cart', compact('products','src_by'));
    }

    public function addToCart($id)
    {
        $product = Product::find($id);

        if(!$product) {

            abort(404);

        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                    $id => [
                        "name" => $product->name,
                        "quantity" => 1,
                        "price" => $product->price,
                        "photo" => $product->photo
                    ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "photo" => $product->photo
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
	
	
	public function addToCartAjaxSession(Request $request)
    {
		if($request->id) {
			
			$id=$request->id;
			
			$product = Product::find($id);
			$cart = session()->get('cart');
			// if cart is empty then this the first product
			if(!$cart) {
				$cart = [
						$id => [
							"name" => $product->name,
							"quantity" => 1,
							"price" => $product->price,
							"photo" => $product->photo
						]
				];
				session()->put('cart', $cart);
				// return redirect()->back()->with('success', 'Product added to cart successfully!');
			}
			// if cart not empty then check if this product exist then increment quantity
			if(isset($cart[$id])) {
				$cart[$id]['quantity']++;
				session()->put('cart', $cart);
				// return redirect()->back()->with('success', 'Product added to cart successfully!');
			}
			// if item not exist in cart then add to cart with quantity = 1
			$cart[$id] = [
				"name" => $product->name,
				"quantity" => 1,
				"price" => $product->price,
				"photo" => $product->photo
			];
			session()->put('cart', $cart);
			// return redirect()->back()->with('success', 'Product added to cart successfully!');
			
			
			// echo "<span class='badge badge-pill badge-danger'>";
			echo count(session('cart'));
			// echo "</span>";
		}
    }

    public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
        }
    }
	

    public function remove(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed successfully');
        }
    }
}
