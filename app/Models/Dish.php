<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'preparation_method', 'preparation_time', 'user_id']; // Добавлено 'user_id'
    protected $casts = [
        'user_id' => 'integer',
        'category_id' => 'integer',
        'preparation_time' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo // Добавлено
    {
        return $this->belongsTo(User::class);
    }
}
