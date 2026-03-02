<?php

namespace App\Filament\Resources\Companies\Pages;

use App\Filament\Resources\Companies\CompanyResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCompany extends EditRecord
{
    protected static string $resource = CompanyResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Cargar automáticamente el country y department basado en city_id
        if (!empty($data['city_id'])) {
            $city = \App\Models\City::find($data['city_id']);
            if ($city && $city->department) {
                $data['department_id'] = $city->department->id;
                $data['country_id'] = $city->department->country_id;
            }
        }
        
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Remover country_id y department_id antes de guardar
        // ya que solo se usa city_id
        unset($data['country_id'], $data['department_id']);
        
        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
