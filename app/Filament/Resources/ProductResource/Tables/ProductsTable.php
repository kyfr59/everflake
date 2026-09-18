<?php

namespace App\Filament\Resources\ProductResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('price')
                    ->money()
                    ->sortable(),
                TextColumn::make('currency')
                    ->searchable(),
                TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('horodatage_precis')
                    ->dateTime()
                    ->sortable(),
                ImageColumn::make('longueur_image')
                    ->numeric()
                    ->sortable(),
                ImageColumn::make('largeur_image')
                    ->numeric()
                    ->sortable(),
                ImageColumn::make('orientation_image'),
                TextColumn::make('nombre_pixels')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('photo')
                    ->searchable(),
                TextColumn::make('reference')
                    ->searchable(),
                TextColumn::make('latitude')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('longitude')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('altitude')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('pression_atmospherique')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('luminosite_ambiante')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('temperature')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('humidite_relative')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('point_de_rosee')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('meteo')
                    ->searchable(),
                TextColumn::make('support')
                    ->searchable(),
                TextColumn::make('canton')
                    ->searchable(),
                TextColumn::make('commune')
                    ->searchable(),
                TextColumn::make('lieu_dit')
                    ->searchable(),
                IconColumn::make('eclairage')
                    ->boolean(),
                TextColumn::make('type_cristal')
                    ->searchable(),
                TextColumn::make('classe_morphologique')
                    ->searchable(),
                TextColumn::make('structure')
                    ->searchable(),
                TextColumn::make('nombre_branches')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('symetrie')
                    ->searchable(),
                TextColumn::make('nombre_axes')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('presence_dendrites')
                    ->boolean(),
                IconColumn::make('presence_plaquettes')
                    ->boolean(),
                IconColumn::make('presence_colonnes')
                    ->boolean(),
                IconColumn::make('presence_aiguilles')
                    ->boolean(),
                IconColumn::make('presence_givre')
                    ->boolean(),
                IconColumn::make('presence_gouttelettes')
                    ->boolean(),
                IconColumn::make('presence_fonte')
                    ->boolean(),
                TextColumn::make('taille_approximative')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('degre_riming')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
