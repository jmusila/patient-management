<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('api')->group(function () {
    Route::post('user/create', [UserController::class, 'store']);
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('users', UserController::class)->except('store');
    Route::apiResource('patients', PatientController::class);
    Route::apiResource('receptionists', ReceptionistController::class);
});
