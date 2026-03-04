<?php

namespace App\Filament\Resources\ProductoImpuestos\Pages;

use App\Filament\Resources\ProductoImpuestos\ProductoImpuestoResource;
use App\Models\Product;
use App\Models\ProductoImpuesto;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditProductoImpuesto extends EditRecord
{
    protected static string $resource = ProductoImpuestoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    public function mount($record = null): void
    {
        parent::mount($record);
        
        // Si estamos editando un registro, cargar todos los impuestos del producto
        if ($record) {
            $productoImpuesto = ProductoImpuesto::find($record);
            if ($productoImpuesto) {
                $productId = $productoImpuesto->product_id;
                $impuestosActuales = ProductoImpuesto::where('product_id', $productId)
                    ->get()
                    ->map(function ($item) {
                        return [
                            'impuesto_id' => (string) $item->impuesto_id,
                            'porcentaje' => (string) $item->porcentaje,
                            'fecha_inicio' => $item->fecha_inicio->format('Y-m-d'),
                            'fecha_fin' => $item->fecha_fin ? $item->fecha_fin->format('Y-m-d') : null,
                        ];
                    })
                    ->toArray();

                $this->data = [
                    'product_id' => (string) $productId,
                    'impuestos' => $impuestosActuales,
                ];

                $this->form->fill($this->data);
            }
        }
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // Obtener el producto actual del registro que se está editando
        $productoImpuesto = ProductoImpuesto::find($record->id);
        $productId = $productoImpuesto->product_id;
        $impuestosNuevos = $data['impuestos'] ?? [];

        // Validar que no haya impuestos duplicados
        $impuestosIds = array_column($impuestosNuevos, 'impuesto_id');
        if (count($impuestosIds) !== count(array_unique($impuestosIds))) {
            throw new \Exception('No se pueden asignar impuestos duplicados al mismo producto.');
        }

        // Eliminar impuestos anteriores del producto
        ProductoImpuesto::where('product_id', $productId)->delete();

        // Crear los nuevos impuestos
        foreach ($impuestosNuevos as $impuesto) {
            ProductoImpuesto::create([
                'product_id' => $productId,
                'impuesto_id' => $impuesto['impuesto_id'],
                'porcentaje' => $impuesto['porcentaje'],
                'fecha_inicio' => $impuesto['fecha_inicio'],
                'fecha_fin' => $impuesto['fecha_fin'] ?? null,
            ]);
        }

        // Retornar el primer registro actualizado
        return ProductoImpuesto::where('product_id', $productId)
            ->latest()
            ->first() ?? $record;
    }
}
