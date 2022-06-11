<?php

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\OrderController as ControllersOrderController;

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


Auth::routes();
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'auth.admin'] ,'as'=>'admin.'], function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('item', ItemController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('brand', BrandController::class);
    Route::resource('order', OrderController::class);
    Route::resource('user', UserController::class);
});

// Route::get('/',)

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('product/{item}', [ProductController::class, 'single'])->name('product.single');
Route::get('product/', [ProductController::class, 'all'])->name('product.all');
Route::get('search/', [ProductController::class, 'search'])->name('product.search');

Route::middleware(['auth'] )->group(function(){
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('cart/store', [CartController::class, 'store'])->name('cart.store');
    Route::delete('cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::patch('cart/{cart}/{type}', [CartController::class, 'update'])->name('cart.update');
    Route::get('checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('order', [ControllersOrderController::class, 'index'])->name('order.index');
    Route::post('order', [ControllersOrderController::class, 'store'])->name('order.store');
    Route::patch('order/{order}', [ControllersOrderController::class, 'update'])->name('order.update');
});