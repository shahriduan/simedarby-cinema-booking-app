<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\FnbController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::post('authenticate', [AuthController::class, 'authenticate']);
Route::get('movies', [MovieController::class, 'listMovies']);
Route::get('movies/{movie}', [MovieController::class, 'movieDetails']);
Route::get('areas', [CinemaController::class, 'listAreas']);
Route::get('cinemas', [CinemaController::class, 'listCinemas']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('user', [AuthController::class, 'getUser']);

    # Food and Beverages
    Route::prefix('fnb')->group(function () {
        Route::get('menu', [FnbController::class, 'fnbMenu']);
    });

    # Booking
    Route::prefix('booking')->group(function () {
        Route::post('ticket', [BookingController::class, 'bookingTicket']);
        Route::post('fnb/{booking}', [BookingController::class, 'bookingFnb']);
    });
});

