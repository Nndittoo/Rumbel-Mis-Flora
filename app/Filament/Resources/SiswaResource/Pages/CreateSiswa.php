<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use App\Filament\Resources\SiswaResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;


class CreateSiswa extends CreateRecord
{
    protected static string $resource = SiswaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
{
    // Ekstrak data siswa langsung dari array $data
    $fullName = $data['full_name'];
    $tanggalLahir = date('dmY', strtotime($data['tanggalLahir']));

    // Buat email dari nama lengkap
    $email = str_replace(' ', '', strtolower($fullName)) . '@students.rms';

    // Ambil kata pertama dari nama lengkap sebagai 'name'
    $name = explode(' ', $fullName)[0];

    // Buat password dari tempat lahir dan tanggal lahir
    $password = $name . $tanggalLahir;

    // Buat user baru
    $user = User::create([
        'name' => $name,
        'email' => $email,
        'password' => Hash::make($password),
        'role' => 'SISWA'
    ]);


    $data['user_id'] = $user->id;

    return $data;
}

}
