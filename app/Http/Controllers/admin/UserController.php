<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('admin.user.index', [
            'users' => User::where('is_admin', false)->orderBy('name', 'asc')->paginate(10)
        ]);
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', [
            'user' => $user
        ]);
    }

    public function update(User $user, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect('/users')->with('message', 'User Updated Successfully!!');
    }
}
