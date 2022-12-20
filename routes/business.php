<?php

use App\Http\Controllers\Business\CalendarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Business\PageController as BusinessPageController;
use App\Http\Controllers\Business\PatientController;
use App\Http\Controllers\Business\ReservationController;

Route::middleware(['auth', 'verified', 'VerifyIsBusiness'])->name('business.')->group(function () {
//PageController
    Route::get('/', [BusinessPageController::class, 'dashboard'])->name('dashboard');
//Patient
    Route::resource('patient', PatientController::class);
//Reservetion
    Route::get('reservation', [ReservationController::class, 'create'])->name('reservation.create');
    Route::post('reservation', [ReservationController::class, 'store'])->name('reservation.store');
    Route::get('calendar', CalendarController::class)->name('calendar');
});
