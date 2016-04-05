<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use MongoDB;
use DB;
use App\Answer;
use App\Question;

class QuestionnaireController extends Controller
{
    public function index(){
        return Question::all();
    }
}
