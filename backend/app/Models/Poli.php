<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poli extends Model
{
    use HasFactory;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_poli';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_poli',
        'id_dokter',
        'id_perawat',
        'nama_poli',
    ];

    /**
     * Get the dokter that owns the Poli.
     */
    public function dokter(): BelongsTo
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }

    /**
     * Get the perawat that owns the Poli.
     */
    public function perawat(): BelongsTo
    {
        return $this->belongsTo(Perawat::class, 'id_perawat', 'id_perawat');
    }

    /**
     * Get the pendaftarans for the Poli.
     */
    public function pendaftarans(): HasMany
    {
        return $this->hasMany(Pendaftaran::class, 'id_poli', 'id_poli');
    }
}
// Compare this snippet from app/Models/Poli.php:
