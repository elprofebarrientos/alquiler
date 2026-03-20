<?php

namespace App\Filament\Resources\Compras\RelationManagers;

use App\Models\Compra;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
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
                    ->helperText(fn () => $this->getHelperText($compra))
                    ->rules([
                        fn (): \Closure => function (string $attribute, $value, \Closure $fail) use ($compra) {
                            if (!$compra || !$compra->exists) {
                                return;
                            }
                            
                            $saldoPendiente = $this->getSaldoPendiente($compra);
                            if ((float) $value > $saldoPendiente) {
                                $fail("El monto no puede exceder el saldo pendiente de $" . number_format($saldoPendiente, 2));
                            }
                        },
                    ]),
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
                FileUpload::make('documento')
                    ->label('Documento (PDF o Fotografía)')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'application/pdf'])
                    ->directory('abonos-documentos')
                    ->nullable()
                    ->columnSpanFull(),
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
                    ->label('Nota')
                    ->limit(50),
                Tables\Columns\TextColumn::make('documento')
                    ->label('Documento')
                    ->url(fn ($record) => $record->documento ? asset('storage/' . $record->documento) : null)
                    ->openUrlInNewTab()
                    ->badge()
                    ->color('info')
                    ->visible(fn ($record) => !empty($record->documento)),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->headerActions([
                CreateAction::make()
                    ->visible(fn () => $this->canCreateAbono()),
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

        $saldoPendiente = $this->getSaldoPendiente($compra);

        return "Saldo pendiente: $" . number_format(max(0, $saldoPendiente), 2);
    }

    /**
     * Calculate remaining balance for the purchase
     */
    protected function getSaldoPendiente(Compra $compra): float
    {
        $totalAbonos = $compra->abonos()->sum('monto');
        return max(0, (float) $compra->total_neto_pagar - $totalAbonos);
    }

    /**
     * Check if a new abono can be created
     */
    protected function canCreateAbono(): bool
    {
        $compra = $this->getOwnerRecord();
        if (!$compra || !$compra->exists) {
            return false;
        }
        
        return $this->getSaldoPendiente($compra) > 0;
    }
}
