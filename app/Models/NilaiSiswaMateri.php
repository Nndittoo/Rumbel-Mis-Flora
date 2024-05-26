<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSiswaMateri extends Model
{
    use HasFactory;

    protected $table = 'nilai_siswa_materi';

    protected $fillable = [
        'user_id',
        'materi_id',
    ];
}
