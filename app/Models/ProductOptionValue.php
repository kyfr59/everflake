<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductOptionValue extends Model
{
    protected $fillable = [
        'product_option_group_id',
        'value',
        'label',
        'price_modifier_type',
        'price_modifier',
        'shipping_weight_grams',
        'shipping_extra_cost',
        'meta',
        'position',
    ];

    protected $casts = [
        'price_modifier' => 'integer',
        'shipping_weight_grams' => 'integer',
        'shipping_extra_cost' => 'integer',
        'meta' => 'array',
        'position' => 'integer',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(ProductOptionGroup::class, 'product_option_group_id');
    }

    /**
     * Valeurs incompatibles avec celle-ci (relation symétrique,
     * les deux lignes A->B et B->A existent en base).
     */
    public function incompatibleWith(): BelongsToMany
    {
        return $this->belongsToMany(
            self::class,
            'option_value_incompatibilities',
            'option_value_id',
            'incompatible_with_value_id'
        );
    }

    /**
     * Valeurs requises pour pouvoir sélectionner celle-ci.
     */
    public function requires(): BelongsToMany
    {
        return $this->belongsToMany(
            self::class,
            'option_value_dependencies',
            'option_value_id',
            'required_value_id'
        );
    }

    /**
     * Prix modificateur effectif pour un produit donné,
     * en tenant compte d'une éventuelle surcharge.
     */
    public function priceModifierFor(Product $product): int
    {
        $override = $this->relationLoaded('overrides')
            ? $this->overrides->firstWhere('product_id', $product->id)
            : ProductOptionValueOverride::query()
                ->where('product_id', $product->id)
                ->where('product_option_value_id', $this->id)
                ->first();

        if ($override) {
            return $override->price_modifier;
        }

        if ($this->price_modifier_type === 'percent') {
            return (int) round($product->base_price * $this->price_modifier / 100);
        }

        return $this->price_modifier;
    }
}
