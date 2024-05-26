<?php

namespace App\Filament\Widgets;

use App\Models\Mapel;
use App\Models\Pengajar;
use App\Models\Siswa;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pengajar', Pengajar::count())
            ->icon('heroicon-m-users')
            ->description('Jumlah total pengajar yang terdaftar')
            ->extraAttributes([
            'class' => 'cursor-pointer p-4 rounded-lg shadow-md hover:bg-indigo-700 transition duration-300 ease-in-out',
            ]),
            Stat::make('Total Siswa', Siswa::count())
            ->icon('heroicon-m-academic-cap')
            ->description('Jumlah total Siswa yang terdaftar'),

            Stat::make('Total Modul', Mapel::count())
            ->icon('heroicon-m-book-open')
            ->description('Jumlah total Modul yang terdaftar')
            ->extraAttributes([
                'class' => 'cursor-pointer ',
            ]),
        ];
    }
}
