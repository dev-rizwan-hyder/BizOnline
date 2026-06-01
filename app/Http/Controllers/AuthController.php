<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function test(Request $request){
        return view("login");
    }

    public function login(Request $request){

        $request->validate([
            "email"=> "required",
            "password"=> "required",
        ]);

        $credentials = $request->only("email","password");
        if(Auth::attempt($credentials)){
            $request->session()->regenerate(); 
        return redirect()->intended('test')->with('success', 'Logged in successfully');
        }else{
            return 'wrong credentials ';
        }


    }

    public function logout(){

        Auth::logout();

        return auth()->user();
    }

}

