<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPersonalDetailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes - no authentication needed
Route::prefix('auth')->group(function () {
    // Register with personal details
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// Protected routes - require authentication
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    
    // Current user
    Route::get('/user/profile', [AuthController::class, 'profile']);
    Route::put('/user/profile', [UserController::class, 'updateProfile']);
    
    // User personal details
    Route::get('/user/personal-details', [UserPersonalDetailController::class, 'getCurrentUserDetails']);
    Route::post('/user/personal-details', [UserPersonalDetailController::class, 'storeCurrentUserDetails']);
    Route::put('/user/personal-details', [UserPersonalDetailController::class, 'updateCurrentUserDetails']);
    Route::get('/user/bmi', [UserPersonalDetailController::class, 'getCurrentUserBMI']);
});

