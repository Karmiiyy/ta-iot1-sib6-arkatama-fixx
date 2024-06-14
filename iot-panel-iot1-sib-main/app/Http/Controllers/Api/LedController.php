<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Led;
use Illuminate\Http\Request;

class LedController extends Controller
{
    // READ all data-> index (GET) -> terserah namanya
    function index()
    {
        $leds = Led::orderBy('name', 'ASC')
            ->get(); // select * from led order by name asc

        return response()
            ->json([
                'message'   => 'Data berhasil ditampilkan',
                'data'      => $leds
            ], 200);
    }

    // READ single data -> show (GET) -> terserah namanya
    function show($id)
    {
        // select * from led where id = $id
        $led = Led::find($id); // cara 1
        // $led = Led::where('id', $id)
        //     ->first(); // cara 2

        if (!$led) { // dibaca: Jika led tidak ada
            return response()
                ->json([
                    'message'   => 'Data tidak ditemukan',
                    'data'      => null
                ], 404);
        }

        return response()
            ->json([
                'message'   => 'Data berhasil ditemukan',
                'data'      => $led
            ], 200);
    }

    // CREATE data -> store (POST) -> terserah namanya
    function store(Request $request)
    {
        // Request $request -> untuk menangkap data yang dikirimkan oleh client (header, body, query, dll)

        // validasi data -> jika data tidak sesuai, maka akan mengembalikan response error
        // validasi: name, pin, status
        $validated = $request
            ->validate([
                "name"  => [
                    "required",
                    "string",
                    "min:3",
                    "max:255",
                ],
                "pin"  => [
                    "required",
                    "numeric",
                    "between:0,39",
                ],
                "status"  => [
                    "required",
                    "boolean",
                ],
            ]);

        // insert into led (name, pin, status) values ($validated['name'], $validated['pin'], $validated['status'])
        $led = Led::create($validated);

        // $led = new Led();
        // $led->name = $validated['name'];
        // $led->pin = $validated['pin'];
        // $led->status = $validated['status'];

        // $led = Led::create([
        //     'name'  => $request->name,
        //     'pin'   => $request->pin,
        //     'status'    => $request->status,
        // ]);

        return response()
            ->json([
                'message'   => 'Data berhasil disimpan',
                'data'      => $led
            ], 201); // 200 OK -> 201 Created
    }

    // UPDATE data -> update (PUT/PATCH) -> terserah namanya
    function update(Request $request, $id)
    {
        $led = Led::find($id);
        if (!$led) { // dibaca: Jika led tidak ada
            return response()
                ->json([
                    'message'   => 'Data tidak ditemukan',
                    'data'      => null
                ], 404);
        }

        $validated = $request
            ->validate([
                "name"  => [
                    "required", "string", "min:3", "max:255",
                ],
                "pin"  => [
                    "required", "numeric", "between:0,39",
                ],
                "status"  => [
                    "required", "boolean",
                ],
            ]);

        $led->update($validated);

        return response()
            ->json([
                'message'   => 'Data berhasil diubah',
                'data'      => $led
            ], 200); // 200 OK -> 201 Created
    }

    // DELETE data -> destroy (DELETE) -> terserah namanya
    function destroy($id)
    {
        $led = Led::find($id);

        if (!$led) { // dibaca: Jika led tidak ada
            return response()
                ->json([
                    'message'   => 'Data tidak ditemukan',
                    'data'      => null
                ], 404);
        }

        $led->delete();

        return response()
            ->json([
                'message'   => 'Data berhasil dihapus',
                'data'      => $led
            ], 200);
    }
}
