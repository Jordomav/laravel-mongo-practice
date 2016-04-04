<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Question extends Eloquent
{
    public function answers()
    {
<<<<<<< HEAD
    	return $this->embedsMany(Answer::class);
=======
        return $this->embedsMany(Answer::class);
>>>>>>> 9c4a31022ccf6b01295d4d39b5a10459525a55bd
    }
}
