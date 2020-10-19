<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
class CheckmailController extends Controller
{
    public function Check(Request $r){
        $c = User::where('email',$r->email)->get();
        $s = sizeof($c);
        return response()->json($s);
    }
}
