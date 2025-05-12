<!DOCTYPE html>
<html>
<head>
    <title>Редактировать блюдо: {{ $dish->name }}</title>
</head>
<body>
<h1>Редактировать блюдо: {{ $dish->name }}</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('dishes.update', $dish->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="category_id">Категория:</label>
        <select id="category_id" name="category_id" required>
            <option value="">-- Выберите категорию --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $dish->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="name">Название:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $dish->name) }}" required>
    </div>

    <div>
        <label for="preparation_method">Способ приготовления:</label>
        <textarea id="preparation_method" name="preparation_method" required>{{ old('preparation_method', $dish->preparation_method) }}</textarea>
    </div>

    <div>
        <label for="preparation_time">Время приготовления (минут):</label>
        <input type="number" id="preparation_time" name="preparation_time" value="{{ old('preparation_time', $dish->preparation_time) }}" required>
    </div>

    <button type="submit">Обновить</button>
</form>
</body>
</html>
