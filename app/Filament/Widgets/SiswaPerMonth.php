<?php

namespace App\Filament\Widgets;

use App\Models\Siswa;
use App\Models\User;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class SiswaPerMonth extends ChartWidget
{
    protected static ?string $heading = 'Siswa Per Month';
    protected static ?int $sort = 2;
    protected function getData(): array
    {
        return [
           $data = Trend::model(Siswa::class)
                ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
                ->perMonth()
                ->dateColumn('created_at')
                ->count(),
            'datasets' => [
                [
                    'label' => 'Siswa Baru',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
