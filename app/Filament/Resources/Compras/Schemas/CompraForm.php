<?php

namespace App\Filament\Resources\Compras\Schemas;

use App\Models\Product;
use App\Models\Proveedor;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class CompraForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Datos de la Compra')
                ->columnSpanFull()
                ->columns(5)
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

            Section::make('Detalle de Productos')
                ->columnSpanFull()
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
                                ->minValue(0.01)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($set, $get) => static::recalcularTotales($set, $get)),

                            TextInput::make('costo_unitario')
                                ->label('Costo Unitario (sin IVA)')
                                ->numeric()
                                ->prefix('$')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($set, $get) => static::recalcularTotales($set, $get)),

                            TextInput::make('porcentaje_iva')
                                ->label('% IVA')
                                ->numeric()
                                ->suffix('%')
                                ->default(0)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($set, $get) => static::recalcularTotales($set, $get)),
                        ])
                        ->columns(4)
                        ->addActionLabel('Agregar producto')
                        ->live()
                        ->afterStateUpdated(fn ($set, $get) => static::recalcularTotalesFromRoot($set, $get)),
                ]),

            Section::make('Totales')
                ->columnSpanFull()
                ->columns(5)
                ->schema([
                    TextInput::make('subtotal_bruto')
                        ->label('Subtotal Bruto')
                        ->numeric()
                        ->prefix('$')
                        ->default(0)
                        ->disabled()
                        ->dehydrated(),

                    TextInput::make('total_iva')
                        ->label('Total IVA')
                        ->numeric()
                        ->prefix('$')
                        ->default(0)
                        ->disabled()
                        ->dehydrated(),

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
                        ->default(0)
                        ->disabled()
                        ->dehydrated(),
                ]),

            Section::make('Estado y Pago')
                ->columnSpanFull()
                ->columns(3)
                ->schema([
                    Select::make('estado')
                        ->label('Estado de la Compra')
                        ->options([
                            'pendiente'       => 'Pendiente',
                            'pagada_parcial'  => 'Pagada Parcial',
                            'pagada_total'    => 'Pagada Total',
                            'vencida'         => 'Vencida',
                            'anulada'         => 'Anulada',
                        ])
                        ->default('pendiente')
                        ->required()
                        ->live(),

                    DateTimePicker::make('fecha_pago')
                        ->label('Fecha de Pago')
                        ->nullable()
                        ->visible(fn (Get $get) => in_array($get('estado'), ['pagada_parcial', 'pagada_total'])),

                    Select::make('metodo_pago')
                        ->label('Método de Pago')
                        ->options([
                            'efectivo'      => 'Efectivo',
                            'transferencia' => 'Transferencia',
                        ])
                        ->nullable()
                        ->live()
                        ->visible(fn (Get $get) => in_array($get('estado'), ['pagada_parcial', 'pagada_total'])),

                    TextInput::make('monto_pagado')
                        ->label('Monto Pagado')
                        ->numeric()
                        ->prefix('$')
                        ->nullable()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($set, $get) => static::calcularMontoRestante($set, $get))
                        ->visible(fn (Get $get) => in_array($get('estado'), ['pagada_parcial', 'pagada_total']) && $get('metodo_pago') === 'efectivo'),

                    TextInput::make('monto_restante')
                        ->label('Monto Restante')
                        ->numeric()
                        ->prefix('$')
                        ->disabled()
                        ->dehydrated()
                        ->visible(fn (Get $get) => $get('estado') === 'pagada_parcial' && $get('metodo_pago') === 'efectivo'),

                    FileUpload::make('comprobante_pago')
                        ->label('Comprobante de Pago')
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'application/pdf'])
                        ->directory('comprobantes-pago')
                        ->nullable()
                        ->columnSpanFull()
                        ->visible(fn (Get $get) => in_array($get('estado'), ['pagada_parcial', 'pagada_total'])),
                ]),
        ]);
    }

    /**
     * Called from inside a repeater row field (two levels up: row → repeater → form root).
     */
    private static function recalcularTotales(Set $set, Get $get): void
    {
        $detalles = $get('../../detalles') ?? [];

        static::calcular($set, $get, $detalles, '../../');
    }

    /**
     * Called from the repeater itself (one level up: repeater → form root).
     */
    private static function recalcularTotalesFromRoot(Set $set, Get $get): void
    {
        $detalles = $get('detalles') ?? [];

        static::calcular($set, $get, $detalles, '');
    }

    private static function calcular(Set $set, Get $get, array $detalles, string $prefix): void
    {
        $subtotal = collect($detalles)->sum(
            fn ($d) => floatval($d['cantidad'] ?? 0) * floatval($d['costo_unitario'] ?? 0)
        );

        $iva = collect($detalles)->sum(
            fn ($d) => floatval($d['cantidad'] ?? 0) * floatval($d['costo_unitario'] ?? 0) * (floatval($d['porcentaje_iva'] ?? 0) / 100)
        );

        $retefuente = floatval($get($prefix . 'valor_retefuente') ?? 0);
        $reteica    = floatval($get($prefix . 'valor_reteica') ?? 0);

        $set($prefix . 'subtotal_bruto', round($subtotal, 2));
        $set($prefix . 'total_iva', round($iva, 2));
        $set($prefix . 'total_neto_pagar', round($subtotal + $iva - $retefuente - $reteica, 2));
    }

    private static function calcularMontoRestante(Set $set, Get $get): void
    {
        $total = floatval($get('../../total_neto_pagar') ?? 0);
        $pagado = floatval($get('../../monto_pagado') ?? 0);
        $restante = max(0, $total - $pagado);
        $set('../../monto_restante', round($restante, 2));
    }
}
