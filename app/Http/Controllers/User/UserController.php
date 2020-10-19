<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function dashboard(){
        $users = User::all();
        return view('user.dashboard', compact('users'));
    }
}
