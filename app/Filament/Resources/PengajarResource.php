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
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengajarResource extends Resource
{
    protected static ?string $model = Pengajar::class;
    protected static ?string $navigationLabel = "Pengajar";
    protected static ?string $navigationGroup = "Users";
    public static function form(Form $form): Form
{
    // Determine if editing an existing record or creating a new one
    $isEditing = $form->getRecord() !== null;

    // Use different form schemas based on whether editing or creating
    return $form->schema(
        $isEditing ? static::editFormSchema() : static::createFormSchema()
    );
}

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static function createFormSchema(): array
    {
        return [
            Wizard::make([
                Wizard\Step::make('Biodata')
                    ->schema([
                        TextInput::make('fullname')
                            ->label('Nama Lengkap')
                            ->placeholder("Masukkan nama panjang pengajar baru . .")
                            ->required(),
                        TextInput::make('tempatLahir')
                            ->label('Tempat Lahir')
                            ->placeholder("Masukkan Tempat Lahir Pengajar Baru . .")
                            ->helperText("Tempat lahir anda tidak boleh kosong.")
                            ->required(),
                        DatePicker::make('tanggalLahir')
                            ->required()
                            ->label('Tanggal Lahir')
                            ->helperText('Anda dapat menekan icon calender untuk memilih tanggal lahir anda.')
                            ->date(),
                        TextInput::make('alamat')
                            ->label('Alamat')
                            ->placeholder("Masukkan Alamat Pengajar Baru . .")
                            ->helperText("Tempat lahir anda tidak boleh kosong.")
                            ->required(),
                        TextInput::make('noHp')
                            ->label('Nomor Telepon')
                            ->required()
                            ->placeholder("08 . .")
                            ->helperText("No hp anda tidak boleh kurang dari 10 dan lebih dari 14.")
                            ->minLength(10)
                            ->maxLength(14)
                            ->tel()
                            ->numeric(),
                        Select::make('pendidikan')
                            ->label('Pendidikan Terakhir')
                            ->helperText("Pilihlah salah satu dari option di atas.")
                            ->options([
                                'sma' => 'SMA',
                                'smk' => 'SMK',
                                'diploma' => 'Diploma (D3)',
                                'sarjana' => 'Sarjana (S1)',
                                'magister' => 'Magister (S2)',
                                'doktor' => 'Doktor (S3)',
                            ])
                            ->required(),
                        Select::make('status')
                            ->options(Pengajar::STAT)
                            ->helperText("Pilihlah status pengajar baru ini dari uption di atas.")
                            ->required(),
                        TextInput::make('user_id')
                            ->label('User ID')
                            ->hidden(),
                    ])->columns(2),
                    Wizard\Step::make('Akun')->icon('heroicon-m-user-plus')->completedIcon('heroicon-m-hand-thumb-up')
                    ->schema([
                        TextInput::make('pengajarUser.name')
                            ->label('Username')
                            ->placeholder("Masukkan username orang tua")
                            ->required()
                            ->helperText('Pastikan username anda mudah di ingat.')
                            ->minLength(5)
                            ->maxLength(255),
                        TextInput::make('pengajarUser.email')
                            ->email()
                            ->required()
                            ->helperText('Pastikan email anda mudah di ingat.')
                            ->placeholder("example@gmail.com")
                            ->maxLength(255),
                        TextInput::make('pengajarUser.password')
                            ->password()
                            ->required()
                            ->placeholder("Masukkan Password baru . .")
                            ->helperText('Pastikan password anda mudah di ingat.')
                            ->visible()
                            ->revealable()
                            ->minLength(8),
                        TextInput::make('passwordConfirmation')
                            ->password()
                            ->placeholder("Masukkan password anda kembali . .")
                            ->revealable()
                            ->same('pengajarUser.password')
                            ->required(),
                    ]),
                ])->columnSpanFull(),
    ];
    }

    protected static function editFormSchema(): array
    {
        return [
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
                TextInput::make('noHp')
                ->label('Nomor Telepon')
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
                TextColumn::make('fullname')->label('Full Name')->searchable(),
                TextColumn::make('pengajarUser.email')->label('Email')->searchable(),
                TextColumn::make('alamat')->searchable(),
                TextColumn::make('noHp')->searchable(),
                TextColumn::make('pendidikan')->label('Pendidikan Terakhir')->searchable()
                    ->getStateUsing(function ($record) {
                        return self::getPendidikanLabel($record->pendidikan);
                    }),
                    TextColumn::make('status')
                    ->label('Status')
                    ->getStateUsing(function ($record) {
                        return $record->status === 'AKTIF' ? 'Aktif' : 'Tidak Aktif';
                    })
                    ->extraAttributes(function ($record) {
                        return [
                            'class' => $record->status === 'AKTIF' ? 'text-green-500' : 'text-red-500',
                        ];
                    }),
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

    public static function getPendidikanLabel($pendidikan)
    {
        $labels = [
            'sma' => 'SMA',
            'smk' => 'SMK',
            'diploma' => 'Diploma (D3)',
            'sarjana' => 'Sarjana (S1)',
            'magister' => 'Magister (S2)',
            'doktor' => 'Doktor (S3)',
        ];

        return $labels[$pendidikan] ?? $pendidikan;
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
