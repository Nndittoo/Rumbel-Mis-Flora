<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas',
    ];

    public function kelasSiswa(){
        return $this->belongsToMany(Siswa::class, 'kelas_id');
    }
}
