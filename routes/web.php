<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::resource('categories', CategoryController::class);
Route::resource('dishes', DishController::class)->middleware('auth');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/test-destroy', function () {
    dd('test-destroy route hit!');
});
Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');
