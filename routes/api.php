<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('authenticate', [AuthController::class, 'authenticate']);
Route::get('movies', [MovieController::class, 'listMovies']);
Route::get('movies/{movie}', [MovieController::class, 'movieDetails']);
Route::get('areas', [CinemaController::class, 'listAreas']);
Route::get('cinemas', [CinemaController::class, 'listCinemas']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('user', [AuthController::class, 'getUser']);
});

