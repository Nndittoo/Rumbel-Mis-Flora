<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Pengajar extends Model
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
        'email',
        'name',
        'password',
        'role',
        'fullname',
        'tempatLahir',
        'tanggalLahir',
        'alamat',
        'pendidikan',
        'status',
    ];

    public function pengajarUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

        public static function store(array $data)
    {
        // Simpan pengajar menggunakan data yang diterima
        $pengajar = Pengajar::create($data);

        // Buat pengguna (user) menggunakan data yang diterima
        $user = User::create([
            'username' => $data['pengajarUser']['name'],
            'email' => $data['pengajarUser']['email'],
            'password' => Hash::make($data['pengajarUser']['password']),
            'role' => 'PENGAJAR'
        ]);

        // Atur nilai user_id di model pengajar
        $pengajar->user_id = $user->id;
        $pengajar->save();

        // Kembalikan respons atau lakukan tindakan lain yang sesuai
        return $pengajar;
    }
}
