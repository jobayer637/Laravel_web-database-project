<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Blogcategory;
use App\Questioncategory;
use App\Question;
use App\Blog;
class AdminController extends Controller
{
    function admin(){
        $users = User::all();
        $blogCategorirs = Blogcategory::all();
        $questionCategories = Questioncategory::all();
        $questions = Question::latest()->get();
        $blogs = Blog::latest()->get();
        return view('admin.admin', compact('users','blogCategorirs','questionCategories','questions','blogs'));
    }
}