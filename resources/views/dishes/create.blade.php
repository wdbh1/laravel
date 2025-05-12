<!DOCTYPE html>
<html>
<head>
    <title>Создать блюдо</title>
    <style>
        .ingredient-row {
            margin-bottom: 10px;
        }
        .remove-ingredient {
            margin-left: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<h1>Создать блюдо</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('dishes.store') }}" method="POST">
    @csrf

    <div>
        <label for="category_id">Категория:</label>
        <select id="category_id" name="category_id" required>
            <option value="">-- Выберите категорию --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="name">Название:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
    </div>

    <div>
        <label for="preparation_method">Способ приготовления:</label>
        <textarea id="preparation_method" name="preparation_method" required>{{ old('preparation_method') }}</textarea>
    </div>

    <div>
        <label for="preparation_time">Время приготовления (минут):</label>
        <input type="number" id="preparation_time" name="preparation_time" value="{{ old('preparation_time') }}" required>
    </div>

    <!-- Секция для ингредиентов -->
    <h2>Ингредиенты</h2>
    <div id="ingredients-container">
        @if(old('ingredients'))
            @foreach(old('ingredients') as $index => $ingredientData)
                <div class="ingredient-row">
                    <label for="ingredients[{{ $index }}][ingredient_id]">Ингредиент:</label>
                    <select name="ingredients[{{ $index }}][ingredient_id]" required>
                        <option value="">-- Выберите ингредиент --</option>
                        @foreach ($ingredients as $ingredient)
                            <option value="{{ $ingredient->id }}" {{ old("ingredients.$index.ingredient_id") == $ingredient->id ? 'selected' : '' }}>{{ $ingredient->name }}</option>
                        @endforeach
                    </select>

                    <label for="ingredients[{{ $index }}][quantity]">Количество:</label>
                    <input type="number" step="0.01" name="ingredients[{{ $index }}][quantity]" value="{{ old("ingredients.$index.quantity") }}" required style="width: 80px;">

                    <span class="remove-ingredient" onclick="removeIngredientRow(this)">Удалить</span>
                </div>
            @endforeach
        @else
            <div class="ingredient-row">
                <label for="ingredients[0][ingredient_id]">Ингредиент:</label>
                <select name="ingredients[0][ingredient_id]" required>
                    <option value="">-- Выберите ингредиент --</option>
                    @foreach ($ingredients as $ingredient)
                        <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                    @endforeach
                </select>

                <label for="ingredients[0][quantity]">Количество:</label>
                <input type="number" step="0.01" name="ingredients[0][quantity]" value="" required style="width: 80px;">
            </div>
        @endif
    </div>
    <button type="button" onclick="addIngredientRow()">Добавить ингредиент</button>

    <button type="submit">Создать</button>
</form>

<script>
    let ingredientIndex = {{ old('ingredients') ? count(old('ingredients')) : 1 }}; // Start index

    function addIngredientRow() {
        const container = document.getElementById('ingredients-container');
        const newRow = document.createElement('div');
        newRow.classList.add('ingredient-row');
        newRow.innerHTML = `
                <label for="ingredients[${ingredientIndex}][ingredient_id]">Ингредиент:</label>
                <select name="ingredients[${ingredientIndex}][ingredient_id]" required>
                    <option value="">-- Выберите ингредиент --</option>
                    @foreach ($ingredients as $ingredient)
        <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                    @endforeach
        </select>

        <label for="ingredients[${ingredientIndex}][quantity]">Количество:</label>
                <input type="number" step="0.01" name="ingredients[${ingredientIndex}][quantity]" value="" required style="width: 80px;">

                <span class="remove-ingredient" onclick="removeIngredientRow(this)">Удалить</span>
            `;
        container.appendChild(newRow);
        ingredientIndex++;
    }

    function removeIngredientRow(element) {
        element.parentNode.remove();
    }
</script>
</body>
</html>
