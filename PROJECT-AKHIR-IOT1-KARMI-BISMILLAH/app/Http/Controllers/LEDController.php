<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LEDController extends Controller
{
    function index()
    {
        $data['title'] = 'LED Control';
        $data['breadcrumbs'][] = [
            'title' => 'Dashboard',
            'url' => route('dashboard')
        ];
        $data['title'] = 'LED Control';
        $data['breadcrumbs'][] = [
            'title' => 'LED Control',
            'url' => 'LEDControllers.index'
        ];

        return view('pages.sensor.index', $data);
    }
}
