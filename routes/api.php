<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\CustomerController;


Route::post('login', [AuthController::class, 'login']);  
Route::post('register', [AuthController::class, 'register']);  

// Authenticated routes
Route::middleware('auth:api')->put('/users/{id}', [AuthController::class, 'update']);

Route::apiResource('customers', CustomerController::class);
