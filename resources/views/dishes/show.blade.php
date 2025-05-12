<!DOCTYPE html>
<html>
<head>
    <title>Блюдо: {{ $dish->name }}</title>
</head>
<body>
<h1>Блюдо: {{ $dish->name }}</h1>
<p>ID: {{ $dish->id }}</p>
<p>Способ приготовления: {{ $dish->preparation_method }}</p>
<p>Время приготовления: {{ $dish->preparation_time }} минут</p>

<p>Категория: {{ $dish->category->name }}</p> <!-- Выводим категорию блюда -->

<h2>Ингредиенты:</h2>
@if($ingredients->count() > 0)
    <ul>
        @foreach ($ingredients as $ingredient)
            <li>{{ $ingredient->name }} ({{ $ingredient->pivot->quantity }} {{ $ingredient->unit }})</li>
        @endforeach
    </ul>
@else
    <p>Нет ингредиентов.</p>
@endif
</body>
</html>
