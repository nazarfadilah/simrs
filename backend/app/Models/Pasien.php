<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pasien extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'rm';       // Gunakan kolom rm sebagai primary key
    public $incrementing = false;       // Karena RM biasanya bukan integer auto-increment
    protected $keyType = 'string';
    protected $fillable = [
        'rm',
        'nik',
        'nama_pasien',
        'tgl_lahir',
        'agama',
        'kabupaten',
        'pekerjaan',
        'jns_kelamin',
        'alamat',
        'no_hp_pasien',
        'email_pasien',
        'gol_darah',
    ];


    /**
     * Get all of the pendaftarans for the Pasien.
     */
    public function pendaftarans(): HasMany
    {
        return $this->hasMany(Pendaftaran::class, 'rekam_medis', 'id');
    }
}
