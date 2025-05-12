<!DOCTYPE html>
<html>
<head>
    <title>Все категории</title>
</head>
<body>
<h1>Все категории</h1>
<ul>
    @foreach ($categories as $category)
        <li><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></li>
    @endforeach
</ul>
</body>
</html>
