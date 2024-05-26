<?php

namespace App\Filament\Resources\OrtuResource\Pages;

use App\Filament\Resources\OrtuResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CreateOrtu extends CreateRecord
{
    protected static string $resource = OrtuResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Create user first
        $user = User::create([
            'name' => $data['ortuUser']['name'],
            'email' => $data['ortuUser']['email'],
            'password' => Hash::make($data['ortuUser']['password']),
            'role' => 'ORTU'
        ]);

        // Add user_id to pengajar data
        $data['user_id'] = $user->id;

        // Remove the ortuUser data from the array to avoid mass assignment issues
        unset($data['ortuUser']);

        return $data;
    }
}
