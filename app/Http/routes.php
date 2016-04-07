<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//Initial Screen Load
Route::get('/', function () {
    return view('questionnaire');
});

//Retrieves all 'Questions' and their subsequent 'Answers'- QuestionnaireController.php(index)
Route::get('get-questions', 'QuestionnaireController@index');

//Posts 'Answer' Responses to the Database- AnswersController.php(post)
Route::post('post-answer', 'QuestionnaireController@saveAnswer');

