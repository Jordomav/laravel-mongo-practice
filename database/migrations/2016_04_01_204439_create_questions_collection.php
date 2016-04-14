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

            // The text for the Question.
            $collection->string('text');

            // The URL to go to for more information.
            $collection->string('help_url');

            // The type of answer input for the question (multiple_choice, true_false, range).
            $collection->string('data_type');

            // Whether or not the question should be displayed by default, or displayed based on the answer to
            // another question.
            $collection->boolean('default_question');

            // Answers array is embedded in Question Document in Mongo under 'answers' method -
            // (Question->associate(Answers)).
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
