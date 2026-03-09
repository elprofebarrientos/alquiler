<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'descripcion',
        'category_id',
        'subcategory_id',
        'brand_id',
        'unit_id',
        'maneja_talla',
        'maneja_color',
        'estado',
    ];

    protected $casts = [
        'maneja_talla' => 'boolean',
        'maneja_color' => 'boolean',
        'estado' => 'boolean',
    ];

    /**
     * Get the category that owns this product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the subcategory that owns this product.
     */
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    /**
     * Get the brand that owns this product.
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the unit that owns this product.
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Get all images for this product.
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('orden');
    }

    /**
     * Get all impuestos associated with this product.
     */
    public function impuestos(): HasMany
    {
        return $this->hasMany(ProductoImpuesto::class);
    }

    /**
     * Get all variantes associated with this product.
     */
    public function variantes(): HasMany
    {
        return $this->hasMany(Variante::class, 'id_producto');
    }
}
