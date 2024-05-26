<?php

namespace App\Filament\Pengajar\Resources;

use App\Filament\Pengajar\Resources\NilaiResource\Pages;
use App\Filament\Pengajar\Resources\NilaiResource\RelationManagers;
use App\Models\Nilai;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
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
use Closure;
use Filament\Forms\Get;

class NilaiResource extends Resource
{
    protected static ?string $model = Nilai::class;

    protected static ?string $navigationGroup = "Siswa";


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Card::make()
                ->schema([
                    Select::make('siswa_id')
                    ->relationship('nilaiSiswa', 'full_name')
                    ->required()
                    ->columnSpan(2),
                    TextInput::make('nilai')
                    ->numeric()
                    ->required()
                    ->rules(['min:0', 'max:100']),
                Select::make('materi_id')
                    ->relationship('nilaiMateri', 'title')
                    ->required()
                    ->columnSpan(2),
                DatePicker::make('tanggal')->default(now()),
                TextInput::make('catatan')
                    ->required()
                    ->columnSpan(3),
                ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nilaiSiswa.full_name')->searchable(),
                TextColumn::make('nilaiMateri.title')->searchable(),
                TextColumn::make('nilai')->sortable(),
                TextColumn::make('tanggal')->date()->sortable()
            ])
            ->filters([
                SelectFilter::make('tanggal')
                    ->label('Tanggal')
                    ->options(function () {
                        $uniqueDates = Nilai::distinct()->orderBy('tanggal', 'asc')->get(['tanggal']);
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
            'index' => Pages\ListNilais::route('/'),
            'create' => Pages\CreateNilai::route('/create'),
            'edit' => Pages\EditNilai::route('/{record}/edit'),
        ];
    }
}
