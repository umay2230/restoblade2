<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('user', [UserController::class, 'index'])->name('userindex');
    Route::get('user/create', [UserController::class, 'create'])->name('usercreate');
    Route::post('user', [UserController::class, 'store'])->name('userstore');
    Route::delete('user/{user}', [UserController::class, 'destroy'])->name('userdestroy');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('useredit');
    Route::put('user/{id}', [UserController::class, 'update'])->name('userupdate');

    Route::get('produk', [ProductController::class, 'index'])->name('produkindex');
    Route::get('produk/create', [ProductController::class, 'create'])->name('produkcreate');
    Route::post('produk', [ProductController::class, 'store'])->name('produkstore');
    Route::delete('produk/{produk}', [ProductController::class, 'destroy'])->name('produkdestroy');
    Route::get('produk/edit/{id}', [ProductController::class, 'edit'])->name('produkedit');
    Route::put('produk/{id}', [ProductController::class, 'update'])->name('produkupdate');
});

require __DIR__.'/auth.php';