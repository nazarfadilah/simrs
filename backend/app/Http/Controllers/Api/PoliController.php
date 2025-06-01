<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PoliResource;
use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
    {
        // Eager load relasi 'dokter' dan 'perawat'
        $polis = Poli::with(['dokter', 'perawat'])->get();

        return PoliResource::collection($polis);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $poli = Poli::create($request->all());
        return new PoliResource($poli);
    }

    /**
     * Display the specified resource.
     */
    public function show(Poli $poli)
    {
        return new PoliResource($poli);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Poli $poli)
    {
        $poli->update($request->all());
        return new PoliResource($poli);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poli $poli)
    {
        $poli->delete();
        return response()->json(['message' => 'Data poli berhasil dihapus']);
    }
}
