<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\Admin\RegisterControllers;
use App\Http\Controllers\API\Admin\CompanyControllers;

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
    
    Route::get('admin/emploes/{company_id}', [RegisterControllers::class, 'emploes']);  // Kompaniya hodimlari
    Route::get('admin/emploes/show/{user_id}', [RegisterControllers::class, 'emploes_user']);  // Kompaniya hodimi

    /// Company 
    Route::post('admin/company/create', [CompanyControllers::class, 'create']);  // Yangi kompaniya yaratish
    Route::post('admin/company/update/data', [CompanyControllers::class, 'update_data']);  // Kompaniya malumotlarini tangilash
    Route::post('admin/company/update/image', [CompanyControllers::class, 'update_image']);  // Kompaniya banner rasmini yangilash
    Route::get('admin/company/company', [CompanyControllers::class, 'company']); // Barcha ro'yhatga olingan kompaniyalar
    Route::get('admin/company/company/{id}', [CompanyControllers::class, 'show']); // Kompaniya haqida malumot


});