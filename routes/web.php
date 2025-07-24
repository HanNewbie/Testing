<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AccountUserController;

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::post('/logout', function () {Auth::logout();return redirect('/admin/login');})->name('admin.logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('account', AccountController::class);
    Route::resource('user', AccountUserController::class);
});

Route::get('/', function () {
    return view('welcome');
});
