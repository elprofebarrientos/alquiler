<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Variante extends Model
{
    protected $table = 'variantes';

    protected $fillable = [
        'precio_compra',
        'porcentaje_ganancia',
        'precio_venta',
        'imagenes',
        'sku',
        'codigos_barras',
        'estado',
        'id_producto',
        'id_talla',
        'id_color',
    ];

    protected $casts = [
        'precio_compra' => 'decimal:2',
        'porcentaje_ganancia' => 'decimal:2',
        'precio_venta' => 'decimal:2',
        'imagenes' => 'array',
        'estado' => 'boolean',
    ];

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_producto');
    }

    public function talla(): BelongsTo
    {
        return $this->belongsTo(Talla::class, 'id_talla');
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'id_color');
    }
}
