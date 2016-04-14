<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Question extends Eloquent
{
    protected $collection = 'questions';
    protected $connection = 'mongodb';
    protected $fillable = [ 'text', 'help_url', 'data_type', 'default_question',
                            'selected_answer_id', 'answers', 'compliant', 'user_input'];

    protected $attributes = ['selected_answer' => null];

    public function answers()
    {
        return $this->embedsMany(Answer::class);
    }

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }
}
