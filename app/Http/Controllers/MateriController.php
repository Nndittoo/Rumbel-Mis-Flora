<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index(){
        return view('siswa.materi', [
            'materi' => Materi::all(),
            'mapel' => Mapel::whereHas('mapelMateri', function ($query){
                $query->published();
            })->get()
        ]);
    }
}
