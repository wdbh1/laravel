<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Ingredient;

// Добавляем ингредиенты
$ingredients = [
    ['name' => 'Мука', 'unit' => 'г'],
    ['name' => 'Сахар', 'unit' => 'г'],
    ['name' => 'Соль', 'unit' => 'г'],
    ['name' => 'Вода', 'unit' => 'мл'],
    ['name' => 'Молоко', 'unit' => 'мл'],
    ['name' => 'Яйца', 'unit' => 'шт'],
    ['name' => 'Масло растительное', 'unit' => 'мл'],
    ['name' => 'Масло сливочное', 'unit' => 'г'],
    ['name' => 'Лук', 'unit' => 'шт'],
    ['name' => 'Морковь', 'unit' => 'шт'],
    ['name' => 'Картофель', 'unit' => 'шт'],
    ['name' => 'Помидоры', 'unit' => 'шт'],
    ['name' => 'Перец болгарский', 'unit' => 'шт'],
    ['name' => 'Чеснок', 'unit' => 'зубч'],
    ['name' => 'Зелень', 'unit' => 'г'],
    ['name' => 'Мясо', 'unit' => 'г'],
    ['name' => 'Курица', 'unit' => 'г'],
    ['name' => 'Рыба', 'unit' => 'г'],
    ['name' => 'Сметана', 'unit' => 'г'],
    ['name' => 'Сыр', 'unit' => 'г']
];

foreach ($ingredients as $ingredient) {
    Ingredient::create($ingredient);
}

echo "Добавлено " . count($ingredients) . " ингредиентов!\n";
