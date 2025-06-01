<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PasienResource;
use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pasiens = Pasien::all();
        return PasienResource::collection($pasiens);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pasien = Pasien::create($request->all());
        return new PasienResource($pasien);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pasien $pasien)
{
    return new PasienResource($pasien);
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pasien $pasien)
    {
        $pasien->update($request->all());
        return new PasienResource($pasien);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pasien $pasien)
    {
        $pasien->delete();
        return response()->json(['message' => 'Data pasien berhasil dihapus']);
    }
}
