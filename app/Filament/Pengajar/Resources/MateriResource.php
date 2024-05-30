<?php

namespace App\Filament\Pengajar\Resources;

use App\Filament\Pengajar\Resources\MateriResource\Pages;
use App\Filament\Pengajar\Resources\MateriResource\RelationManagers;
use App\Models\Materi;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class MateriResource extends Resource
{
    protected static ?string $model = Materi::class;
    protected static ?string $navigationGroup = "Modul";
    protected static ?string $navigationLabel = "Sub Modul";
    protected static ?string $pluralLabel = "Sub Modul";

    public static function getNavigationBadge(): ?string

{
    return static::getModel()::count();
}


    public static function form(Form $form): Form
    {
        $userId = Auth::id();
        return $form
        ->schema([
            Select::make('materiMapel')->label('Modul')
            ->relationship('materiMapel', 'title')
            ->columnSpanFull()
            ->required(),
            TextInput::make('title')
            ->live()
            ->label('Sub Modul')
            ->placeholder("Masukkan nama sub modul")
            ->minLength(1)
            ->required()->maxLength(150)
            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set){
                if ($operation === 'edit'){
                    return;
                }
                $set('slug', Str::slug($state));
            }),
            TextInput::make('slug')->unique(ignoreRecord: true),
            FileUpload::make('image')
            ->label("Thumbnail")
            ->directory('materi/image')
            ->required()
            ->columnSpanFull(),
            RichEditor::make('body')
            ->required()
            ->columnSpanFull(),
            Select::make('user_id')->label('Nama pengajar')
            ->relationship('author', 'name')
            ->required()
            ->default($userId),
            DateTimePicker::make('published_at')
            ->default(now())
            ->required()
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            ImageColumn::make('image')->label("Thumbnail"),
            TextColumn::make('title')->searchable()->sortable()->label('Sub Modul'),
            TextColumn::make('materiMapel.title')->searchable()->sortable()->label('Modul'),
            TextColumn::make('author.name')->searchable()->sortable()->label('Nama Pengajar'),
            TextColumn::make('published_at')->date()->sortable(),
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
            'index' => Pages\ListMateris::route('/'),
            'create' => Pages\CreateMateri::route('/create'),
            'edit' => Pages\EditMateri::route('/{record}/edit'),
        ];
    }
}
