<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SalaryResource\Pages;
use App\Filament\Resources\SalaryResource\RelationManagers;
use App\Models\Salary;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SalaryResource extends Resource
{
    protected static ?string $model = Salary::class;
    protected static ?string $navigationLabel = "Gaji Pengajar";
    protected static ?string $navigationGroup = "Payment";

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('pengajar_id')
                    ->relationship('gajiPengajar', 'fullname')
                    ->required(),
                TextInput::make('gaji')
                    ->numeric()
                    ->required(),
                Select::make('periode')
                    ->options(Salary::BULAN)
                    ->required(),
                Select::make('caraBayar')
                    ->options(Salary::METODE)
                    ->required(),
                FileUpload::make('buktiBayar')
                    ->required()
                    ->image()
                    ->directory('Gaji'),
                Select::make('status')
                    ->options(Salary::STATUS),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('gajiPengajar.fullname')->searchable(),
                TextColumn::make('gaji')->sortable()->label('Gaji'),
                TextColumn::make('caraBayar')->sortable()->searchable(),
                ImageColumn::make('buktiBayar'),
                TextColumn::make('status')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    ])
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
            'index' => Pages\ListSalaries::route('/'),
            'create' => Pages\CreateSalary::route('/create'),
            'edit' => Pages\EditSalary::route('/{record}/edit'),
        ];
    }
}
