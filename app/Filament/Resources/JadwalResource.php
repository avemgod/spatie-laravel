<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JadwalResource\Pages;
use App\Filament\Resources\JadwalResource\RelationManagers;
use App\Models\Jadwal;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JadwalResource extends Resource
{
    protected static ?string $model = Jadwal::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Jadwal Kelas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
            Select::make('paket_id')
            ->relationship('paket', 'nama_paket')
            ->label('Paket')
            ->required(),
        Select::make('mata_kuliah_id')
            ->relationship('mataKuliah', 'nama_matkul')
            ->label('Mata Kuliah')
            ->required(),
        TextInput::make('hari')->label('Hari')->required(),
        TimePicker::make('jam_mulai')->label('Jam Mulai')->required(),
        TimePicker::make('jam_selesai')->label('Jam Selesai')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
            TextColumn::make('paket.nama_paket')->label('Paket'),
            TextColumn::make('mataKuliah.nama_matkul')->label('Mata Kuliah'),
            TextColumn::make('hari')->label('Hari'),
            TextColumn::make('jam_mulai')->label('Mulai'),
            TextColumn::make('jam_selesai')->label('Selesai'),
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
            'index' => Pages\ListJadwals::route('/'),
            'create' => Pages\CreateJadwal::route('/create'),
            'edit' => Pages\EditJadwal::route('/{record}/edit'),
        ];
    }
}
