<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // public $attributes;
    protected $table = 'categories';

    protected $fillable = [
        'name',
    ];
}
