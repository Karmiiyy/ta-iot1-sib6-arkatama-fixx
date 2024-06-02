<?php

namespace App\Http\Controllers;

use App\Models\LED;
use Illuminate\Http\Request;

class LedControllerDB extends Controller
{
    function index(){
        $Leds = LED::all(); //select * from led
        $data['leds'] = $Leds;

        return view ('pages.ledDB', $data);
    }
}
