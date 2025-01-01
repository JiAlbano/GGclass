<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamQuestionAnswersTable extends Migration
{
    public function up()
    {
        Schema::create('exam_question_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade');
            $table->foreignId('question_id')->constrained('exam_questions')->onDelete('cascade');
            $table->string('answer');
            $table->unsignedBigInteger('student_id');
            $table->boolean('is_correct');
            $table->timestamps();
            $table->foreign('student_id')->references('school_id')->on('students')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('exam_question_answers');
    }
};