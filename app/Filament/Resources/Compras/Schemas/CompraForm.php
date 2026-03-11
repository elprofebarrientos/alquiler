<?php

namespace App\Filament\Resources\Compras\Schemas;

use App\Models\Product;
use App\Models\Proveedor;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CompraForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Datos de la Compra')
                ->columns(3)
                ->schema([
                    Select::make('id_proveedor')
                        ->label('Proveedor')
                        ->options(fn () => Proveedor::query()->where('estado', true)->pluck('razon_social', 'id_proveedor'))
                        ->searchable()
                        ->preload()
                        ->required(),

                    TextInput::make('numero_factura')
                        ->label('Número de Factura')
                        ->maxLength(50),

                    TextInput::make('cufe')
                        ->label('CUFE (Código DIAN)')
                        ->maxLength(255),

                    DatePicker::make('fecha_emision')
                        ->label('Fecha de Emisión')
                        ->required(),

                    DatePicker::make('fecha_vencimiento')
                        ->label('Fecha de Vencimiento'),
                ]),

            Section::make('Totales')
                ->columns(5)
                ->schema([
                    TextInput::make('subtotal_bruto')
                        ->label('Subtotal Bruto')
                        ->numeric()
                        ->prefix('$')
                        ->default(0),

                    TextInput::make('total_iva')
                        ->label('Total IVA')
                        ->numeric()
                        ->prefix('$')
                        ->default(0),

                    TextInput::make('valor_retefuente')
                        ->label('Retención en la Fuente')
                        ->numeric()
                        ->prefix('$')
                        ->default(0),

                    TextInput::make('valor_reteica')
                        ->label('ReteICA')
                        ->numeric()
                        ->prefix('$')
                        ->default(0),

                    TextInput::make('total_neto_pagar')
                        ->label('Total Neto a Pagar')
                        ->numeric()
                        ->prefix('$')
                        ->default(0),
                ]),

            Section::make('Detalle de Productos')
                ->schema([
                    Repeater::make('detalles')
                        ->label('')
                        ->relationship('detalles')
                        ->schema([
                            Select::make('id_producto')
                                ->label('Producto')
                                ->options(fn () => Product::query()->pluck('name', 'id'))
                                ->searchable()
                                ->required(),

                            TextInput::make('cantidad')
                                ->label('Cantidad')
                                ->numeric()
                                ->required()
                                ->minValue(0.01),

                            TextInput::make('costo_unitario')
                                ->label('Costo Unitario (sin IVA)')
                                ->numeric()
                                ->prefix('$')
                                ->required(),

                            TextInput::make('porcentaje_iva')
                                ->label('% IVA')
                                ->numeric()
                                ->suffix('%')
                                ->default(0),
                        ])
                        ->columns(4)
                        ->addActionLabel('Agregar producto'),
                ]),
        ]);
    }
}
