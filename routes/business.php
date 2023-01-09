<?php

use App\Http\Controllers\Business\CalendarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Business\PageController as BusinessPageController;
use App\Http\Controllers\Business\CollaboratorController;
use App\Http\Controllers\Business\PatientController;
use App\Http\Controllers\Business\ProviderController;
use App\Http\Controllers\Business\ReservationController;
use App\Http\Controllers\Business\WarehouseController;

Route::middleware(['auth', 'verified', 'VerifyIsBusiness'])->name('business.')->group(function () {
//PageController
    Route::get('/', [BusinessPageController::class, 'dashboard'])->name('dashboard');
//Patient
    Route::resource('patient', PatientController::class);
//Reservetion
    Route::post('reservation', [ReservationController::class, 'store'])->name('reservation.store');
    Route::delete('reservation/destroy/{id}', [ReservationController::class, 'destroy'])->name('reservation.destroy');
    Route::get('calendar', CalendarController::class)->name('calendar');
//Provider
    Route::resource('provider', ProviderController::class);
//Warehouse
    Route::resource('warehouse', WarehouseController::class);
//Collaborator
    Route::resource('collaborator', CollaboratorController::class);
});
