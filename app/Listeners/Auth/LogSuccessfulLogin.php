<?php

namespace App\Listeners\Auth;

use DB;
use Auth;
use App\Model\Cart;
use Session;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
	public function handle(Login $login)
	{
		
		$cart = Session()->get('cart');
		$user_id = Auth::user()->id;
        if(!empty($cart)){
			$pid = DB::table('carts')->where(['uid'=>$user_id])->pluck('pid')->toArray();
			
			
			foreach($cart as $id => $details){
				if(in_array($id, $pid)){
					$product = DB::table('carts')->where(['pid'=>$id, 'uid'=>$user_id])->get();
					$cnt=count($product);
					if($cnt >= 1){
						$qty=$product[0]->quantity+$details['quantity'];
						DB::table('carts')->where(['pid'=>$id, 'uid'=>$user_id])->update(['quantity' => $qty]);
					}
				}else{
					DB::table('carts')->insert([
						['uid' => $user_id,'pid' => $id,'price' => $details['price'],'quantity' => $details['quantity'],'created_at' => '2020-01-02 00:00:00','updated_at' => '2020-01-02 00:00:00']
					]);
				}
			}
			Session()->forget('cart');
		}
		
		
		
		
	}



}
