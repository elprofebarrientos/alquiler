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

    /** Remaining balance when partially paid in cash */
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
}
