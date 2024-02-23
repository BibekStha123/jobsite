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
}
