<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProfilMahasiswa;
use App\Models\SkillMahasiswa;
use App\Models\PortofolioMahasiswa;
use App\Models\User;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
        'user_id',
        'nim',
        'nama',
        'prodi',
        'status',
        'qr_token',
    ];

    /**
     * Relasi ke user (akun login)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke profil mahasiswa
     */
    public function profil()
    {
        return $this->hasOne(ProfilMahasiswa::class);
    }

    /**
     * Relasi ke skill mahasiswa
     */
    public function skills()
    {
        return $this->hasMany(SkillMahasiswa::class);
    }

    /**
     * Relasi ke portofolio mahasiswa
     */
    public function portofolio()
    {
        return $this->hasMany(PortofolioMahasiswa::class, 'mahasiswa_id');
    }

    /**
     * Accessor untuk ambil foto profil dengan fallback
     */
    public function getFotoProfilAttribute()
    {
        if ($this->profil && $this->profil->foto) {
            return asset('storage/' . $this->profil->foto);
        }

        return asset('images/default-avatar.png');
    }
}
