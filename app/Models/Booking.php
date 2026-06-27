<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    const STATUS_PAID = 'Paid';
    const STATUS_CART = 'Cart';

    const TICKET_PRICE = 15; // RM
    const SERVICE_CHARGES = 1; // %
    const SEAT_LOCK_PERIOD = 10; // Minutes

    protected $casts = [
        'movie_start_at' => 'datetime',
        'movie_end_at' => 'datetime',
        'cart_expired_at' => 'datetime',
        'total_ticket_price' => 'decimal:2',
        'fnb_total_price' => 'decimal:2',
        'service_charges' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'grand_total_price' => 'decimal:2'
    ];
    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function bookingSeats()
    {
        return $this->hasMany(BookingSeat::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Custom Logics
    |--------------------------------------------------------------------------
    */
    public static function generateBookingNumber()
    {
        return 'B'.now()->format('ymdHis');
    }

    public function updateGrandTotalPrice()
    {
        $totalPrice = $this->bookingSeats()->sum('price');
        $this->total_ticket_price = $totalPrice;

        // $totalFnb = $this->bookingFoodBeverages()->sum('price');
        // $this->fnb_total_price = $totalFnb;

        $this->service_charges = (self::SERVICE_CHARGES / 100) * $this->total_ticket_price;

        $grandTotal = $this->total_ticket_price + $this->fnb_total_price + $this->service_charges - $this->discount_price;
        $this->grand_total_price = $grandTotal;
        $this->save();
    }
}
