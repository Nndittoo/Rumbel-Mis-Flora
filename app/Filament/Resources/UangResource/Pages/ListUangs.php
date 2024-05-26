<?php

namespace App\Filament\Resources\UangResource\Pages;

use App\Filament\Resources\UangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUangs extends ListRecords
{
    protected static string $resource = UangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
