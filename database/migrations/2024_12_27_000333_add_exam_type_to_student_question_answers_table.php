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
        Schema::table('student_question_answers', function (Blueprint $table) {
            $table->enum('exam_type', ['prelim', 'midterm', 'prefinal', 'final'])->nullable()->after('challenge_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_question_answers', function (Blueprint $table) {
            $table->dropColumn('exam_type');
        });
    }
};
