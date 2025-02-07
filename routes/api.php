<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\User\UserController;
use App\Http\Controllers\API\User\CompanyController;

Route::controller(UserController::class)->group(function(){
    Route::post('user/phone', 'phone');  
    Route::post('user/check', 'check');  
});

Route::middleware('auth:sanctum')->group( function () {
    Route::controller(UserController::class)->group(function(){
        Route::get('user/profile', 'profile');  // Parolni yangilash
        Route::post('user/logout', 'logout');  // Logout
        Route::post('user/update-profile', 'update_profile');  // Logout
    });
    Route::controller(CompanyController::class)->group(function(){
        Route::get('user/companies', 'companies');  
        Route::get('user/company/{id}', 'company');  
        Route::post('user/create-order', 'order_create'); 
        Route::get('user/active-order', 'active_order');  
        Route::get('user/end-order', 'end_order');  
        Route::get('user/order{id}', 'order_show');  
        Route::post('user/cancel-order', 'order_cancel'); 
        Route::post('user/order-comment', 'order_comment'); 
    });

});

require __DIR__ . '/admin.php';