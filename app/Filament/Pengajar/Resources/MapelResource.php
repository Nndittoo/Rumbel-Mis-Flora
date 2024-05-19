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
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    
    protected static ?string $navigationGroup = "Belajar";
    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('title')
            ->live()
            ->label('Nama Mata Pelajaran')
            ->minLength(1)
            ->required()->maxLength(150)
            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set){
                if ($operation === 'edit'){
                    return;
                }
                $set('slug', Str::slug($state));
            }),
            TextInput::make('slug')->unique(ignoreRecord: true),
            Select::make('jadwal')->required()->options(Mapel::DAY),
            TimePicker::make('kelas_mulai')->required(),
            TimePicker::make('kelas_akhir')->required(),
            FileUpload::make('image')
            ->nullable()
            ->image()
            ->columnSpanFull(),
            TextInput::make('text_color')
            ->nullable(),
            TextInput::make('bg_color')->nullable(),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            ImageColumn::make('image'),
            TextColumn::make('title')->label(('Nama Mata Pelajaran'))->searchable()->sortable(),
            TextColumn::make('slug')->searchable()->sortable(),
            TextColumn::make('jadwal'),
            TextColumn::make('kelas_mulai')->sortable(),
            TextColumn::make('kelas_akhir')->sortable(),
            TextColumn::make('text_color')->sortable(),
            TextColumn::make('bg_color')->sortable(),
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
