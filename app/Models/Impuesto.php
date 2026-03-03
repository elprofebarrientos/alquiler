<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Impuesto extends Model
{
    protected $fillable = [
        'name',
        'porcentaje',
        'codigo_dian',
        'es_retencion',
        'es_trasladable',
        'es_compuesto',
        'orden_calculo',
        'estado',
    ];

    protected $casts = [
        'porcentaje' => 'decimal:2',
        'es_retencion' => 'boolean',
        'es_trasladable' => 'boolean',
        'es_compuesto' => 'boolean',
        'estado' => 'boolean',
    ];

    protected $table = 'impuestos';
}
