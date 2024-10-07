<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_types', function (Blueprint $table) {
            $table->id();
            $table->string('assessment_id'); // Foreign key to assessments table
            $table->string('assessment_type_name'); // Name of the specific quiz, activity, project, etc.
            $table->integer('total_score'); // Maximum possible score for this assessment type
            $table->timestamps();

            // Foreign key constraint to reference the assessments table
            $table->foreign('assessment_id')->references('assessment_id')->on('assessments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assessment_types');
    }
}
