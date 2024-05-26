<?php

namespace App\Filament\Pengajar\Resources;

use App\Filament\Pengajar\Resources\GajiResource\Pages;
use App\Filament\Pengajar\Resources\GajiResource\RelationManagers;
use App\Models\Pengajar;
use App\Models\Salary;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class GajiResource extends Resource
{
    protected static ?string $model = Salary::class;

    protected static ?string $navigationLabel = 'Gaji Ku';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            //
        ]);
    }

    public static function table(Table $table): Table
    {
        $options = Pengajar::pluck('fullname', 'fullname')->toArray();

        return $table
            ->columns([
                TextColumn::make('gajiPengajar.fullname')->searchable(),
                TextColumn::make('gaji')->sortable()->label('Gaji'),
                TextColumn::make('caraBayar')->sortable()->searchable(),
                ImageColumn::make('buktiBayar'),
                TextColumn::make('periode')->sortable(),
                TextColumn::make('created_at')->sortable()->date(),
                TextColumn::make('status')->sortable(),
            ])
            ->filters([
                SelectFilter::make('periode')->label('Bulan')->options(Salary::BULAN)->multiple(),
                SelectFilter::make('caraBayar')->label('Cara Bayar')->options(Salary::METODE),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                    Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGajis::route('/'),
            'create' => Pages\CreateGaji::route('/create'),
        ];
    }
}
