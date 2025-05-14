<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\UserProgressController;
use App\Http\Controllers\WeeklyScheduleController;
use App\Http\Controllers\WorkoutController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login',    [AuthController::class, 'login']);

// Protected
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/user/profile', [AuthController::class, 'profile']);
    Route::put('/user/profile', [UserController::class, 'updateProfile']);

    // Personal Details
    Route::get('/user-details',         [UserDetailController::class, 'index']);
    Route::post('/user-details',        [UserDetailController::class, 'store']);
    Route::get('/user-details/{id}',    [UserDetailController::class, 'show']);
    Route::put('/user-details/{id}',    [UserDetailController::class, 'update']);
    Route::delete('/user-details/{id}', [UserDetailController::class, 'destroy']);
    Route::get('/user/bmi',               [UserDetailController::class, 'getCurrentUserBMI']);

    // User Progress
    Route::get('/progress',        [UserProgressController::class, 'index']);
    Route::post('/progress',       [UserProgressController::class, 'store']);
    Route::get('/progress/{id}',   [UserProgressController::class, 'show']);
    Route::put('/progress/{id}',   [UserProgressController::class, 'update']);

    // Weekly Schedule
    Route::get('/schedule',      [WeeklyScheduleController::class, 'index']);
    Route::post('/schedule',     [WeeklyScheduleController::class, 'store']);
    Route::get('/schedule/{id}', [WeeklyScheduleController::class, 'show']);
    Route::put('/schedule/{id}', [WeeklyScheduleController::class, 'update']);

    // Workouts
    Route::get('/workouts',        [WorkoutController::class, 'index']);
    Route::post('/workouts',       [WorkoutController::class, 'store']);
    Route::get('/workouts/{id}',   [WorkoutController::class, 'show']);
    Route::delete('/workouts/{id}',[WorkoutController::class, 'destroy']);
});
