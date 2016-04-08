
 <?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Answer extends Eloquent
{
    protected $connection = 'mongodb';

    protected $fillable = ['text', 'compliant', 'selected_answer'];

    public function question()
    {
        return $this->hasOne(Question::class);
//        Belongs to many Questions (Is Embeded into a Question)
    }
}
