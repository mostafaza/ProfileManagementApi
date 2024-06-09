<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;



Route::post('/login', [AuthController::class, 'login']);

//routes accessibles seulement
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/createProfile', [ProfileController::class, 'store']);
    Route::put('/updateProfile/{profile}', [ProfileController::class, 'update']);
    Route::delete('/delProfile/{profile}', [ProfileController::class, 'destroy']);

});

Route::get('/getActiveProfiles', [ProfileController::class, 'getActiveProfiles']);
