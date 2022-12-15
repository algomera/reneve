<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\WarehouseController;

Route::middleware(['auth', 'verified','VerifyIsAdmin'])->name('admin.')->group(function() {
//PageController
    Route::get('/', [AdminPageController::class, 'dashboard'])->name('dashboard');
    //SubDomain
    Route::domain('{subdomain}.' . env('APP_URL'))->group(function () {
        Route::get('/', [AdminPageController::class, 'show_business'])->name('show_business');
    });

//Business
    Route::resource('business', BusinessController::class);
    Route::patch('restore/{business}', [BusinessController::class, 'restore'])->name('businessRestore');

//Warehouse
    Route::resource('warehouse', WarehouseController::class);

//Order
    Route::get('order', [OrderController::class, 'index'])->name('order.index');
    Route::get('order/{order}', [OrderController::class, 'show'])->name('order.show');

//Provider
    Route::resource('service', ProviderController::class);
});
