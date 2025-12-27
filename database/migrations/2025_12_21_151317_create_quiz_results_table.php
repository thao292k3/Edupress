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
        Schema::create('quiz_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
            $table->integer('total_questions');
            $table->integer('correct_answers');
            $table->decimal('score', 5, 2); // Điểm số (ví dụ: 8.5)
            $table->integer('percentage');  // % đạt được (ví dụ: 85)
            $table->enum('status', ['pass', 'fail', 'pending']); // 'pending' dùng cho bài có tự luận
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_results');
    }
};
