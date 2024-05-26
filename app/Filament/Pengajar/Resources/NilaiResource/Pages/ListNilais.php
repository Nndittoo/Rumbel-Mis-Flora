<?php

namespace App\Filament\Pengajar\Resources\NilaiResource\Pages;

use App\Filament\Pengajar\Resources\NilaiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNilais extends ListRecords
{
    protected static string $resource = NilaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
