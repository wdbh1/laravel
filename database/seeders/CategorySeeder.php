<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Салаты']);
        Category::create(['name' => 'Супы']);
        Category::create(['name' => 'Второе']);
        Category::create(['name' => 'Выпечка']);
    }
}
