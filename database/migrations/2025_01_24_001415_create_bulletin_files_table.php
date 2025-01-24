<?php
// database/migrations/2025_01_22_143101_create_bulletin_file_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('bulletin_files', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('bulletin_id')->constrained()->onDelete('cascade'); // Link to the bulletin
            $table->string('file_path'); // Path to the uploaded file
            $table->string('file_type'); // Type of the uploaded file (e.g., doc, pdf, image)
            $table->string('filename'); // Original filename
            $table->timestamps(); // Created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('bulletin_files');
    }
};