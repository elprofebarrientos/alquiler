<?php

namespace App\Filament\Resources\Tallas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TallaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->minLength(1)
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->placeholder('Ej: S, M, L, XL'),
            ]);
    }
}
