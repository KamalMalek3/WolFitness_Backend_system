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

// Public routes - no authentication needed
Route::prefix('auth')->group(function () {
    // Register with personal details
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login',    [AuthController::class, 'login']);
});

// Protected routes - require authentication
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    
    // Current user
    Route::get('/user/profile', [AuthController::class, 'profile']);
    Route::put('/user/profile', [UserController::class, 'updateProfile']);
    
    // User personal details
    Route::get('/user/personal-details',    [UserPersonalDetailController::class, 'getUserDetails']);
    Route::post('/user/personal-details',   [UserPersonalDetailController::class, 'storeUserDetails']);
    Route::put('/user/personal-details',    [UserPersonalDetailController::class, 'updateUserDetails']);
    Route::get('/user/bmi',                 [UserPersonalDetailController::class, 'getCurrentUserBMI']);

    Route::get('/progress', [UserProgressController::class, 'index']);
    Route::post('/progress', [UserProgressController::class, 'store']);
Route::get('/progress/{id}', [UserProgressController::class, 'show']);
Route::put('/progress/{id}', [UserProgressController::class, 'update']);


Route::get('/schedule', [WeeklyScheduleController::class, 'index']);
Route::post('/schedule', [WeeklyScheduleController::class, 'store']);
Route::get('/schedule/{id}', [WeeklyScheduleController::class, 'show']);
Route::put('/schedule/{id}', [WeeklyScheduleController::class, 'update']);

Route::get('/workouts', [WorkoutController::class, 'index']);
Route::post('/workouts', [WorkoutController::class, 'store']);
Route::get('/workouts/{id}', [WorkoutController::class, 'show']);
Route::delete('/workouts/{id}', [WorkoutController::class, 'destroy']);
});



