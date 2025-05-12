<!DOCTYPE html>
<html>
<head>
    <title>Создать категорию</title>
</head>
<body>
<h1>Создать категорию</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('categories.store') }}" method="POST">

    <div>
        <label for="name">Название:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
    </div>

    <button type="submit">Создать</button>
</form>
</body>
</html>
