<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(RegisterController::class)->group(function(){
    Route::post('phone', 'phone');
    Route::post('check', 'check');
});
Route::middleware('auth:sanctum')->group( function () {
    Route::get('profile', [RegisterController::class, 'profile']);


});
