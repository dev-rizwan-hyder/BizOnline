<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function showLoginForm(Request $request){
        return view("auth.login");
    }

    public function login(Request $request){

        $request->validate([
            "email"=> "required",
            "password"=> "required",
        ]);

        $credentials = $request->only("email","password");
        if(Auth::attempt($credentials)){
            $request->session()->regenerate(); 
            $role = Auth::user()->role;
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'employee') {
                return redirect()->route('employee.dashboard');
            }
            return redirect('/');
        }else{
            return back()->withErrors(['email' => 'Invalid credentials']);
        }


    }

    public function logout(Request $request){

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}

