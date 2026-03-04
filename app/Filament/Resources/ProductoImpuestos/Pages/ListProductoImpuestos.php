<?php

namespace App\Filament\Resources\ProductoImpuestos\Pages;

use App\Filament\Resources\ProductoImpuestos\ProductoImpuestoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductoImpuestos extends ListRecords
{
    protected static string $resource = ProductoImpuestoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
