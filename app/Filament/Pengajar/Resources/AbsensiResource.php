<?php

namespace App\Filament\Pengajar\Resources;

use App\Filament\Pengajar\Resources\AbsensiResource\Pages;
use App\Filament\Pengajar\Resources\AbsensiResource\RelationManagers;
use App\Models\Absensi;
use App\Models\Presensi;
use App\Models\Siswa;
use Doctrine\DBAL\Schema\Schema;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Carbon\Carbon;

class AbsensiResource extends Resource
{
    protected static ?string $model = Presensi::class;
    protected static ?string $navigationGroup = "Siswa";

    protected static ?string $navigationLabel = "Absensi";
    protected static ?string $label = "Absensi Siswa";

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
        return[
            Fieldset::make('')
                            ->schema([
                                Select::make('siswa_id')
                                ->label("Nama Siswa")
                                    ->options(function () {
                                        $today = now()->format('Y-m-d'); // Get today's date in 'YYYY-MM-DD' format

                                        return Siswa::whereNotIn('id', function ($query) use ($today) {
                                            $query->select('siswa_id')
                                                  ->from('presensis')
                                                  ->whereDate('tanggal', $today); // Check for today’s date
                                        })->get()->pluck('full_name', 'id')->toArray();
                                    })
                                    ->required(),
                                Select::make('attendance')
                                    ->options(Presensi::ABSENSI)
                                    ->label("Kehadiran")
                                    ->required(),
                    ])
        ];
    }

protected static function editFormSchema(): array
{
    return [
        Fieldset::make('')
        ->schema([
            Select::make('siswa_id')
                ->unique(ignoreRecord: true)
                ->relationship('presensiSiswa', 'full_name')
                ->required(),
            Select::make('attendance')
                ->options(Presensi::ABSENSI)
                ->required(),
            DatePicker::make('tanggal')
])
    ];
}


    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('presensiSiswa.full_name')->searchable(),
            TextColumn::make('attendance')->sortable(),
            TextColumn::make('tanggal')->date()->sortable(),
        ])
        ->filters([
            SelectFilter::make('attendance')
            ->label('Absensi')
            ->options(Presensi::ABSENSI),
            SelectFilter::make('tanggal')
            ->label('Tanggal')
            ->options(function () {
                // Ambil daftar tanggal yang unik dari tabel 'presensis'
                $uniqueDates = Presensi::distinct()->orderBy('tanggal', 'asc')->get(['tanggal']);

                // Buat array untuk opsi filter
                $options = [];
                foreach ($uniqueDates as $date) {
                    $formattedDate = Carbon::parse($date->tanggal)->format('Y-m-d');
                    $options[$formattedDate] = $formattedDate;
                }
                return $options;
            }),
        ])
        ->actions([
            Tables\Actions\ActionGroup::make([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                ])
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
            'index' => Pages\ListAbsensis::route('/'),
            'create' => Pages\CreateAbsensi::route('/create'),
            'edit' => Pages\EditAbsensi::route('/{record}/edit'),
        ];
    }
}
