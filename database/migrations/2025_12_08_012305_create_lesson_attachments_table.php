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
        Schema::create('lesson_attachments', function (Blueprint $table) {
        $table->id();

        $table->foreignId('lesson_id')
              ->constrained('lessons')
              ->onDelete('cascade');

        
        $table->string('file_path')->nullable();
        $table->string('file_name')->nullable();
        $table->string('link_url')->nullable();

        $table->enum('type', ['file', 'link']);

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_attachments');
    }
};
