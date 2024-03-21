<?php

namespace App\Http\Controllers\backend;

use Carbon\Carbon;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactUsController extends Controller
{
    public function ContactUs(){
        $messages = Contact::latest()->get();
        return view('backend.contact.contact_us_all_messages', compact('messages'));
    } // End Method

    public function ContactPage(){
        return view('frontend.contact.contact_us');
    } // End Method

    public function StoreMessage(Request $request){
        
        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone_number,
            'subject' => $request->msg_subject,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Message Sent Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method
}
