<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Category;
use App\Models\Dish;
use App\Models\Ingredient;
use App\Models\Recipe;

// Очистка старых данных
Recipe::truncate();
Dish::truncate();
Ingredient::truncate();
Category::truncate();

// Создание категорий
$soup = Category::create(['name' => 'Супы']);
$main = Category::create(['name' => 'Основные блюда']);
$dessert = Category::create(['name' => 'Десерты']);

// Создание ингредиентов
$flour = Ingredient::create(['name' => 'Мука', 'unit' => 'г']);
$water = Ingredient::create(['name' => 'Вода', 'unit' => 'мл']);
$salt = Ingredient::create(['name' => 'Соль', 'unit' => 'г']);
$sugar = Ingredient::create(['name' => 'Сахар', 'unit' => 'г']);

// Создание блюд
$borscht = Dish::create([
    'category_id' => $soup->id,
    'name' => 'Борщ',
    'preparation_method' => 'Варить овощи 40 минут',
    'preparation_time' => 60,
    'user_id' => 1
]);

$cake = Dish::create([
    'category_id' => $dessert->id,
    'name' => 'Торт',
    'preparation_method' => 'Выпекать в духовке',
    'preparation_time' => 120,
    'user_id' => 1
]);

// Создание рецептов
Recipe::create([
    'dish_id' => $borscht->id,
    'ingredient_id' => $water->id,
    'quantity' => 1000
]);

Recipe::create([
    'dish_id' => $borscht->id,
    'ingredient_id' => $salt->id,
    'quantity' => 10
]);

Recipe::create([
    'dish_id' => $cake->id,
    'ingredient_id' => $flour->id,
    'quantity' => 500
]);

Recipe::create([
    'dish_id' => $cake->id,
    'ingredient_id' => $sugar->id,
    'quantity' => 200
]);

echo "Тестовые данные добавлены!\n";
