<?php

namespace App\Filament\Resources\Variantes;

use App\Filament\Resources\Variantes\Pages\CreateVariante;
use App\Filament\Resources\Variantes\Pages\EditVariante;
use App\Filament\Resources\Variantes\Pages\ListVariantes;
use App\Filament\Resources\Variantes\Schemas\VarianteForm;
use App\Filament\Resources\Variantes\Tables\VariantesTable;
use App\Models\Variante;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class VarianteResource extends Resource
{
    protected static ?string $model = Variante::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static ?string $recordTitleAttribute = 'sku';

    protected static ?string $pluralModelLabel = 'Variantes';

    protected static ?string $modelLabel = 'Variante';

    protected static UnitEnum|string|null $navigationGroup = 'Catálogo';

    public static function form(Schema $schema): Schema
    {
        return VarianteForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VariantesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVariantes::route('/'),
            'create' => CreateVariante::route('/create'),
            'edit' => EditVariante::route('/{record}/edit'),
        ];
    }
}
