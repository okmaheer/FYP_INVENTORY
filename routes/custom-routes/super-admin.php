<?php

//Index
use App\Http\Controllers\SuperAdmin\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('locations', [HomeController::class, 'locationSelection'])->name('locations');
    Route::get('change-location', [HomeController::class, 'changeLocation'])->name('change-location');
    Route::get('clear-location', [HomeController::class, 'clearLocation'])->name('clear-location');

});
