<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Dokter;
class SinkronisasiDokterController extends Controller
{
    public function ambilData()
    {
        $response = Http::get('https://ti054a02.agussbn.my.id/api/dokter');

        if ($response->failed()) {
            $this->error("Gagal mengambil data dari API.");
            return;
        }

        $dataDokter = $response->json();

        foreach ($dataDokter as $dokter) {
            \App\Models\Dokter::updateOrCreate(
            ['id_dokter' => $dokter['id_dokter']],
            [
                'id_user' => $dokter['id_user'],
                'nama_dokter' => $dokter['nama_dokter'],
                'no_hp_dokter' => $dokter['no_hp_dokter'],
                'spesialis' => $dokter['spesialis'],

            ]
            );
        }
    }
}
