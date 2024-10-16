<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_question_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('question_id');
            $table->integer('challenge_id');
            $table->string('answer');
            $table->integer('student_id');
            $table->boolean('is_correct');
            $table->string('challenge_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_question_answers');
    }
};
