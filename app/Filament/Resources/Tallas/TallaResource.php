<?php

namespace App\Filament\Resources\Tallas;

use App\Filament\Resources\Tallas\Pages\ListTallas;
use App\Filament\Resources\Tallas\Schemas\TallaForm;
use App\Filament\Resources\Tallas\Tables\TallasTable;
use App\Models\Talla;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TallaResource extends Resource
{
    protected static ?string $model = Talla::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $pluralModelLabel = 'Tallas';

    protected static ?string $modelLabel = 'Talla';

    public static function form(Schema $schema): Schema
    {
        return TallaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TallasTable::configure($table);
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
            'index' => ListTallas::route('/'),
        ];
    }
}
