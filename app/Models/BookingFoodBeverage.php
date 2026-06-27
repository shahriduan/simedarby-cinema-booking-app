<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingFoodBeverage extends Model
{
    protected $fillable = [
        'fnb_id',
        'name',
        'description',
        'category',
        'unit_price',
        'quantity',
        'total_price'
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2'
    ];

    public $timestamps = false;
}
