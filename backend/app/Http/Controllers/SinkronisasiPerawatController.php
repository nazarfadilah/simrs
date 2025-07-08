<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Perawat;

class SinkronisasiPerawatController extends Controller
{
    public function ambilData()
    {
        $response = Http::get('https://ti054a02.agussbn.my.id/api/perawat');
        if ($response->failed()) {
            $this->error("Gagal mengambil data dari API.");
            return;
        }

        $dataPerawat = $response->json();
        foreach ($dataPerawat as $perawat) {
            Perawat::updateOrCreate(
                ['id_perawat' => $perawat['id_perawat']],
                [
                    'nama_perawat' => $perawat['nama_perawat'],
                    'no_hp_perawat' => $perawat['no_hp_perawat'],
                    'id_user' => $perawat['id_user'] // pastikan kolom ini ada di tabel kamu
                ]
            );
        }
    }
}
