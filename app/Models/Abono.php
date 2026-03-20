<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Abono extends Model
{
    protected $table = 'abonos';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id_compra',
        'monto',
        'monto_restante',
        'metodo_pago',
        'nota',
        'documento',
    ];

    protected $casts = [
        'monto' => 'decimal:2',
        'monto_restante' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        // After creating an abono, update the parent compra state
        static::created(function (Abono $abono) {
            $abono->actualizarEstadoCompra();
        });

        // After updating an abono, update the parent compra state
        static::updated(function (Abono $abono) {
            $abono->actualizarEstadoCompra();
        });

        // After deleting an abono, update the parent compra state
        static::deleted(function (Abono $abono) {
            $abono->actualizarEstadoCompra();
        });
    }

    public function compra(): BelongsTo
    {
        return $this->belongsTo(Compra::class, 'id_compra', 'id_compra');
    }

    /**
     * Update the parent compra state based on all abonos
     */
    public function actualizarEstadoCompra(): void
    {
        $compra = $this->compra;
        
        if (!$compra || !$compra->exists) {
            return;
        }

        $totalAbonos = $compra->abonos()->sum('monto');
        $totalNeto = (float) $compra->total_neto_pagar;

        // Determine new state
        if ($totalAbonos <= 0) {
            $compra->estado = 'pendiente';
        } elseif ($totalAbonos >= $totalNeto) {
            $compra->estado = 'pagada_total';
        } else {
            $compra->estado = 'pagada_parcial';
        }

        // Update monto_pagado and monto_restante
        $compra->monto_pagado = $totalAbonos;
        $compra->monto_restante = max(0, $totalNeto - $totalAbonos);

        // If fully paid, set payment date
        if ($compra->estado === 'pagada_total' && !$compra->fecha_pago) {
            $compra->fecha_pago = now();
        }

        $compra->save();
    }
}
