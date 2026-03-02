<?php

namespace App\Filament\Resources\Companies\Pages;

use App\Filament\Resources\Companies\CompanyResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCompany extends CreateRecord
{
    protected static string $resource = CompanyResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Remover country_id y department_id antes de guardar
        // ya que solo se usa city_id
        unset($data['country_id'], $data['department_id']);
        
        return $data;
    }
}
