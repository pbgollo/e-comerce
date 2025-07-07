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
use App\Http\Controllers\Site\SearchController;
use App\Http\Controllers\Site\TranslateController;
use Illuminate\Support\Facades\Route;

Route::get('translate/{language}', [TranslateController::class, 'index'])->name("translate");

Route::middleware('localization')->group(function () {

    Route::get('', [HomeController::class, 'index'])->name("home");


    //Rota para ver pedidos de um determinado cliente
    Route::get('/admin/pedidos', [OrdersController::class, 'admin'])->name('admin.orders');



    //Rota para ver detalhes do produto:
    Route::get('product/{slug}', [ProductDetailController::class, 'show'])->name("product-detail");

    // Alterar e melhorar rotas abaixo:
    Route::get('/cart', [OrdersController::class, 'cart'])->name("admin.cart");

    // Rotas para pesquisa de produtos na página inicial:
    Route::get('/busca', [SearchController::class, 'search'])->name("product-search");
    Route::get('/filtra', [SearchController::class, 'filter'])->name("product-filter");




    Route::post('ck/upload', [CKEditorController::class, 'ckUpload'])->name('ck.upload');

});
