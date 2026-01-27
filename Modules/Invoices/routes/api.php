<?php

use Illuminate\Support\Facades\Route;
use Modules\Invoices\Http\Controllers\InvoiceApiController;

// Invoice API Routes (AJAX/JavaScript) - Replaces Livewire components
// These routes are accessible via /api/v1/invoices/*
// Using web middleware for session-based authentication (compatible with Blade/JavaScript)
Route::middleware(['web', 'auth'])->prefix('v1/invoices')->name('invoices.')->group(function () {
    // Get initial data for create form
    Route::get('/create-data', [InvoiceApiController::class, 'getCreateData'])->name('create-data');
    
    // Get initial data for edit form
    Route::get('/edit-data/{operationId}', [InvoiceApiController::class, 'getEditData'])->name('edit-data');
    
    // Search items
    Route::get('/search-items', [InvoiceApiController::class, 'searchItems'])->name('search-items');
    
    // Quick create item from invoice
    Route::post('/quick-create-item', [InvoiceApiController::class, 'quickCreateItem'])->name('quick-create-item');
    
    // Get item for invoice
    Route::post('/get-item', [InvoiceApiController::class, 'getItemForInvoice'])->name('get-item');
    
    // Save invoice (create)
    Route::post('/store', [InvoiceApiController::class, 'store'])->name('store');
    
    // Update invoice
    Route::put('/update/{operationId}', [InvoiceApiController::class, 'update'])->name('update');
    
    // Get account balance
    Route::get('/account-balance/{accountId}', [InvoiceApiController::class, 'getAccountBalance'])->name('account-balance');
    
    // Get account currency
    Route::get('/account-currency/{accountId}', [InvoiceApiController::class, 'getAccountCurrency'])->name('account-currency');
});
