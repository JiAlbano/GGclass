<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id('score_id'); // Primary key
            $table->unsignedBigInteger('student_id'); // Foreign key to link to students
            $table->unsignedBigInteger('assessment_type_id'); // Foreign key to link to assessment types
            $table->integer('score'); // Student's score
            $table->timestamps();
    
            // Foreign key constraints
            $table->foreign('student_id')->references('school_id')->on('students')->onDelete('cascade');
            $table->foreign('assessment_type_id')->references('assessment_type_id')->on('assessment_types')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('scores');
    }
    
};
