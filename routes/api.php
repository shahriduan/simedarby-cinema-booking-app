<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('authenticate', [AuthController::class, 'authenticate']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('user', [AuthController::class, 'getUser']);
});

