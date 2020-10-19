<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Apikey;
use App\User;

class ServiceController extends Controller
{
    public function getUser(Request $req){
        $users = User::all(); 
            $response = [];
            foreach ($users as $i => $user) {
                $response[$i] = [
                    'user' => [
                        'name' => $user->name,
                        'email' => $user->email,
                        'create' => $user->created_at,
                        'update' => $user->updated_at
                    ],
                    'role' => [
                        'role' => $user->role->name
                    ]
                ];
            }
            return json_encode($response);
    }
}
