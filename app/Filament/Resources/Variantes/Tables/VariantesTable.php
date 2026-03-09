<?php

namespace App\Filament\Resources\Variantes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VariantesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('producto.name')
                    ->label('Producto')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('talla.name')
                    ->label('Talla')
                    ->default('N/A')
                    ->sortable(),
                TextColumn::make('color.name')
                    ->label('Color')
                    ->default('N/A')
                    ->sortable(),
                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('codigos_barras')
                    ->label('Cód. Barras')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('precio_compra')
                    ->label('P. Compra')
                    ->money('COP')
                    ->sortable(),
                TextColumn::make('porcentaje_ganancia')
                    ->label('% Ganancia')
                    ->suffix('%')
                    ->sortable(),
                TextColumn::make('precio_venta')
                    ->label('P. Venta')
                    ->money('COP')
                    ->sortable(),
                IconColumn::make('estado')
                    ->label('Estado')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
