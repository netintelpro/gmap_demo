<?php

namespace App\Http\Controllers;

use App\Models\Impact;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {

        $center = json_encode(config('google.maps.austin'), JSON_NUMERIC_CHECK);
        $center = preg_replace('/"([a-zA-Z]+[a-zA-Z0-9_]*)":/','$1:',$center);

        $locations = Impact::locations();
        /*dd([
            'center' => $center,
            'impacts' => $impacts,
        ]);*/
        return view('index')->with([
            'locations' => $locations,
            'events' => [],
            'center' => $center,
        ]);
    }

    public function getMarkers(Request $request)
    {
        $startDate = $request->get('start_date') ?? null;
        $endDate = $request->get('end_date') ?? null;
        $address = $request->get('address') ?? null;

        $impacts = Impact::locations($startDate,$endDate,$address);

        return view('index')->with([
            'impacts' => $impacts,
            'events' => [],
        ]);
    }
}
