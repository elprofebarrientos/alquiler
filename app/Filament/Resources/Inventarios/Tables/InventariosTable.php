<?php

namespace App\Filament\Resources\Inventarios\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InventariosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_inventario')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('variante.producto.name')
                    ->label('Producto')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('variante.sku')
                    ->label('SKU Variante')
                    ->searchable(),
                TextColumn::make('stock_total')
                    ->label('Stock Total')
                    ->sortable(),
                TextColumn::make('stock_mantenimiento')
                    ->label('En Mantenimiento')
                    ->sortable(),
                TextColumn::make('stock_danado')
                    ->label('Dañado')
                    ->sortable(),
            ])
            ->defaultSort('id_inventario', 'desc');
    }
}
