<?php

use App\Http\Controllers\Admin\MerekController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\VarianProdukController;
use App\Http\Controllers\KatalogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Route Modul Katalog
|--------------------------------------------------------------------------
| File ini di-require dari routes/web.php.
| Berisi route publik katalog dan route admin CRUD katalog.
*/

// === Route Publik (tidak perlu login) ===
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');
Route::get('/katalog/{produk}', [KatalogController::class, 'show'])->name('katalog.show');

// === Route Admin Katalog (perlu login + role admin) ===
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // CRUD Merek
    Route::resource('merek', MerekController::class)->except(['show']);

    // CRUD Produk
    Route::resource('produk', ProdukController::class);

    // CRUD Varian (nested di bawah produk, shallow)
    Route::resource('produk.varian', VarianProdukController::class)->shallow();
});
