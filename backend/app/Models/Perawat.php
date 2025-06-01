<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perawat extends Model
{
    use HasFactory;

    //
    protected $table = 'perawats';
    protected $primaryKey = 'id_perawat';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'nama_perawat',
        'no_hp_perawat',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    public function polis()
    {
        return $this->hasMany(Poli::class, 'id_perawat', 'id_perawat');
    }
}
