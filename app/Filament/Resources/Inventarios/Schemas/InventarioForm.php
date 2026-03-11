<?php

namespace App\Filament\Resources\Inventarios\Schemas;

use App\Models\Variante;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InventarioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('id_variante')
                    ->label('Variante')
                    ->options(
                        Variante::with('producto')->get()->mapWithKeys(fn ($v) => [
                            $v->id => ($v->producto?->name ?? 'Sin producto') . ' - ' . $v->sku
                        ])
                    )
                    ->searchable()
                    ->required(),
                TextInput::make('stock_total')
                    ->label('Stock Total')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->required(),
                TextInput::make('stock_mantenimiento')
                    ->label('Stock en Mantenimiento')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->required(),
                TextInput::make('stock_danado')
                    ->label('Stock Dañado')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->required(),
            ]);
    }
}
