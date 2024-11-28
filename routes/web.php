<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function(){
    Route::get('/profile',[ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/Profile',[ProfileController::class,'update'])->name('profile.update');
    Route::delete('/Profile',[ProfileController::class,'destroy'])->name('profile.destroy');
});

Route::middleware(['Role:admin,petugas'])->group(function () {
    Route::get('/user',[UserController::class,'index'])->name('user.index');
    Route::get('/user/create',[UserController::class,'create'])->name('user.create');
    Route::post('/user/create',[UserController::class,'store'])->name('user.store');
    Route::get('/user/edit/{id}',[UserController::class,'edit'])->name('user.edit');
    Route::put('/user/update/{id}',[UserController::class,'update'])->name('user.update');
    Route::delete('/user/{id}',[UserController::class,'destroy'])->name('user.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/buku',[BukuController::class,'index'])->name('buku.index');
    Route::get('/buku/create',[BukuController::class,'create'])->name('buku.create');
    Route::post('/buku/create',[BukuController::class,'store'])->name('buku.store');
    Route::get('/buku/edit/{id}',[BukuController::class,'edit'])->name('buku.edit');
    Route::put('/buku/update/{id}',[BukuController::class,'update'])->name('buku.update');
    Route::delete('/buku/{id}',[BukuController::class,'destroy'])->name('buku.destroy');

    Route::get('/kategori',[KategoriController::class,'index'])->name('kategori.index');
    Route::get('/kategori/create',[KategoriController::class,'create'])->name('kategori.create');
    Route::post('/kategori/create',[KategoriController::class,'store'])->name('kategori.store');
    Route::get('/kategori/edit/{id}',[KategoriController::class,'edit'])->name('kategori.edit');
    Route::put('/kategori/update/{id}',[KategoriController::class,'update'])->name('kategori.update');
    Route::delete('/kategori/{id}',[KategoriController::class,'destroy'])->name('kategori.destroy');
    
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::patch('/peminjaman/{peminjaman}/status', [PeminjamanController::class, 'updateStatus'])->name('peminjaman.updateStatus');
    Route::post('/peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::delete('/peminjaman/{peminjaman}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
});

require __DIR__.'/auth.php';
