<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class RegisterTwoController extends Controller
{
    public function show()
    {
        if (!Session::has('register_step_1')) {
            return redirect()->route('register');
        }
        return view('auth.register2');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'  => 'required|string|max:50',
            'last_name'   => 'required|string|max:50',
            'birth_month' => 'required',
            'birth_year'  => 'required',
            'country'     => 'required',
        ]);

        $step1Data = Session::get('register_step_1');

        if (!$step1Data) {
            return redirect()->route('register');
        }

        $user = User::create([
    'name'              => $request->first_name . ' ' . $request->last_name,
    'username'          => Str::slug($request->first_name . $request->last_name . rand(10, 99)), 
    'email'             => $step1Data['email'],
    'password'          => $step1Data['password'],
    'email_verified_at' => now(),
]);

        auth()->login($user);
        Session::forget('register_step_1');

        return redirect()->route('dashboard');
    }
}