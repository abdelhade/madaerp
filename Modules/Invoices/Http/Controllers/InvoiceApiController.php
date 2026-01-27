<?php

namespace Modules\Invoices\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Enums\ItemType;
use App\Models\OperHead;
use App\Models\Price;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Modules\Accounts\Models\AccHead;
use Modules\Settings\Models\Currency;
use Modules\Invoices\Models\InvoiceTemplate;
use App\Helpers\ItemViewModel;
use Modules\Invoices\Services\SaveInvoiceService;
use Modules\Invoices\Services\Invoice\DetailValueValidator;
use Modules\Invoices\Services\Invoice\DetailValueCalculator;

/**
 * API Controller for Invoice Operations (JavaScript)
 * Provides RESTful API endpoints for invoice operations
 */
class InvoiceApiController extends Controller
{
    protected $titles = [
        10 => 'Sales Invoice',
        11 => 'Purchase Invoice',
        12 => 'Sales Return',
        13 => 'Purchase Return',
        14 => 'Sales Order',
        15 => 'Purchase Order',
        16 => 'Quotation to Customer',
        17 => 'Quotation from Supplier',
        18 => 'Damaged Goods Invoice',
        19 => 'Dispatch Order',
        20 => 'Addition Order',
        21 => 'Store-to-Store Transfer',
        22 => 'Booking Order',
        24 => 'Service Invoice',
        25 => 'Requisition',
        26 => 'Pricing Agreement',
    ];

    /**
     * Get initial data for creating invoice (returns array for use in views)
     * @param int $type Invoice type
     * @param int|null $branchId Branch ID
     * @param int|null $templateId Specific template ID to use (optional)
     */
    public function getCreateDataArray($type, $branchId = null, $templateId = null)
    {
        if (!isset($this->titles[$type])) {
            return null;
        }

        $user = Auth::user();
        $permissionName = 'create ' . $this->titles[$type];
        if (!($user instanceof User) || !$user->can($permissionName)) {
            return null;
        }

        $branch_id = $branchId;
        if (!$branch_id && function_exists('userBranches')) {
            $branches = userBranches();
            $branch_id = $branches->isNotEmpty() ? $branches->first()->id : null;
        }

        // Load templates
        $availableTemplates = InvoiceTemplate::getForType($type);
        $defaultTemplate = InvoiceTemplate::getDefaultForType($type);
        
        // If specific template_id is provided, use it; otherwise use default
        if ($templateId) {
            $selectedTemplate = $availableTemplates->firstWhere('id', $templateId) 
                ?? $defaultTemplate 
                ?? ($availableTemplates->isNotEmpty() ? $availableTemplates->first() : null);
        } else {
            $selectedTemplate = $defaultTemplate ?? ($availableTemplates->isNotEmpty() ? $availableTemplates->first() : null);
        }
        $selectedTemplateId = $selectedTemplate?->id;

        // Load accounts based on type
        $acc1List = $this->getAcc1List($type, $branch_id);
        $acc2List = $this->getAcc2List($type, $branch_id);
        $employees = $this->getEmployees($branch_id);

        // Get price types
        $priceTypes = \App\Models\Price::pluck('name', 'id')->toArray();

        // Get next pro_id
        $maxProId = OperHead::where('pro_type', $type)->max('pro_id');
        $nextProId = ($maxProId ?? 0) + 1;

        // Get branches if function exists
        $branches = collect();
        if (function_exists('userBranches')) {
            $branches = userBranches();
        }

        // Optimize: Load balances for all accounts at once
        $accountIds = $acc1List->pluck('id')->toArray();
        $balances = [];
        if (!empty($accountIds)) {
            $balanceData = DB::table('journal_details')
                ->whereIn('account_id', $accountIds)
                ->where('isdeleted', 0)
                ->select('account_id', DB::raw('SUM(debit) as total_debit'), DB::raw('SUM(credit) as total_credit'))
                ->groupBy('account_id')
                ->get()
                ->keyBy('account_id');
            
            foreach ($accountIds as $accountId) {
                $data = $balanceData->get($accountId);
                $balances[$accountId] = ($data->total_debit ?? 0) - ($data->total_credit ?? 0);
            }
        }

        // Load accounts with currency relationships (if multi-currency enabled)
        $accountsWithCurrency = collect();
        if (function_exists('isMultiCurrencyEnabled') && isMultiCurrencyEnabled() && !empty($accountIds)) {
            $accountsWithCurrency = AccHead::with('currency.latestRate')
                ->whereIn('id', $accountIds)
                ->get()
                ->keyBy('id');
        }
        
        $defaultCurrency = function_exists('getDefaultCurrency') ? getDefaultCurrency() : null;
        $isMultiCurrency = function_exists('isMultiCurrencyEnabled') && isMultiCurrencyEnabled();

        // Load cash accounts (safes and banks)
        // Order: Cash Boxes (acc_type = 3) first, then Banks (acc_type = 4)
        $cashAccounts = AccHead::where('isdeleted', 0)
            ->where('is_basic', 0)
            ->whereIn('acc_type', [3, 4]) // 3 = Cash Box (صندوق), 4 = Bank (بنك)
            ->select('id', 'aname', 'code', 'acc_type')
            ->orderBy('acc_type') // This will put 3 (cash boxes) before 4 (banks)
            ->orderBy('code')
            ->get();

        return [
            'type' => $type,
            'branch_id' => $branch_id,
            'branches' => $branches->map(fn($b) => [
                'id' => $b->id,
                'name' => $b->name,
            ])->values(),
            'cash_accounts' => $cashAccounts->map(fn($a) => [
                'id' => $a->id,
                'aname' => $a->aname,
                'code' => $a->code,
            ])->values(),
            'available_templates' => $availableTemplates->map(fn($t) => [
                'id' => $t->id,
                'name' => $t->name,
                'visible_columns' => $t->visible_columns ?? [],
                'column_widths' => $t->column_widths ?? [],
                'column_order' => $t->column_order ?? [],
            ])->values(),
            'selected_template_id' => $selectedTemplateId,
            'selected_template' => $selectedTemplate ? [
                'id' => $selectedTemplate->id,
                'name' => $selectedTemplate->name,
                'visible_columns' => $selectedTemplate->visible_columns ?? [],
                'column_widths' => $selectedTemplate->column_widths ?? [],
                'column_order' => $selectedTemplate->getOrderedColumns(),
            ] : null,
            'acc1_list' => $acc1List->map(function($a) use ($balances, $accountsWithCurrency, $defaultCurrency, $isMultiCurrency) {
                $balance = $balances[$a->id] ?? 0;
                $currencyId = null;
                $currencyRate = 1;
                
                if ($isMultiCurrency) {
                    $account = $accountsWithCurrency->get($a->id);
                    if ($account && $account->currency_id && $account->currency) {
                        $currencyId = $account->currency_id;
                        $currencyRate = $account->currency->latestRate->rate ?? 1;
                    } else {
                        $currencyId = $defaultCurrency?->id ?? null;
                        $currencyRate = 1;
                    }
                } else {
                    $currencyId = $defaultCurrency?->id ?? null;
                    $currencyRate = 1;
                }
                
                return [
                    'id' => $a->id,
                    'code' => $a->code,
                    'aname' => $a->aname,
                    'balance' => $balance,
                    'currency_id' => $currencyId,
                    'currency_rate' => $currencyRate,
                ];
            })->values(),
            'acc2_list' => $acc2List->map(fn($a) => [
                'id' => $a->id,
                'code' => $a->code,
                'aname' => $a->aname,
            ])->values(),
            'employees' => $employees->map(fn($e) => [
                'id' => $e->id,
                'code' => $e->code,
                'aname' => $e->aname,
            ])->values(),
            'price_types' => $priceTypes,
            'next_pro_id' => $nextProId,
            'settings' => [
                'default_vat_percentage' => (float) setting('default_vat_percentage', 0),
                'default_withholding_tax_percentage' => (float) setting('default_withholding_tax_percentage', 0),
                'enable_dimensions_calculation' => setting('enable_dimensions_calculation', '0') == '1',
                'dimensions_unit' => setting('dimensions_unit', 'cm'),
                'allow_zero_price_in_invoice' => setting('allow_zero_price_in_invoice', '0') == '1',
                'prevent_negative_invoice' => setting('prevent_negative_invoice', '0') == '1',
                'default_quantity_greater_than_zero' => setting('default_quantity_greater_than_zero', '0') == '1',
                'invoice_use_templates' => setting('invoice_use_templates', '0') == '1',
                'invoice_select_price_type' => setting('invoice_select_price_type', '0') == '1',
                'multi_currency_enabled' => function_exists('isMultiCurrencyEnabled') ? (isMultiCurrencyEnabled() ? '1' : '0') : '0',
            ],
            'currencies' => function_exists('isMultiCurrencyEnabled') && isMultiCurrencyEnabled() 
                ? \Modules\Settings\Models\Currency::all()->map(fn($c) => ['id' => $c->id, 'name' => $c->name, 'rate' => $c->latestRate->rate ?? 1])->values()
                : [],
            'default_currency_id' => function_exists('getDefaultCurrency') 
                ? (getDefaultCurrency()?->id ?? null)
                : null,
        ];
    }

    /**
     * Get initial data for creating invoice (API endpoint)
     */
    public function getCreateData(Request $request)
    {
        $type = (int) $request->get('type');
        $branchId = $request->get('branch_id');
        
        $data = $this->getCreateDataArray($type, $branchId);
        if (!$data) {
            return response()->json(['error' => 'Invalid invoice type or unauthorized'], 400);
        }
        
        return response()->json($data);
    }

    /**
     * Get initial data for editing invoice (returns array for use in views)
     */
    public function getEditDataArray($operationId)
    {
        $operation = OperHead::with(['operationItems.item.units', 'operationItems.item.prices'])
            ->findOrFail($operationId);

        $type = $operation->pro_type;
        $user = Auth::user();
        $permissionName = 'edit ' . ($this->titles[$type] ?? 'Unknown');
        if (!($user instanceof User) || !$user->can($permissionName)) {
            return null;
        }

        // Load templates
        $availableTemplates = InvoiceTemplate::getForType($type);
        $defaultTemplate = InvoiceTemplate::getDefaultForType($type);

        // Get branch_id from operation
        $branch_id = $operation->branch_id ?? null;
        if (!$branch_id && function_exists('userBranches')) {
            $branches = userBranches();
            $branch_id = $branches->isNotEmpty() ? $branches->first()->id : null;
        }

        // Load accounts based on type (same as getCreateData)
        $acc1List = $this->getAcc1List($type, $branch_id);
        $acc2List = $this->getAcc2List($type, $branch_id);
        $employees = $this->getEmployees($branch_id);

        // Get price types
        $priceTypes = \App\Models\Price::pluck('name', 'id')->toArray();

        // Get branches if function exists
        $branches = collect();
        if (function_exists('userBranches')) {
            $branches = userBranches();
        }

        // Optimize: Load balances for all accounts at once
        $accountIds = $acc1List->pluck('id')->toArray();
        $balances = [];
        if (!empty($accountIds)) {
            $balanceData = DB::table('journal_details')
                ->whereIn('account_id', $accountIds)
                ->where('isdeleted', 0)
                ->select('account_id', DB::raw('SUM(debit) as total_debit'), DB::raw('SUM(credit) as total_credit'))
                ->groupBy('account_id')
                ->get()
                ->keyBy('account_id');
            
            foreach ($accountIds as $accountId) {
                $data = $balanceData->get($accountId);
                $balances[$accountId] = ($data->total_debit ?? 0) - ($data->total_credit ?? 0);
            }
        }

        // Load accounts with currency relationships (if multi-currency enabled)
        $accountsWithCurrency = collect();
        if (function_exists('isMultiCurrencyEnabled') && isMultiCurrencyEnabled() && !empty($accountIds)) {
            $accountsWithCurrency = AccHead::with('currency.latestRate')
                ->whereIn('id', $accountIds)
                ->get()
                ->keyBy('id');
        }
        
        $defaultCurrency = function_exists('getDefaultCurrency') ? getDefaultCurrency() : null;
        $isMultiCurrency = function_exists('isMultiCurrencyEnabled') && isMultiCurrencyEnabled();

        // Prepare invoice items
        $invoiceItems = [];
        foreach ($operation->operationItems as $operationItem) {
            $item = $operationItem->item;
            if (!$item) continue;

            $availableUnits = $item->units->map(fn($unit) => [
                'id' => $unit->id,
                'name' => $unit->name,
                'u_val' => $unit->pivot->u_val ?? 1,
            ])->toArray();

            $displayUnitId = $operationItem->fat_unit_id ?: $operationItem->unit_id;
            $uVal = collect($availableUnits)->firstWhere('id', $displayUnitId)['u_val'] ?? 1;

            if (isset($operationItem->fat_quantity) && $operationItem->fat_quantity > 0) {
                $quantity = $operationItem->fat_quantity;
                $price = $operationItem->fat_price ?? ($operationItem->item_price * $uVal);
            } else {
                $baseQty = $operationItem->qty_in > 0 ? $operationItem->qty_in : $operationItem->qty_out;
                $quantity = $uVal > 0 ? $baseQty / $uVal : $baseQty;
                $price = $operationItem->fat_price ?? ($operationItem->item_price * $uVal);
            }

            $invoiceItems[] = [
                'operation_item_id' => $operationItem->id,
                'item_id' => $item->id,
                'unit_id' => $displayUnitId,
                'name' => $item->name,
                'quantity' => $quantity,
                'price' => $price,
                'item_price' => $operationItem->item_price ?? 0,
                'sub_value' => $operationItem->detail_value ?? ($price * $quantity) - ($operationItem->item_discount ?? 0),
                'discount' => $operationItem->item_discount ?? 0,
                'available_units' => $availableUnits,
            ];
        }

        // Calculate current balance for selected account
        $currentBalance = 0;
        if ($operation->acc1) {
            $currentBalance = $balances[$operation->acc1] ?? 0;
        }

        return [
            'type' => $type,
            'branch_id' => $branch_id,
            'branches' => $branches->map(fn($b) => [
                'id' => $b->id,
                'name' => $b->name,
            ])->values(),
            'available_templates' => $availableTemplates->map(fn($t) => [
                'id' => $t->id,
                'name' => $t->name,
            ])->values(),
            'selected_template_id' => $defaultTemplate?->id,
            'acc1_list' => $acc1List->map(function($a) use ($balances, $accountsWithCurrency, $defaultCurrency, $isMultiCurrency) {
                $balance = $balances[$a->id] ?? 0;
                $currencyId = null;
                $currencyRate = 1;
                
                if ($isMultiCurrency) {
                    $account = $accountsWithCurrency->get($a->id);
                    if ($account && $account->currency_id && $account->currency) {
                        $currencyId = $account->currency_id;
                        $currencyRate = $account->currency->latestRate->rate ?? 1;
                    } else {
                        $currencyId = $defaultCurrency?->id ?? null;
                        $currencyRate = 1;
                    }
                } else {
                    $currencyId = $defaultCurrency?->id ?? null;
                    $currencyRate = 1;
                }
                
                return [
                    'id' => $a->id,
                    'code' => $a->code,
                    'aname' => $a->aname,
                    'balance' => $balance,
                    'currency_id' => $currencyId,
                    'currency_rate' => $currencyRate,
                ];
            })->values(),
            'acc2_list' => $acc2List->map(fn($a) => [
                'id' => $a->id,
                'code' => $a->code,
                'aname' => $a->aname,
            ])->values(),
            'employees' => $employees->map(fn($e) => [
                'id' => $e->id,
                'code' => $e->code,
                'aname' => $e->aname,
            ])->values(),
            'price_types' => $priceTypes,
            'invoice_items' => $invoiceItems,
            'acc1_id' => $operation->acc1,
            'acc2_id' => $operation->acc2,
            'emp_id' => $operation->emp_id,
            'pro_date' => $operation->pro_date,
            'accural_date' => $operation->accural_date,
            'pro_id' => $operation->pro_id,
            'serial_number' => $operation->pro_serial,
            'selected_price_type' => $operation->price_list ?? 1,
            'discount_percentage' => $operation->fat_disc_per ?? 0,
            'discount_value' => $operation->fat_disc ?? 0,
            'additional_percentage' => $operation->fat_plus_per ?? 0,
            'additional_value' => $operation->fat_plus ?? 0,
            'subtotal' => $operation->fat_total ?? 0,
            'total_after_additional' => $operation->fat_net ?? 0,
            'vat_percentage' => $operation->vat_percentage ?? 0,
            'vat_value' => $operation->vat_value ?? 0,
            'withholding_tax_percentage' => $operation->withholding_tax_percentage ?? 0,
            'withholding_tax_value' => $operation->withholding_tax_value ?? 0,
            'notes' => $operation->info ?? '',
            'received_from_client' => $operation->paid_from_client ?? 0,
            'currency_id' => $operation->currency_id,
            'currency_rate' => $operation->currency_rate ?? 1,
            'current_balance' => $currentBalance,
            'settings' => [
                'default_vat_percentage' => (float) setting('default_vat_percentage', 0),
                'default_withholding_tax_percentage' => (float) setting('default_withholding_tax_percentage', 0),
                'enable_dimensions_calculation' => setting('enable_dimensions_calculation', '0') == '1',
                'dimensions_unit' => setting('dimensions_unit', 'cm'),
                'allow_zero_price_in_invoice' => setting('allow_zero_price_in_invoice', '0') == '1',
                'prevent_negative_invoice' => setting('prevent_negative_invoice', '0') == '1',
                'default_quantity_greater_than_zero' => setting('default_quantity_greater_than_zero', '0') == '1',
                'invoice_use_templates' => setting('invoice_use_templates', '0') == '1',
                'invoice_select_price_type' => setting('invoice_select_price_type', '0') == '1',
                'multi_currency_enabled' => function_exists('isMultiCurrencyEnabled') ? (isMultiCurrencyEnabled() ? '1' : '0') : '0',
            ],
            'currencies' => function_exists('isMultiCurrencyEnabled') && isMultiCurrencyEnabled() 
                ? \Modules\Settings\Models\Currency::all()->map(fn($c) => ['id' => $c->id, 'name' => $c->name, 'rate' => $c->latestRate->rate ?? 1])->values()
                : collect(),
            'default_currency_id' => function_exists('getDefaultCurrency') 
                ? (getDefaultCurrency()?->id ?? null)
                : null,
        ];
    }

    /**
     * Get initial data for editing invoice (API endpoint)
     */
    public function getEditData($operationId)
    {
        $data = $this->getEditDataArray($operationId);
        if (!$data) {
            return response()->json(['error' => 'Unauthorized or invoice not found'], 403);
        }
        
        return response()->json($data);
    }

    /**
     * Quick create item from invoice
     */
    public function quickCreateItem(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'code' => 'nullable|string|max:50',
        ]);

        $user = Auth::user();
        if (!($user instanceof User) || !$user->can('create item')) {
            return response()->json(['message' => 'غير مصرح لك بإنشاء أصناف'], 403);
        }

        try {
            DB::beginTransaction();

            // Generate unique code if not provided
            $code = $request->input('code');
            if (empty($code)) {
                $maxCode = Item::max('code');
                $code = is_numeric($maxCode) ? (int)$maxCode + 1 : 1;
            }

            // Check if code already exists
            if (Item::where('code', $code)->exists()) {
                $maxCode = Item::max('code');
                $code = is_numeric($maxCode) ? (int)$maxCode + 1 : time();
            }

            // Create item
            $item = Item::create([
                'name' => $request->input('name'),
                'code' => $code,
                'type' => 1, // Default type: مخزني
                'isdeleted' => 0,
            ]);

            // Get default unit (piece)
            $defaultUnit = \App\Models\Unit::where('name', 'like', '%قطعة%')
                ->orWhere('name', 'like', '%حبة%')
                ->orWhere('name', 'like', '%piece%')
                ->first();

            if (!$defaultUnit) {
                $defaultUnit = \App\Models\Unit::first();
            }

            // Attach default unit
            if ($defaultUnit) {
                $item->units()->attach($defaultUnit->id, [
                    'u_val' => 1,
                    'cost' => 0,
                ]);

                // Create default barcode
                $item->barcodes()->create([
                    'unit_id' => $defaultUnit->id,
                    'barcode' => $code,
                ]);

                // Create default price (0)
                $defaultPrice = Price::first();
                if ($defaultPrice) {
                    $item->prices()->attach($defaultPrice->id, [
                        'unit_id' => $defaultUnit->id,
                        'price' => 0,
                    ]);
                }
            }

            DB::commit();

            // Return item data in the same format as search results
            return response()->json([
                'success' => true,
                'message' => 'تم إنشاء الصنف بنجاح',
                'item' => [
                    'id' => $item->id,
                    'name' => $item->name,
                    'code' => $item->code,
                    'unit_id' => $defaultUnit?->id,
                    'unit_name' => $defaultUnit?->name,
                    'price' => 0,
                    'units' => $defaultUnit ? [[
                        'id' => $defaultUnit->id,
                        'name' => $defaultUnit->name,
                        'uval' => 1,
                    ]] : [],
                ],
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'فشل في إنشاء الصنف: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Search items
     */
    public function searchItems(Request $request)
    {
        $term = trim($request->get('term', ''));
        $type = (int) $request->get('type');
        $branchId = $request->get('branch_id');
        $selectedPriceType = (int) $request->get('selected_price_type', 1);

        if (empty($term) || strlen($term) < 1) {
            return response()->json(['items' => []]);
        }

        $cacheKey = sprintf('item_search_%s_%s_%s_%s_v4', md5($term), $type, $branchId ?? 'all', $selectedPriceType);

        return Cache::remember($cacheKey, 300, function () use ($term, $type, $branchId, $selectedPriceType) {
            $isNumeric = is_numeric($term);
            
            // === FAST SEARCH: Use index-friendly patterns ===
            $query = Item::select('items.id', 'items.name', 'items.code')
                ->where('items.isdeleted', 0);

            if ($isNumeric) {
                // Barcode/Code search - exact prefix match (uses index)
                $query->where('items.code', 'like', $term . '%');
            } else {
                // Name search - prioritize prefix match (uses index)
                $words = preg_split('/\s+/', $term, -1, PREG_SPLIT_NO_EMPTY);
                $firstWord = $words[0] ?? $term;
                
                $query->where(function ($q) use ($firstWord) {
                    // Fast: prefix match (uses index)
                    $q->where('items.name', 'like', $firstWord . '%')
                      ->orWhere('items.code', 'like', $firstWord . '%');
                });
            }

            // Filter by type
            if (in_array($type, [11, 13, 15, 17])) {
                $query->where('items.type', ItemType::Inventory->value);
            } elseif ($type == 24) {
                $query->where('items.type', ItemType::Service->value);
            }

            // Filter by branch
            if ($branchId) {
                $query->where(function ($q) use ($branchId) {
                    $q->where('items.branch_id', $branchId)
                      ->orWhereNull('items.branch_id');
                });
            }

            $items = $query->limit(15)->get();

            // If no results with prefix, try contains (slower but necessary)
            if ($items->isEmpty() && !$isNumeric && strlen($term) >= 3) {
                $fallbackQuery = Item::select('items.id', 'items.name', 'items.code')
                    ->where('items.isdeleted', 0)
                    ->where('items.name', 'like', '%' . $term . '%');
                
                if (in_array($type, [11, 13, 15, 17])) {
                    $fallbackQuery->where('items.type', ItemType::Inventory->value);
                } elseif ($type == 24) {
                    $fallbackQuery->where('items.type', ItemType::Service->value);
                }
                
                if ($branchId) {
                    $fallbackQuery->where(function ($q) use ($branchId) {
                        $q->where('items.branch_id', $branchId)
                          ->orWhereNull('items.branch_id');
                    });
                }
                
                $items = $fallbackQuery->limit(15)->get();
            }

            if ($items->isEmpty()) {
                return ['items' => []];
            }

            $itemIds = $items->pluck('id')->toArray();

            // Get units (fast query)
            $unitsData = DB::table('item_units')
                ->join('units', 'item_units.unit_id', '=', 'units.id')
                ->whereIn('item_units.item_id', $itemIds)
                ->select(
                    'item_units.item_id',
                    'units.id as unit_id',
                    'units.name as unit_name',
                    'item_units.u_val as uval'
                )
                ->orderBy('item_units.u_val', 'asc')
                ->get()
                ->groupBy('item_id');

            // Get first unit IDs for price lookup
            $firstUnitIds = $unitsData->map(fn($units) => $units->first()->unit_id ?? null)->filter()->toArray();

            // Get prices (fast query)
            $pricesData = DB::table('item_prices')
                ->whereIn('item_id', $itemIds)
                ->where('price_id', $selectedPriceType)
                ->whereIn('unit_id', $firstUnitIds)
                ->select('item_id', 'unit_id', 'price')
                ->get()
                ->keyBy(fn($p) => $p->item_id . '_' . $p->unit_id);

            return ['items' => $items->map(function ($item) use ($unitsData, $pricesData) {
                $units = $unitsData->get($item->id, collect());
                $firstUnit = $units->first();
                
                $price = 0;
                if ($firstUnit) {
                    $priceKey = $item->id . '_' . $firstUnit->unit_id;
                    $priceData = $pricesData->get($priceKey);
                    $price = $priceData->price ?? 0;
                }
                
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'code' => $item->code,
                    'unit_id' => $firstUnit->unit_id ?? null,
                    'unit_name' => $firstUnit->unit_name ?? null,
                    'price' => $price,
                    'units' => $units->map(fn($u) => [
                        'id' => $u->unit_id,
                        'name' => $u->unit_name,
                        'uval' => $u->uval ?? 1,
                    ])->toArray(),
                ];
            })->toArray()];
        });
    }

    /**
     * Get item for invoice
     */
    public function getItemForInvoice(Request $request)
    {
        $itemId = $request->get('item_id');
        $type = (int) $request->get('type');
        $selectedPriceType = (int) $request->get('selected_price_type', 1);
        $acc2Id = $request->get('acc2_id');

        $item = Item::with([
            'units' => fn($q) => $q->orderBy('pivot_u_val', 'asc'),
            'prices',
        ])->find($itemId);

        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        // Check stock availability
        if (in_array($type, [10, 12, 14, 16, 22])) {
            $user = Auth::user();
            if (!($user instanceof User) || !$user->can('prevent_transactions_without_stock')) {
                $availableQty = DB::table('operation_items')
                    ->where('item_id', $itemId)
                    ->where('detail_store', $acc2Id)
                    ->selectRaw('SUM(qty_in - qty_out) as total')
                    ->value('total') ?? 0;

                if ($availableQty <= 0) {
                    return response()->json(['error' => 'insufficient_stock'], 400);
                }
            }
        }

        $firstUnit = $item->units->first();
        $unitId = $firstUnit?->id;
        $acc1Id = $request->get('acc1_id');
        $price = $this->calculateItemPrice($item, $unitId, $selectedPriceType, 0, null, $type, $acc1Id);

        if (in_array($type, [11, 15]) && $price == 0) {
            $user = Auth::user();
            if (!($user instanceof User) || !$user->can('allow_purchase_with_zero_price')) {
                return response()->json(['error' => 'zero_price'], 400);
            }
        }

        $defaultQuantity = (setting('default_quantity_greater_than_zero', '0') == '1' && $type == 10) ? 1 : 1;

        $availableUnits = $item->units->map(function ($unit) {
            return [
                'id' => $unit->id,
                'name' => $unit->name,
                'u_val' => $unit->pivot->u_val ?? 1,
            ];
        })->toArray();

        return response()->json([
            'success' => true,
            'item' => [
                'item_id' => $item->id,
                'unit_id' => $unitId,
                'name' => $item->name,
                'quantity' => $defaultQuantity,
                'price' => $price,
                'sub_value' => $price * $defaultQuantity,
                'discount' => 0,
                'available_units' => $availableUnits,
            ],
        ]);
    }

    /**
     * Save invoice
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|integer',
            'acc1_id' => 'required|exists:acc_head,id',
            'acc2_id' => 'required|exists:acc_head,id',
            'emp_id' => 'nullable|exists:acc_head,id',
            'pro_date' => 'required|date',
            'accural_date' => 'nullable|date',
            'pro_id' => 'nullable|string',
            'serial_number' => 'nullable|string',
            'branch_id' => 'nullable|integer|exists:branches,id',
            'invoice_items' => 'required|array|min:1',
            'invoice_items.*.item_id' => 'required|exists:items,id',
            'invoice_items.*.quantity' => 'required|numeric|min:0.001',
            'invoice_items.*.price' => 'required|numeric|min:0',
            'invoice_items.*.sub_value' => 'nullable|numeric|min:0',
            'invoice_items.*.discount' => 'nullable|numeric|min:0',
            'invoice_items.*.unit_id' => 'nullable|integer',
            'subtotal' => 'required|numeric',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'discount_value' => 'nullable|numeric|min:0',
            'additional_percentage' => 'nullable|numeric|min:0|max:100',
            'additional_value' => 'nullable|numeric|min:0',
            'total_after_additional' => 'required|numeric',
            'vat_percentage' => 'nullable|numeric|min:0|max:100',
            'vat_value' => 'nullable|numeric|min:0',
            'withholding_tax_percentage' => 'nullable|numeric|min:0|max:100',
            'withholding_tax_value' => 'nullable|numeric|min:0',
            'received_from_client' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'currency_id' => 'nullable|exists:currencies,id',
            'currency_rate' => 'nullable|numeric|min:0.0001',
            'cash_box_id' => 'nullable|exists:acc_head,id',
        ]);

        // Create a temporary component-like object for SaveInvoiceService
        $component = (object) $data;
        $component->invoiceItems = $data['invoice_items'];
        
        // Debug: Log invoice items to verify sub_value is received
        \Illuminate\Support\Facades\Log::debug('Invoice items received:', ['items' => $data['invoice_items']]);
        $component->currency_rate = $data['currency_rate'] ?? 1;
        $component->cash_box_id = $data['cash_box_id'] ?? null;
        
        // Set default values for optional properties used by SaveInvoiceService
        $component->delivery_id = $data['delivery_id'] ?? null;
        $component->selectedPriceType = $data['price_list'] ?? $data['selectedPriceType'] ?? null;
        // Handle empty string from JavaScript - use !empty() to properly check
        $component->branch_id = !empty($data['branch_id']) ? (int) $data['branch_id'] : (Auth::user()->branch_id ?? null);
        $component->selectedTemplateId = $data['template_id'] ?? $data['selectedTemplateId'] ?? null;
        $component->status = $data['status'] ?? 0;
        $component->op2 = $data['op2'] ?? 0;
        $component->operationId = $data['operation_id'] ?? null;

        $calculator = new DetailValueCalculator();
        $validator = new DetailValueValidator();
        $service = new SaveInvoiceService($calculator, $validator);

        try {
            $operationId = $service->saveInvoice($component, false);
            
            if ($operationId) {
                return response()->json([
                    'success' => true,
                    'operation_id' => $operationId,
                    'message' => 'Invoice saved successfully',
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to save invoice',
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update invoice
     */
    public function update(Request $request, $operationId)
    {
        $operation = OperHead::findOrFail($operationId);
        
        if ($operation->is_posted ?? false) {
            return response()->json(['error' => 'Cannot edit posted invoice'], 400);
        }

        $data = $request->validate([
            'acc1_id' => 'required|exists:acc_head,id',
            'acc2_id' => 'required|exists:acc_head,id',
            'emp_id' => 'nullable|exists:acc_head,id',
            'pro_date' => 'required|date',
            'accural_date' => 'nullable|date',
            'branch_id' => 'nullable|integer|exists:branches,id',
            'invoice_items' => 'required|array|min:1',
            'invoice_items.*.item_id' => 'required|exists:items,id',
            'invoice_items.*.quantity' => 'required|numeric|min:0.001',
            'invoice_items.*.price' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'discount_value' => 'nullable|numeric|min:0',
            'additional_percentage' => 'nullable|numeric|min:0|max:100',
            'additional_value' => 'nullable|numeric|min:0',
            'total_after_additional' => 'required|numeric',
            'vat_percentage' => 'nullable|numeric|min:0|max:100',
            'vat_value' => 'nullable|numeric|min:0',
            'withholding_tax_percentage' => 'nullable|numeric|min:0|max:100',
            'withholding_tax_value' => 'nullable|numeric|min:0',
            'received_from_client' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'currency_id' => 'nullable|exists:currencies,id',
            'currency_rate' => 'nullable|numeric|min:0.0001',
        ]);

        $component = (object) $data;
        $component->type = $operation->pro_type;
        $component->operationId = $operationId;
        $component->invoiceItems = $data['invoice_items'];
        $component->currency_rate = $data['currency_rate'] ?? 1;
        // Handle branch_id - use provided value, or keep existing, or fallback to user's branch
        $component->branch_id = !empty($data['branch_id']) ? (int) $data['branch_id'] : ($operation->branch_id ?? Auth::user()->branch_id ?? null);

        $calculator = new DetailValueCalculator();
        $validator = new DetailValueValidator();
        $service = new SaveInvoiceService($calculator, $validator);

        try {
            $result = $service->saveInvoice($component, true);
            
            if ($result) {
                return response()->json([
                    'success' => true,
                    'operation_id' => $result,
                    'message' => 'Invoice updated successfully',
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to update invoice',
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get account balance
     */
    public function getAccountBalance($accountId)
    {
        $totalDebit = DB::table('journal_details')
            ->where('account_id', $accountId)
            ->where('isdeleted', 0)
            ->sum('debit');

        $totalCredit = DB::table('journal_details')
            ->where('account_id', $accountId)
            ->where('isdeleted', 0)
            ->sum('credit');

        $balance = $totalDebit - $totalCredit;

        return response()->json([
            'balance' => $balance,
        ]);
    }

    /**
     * Get account currency information
     */
    public function getAccountCurrency($accountId)
    {
        if (!function_exists('isMultiCurrencyEnabled') || !isMultiCurrencyEnabled()) {
            $defaultCurrency = function_exists('getDefaultCurrency') ? getDefaultCurrency() : null;
            return response()->json([
                'currency_id' => $defaultCurrency?->id ?? null,
                'currency_rate' => 1,
            ]);
        }

        $account = AccHead::with('currency.latestRate')->find($accountId);

        if (!$account) {
            $defaultCurrency = function_exists('getDefaultCurrency') ? getDefaultCurrency() : null;
            return response()->json([
                'currency_id' => $defaultCurrency?->id ?? null,
                'currency_rate' => 1,
            ]);
        }

        // If account has a currency
        if ($account->currency_id && $account->currency) {
            $currency = $account->currency;
            return response()->json([
                'currency_id' => $currency->id,
                'currency_rate' => $currency->latestRate->rate ?? 1,
            ]);
        }

        // Return default currency
        $defaultCurrency = function_exists('getDefaultCurrency') ? getDefaultCurrency() : null;
        return response()->json([
            'currency_id' => $defaultCurrency?->id ?? null,
            'currency_rate' => 1,
        ]);
    }

    /**
     * Helper methods
     */
    private function getAcc1List($type, $branchId)
    {
        if (!$branchId) {
            return collect();
        }

        $clientsAccounts = $this->getAccountsByCodeAndBranch('1103%', $branchId);
        $suppliersAccounts = $this->getAccountsByCodeAndBranch('2101%', $branchId);
        $employeesAccounts = $this->getAccountsByCodeAndBranch('2102%', $branchId);
        $wasted = $this->getAccountsByCodeAndBranch('55%', $branchId);
        $accounts = $this->getAccountsByCodeAndBranch('1108%', $branchId);
        $stores = $this->getAccountsByCodeAndBranch('1104%', $branchId);

        // Check if all client types are enabled
        $allowAllClientTypes = setting('invoice_enable_all_client_types') == '1';

        if ($allowAllClientTypes) {
            $mergedAccounts = collect()
                ->merge($clientsAccounts)
                ->merge($suppliersAccounts)
                ->merge($employeesAccounts)
                ->unique('id')
                ->values();
        }

        // Determine acc1 based on invoice type
        if (in_array($type, [10, 12, 14, 16, 22, 26])) {
            return $allowAllClientTypes ? $mergedAccounts : $clientsAccounts;
        } elseif (in_array($type, [11, 13, 15, 17, 25])) {
            return $allowAllClientTypes ? $mergedAccounts : $suppliersAccounts;
        } elseif ($type == 18) {
            return $wasted;
        } elseif (in_array($type, [19, 20])) {
            return $accounts;
        } elseif ($type == 21) {
            return $stores;
        } elseif ($type == 24) {
            return $this->getAccountsByCodeAndBranch('5%', $branchId);
        }

        return collect();
    }

    private function getAcc2List($type, $branchId)
    {
        if (!$branchId) {
            return collect();
        }

        $suppliersAccounts = $this->getAccountsByCodeAndBranch('2101%', $branchId);
        $stores = $this->getAccountsByCodeAndBranch('1104%', $branchId);

        return $type == 24 ? $suppliersAccounts : $stores;
    }

    private function getEmployees($branchId)
    {
        if (!$branchId) {
            return collect();
        }

        return $this->getAccountsByCodeAndBranch('2102%', $branchId);
    }

    private function getAccountsByCodeAndBranch(string $code, $branchId)
    {
        return AccHead::where('isdeleted', 0)
            ->where('is_basic', 0)
            ->where('code', 'like', $code)
            ->where('branch_id', $branchId)
            ->select('id', 'code', 'aname')
            ->orderBy('id')
            ->get();
    }

    private function calculateItemPrice($item, $unitId, $priceTypeId = 1, $currentPrice = 0, $oldUnitId = null, $type = null, $acc1Id = null)
    {
        if (!$item || !$unitId) {
            return 0;
        }

        // Dynamic conversion logic: if there's a written price and old unit, convert
        if ($currentPrice > 0 && $oldUnitId && $oldUnitId != $unitId) {
            $oldUnit = $item->units->where('id', $oldUnitId)->first();
            $newUnit = $item->units->where('id', $unitId)->first();

            if ($oldUnit && $newUnit) {
                $oldUVal = $oldUnit->pivot->u_val ?? 1;
                $newUVal = $newUnit->pivot->u_val ?? 1;

                if ($newUVal == 0) {
                    return 0;
                }

                // Base price (for smallest unit)
                $basePrice = $currentPrice / $oldUVal;

                // New price (for new unit)
                return $basePrice * $newUVal;
            }
        }

        $price = 0;

        // 1. Purchase invoices and purchase orders logic (11, 15)
        if (in_array($type, [11, 15])) {
            // Try to get last purchase price for same item and same unit
            $lastPurchasePrice = DB::table('operation_items')
                ->where('item_id', $item->id)
                ->where('unit_id', $unitId)
                ->where('is_stock', 1)
                ->whereIn('pro_tybe', [11, 20])
                ->where('qty_in', '>', 0)
                ->orderBy('created_at', 'desc')
                ->value('item_price');

            if ($lastPurchasePrice && $lastPurchasePrice > 0) {
                $price = $lastPurchasePrice;
            } else {
                // If no previous price for this unit, calculate based on average cost and conversion factor
                $unit = $item->units->where('id', $unitId)->first();
                $uVal = $unit->pivot->u_val ?? 1;
                $averageCost = $item->average_cost ?? 0;
                $price = $averageCost * $uVal;
            }
        }
        // 2. Damaged goods invoices logic (18)
        elseif ($type == 18) {
            $unit = $item->units->where('id', $unitId)->first();
            $uVal = $unit->pivot->u_val ?? 1;
            $averageCost = $item->average_cost ?? 0;
            $price = $averageCost * $uVal;
        }
        // 3. Sales invoices and others logic
        else {
            // Use ItemViewModel to get prices
            $vm = new \App\Helpers\ItemViewModel(null, $item, $unitId);
            $salePrices = $vm->getUnitSalePrices();
            $price = $salePrices[$priceTypeId]['price'] ?? 0;

            // Apply pricing agreement and last customer price logic (only for sales)
            if ($type == 10 && $acc1Id) {
                $usePricingAgreement = (setting('invoice_use_pricing_agreement') ?? '0') == '1';
                $useLastCustomerPrice = (setting('invoice_use_last_customer_price') ?? '0') == '1';

                if (!($usePricingAgreement && $useLastCustomerPrice)) {
                    if ($usePricingAgreement) {
                        $pricingAgreementPrice = DB::table('operation_items')
                            ->join('oper_head', 'operation_items.pro_id', '=', 'oper_head.id')
                            ->where('oper_head.pro_type', 26)
                            ->where('oper_head.acc1', $acc1Id)
                            ->where('operation_items.item_id', $item->id)
                            ->where('operation_items.unit_id', $unitId)
                            ->orderBy('operation_items.created_at', 'desc')
                            ->value('operation_items.item_price');

                        if ($pricingAgreementPrice && $pricingAgreementPrice > 0) {
                            $price = $pricingAgreementPrice;
                        }
                    } elseif ($useLastCustomerPrice) {
                        $lastCustomerPrice = DB::table('operation_items')
                            ->join('oper_head', 'operation_items.pro_id', '=', 'oper_head.id')
                            ->where('oper_head.pro_type', 10)
                            ->where('oper_head.acc1', $acc1Id)
                            ->where('operation_items.item_id', $item->id)
                            ->where('operation_items.unit_id', $unitId)
                            ->orderBy('operation_items.created_at', 'desc')
                            ->value('operation_items.item_price');

                        if ($lastCustomerPrice && $lastCustomerPrice > 0) {
                            $price = $lastCustomerPrice;
                        }
                    }
                }
            }
            // Pricing agreements (26)
            elseif ($type == 26 && $acc1Id) {
                $pricingAgreementPrice = DB::table('operation_items')
                    ->join('oper_head', 'operation_items.pro_id', '=', 'oper_head.id')
                    ->where('oper_head.pro_type', 26)
                    ->where('oper_head.acc1', $acc1Id)
                    ->where('operation_items.item_id', $item->id)
                    ->where('operation_items.unit_id', $unitId)
                    ->orderBy('operation_items.created_at', 'desc')
                    ->value('operation_items.item_price');

                if ($pricingAgreementPrice && $pricingAgreementPrice > 0) {
                    $price = $pricingAgreementPrice;
                }
            }
        }

        return $price;
    }

    /**
     * Normalize Arabic text for better search matching
     * Converts: أإآٱ → ا, ة ↔ ه, ى → ي, ؤ → و, ئ → ي
     * Removes: تشكيل (diacritics)
     */
    private function normalizeArabic(string $text): string
    {
        // Replace different forms of Alef with plain Alef
        $text = str_replace(['أ', 'إ', 'آ', 'ٱ'], 'ا', $text);
        
        // Replace Taa Marbouta with Haa (and vice versa for bidirectional matching)
        // We normalize both to 'ه' for consistent matching
        $text = str_replace('ة', 'ه', $text);
        
        // Replace Alef Maqsura with Yaa
        $text = str_replace('ى', 'ي', $text);
        
        // Replace Waw with Hamza with Waw
        $text = str_replace('ؤ', 'و', $text);
        
        // Replace Yaa with Hamza with Yaa
        $text = str_replace('ئ', 'ي', $text);
        
        // Remove Arabic diacritics (Tashkeel)
        $text = preg_replace('/[\x{064B}-\x{065F}]/u', '', $text);
        
        return $text;
    }
}
