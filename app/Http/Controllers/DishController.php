<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;  // Add this

class DishController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $dishes = Dish::paginate($perPage);
        return view('dishes.index', compact('dishes'));
    }

    public function show(Dish $dish)
    {
        return view('dishes.show', compact('dish'));
    }

    public function create()
    {
        $categories = Category::all();
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

        // Add user_id to the validated data
        $validatedData['user_id'] = Auth::id(); // Get the logged in user's ID
        $dish = Dish::create($validatedData);

        return redirect()->route('dishes.show', $dish->id);
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

    public function edit(Dish $dish)
    {
        if (! Gate::allows('update-dish', $dish)) {
            abort(403, 'You are not authorized to edit this dish.');
        }
        $categories = Category::all();
        return view('dishes.edit', compact('dish', 'categories'));
    }

    public function destroy(Dish $dish)
    {
        if (! Gate::allows('delete-dish', $dish)) {
            abort(403, 'You are not authorized to delete this dish.');
        }
        $dish->delete();
        return redirect()->route('dishes.index')->with('success', 'Dish deleted successfully!');
    }
}
