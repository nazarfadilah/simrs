<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PasienResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'rm' => $this->rm,
            'nik' => $this->nik,
            'nama_pasien' => $this->nama_pasien,
            'tgl_lahir' => $this->tgl_lahir,
            'agama' => $this->agama,
            'kabupaten' => $this->kabupaten,
            'pekerjaan' => $this->pekerjaan,
            'jns_kelamin' => $this->jns_kelamin,
            'alamat' => $this->alamat,
            'no_hp_pasien' => $this->no_hp_pasien,
            'email_pasien' => $this->email_pasien,
            'gol_darah' => $this->gol_darah,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
