<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'skill_mahasiswa';

    protected $fillable = [
        'mahasiswa_id',
        'nama_skill',
        'level',
    ];
}
