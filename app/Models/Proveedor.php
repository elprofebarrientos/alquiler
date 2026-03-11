<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $primaryKey = 'id_proveedor';

    protected $fillable = [
        'tipo_documento',
        'numero_documento',
        'digito_verificacion',
        'razon_social',
        'nombre_comercial',
        'responsabilidad_fiscal',
        'es_iva_responsable',
        'es_autoretenedor',
        'correo_facturacion',
        'telefono',
        'direccion',
        'codigo_postal',
        'id_pais',
        'id_departamento',
        'id_municipio',
        'plazo_pago_dias',
        'cupo_credito',
        'estado',
    ];

    protected $casts = [
        'es_iva_responsable' => 'boolean',
        'es_autoretenedor' => 'boolean',
        'estado' => 'boolean',
        'cupo_credito' => 'decimal:2',
        'plazo_pago_dias' => 'integer',
        'digito_verificacion' => 'integer',
    ];

    public function pais(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'id_pais');
    }

    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'id_departamento');
    }

    public function municipio(): BelongsTo
    {
        return $this->belongsTo(City::class, 'id_municipio');
    }
}
