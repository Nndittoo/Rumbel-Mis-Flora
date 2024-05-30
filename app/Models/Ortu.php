<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class Ortu extends Model
{
    use HasFactory;

    const AKTIF = 'AKTIF';
    const TIDAK_AKTIF = 'TIDAK_AKTIF';
    const STAT = [
        self::AKTIF => 'Aktif',
        self::TIDAK_AKTIF => 'Tidak Aktif',
    ];

    protected $fillable = [
        'user_id',
        'fullName',
        'alamat',
        'status',
        'noHp'
    ];

    public function ortuUser()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function ortuSiswa(){
    return $this->belongsToMany(Siswa::class);
}

public function siswas(){
    return $this->belongsToMany(Siswa::class, 'ortu_siswa', 'ortu_id', 'siswa_id');
}

public function scopeOrtuRole(Builder $query)
{
    return $query->whereHas('role', function ($query) {
        $query->where('name', 'ortu');
    });
}

public function scopeWithoutOrtuUser(Builder $query)
    {
        return $query->doesntHave('ortuUser');
    }

    public static function store(array $data)
    {
        // Simpan pengajar menggunakan data yang diterima
        $ortu = Ortu::create($data);

        // Buat pengguna (user) menggunakan data yang diterima
        $user = User::create([
            'username' => $data['ortuUser']['name'],
            'email' => $data['ortuUser']['email'],
            'password' => Hash::make($data['ortuUser']['password']),
            'role' => 'ORTU'
        ]);

        // Atur nilai user_id di model pengajar
        $ortu->user_id = $user->id;
        $ortu->save();

        // Kembalikan respons atau lakukan tindakan lain yang sesuai
        return $ortu;
    }
}
