<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id');
            $table->string('class_name');
            $table->string('subject');
            $table->string('section');
            $table->string('schedule');
            $table->string('room');
            $table->string('image_path')->nullable(); // For the class image
            $table->string('class_code')->unique(); // Add unique class code
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}

