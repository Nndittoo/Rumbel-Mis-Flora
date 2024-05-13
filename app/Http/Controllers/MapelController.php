<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index(){
        return view('siswa.home', [
            'mapel' => Mapel::whereHas('mapelMateri', function ($query){
                $query->published();
            })->get()
        ]);
    }
}
