<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Perawat;
use Illuminate\Http\Request;
use App\Http\Resources\PerawatResources;

class PerawatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perawats = Perawat::all();
        return PerawatResources::collection($perawats);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $perawat = Perawat::create($request->all());
        return new PerawatResources($perawat);
    }

    /**
     * Display the specified resource.
     */
    public function show(Perawat $perawat)
    {
        return new PerawatResources($perawat);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $perawat = Perawat::findOrFail($id);
        $perawat->update($request->all());
        return new PerawatResources($perawat);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perawat = Perawat::findOrFail($id);
        $perawat->delete();
        return response()->json(['message' => 'Data perawat berhasil dihapus']);
    }
}
