<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    const SELESAI = 'SELESAI';
    const BELUM_SELESAI = 'BELUM SELESAI';
    const JAWAB = [
        self::SELESAI => 'Selesai',
        self::BELUM_SELESAI => 'Belum Selesai',
    ];

    use HasFactory;

    protected $fillable = [
        'user_id',
        'mapel_id',
        'title',
        'description',
        'file_path',
        'original_filename',
        'status',
        'deadline'
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'file_paths' => 'array',
    ];

    public function tugasMapel(){
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }
    public function tugasUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tugasBalas()
    {
        return $this->hasMany(BalasTugas::class);
    }

    public function hasBalasan()
{
    return $this->tugasBalas()->exists();
}

}
