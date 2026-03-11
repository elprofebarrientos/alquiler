<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventario extends Model
{
    protected $table = 'inventarios';
    protected $primaryKey = 'id_inventario';

    protected $fillable = [
        'id_variante',
        'stock_total',
        'stock_mantenimiento',
        'stock_danado',
    ];

    protected $casts = [
        'stock_total' => 'integer',
        'stock_mantenimiento' => 'integer',
        'stock_danado' => 'integer',
    ];

    public function variante(): BelongsTo
    {
        return $this->belongsTo(Variante::class, 'id_variante');
    }
}
