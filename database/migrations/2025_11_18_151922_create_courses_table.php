<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
           $table->id();

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('instructor_id');

            $table->boolean('is_free')->default(0);

            $table->string('course_image')->nullable();
            $table->string('course_name')->nullable();
            $table->string('course_name_slug')->nullable();
            $table->string('course_title')->nullable();
            $table->longText('description')->nullable();
            $table->string('video_url')->nullable();
            $table->string('course_level')->nullable();
            $table->string('course_duration')->nullable();
            $table->string('resources')->nullable();
            $table->string('certificate')->nullable();
            $table->string('certificate_template')->nullable();

           $table->decimal('selling_price', 10, 2)->nullable();
            $table->decimal('discount_price', 10, 2)->nullable();


            $table->string('bestseller')->nullable();
            $table->string('featured')->nullable();
            $table->string('highestrated')->nullable();

            $table->float('average_rating', 2, 1)->default(0);
            $table->integer('preview_count')->default(1);
            $table->integer('pass_score')->default(60);

           $table->tinyInteger('status')
                ->default(0)
                ->comment('0 = Inactive, 1 = Active');


            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
