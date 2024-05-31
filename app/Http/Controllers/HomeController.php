<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if(Auth::user()->role == 'ADMIN'){
            return redirect()->route('filament.admin.pages.dashboard');
        }
        else if(Auth::user()->role == 'ORTU'){
            return redirect()->route('ortu');
        }
        else if(Auth::user()->role == 'SISWA'){
            return view('siswa.index', [
                'mapel' => Mapel::all(),
            ]);
        }
        else{
            return redirect()->route('filament.pengajar.pages.dashboard');
        }

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
