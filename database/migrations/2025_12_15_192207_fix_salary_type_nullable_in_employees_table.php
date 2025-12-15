<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Make salary_type nullable to allow creating employees without specifying salary type
            $table->enum('salary_type', [
                'ساعات عمل فقط',
                'ساعات عمل و إضافي يومى',
                'ساعات عمل و إضافي للمده',
                'حضور فقط',
                'إنتاج فقط',
                'ثابت + ساعات عمل مرن'
            ])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Set default value before making it not nullable
            DB::statement("UPDATE employees SET salary_type = 'ساعات عمل فقط' WHERE salary_type IS NULL");
            
            $table->enum('salary_type', [
                'ساعات عمل فقط',
                'ساعات عمل و إضافي يومى',
                'ساعات عمل و إضافي للمده',
                'حضور فقط',
                'إنتاج فقط',
                'ثابت + ساعات عمل مرن'
            ])->nullable(false)->change();
        });
    }
};
