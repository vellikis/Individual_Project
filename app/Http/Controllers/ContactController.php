<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }
    
    public function send(Request $request)
    {
        // Validate
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Send an email
        Mail::to(config('mail.from.address'))
            ->send(new ContactFormSubmitted($data));

        //Redirect back with a success flash
        return back()->with('success', 'Thank you! Your message has been sent.');
    }
}
