<?php

use App\Http\Controllers\InstallController;
use Illuminate\Support\Facades\Route;

Route::get('install/initialize', [InstallController::class, 'index'])->name('install.initialize');
Route::post('dbdetails',[InstallController::class, 'store'])->name('DbDetails');
Route::post('finalize', [InstallController::class, 'final'])->name('install.finalize');

Route::get('update-code', [InstallController::class, 'UpdateSystem'])->name('UpdateSystem');
