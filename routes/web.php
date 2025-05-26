<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\ActionController;

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    Route::resource('users', UserController::class);
    Route::resource('spare-parts', SparePartController::class);
    Route::resource('actions', ActionController::class);

    Route::get('/api/low-stock-notifications', [SparePartController::class, 'getLowStockNotifications'])->name('api.low-stock-notifications');
});
