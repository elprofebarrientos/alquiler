<?php

namespace App\Filament\Resources\ProductoImpuestos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductoImpuestosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product.name')
                    ->label('Producto')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('impuesto.name')
                    ->label('Impuesto')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('porcentaje')
                    ->label('Porcentaje (%)')
                    ->numeric(decimalPlaces: 2)
                    ->sortable(),
                TextColumn::make('fecha_inicio')
                    ->label('Fecha Inicio')
                    ->date()
                    ->sortable(),
                TextColumn::make('fecha_fin')
                    ->label('Fecha Fin')
                    ->date()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Actualizado')
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
