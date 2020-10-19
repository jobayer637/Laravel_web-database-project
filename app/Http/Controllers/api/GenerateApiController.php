<?php
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Apikey;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GenerateApiController extends Controller
{
    public function GenerateAPI(Request $req){
        $apikey = new Apikey;
        $apikey->user_id = $req->id;
        $apikey->uniqueKey = $req->id;
        $apikey->key = Hash::make(Str::random(40));
        $apikey->save();
        return response()->json($apikey);
    }

    public function GetAPI(Request $req){
        $key = Apikey::where('user_id',$req->id)->get();
        return response($key);
    }
}
