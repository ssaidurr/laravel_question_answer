<?php

namespace App\Http\Controllers;
use App\Models\Votable;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VotableController extends Controller
{
    public function question_vote($question,Request $request){
        $vote = $request->vote;
        $id = $question;
        $this->_vote($id,'App\Models\Question',$vote);
        return back();
    }
    public function answer_vote($answer,Request $request){
        $vote = $request->vote;
        $id = $answer;
        $this->_vote($id,'App\Models\Answer',$vote);
        return back();
    }
    public function _vote($id,$model_path,$vote){
        if(Votable::where('user_id',Auth::user()->id)->where('votable_id',$id)->where('votable_type',$model_path)->exists()){
            $votable = Votable::where('user_id',Auth::user()->id)->where('votable_id',$id)->where('votable_type',$model_path)->first();
            if($votable->vote != $vote){
                $this->counts($model_path,$vote,$id);
            }
            $votable->vote  = $vote;
            $votable->save();
        }else{
            $votable = new Votable;
            $votable->user_id  = Auth::user()->id;
            $votable->votable_id  = $id;
            $votable->votable_type  = $model_path;
            $votable->vote  = $vote;
            $votable->save();

            $this->counts($model_path,$vote,$id);
        }
    }
    public function counts($model,$vote,$id){
        $model_value = $model::find($id);
        $model_value->votes_count = $model_value->votes_count + $vote;
        $model_value->save();
    }
}
