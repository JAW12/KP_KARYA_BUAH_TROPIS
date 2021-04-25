<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\UserController;
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

Route::get('/', [GuestController::class, 'home'])->name('home');
Route::view('tentang', 'about')->name('about');
Route::view('kontak', 'contact')->name('contact');
Route::post('kontak/send', [GuestController::class, 'mail'])->name('send');


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

    Route::prefix('master')->group(function(){
        Route::prefix('produk')->group(function(){
            Route::get('/', [AdminController::class, 'master_produk_index'])->name('admin.master.produk');
            Route::get('/tambah', [AdminController::class, 'master_produk_tambah_index'])->name('admin.master.produk.tambah');
            Route::post('/tambah', [AdminController::class, 'master_produk_tambah']);
            Route::get('/{slug}', [AdminController::class, 'master_produk_detail'])->name('admin.master.produk.detail');
            Route::post('/{slug}', [AdminController::class, 'master_produk_ubah']);
            Route::get('/hapus/{id}', [AdminController::class, 'master_produk_hapus'])->name('admin.master.produk.hapus');
            Route::get('/restore/{id}', [AdminController::class, 'master_produk_restore'])->name('admin.master.produk.restore');
        });
        Route::prefix('kategori_buah')->group(function(){
            Route::get('/', [AdminController::class, 'master_kategori_buah_index'])->name('admin.master.kategori_buah');
            Route::prefix('kategori')->group(function(){
                Route::get('/tambah', [AdminController::class, 'master_kategori_tambah_index'])->name('admin.master.kategori.tambah');
                Route::post('/tambah', [AdminController::class, 'master_kategori_tambah']);
                Route::get('/{slug}', [AdminController::class, 'master_kategori_detail'])->name('admin.master.kategori.detail');
                Route::post('/{slug}', [AdminController::class, 'master_kategori_ubah']);
                Route::get('/hapus/{id}', [AdminController::class, 'master_kategori_hapus'])->name('admin.master.kategori.hapus');
                Route::get('/restore/{id}', [AdminController::class, 'master_kategori_restore'])->name('admin.master.kategori.restore');
            });
            Route::prefix('buah')->group(function(){
                Route::get('/tambah', [AdminController::class, 'master_buah_tambah_index'])->name('admin.master.buah.tambah');
                Route::post('/tambah', [AdminController::class, 'master_buah_tambah']);
                Route::get('/{slug}', [AdminController::class, 'master_buah_detail'])->name('admin.master.buah.detail');
                Route::post('/{slug}', [AdminController::class, 'master_buah_ubah']);
                Route::get('/hapus/{id}', [AdminController::class, 'master_buah_hapus'])->name('admin.master.buah.hapus');
                Route::get('/restore/{id}', [AdminController::class, 'master_buah_restore'])->name('admin.master.buah.restore');
            });
        });
    });

    Route::prefix('transaksi')->group(function(){
        Route::get('/', [AdminController::class, 'transaksi_index'])->name('admin.transaksi');
        Route::get('/tambah', [AdminController::class, 'permintaan_transaksi_index'])->name('admin.transaksi.tambah');
        Route::get('/tambah2', [AdminController::class, 'permintaan_transaksi_index2'])->name('admin.transaksi.tambah2');
        Route::post('/tambah', [AdminController::class, 'permintaan_transaksi']);
        Route::get('/hapus/{id}', [AdminController::class, 'transaksi_hapus'])->name('admin.transaksi.hapus');
        Route::get('/{id}', [AdminController::class, 'transaksi_detail'])->name('admin.transaksi.detail');
    });
});

// Route::get('detail_bahan_baku', [AdminController::class, 'stok_bahan_baku_detail']);
