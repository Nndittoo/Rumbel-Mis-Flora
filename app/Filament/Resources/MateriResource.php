<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MateriResource\Pages;
use App\Filament\Resources\MateriResource\RelationManagers;
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
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MateriResource extends Resource
{
    protected static ?string $model = Materi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('materiMapel')->label('Mata Pelajaran')
                ->relationship('materiMapel', 'title')
                ->columnSpanFull()
                ->multiple()
                ->required(),
                TextInput::make('title')
                ->live()
                ->label('Nama Materi')
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
                ->directory('materi/image')
                ->required()
                ->columnSpanFull(),
                RichEditor::make('body')
                ->required()
                ->columnSpanFull()
                ->fileAttachmentsDirectory('materi/file'),
                Select::make('user_id')->label('Pengajar')
                ->relationship('author', 'name')
                ->required(),
                DateTimePicker::make('published_at')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'),
                TextColumn::make('title')->searchable()->sortable()->label('Materi'),
                TextColumn::make('materiMapel.title')->searchable()->sortable()->label('Mata Pelajaran'),
                TextColumn::make('author.name')->searchable()->sortable()->label('Pengajar'),
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
