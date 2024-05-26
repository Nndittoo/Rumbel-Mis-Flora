<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    const HADIR = 'HADIR';
    const IZIN = 'IZIN';
    const SAKIT = 'ALPHA';
    const ALPHA = 'SISWA';

    const ABSENSI = [
        self::IZIN => 'Izin',
        self::ALPHA => 'Alpha',
        self::SAKIT => 'Sakit',
        self::HADIR => 'Hadir',
    ];

    protected $fillable = [
        'siswa_id',
        'attendance',
        'tanggal',
    ];


    protected $casts = [
        'tanggal' => 'datetime', // Pastikan kolom 'jadwal' dicasting sebagai array
    ];

    public function presensiSiswa(){
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
