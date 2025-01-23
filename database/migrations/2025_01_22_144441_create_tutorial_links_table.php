<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tutorial_links', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('tutorial_id')->constrained()->onDelete('cascade'); // Link to the tutorial
            $table->string('url'); // URL of the link
            $table->timestamps(); // Created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutorial_links');
    }
};
