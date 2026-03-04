<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductoImpuesto extends Model
{
    protected $table = 'product_impuestos';

    protected $fillable = [
        'product_id',
        'impuesto_id',
        'porcentaje',
        'fecha_inicio',
        'fecha_fin',
    ];

    protected $casts = [
        'porcentaje' => 'decimal:2',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    /**
     * Get the product that owns this relationship.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the impuesto that owns this relationship.
     */
    public function impuesto(): BelongsTo
    {
        return $this->belongsTo(Impuesto::class);
    }
}
