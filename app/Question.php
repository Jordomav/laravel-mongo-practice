<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Question extends Eloquent
{
    protected $fillable = ['text', 'help_url', 'data_type', 'default_question'];


    public function answers()
    {
        return $this->embedsMany(Answer::class);
    }
}
