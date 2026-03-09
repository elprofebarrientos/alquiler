<?php

namespace App\Filament\Resources\Variantes\Schemas;

use App\Models\Color;
use App\Models\Product;
use App\Models\Talla;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class VarianteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('id_producto')
                    ->label('Producto')
                    ->options(Product::pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->live()
                    ->placeholder('Selecciona un producto'),

                Select::make('id_talla')
                    ->label('Talla')
                    ->options(Talla::pluck('name', 'id'))
                    ->nullable()
                    ->searchable()
                    ->placeholder('Sin talla')
                    ->visible(function (Get $get): bool {
                        $productoId = $get('id_producto');
                        if (!$productoId) {
                            return false;
                        }
                        return Product::where('id', $productoId)
                            ->value('maneja_talla') === true;
                    }),

                Select::make('id_color')
                    ->label('Color')
                    ->options(Color::pluck('name', 'id'))
                    ->nullable()
                    ->searchable()
                    ->placeholder('Sin color')
                    ->visible(function (Get $get): bool {
                        $productoId = $get('id_producto');
                        if (!$productoId) {
                            return false;
                        }
                        return Product::where('id', $productoId)
                            ->value('maneja_color') === true;
                    }),

                TextInput::make('sku')
                    ->label('SKU')
                    ->maxLength(50)
                    ->placeholder('Código único de variante'),

                TextInput::make('codigos_barras')
                    ->label('Código de Barras')
                    ->maxLength(50)
                    ->placeholder('Código de barras'),

                TextInput::make('precio_compra')
                    ->label('Precio de Compra')
                    ->numeric()
                    ->prefix('$')
                    ->placeholder('0.00')
                    ->live(debounce: 500)
                    ->afterStateUpdated(function (Get $get, Set $set, $state) {
                        $compra = (float) $state;
                        $ganancia = (float) $get('porcentaje_ganancia');
                        $set('precio_venta', round($compra * (1 + $ganancia / 100), 2));
                    }),

                TextInput::make('porcentaje_ganancia')
                    ->label('% Ganancia')
                    ->numeric()
                    ->suffix('%')
                    ->placeholder('0.00')
                    ->live(debounce: 500)
                    ->afterStateUpdated(function (Get $get, Set $set, $state) {
                        $compra = (float) $get('precio_compra');
                        $ganancia = (float) $state;
                        $set('precio_venta', round($compra * (1 + $ganancia / 100), 2));
                    }),

                TextInput::make('precio_venta')
                    ->label('Precio de Venta')
                    ->numeric()
                    ->required()
                    ->prefix('$')
                    ->placeholder('0.00'),

                FileUpload::make('imagenes')
                    ->label('Imágenes')
                    ->image()
                    ->multiple()
                    ->directory('variantes')
                    ->columnSpanFull(),

                Toggle::make('estado')
                    ->label('Estado Activo')
                    ->default(true),
            ]);
    }
}
