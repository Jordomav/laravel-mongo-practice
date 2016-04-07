<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Questionnaire extends Eloquent
{
    protected $collection = 'questionnaires';
    protected $fillable = ['user_id', 'compliant'];
    protected $attributes = ['compliant' => false];


    public function questions()
    {
        return $this->embedsMany(Question::class);
    }
}
