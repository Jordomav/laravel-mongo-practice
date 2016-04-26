<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Question;
use App\Questionnaire;
use App\Answer;
use DB;
use Illuminate\Http\Request;


class QuestionnaireController extends Controller
{

    public function index()
    {
        // Mongolab
        $uri = 'mongodb://heroku_nhdqq3wv:8hu1n8gguitftgnql27fte63k1@ds025459.mlab.com:25459/heroku_nhdqq3wv';
        $client = new MongoClient($uri);
        $db = $client->selectDB('heroku_nhdqq3wv');

        // This will work differently when we have users set up. For now we check if we've already copied master list of
        // questions to a questionnaire object.
        if ($db->questionnaires->first()) {

            $questionnaire = $db->questionnaires->first();

        } else {
            
            $questionnaire = new Questionnaire;

            // We actually don't really need this, but hard-code user id for now.
            $questionnaire->user_id = 1;

            foreach ($db->questions->get() as $q) {
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

    // TODO: Probably move the save method to own controller.   
    public function saveQuestion(Request $request)
    {
        $questionnaire = Questionnaire::first();

        $question = Question::create([
            'text' => $request->text,
            'data_type' => $request->data_type,
            'default_question' => $request->default_question,
            'help_url' => $request->help_url
        ]);

        if ($question->data_type === 'range') {
            $answer = Answer::create([
                'text' => $request->answers['text'],
                'compliant_range' => $request->answers['compliant_range']
            ]);
            $question->answers()->associate($answer);

        } else {
            foreach($request->answers as $answer) {
                $answer = Answer::create([
                    'text' => $answer['text'],
                    'compliant' => $answer['compliant']
                ]);
                $question->answers()->associate($answer);
            }
        }

        $questionnaire->questions()->associate($question);
        $questionnaire->save();
    }

    public function deleteQuestion(Request $request) {
        $questionnaire = Questionnaire::first();
        $question = $questionnaire->questions()->where('_id', $request->_id)->first();
        $question->delete();
    }
}