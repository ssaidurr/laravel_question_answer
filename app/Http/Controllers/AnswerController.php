<?php

namespace App\Http\Controllers;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store($id,Request $request){
        $this->validate($request,[
            'body' => 'required|string',
        ]);
        $answer = new Answer();
        $answer->question_id = $id; 
        $answer->body = $request->body; 
        $answer->user_id = \Auth::id(); 
        $answer->save();

        return back()->with('success', "Your answer has been submitted successfully");
    }
    public function edit($q_id,$a_id){
        $question = Question::find($q_id);
        $answer = Answer::find($a_id);
        return view('answers.edit', compact('question', 'answer'));
    }
    public function update(Request $request, $q_id, $a_id){
        $this->validate($request,[
            'body' => 'required|string',
        ]);
        $answer = Answer::find($a_id);
        $answer->body = $request->body; 
        $answer->save();

        return redirect()->route('questions.show', $q_id)->with('success', 'Your answer has been updated');
    }

    public function destroy($q_id, $a_id){
        Answer::find($a_id)->delete();
        return back()->with('success', "Your answer has been removed");
    }
}
