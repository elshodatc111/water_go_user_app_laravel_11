<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\Admin\RegisterControllers;
use App\Http\Controllers\API\Admin\CompanyControllers;
use App\Http\Controllers\API\Admin\PaymartController;
use App\Http\Controllers\API\Admin\EmploesController;

/// USERS ////
Route::controller(RegisterController::class)->group(function(){
    Route::post('phone', 'phone');
    Route::post('check', 'check');
});
Route::middleware('auth:sanctum')->group( function () {
    Route::get('profile', [RegisterController::class, 'profile']);


});

/// ADMIN ////
Route::controller(RegisterControllers::class)->group(function(){
    Route::post('admin/login', 'login');  // Admin uchun login
    Route::post('admin/register', 'register');  // Uangi foydalanuvchi qo'shish
});

Route::middleware('auth:sanctum')->group( function () {
    Route::controller(RegisterControllers::class)->group(function(){
        Route::post('admin/update-password', 'updatePassword');  // Parolni yangilash
        Route::post('admin/logout', 'logout');  // Logout
    });

    /// Company 
    Route::controller(CompanyControllers::class)->group(function(){
        Route::post('admin/company/create', 'create');  // Yangi kompaniya yaratish
        Route::post('admin/company/update-data', 'update_data');  // Yangi kompaniya yaratish
        Route::post('admin/company/update-image', 'update_image'); // Kompaniya banner rasmini yangilash
        Route::get('admin/company/status/{id}', 'status'); // Kompaniya holati
        Route::post('admin/company/status-update', 'status_update'); // Kompaniya status update
        Route::get('admin/company/all', 'company'); // all Company
        Route::get('admin/company/show/{id}', 'show'); // show Company
    });

    /// Paymart
    Route::controller(PaymartController::class)->group(function(){
        Route::post('admin/paymart/create', 'create');  // Yangi paymart yaratish
        Route::get('admin/paymart/all', 'paymart'); // all paymart
    });

    /// Hodimlar
    Route::controller(EmploesController::class)->group(function(){
        Route::post('admin/emploes/create', 'create');  // Yangi emploes yaratish
        Route::get('admin/emploes/{id}', 'emploes'); // all emploes
    });


});