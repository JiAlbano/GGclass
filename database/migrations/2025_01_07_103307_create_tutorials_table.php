<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tutorials', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('title'); // Tutorial title (required)
            $table->text('description')->nullable(); // Tutorial description (optional)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Author of the tutorial
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade'); // Class association
            $table->timestamps(); // Created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('tutorials');
    }
};
