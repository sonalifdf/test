<?php

namespace Bitfumes\Contact\Http\Controllers;

use App\Http\Controllers\Controller;
use Bitfumes\Contact\Models\Contact; 
use Illuminate\Http\Request;

class ContactController extends Controller
{
	public function indexing()
    {
        return view('contact::contact');
    }

	public function send(Request $request)
    {
	echo 'hi';die;
      // Contact::create($request->all());
    }

}