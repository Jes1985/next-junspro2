<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WellnessPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price_monthly',
        'sessions_per_month',
    ];

    protected $casts = [
        'price_monthly' => 'decimal:2',
        'sessions_per_month' => 'integer',
    ];
}

