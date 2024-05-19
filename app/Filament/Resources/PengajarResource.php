<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengajarResource\Pages;
use App\Filament\Resources\PengajarResource\RelationManagers;
use App\Models\Pengajar;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengajarResource extends Resource
{
    protected static ?string $model = Pengajar::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Wizard::make([
                Wizard\Step::make('Akun')
                    ->schema([
                        TextInput::make('pengajarUser.name')
                            ->label('Username')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('pengajarUser.email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('pengajarUser.password')
                            ->password()
                            ->required()
                            ->visible()
                            ->revealable()
                            ->minLength(8),
                    ]),
                Wizard\Step::make('Biodata')
                    ->schema([
                        TextInput::make('fullname')
                            ->label('Nama Lengkap')
                            ->required(),
                        TextInput::make('tempatLahir')
                            ->label('Tempat Lahir')
                            ->required(),
                        DatePicker::make('tanggalLahir')
                            ->label('Tanggal Lahir')
                            ->date(),
                        TextInput::make('alamat')
                            ->label('Alamat')
                            ->required(),
                        TextInput::make('pendidikan')
                            ->label('Pendidikan Terakhir')
                            ->required(),
                        Select::make('status')
                            ->options(Pengajar::STAT)
                            ->required(),
                        TextInput::make('user_id')
                            ->label('User ID')
                            ->hidden(),
                    ]),
                ])->columnSpanFull()
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
            'index' => Pages\ListPengajars::route('/'),
            'create' => Pages\CreatePengajar::route('/create'),
            'edit' => Pages\EditPengajar::route('/{record}/edit'),
        ];
    }
}
