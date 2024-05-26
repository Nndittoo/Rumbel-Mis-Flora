<?php

namespace App\Filament\Pengajar\Resources\GajiResource\Pages;

use App\Filament\Pengajar\Resources\GajiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGaji extends EditRecord
{
    protected static string $resource = GajiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
