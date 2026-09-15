<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    protected $fillable = [
        'product_id',
        'type',
        'value',
        'label',
        'price_modifier',
    ];

    protected $casts = [
        'price_modifier' => 'integer',
    ];

    /**
     * Le produit auquel appartient cette option.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}