<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Answer extends Eloquent
{
<<<<<<< HEAD
<<<<<<< HEAD
        public function questions()
    {
    	return $this->belongsTo(Question::class);
=======
=======
    protected $fillable = ['text', 'compliant'];

>>>>>>> 50c52ec6e98088a81025cc85cd41f5b3bf90d916
    public function question()
    {
        return $this->belongsTo(Question::class);
>>>>>>> 9c4a31022ccf6b01295d4d39b5a10459525a55bd
    }
}
