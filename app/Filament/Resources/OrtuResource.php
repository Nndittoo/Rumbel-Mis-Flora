<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrtuResource\Pages;
use App\Filament\Resources\OrtuResource\RelationManagers;
use App\Models\Ortu;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
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
    protected static ?string $navigationGroup = "Users";
    protected static ?string $navigationLabel = "Orang Tua";

    protected static ?int $groupSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
{
    // Determine if editing an existing record or creating a new one
    $isEditing = $form->getRecord() !== null;

    // Use different form schemas based on whether editing or creating
    return $form->schema(
        $isEditing ? static::editFormSchema() : static::createFormSchema()
    );
}

    protected static function createFormSchema(): array
    {
        return [
            Wizard::make([
                Wizard\Step::make('Biodata')
                    ->schema([
                        TextInput::make('fullName')
                            ->label('Nama Lengkap')
                            ->placeholder("Masukkan nama lengkap orang tua siswa . .")
                            ->required(),
                            Select::make('status')
                            ->options(Ortu::STAT)
                            ->default(Ortu::AKTIF)
                            ->required(),
                        TextInput::make('alamat')
                            ->label('Alamat')
                            ->placeholder("Masukkan alamat orang tua siswa . .")
                            ->required(),
                        TextInput::make('noHp')
                            ->required()
                            ->tel()
                            ->placeholder("08 . . .")
                            ->numeric(),
                            Select::make('ortuSiswa')
                            ->required()
                            ->label("Nama Anak")
                            ->relationship('ortuSiswa', 'full_name'),
                        TextInput::make('user_id')
                            ->label('User ID')
                            ->hidden(),
                    ])->columns(2),
                Wizard\Step::make('Akun')
                    ->schema([
                        TextInput::make('ortuUser.name')
                            ->label('Username')
                            ->placeholder("Masukkan username orang tua")
                            ->helperText("Masukkan username tidak boleh ada angka")
                            ->required()
                            ->maxLength(255),
                        TextInput::make('ortuUser.email')
                            ->email()
                            ->required()
                            ->placeholder("example@gmail.com")
                            ->maxLength(255),
                        TextInput::make('ortuUser.password')
                            ->password()
                            ->required()
                            ->placeholder("Masukkan Password baru . .")
                            ->visible()
                            ->revealable()
                            ->minLength(8),
                        TextInput::make('passwordConfirmation')
                            ->password()
                            ->revealable()
                            ->placeholder("Masukkan password anda kembali . .")
                            ->same('ortuUser.password')
                            ->required(),
                    ]),
                ])->columnSpanFull(),
        ];
    }

    protected static function editFormSchema(): array
    {
        return [
            TextInput::make('fullName')
                            ->label('Nama Lengkap')
                            ->required(),
                        Select::make('ortuSiswa')
                            ->required()
                            ->relationship('ortuSiswa', 'full_name'),
                        TextInput::make('alamat')
                            ->label('Alamat')
                            ->required(),
                        TextInput::make('noHp')
                            ->required()
                            ->tel()
                            ->numeric(),
                        Select::make('status')
                            ->options(['active', 'inactive'])
                            ->required(),
        ];
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
