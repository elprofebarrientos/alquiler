<?php

namespace App\Filament\Resources\ProductoImpuestos;

use App\Filament\Resources\ProductoImpuestos\Pages\ListProductoImpuestos;
use App\Filament\Resources\ProductoImpuestos\Schemas\ProductoImpuestoForm;
use App\Filament\Resources\ProductoImpuestos\Tables\ProductoImpuestosTable;
use App\Models\ProductoImpuesto;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductoImpuestoResource extends Resource
{
    protected static ?string $model = ProductoImpuesto::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentCheck;

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $pluralModelLabel = 'Impuestos de Productos';

    protected static ?string $modelLabel = 'Impuesto de Producto';

    public static function form(Schema $schema): Schema
    {
        return ProductoImpuestoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductoImpuestosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProductoImpuestos::route('/'),
            'create' => \App\Filament\Resources\ProductoImpuestos\Pages\CreateProductoImpuesto::route('/create'),
        ];
    }
}
