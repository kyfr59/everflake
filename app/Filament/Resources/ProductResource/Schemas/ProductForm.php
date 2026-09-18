<?php

namespace App\Filament\Resources\ProductResource\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nom'),
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('currency')
                    ->required()
                    ->default('CHF'),
                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('active')
                    ->required(),
                DateTimePicker::make('horodatage_precis'),
                FileUpload::make('longueur_image')
                    ->image(),
                FileUpload::make('largeur_image')
                    ->image(),
                FileUpload::make('orientation_image')
                    ->image(),
                TextInput::make('nombre_pixels')
                    ->numeric(),
                TextInput::make('photo'),
                TextInput::make('reference'),
                TextInput::make('latitude')
                    ->numeric(),
                TextInput::make('longitude')
                    ->numeric(),
                TextInput::make('altitude')
                    ->numeric(),
                TextInput::make('pression_atmospherique')
                    ->numeric(),
                TextInput::make('luminosite_ambiante')
                    ->numeric(),
                TextInput::make('temperature')
                    ->numeric(),
                TextInput::make('humidite_relative')
                    ->numeric(),
                TextInput::make('point_de_rosee')
                    ->numeric(),
                TextInput::make('meteo'),
                TextInput::make('support'),
                TextInput::make('canton'),
                TextInput::make('commune'),
                TextInput::make('lieu_dit'),
                Toggle::make('eclairage'),
                TextInput::make('type_cristal'),
                TextInput::make('classe_morphologique'),
                TextInput::make('structure'),
                TextInput::make('nombre_branches')
                    ->numeric(),
                TextInput::make('symetrie'),
                TextInput::make('nombre_axes')
                    ->numeric(),
                Toggle::make('presence_dendrites')
                    ->required(),
                Toggle::make('presence_plaquettes')
                    ->required(),
                Toggle::make('presence_colonnes')
                    ->required(),
                Toggle::make('presence_aiguilles')
                    ->required(),
                Toggle::make('presence_givre')
                    ->required(),
                Toggle::make('presence_gouttelettes')
                    ->required(),
                Toggle::make('presence_fonte')
                    ->required(),
                Textarea::make('fractures_deformations')
                    ->columnSpanFull(),
                Textarea::make('ramification')
                    ->columnSpanFull(),
                TextInput::make('taille_approximative')
                    ->numeric(),
                TextInput::make('degre_riming')
                    ->numeric(),
            ]);
    }
}
