<?php

namespace App\Filament\Resources\PembenahanResource\Pages;

use App\Filament\Resources\PembenahanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPembenahans extends ListRecords
{
    protected static string $resource = PembenahanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
