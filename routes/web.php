<?php

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

use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\OrdersController;
use App\Http\Controllers\Site\ShoppingCartController;
use App\Http\Controllers\Admin\CKEditorController;
use App\Http\Controllers\Api\AppUserController;
use App\Http\Controllers\Site\ProductDetailController;
use App\Http\Controllers\Site\TranslateController;
use Illuminate\Support\Facades\Route;

Route::get('translate/{language}', [TranslateController::class, 'index'])->name("translate");

Route::middleware('localization')->group(function () {

    Route::get('', [HomeController::class, 'index'])->name("home");
    Route::get('/admin/orders', [OrdersController::class, 'index'])->name("admin-orders");
    Route::get('product/{slug}', [ProductDetailController::class, 'show'])->name("product-detail");
    Route::get('product/{slug}/cart', [ProductDetailController::class, 'cart'])->name("product-cart");
    Route::get('product/{slug}/cart/payment', [ProductDetailController::class, 'payment'])->name("product-payment");

    Route::post('ck/upload', [CKEditorController::class, 'ckUpload'])->name('ck.upload');

});
