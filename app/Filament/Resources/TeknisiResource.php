<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeknisiResource\Pages;
use App\Filament\Resources\TeknisiResource\RelationManagers;
use App\Models\Teknisi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeknisiResource extends Resource
{
    protected static ?string $model = Teknisi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_teknisi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_telefon')
                    ->tel()
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('keahlian')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_ada')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_teknisi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_telefon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('keahlian')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_ada')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListTeknisis::route('/'),
            'create' => Pages\CreateTeknisi::route('/create'),
            'edit' => Pages\EditTeknisi::route('/{record}/edit'),
        ];
    }
}
