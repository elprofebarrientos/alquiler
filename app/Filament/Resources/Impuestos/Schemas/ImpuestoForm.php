<?php

namespace App\Filament\Resources\Impuestos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class ImpuestoForm
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
                    ->placeholder('Ej: IVA, Renta, Consumo'),
                TextInput::make('codigo_dian')
                    ->label('Código DIAN')
                    ->maxLength(50)
                    ->placeholder('Ej: 01'),
                TextInput::make('porcentaje')
                    ->label('Porcentaje (%)')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(99.99)
                    ->step('0.01')
                    ->placeholder('Ej: 19.00'),
                Select::make('tipo_afectacion')
                    ->label('Tipo de Afectación')
                    ->options([
                        'GRAVADO' => 'Gravado',
                        'EXENTO' => 'Exento',
                        'EXCLUIDO' => 'Excluido',
                    ])
                    ->required()
                    ->default('GRAVADO')
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if (in_array($state, ['EXENTO', 'EXCLUIDO'])) {
                            $set('es_retencion', false);
                            $set('es_trasladable', false);
                            $set('es_compuesto', false);
                        }
                    }),
                TextInput::make('orden_calculo')
                    ->label('Orden de Cálculo')
                    ->numeric()
                    ->default(1)
                    ->minValue(1)
                    ->helperText('Define el orden en que se calcula este impuesto'),
                Toggle::make('es_retencion')
                    ->label('Es Retención')
                    ->default(false)
                    ->live()
                    ->disabled(fn (Get $get) => in_array($get('tipo_afectacion'), ['EXENTO', 'EXCLUIDO']))
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $set('es_trasladable', false);
                        }
                    })
                    ->helperText('Marcar si es un impuesto de retención'),
                Toggle::make('es_trasladable')
                    ->label('Es Trasladable')
                    ->default(true)
                    ->live()
                    ->disabled(fn (Get $get) => in_array($get('tipo_afectacion'), ['EXENTO', 'EXCLUIDO']))
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $set('es_retencion', false);
                        }
                    })
                    ->helperText('Marcar si se puede trasladar al cliente'),
                Toggle::make('es_compuesto')
                    ->label('Es Compuesto')
                    ->default(false)
                    ->disabled(fn (Get $get) => in_array($get('tipo_afectacion'), ['EXENTO', 'EXCLUIDO']))
                    ->helperText('Marcar si el impuesto se calcula sobre otro impuesto'),
                Toggle::make('estado')
                    ->label('Estado Activo')
                    ->default(true)
                    ->helperText('Desactivar para deshabilitar este impuesto'),
            ]);
    }
}
