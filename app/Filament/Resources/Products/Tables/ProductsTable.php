<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('category.name')
                    ->label('Categoría')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('subcategory.name')
                    ->label('Subcategoría')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('brand.name')
                    ->label('Marca')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('unit.name')
                    ->label('Unidad')
                    ->sortable()
                    ->toggleable(),
                IconColumn::make('maneja_talla')
                    ->label('Talla')
                    ->boolean()
                    ->toggleable(),
                IconColumn::make('maneja_color')
                    ->label('Color')
                    ->boolean()
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
