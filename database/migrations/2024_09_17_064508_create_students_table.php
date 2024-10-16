<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            // Define the columns of the table
            $table->unsignedBigInteger('school_id')->primary();   
            $table->string('full_name');            
            $table->string('in_game_name');          
            $table->string('email')->unique();      
            $table->string('course');                
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
        Schema::dropIfExists('students');
    }
}
