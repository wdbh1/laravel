<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DishController;
use Illuminate\Support\Facades\Route;

Route::resource('categories', CategoryController::class);  // Добавит все необходимые маршруты для CategoryController
Route::resource('dishes', DishController::class);   // Добавит все необходимые маршруты для DishControllerphp artisan route:cache
