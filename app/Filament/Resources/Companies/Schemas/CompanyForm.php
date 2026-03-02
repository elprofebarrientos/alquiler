<?php

namespace App\Filament\Resources\Companies\Schemas;

use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nit')
                    ->label('NIT')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->regex('/^[0-9\-]+$/')
                    ->validationMessages([
                        'regex' => 'El NIT debe contener solo números y guiones.',
                    ]),
                TextInput::make('name')
                    ->label('Nombre de la Empresa')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Correo Electrónico')
                    ->email('Ingrese un correo válido')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('phone')
                    ->label('Teléfono')
                    ->tel()
                    ->required()
                    ->regex('/^[0-9\+\-\s\(\)]+$/')
                    ->validationMessages([
                        'regex' => 'El teléfono tiene un formato inválido.',
                    ]),
                Select::make('country_id')
                    ->label('País')
                    ->options(Country::pluck('name', 'id'))
                    ->searchable()
                    ->preload()
                    ->required()
                    ->live()
                    ->afterStateUpdated(function (Set $set) {
                        $set('department_id', null);
                        $set('city_id', null);
                    })
                    ->dehydrated(false),
                Select::make('department_id')
                    ->label('Departamento/Estado')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->live()
                    ->afterStateUpdated(function (Set $set) {
                        $set('city_id', null);
                    })
                    ->options(function (Get $get) {
                        $countryId = $get('country_id');
                        if (!$countryId) {
                            return [];
                        }
                        return Department::where('country_id', $countryId)
                            ->pluck('name', 'id');
                    })
                    ->dehydrated(false),
                Select::make('city_id')
                    ->label('Ciudad')
                    ->relationship('city', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->options(function (Get $get) {
                        $departmentId = $get('department_id');
                        if (!$departmentId) {
                            return City::pluck('name', 'id');
                        }
                        return City::where('department_id', $departmentId)
                            ->pluck('name', 'id');
                    }),
                TextInput::make('postal_code')
                    ->label('Código Postal')
                    ->required()
                    ->maxLength(255),
                TextInput::make('address')
                    ->label('Dirección')
                    ->required()
                    ->maxLength(255),
                TextInput::make('url')
                    ->label('Sitio Web')
                    ->url('Ingrese una URL válida')
                    ->nullable(),
                Select::make('type_company')
                    ->label('Tipo de Empresa')
                    ->options([
                        'Régimen común' => 'Régimen común',
                        'Régimen simplificado' => 'Régimen simplificado',
                    ])
                    ->required(),
            ]);
    }
}
