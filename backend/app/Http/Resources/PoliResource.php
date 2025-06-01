<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PoliResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_poli' => $this->id_poli,
            'nama_poli' => $this->nama_poli,
            // Mengakses nama dokter dari relasi yang sudah dimuat
            // Pastikan relasi 'dokter' ada dan 'nama_dokter' adalah kolom yang benar
            'nama_dokter' => $this->whenLoaded('dokter', function () {
                return $this->dokter ? $this->dokter->nama_dokter : null;
            }),
            // Mengakses nama perawat dari relasi yang sudah dimuat
            // Pastikan relasi 'perawat' ada dan 'nama_perawat' adalah kolom yang benar
            'nama_perawat' => $this->whenLoaded('perawat', function () {
                return $this->perawat ? $this->perawat->nama_perawat : null;
            }),
            'id_perawat' => $this->id_perawat, // Tetap sertakan ID jika Anda ingin
            'id_dokter' => $this->id_dokter,   // Tetap sertakan ID jika Anda ingin
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            // 'deskripsi' => $this->deskripsi, // Aktifkan jika Anda punya kolom deskripsi
        ];
    }
}
