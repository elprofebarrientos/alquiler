<?php

namespace App\Filament\Resources\Subcategories\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SubcategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Nombre'),
                TextEntry::make('slug')
                    ->label('Slug'),
                TextEntry::make('description')
                    ->label('Descripcion')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('icon')
                    ->label('Icono')
                    ->placeholder('-'),
                TextEntry::make('category.name')
                    ->label('Categoria'),
                TextEntry::make('parent.name')
                    ->label('Subcategoria Padre')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
