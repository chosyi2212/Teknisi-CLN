<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Pasang;
use App\Models\Teknisi;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\PasangResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PasangResource\RelationManagers;

class PasangResource extends Resource
{
    protected static ?string $model = Pasang::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nomortiket')
                    ->label('NO.Tiket Pelanggan')
                    ->disabled()
                    ->default(fn () => \App\Models\Pasang::generateNomorTiket()),
                TextInput::make('nama_pelanggan')
                    ->required()
                    ->label('Nama Pelanggan')
                    ->placeholder('masukkan Nama Pelanggan'),
                Textarea::make('keterangan')
                    ->autosize()
                    ->label('Keterangan')
                    ->placeholder('Keterangan Pelanggan'),
                Select::make('jenis_koneksi')
                    ->options([
                        'WIRELESS'=>'WIRELESS',
                        'HTB'=>'HTB',
                        'FIBER OPTIC'=>'FIBER OPTIC',
                        'LAN'=>'LAN',
                    ])
                    ->label('Jenis Koneksi')
                    ->placeholder('Pilih jenis koneksi'),
                Select::make('status')
                    ->options([
                        'pending'=>'Masih menunggu',
                        'in-progress'=>'Sedang di proses',
                        'resolved'=>'Sudah selesai',
                        'reject'=>'Di Batalkan',
                    ])
                    ->label('Status')
                    ->placeholder('Pilih status'),
                DateTimePicker::make('waktu_pasang')
                    ->displayFormat('d/m/Y H:i')
                    ->placeholder('03/12/2024 10:40'),
                TextInput::make('lokasi_pasang')
                    ->placeholder('-8.128999, 112.011781'),
                Select::make('teknisi_id')
                    ->label('Teknisi')
                    ->options(Teknisi::all()->pluck('nama_teknisi', 'id'))
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tiketing'),
                TextColumn::make('nama_pelanggan'),
                TextColumn::make('jenis_koneksi'),
                TextColumn::make('keterangan'),
                TextColumn::make('status'),
                TextColumn::make('waktu_pasang'),
                TextColumn::make('lokasi_pasang'),
                TextColumn::make('teknisi.nama_teknisi')->label('Teknisi')->sortable(),
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
            'index' => Pages\ListPasangs::route('/'),
            'create' => Pages\CreatePasang::route('/create'),
            'edit' => Pages\EditPasang::route('/{record}/edit'),
        ];
    }
}
