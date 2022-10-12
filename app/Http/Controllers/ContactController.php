<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //Contact Page Function
    public function contactPage(){
        return view('user.contact');
    }
    //Contact Function
    public function contact(Request $request){
        $this->contactValidationCheck($request);
        $data=$this->getContactData($request);
        Contact::create($data);
        return redirect()->route('customer#home');
    }
    //Contact List Function
    public function contactListPage(){
        $contacts=Contact::get();
        return view('admin.profile.contactList',compact('contacts'));
    }
    //contactValidationCheck Function
    private function contactValidationCheck($request){
        $validationRules=[
            'userName'=>'required',
            'userEmail'=>'required',
            'userSubject'=>'required',
            'userMessage'=>'required'
        ];
        Validator::make($request->all(),$validationRules)->validate();
    }
    //getContactData Function
    private function getContactData($request){
        return [
            'user_id'=>Auth::user()->id,
            'name'=>$request->userName,
            'email'=>$request->userEmail,
            'subject'=>$request->userSubject,
            'message'=>$request->userMessage
        ];
    }
}
