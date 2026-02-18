<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'profil_mahasiswa';

    protected $fillable = [
        'mahasiswa_id',
        'tentang_saya',
        'foto',
    ];

    /**
     * Relasi ke mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    /**
     * Accessor untuk ambil URL foto langsung
     */
    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('storage/' . $this->foto);
        }

        return asset('images/default-avatar.png');
    }
}
