<!DOCTYPE html>
<html>
<head>
    <title>Все блюда</title>
</head>
<body>
<h1>Все блюда</h1>
<ul>
    @foreach ($dishes as $dish)
        <li><a href="{{ route('dishes.show', $dish->id) }}">{{ $dish->name }}</a></li>
    @endforeach
</ul>
</body>
</html>
