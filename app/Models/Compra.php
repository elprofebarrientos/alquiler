<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Compra extends Model
{
    protected $table = 'compras';
    protected $primaryKey = 'id_compra';

    protected $fillable = [
        'id_proveedor',
        'numero_factura',
        'cufe',
        'fecha_emision',
        'fecha_vencimiento',
        'subtotal_bruto',
        'total_iva',
        'valor_retefuente',
        'valor_reteica',
        'total_neto_pagar',
        'estado',
        'fecha_pago',
        'metodo_pago',
        'monto_pagado',
        'monto_restante',
        'comprobante_pago',
    ];

    protected $casts = [
        'fecha_emision'    => 'date',
        'fecha_vencimiento' => 'date',
        'fecha_pago'       => 'datetime',
        'subtotal_bruto'   => 'decimal:2',
        'total_iva'        => 'decimal:2',
        'valor_retefuente' => 'decimal:2',
        'valor_reteica'    => 'decimal:2',
        'total_neto_pagar' => 'decimal:2',
        'monto_pagado'     => 'decimal:2',
        'monto_restante'   => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function (Compra $compra) {
            // Calculate total paid from abonos
            $totalAbonos = $compra->abonos()->sum('monto');
            $compra->monto_pagado = $totalAbonos;
            $compra->monto_restante = max(0, (float) $compra->total_neto_pagar - $totalAbonos);

            // Auto-update status based on payment
            if ($compra->monto_restante <= 0 && $compra->total_neto_pagar > 0) {
                $compra->estado = 'pagada_total';
            } elseif ($compra->monto_pagado > 0 && $compra->monto_restante > 0) {
                $compra->estado = 'pagada_parcial';
            }
        });
    }

    /**
     * Remaining balance when partially paid in cash
     */
    public function getMontoPendienteAttribute(): float
    {
        return max(0, (float) $this->total_neto_pagar - (float) ($this->monto_pagado ?? 0));
    }

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(CompraDetalle::class, 'id_compra');
    }

    public function abonos(): HasMany
    {
        return $this->hasMany(Abono::class, 'id_compra', 'id_compra');
    }
}
