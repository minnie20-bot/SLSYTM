<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
 public function login()
 {
    // Hash::make(123456);
    //die;

    return view('auth.login');
 }

 public function auth_login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt([
        'email' => $request->email,
        'password' => $request->password,
        'is_delete' => 0
    ], true)) {

        return redirect('panel/dashboard');
    }

    return redirect()->back()->with('error', "Please enter correct email and password");
}

public function forgot()
{
    return view('auth.forgot');
}
 }

