<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UangResource\Pages;
use App\Filament\Resources\UangResource\RelationManagers;
use App\Models\Uang;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UangResource extends Resource
{
    protected static ?string $model = Uang::class;
    protected static ?string $navigationGroup = "Payment";

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('siswa_id')
                    ->relationship('uangSiswa', 'full_name')
                    ->required(),
                TextInput::make('uang')
                    ->numeric()
                    ->required(),
                Select::make('periode')
                    ->required()
                    ->options(Uang::BULAN),
                Radio::make('caraBayar')
                    ->options(Uang::METODE)
                    ->required(),
                FileUpload::make('buktiBayar')
                    ->required()
                    ->image()
                    ->directory('Uang'),
                Select::make('status')
                    ->options(Uang::STATUS),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListUangs::route('/'),
            'create' => Pages\CreateUang::route('/create'),
            'edit' => Pages\EditUang::route('/{record}/edit'),
        ];
    }
}
