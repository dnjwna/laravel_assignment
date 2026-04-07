<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\InstructorController;
use App\Http\Controllers\Api\EnrollmentController;


Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login',    [AuthController::class, 'login']);


    Route::middleware('jwt.auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me',      [AuthController::class, 'me']);
    });
});

Route::apiResource('categories', CategoryController::class);

Route::get('/courses',       [CourseController::class, 'index']);
Route::get('/courses/{id}',  [CourseController::class, 'show']);

Route::middleware('jwt.auth')->group(function () {
    Route::post('/courses',          [CourseController::class, 'store']);
    Route::put('/courses/{id}',      [CourseController::class, 'update']);
    Route::delete('/courses/{id}',   [CourseController::class, 'destroy']);
});


Route::get('/instructors/course-count', [InstructorController::class, 'courseCount']);

Route::get('/enrollments/detail', [EnrollmentController::class, 'detail']);