<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DHT11;
use Illuminate\Http\Request;

class DHT11_SuhuController extends Controller
{
    function index()
    {
        $sensorsData = DHT11::orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        return response()
            ->json([
                'data' => $sensorsData,
                'message' => 'Success'
            ], 200);
           }

    function show($id)
    {
        $sensorData = DHT11::find($id);

        if ($sensorData) {
            return response()
                ->json($sensorData, 200);
        } else {
            return response()
                ->json(['message' => 'Data not found'], 404);
        }
    }

    function store(Request $request)
    {
        $request->validate([
            'value' => [
                'required',
                'numeric',

            ]
        ]);

        $sensorData = DHT11::create($request->all());

        return response()
            ->json($sensorData, 201);
    }
}
