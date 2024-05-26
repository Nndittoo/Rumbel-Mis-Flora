<?php

namespace App\Filament\Widgets;

use App\Models\Mapel;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestModuleCreate extends BaseWidget
{
    protected static ?int $sort = 3;
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Mapel::whereDate('created_at', '>', now()->subDays(4)->startOfDay())
            )
            ->columns([
                TextColumn::make('title')->searchable(),
                TextColumn::make('jadwal')->sortable(),
                TextColumn::make('kelas_mulai')->sortable()->label('Kelas Mulai'),
                TextColumn::make('kelas_akhir')->sortable()->label('Kelas Berakhir'),
            ]);
    }
}
