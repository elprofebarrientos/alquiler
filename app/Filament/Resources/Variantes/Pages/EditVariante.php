<?php

namespace App\Filament\Resources\Variantes\Pages;

use App\Filament\Resources\Variantes\VarianteResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVariante extends EditRecord
{
    protected static string $resource = VarianteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
