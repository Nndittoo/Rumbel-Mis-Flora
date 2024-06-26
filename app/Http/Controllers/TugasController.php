<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use App\Models\Mapel;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    public function create()
    {
        $juduk = "Tambah";
        $mapels = Mapel::all();
        return view('siswa.tugas.tugas-create', compact('mapels', 'juduk'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'mapel_id' => 'required|integer',
        'description' => 'nullable|string',
        'deadline' => 'required|date',
        'file_path' => 'nullable|file|max:10240', // limit file size to 10 MB
    ]);

    $tugas = new Tugas;
    $tugas->title = $validatedData['title'];
    $tugas->mapel_id = $validatedData['mapel_id'];
    $tugas->user_id = Auth::id();
    $tugas->description = $validatedData['description'];
    $tugas->deadline = $validatedData['deadline'];

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $filePath = $file->store('', 'public');
    }
    $tugas->file_path = $filePath;
    $tugas->save();

    return redirect()->route('tugas')->with('success', 'File berhasil disimpan.');
}

    public function show(Tugas $tugas)
    {
        $balasan = $tugas->tugasBalas;
        return view('siswa.tugas.tugas-show', [
            'tugas' => $tugas,
            'balasan' => $balasan
        ]);
    }

    public function index()
    {
        $selesai = Tugas::where('status', 'SELESAI')->count();
        $belumSelesai = Tugas::where('status', 'BELUM SELESAI')->count();
        return view('siswa.tugas.tugas', [
            'tugas' => Tugas::all(),
            'selesai' => $selesai,
            'belumSelesai' => $belumSelesai,
        ]);
    }

    public function edit(Tugas $tugas)
    {
        $juduk = "Edit";
        $mapels = Mapel::all();
        return view('siswa.tugas.tugas-create', compact('tugas', 'mapels', 'juduk'));
    }

    public function update(Request $request, Tugas $tugas)
    {
        $file_path = json_decode($tugas->file_path, true) ?? [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $file_path[] = $file->store('tugas_sekolah_files');
            }
        }

        $tugas->update([
            'title' => $request->title,
            'mapel_id' => $request->mapel_id,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'file_path' => json_encode($file_path),
        ]);

        return redirect()->route('tugas.show', $tugas)->with('success', 'Tugas berhasil diperbarui');
    }

}
