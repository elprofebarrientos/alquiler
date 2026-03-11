<?php

namespace App\Filament\Resources\Proveedores\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ProveedoresTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_proveedor')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('tipo_documento')
                    ->label('Tipo Doc.')
                    ->badge()
                    ->sortable(),

                TextColumn::make('numero_documento')
                    ->label('Número Doc.')
                    ->searchable(),

                TextColumn::make('razon_social')
                    ->label('Razón Social')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nombre_comercial')
                    ->label('Nombre Comercial')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('responsabilidad_fiscal')
                    ->label('Régimen Fiscal')
                    ->toggleable(),

                IconColumn::make('es_iva_responsable')
                    ->label('IVA')
                    ->boolean(),

                IconColumn::make('es_autoretenedor')
                    ->label('Autorretenedor')
                    ->boolean()
                    ->toggleable(),

                TextColumn::make('correo_facturacion')
                    ->label('Correo')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('telefono')
                    ->label('Teléfono')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('direccion')
                    ->label('Dirección')
                    ->limit(40)
                    ->toggleable(),

                TextColumn::make('pais.name')
                    ->label('País')
                    ->toggleable(),

                TextColumn::make('departamento.name')
                    ->label('Departamento')
                    ->toggleable(),

                TextColumn::make('municipio.name')
                    ->label('Municipio')
                    ->toggleable(),

                TextColumn::make('plazo_pago_dias')
                    ->label('Plazo (días)')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('cupo_credito')
                    ->label('Cupo Crédito')
                    ->money('COP')
                    ->sortable()
                    ->toggleable(),

                IconColumn::make('estado')
                    ->label('Activo')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('tipo_documento')
                    ->label('Tipo de Documento')
                    ->options([
                        'CC' => 'CC',
                        'NIT' => 'NIT',
                        'CE' => 'CE',
                        'PAP' => 'PAP',
                    ]),
                TernaryFilter::make('estado')
                    ->label('Estado')
                    ->trueLabel('Activos')
                    ->falseLabel('Inactivos'),
                TernaryFilter::make('es_iva_responsable')
                    ->label('Responsable IVA'),
            ])
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
