<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->timestamps();
            $collection->string('text'); // The text for the Question
            $collection->string('help_url'); // The URL to go to for more information
            $collection->string('data_type'); //The type of Answers this Question will have(multiple_choice, true_false, number)
            $collection->boolean('default_question'); //The correct Answer for the Question
            $collection->string('selected_answer');
            //Answers Document tagged onto Questions Document in Mongo under 'answers' Method - (Question->associate(Answers)).
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('questions');
    }
}
