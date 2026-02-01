<?php

use App\Http\Controllers\Api\WorkoutController;
use App\Http\Controllers\Api\WorkoutTrackController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/workouts/start', [WorkoutController::class, 'start']);
    Route::post('/workouts/{workout}/track', [WorkoutTrackController::class, 'store']);
    Route::post('/workouts/{workout}/end', [WorkoutController::class, 'end']);
});
Route::post('/login', [AuthController::class, 'login']);



