<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Backend\DashboardController;


Route::get('/', [AuthController::class, 'login']);
Route::post('/', [AuthController::class, 'auth_login']);
Route::get('forgot', [AuthController::class, 'forgot']);

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

Route::group(['middleware' => 'useradmin'], function () {

    Route::get('panel/dashboard', [DashboardController::class, 'dashboard']);
});
