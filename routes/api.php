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
    Route::post('admin/login', 'login');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::post('admin/register', [RegisterControllers::class, 'register']);
    Route::post('admin/company/create', [CompanyControllers::class, 'create']);

});