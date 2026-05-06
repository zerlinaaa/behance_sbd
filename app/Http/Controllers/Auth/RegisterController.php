<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name'              => $request->name,
            'username'          => Str::slug($request->username),
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'email_verified_at' => now(),
        ]);

        Auth::login($user);
        return redirect()->route('explore');
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

    // Ambil user yang baru register dari session atau auth
    $user = Auth::user();

    if ($user) {
        $user->update([
            'name'     => $request->first_name . ' ' . $request->last_name,
            'location' => $request->country,
        ]);
    }

    return redirect()->route('explore');
}
}