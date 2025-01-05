<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamScoresTable extends Migration
{
    public function up()
    {
        Schema::create('exam_scores', function (Blueprint $table) {
            $table->id('score_id');
            $table->unsignedBigInteger('student_id');
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade');
            $table->integer('score');
            $table->boolean('token_used')->default(false);
            $table->integer('total_score')->nullable();
            $table->timestamps();
            $table->foreign('student_id')->references('school_id')->on('students')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('exam_scores');
    }

};
