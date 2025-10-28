<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeApiController extends Controller
{
    public function index()
    {
        return Recipe::with(['dish', 'ingredient'])->get();
    }

    public function show(string $id)
    {
        return Recipe::with(['dish', 'ingredient'])->findOrFail($id);
    }

    public function store(Request $request) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}
