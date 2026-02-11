<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'first_name',
        'last_name',
        'address',
        'city',
        'country',
        'email',
        'phone',
        'subtotal',
        'total',
        'shipping',
        'payment_method',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order__products')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
    
}
