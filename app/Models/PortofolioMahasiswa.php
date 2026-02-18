<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PortofolioMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'portofolio_mahasiswa';

    protected $fillable = [
        'mahasiswa_id',
        'judul',
        'deskripsi',
        'link',
        'file'
    ];
}
