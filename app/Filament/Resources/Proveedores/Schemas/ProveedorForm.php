<?php

namespace App\Filament\Resources\Proveedores\Schemas;

use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProveedorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            // --- Identificación ---
            Select::make('tipo_documento')
                ->label('Tipo de Documento')
                ->options([
                    'CC' => 'Cédula de Ciudadanía (CC)',
                    'NIT' => 'NIT',
                    'CE' => 'Cédula de Extranjería (CE)',
                    'PAP' => 'Pasaporte (PAP)',
                ])
                ->required()
                ->live(),

            TextInput::make('numero_documento')
                ->label('Número de Documento')
                ->required()
                ->maxLength(20),

            TextInput::make('digito_verificacion')
                ->label('Dígito de Verificación')
                ->numeric()
                ->minValue(0)
                ->maxValue(9)
                ->visible(fn ($get) => $get('tipo_documento') === 'NIT'),

            TextInput::make('razon_social')
                ->label('Razón Social')
                ->required()
                ->maxLength(255),

            TextInput::make('nombre_comercial')
                ->label('Nombre Comercial')
                ->maxLength(255),

            // --- Fiscal ---
            Select::make('responsabilidad_fiscal')
                ->label('Responsabilidad Fiscal')
                ->options([
                    'Régimen Ordinario' => 'Régimen Ordinario',
                    'Régimen Simple' => 'Régimen Simple',
                    'Gran Contribuyente' => 'Gran Contribuyente',
                    'No Responsable de IVA' => 'No Responsable de IVA',
                ])
                ->searchable(),

            Toggle::make('es_iva_responsable')
                ->label('¿Es responsable de IVA?')
                ->default(false),

            Toggle::make('es_autoretenedor')
                ->label('¿Es autorretenedor?')
                ->default(false),

            // --- Contacto ---
            TextInput::make('correo_facturacion')
                ->label('Correo de Facturación')
                ->email()
                ->maxLength(150),

            TextInput::make('telefono')
                ->label('Teléfono')
                ->tel()
                ->maxLength(50),

            // --- Ubicación ---
            Select::make('id_pais')
                ->label('País')
                ->options(fn () => Country::query()->pluck('name', 'id'))
                ->searchable()
                ->preload()
                ->live()
                ->afterStateUpdated(function ($set) {
                    $set('id_departamento', null);
                    $set('id_municipio', null);
                }),

            Select::make('id_departamento')
                ->label('Departamento')
                ->options(fn ($get) => Department::query()
                    ->when($get('id_pais'), fn ($q, $v) => $q->where('country_id', $v))
                    ->pluck('name', 'id'))
                ->searchable()
                ->live()
                ->afterStateUpdated(fn ($set) => $set('id_municipio', null)),

            Select::make('id_municipio')
                ->label('Municipio / Ciudad')
                ->options(fn ($get) => City::query()
                    ->when($get('id_departamento'), fn ($q, $v) => $q->where('department_id', $v))
                    ->pluck('name', 'id'))
                ->searchable(),

            TextInput::make('direccion')
                ->label('Dirección Física')
                ->maxLength(255),

            TextInput::make('codigo_postal')
                ->label('Código Postal')
                ->maxLength(10),

            // --- Financiero ---
            TextInput::make('plazo_pago_dias')
                ->label('Plazo de Pago (días)')
                ->numeric()
                ->default(0)
                ->minValue(0),

            TextInput::make('cupo_credito')
                ->label('Cupo de Crédito')
                ->numeric()
                ->default(0)
                ->prefix('$'),

            Toggle::make('estado')
                ->label('Activo')
                ->default(true),
        ]);
    }
}
