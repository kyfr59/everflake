<?php

namespace App\Models;

use Binafy\LaravelCart\Cartable;
use App\Models\ProductOption;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements Cartable
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'active',
    ];

    protected $casts = [
        'price' => 'integer',
        'stock' => 'integer',
        'active' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function options()
    {
        return $this->hasMany(ProductOption::class);
    }

    public function getPriceWithOptions(array $selected = []): float
    {
        $price = $this->price;

        foreach (array_filter($selected) as $type => $value) {
            $option = $this->options()
                ->where('type', $type)
                ->where('value', $value)
                ->first();

            $price += $option?->price_modifier ?? 0;
        }

        return $price;
    }
}