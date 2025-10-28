<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function show(string $id)
    {
        return Category::findOrFail($id);
    }

    // Остальные методы можно оставить пустыми
    public function store(Request $request) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}
