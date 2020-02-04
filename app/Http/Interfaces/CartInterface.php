<?php 
namespace App\Http\Interfaces;

use Illuminate\Http\Request;

interface CartInterface {
	public function cart();
	public function addToCart(Request $request);
	public function update(Request $request);
	public function remove(Request $request);
}