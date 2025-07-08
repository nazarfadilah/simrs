<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PendaftaranResource;
use App\Http\Resources\DokterResource;
use App\Http\Resources\PasienResource;
use App\Http\Resources\PoliResource;
use App\Models\Pendaftaran;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Carbon\Carbon; // Import Carbon untuk tanggal

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pendaftarans = Pendaftaran::all();
        return PendaftaranResource::collection($pendaftarans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'rm' => 'required|exists:pasiens,rm',
            'id_poli' => 'required|exists:polis,id_poli',
            'tgl_kunjungan' => 'required|date',
            'status' => 'required|integer',
            'no_antrian' => 'required|integer',
        ]);
        $pendaftaran = Pendaftaran::create($validatedData);
        $pendaftaran->load(['pasien', 'poli.dokter']);

        return new PendaftaranResource($pendaftaran);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendaftaran $pendaftaran)
    {
        $pendaftaran->load(['pasien', 'poli.dokter']);
        return new PendaftaranResource($pendaftaran);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update($request->all());
        return new PendaftaranResource($pendaftaran);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        $pendaftaran->delete();
        return response()->json(['message' => 'Data pendaftaran berhasil dihapus'], 200);
    }

    /**
     * Custom method to get historical registrations (for index-pendaftaran-riwayat.html)
     */
    public function getMaxAntrian(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_poli' => 'required|integer|exists:polis,id_poli',
            'tgl_kunjungan' => 'required|date_format:Y-m-d',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $validatedData = $validator->validated();
        $maxAntrian = Pendaftaran::where('id_poli', $validatedData['id_poli'])
                                  ->where('tgl_kunjungan', $validatedData['tgl_kunjungan'])
                                  ->max('no_antrian');

        return response()->json([
            'max_no_antrian' => $maxAntrian ? (int)$maxAntrian : 0
        ]);
    }

}
