<?php

namespace App\Filament\Resources\Units\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class UnitForm
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
                    ->placeholder('Ej: Kilogramo')
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if (empty($set('code'))) {
                            $set('code', Str::upper(Str::substr($state, 0, 3)));
                        }
                    }),
                TextInput::make('code')
                    ->label('Código')
                    ->required()
                    ->minLength(1)
                    ->maxLength(10)
                    ->unique(ignoreRecord: true)
                    ->placeholder('Ej: KG')
                    ->helperText('Código único para la unidad'),
                TextInput::make('symbol')
                    ->label('Símbolo')
                    ->maxLength(5)
                    ->placeholder('Ej: kg'),
                Textarea::make('description')
                    ->label('Descripción')
                    ->maxLength(1000)
                    ->columnSpanFull()
                    ->placeholder('Descripción opcional de la unidad de medida'),
                Select::make('type')
                    ->label('Tipo de Unidad')
                    ->options([
                        'standard' => 'Estándar',
                        'weight' => 'Peso',
                        'volume' => 'Volumen',
                        'length' => 'Longitud',
                        'area' => 'Área',
                        'time' => 'Tiempo',
                    ])
                    ->default('standard')
                    ->required(),
            ]);
    }
}
