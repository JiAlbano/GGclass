<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained('quizzes')->onDelete('cascade');
            $table->text('question');
            $table->string('type'); // e.g., multipleChoice, trueFalse, identification
            $table->json('options')->nullable(); // Store multiple choice options as JSON if needed
            $table->string('answer_key')->nullable(); // Store the answer key for MCQs
            $table->string('correct_answer')->nullable(); // For true/false and identification
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
}

