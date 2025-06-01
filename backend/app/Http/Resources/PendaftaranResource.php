<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon; // Import Carbon untuk format tanggal/waktu

class PendaftaranResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Mapping status dari integer ke string yang lebih mudah dibaca
        $statusText = 'Tidak Diketahui';
        switch ($this->status) {
            case 0:
                $statusText = 'Menunggu';
                break;
            case 1:
                $statusText = 'Menunggu Diperiksa';
                break;
            case 2:
                $statusText = 'Diperiksa';
                break;
            case 3:
                $statusText = 'Selesai';
                break;
                
            // Tambahkan status lain jika ada
        }

        return [
            'no_registrasi' => $this->no_registrasi,
            'rm' => $this->rm,
            // Display nama_pasien directly without whenLoaded for default inclusion
            'nama_pasien' => $this->pasien ? $this->pasien->nama_pasien : null,
            // Display nik_pasien directly without whenLoaded for default inclusion
            'nik_pasien' => $this->pasien ? $this->pasien->nik : null,
            // Replace id_poli with nama_poli and display directly
            'nama_poli' => $this->poli ? $this->poli->nama_poli : null,
            // Add nama_dokter based on the poli's associated dokter
            'nama_dokter' => ($this->poli && $this->poli->dokter) ? $this->poli->dokter->nama_dokter : null,
            'status_raw' => $this->status,
            'status' => $statusText,
            'no_antrian' => $this->no_antrian,
        ];
    }
}