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
        Schema::create('course_quizzes', function (Blueprint $table) {
            $table->id();
           
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade'); 

            $table->string('title');
            $table->longText('description')->nullable();
            
           
            $table->integer('total_marks')->default(0); 
            $table->integer('pass_score')->default(60); 
            $table->integer('duration_minutes')->nullable(); 
            $table->boolean('show_result_immediately')->default(0); 
            
            $table->tinyInteger('status')->default(0); // 0=Draft, 1=Active
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_quizzes');
    }
};
