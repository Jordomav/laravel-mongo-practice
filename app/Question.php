<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Question extends Eloquent
{

    public function answers(){
        return $this->embedsMany(Answer::class);
    }
}
