<?php

namespace App\Filament\Resources\Subcategories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class SubcategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->minLength(3)
                    ->maxLength(255)
                    ->placeholder('Ej: Smartphones')
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->minLength(3)
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->placeholder('ej: smartphones')
                    ->helperText('Se genera automáticamente del nombre'),
                Textarea::make('description')
                    ->label('Descripcion')
                    ->maxLength(1000)
                    ->columnSpanFull()
                    ->placeholder('Descripcion opcional de la subcategoria'),
                Select::make('category_id')
                    ->label('Categoria Principal')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('parent_id')
                    ->label('Subcategoria Padre (Opcional)')
                    ->relationship('parent', 'name')
                    ->searchable()
                    ->preload()
                    ->placeholder('Sin subcategoria padre'),
                Select::make('icon')
                    ->label('Icono')
                    ->options(self::getIconOptions())
                    ->placeholder('Selecciona un icono')
                    ->searchable(),
            ]);
    }

    private static function getIconOptions(): array
    {
        return [
            'bx bx-home' => '🏠 Hogar',
            'bx bx-store' => '🏪 Tienda',
            'bx bx-car' => '🚗 Carro',
            'bx bx-mobile-alt' => '📱 Movil',
            'bx bx-desktop' => '💻 Computadora',
            'bx bx-basketball' => '🏀 Deportes',
            'bx bx-wrench' => '🔧 Herramientas',
            'bx bx-building' => '🏢 Edificio',
            'bx bx-bxs-hot' => '🌞 Caliente',
            'bx bx-bxs-package' => '📦 Paquete',
            'bx bx-camera' => '📷 Camara',
            'bx bx-headphone' => '🎧 Auriculares',
            'bx bx-book' => '📚 Libro',
            'bx bx-paint' => '🎨 Arte',
            'bx bx-dumbbell' => '💪 Fitness',
            'bx bx-tennis' => '🎾 Tenis',
            'bx bx-coffee' => '☕ Cafe',
            'bx bx-restaurant' => '🍽️ Restaurante',
            'bx bx-plane' => '✈️ Viaje',
            'bx bx-map' => '🗺️ Mapa',
        ];
    }
}
