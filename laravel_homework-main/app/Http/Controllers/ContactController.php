<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;

use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;


use App\Models\ContactForm;


class ContactController extends Controller{

    public function AdminContact(){
        $contacts = Contact::all();
        return view('admin.contact.index',compact('contacts'));
    }

    public function AdminAddContact(){
        return view('admin.contact.create');
    }
    public function AdminStoreContact(Request $request){
         Contact::insert([
            'email'=> $request->email,
            'phone' =>$request->phone,
            'address' =>$request->address,
            'created_at' => Carbon::now()
        ]);
            return Redirect()->route('admin.contact')->with('succes','About Inserted Succesfully');
    }
    public function Contact(){
        $contacts = DB::table('contacts')->first();
        return view('pages.contact',compact('contacts'));
    }
    public function ContactForm(Request $request){
       // FORM VALIDATION ON SERVER SIDE
            $this->validate($request,[
            'email'=>'required|min:8',
            'name'=>'required|max:15',
            ]);

          ContactForm::insert([
            'name'=> $request->name,
            'email' =>$request->email,
            'subject' =>$request->subject,
            'message' =>$request->message,
            'created_at' => Carbon::now()
        ]);
            return Redirect()->route('contact')->with('succes','About Inserted Succesfully');

    }
    public function AdminMessage(){
        $messages = ContactForm::all()->sortByDesc("created_at") ;
        return view('admin.contact.message',compact('messages'));
    }


}
