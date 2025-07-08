<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmployeesExpenssesToAccHeadTable extends Migration
{
    public function up(): void
    {
        Schema::table('acc_head', function (Blueprint $table) {
            $table->boolean('employees_expensses')->nullable()->after('rentable');
        });
    }

    public function down(): void
    {
        Schema::table('acc_head', function (Blueprint $table) {
            $table->dropColumn('employees_expensses');
        });
    }
}
