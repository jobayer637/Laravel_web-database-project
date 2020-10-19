<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Question;
use App\Questioncategory;
use App\Apikey;

class QuestionController extends Controller
{
    public function getMethod(Request $req){
       $ques = Question::all();
            $response = [];
            foreach($ques as $key=>$ques){
                $response[$key] = [
                    'category' =>[
                        'id' => $ques->category->id,
                        'category' => $ques->category->name,
                    ],
                    'user' => [
                        'name' => $ques->user->name,
                        'email' => $ques->user->email,
                        'role'=> $ques->user->role->name 
                    ],
                    'question' => [
                        'id' => $ques->id,
                        'question' => $ques->question,
                        'description' => $ques->description,
                        'view' => $ques->view,
                        'created_at' => $ques->created_at,
                        'updated_at' => $ques->updated_at,
                    ],
                ];
            }
            return $response;
    }
}