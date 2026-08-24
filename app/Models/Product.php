<?php

namespace App\Models;

use Binafy\LaravelCart\Cartable;
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

    public function getPrice(): float
    {
        return $this->price;
    }
}