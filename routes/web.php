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
    CaseController,
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
Route::get('migrate', function () {
    Artisan::call('migrate');
    return redirect()->route('Clear');
});
Route::get('/home', function () {
    dd(ini_get('disable_functions'));
});
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
    Route::resource('case', CaseController::class);
});

Route::middleware(['user.auth', 'lastactivity'])->group(static function () {
    Route::get('/', [DashboardController::class, 'index'])->name('Home');
    Route::get('markasread/{id}', [ProfileController::class, 'MarkAsRead'])->name('MarkAsRead');
    Route::get('markallread', [ProfileController::class, 'MarkAllRead'])->name('MarkAllRead');
    Route::get('shownotification/{id}', [ProfileController::class, 'ShowNotification'])->name('ShowNotification');
    Route::get('get-branches/{department_id}', [SubjectController::class, 'getBranches'])->name('getBranches');
    Route::post('add-subject', [SubjectController::class, 'AddSubject'])->name('AddSubject');
    Route::post('add-department', [DepartmentController::class, 'AddDepartment'])->name('AddDepartment');
    Route::post('add-branch', [BranchController::class, 'AddBranch'])->name('AddBranch');
    Route::get('get-case-activity/{id}', [CaseController::class, 'GetCaseActivity']);
    Route::get('get-letter-activity/{id}', [InwardLetterController::class, 'GetLetterActivity']);
    Route::get('get-comment-model/{id}', [InwardLetterController::class, 'GetCommentModel']);
    Route::post('add-letter-comment', [InwardLetterController::class, 'AddLetterComment'])->name('AddLetterComment');
    Route::post('add-case-comment', [CaseController::class, 'AddCaseComment'])->name('AddCaseComment');
    Route::get('get-followup-model/{id}', [InwardLetterController::class, 'GetFollowupModel']);
    Route::post('add-followup', [InwardLetterController::class, 'AddFollowup'])->name('AddFollowup');
    Route::post('add-case-followup', [CaseController::class, 'AddCaseFollowup'])->name('AddCaseFollowup');
    Route::get('get-outward-content/{id}', [OutwardLetterController::class, 'GetOutwardContent']);
    Route::get('remove-file/{id}', [InwardLetterController::class, 'RemoveFile'])->name('RemoveFile');
    Route::get('change-language/{lang}', [UsersController::class, 'ChangeLanguage'])->name('ChangeLanguage');
});

Route::get('run-queue', function () {
    Artisan::call('queue:work --stop-when-empty');
    if (request()->ajax()) {
        return response()->json(['status' => true, 'msg' => "Queue updated successfully."]);
    }
});
