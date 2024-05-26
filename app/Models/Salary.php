<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    const Januari  = 'Januari';
    const Februari = 'Februari';
    const Maret = 'Maret';
    const April = 'April';
    const Mei = 'Mei';
    const Juni = 'Juni';
    const Juli = 'Juli';
    const Agustus = 'Agustus';
    const September = 'September';
    const Oktober = 'Oktober';
    const November = 'November';
    const Desember = 'Desember';

    const BULAN = [
        self::Januari => 'Januari',
        self::Februari => 'Februari',
        self::Maret => 'Maret',
        self::April => 'April',
        self::Mei => 'Mei',
        self::Juni => 'Juni',
        self::Juli => 'Juli',
        self::Agustus => 'Agustus',
        self::September => 'September',
        self::Oktober => 'Oktober',
        self::November => 'November',
        self::Desember => 'Desember',
    ];

    const LUNAS = 'LUNAS';
    const BELUM_LUNAS = 'BELUM_LUNAS';
    const STATUS = [
        self::LUNAS => 'Lunas',
        self::BELUM_LUNAS => 'Belum Lunas',
    ];
    const TRANSFER = 'TRANSFER';
    const CASH = 'CASH';
    const METODE = [
        self::TRANSFER => 'Transfer',
        self::CASH => 'Cash',
    ];

    protected $fillable = [
        'pengajar_id',
        'gaji',
        'tanggal',
        'caraBayar',
        'periode',
        'status',
        'buktiBayar',
    ];

    public function gajiPengajar(){
        return $this->belongsTo(Pengajar::class, 'pengajar_id');
    }
}
