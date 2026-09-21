<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductOptionGroup extends Model
{
    protected $fillable = [
        'key',
        'label',
        'input_type',
        'affects_price',
        'is_required',
        'position',
    ];

    protected $casts = [
        'affects_price' => 'boolean',
        'is_required' => 'boolean',
        'position' => 'integer',
    ];

    public function values(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class)
            ->orderBy('position');
    }

    /**
     * Produits pour lesquels ce groupe d'options est proposé.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot(['is_required', 'position'])
            ->withTimestamps();
    }
}