<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Question extends Eloquent
{
    protected $collection = 'questions';
    protected $connection = 'mongodb';
    protected $fillable = ['text', 'help_url', 'data_type', 'default_question', 'selected_answer', 'answers'];
    protected $attributes = ['selected_answer' => ''];

    public function answers()
    {
        return $this->embedsMany(Answer::class);
    }

    public function questionnaire()
    {
        return $this->hasOne(Questionnaire::class);
    }
}
