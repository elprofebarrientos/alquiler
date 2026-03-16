<?php

namespace App\Filament\Resources\Compras;

use App\Filament\Resources\Compras\Pages\CreateCompra;
use App\Filament\Resources\Compras\Pages\EditCompra;
use App\Filament\Resources\Compras\Pages\ListCompras;
use App\Filament\Resources\Compras\Pages\ViewCompra;
use App\Filament\Resources\Compras\Schemas\CompraForm;
use App\Filament\Resources\Compras\RelationManagers\AbonosRelationManager;
use App\Filament\Resources\Compras\Tables\ComprasTable;
use App\Models\Compra;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CompraResource extends Resource
{
    protected static ?string $model = Compra::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingCart;

    protected static ?string $pluralModelLabel = 'Compras';

    protected static ?string $modelLabel = 'Compra';

    protected static \UnitEnum|string|null $navigationGroup = 'Compras';

    public static function form(Schema $schema): Schema
    {
        return CompraForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ComprasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            AbonosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCompras::route('/'),
            'create' => CreateCompra::route('/create'),
            'view' => ViewCompra::route('/{record}'),
            'edit' => EditCompra::route('/{record}/edit'),
        ];
    }
}
