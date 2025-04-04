<?php

use App\Http\Controllers\Auth\{
    AuthenticatedSessionController,
    NewPasswordController,
    PasswordResetLinkController,
};
use Illuminate\Support\Facades\Route;

Route::middleware([\App\Http\Middleware\CheckInstalltion::class])->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::name('password.')->group(static function () {
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('email');
    Route::get('reset-password', [NewPasswordController::class, 'create'])->name('reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('store');
});

Route::middleware('auth')->group(function () {
    //logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('sessions/logout/{sessionId}', [AuthenticatedSessionController::class, 'logoutSession'])->name('sessions.logout');
    Route::get('sessions/logout-all/{id}', [AuthenticatedSessionController::class, 'logoutAllSessions'])->name('sessions.logoutAll');
});
