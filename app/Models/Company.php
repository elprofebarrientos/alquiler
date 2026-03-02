<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    protected $fillable = [
        'nit',
        'name',
        'email',
        'phone',
        'city_id',
        'postal_code',
        'address',
        'url',
        'type_company',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
