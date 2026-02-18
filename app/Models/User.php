<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi mass assignment
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // ✅ tambahkan role
    ];

    /**
     * Kolom yang disembunyikan
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast tipe data
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * RELASI: 1 User punya 1 Mahasiswa
     */
    public function mahasiswa()
    {
        return $this->hasOne(\App\Models\Mahasiswa::class);
    }


    /**
     * Helper: cek apakah user admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Helper: cek apakah user mahasiswa
     */
    public function isMahasiswa(): bool
    {
        return $this->role === 'mahasiswa';
    }
}
