<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->enum('exam_type', ['prelim', 'midterm', 'prefinal', 'final']); // Correct enum definition
            $table->boolean('enable_token')->default(false);
            $table->integer('time_duration')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exams');
    }
};
