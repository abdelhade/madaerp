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
        Schema::table('operation_items', function (Blueprint $table) {
            $table->decimal('fat_quantity', 10, 2)->nullable()->after('qty_out');
            $table->decimal('fat_price', 10, 2)->nullable()->after('fat_quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('operation_items', function (Blueprint $table) {
            $table->dropColumn(['fat_quantity', 'fat_price']);
        });
    }
};
