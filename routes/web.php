<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\ReportController;
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
    return redirect()->route('produk');
})->middleware('auth')->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/rules', function() {
        return view('rules');
    })->name('rules');

    Route::get('/produk', [ProductController::class,'show'])->name('produk');
    Route::get('/produk/detailProduk/{id}', [ProductController::class,'details'])->name('detailProduk');
    Route::get('/produk/tambahProduk', [ProductController::class,'addProduct'])->name('tambahProduk');
    Route::post('/produk/simpanProduk', [ProductController::class,'storeProduct'])->name('simpanProduk');
    Route::get('/produk/editProduk/{id}', [ProductController::class,'editProduct'])->name('editProduk');
    Route::put('/produk/updateProduk', [ProductController::class,'updateProduct'])->name('updateProduk');
    Route::get('/produk/hapusProduk/{id}', [ProductController::class, 'deleteProduct'])->name('hapusProduk');
    Route::get('/search', [ProductController::class, 'search'])->name('search');

    Route::get('/penjualan', [SellsController::class,'show'])->name('penjualan');
    Route::get('/penjualan/tambahPenjualan', [SellsController::class,'addSells'])->name('tambahPenjualan');
    Route::post('/penjualan/simpanPenjualan', [SellsController::class,'storeSells'])->name('simpanPenjualan');
    Route::get('/penjualan/editPenjualan/{id}', [SellsController::class,'editSells'])->name('editPenjualan');
    Route::put('/penjualan/updatePenjualan', [SellsController::class,'updateSells'])->name('updatePenjualan');
    Route::get('/penjualan/hapusPenjualan/{id}', [SellsController::class, 'deleteSells'])->name('hapusPenjualan');

    Route::get('/penjualan/autocomplete-search', [SellsController::class,'autocomplete'])->name('autocomplete');
    Route::get('/penjualan/filterPenjualan', [SellsController::class, 'sellsReport'])->name('filterPenjualan');

    Route::middleware('isadmin')->group(function () {
    Route::get('/biaya', [ExpensesController::class,'show'])->name('biaya');
    Route::get('/biaya/tambahBiaya', [ExpensesController::class,'addExpenses'])->name('tambahBiaya');
    Route::post('/biaya/simpanBiaya', [ExpensesController::class,'storeExpenses'])->name('simpanBiaya');
    Route::get('/biaya/editBiaya/{id}', [ExpensesController::class,'editExpenses'])->name('editBiaya');
    Route::put('/biaya/updateBiaya', [ExpensesController::class,'updateExpenses'])->name('updateBiaya');
    Route::get('/biaya/hapusBiaya/{id}', [ExpensesController::class, 'deleteExpenses'])->name('hapusBiaya');

    Route::get('/user', [App\Http\Controllers\Auth\RegisteredUserController::class,'show'])->name('user');
    Route::get('/user/tambahUser', [App\Http\Controllers\Auth\RegisteredUserController::class,'create'])->name('tambahUser');
    Route::post('/user/simpanUser', [App\Http\Controllers\Auth\RegisteredUserController::class,'store'])->name('simpanUser');
    Route::post('/user/makeAdmin/{id}', [App\Http\Controllers\Auth\RegisteredUserController::class, 'makeAdmin'])->name('completedUpdate');
    Route::get('/user/editUser/{id}', [App\Http\Controllers\Auth\RegisteredUserController::class,'editUser'])->name('editUser');
    Route::put('/user/updateUser', [App\Http\Controllers\Auth\RegisteredUserController::class,'updateUser'])->name('updateUser');
    Route::get('/user/hapusUser/{id}', [App\Http\Controllers\Auth\RegisteredUserController::class, 'deleteUser'])->name('hapusUser');
    Route::get('/searchUser', [App\Http\Controllers\Auth\RegisteredUserController::class, 'searchUser'])->name('searchUser');

    Route::get('/laporan', [ReportController::class,'show'])->name('laporanKeuangan');
    Route::get('/laporan/cetakpdf', [ReportController::class,'cetakPdf'])->name('cetakPdf');
    Route::get('/laporan/cetakpdffilter', [ReportController::class,'cetakPdfFiltered'])->name('cetakPdfFiltered');

    Route::get('/biaya/filterBiaya', [ExpensesController::class, 'expensesReport'])->name('filterBiaya');
    Route::get('/laporan/filterLaporan', [ReportController::class, 'reportReport'])->name('filterLaporan');
       });

    

});

require __DIR__.'/auth.php';
