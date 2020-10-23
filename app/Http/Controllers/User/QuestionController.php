<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\AnswerEvent;
use App\Events\UpdateAnswerEvent;
use App\Events\DeleteAnswerEvent;
use App\Question;
use App\Answer;

class QuestionController extends Controller
{
    public function index($id)
    {
        $question = Question::where('id', $id)->with('user')->first();
        $relQues = Question::where('category_id',$question->category_id)->get();
        return view('viewquestion', compact('question','relQues'));
    }
    public function relatedQuestion($id){
        $rq = Question::where('category_id', $id)->get();
        return response()->json($rq);
    }

    public function getRecentQuestion()
    {
        $questions = Question::latest()->get();
        return response()->json($questions);
    }

    public function getAns($id){
        $ans = Answer::where('question_id',$id)->with('user')->latest()->get();
        return response()->json($ans);
    }
    public function newAns(Request $r){
        $newAns = new Answer;
        $newAns->user_id = $r->id;
        $newAns->question_id = $r->qid;
        $newAns->answer = $r->answer;
        $newAns->save();

        $lastAns = Answer::where('id',$newAns->id)->with('user')->first();
        event(new AnswerEvent($lastAns));
        return response()->json($lastAns);
    }

    public function deleteAns(Request $r, $id){
        $delete = Answer::where('id',$id)->delete();

        event(new DeleteAnswerEvent($id));
        return response()->json($delete);
    }

    public function updateAns(Request $r){
        $ans = Answer::find($r->id);
        $ans->answer = $r->answer;
        $ans->save();

        event(new UpdateAnswerEvent($ans));
        return response()->json($ans);
    }

    
}
