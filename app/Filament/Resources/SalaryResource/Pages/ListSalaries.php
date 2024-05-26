<?php

namespace App\Filament\Resources\SalaryResource\Pages;

use App\Filament\Resources\SalaryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;


class ListSalaries extends ListRecords
{
    protected static string $resource = SalaryResource::class;

    public function getTitle(): string
    {
        return 'Daftar Gaji Pengajar';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
