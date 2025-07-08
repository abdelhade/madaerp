<?php

use Illuminate\Support\Facades\Route;
use Modules\Settings\Http\Controllers\SettingsController;

// Route::resource('settings', SettingsController::class)->names('settings');
Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
