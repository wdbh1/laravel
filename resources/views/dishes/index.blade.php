<!DOCTYPE html>
<html>
<head>
    <title>Все блюда</title>
</head>
<body>
<h1>Все блюда</h1>
<a href="{{ route('dishes.create') }}">Создать новое блюдо</a>
<ul>
    @foreach ($dishes as $dish)
        <li>
            <a href="{{ route('dishes.show', $dish->id) }}">{{ $dish->name }}</a>
            <a href="{{ route('dishes.edit', $dish->id) }}">Редактировать</a>  <!-- Добавлена кнопка Редактировать -->
            <form action="{{ route('dishes.destroy', $dish->id) }}" method="POST" style="display: inline;">  <!-- Добавлена кнопка Удалить -->
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Вы уверены?')">Удалить</button>  <!-- Добавлено подтверждение удаления -->
            </form>
        </li>
    @endforeach
</ul>
</body>
</html>
