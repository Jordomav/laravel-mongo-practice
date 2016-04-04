<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Answer extends Eloquent
{
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
