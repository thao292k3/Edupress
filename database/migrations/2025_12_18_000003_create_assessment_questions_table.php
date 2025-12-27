<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('assessment_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instructor_id')->nullable();
            $table->text('question');
            $table->json('options')->nullable();
            $table->string('correct_option')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assessment_questions');
    }
};
