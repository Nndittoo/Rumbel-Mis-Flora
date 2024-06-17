<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Ortu;
use App\Models\Pengajar;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrtuController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $ortu= $user->userOrtu;
    $siswa= $ortu->ortuSiswa;
    $nilai = $siswa->flatMap->siswaNilai;
    $uangLes = $siswa->flatMap->siswaUang;

    $waktu = date("d F Y");

    $nilai->tanggal = date("d F Y");

    $absen = Presensi::all();

    $pengajar = Pengajar::all();

    $mapel = Mapel::all();

    return view('ortu.index', [
        'uangLes' => $uangLes,
        'siswa' => $siswa,
        'absen' => $absen,
        'mapel' => $mapel,
        'waktu' => $waktu,
        'nilai' => $nilai,
        'pengajar' => $pengajar,
    ]);

}

}
