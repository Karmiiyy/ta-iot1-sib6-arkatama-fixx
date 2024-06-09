<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function api_dht11(Request $request)
    {
        $data ['title'] = 'Sensor';
        $data ['breadcrumbs'][] = [
            'title' => 'Dashboard',
            'url' => route('dashboard')
        ];
        $data ['breadcrumbs'][] = [
            'title' => 'Sensor',
            'url' => 'sensor.api_dht11'
        ];

        return view('pages.sensor', $data);
        
    }
}
