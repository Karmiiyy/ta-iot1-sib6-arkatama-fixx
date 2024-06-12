<?php

namespace App\Http\Controllers;

use App\Models\pot;
use Illuminate\Http\Request;

class PotCotroller extends Controller
{
    function index()
    {
        $potsData = pot::orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        return response()
            ->json([
                'data' => $potsData,
                'message' => 'Success'
            ], 200);
           }

    function show($id)
    {
        $potsData = pot::find($id);

        if ($potsData) {
            return response()
                ->json($potsData, 200);
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

        $potsData = pot::create($request->all());

        return response()
            ->json($potsData, 201);
    }
}
