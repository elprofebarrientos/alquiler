<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Unit;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre del Producto')
                    ->required()
                    ->minLength(2)
                    ->maxLength(255)
                    ->placeholder('Ej: Camiseta de algodón')
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if (!empty($state)) {
                            $set('slug', Str::slug($state));
                        }
                    }),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->disabled()
                    ->dehydrated(),
                Textarea::make('descripcion')
                    ->label('Descripción')
                    ->required()
                    ->minLength(10)
                    ->maxLength(2000)
                    ->placeholder('Descripción detallada del producto')
                    ->rows(4)
                    ->columnSpanFull(),
                Select::make('category_id')
                    ->label('Categoría')
                    ->options(Category::pluck('name', 'id'))
                    ->placeholder('Selecciona una categoría')
                    ->searchable(),
                Select::make('subcategory_id')
                    ->label('Subcategoría')
                    ->options(Subcategory::pluck('name', 'id'))
                    ->placeholder('Selecciona una subcategoría')
                    ->searchable(),
                Select::make('brand_id')
                    ->label('Marca')
                    ->options(Brand::pluck('name', 'id'))
                    ->placeholder('Selecciona una marca')
                    ->searchable(),
                Select::make('unit_id')
                    ->label('Unidad de Medida')
                    ->options(Unit::pluck('name', 'id'))
                    ->placeholder('Selecciona una unidad')
                    ->searchable(),
                Toggle::make('maneja_talla')
                    ->label('¿Maneja Tallas?')
                    ->default(false)
                    ->helperText('Marcar si el producto tiene diferentes tallas'),
                Toggle::make('maneja_color')
                    ->label('¿Maneja Colores?')
                    ->default(false)
                    ->helperText('Marcar si el producto tiene diferentes colores'),
                Toggle::make('estado')
                    ->label('Estado Activo')
                    ->default(true)
                    ->helperText('Desactiva el producto si no está disponible'),
            ]);
    }
}
