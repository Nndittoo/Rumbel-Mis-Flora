<?php

namespace App\Filament\Pengajar\Resources;

use App\Filament\Pengajar\Resources\MapelResource\Pages;
use App\Filament\Pengajar\Resources\MapelResource\RelationManagers;
use App\Models\Mapel;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;


class MapelResource extends Resource
{
    protected static ?string $model = Mapel::class;
    protected static ?string $navigationGroup = "Modul";
    protected static ?string $pluralLabel = "Modul";

    public static function getNavigationBadge(): ?string


    {
        return static::getModel()::count();
    }


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('title')
            ->live()
            ->label('Nama Modul')
            ->placeholder("Masukkan nama Modul")
            ->minLength(1)
            ->required()->maxLength(150)
            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set){
                if ($operation === 'edit'){
                    return;
                }
                $set('slug', Str::slug($state));
            }),
            TextInput::make('slug')->unique(ignoreRecord: true),
            Select::make('jadwal')->required()->options(Mapel::DAY)->multiple(),
            TimePicker::make('kelas_mulai')->required(),
            TimePicker::make('kelas_akhir')->required(),
            Select::make('kelas_id')
                ->relationship('mapelKelas', 'kelas')
                ->label("Kelas")
                ->required(),
            FileUpload::make('image')
            ->label("Thumbnail")
            ->nullable()
            ->image()
            ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            ImageColumn::make('image')->label("Thumbnail"),
            TextColumn::make('title')->label(('Nama Mata Pelajaran'))->searchable()->sortable(),
            TextColumn::make('mapelKelas.kelas')->sortable()->label('Kelas'),
            TextColumn::make('jadwal'),
            TextColumn::make('kelas_mulai')->sortable(),
            TextColumn::make('kelas_akhir')->sortable(),
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
            'index' => Pages\ListMapels::route('/'),
            'create' => Pages\CreateMapel::route('/create'),
            'edit' => Pages\EditMapel::route('/{record}/edit'),
        ];
    }
}
