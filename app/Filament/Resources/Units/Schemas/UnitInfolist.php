<?php

namespace App\Filament\Resources\Units\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UnitInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Nombre'),
                TextEntry::make('code')
                    ->label('Código'),
                TextEntry::make('symbol')
                    ->label('Símbolo')
                    ->placeholder('-'),
                TextEntry::make('description')
                    ->label('Descripción')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('type')
                    ->label('Tipo')
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'standard' => 'Estándar',
                        'weight' => 'Peso',
                        'volume' => 'Volumen',
                        'length' => 'Longitud',
                        'area' => 'Área',
                        'time' => 'Tiempo',
                        default => $state,
                    }),
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
