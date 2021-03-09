<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::post('/dashboard', [DashboardController::class, 'store'])->middleware('auth');
Route::delete('/dashboard/{id}', [DashboardController::class, 'destroy'])->middleware('auth');
Route::put('/dashboard/{id}', [DashboardController::class, 'update'])->middleware('auth');
Route::get('/dashboard/edit/{id}', [DashboardController::class, 'show'])->middleware('auth');

Route::get('/dashboard/input', [DashboardController::class, 'input'])->middleware('auth');

Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');
