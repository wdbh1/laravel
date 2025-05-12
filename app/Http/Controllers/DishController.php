<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Category;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DishController extends Controller
{
    public function index()
    {
        $dishes = Dish::all();
        return view('dishes.index', compact('dishes'));
    }

    public function show(Dish $dish)
    {
        $ingredients = $dish->ingredients;
        return view('dishes.show', compact('dish', 'ingredients'));
    }

    public function create()
    {
        $categories = Category::all();
        $ingredients = Ingredient::all();
        return view('dishes.create', compact('categories', 'ingredients'));
    }

    public function store(Request $request)
    {
        // Валидация данных
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'preparation_method' => 'required',
            'preparation_time' => 'required|integer|min:0',
            'ingredients' => 'array',
            'ingredients.*.ingredient_id' => 'required|exists:ingredients,id',
            'ingredients.*.quantity' => 'required|numeric|min:0.01',
        ]);

        $dish = Dish::create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'preparation_method' => $validatedData['preparation_method'],
            'preparation_time' => $validatedData['preparation_time'],
        ]);

        $ingredientsData = $validatedData['ingredients'];
        $dish->ingredients()->attach(collect($ingredientsData)->pluck('ingredient_id')->toArray(), collect($ingredientsData)->pluck('quantity')->map(function ($q) {
            return (float)$q;
        })->toArray());


        return redirect()->route('dishes.show', $dish->id);

    }
}
