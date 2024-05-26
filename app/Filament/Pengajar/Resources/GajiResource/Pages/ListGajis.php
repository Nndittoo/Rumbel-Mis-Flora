<?php

namespace App\Filament\Pengajar\Resources\GajiResource\Pages;

use App\Filament\Pengajar\Resources\GajiResource;
use App\Models\Salary;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListGajis extends ListRecords
{
    protected static string $resource = GajiResource::class;

    public static function query()
    {
        $pengajarId = Auth::user()->pengajar->id;
        return Salary::query()->where('pengajar_id', $pengajarId);
    }


}
