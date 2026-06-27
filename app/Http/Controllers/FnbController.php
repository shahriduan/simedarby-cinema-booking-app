<?php

namespace App\Http\Controllers;

use App\Models\Fnb;
use Illuminate\Http\Request;

/**
 * @group Food and Beverages
 * 
 * @authenticated
 */
class FnbController extends Controller
{

    /**
     * FnB Menu
     * 
     * List of food and beverages with category
     * 
     * @response {
     *     "status": true,
     *     "message": "OK",
     *     "data": [
     *         {
     *             "category": "Combo",
     *             "items": [
     *                 {
     *                     "name": "Tasty Combo",
     *                     "description": "2 Shawarma, Pack of fries & Pepsi",
     *                     "unit_price": 28
     *                 }
     *             ]
     *         },
     *     ]
     * }
     */
    public function fnbMenu(Request $request)
    {
        $menu = Fnb::select('category', 'name', 'description', 'unit_price')
            ->get()
            ->groupBy('category')
            ->map(function ($items, $category) {
                return [
                    'category' => $category,
                    'items' => $items->map(function ($item) {
                        return [
                            'name' => $item->name,
                            'description' => $item->description,
                            'unit_price' => (float) $item->unit_price,
                        ];
                    })->values()
                ];
            })
            ->values();

        return $this->responseSuccess('OK', $menu);
    }
}
