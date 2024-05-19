<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrtuResource\Pages;
use App\Filament\Resources\OrtuResource\RelationManagers;
use App\Models\Ortu;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrtuResource extends Resource
{
    protected static ?string $model = Ortu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                ->label('Akun')
                ->relationship('ortuUser', 'name')
                ->required(),
                Select::make('ortuSiswa')->label('Anak')
                ->relationship('ortuSiswa', 'full_name')
                ->required(),
                TextInput::make('fullName')
                ->label('Nama Lengkap')
                ->required(),
                TextInput::make('alamat')
                ->required()
                ->label('Alamat'),
                TextInput::make('noHp')
                ->required()
                ->label('Nomor Hp')
                ->tel()
                ->numeric()
                ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fullName')->searchable(),
                TextColumn::make('ortuSiswa.full_name')->label('Nama Anak')->searchable(),
                TextColumn::make('alamat')->searchable(),
                TextColumn::make('noHp')
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
            'index' => Pages\ListOrtus::route('/'),
            'create' => Pages\CreateOrtu::route('/create'),
            'edit' => Pages\EditOrtu::route('/{record}/edit'),
        ];
    }
}
