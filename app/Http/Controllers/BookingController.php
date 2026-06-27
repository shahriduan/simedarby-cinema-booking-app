<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\BookingSeat;
use App\Models\Fnb;
use App\Models\Movie;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group   Booking
 * 
 * @authenticated
 */
class BookingController extends Controller
{
    /**
     * Book Ticket
     * 
     * @bodyParam   cinema_id       integer     required    Cinema ID. Example: 1
     * @bodyParam   movie_id        integer     required    Movie ID. Example: 2
     * @bodyParam   showtime_slot   string      required    Slot datetime. Example: 2026-06-07 09:20:00
     * @bodyparam   seats           string[]    required    Selected seats. Example: ["F4", "F5", "F6"]
     * 
     * @response {
     *     "status": true,
     *     "message": "OK",
     *     "data": {
     *         "booking": {
     *             "id": 2,
     *             "booking_number": "B260627143845",
     *             "user": {
     *                 "id": 2,
     *                 "first_name": "Alex Goh",
     *                 "last_name": "Kean Tiong",
     *                 "email": "alex@gmail.com"
     *             },
     *             "cinema_id": 1,
     *             "movie_id": 3,
     *             "movie_start_at": "2026-06-28 09:20:00",
     *             "movie_end_at": "2026-06-28 11:22:00",
     *             "total_selected_seat": 2,
     *             "promo_code": null,
     *             "total_ticket_price": "30.00",
     *             "fnb_total_price": "0.00",
     *             "service_charges": "0.30",
     *             "discount_price": "0.00",
     *             "grand_total_price": "30.30",
     *             "booking_status": "Cart",
     *             "cart_expired_at": "2026-06-27 14:48:45"
     *         },
     *         "seat_lock_period": 10
     *     }
     * }
     */
    public function bookingTicket(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cinema_id' => 'required|exists:App\Models\Cinema,id',
            'movie_id' => 'required|exists:App\Models\Movie,id',
            'showtime_slot' => [
                'required',
                'date_format:Y-m-d H:i:s'
            ],
            'seats' => [
                'required',
                'array',
                function (string $attribute, mixed $value, Closure $fail) use ($request) {
                    $cinemaId = $request->cinema_id;
                    $movieId = $request->movie_id;
                    $showtimeSlot = $request->showtime_slot;

                    $takenSeats = BookingSeat::whereIn('seat', $value)
                        ->whereHas('booking', function ($query) use ($cinemaId, $movieId, $showtimeSlot) {
                            $query->where('cinema_id', $cinemaId)
                                  ->where('movie_id', $movieId)
                                  ->where('movie_start_at', $showtimeSlot)
                                  ->where(function ($statusQuery) {
                                    $statusQuery->where('booking_status', Booking::STATUS_PAID)
                                                ->orWhere(function ($cartQuery) {
                                                    $cartQuery->where('booking_status', Booking::STATUS_CART)
                                                              ->where('cart_expired_at', '>', now());
                                                });
                                  });
                        })
                        ->pluck('seat')
                        ->toArray();

                    if (!empty($takenSeats)) {
                        $takenSeatsString = implode(', ', $takenSeats);
                        $fail("The following seats are unavailable: {$takenSeatsString}.");
                    }
                },
            ]
        ], [], [
            'cinema_id' => 'cinema',
            'movie_id' => 'movie',
        ]);

        if ($validator->fails()) {
            return $this->responseError($validator->errors()->first(), $validator->errors());
        }

        $movie = Movie::find($request->movie_id);

        $booking = new Booking;
        $booking->booking_number = Booking::generateBookingNumber();
        $booking->user_id = $request->user()->id;
        $booking->cinema_id = $request->cinema_id;
        $booking->movie_id = $request->movie_id;
        $booking->movie_start_at = $request->showtime_slot;
        $booking->movie_end_at = Carbon::parse($request->showtime_slot)->addMinutes($movie->duration_minutes);
        $booking->total_selected_seat = count($request->seats);
        $booking->cart_expired_at = now()->addMinutes(Booking::SEAT_LOCK_PERIOD);
        $booking->save();

        foreach ($request->seats as $seat) {
            $booking->bookingSeats()->create([
                'seat' => $seat,
                'price' => Booking::TICKET_PRICE
            ]);
        }

        $booking->updateGrandTotalPrice();

        $booking->refresh();

        return $this->responseSuccess('OK', [
            'booking' => new BookingResource($booking),
            'seat_lock_period' => Booking::SEAT_LOCK_PERIOD
        ]);
    }

    /**
     * Submit Food Beverages Booking
     * 
     * @bodyParam   fnb                 object[]    required    List of Food and Beverage selections.
     * @bodyParam   fnb[].fnb_id        integer     required    FnB ID. Example: 2
     * @bodyParam   fnb[].quantity      integer     required    Quantity of FnB. Example: 2
     * 
     * @response {
     *     "status": true,
     *     "message": "OK",
     *     "data": {
     *         "booking": {
     *             "id": 1,
     *             "booking_number": "B260627153315",
     *             "user": {
     *                 "id": 2,
     *                 "first_name": "Alex Goh",
     *                 "last_name": "Kean Tiong",
     *                 "email": "alex@gmail.com"
     *             },
     *             "cinema_id": 1,
     *             "movie_id": 3,
     *             "movie_start_at": "2026-06-28 09:20:00",
     *             "movie_end_at": "2026-06-28 11:22:00",
     *             "total_selected_seat": 2,
     *             "promo_code": null,
     *             "total_ticket_price": "30.00",
     *             "fnb_total_price": "28.00",
     *             "service_charges": "0.30",
     *             "discount_price": "0.00",
     *             "grand_total_price": "58.30",
     *             "booking_status": "Cart",
     *             "cart_expired_at": "2026-06-27 15:43:15"
     *         }
     *     }
     * }
     */
    public function bookingFnb(Request $request, Booking $booking)
    {
        if ($booking->user_id != $request->user()->id) {
            return $this->responseError('Invalid Booking.');
        }

        $validator = Validator::make($request->all(), [
            'fnb' => 'required|array|min:1',
            'fnb.*.fnb_id' => 'required|exists:App\Models\Fnb,id',
            'fnb.*.quantity' => 'required|integer|min:1',
        ], [], [
            'fnb.*.fnb_id' => 'FnB',
            'fnb.*.quantity' => 'quantity',
        ]);

        if ($validator->fails()) {
            return $this->responseError($validator->errors()->first(), $validator->errors());
        }

        foreach ($request->fnb as $fnb) {
            $fnbModel = Fnb::find($fnb['fnb_id']);

            if ($fnbModel) {
                $booking->bookingFoodBeverages()->updateOrCreate([
                    'fnb_id' => $fnbModel->id,
                ], [
                    'name' => $fnbModel->name,
                    'description' => $fnbModel->description,
                    'category' => $fnbModel->category,
                    'unit_price' => $fnbModel->unit_price,
                    'quantity' => $fnb['quantity'],
                    'total_price' => $fnbModel->unit_price * $fnb['quantity']
                ]);
            }
        }

        # Delete any items currently in the database that weren't sent in this request
        $selectedFnbIds = collect($request->fnb)->pluck('fnb_id')->toArray();
        $booking->bookingFoodBeverages()->whereNotIn('fnb_id', $selectedFnbIds)->delete();

        $booking->updateGrandTotalPrice();

        return $this->responseSuccess('OK', [
            'booking' => new BookingResource($booking),
        ]);
    }

    /**
     * Booking Details
     * 
     * @response {
     *     "status": true,
     *     "message": "OK",
     *     "data": {
     *         "id": 1,
     *         "booking_number": "B260627153315",
     *         "user": {
     *             "id": 2,
     *             "first_name": "Alex Goh",
     *             "last_name": "Kean Tiong",
     *             "email": "alex@gmail.com"
     *         },
     *         "cinema": {
     *             "name": "GSC - IOI City Mall",
     *             "area": "Putrajaya"
     *         },
     *         "movie": {
     *             "id": 3,
     *             "title": "The Death Of Robin Hood",
     *             "release_date": "2026-06-18",
     *             "classification": "16",
     *             "rating": "3.2",
     *             "total_rating_people": 26,
     *             "genre": [
     *                 "Action"
     *             ],
     *             "synopsis": "Grappling with his past after a life of crime and murder, Robin Hood finds himself gravely injured after a battle he thought would be his last. In the hands of a mysterious woman, he is offered a chance at salvation.",
     *             "director": "Michael Sarnoski",
     *             "writers": "Michael Sarnoski",
     *             "poster_url": "https://poster.gsc.com.my/2026/260605_TheDeathOfTheRobinhood_big.jpg",
     *             "trailer_url": "https://youtu.be/goLcYMt7pfg?si=M9HZHLWNijcHvbOz"
     *         },
     *         "movie_start_at": "2026-06-28 09:20:00",
     *         "movie_end_at": "2026-06-28 11:22:00",
     *         "total_selected_seat": 2,
     *         "promo_code": null,
     *         "total_ticket_price": "30.00",
     *         "fnb_total_price": "28.00",
     *         "service_charges": "0.30",
     *         "discount_price": "0.00",
     *         "grand_total_price": "58.30",
     *         "booking_status": "Cart",
     *         "cart_expired_at": "2026-06-27 15:43:15",
     *         "booking_fnbs": [
     *             {
     *                 "name": "Tasty Combo",
     *                 "description": "2 Shawarma, Pack of fries & Pepsi",
     *                 "category": "Combo",
     *                 "unit_price": "28.00",
     *                 "quantity": 1,
     *                 "total_price": "28.00"
     *             }
     *         ]
     *     }
     * }
     */
    public function bookingDetails(Request $request, Booking $booking)
    {
        if ($booking->user_id != $request->user()->id) {
            return $this->responseError('Invalid Booking.');
        }
        
        $booking->load(['bookingFoodBeverages', 'cinema', 'movie']);

        return $this->responseSuccess('OK', new BookingResource($booking));
    }
}
