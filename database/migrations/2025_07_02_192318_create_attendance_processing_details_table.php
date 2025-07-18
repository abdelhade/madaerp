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
        Schema::create('attendance_processing_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendance_processing_id')->constrained('attendance_processings')->onDelete('cascade');
            $table->foreignId('employee_id')->constrained('employees')->onDelete('restrict');
            $table->foreignId('department_id')->constrained('departments')->onDelete('restrict');
            $table->date('attendance_date')->required();
            $table->decimal('attendance_basic_hours_count')->required();
            $table->decimal('attendance_actual_hours_count')->required();
            $table->decimal('attendance_overtime_hours_count')->required()->default(0.00);
            $table->decimal('attendance_late_hours_count')->required()->default(0.00);
            $table->decimal('attendance_total_hours_count')->required();
            $table->timestamps();
            //index
            $table->index('attendance_processing_id');
            $table->index('employee_id');
            $table->index('department_id');
            $table->index('attendance_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_processing_details');
    }
};
