<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\BookingSeat;
use App\Models\Fnb;
use App\Models\Movie;
use Carbon\Carbon;
use Closure;
use Illuminate\Database\Eloquent\Builder;
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
     * @bodyparam   seats           string[]    required    Selected seats. Example: ["F-4", "F-5", "F-6"]
     * 
     * @response {
     *     "status": true,
     *     "message": "OK",
     *     "data": {
     *         "booking": {
     *             "id": 2,
     *             "booking_number": "B260630170202",
     *             "user": {
     *                 "id": 4,
     *                 "first_name": "Amirul",
     *                 "last_name": "Zakariah",
     *                 "email": "amirul@gmail.com"
     *             },
     *             "seats": [
     *                 "G1",
     *                 "G2"
     *             ],
     *             "movie_start_at": "2026-07-01 09:20:00",
     *             "movie_end_at": "2026-07-01 11:22:00",
     *             "total_selected_seat": 2,
     *             "promo_code": null,
     *             "total_ticket_price": "30.00",
     *             "fnb_total_price": "0.00",
     *             "service_charges": "1.50",
     *             "discount_price": "0.00",
     *             "grand_total_price": "31.50",
     *             "booking_status": "Cart",
     *             "cart_expired_at": "2026-06-30 17:12:02"
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
        ], [
            'showtime_slot.date_format' => 'Please select showtime.'
        ], [
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
     *             "id": 2,
     *             "booking_number": "B260630170202",
     *             "user": {
     *                 "id": 4,
     *                 "first_name": "Amirul",
     *                 "last_name": "Zakariah",
     *                 "email": "amirul@gmail.com"
     *             },
     *             "seats": [
     *                 "G1",
     *                 "G2"
     *             ],
     *             "movie_start_at": "2026-07-01 09:20:00",
     *             "movie_end_at": "2026-07-01 11:22:00",
     *             "total_selected_seat": 2,
     *             "promo_code": null,
     *             "total_ticket_price": "30.00",
     *             "fnb_total_price": "32.00",
     *             "service_charges": "1.50",
     *             "discount_price": "0.00",
     *             "grand_total_price": "63.50",
     *             "booking_status": "Cart",
     *             "cart_expired_at": "2026-06-30 17:12:02"
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
     *         "booking_number": "B260630165531",
     *         "user": {
     *             "id": 4,
     *             "first_name": "Amirul",
     *             "last_name": "Zakariah",
     *             "email": "amirul@gmail.com"
     *         },
     *         "cinema": {
     *             "name": "GSC - Subang Parade",
     *             "area": "Subang Jaya"
     *         },
     *         "movie": {
     *             "id": 4,
     *             "title": "Masters Of The Universe",
     *             "release_date": "04 Jun 2026",
     *             "duration": "2h 21m",
     *             "classification": "13",
     *             "rating": "3.6",
     *             "total_rating_people": 38,
     *             "genre": [
     *                 "Action"
     *             ],
     *             "synopsis": "A young man on Earth discovers a fabulous secret legacy as the prince of an alien planet, and must recover a magic sword and return home to protect his kingdom.",
     *             "director": "Travis Knight",
     *             "writers": "Chris Butler, Aaron Nee, Adam Nee",
     *             "casts": "Nicholas Galitzine, Morena Baccarin, Idris Elba, James Purefoy, Jared Leto",
     *             "poster_url": "https://poster.gsc.com.my/2025/251117_MastersOfTheUniverse_big.jpg",
     *             "trailer_url": "https://youtu.be/Vf_5H3T8Y7Q?si=HOg0l0F5EeMOpMvG"
     *         },
     *         "seats": [
     *             "F-4",
     *             "F-5",
     *             "F-6"
     *         ],
     *         "movie_start_at": "2026-07-05 17:40:00",
     *         "movie_end_at": "2026-07-05 20:01:00",
     *         "total_selected_seat": 3,
     *         "promo_code": null,
     *         "total_ticket_price": "45.00",
     *         "fnb_total_price": "0.00",
     *         "service_charges": "2.25",
     *         "discount_price": "0.00",
     *         "grand_total_price": "47.25",
     *         "booking_status": "Paid",
     *         "cart_expired_at": "2026-06-30 17:05:31",
     *         "booking_fnbs": []
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

    /**
     * Redeem Promo Code
     * 
     * @bodyParam   promo_code  string  required    Promo code. Example: PROMO5
     * 
     * @response {
     *     "status": true,
     *     "message": "Promo code applied",
     *     "data": []
     * }
     */
    public function redeemPromo(Request $request, Booking $booking)
    {
        if ($booking->user_id != $request->user()->id) {
            return $this->responseError('Invalid Booking.');
        }

        $validator = Validator::make($request->all(), [
            'promo_code' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) use ($request, $booking) {
                    if ($booking->status == Booking::STATUS_PAID) {
                        $fail('This booking is already completed and paid for.');
                    } elseif (isset($booking->promo_code)) {
                        $fail('You’ve already redeemed this promo code');
                    } elseif ($request->promo_code != Booking::PROMO_CODE) {
                        $fail('Invalid promo code.');
                    }
                },
            ]
        ]);

        if ($validator->fails()) {
            return $this->responseError($validator->errors()->first(), $validator->errors());
        }

        $booking->promo_code = $request->promo_code;
        $booking->discount_price = Booking::PROMO_DISCOUNT;
        $booking->save();

        $booking->updateGrandTotalPrice();

        return $this->responseSuccess('Promo code applied');

    }

    /**
     * Make a Payment
     * 
     * @response {
     *     "status": false,
     *     "message": "Invalid Booking.",
     *     "error": [],
     *     "data": []
     * }
     */
    public function bookingPayment(Request $request, Booking $booking)
    {
        if ($booking->user_id != $request->user()->id) {
            return $this->responseError('Invalid Booking.');
        }

        $booking->booking_status = Booking::STATUS_PAID;
        $booking->save();

        return $this->responseSuccess('OK');
    }

    /**
     * List Unavailable Seats
     * 
     * Fetches a list of seats that are currently unavailable for selection.
     * * ### 🔄 Client-Side Polling
     * This endpoint is designed to be polled periodically by the client application, while the user is on the seat selection screen to ensure real-time seat availability.
     * * ### 💺 Seat Status Types (Refer response)
     *      - `Booked`: The seat has been successfully reserved and paid for.
     *      - `Lock`: Temporary state. The seat is temporarily locked by another user who is currently in the checkout flow.
     * 
     * @queryParam  cinema_id       integer     required    Cinema ID. Example: 1
     * @queryParam  movie_id        integer     required    Movie ID. Example: 1
     * @queryParam  showtime_slot   string      required    Showtime slot. Example: 2026-06-28 09:20:00
     * 
     * @response {
     *     "status": true,
     *     "message": "OK",
     *     "data": [
     *         {
     *             "seat": "F1",
     *             "status": "Booked"
     *         },
     *         {
     *             "seat": "G2",
     *             "status": "Lock"
     *         }
     *     ]
     * }
     */
    public function getUnavailableSeats(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cinema_id' => 'required|exists:App\Models\Cinema,id',
            'movie_id' => 'required|exists:App\Models\Movie,id',
            'showtime_slot' => 'required'
        ], [], [
            'cinema_id' => 'cinama',
            'movie_id' => 'movie',
            'showtime_slot' => 'showtime'
        ]);

        if ($validator->fails()) {
            return $this->responseError($validator->errors()->first(), $validator->errors());
        }

        $unavailableSeats = BookingSeat::whereHas('booking', function (Builder $query) use ($request) {
                $query->where('cinema_id', $request->query('cinema_id'))
                      ->where('movie_id', $request->query('movie_id'))
                      ->where('movie_start_at', $request->query('showtime_slot'))
                      ->where(function ($statusQuery) {
                            $statusQuery->where('booking_status', Booking::STATUS_PAID)
                                        ->orWhere(function ($cartQuery) {
                                            $cartQuery->where('booking_status', Booking::STATUS_CART)
                                                      ->where('cart_expired_at', '>', now());
                                        });
                      });
            })
            ->orderBy('seat')
            ->get()
            ->map(function ($bookingSeat) {
                return [
                    'seat' => $bookingSeat->seat,
                    'status' => $bookingSeat->booking->booking_status == Booking::STATUS_PAID ? 'Booked' : 'Lock',
                ];
            })
            ->values()
            ->toArray();

        return $this->responseSuccess('OK', $unavailableSeats);
    }
}
