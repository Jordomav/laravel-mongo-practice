<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Question;
use DB;
use Illuminate\Http\Request;
use App\Questionnaire;

class QuestionnaireController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        if (Questionnaire::first()){
            $questionnaire = Questionnaire::first();
            $questions = $questionnaire->questions;
        } else {
            $questionnaire = new Questionnaire;
            $questionnaire->user_id = 1;
            $questionnaire->save();

            foreach (Question::all() as $q){
                $questionnaire->questions()->associate($q);
            }
        }
        return $questionnaire->questions;
    }
    public function saveAnswer(Request $request){

    }
}