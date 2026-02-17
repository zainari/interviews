<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Invoice extends Model
{
    protected $fillable = ['company_id', 'client_id', 'invoice_number', 'amount', 'due_date', 'status'];

    protected static function booted()
    {
        // Global Scope: Sirf apni company ki invoices dikhao
        static::addGlobalScope('company', function (Builder $builder) {
            if (Auth::check()) {
                $builder->where('company_id', Auth::user()->company_id);
            }
        });

        // Automatic Assign: Save karte waqt company_id khud lag jaye
        static::creating(function ($invoice) {
            if (empty($invoice->company_id) && Auth::check()) {
                $invoice->company_id = Auth::user()->company_id;
            }
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}