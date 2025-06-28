<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureUserIsSeller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function() {
    return view('pages.registrasi');
});

Route::post('/registrasi', [UserController::class, 'regis'])->name('user.regis');
Route::get('/login', [UserController::class, 'viewlogin'])->name('login.view');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/list-product',[ProductController::class, 'index'])-> name('products.index')->middleware('auth');

Route::get('/store/create', [StoreController::class, 'create'])->name('store.create')->middleware('auth',EnsureUserIsSeller::class);
// Route::get('/list-store', [StoreController::class, 'index'])-> name('store.index')->middleware('auth',EnsureUserIsSeller::class);
Route::post('/store', [StoreController::class, 'store'])->name('store.store')->middleware('auth',EnsureUserIsSeller::class);

Route::get('/store/home', [StoreController::class, 'home'])->name('store.home')->middleware('auth',EnsureUserIsSeller::class);

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
})->name('logout');

Route::get('/product/create', [ProductController::class, 'create'])->name('product.create')->middleware('auth',EnsureUserIsSeller::class);
Route::post('/products', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('edit.product')->middleware('auth',EnsureUserIsSeller::class);
Route::put('/product/{id}', [ProductController::class, 'update'])->name('update.product')->middleware('auth',EnsureUserIsSeller::class);
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('delete.product')->middleware('auth',EnsureUserIsSeller::class);

