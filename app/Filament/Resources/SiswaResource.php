<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Filament\Resources\SiswaResource\RelationManagers;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
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

    protected static ?string $navigationLabel = "Siswa";

    public static function form(Form $form): Form
{
    // Determine if editing an existing record or creating a new one
    $isEditing = $form->getRecord() !== null;

    // Use different form schemas based on whether editing or creating
    return $form->schema(
        $isEditing ? static::editFormSchema() : static::createFormSchema()
    );
}
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $foreignKey = 'siswa_id';

    protected static function createFormSchema(): array
    {
        return [
            Card::make('Tambah Siswa Baru')
                    ->schema([
                        TextInput::make('full_name')
                            ->label('Nama Lengkap')
                            ->placeholder("Masukkan nama lengkap siswa baru . .")
                            ->required(),
                        TextInput::make('sekolah')
                            ->label('Asal Sekolah')
                            ->placeholder("Masukkan Asal sekolah siswa baru . .")
                            ->required(),
                        Select::make('kelas_id')
                            ->relationship('siswaKelas', 'kelas')
                            ->helperText('Pilihlah kelas siswa di option di atas')
                            ->label("Kelas")
                            ->placeholder("Pilih Kelas untuk siswa baru . .")
                            ->required(),
                        TextInput::make('alamat')
                            ->label('Alamat')
                            ->placeholder("Masukkan alamat siswa baru . .")
                            ->required(),
                        TextInput::make('tempatLahir')
                            ->label('Tempat Lahir')
                            ->placeholder("Masukkan asal tempat lahir siswa baru . .")
                            ->required(),
                        DatePicker::make('tanggalLahir')
                            ->label('Tanggal Lahir')
                            ->helperText('Anda bisa menekan icon calendar di atas untuk memilih tanggal lahir anda.')
                            ->date()
                            ->required(),
                        Select::make('status')
                            ->helperText('Pilihlah status siswa di option di atas')
                            ->options(Siswa::STAT)
                            ->default(Siswa::AKTIF)
                            ->required(),
                        TextInput::make('user_id')
                            ->label('User ID')
                            ->hidden(),
                    ])->columns(2),
                ];
    }

    protected static function editFormSchema(): array
    {
        return [
            TextInput::make('full_name')
            ->label('Nama Lengkap')
            ->required(),
            TextInput::make('sekolah')
                ->label('Asal Sekolah')
                ->required(),
            Select::make('kelas_id')
                ->relationship('siswaKelas', 'kelas')
                ->required(),
            TextInput::make('alamat')
                ->label('Alamat')
                ->required(),
            TextInput::make('tempatLahir')
                ->label('Tempat Lahir')
                ->required(),
            DatePicker::make('tanggalLahir')
                ->label('Tanggal Lahir')
                ->date()
                ->required(),
            Select::make('status')
                ->options(Siswa::STAT)
                ->required(),
        ];
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')->searchable()->sortable()->label('Nama Lengkap'),
                TextColumn::make('siswaOrtu.fullName')->searchable()->label('Orang Tua'),
                TextColumn::make('alamat')->searchable()->sortable(),
                TextColumn::make('siswaKelas.kelas')->sortable()->label('Kelas'),
                TextColumn::make('sekolah')->searchable()->label('Asal Sekolah'),
                TextColumn::make('status')->label('Status')
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
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
