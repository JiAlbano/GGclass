<?php
// database/migrations/2025_01_22_143101_create_tutorial_files_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tutorial_files', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('tutorial_id')->constrained()->onDelete('cascade'); // Link to the tutorial
            $table->string('file_path'); // Path to the uploaded file
            $table->string('file_type'); // Type of the uploaded file (e.g., doc, pdf, image)
            $table->string('filename'); // Original filename
            $table->timestamps(); // Created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('tutorial_files');
    }
};