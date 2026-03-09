<?php

namespace App\Filament\Resources\Variantes\Pages;

use App\Filament\Resources\Variantes\VarianteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVariantes extends ListRecords
{
    protected static string $resource = VarianteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
