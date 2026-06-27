<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Cinema;
use Illuminate\Http\Request;

/**
 * @group   Cinema
 */
class CinemaController extends Controller
{
    /**
     * List Areas
     * 
     * @response {
     *     "status": true,
     *     "message": "OK",
     *     "data": [
     *         {
     *             "id": 1,
     *             "name": "Putrajaya"
     *         },
     *         {
     *             "id": 2,
     *             "name": "Subang Jaya"
     *         }
     *     ]
     * }
     */
    public function listAreas(Request $request)
    {
        $areas = Area::orderBy('name')->get();
        
        return $this->responseSuccess('OK', $areas);
    }

    /**
     * List Cinemas
     * 
     * @queryParam  area_id     integer     Area ID. Example: 1
     * 
     * @response {
     *     "status": true,
     *     "message": "OK",
     *     "data": [
     *         {
     *             "id": 1,
     *             "name": "GSC - IOI City Mall",
     *             "area_id": 1
     *         },
     *         {
     *             "id": 2,
     *             "name": "GSC - Subang Parade",
     *             "area_id": 2
     *         }
     *     ]
     * }
     */
    public function listCinemas(Request $request)
    {
        $areaId = $request->query('area_id', null);

        $cinemas = Cinema::when(isset($areaId), function ($query) use ($areaId) {
                $query->where('area_id', $areaId);
            })
            ->orderBy('name')
            ->get();

        return $this->responseSuccess('OK', $cinemas);
    }
}
