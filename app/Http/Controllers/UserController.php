<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;

class UserController extends Controller
{
    public static function create()
    {
        return view('users.register');
    }

    public static function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['email', 'required', Rule::unique('users','email')],
            'password' => ['required','confirmed', 'min:8', 'max:255']
        ]);

          $formFields['password'] = bcrypt($formFields['password']);

          $user = User::create($formFields);

          auth()->login($user);

        return redirect('/')->with('success', 'Account created successfully!');
    }


    public static function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You have been logged out!');
    }


    public static function login()
    {
        return view('users.login');
    }

    public static function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['email', 'required'],
            'password' => ['required']
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials!',
        ]);
    }


}
