<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Answer extends Eloquent
{
<<<<<<< HEAD
        public function questions()
    {
    	return $this->belongsTo(Question::class);
=======
    public function question()
    {
        return $this->belongsTo(Question::class);
>>>>>>> 9c4a31022ccf6b01295d4d39b5a10459525a55bd
    }
}
