<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $primaryKey = 'no_registrasi';
public $incrementing = true; // Pastikan ini TRUE
protected $keyType = 'int'; // Tetap int

    protected $fillable = [
        'rm',
        'id_poli',
        'tgl_kunjungan',
        'status',
        'no_antrian',
    ];

    /**
     * Get the pasien that owns the Pendaftaran.
     */
    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class, 'rm', 'rm');
    }

    /**
     * Get the poli that owns the Pendaftaran.
     */
    public function poli(): BelongsTo
    {
        return $this->belongsTo(Poli::class, 'id_poli', 'id_poli');
    }
}
