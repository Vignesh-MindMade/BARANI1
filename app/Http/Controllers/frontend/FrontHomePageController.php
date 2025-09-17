<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Textile;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;



class FrontHomePageController extends Controller
{
    public function index(){
    
        return view('frontend.home');
    }

    public function profile(){
    
        return view('frontend.profile');
    }

    public function contact(){
        return view('frontend.contact');
    }

    public function gallery(){
        return view('frontend.gallery');
    }
   
    public function textile(){
        return view('frontend.textile');
    }

    public function food(){
        return view('frontend.food');
    }

    public function OEM(){
        return view('frontend.oem');
    }

public function sendContact(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    $data = $request->only('name', 'email', 'subject', 'message');

    Mail::to('manoj@mindmade.in')->send(new ContactMail($data));

    return response()->json(['success' => 'Your message has been sent successfully!']);
}

}
