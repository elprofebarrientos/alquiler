<?php

namespace App\Filament\Resources\Compras\Pages;

use App\Filament\Resources\Compras\CompraResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateCompra extends CreateRecord
{
    protected static string $resource = CompraResource::class;

    public function getMaxContentWidth(): Width|string|null
    {
        return Width::Full;
    }
}
