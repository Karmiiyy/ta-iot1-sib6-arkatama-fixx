<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Temperature;
use Illuminate\Http\Request;

class TemperatureController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->query('limit', 20);

        $temperatures = Temperature::orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();

        return response()->json([
            'message' => 'Berhasil menampilkan data',
            'data' => $temperatures,
        ]);
    }

    public function store(Request $request)
    {
        $value = $request->input('value');
        $temperature = Temperature::create([
            'value' => $value,
        ]);

        return response()->json([
            'message' => 'Berhasil menambahkan data',
            'data' => $temperature,
        ], 201);
    }

}
