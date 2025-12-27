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
        Schema::create('lesson_progress', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('user_id'); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            
            $table->unsignedBigInteger('lesson_id'); 
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
            
            $table->integer('watched_time')->default(0);
            
            $table->boolean('is_completed')->default(0); 
            
           
            $table->timestamp('completed_at')->nullable(); 

            
            $table->unique(['user_id', 'lesson_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_progress');
    }
};
