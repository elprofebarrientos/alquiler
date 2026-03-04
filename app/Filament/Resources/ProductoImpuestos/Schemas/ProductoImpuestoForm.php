<?php

namespace App\Filament\Resources\ProductoImpuestos\Schemas;

use App\Models\Impuesto;
use App\Models\Product;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;

class ProductoImpuestoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('product_id')
                    ->label('Producto')
                    ->options(Product::pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->preload()
                    ->placeholder('Selecciona un producto')
                    ->disabled(fn (?Model $record) => $record !== null)
                    ->columnSpanFull(),
                Repeater::make('impuestos')
                    ->label('Impuestos a Aplicar')
                    ->schema([
                        Select::make('impuesto_id')
                            ->label('Impuesto')
                            ->options(Impuesto::pluck('name', 'id'))
                            ->required()
                            ->searchable()
                            ->preload()
                            ->placeholder('Selecciona un impuesto')
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $impuesto = Impuesto::find($state);
                                    if ($impuesto) {
                                        $set('porcentaje', (float) $impuesto->porcentaje);
                                    }
                                }
                            }),
                        TextInput::make('porcentaje')
                            ->label('Porcentaje (%)')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(99.99)
                            ->disabled()
                            ->dehydrated()
                            ->helperText('Se carga automáticamente del impuesto'),
                        DatePicker::make('fecha_inicio')
                            ->label('Fecha de Inicio')
                            ->required()
                            ->format('Y-m-d'),
                        DatePicker::make('fecha_fin')
                            ->label('Fecha de Fin')
                            ->format('Y-m-d')
                            ->nullable()
                            ->helperText('Dejar vacío si no tiene fecha de fin'),
                    ])
                    ->columns(4)
                    ->addActionLabel('Agregar Impuesto')
                    ->columnSpanFull()
                    ->minItems(1)
                    ->reorderable()
                    ->deletable(),
            ]);
    }
}
