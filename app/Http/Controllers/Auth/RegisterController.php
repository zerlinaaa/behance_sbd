<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        Session::put('register_step_1', [
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('register2.show');
    }

    public function register2(Request $request)
    {
        $request->validate([
            'first_name'  => 'required|string|max:50',
            'last_name'   => 'required|string|max:50',
            'birth_month' => 'required|integer|min:1|max:12',
            'birth_year'  => 'required|integer|min:1900|max:'.date('Y'),
            'country'     => 'required|string|max:100',
        ]);

        $step1Data = Session::get('register_step_1');

        if (!$step1Data) {
            return redirect()->route('register');
        }

        try {
            $user = User::create([
                'name'              => $request->first_name . ' ' . $request->last_name,
                'email'             => $step1Data['email'],
                'password'          => $step1Data['password'],
                'email_verified_at' => now(),
            ]);

            auth()->login($user);
            Session::forget('register_step_1');

            return redirect()->route('explore');

        } catch (\Exception $e) {
            return back()->withInput();
        }
    }
}