<?php

namespace App\Http\Controllers;

use App\Models\LEDController as ModelsLEDController;
use Illuminate\Http\Request;
use App\Models\LEDControl;


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
       
        return view('pages.LEDControl.index', $data);
    }
}
