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
        Schema::create('lessons', function (Blueprint $table) {
             $table->id();
            $table->integer('course_id')->nullable();
            $table->unsignedBigInteger('section_id');
            $table->string('lecture_title')->nullable();
            $table->string('url')->nullable();
            $table->text('content')->nullable();
            $table->decimal('video_duration', 8, 2)->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_preview')->default(false);
            $table->string('video_url')->nullable();    // youtube link
            $table->string('video_file')->nullable();   // upload path (disk public)
            $table->string('lesson_file')->nullable();
            $table->string('lesson_document_link')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();

             // Add foreign key constraint
             $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');

             });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
