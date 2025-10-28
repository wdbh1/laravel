<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientApiController extends Controller
{
    public function index()
    {
        return Ingredient::all();
    }

    public function show(string $id)
    {
        return Ingredient::findOrFail($id);
    }

    public function store(Request $request) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}
