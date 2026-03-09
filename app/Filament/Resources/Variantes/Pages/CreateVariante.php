<?php

namespace App\Filament\Resources\Variantes\Pages;

use App\Filament\Resources\Variantes\VarianteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVariante extends CreateRecord
{
    protected static string $resource = VarianteResource::class;

    public function mount(): void
    {
        parent::mount();
        if ($id = request()->query('id_producto')) {
            $this->form->fill(['id_producto' => (int) $id]);
        }
    }
}
