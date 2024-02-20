<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function register()
    {
        return view('users.register');
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in successfully!!');
    }

    public function login()
    {
        return view('users.login');
    }

    public function authenticateUser(Request $request)
    {
        $user = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if(auth()->attempt($user)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Logged in successfully!!');
        }

        return back()->withErrors(['password' => 'Invalid Credentials'])->onlyInput('password');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Logged out successfully!!');
    }
}
