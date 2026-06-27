<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'booking_number' => $this->booking_number,
            'user' => new UserResource(User::find($this->user_id)),
            'cinema_id' => $this->cinema_id,
            'movie_id' => $this->movie_id,
            'movie_start_at' => $this->movie_start_at->format('Y-m-d H:i:s'),
            'movie_end_at' => $this->movie_end_at->format('Y-m-d H:i:s'),
            'total_selected_seat' => $this->total_selected_seat,
            'promo_code' => $this->promo_code,
            'total_ticket_price' => $this->total_ticket_price,
            'fnb_total_price' => $this->fnb_total_price,
            'service_charges' => $this->service_charges,
            'discount_price' => $this->discount_price,
            'grand_total_price' => $this->grand_total_price,
            'booking_status' => $this->booking_status,
            'cart_expired_at' => $this->cart_expired_at->format('Y-m-d H:i:s')
        ];
    }
}
