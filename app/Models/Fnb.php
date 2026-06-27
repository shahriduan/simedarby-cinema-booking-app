<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fnb extends Model
{
    protected $fillable = [
        'category',
        'name',
        'description',
        'unit_price'
    ];

    protected $casts = [
        'unit_price' => 'decimal:2'
    ];
}
