<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Category;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function index()
    {
        $dishes = Dish::all();
        return view('dishes.index', compact('dishes'));
    }

    public function show(Dish $dish)
    {
        return view('dishes.show', compact('dish'));
    }

    public function create()
    {
        $categories = Category::all();
        // Получаем ингредиенты
        // Если вы точно убрали все, что связано с ингредиентами,
        // то эту строчку можно убрать
        // $ingredients = Ingredient::all();
        // Передаем ингредиенты в представление
        // return view('dishes.create', compact('categories', 'ingredients'));
        return view('dishes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'preparation_method' => 'required',
            'preparation_time' => 'required|integer|min:0',
        ]);

        $dish = Dish::create($validatedData);

        return redirect()->route('dishes.show', $dish->id);
    }

    public function edit(Dish $dish)
    {
        $categories = Category::all();
        return view('dishes.edit', compact('dish', 'categories'));
    }

    public function update(Request $request, Dish $dish)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'preparation_method' => 'required',
            'preparation_time' => 'required|integer|min:0',
        ]);

        $dish->update($validatedData);

        return redirect()->route('dishes.show', $dish->id);
    }

    public function destroy(Dish $dish)
    {
        $dish->delete();
        return redirect()->route('dishes.index');
    }
}
