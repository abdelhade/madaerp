<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $itemId = DB::table('items')->insertGetId([
            'name' => 'Test Item',
            'code' => 1001,
            'info' => 'This is a test item',
            'tenant' => 1,
            'branch' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // الوحدة الأساسية (قطعة مثلاً)
        $unit = DB::table('units')->first();
        $price = DB::table('prices')->first();

        // نضيف وحدة كرتونة لو مش موجودة
        $cartonUnit = DB::table('units')->where('name', 'كرتونة')->first();
        if (!$cartonUnit) {
            $cartonUnitId = DB::table('units')->insertGetId([
                'name' => 'كرتونة',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $cartonUnit = DB::table('units')->find($cartonUnitId);
        }

        if (!$unit || !$price || !$cartonUnit) {
            $this->command->error("Please seed units and prices first.");
            return;
        }

        // قطعة = وحدة أساسية
        DB::table('item_units')->insert([
            [
                'item_id' => $itemId,
                'unit_id' => $unit->id,
                'u_val' => 1,
                'cost' => 50.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => $itemId,
                'unit_id' => $cartonUnit->id,
                'u_val' => 12,
                'cost' => 600.00, // 12 * 50 = 600 مثلاً
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // أسعار
        DB::table('item_prices')->insert([
            [
                'item_id' => $itemId,
                'price_id' => $price->id,
                'unit_id' => $unit->id,
                'price' => 100.00,
                'discount' => 10.00,
                'tax_rate' => 5.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => $itemId,
                'price_id' => $price->id,
                'unit_id' => $cartonUnit->id,
                'price' => 1100.00, // سعر الكرتونة بعد ربح
                'discount' => 100.00,
                'tax_rate' => 5.00,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
