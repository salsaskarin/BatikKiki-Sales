<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellsController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/rules', [DashboardController::class,'rules'])->name('rules');

    Route::get('/produk', [ProductController::class,'show'])->name('produk');
    Route::get('/produk/tambahProduk', [ProductController::class,'addProduct'])->name('tambahProduk');
    Route::post('/produk/simpanProduk', [ProductController::class,'storeProduct'])->name('simpanProduk');
    Route::get('/produk/editProduk/{id}', [ProductController::class,'editProduct'])->name('editProduk');
    Route::put('/produk/updateProduk', [ProductController::class,'updateProduct'])->name('updateProduk');

    Route::get('/penjualan', [SellsController::class,'show'])->name('penjualan');
    Route::get('/penjualan/tambahPenjualan', [SellsController::class,'addSells'])->name('tambahPenjualan');

    Route::get('/penjualan/autocomplete-search', [SellsController::class,'autocomplete'])->name('autocomplete');
});

require __DIR__.'/auth.php';
