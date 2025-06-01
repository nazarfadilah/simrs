<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DokterResource;
use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dokters = Dokter::with('polis')->get();
        return DokterResource::collection($dokters);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dokter = Dokter::create($request->all());
        return new DokterResource($dokter);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dokter $dokter)
    {
        return new DokterResource($dokter);
    }
    public function showById(string $id)
    {
        $dokter = Dokter::findOrFail($id);
        return new DokterResource($dokter);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dokter $dokter)
    {
        $dokter->update($request->all());
        return new DokterResource($dokter);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        return response()->json(['message' => 'Data dokter berhasil dihapus']);
    }
}
