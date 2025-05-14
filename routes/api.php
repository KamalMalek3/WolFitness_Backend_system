<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPersonalDetailController;
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
    Route::get('/user/personal-details',  [UserPersonalDetailController::class, 'getUserDetails']);
    Route::post('/user/personal-details', [UserPersonalDetailController::class, 'storeUserDetails']);
    Route::put('/user/personal-details',  [UserPersonalDetailController::class, 'updateUserDetails']);
    Route::get('/user/bmi',               [UserPersonalDetailController::class, 'getCurrentUserBMI']);

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
