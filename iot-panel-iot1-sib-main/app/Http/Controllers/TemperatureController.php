<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Temperature;
use Illuminate\Http\Request;

class TemperatureController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.temperature');
    }

}
