<?php

namespace App\Http\Controllers;

use App\Models\Impact;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $impacts = Impact::getImpactsByParams();
        //dd($impacts);

        return view('index')->with([
            'impacts' => $impacts,
            'events' => [],
        ]);
    }

    public function getMarkers(Request $request)
    {
        $startDate = $request->get('start_date') ?? null;
        $endDate = $request->get('end_date') ?? null;
        $address = $request->get('address') ?? null;

        $impacts = Impact::getImpactsByParams($startDate,$endDate,$address);

        return view('index')->with([
            'impacts' => $impacts,
            'events' => [],
        ]);
    }
}
