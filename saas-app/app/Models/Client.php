<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Client extends Model
{
    protected $fillable = [
        'name',
        'email',
    ];
 
    protected static function booted()
    {
        static::addGlobalScope('company', function (Builder $builder) {
            if (Auth::check()) {
                $builder->where('company_id', Auth::user()->company_id);
            }
        });
    
        static::creating(function ($client) {
            if (empty($client->company_id) && Auth::check()) {
                $client->company_id = Auth::user()->company_id;
            }
        });
    }
}
