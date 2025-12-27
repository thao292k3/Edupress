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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instructor_id')->constrained('users');
            $table->string('payroll_month'); // VD: "12-2025"
            $table->decimal('fixed_salary', 15, 2)->default(0);      // Lương cứng
            $table->decimal('support_fee', 15, 2)->default(0);      // Phí giải đáp/buổi dạy
            $table->decimal('course_revenue', 15, 2)->default(0);   // Hoa hồng khóa học
            $table->integer('student_count')->default(0);           // Số học sinh mới
            $table->decimal('total_amount', 15, 2);                 // Tổng lương thực nhận
            $table->string('bank_receipt')->nullable();             // Ảnh/File xác nhận ngân hàng
            $table->enum('status', ['draft', 'sent_to_instructor', 'approved', 'paid'])->default('draft');
            $table->text('admin_note')->nullable();                 // Ghi chú của Admin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
