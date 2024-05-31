<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Siswa extends Model
{
    use HasFactory;

    const AKTIF = 'AKTIF';
    const TIDAK_AKTIF = 'TIDAK_AKTIF';
    const STAT = [
        self::AKTIF => 'Aktif',
        self::TIDAK_AKTIF => 'Tidak Aktif',
    ];

    protected $fillable = [
        'full_name',
        'sekolah',
        'alamat',
        'tempatLahir',
        'tanggalLahir',
        'user_id',
        'status',
        'kelas_id',
    ];

    public function siswaUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function siswaKelas(){
        return $this->belongsTo(Kelas::class, 'user_id',);
    }
    public function siswaNilai(){
        return $this->hasMany(Nilai::class);
    }

    public function siswaOrtu(){
        return $this->belongsToMany(Ortu::class);
    }
    public function siswaPresensi(){
        return $this->belongsToMany(Presensi::class);
    }

    public function siswaUang(){
        return $this->hasMany(Uang::class);
    }

    public static function store(array $data)
    {
        // Simpan pengajar menggunakan data yang diterima
        $siswa = Siswa::create($data);

        // Buat pengguna (user) menggunakan data yang diterima
        $user = User::create([
            'username' => $data['siswaUser']['name'],
            'email' => $data['siswaUser']['email'],
            'password' => Hash::make($data['siswaUser']['password']),
            'role' => 'SISWA'
        ]);

        // Atur nilai user_id di model siswa
        $siswa->user_id = $user->id;
        $siswa->save();

        // Kembalikan respons atau lakukan tindakan lain yang sesuai
        return $siswa;
    }
}
