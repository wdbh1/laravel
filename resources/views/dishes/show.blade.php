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


</body>
</html>
