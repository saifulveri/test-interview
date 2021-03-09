<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::post('/login', [LoginController::class, 'storeApi']);

Route::middleware('auth:api')->group(function () {
    Route::get('/all-users', [DashboardController::class, 'indexApi']);
    Route::get('/user-by-id/{id}', [DashboardController::class, 'showApi']);
    Route::post('/user', [DashboardController::class, 'storeApi']);
    Route::put('/user/{id}', [DashboardController::class, 'updateApi']);
    Route::delete('/user/{id}', [DashboardController::class, 'destroyApi']);
});
