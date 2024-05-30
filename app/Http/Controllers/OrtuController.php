<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrtuController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $ortu= $user->userOrtu;
    $siswa= $ortu->ortuSiswa;

    $uangLes = $siswa->flatMap->siswaUang;

    $waktu = date("d F Y");

    $absen = Presensi::all();

    $mapel = Mapel::all();

    return view('ortu.index', [
        'uangLes' => $uangLes,
        'siswa' => $siswa,
        'absen' => $absen,
        'mapel' => $mapel,
        'waktu' => $waktu
    ]);

}

}
