<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', 0)->get();
        return view('admin.user.list', compact('users'));

    }
    public function index2()
    {
        return view('admin.user.checkout');
    }
}
