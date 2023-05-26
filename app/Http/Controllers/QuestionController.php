<?php

namespace App\Http\Controllers;
use App\Models\Question;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index(){
        $questions = Question::latest()->paginate(5);
        return view('questions.index',compact('questions'));
    }

    public function create(){
        $question = new Question();
        return view('questions.create',compact('question'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|string',
            'body' => 'required|string',
        ]);
        $question = new Question();
        $question->title = $request->title;
        $question->slug = str::slug($request->title);
        $question->body = $request->body; 
        $question->user_id = Auth::user()->id; 
        $question->save();

        return redirect()->route('questions.index')->with('success', "Your question has been submitted");
    }
    public function show(Question $question){
        return view('questions.show', compact('question'));
    }

    public function edit(Question $question){
        return view("questions.edit", compact('question'));
    }
    public function update(Request $request, Question $question){
        $this->validate($request,[
            'title' => 'required|string',
            'body' => 'required|string',
        ]);
        $question = Question::find($question->id);
        $question->title = $request->title;
        $question->slug = str::slug($request->title);
        $question->body = $request->body; 
        $question->save();

        $question->update($request->only('title', 'body'));
        return redirect('/questions')->with('success', "Your question has been updated.");
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect('/questions')->with('success', "Your question has been deleted.");
    }
}
