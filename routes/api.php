<?php

/*
|--------------------------------------------------------------------------
| API Routes - /api
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers\Api\AppUserController;
use App\Http\Controllers\Api\EvaluationController;
use App\Http\Controllers\Api\GeneralController;
use App\Http\Controllers\Api\PillarController;
use Illuminate\Support\Facades\Route;

Route::post('app-user/login', [AppUserController::class, 'login'])->name('login');
Route::post('app-user/register', [AppUserController::class, 'register'])->name('register');

Route::middleware(['jwt','jwt-auth'])->group(function () {
    Route::get('app-user/me', [AppUserController::class, 'getCurrentUser'])->name('me');
});
