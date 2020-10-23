<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\NewCommentEvent;
use App\Blog;
use App\Comment;

class BlogController extends Controller
{
    public function viewBlog($id=1){
        $blog = Blog::where('id',$id)->with('user')->first();
        return view('viewblog', compact('blog'));
    }
    public function allBlogs()
    {
        return response()
            ->json(Blog::with('user')->latest()->paginate(10));
    }

    public function newComment(Request $req){
        $newCom = new Comment;
        $newCom->user_id = $req->userId;
        $newCom->blog_id = $req->blogId;
        $newCom->comment = $req->comment;
        $newCom->save();
        $newcomment = Comment::where('id',$newCom->id)->with('user')->first();
        event(new NewCommentEvent($newcomment));
        return response()->json($newcomment);
    }

    public function getComment($id){
        $com = Comment::where('blog_id',$id)->with('user')->latest()->get();
        return response()->json($com);
    }

    public function deleteComment($id){
        $delete = Comment::where('id',$id)->delete();
        return $delete;
    }

    public function updateComment(Request $r){
        $update = Comment::find($r->id);
        $update->comment = $r->comment;
        $update->save();
        return  response()->json($update);
    }
}
