<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Filament\Resources\SiswaResource\RelationManagers;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;
    protected static ?string $navigationGroup = "Users";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                ->label('Akun')
                ->relationship('siswaUser', 'name')
                ->required(),
                TextInput::make('full_name')
                ->label('Nama Lengkap')
                ->required(),
                TextInput::make('alamat')
                ->required()
                ->label('Alamat'),
                TextInput::make('sekolah')
                ->required()
                ->label('Asal Sekolah'),
                Select::make('kelas_id')
                ->label('Kelas')
                ->required()
                ->relationship('siswaKelas', 'kelas'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')->searchable()->sortable()->label('Nama Lengkap'),
                TextColumn::make('alamat')->searchable()->sortable(),
                TextColumn::make('siswaKelas.kelas')->sortable()->label('Kelas'),
                TextColumn::make('siswaOrtu.fullName')->searchable()->label('Orang Tua'),
                TextColumn::make('sekolah')->searchable()->label('Asal Sekolah'),
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
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
