<?php

use App\Http\Controllers\AdminController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $categories = Category::get();
    return view('user.home',  compact('categories'));
});

Route::prefix('admin')->group(function(){
    Route::get('/', [AdminController::class, 'home'])->name('admin.home');

    Route::prefix('stok')->group(function(){
        Route::prefix('bahan_baku')->group(function(){
            Route::get('/', [AdminController::class, 'stok_bahan_baku_index'])->name('admin.stok.bahan_baku');
            Route::get('/{slug}', [AdminController::class, 'stok_bahan_baku_detail'])->name('admin.stok.bahan_baku.detail');
            Route::post('/{slug}', [AdminController::class, 'stok_bahan_baku_tambah']);
            Route::get('/hapus/{id}', [AdminController::class, 'stok_bahan_baku_hapus'])->name('admin.stok.bahan_baku.hapus');
        });
        Route::prefix('produk')->group(function(){
            Route::get('/', [AdminController::class, 'stok_produk_index'])->name('admin.stok.produk');
            Route::get('/{slug}', [AdminController::class, 'stok_produk_detail'])->name('admin.stok.produk.detail');
            Route::post('/{slug}', [AdminController::class, 'stok_produk_tambah']);
            Route::get('/hapus/{id}', [AdminController::class, 'stok_produk_hapus'])->name('admin.stok.produk.hapus');
        });
    });

    Route::prefix('permintaan')->group(function(){
        Route::get('/', [AdminController::class, 'permintaan_index'])->name('admin.permintaan');
        Route::get('/tambah', [AdminController::class, 'permintaan_tambah_index'])->name('admin.permintaan.tambah');
        Route::post('/tambah', [AdminController::class, 'permintaan_tambah']);
        Route::get('/hapus/{id}', [AdminController::class, 'permintaan_hapus'])->name('admin.permintaan.hapus');
        Route::get('/{id}', [AdminController::class, 'permintaan_detail'])->name('admin.permintaan.detail');
    });
});

Route::get('detail_bahan_baku', [AdminController::class, 'stok_bahan_baku_detail']);
