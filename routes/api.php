<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\DishApiController;
use App\Http\Controllers\IngredientApiController;
use App\Http\Controllers\RecipeApiController;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', [AuthController::class, 'user']);

    Route::get('/categories', [CategoryApiController::class, 'index']);
    Route::get('/categories/{id}', [CategoryApiController::class, 'show']);

    Route::get('/dishes', [DishApiController::class, 'index']);
    Route::get('/dishes/{id}', [DishApiController::class, 'show']);

    Route::get('/ingredients', [IngredientApiController::class, 'index']);
    Route::get('/ingredients/{id}', [IngredientApiController::class, 'show']);

    Route::get('/recipes', [RecipeApiController::class, 'index']);
    Route::get('/recipes/{id}', [RecipeApiController::class, 'show']);
});
