<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\DishApiController;
use App\Http\Controllers\IngredientApiController;
use App\Http\Controllers\RecipeApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Маршруты для категорий
Route::get('/categories', [CategoryApiController::class, 'index']);
Route::get('/categories/{id}', [CategoryApiController::class, 'show']);

// Маршруты для блюд
Route::get('/dishes', [DishApiController::class, 'index']);
Route::get('/dishes/{id}', [DishApiController::class, 'show']);

// Маршруты для ингредиентов
Route::get('/ingredients', [IngredientApiController::class, 'index']);
Route::get('/ingredients/{id}', [IngredientApiController::class, 'show']);

// Маршруты для рецептов
Route::get('/recipes', [RecipeApiController::class, 'index']);
Route::get('/recipes/{id}', [RecipeApiController::class, 'show']);
