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
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade'); // Reference to user who is a teacher
            $table->string('school_year');
            $table->string('semester');
            $table->string('subject');
            $table->string('section');
            $table->string('schedule_day');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('room');
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

