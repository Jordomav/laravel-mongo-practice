<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Answer extends Eloquent
{
    protected $fillable = ['text', 'compliant'];

    public function question()
    {
        return $this->belongsTo(Question::class);
//        Belongs to many Questions (Is Embeded into a Question)
    }
}
