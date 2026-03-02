<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subcategory extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'icon', 'category_id', 'parent_id'];

    /**
     * Get the category that owns this subcategory.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the parent subcategory.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class, 'parent_id');
    }

    /**
     * Get all child subcategories.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Subcategory::class, 'parent_id');
    }
}
