<?php

namespace App\Filament\Resources\Compras\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
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

                TextColumn::make('estado')
                    ->label('Estado')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pendiente'      => 'Pendiente',
                        'pagada_parcial' => 'Pagada Parcial',
                        'pagada_total'   => 'Pagada Total',
                        'vencida'        => 'Vencida',
                        'anulada'        => 'Anulada',
                        default          => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pendiente'      => 'warning',
                        'pagada_parcial' => 'info',
                        'pagada_total'   => 'success',
                        'vencida'        => 'danger',
                        'anulada'        => 'gray',
                        default          => 'secondary',
                    })
                    ->sortable(),

                TextColumn::make('monto_restante')
                    ->label('Restante')
                    ->money('COP')
                    ->toggleable()
                    ->visible(fn ($record) => $record && in_array($record->estado, ['pagada_parcial'])),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
