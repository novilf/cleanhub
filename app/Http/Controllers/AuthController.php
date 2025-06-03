<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function register(Request $request)
{
    $request->validate([
        'email' => 'required|email|unique:users,email',
        'phone_number' => 'required',
        'account_number' => 'required',
        'password' => 'required|confirmed', // pastikan ada 'password_confirmation' juga
        'laundry_name' => 'required',
        'laundry_address' => 'required',
        'description' => 'required',
    ]);

    User::create([
        'email' => $request->email,
        'phone_number' => $request->phone_number,
        'account_number' => $request->account_number,
        'password' => $request->password,
        'laundry_name' => $request->laundry_name,
        'laundry_address' => $request->laundry_address,
        'description' => $request->description,
    ]);

    return redirect('/')->with('success', 'Registration successful. Please login.');
}
public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('admin/dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}


}
