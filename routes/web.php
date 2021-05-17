<?php

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;

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
Auth::viaRemember();

Route::get('/coba', [GuestController::class, 'coba'])->name('coba');

Route::get('/', [GuestController::class, 'home'])->name('home');
Route::view('tentang', 'about')->name('about');
Route::view('kontak', 'contact')->name('contact');
Route::post('kontak/send', [GuestController::class, 'mail'])->name('send');
Route::get('galeri', [GuestController::class, 'gallery'])->name('gallery');
Route::get('produk', [GuestController::class, 'produk_index'])->name('product-list');
Route::get('produk/search', [GuestController::class, 'produk_index'])->name('search.products');
Route::get('category/{category:slug}', [GuestController::class, 'produk_category'])->name('category-products');
Route::get('buah/{label:slug}', [GuestController::class, 'produk_fruit'])->name('label-products');
Route::get('produk/{product:slug}', [GuestController::class, 'produk_detail'])->name('product-detail');

Route::middleware("auth")->group(function(){
    Route::get('profil', [UserController::class, 'profilePage'])->name('profile');
    Route::post('profil', [UserController::class, 'profileSubmit']);

    Route::get('keranjang', [UserController::class, 'cartsPage'])->name('carts');
    Route::get('keranjang/tambah/{id}', [UserController::class, 'tambahCart'])->name('carts.tambah');
    Route::get('keranjang/kurang/{id}', [UserController::class, 'kurangCart'])->name('carts.kurang');
    Route::get('keranjang/hapus/{id}', [UserController::class, 'hapusCart'])->name('carts.hapus');
    Route::get('keranjang/checkout', [UserController::class, 'checkoutCart'])->name('carts.checkout');

    Route::post('produk/{product:slug}', [UserController::class, 'addtocart']);
});

Route::middleware('guest')->group(function(){
    Route::get('/login', [GuestController::class, 'loginPage'])->name('login');
    Route::post('/login', [GuestController::class, 'login']);

    Route::get('/register', [GuestController::class, 'registerPage'])->name('register');
    Route::post('/register', [GuestController::class, 'register']);

    Route::get('/forgot', [GuestController::class, 'forgotPage'])->name('forgot');
    Route::post('/forgot', [GuestController::class, 'forgot']);
});

// check verification
Route::get('/verification', [GuestController::class, 'verifyUser'])->name('verification');

// reset password page
Route::get('/reset', [GuestController::class, 'resetPage'])->name('password.reset');
Route::post('/reset', [GuestController::class, 'reset']);

Route::prefix('admin')->group(function(){

    Route::get('/login', [AdminController::class, 'adminLoginPage'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);

    Route::middleware('admin')->group(function(){
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
            Route::prefix('pegawai')->group(function(){
                Route::get('/', [AdminController::class, 'master_pegawai_index'])->name('admin.master.pegawai');
                Route::get('/tambah', [AdminController::class, 'master_pegawai_tambah_index'])->name('admin.master.pegawai.tambah');
                Route::post('/tambah', [AdminController::class, 'master_pegawai_tambah']);
                Route::get('/{username}', [AdminController::class, 'master_pegawai_detail'])->name('admin.master.pegawai.detail');
                Route::post('/{username}', [AdminController::class, 'master_pegawai_ubah']);
                Route::get('/hapus/{id}', [AdminController::class, 'master_pegawai_hapus'])->name('admin.master.pegawai.hapus');
                Route::get('/restore/{id}', [AdminController::class, 'master_pegawai_restore'])->name('admin.master.pegawai.restore');
            });
        });

        Route::prefix('transaksi')->group(function(){
            Route::get('/', [AdminController::class, 'transaksi_index'])->name('admin.transaksi');
            Route::get('/tambah', [AdminController::class, 'transaksi_tambah_index'])->name('admin.transaksi.tambah');
            Route::get('/tambah-detail', [AdminController::class, 'transaksi_tambah_index2'])->name('admin.transaksi.tambah-dtrans');
            Route::post('/tambah', [AdminController::class, 'transaksi_tambah']);
            Route::post('/tambah-detail', [AdminController::class, 'transaksi_tambah_dtrans']);
            Route::get('/hapus/{id}', [AdminController::class, 'transaksi_hapus'])->name('admin.transaksi.hapus');
            Route::get('/{id}', [AdminController::class, 'transaksi_detail'])->name('admin.transaksi.detail');
        });
    });
});

// Route::get('detail_bahan_baku', [AdminController::class, 'stok_bahan_baku_detail']);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/hash', [AdminController::class, 'hash']);
