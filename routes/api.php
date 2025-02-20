<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Task\TaskController;
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

Route::name('auth.')->controller(AuthController::class)->group(function () {
    Route::post('auth/login', 'login')->name('login');
    Route::post('auth/register', 'register')->name('register');
    Route::post('auth/logout', 'logout')->name('logout')->middleware('auth:sanctum');
});


Route::middleware('auth:sanctum')->controller(TaskController::class)->prefix('/task')->group(function () {
    Route::get('/all', 'index');
    Route::post('/create', 'store');
    Route::put('/update/{task}', 'update');
    Route::delete('/delete/{task}', 'destroy');
});