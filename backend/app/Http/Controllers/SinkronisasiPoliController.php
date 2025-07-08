<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Poli;

class SinkronisasiPoliController extends Controller
{
    public function ambilData()
    {
        $response = Http::get('https://ti054a02.agussbn.my.id/api/poli');
        if ($response->failed()) {
            $this->error("Gagal mengambil data dari API.");
            return;
        }

        $dataPoli = $response->json();
        foreach ($dataPoli as $poli) {
            Poli::updateOrCreate(
                ['id_poli' => $poli['id_poli']],
                [
                    'id_perawat' => $poli['id_perawat'],
                    'id_dokter' => $poli['id_dokter'],
                    'nama_poli' => $poli['nama_poli'],
                ]
            );
        }
        // return response()->json(['message' => 'Sinkronisasi Poli berhasil.']);
    }
}
