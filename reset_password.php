<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

// Находим пользователя
$user = User::where('email', 'aleksandr@mail.ru')->first();

if ($user) {
    // Просто обновляем пароль
    $user->password = Hash::make('12345678');
    $user->save();
    echo "Пароль обновлен!\n";
} else {
    // Создаем нового если не существует
    $user = new User();
    $user->name = 'Aleksandr';
    $user->email = 'aleksandr@mail.ru';
    $user->password = Hash::make('12345678');
    $user->save();
    echo "Пользователь создан!\n";
}

echo "Email: aleksandr@mail.ru\n";
echo "Пароль: 12345678\n";
echo "ID: " . $user->id . "\n";
