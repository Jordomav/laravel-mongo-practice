<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Question extends Eloquent
{
    protected $collection = 'questions';

    protected $fillable = ['text', 'help_url', 'data_type', 'default_question', 'selected_answer'];

    public function answers()
    {
        return $this->embedsMany(Answer::class);
    }

    public function questionnaire()
    {
        return $this->hasOne(Questionnaire::class);
    }
}
