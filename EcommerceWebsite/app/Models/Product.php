<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'stock', 'image_url',
        'category_id', 'is_active', 'available_from', 'available_to',
        'sku', 'brand'
    ];

    protected $casts = [
        'available_from' => 'datetime',
        'available_to' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

