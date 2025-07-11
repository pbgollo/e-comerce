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
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PillarController;
use Illuminate\Support\Facades\Route;

use App\Models\ProductModel;
use Illuminate\Http\Request;



Route::post('app-user/register', [AppUserController::class, 'register'])->name('register');
Route::post('app-user/login', [AppUserController::class, 'login'])->name('login');


Route::post('orders/calculate', [OrderController::class, 'calculateTotal'])->name('orders.calculate');

Route::middleware(['jwt', 'jwt-auth'])->group(function () {
    Route::get('app-user/me', [AppUserController::class, 'getCurrentUser'])->name('me');

    Route::post('orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index']);
    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus']);
});


// Rotas públicas que NÃO exigem autenticação
Route::group(['middleware' => ['api']], function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
});
