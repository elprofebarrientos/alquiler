<?php

namespace App\Filament\Resources\Colores\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ColorPicker;
use Filament\Schemas\Schema;

class ColorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->minLength(2)
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->placeholder('Ej: Rojo, Azul, Verde'),
                ColorPicker::make('codigo_hex')
                    ->label('Color')
                    ->required()
                    ->format('hex'),
            ]);
    }
}
