<?php
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Auth;
use App\Apikey;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function UserRegister(Request $request)
    {
        if(empty($request->name) || strlen($request->name)<3){
            return "Name at least 3 char and not be null";
        }else if(empty($request->email)){
            return "Please Enter Email Address";
        }else if(User::where('email',$request->email)->first('email')){
            return "This emial already exists";
        }else if(strlen($request->password)<8 || empty($request->password)){
            return "Password at least 8 char and not be null";
        }else{
            $validInfo = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        
        $newUser = new User;
            $newUser->name = $request->name;
            $newUser->email = $request->email;
            $newUser->password = Hash::make($request->password);
            $newUser->save();
            return $newUser;
        }
    }
}

    