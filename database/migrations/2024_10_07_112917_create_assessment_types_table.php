<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('assessment_types', function (Blueprint $table) {
            $table->id('assessment_type_id'); // Primary key for assessment types
            $table->string('assessment_type_name'); // e.g., Quiz 1, Activity 1
            $table->integer('total_scores'); // assessment types score
            $table->unsignedBigInteger('assessment_id'); // Foreign key to link to assessments
            $table->timestamps();
    
            // Foreign key constraint linking to the assessments table
            $table->foreign('assessment_id')->references('assessment_id')->on('assessments')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('assessment_types');
    }
    
};
