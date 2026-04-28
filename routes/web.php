<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SchoolController;



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

    Route::get('panel/school', [SchoolController::class, 'school_list']);

    Route::get('panel/school/create', [SchoolController::class, 'create_school']);
    Route::post('panel/school/create', [SchoolController::class, 'insert_school']);
    
    Route::get('panel/school/edit/{id}', [SchoolController::class, 'edit_school']);
    Route::post('panel/school/edit/{id}', [SchoolController::class, 'update_school']);

    Route::get('panel/school/delete/{id}', [SchoolController::class, 'delete_school']);

     

    });
