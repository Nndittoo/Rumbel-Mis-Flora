<?php

namespace App\Filament\Resources\OrtuResource\Pages;

use App\Filament\Resources\OrtuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrtus extends ListRecords
{
    protected static string $resource = OrtuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
