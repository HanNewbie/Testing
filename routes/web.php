<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AccountUserController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\SubmissionController;

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::post('/logout', function () {Auth::logout();return redirect('/admin/login');})->name('admin.logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('account', AccountController::class);
    Route::resource('user', AccountUserController::class);
    Route::resource('event', EventController::class);
    Route::resource('news', NewsController::class);
    Route::resource('content', ContentController::class);
    Route::resource('submission', SubmissionController::class)->except(['show']);
    Route::get('submission/approved', [SubmissionController::class, 'approved'])->name('submission.approved.list');
    Route::get('submission/rejected', [SubmissionController::class, 'rejected'])->name('submission.rejected.list');
    // PUT untuk menyetujui/menolak 
    Route::put('submission/{id}/approve', [SubmissionController::class, 'approve'])->name('submission.approved');
    Route::put('submission/{id}/reject', [SubmissionController::class, 'reject'])->name('submission.rejected');
});

Route::get('/', function () {
    return view('welcome');
});
