<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MqSensor;
use Illuminate\Http\Request;

class MqSensorController extends Controller
{
    function index()
    {
        $sensorsData = MqSensor::orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        return response()
            ->json($sensorsData, 200);
    }
}
