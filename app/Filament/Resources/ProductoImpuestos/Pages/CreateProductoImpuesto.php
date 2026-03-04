<?php

namespace App\Filament\Resources\ProductoImpuestos\Pages;

use App\Filament\Resources\ProductoImpuestos\ProductoImpuestoResource;
use App\Models\ProductoImpuesto;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateProductoImpuesto extends CreateRecord
{
    protected static string $resource = ProductoImpuestoResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $productId = $data['product_id'];
        $impuestos = $data['impuestos'] ?? [];

        // Validar que no haya impuestos duplicados
        $impuestosIds = array_column($impuestos, 'impuesto_id');
        if (count($impuestosIds) !== count(array_unique($impuestosIds))) {
            throw new \Exception('No se pueden asignar impuestos duplicados al mismo producto.');
        }

        // Validar que el producto no tenga estos impuestos ya asignados
        $impuestosExistentes = ProductoImpuesto::where('product_id', $productId)
            ->whereIn('impuesto_id', $impuestosIds)
            ->pluck('impuesto_id')
            ->toArray();

        if (!empty($impuestosExistentes)) {
            throw new \Exception('Este producto ya tiene algunos de estos impuestos asignados.');
        }

        // Crear múltiples registros de ProductoImpuesto
        foreach ($impuestos as $impuesto) {
            ProductoImpuesto::create([
                'product_id' => $productId,
                'impuesto_id' => $impuesto['impuesto_id'],
                'porcentaje' => $impuesto['porcentaje'],
                'fecha_inicio' => $impuesto['fecha_inicio'],
                'fecha_fin' => $impuesto['fecha_fin'] ?? null,
            ]);
        }

        // Retornar el primer registro creado para la redirección
        return ProductoImpuesto::where('product_id', $productId)
            ->latest()
            ->first() ?? new ProductoImpuesto();
    }
}
