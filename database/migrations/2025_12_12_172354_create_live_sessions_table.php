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
        Schema::create('live_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade'); 
            
            $table->string('topic'); 
            $table->text('description')->nullable();
            $table->string('platform')->default('Zoom'); 
            $table->text('meeting_link'); 
            
            $table->dateTime('start_at'); 
            $table->integer('duration_minutes')->default(60); 
            
            
            $table->boolean('is_teacher_joined')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_sessions');
    }
};
