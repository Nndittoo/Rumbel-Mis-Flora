<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'sekolah',
        'alamat',
        'user_id',
        'kelas_id',
    ];

    public function siswaUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function siswaKelas(){
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function siswaOrtu(){
        return $this->belongsTo(Ortu::class);
    }
}
