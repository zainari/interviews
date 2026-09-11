<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // public $attributes;
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image_url',
        'category_id',
        'is_active',
        'available_from',
        'available_to',
        'slug',
        'sku',
        'brand',
        'status',
        'color_group_id'
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

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes')
            ->withPivot('value')
            ->withTimestamps();
    }
       // Product belongs to many Orders (pivot table)
       public function orders() {
        return $this->belongsToMany(Order::class)->withPivot('quantity', 'price')->withTimestamps();
    }

    public function images() {
        return $this->hasMany(ProductImage::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sizeStocks()
    {
        return $this->hasMany(ProductSizeStock::class);
    }

    public function wishlistedBy()
    {
        return $this->hasMany(Wishlist::class);
    }
}
