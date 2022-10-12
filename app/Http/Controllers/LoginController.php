<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //Check Admin Home Pg?User Home pg? Function
    public function home(){
        if(Auth::user()->role=='admin'){
            return redirect()->route('category#list');
        }
        if(Auth::user()->role=='user'){
            return redirect()->route('customer#home');
        }
    }
}
