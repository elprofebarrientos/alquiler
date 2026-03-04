<?php

namespace App\Filament\Resources\Impuestos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class ImpuestosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('porcentaje')
                    ->label('Porcentaje (%)')
                    ->numeric(decimalPlaces: 2)
                    ->sortable(),
                TextColumn::make('tipo_afectacion')
                    ->label('Tipo de Afectación')
                    ->badge()
                    ->colors([
                        'primary' => 'GRAVADO',
                        'warning' => 'EXENTO',
                        'info' => 'EXCLUIDO',
                    ])
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('codigo_dian')
                    ->label('Código DIAN')
                    ->searchable()
                    ->toggleable(),
                IconColumn::make('es_retencion')
                    ->label('Retención')
                    ->boolean()
                    ->toggleable(),
                IconColumn::make('es_trasladable')
                    ->label('Trasladable')
                    ->boolean()
                    ->toggleable(),
                IconColumn::make('es_compuesto')
                    ->label('Compuesto')
                    ->boolean()
                    ->toggleable(),
                TextColumn::make('orden_calculo')
                    ->label('Orden')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                IconColumn::make('estado')
                    ->label('Estado')
                    ->boolean()
                    ->sortable(),
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
