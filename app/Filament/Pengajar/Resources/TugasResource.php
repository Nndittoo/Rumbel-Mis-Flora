<?php

namespace App\Filament\Pengajar\Resources;

use App\Filament\Pengajar\Resources\TugasResource\Pages;
use App\Filament\Pengajar\Resources\TugasResource\RelationManagers;
use App\Models\Tugas;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TugasResource extends Resource
{
    protected static ?string $model = Tugas::class;
    protected static ?string $navigationGroup = "Modul";


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tugasUser.name')->searchable(),
                TextColumn::make('tugasMapel.title')->searchable(),
                TextColumn::make('deadline')->sortable()->date(),
                TextColumn::make('status')->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Actions\Action::make('balas')
                    ->label('Balas')
                    ->icon('heroicon-m-arrow-down-left')
                    ->action(function (Tugas $record, array $data) {
                        \App\Models\BalasTugas::create([
                            'tugas_id' => $record->id,
                            'user_id' => auth()->user()->id,
                            'note' => $data['note'],
                            'balas' => $data['balas'],
                            'tanggal' => $data['tanggal'],
                        ]);
                        $record->update([
                            'status' => $data['status'],
                        ]);
                    })
                    ->form([
                        Forms\Components\Section::make('Data Tugas')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul')
                                    ->disabled()
                                    ->default(fn (Tugas $record) => $record->title),

                                Forms\Components\Textarea::make('description')
                                    ->label('Deskripsi')
                                    ->disabled()
                                    ->default(fn (Tugas $record) => $record->description),
                                Forms\Components\FileUpload::make('file_path')
                                    ->label('File')
                                    ->image()
                                    ->disabled()
                                    ->default(fn (Tugas $record) => $record->file_path),
                            ]),

                        Forms\Components\Section::make('Balasan Pengajar')
                            ->schema([
                                Forms\Components\Textarea::make('note')
                                    ->required()
                                    ->label('Note'),
                                DatePicker::make('tanggal')->default(now()),
                                FileUpload::make('balas')->image()
                                ->directory('balasTugas/file'),
                                Select::make('status')
                                ->options(Tugas::JAWAB)
                                ->default(Tugas::SELESAI)
                            ]),
                    ]),
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
            'index' => Pages\ListTugas::route('/'),
            'create' => Pages\CreateTugas::route('/create'),
            'edit' => Pages\EditTugas::route('/{record}/edit'),
        ];
    }
}
