<?php

namespace App\Listeners\Auth;

use Session;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogRegisteredUser
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
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
	  
		$cart = Session()->get('cart');
		$user_id = Auth::user()->id;
        if(!empty($cart)){
			foreach($cart as $id => $details){
				DB::table('carts')->insert([
					['uid' => $user_id,'pid' => $id,'price' => $details['price'],'quantity' => $details['quantity'],'created_at' => '2020-01-02 00:00:00','updated_at' => '2020-01-02 00:00:00']
				]);
			}
			Session()->forget('cart');
		}
	  
    }
	
}
