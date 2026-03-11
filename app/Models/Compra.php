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
    ];

    protected $casts = [
        'fecha_emision' => 'date',
        'fecha_vencimiento' => 'date',
        'subtotal_bruto' => 'decimal:2',
        'total_iva' => 'decimal:2',
        'valor_retefuente' => 'decimal:2',
        'valor_reteica' => 'decimal:2',
        'total_neto_pagar' => 'decimal:2',
    ];

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(CompraDetalle::class, 'id_compra');
    }
}
