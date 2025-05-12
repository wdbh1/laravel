<!DOCTYPE html>
<html>
<head>
    <title>Категория: {{ $category->name }}</title>
</head>
<body>
<h1>Категория: {{ $category->name }}</h1>
<p>ID: {{ $category->id }}</p>

<h2>Блюда в этой категории:</h2>
@if($dishes->count() > 0)
    <ul>
        @foreach ($dishes as $dish)
            <li>{{ $dish->name }}</li>
        @endforeach
    </ul>
@else
    <p>В этой категории нет блюд.</p>
@endif
</body>
</html>
