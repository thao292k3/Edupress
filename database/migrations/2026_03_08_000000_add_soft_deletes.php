<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('quizzes', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('coupons', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('coupons', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
