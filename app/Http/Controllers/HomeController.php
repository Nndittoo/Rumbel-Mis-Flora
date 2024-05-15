<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Materi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('siswa.index', [
            'mapel' => Mapel::all(),
        ]);
    }

    public function show(Mapel $mapel){
        $materi = $mapel->mapelMateri; // Asumsikan Anda memiliki relasi `materi` pada model `Mapel`

        return view('siswa.materi', [
            'materi' => $materi,
            'mapel' => Mapel::whereHas('mapelMateri', function ($query) {
                $query->published();
            })->get(),
            'selectedMapel' => $mapel
        ]);
    }
}
