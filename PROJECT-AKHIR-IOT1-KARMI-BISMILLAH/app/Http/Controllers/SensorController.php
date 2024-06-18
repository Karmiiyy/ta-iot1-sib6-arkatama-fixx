<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorControl;


class SensorController extends Controller
{
    function index()
    {
        $data['title'] = 'Sensor';
        $data['breadcrumbs'][] = [
            'title' => 'Dashboard',
            'url' => route('dashboard')
        ];
        $data['title'] = 'Sensor';
        $data['breadcrumbs'][] = [
            'title' => 'Sensor',
            'url' => 'LEDControllers.index'
        ];
       
        return view('pages.sensor', $data);
    }
}
