<?php

namespace App\Filament\Resources\Compras\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ComprasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_compra')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('proveedor.razon_social')
                    ->label('Proveedor')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('numero_factura')
                    ->label('N° Factura')
                    ->searchable(),

                TextColumn::make('fecha_emision')
                    ->label('Fecha Emisión')
                    ->date()
                    ->sortable(),

                TextColumn::make('fecha_vencimiento')
                    ->label('Vencimiento')
                    ->date()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('subtotal_bruto')
                    ->label('Subtotal')
                    ->money('COP')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('total_iva')
                    ->label('IVA')
                    ->money('COP')
                    ->toggleable(),

                TextColumn::make('valor_retefuente')
                    ->label('Retefuente')
                    ->money('COP')
                    ->toggleable(),

                TextColumn::make('valor_reteica')
                    ->label('ReteICA')
                    ->money('COP')
                    ->toggleable(),

                TextColumn::make('total_neto_pagar')
                    ->label('Total Neto')
                    ->money('COP')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
