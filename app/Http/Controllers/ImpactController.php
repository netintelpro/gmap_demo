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

        $impacts = Impact::whereHas('event', function (Builder $query) use ($startDate, $endDate, $address) {
            if ($startDate) {
                $query->where('start_date_time', '>=', $startDate);
            }

            if ($endDate) {
                $query->where('end_date_time', '<=', $endDate);
            }

            if ($address) {
                $query->where('address1', 'like', "%$address%");
            }

        })->get();
        return response()->json($impacts);
    }
}
