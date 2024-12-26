<?php

namespace App\Filament\Resources\PembenahanResource\Pages;

use App\Filament\Resources\PembenahanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPembenahan extends EditRecord
{
    protected static string $resource = PembenahanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
