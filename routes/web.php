<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\CatalogController;
use App\Http\Controllers\User\KeranjangController;
use App\Http\Controllers\User\FakturController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\BarangController;

// Root redirect
Route::get('/', function () {
    return redirect()->route('login');
});

// ── User Auth ──────────────────────────────────────────────────────────────
Route::get('/login',    [UserAuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [UserAuthController::class, 'login'])->name('login.post');
Route::post('/logout',  [UserAuthController::class, 'logout'])->name('logout');
Route::get('/register', [UserAuthController::class, 'showRegister'])->name('register');
Route::post('/register',[UserAuthController::class, 'register'])->name('register.post');

// ── User Pages ─────────────────────────────────────────────────────────────
Route::middleware('user.auth')->group(function () {
    Route::get('/catalog', [CatalogController::class, 'index'])->name('user.catalog');

    // Keranjang
    Route::get('/keranjang',            [KeranjangController::class, 'index'])->name('user.keranjang');
    Route::post('/keranjang/{id}',       [KeranjangController::class, 'add'])->name('user.keranjang.add');
    Route::patch('/keranjang/{id}',      [KeranjangController::class, 'update'])->name('user.keranjang.update');
    Route::delete('/keranjang/{id}',     [KeranjangController::class, 'remove'])->name('user.keranjang.remove');

    // Faktur
    Route::get('/faktur',               [FakturController::class, 'index'])->name('user.faktur.index');
    Route::get('/faktur/create',        [FakturController::class, 'create'])->name('user.faktur.create');
    Route::post('/faktur',              [FakturController::class, 'store'])->name('user.faktur.store');
    Route::get('/faktur/{id}',          [FakturController::class, 'show'])->name('user.faktur.show');
});

// ── Admin Auth ─────────────────────────────────────────────────────────────
Route::prefix('admin')->group(function () {
    Route::get('/login',  [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::post('/logout',[AdminAuthController::class, 'logout'])->name('admin.logout');

    // Admin CRUD (protected)
    Route::middleware('admin')->group(function () {
        Route::resource('barang', BarangController::class, [
            'names' => [
                'index'   => 'admin.barang.index',
                'create'  => 'admin.barang.create',
                'store'   => 'admin.barang.store',
                'show'    => 'admin.barang.show',
                'edit'    => 'admin.barang.edit',
                'update'  => 'admin.barang.update',
                'destroy' => 'admin.barang.destroy',
            ],
        ]);
    });
});
