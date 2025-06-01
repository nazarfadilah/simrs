<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DokterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_dokter' => $this->id_dokter,
            'nama_dokter' => $this->nama_dokter,
            'spesialis' => $this->spesialis,
            'no_hp_dokter' => $this->no_hp_dokter,
            'poli_ids' => $this->whenLoaded('polis', function () {
                return $this->polis->pluck('id_poli'); // Ambil koleksi id_poli
            }),
            'id_user' => $this->id_user,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
