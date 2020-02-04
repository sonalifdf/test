<?php

namespace Bitfumes\Contact\Http\Controllers;
use App\Http\Controllers\Controller;
use Bitfumes\Contact\Models\Contact; 
use Illuminate\Http\Request; 

class ContactController extends Controller
{
	public function index()
    {
        return view('contact::contact');
    }

	public function send(Request $request)
    {
       Contact::create($request->all());
    }

}