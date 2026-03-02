<?php

namespace App\Filament\Resources\Brands\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BrandForm
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
                    ->placeholder('Ej: Samsung'),
                Textarea::make('description')
                    ->label('Descripción')
                    ->maxLength(1000)
                    ->columnSpanFull()
                    ->placeholder('Descripción de la marca'),
            ]);
    }
}
