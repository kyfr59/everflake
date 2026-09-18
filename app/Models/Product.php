<?php

namespace App\Models;

use Binafy\LaravelCart\Cartable;
use App\Models\ProductOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model implements Cartable
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'active',
        'nom',
        'horodatage',
        'longueur',
        'largeur',
        'orientation',
        'nombre_pixels',
        'photo',
        'reference',
        'latitude',
        'longitude',
        'altitude',
        'pression_atmospherique',
        'luminosite_ambiante',
        'temperature',
        'humidite_relative',
        'point_de_rosee',
        'meteo',
        'support',
        'canton',
        'commune',
        'lieu_dit',
        'eclairage',
        'type_cristal',
        'classe_morphologique',
        'structure',
        'nombre_branches',
        'symetrie',
        'nombre_axes',
        'presence_dendrites',
        'presence_plaquettes',
        'presence_colonnes',
        'presence_aiguilles',
        'presence_givre',
        'presence_gouttelettes',
        'presence_fonte',
        'fractures_deformations',
        'ramification',
        'taille_approximative',
        'degre_riming',
    ];

    protected $casts = [
        'price' => 'integer',
        'stock' => 'integer',
        'active' => 'boolean',
        'horodatage' => 'datetime',
        'longueur' => 'integer',
        'largeur' => 'integer',
        'nombre_pixels' => 'integer',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'altitude' => 'decimal:2',
        'pression_atmospherique' => 'decimal:2',
        'luminosite_ambiante' => 'decimal:2',
        'temperature' => 'decimal:1',
        'humidite_relative' => 'decimal:2',
        'point_de_rosee' => 'decimal:1',
        'eclairage' => 'boolean',
        'nombre_branches' => 'integer',
        'nombre_axes' => 'integer',
        'presence_dendrites' => 'boolean',
        'presence_plaquettes' => 'boolean',
        'presence_colonnes' => 'boolean',
        'presence_aiguilles' => 'boolean',
        'presence_givre' => 'boolean',
        'presence_gouttelettes' => 'boolean',
        'presence_fonte' => 'boolean',
        'taille_approximative' => 'decimal:2',
        'degre_riming' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function booted(): void
    {
        static::creating(function (Product $product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
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
