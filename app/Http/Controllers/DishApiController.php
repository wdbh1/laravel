<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;

class DishApiController extends Controller
{
    public function index()
    {
        return Dish::with('category')->get();
    }

    public function show(string $id)
    {
        return Dish::with('category')->findOrFail($id);
    }

    public function store(Request $request) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}
