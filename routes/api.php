<?php

use App\Http\Controllers\Api\Auth\AuthController;
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

Route::name('auth.')
    ->controller(AuthController::class)
    ->group(function () {
        Route::post('auth/login', 'login')->name('login');
        Route::post('auth/register', 'register')->name('register');
        Route::post('auth/logout', 'logout')->name('logout')->middleware('auth:sanctum');
    });