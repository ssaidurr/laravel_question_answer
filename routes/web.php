<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\VotableController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/questions');
});

Auth::routes();
Route::middleware('auth')->group(function (){
    
    /*Question*/
    Route::resource('questions', QuestionController::class);

    /*Answers*/
    Route::post('/answers/store/{id}', [AnswerController::class, 'store'])->name('answers.store');
    Route::get('/questions/answers/edit/{q_id}/{a_id}', [AnswerController::class, 'edit'])->name('questions.answers.edit');
    Route::patch('/questions/answers/update/{q_id}/{a_id}', [AnswerController::class, 'update'])->name('questions.answers.update');
    Route::delete('/questions/answers/destroy/{q_id}/{a_id}', [AnswerController::class, 'destroy'])->name('questions.answers.destroy');

    /*Vote*/
    Route::post('/questions/{question}/vote', [VotableController::class, 'question_vote'])->name('invoke.vote.question');
    Route::post('/answers/{answer}/vote', [VotableController::class, 'answer_vote']);

});
