<?php

namespace App\Filament\Resources\PasangResource\Pages;

use App\Filament\Resources\PasangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPasangs extends ListRecords
{
    protected static string $resource = PasangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
