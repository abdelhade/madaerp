<?php

namespace App\Helpers;

use App\Models\Item;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ItemViewModel
{
    private $item;
    private $selectedUnitId;

    public function __construct(Item $item, ?int $selectedUnitId)
    {
        $this->item = $item;
        $this->selectedUnitId = $selectedUnitId;
    }

    public function getUnitOptions(): array
    {
        return $this->item->units->map(function ($unit) {
            return [
                'value' => $unit->id,
                'label' => $unit->name . ' [' . number_format($unit->pivot->u_val) . ']',
            ];
        })->toArray();
    }

    public function getCurrentUnitQuantity(): float
    {
        // if ($this->selectedStoreId === 'all') {
        //     $currentQuantity = 0;
        //     foreach ($this->item->stores as $store) {
        //         $startQuantity = $store->pivot->start_quantity ?? 0;
        //         $quantityIn = $store->pivot->quantity_in ?? 0;
        //         $quantityOut = $store->pivot->quantity_out ?? 0;
        //         $currentQuantity += $startQuantity + $quantityIn - $quantityOut;

        //     }
        //     return $currentQuantity;
        // }

        // foreach ($this->item->stores as $store) {
        //     if ($store->id == $this->selectedStoreId) {
        //         $startQuantity = $store->pivot->start_quantity ?? 0;
        //         $quantityIn = $store->pivot->quantity_in ?? 0;
        //         $quantityOut = $store->pivot->quantity_out ?? 0;
        //         $currentQuantity += $startQuantity + $quantityIn - $quantityOut;
        //     }
        // }

        $itemRows = DB::table('operation_items')->where('item_id', $this->item->id)->where('unit_id', $this->item->units->first()->pivot->u_val)->get();
        $currentQuantity = $itemRows->sum('qty_in') - $itemRows->sum('qty_out');
        return $currentQuantity;
    }

    public function getFormattedQuantity(): array
    {
        $selectedUnit = $this->item->units->firstWhere('id', $this->selectedUnitId);
        $baseUnitQuantity = $this->getCurrentUnitQuantity();
        $unitValue = $selectedUnit->pivot->u_val ?? 1;
        $unitName = $selectedUnit->name ?? '';
        $smallerUnitName = $this->item->units->firstWhere('pivot.u_val', 1)->name ?? 'Default Unit';

        $largerUnitQuantity = floor($baseUnitQuantity / $unitValue);
        $remainderQuantity = $baseUnitQuantity % $unitValue;
        // \dd($largerUnitQuantity, $remainderQuantity, $unitName, $smallerUnitName);

        return [
            'quantity' => [
                'integer' => $largerUnitQuantity,
                'remainder' => $remainderQuantity
            ],
            'unitName' => $unitName,
            'smallerUnitName' => $smallerUnitName,
        ];
    }

    public function getUnitBarcode(): array
    {
        return $this->item->barcodes->where('unit_id', $this->selectedUnitId)->map(function ($barcode) {
            return [
                'id' => $barcode->id,
                'barcode' => $barcode->barcode,
            ];
        })->toArray();
    }

    public function getUnitCostPrice(): float
    {
        return $this->item->units->firstWhere('id', $this->selectedUnitId)->pivot->cost ?? 0;
    }

    public function getQuantityCost(): float
    {
        return $this->getCurrentUnitQuantity() * $this->getUnitCostPrice();
    }

    public function getUnitSalePrices(): array
    {
        if (!$this->selectedUnitId) {
            return []; // Return empty if no unit is selected
        }
        return $this->item->prices
            ->where('pivot.unit_id', $this->selectedUnitId) // Filter by selected unit
            ->mapWithKeys(function ($priceTypeModel) {
                // $priceTypeModel is an instance of Price (the price type, e.g., "Retail", "Wholesale")
                // $priceTypeModel->pivot contains the actual price for this item, for this unit, for this price type.
                return [
                    $priceTypeModel->id => [ // Key by PriceType ID
                        'name' => $priceTypeModel->name, // Name of the price type
                        'price' => $priceTypeModel->pivot->price, // Actual price value
                    ]
                ];
            })->toArray();
    }
}
