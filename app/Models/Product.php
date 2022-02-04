<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'brand',
        'category',
        'description',
        'images',
        'rating',
        'num_reviews',
        'price',
        'count_in_stock',
        'user_id',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
