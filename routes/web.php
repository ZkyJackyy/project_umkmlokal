<?php

use App\Http\Controllers\UserController;
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
Route::get('/list-product',[UserController::class, 'index'])-> name('products.index')->middleware('auth');


