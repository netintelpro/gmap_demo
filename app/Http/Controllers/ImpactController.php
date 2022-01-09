<?php

namespace App\Http\Controllers;

use App\Models\Impact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ImpactController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->get('start_date') ?? null;
        $endDate = $request->get('end_date') ?? null;
        $address = $request->get('address') ?? null;

        $impacts = Impact::getImpactsByParams($startDate,$endDate,$address);

        return response()->json($impacts);
    }
}
