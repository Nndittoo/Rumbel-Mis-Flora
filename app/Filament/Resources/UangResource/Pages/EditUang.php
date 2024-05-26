<?php

namespace App\Filament\Resources\UangResource\Pages;

use App\Filament\Resources\UangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUang extends EditRecord
{
    protected static string $resource = UangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
