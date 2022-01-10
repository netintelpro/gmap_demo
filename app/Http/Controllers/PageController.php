<?php

namespace App\Http\Controllers;

use App\Models\Impact;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request)
    {
        return view('index')->with([
            'locations' => collect([]),
            'center' => $this->getCenter(),
        ]);
    }

    public function getMarkers(Request $request)
    {
        return view('index')->with([
            'locations' => Impact::locations($request->all()),
            'center' => $this->getCenter(),
        ]);
    }

    private function getCenter()
    {
        return preg_replace('/"([a-zA-Z]+[a-zA-Z0-9_]*)":/','$1:',
            json_encode(config('google.maps.austin'), JSON_NUMERIC_CHECK));
    }
}
