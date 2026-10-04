<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;

// Public routes
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Student CRUD
    Route::apiResource('students', StudentController::class);
    
    // Additional endpoints for background data can be added here
    // Route::apiResource('students.family', FamilyBackgroundController::class);
});