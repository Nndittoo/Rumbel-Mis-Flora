<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'materi_id',
        'nilai',
        'catatan',
        'tanggal'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function nilaiSiswa(){
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
    public function nilaiMateri(){
        return $this->belongsTo(Materi::class, 'materi_id');
    }
}
