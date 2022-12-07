<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\WarehouseController;

Route::get('/', [PageController::class, 'dashboard'])->name('dashboard');

//Business
Route::resource('business', BusinessController::class);
Route::patch('restore/{business}', [BusinessController::class, 'restore'])->name('admin.businessRestore');

//Warehouse
Route::resource('warehouse', WarehouseController::class);

//Order
Route::get('order', [OrderController::class, 'index'])->name('order.index');
Route::get('order/{order}', [OrderController::class, 'show'])->name('order.show');

//Provider
Route::resource('service', ProviderController::class);

//SubDomain
Route::domain('{subdomain}.' . env('APP_URL'))->middleware('VerifyIsAdmin')->group(function () {
    Route::get('/', [PageController::class, 'show_business'])->name('show_business');
});
