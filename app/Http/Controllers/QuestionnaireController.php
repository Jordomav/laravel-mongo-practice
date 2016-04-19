<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Question;
use App\Questionnaire;
use DB;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{

    public function index()
    {
        // This will work differently when we have users set up. For now we check if we've already copied master list of
        // questions to a questionnaire object.
        if (Questionnaire::first()) {

            $questionnaire = Questionnaire::first();

        } else {
            
            $questionnaire = new Questionnaire;

            // We actually don't really need this, but hard-code user id for now.
            $questionnaire->user_id = 1;

            foreach (Question::all() as $q) {
                $questionnaire->questions()->associate($q);
            }

            $questionnaire->save();
        }

        return $questionnaire->questions;
    }

    public function saveAnswer(Request $request)
    {
        // For now, we are hard-coding a Questionnaire.
        $questionnaire = Questionnaire::first();

        $question = $questionnaire->questions()->where('_id', $request->id)->first();

        $question->update([
            'selected_answer_id' => $request->selected_answer_id,
            'compliant' => $request->compliant,
            'user_input' => $request->user_input
        ]);
    }

    public function addQuestion(Request $request)
    {
        $questionnaire = Questionnaire::first();

        $question = Question::create([
            'text' => $request->text,
            'data_type' => $request->data_type,
            'default_question' => $request->default_question,
            'help_url' => $request->help_url
        ]);





    }
}