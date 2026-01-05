<?php

use Modules\Accounts\Models\AccHead;
use Illuminate\Support\Facades\Route;
use Modules\Settings\Models\Currency;
use Modules\Invoices\Http\Controllers\InvoiceController;
use Modules\Invoices\Http\Controllers\InvoiceTemplateController;
use Modules\Invoices\Http\Controllers\InvoiceWorkflowController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('invoice-templates', InvoiceTemplateController::class)->parameters([
        'invoice-templates' => 'template'
    ]);

    // 📁 Invoice Route
    Route::resource('invoices', InvoiceController::class)->names('invoices');

    Route::post(
        'invoice-templates/{template}/toggle-active',
        [InvoiceTemplateController::class, 'toggleActive']
    )->name('invoice-templates.toggle-active');

    // invoice Statistics Routes
    Route::get('/sales/statistics', [InvoiceController::class, 'salesStatistics'])->name('sales.statistics');
    Route::get('/purchases/statistics', [InvoiceController::class, 'purchasesStatistics'])->name('purchases.statistics');
    Route::get('/inventory/statistics', [InvoiceController::class, 'inventoryStatistics'])->name('inventory.statistics');

    // 📁 Invoice Print Route
    Route::get('/invoice/print/{operation_id}', [InvoiceController::class, 'print'])->name('invoice.print');
    // 📁 Invoice View Route
    Route::get('invoice/view/{operationId}', [InvoiceController::class, 'view'])->name('invoice.view');


    // list request orders (طلب احتياج)
    Route::get('/invoices/requests', [InvoiceWorkflowController::class, 'index'])->name('invoices.requests.index');
    Route::get('/invoices/track/search', [InvoiceWorkflowController::class, 'index'])->name('invoices.track.search');
    Route::get('/invoices/track/{id}', [InvoiceWorkflowController::class, 'show'])->name('invoices.track');
    Route::post('/invoices/confirm/{id}', [InvoiceWorkflowController::class, 'confirm'])->name('invoices.confirm');


    Route::get('/ajax/account-currency/{accountId}', function ($accountId) {
        if (!auth()->check()) abort(401);

        // نتأكد إن الموديول شغال
        if (!isMultiCurrencyEnabled()) {
            return response()->json(['success' => false, 'message' => 'Multi-currency disabled']);
        }

        $account = AccHead::find($accountId);
        if (!$account) return response()->json(['success' => false]);

        // لو الحساب ملوش عملة، نرجع العملة الافتراضية
        $currencyId = $account->currency_id ?? getDefaultCurrency()->id;
        $currency = Currency::with('latestRate')->find($currencyId);

        // حساب السعر (1 لو default، وإلا نجيب السعر)
        $rate = ($currency->is_default) ? 1 : ($currency->latestRate->rate ?? 1);

        return response()->json([
            'success' => true,
            'currency_id' => $currency->id,
            'code' => $currency->code,
            'symbol' => $currency->symbol,
            'rate' => $rate,
            'is_default' => $currency->is_default
        ]);
    })->name('ajax.account.currency');
});
