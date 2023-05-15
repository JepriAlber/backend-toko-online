<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGalleryController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'verified']);

Route::get('/product/{id}/gallery', [ProductController::class, 'gallery'])->name('products.gallery')->middleware(['auth', 'verified']); //jika metode tidak ada di resouce maka posisikan lebih awal
Route::resource('products', ProductController::class)->middleware(['auth', 'verified']);
Route::resource('product-galleries', ProductGalleryController::class)->middleware(['auth', 'verified']);
Route::resource('transactions', TransactionController::class)->middleware(['auth', 'verified']);
