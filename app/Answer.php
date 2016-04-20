<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Answer extends Eloquent
{
    protected $connection = 'mongodb';

    protected $fillable = ['text', 'compliant'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
