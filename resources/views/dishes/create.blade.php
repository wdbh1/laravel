@extends('layouts.app')

@section('title', 'Create Dish')

@section('content')
    <h1>Create Dish</h1>

    <form action="{{ route('dishes.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="category_id">Category:</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="preparation_method">Preparation Method:</label>
            <textarea class="form-control" id="preparation_method" name="preparation_method" rows="3" required>{{ old('preparation_method') }}</textarea>
        </div>

        <div class="form-group">
            <label for="preparation_time">Preparation Time (minutes):</label>
            <input type="number" class="form-control" id="preparation_time" name="preparation_time" value="{{ old('preparation_time') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
