<?php

namespace App\Filament\Resources\PengajarResource\Pages;

use App\Filament\Resources\PengajarResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
class CreatePengajar extends CreateRecord
{
    protected static string $resource = PengajarResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Create user first
        $user = User::create([
            'name' => $data['pengajarUser']['name'],
            'email' => $data['pengajarUser']['email'],
            'password' => Hash::make($data['pengajarUser']['password']),
            'role' => 'PENGAJAR'
        ]);

        // Add user_id to pengajar data
        $data['user_id'] = $user->id;

        // Remove the pengajarUser data from the array to avoid mass assignment issues
        unset($data['pengajarUser']);

        return $data;
    }

    protected function beforeCreate(): void
    {
        // Ensure all wizard steps are validated
        $this->form->validate();
    }
}
