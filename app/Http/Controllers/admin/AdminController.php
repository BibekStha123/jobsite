<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $user = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (auth()->attempt($user) && Auth::user()->is_admin) {
            $request->session()->regenerate();

            return redirect('/admin/dashboard')->with('message', 'Logged in successfully!!');
        }

        return back()->withErrors(['password' => 'Invalid Credentials'])->onlyInput('password');
    }

    public function dashboard()
    {
        return view('admin.dashboard',[
            'usersCount' => User::where('is_admin', false)->get()->count(),
            'listingsCount' => Listing::count()
        ]);
    }
}
