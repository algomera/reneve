<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Business\PageController as BusinessPageController;
use App\Http\Controllers\Business\PatientController;

Route::middleware(['auth', 'verified', 'VerifyIsBusiness'])->name('business.')->group(function () {
//PageController
    Route::get('/', [BusinessPageController::class, 'dashboard'])->name('dashboard');
//Patient
    Route::resource('patient', PatientController::class);
});
