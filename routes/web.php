<?php

require __DIR__ . '/auth.php';
require __DIR__ . '/install.php';
date_default_timezone_set('Asia/Kolkata');

use App\Http\Controllers\{
    BranchController,
    DashboardController,
    DepartmentController,
    InwardLetterController,
    OutwardLetterController,
    PermissionListingController,
    ProfileController,
    RolePermissionController,
    SiteSettingController,
    SubjectController,
    UsersController
};
use Illuminate\Support\Facades\{Artisan, Route};

Route::get('clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return view('errors.clear');
})->name('Clear');

Route::middleware(['user.auth', 'permission', 'lastactivity'])->group(static function () {
    Route::resource('role-permission', RolePermissionController::class);
    Route::resource('permission-listing', PermissionListingController::class);
    Route::resource('dashboard', DashboardController::class);
    Route::resource('profile', ProfileController::class);
    Route::resource('users', UsersController::class);
    Route::resource('site-settings', SiteSettingController::class);
    Route::resource('branch', BranchController::class);
    Route::resource('department', DepartmentController::class);
    Route::resource('subject', SubjectController::class);
    Route::resource('inward-letter', InwardLetterController::class);
    Route::resource('outward-letter', OutwardLetterController::class);
});

Route::middleware(['user.auth', 'lastactivity'])->group(static function () {
    Route::get('/', [DashboardController::class, 'index'])->name('Home');
    Route::get('markasread/{id}', [ProfileController::class, 'MarkAsRead'])->name('MarkAsRead');
    Route::get('markallread', [ProfileController::class, 'MarkAllRead'])->name('MarkAllRead');
    Route::get('shownotification/{id}', [ProfileController::class, 'ShowNotification'])->name('ShowNotification');
    Route::get('get-branches/{department_id}', [SubjectController::class, 'getBranches'])->name('getBranches');
});

Route::get('run-queue', function () {
    Artisan::call('queue:work --stop-when-empty');
    if (request()->ajax()) {
        return response()->json(['status' => true, 'msg' => "Queue updated successfully."]);
    }
});
