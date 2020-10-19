<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Blog;
use App\Blogcategory;
use App\Apikey;

class BlogController extends Controller
{
    public function getBlog(){
        $blog = Blog::all();
            $response = [];
            foreach($blog as $key=>$blog){
                $response[$key] = [
                    'category' =>[
                        'id' => $blog->category->id,
                        'category' => $blog->category->name,
                    ],
                    'user' => [
                        'name' => $blog->user->name,
                        'email' => $blog->user->email,
                        'role'=> $blog->user->role->name 
                    ],
                    'blog' => [
                        'id' => $blog->id,
                        'title' => $blog->title,
                        'body' => $blog->body,
                        'view' => $blog->view,
                        'created_at' => $blog->created_at,
                        'updated_at' => $blog->updated_at,
                    ],
                ];
            }
            return $response;
    }
}
