<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\GeoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('web')->group(function () {
    Route::get('/sanctum/csrf-cookie', function (Request $request) {
        return response()->json(['csrf_token' => csrf_token()]);
    });
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/geo', [GeoController::class, 'store'])->middleware('auth:sanctum');
Route::get('/history', [GeoController::class, 'index'])->middleware('auth:sanctum');