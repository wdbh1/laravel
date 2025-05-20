@extends('layouts.app')

@section('title', 'Dishes')

@section('content')
    <h1>Dishes</h1>

    <a href="{{ route('dishes.create') }}" class="btn btn-primary mb-3">Create New Dish</a>

    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($dishes as $dish)
            <tr>
                <td>{{ $dish->name }}</td>
                <td>{{ $dish->category->name }}</td>
                <td>
                    <a href="{{ route('dishes.edit', $dish->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('dishes.destroy', $dish->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $dishes->links() }}
@endsection
