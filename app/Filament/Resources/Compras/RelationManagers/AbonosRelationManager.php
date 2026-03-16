<?php

namespace App\Filament\Resources\Compras\RelationManagers;

use App\Models\Abono;
use App\Models\Compra;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class AbonosRelationManager extends RelationManager
{
    protected static string $relationship = 'abonos';

    public function form(Schema $form): Schema
    {
        $compra = $this->getOwnerRecord();
        
        return $form
            ->schema([
                TextInput::make('monto')
                    ->label('Monto')
                    ->numeric()
                    ->prefix('$')
                    ->required()
                    ->helperText(fn () => $this->getHelperText($compra)),
                Select::make('metodo_pago')
                    ->label('Método de Pago')
                    ->options([
                        'efectivo' => 'Efectivo',
                        'transferencia' => 'Transferencia',
                    ])
                    ->required(),
                TextInput::make('nota')
                    ->label('Nota')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('monto')
                    ->label('Monto')
                    ->money('COP'),
                Tables\Columns\TextColumn::make('metodo_pago')
                    ->label('Método de Pago'),
                Tables\Columns\TextColumn::make('nota')
                    ->label('Nota'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->paginated(false);
    }

    /**
     * Get helper text showing remaining balance
     */
    protected function getHelperText(?Compra $compra): string
    {
        if (!$compra || !$compra->exists) {
            return '';
        }

        $totalAbonos = $compra->abonos()->sum('monto');
        $saldoPendiente = (float) $compra->total_neto_pagar - $totalAbonos;

        return "Saldo pendiente: $" . number_format(max(0, $saldoPendiente), 2);
    }
}
