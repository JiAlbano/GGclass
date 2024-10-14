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
        Schema::create('student_challenge_scores', function (Blueprint $table) {
            $table->id();
            $table->integer('challenge_id');
            $table->integer('student_id');
            $table->integer('score');
            $table->integer('token_used');
            $table->integer('total_score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_challenge_scores');
    }
};
