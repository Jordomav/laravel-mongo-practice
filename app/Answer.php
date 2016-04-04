<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Answer extends Eloquent
{
    public function questions(){
        return $this->belongsTo(Question::class);
    }
}
