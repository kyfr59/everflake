<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductOptionValueResource\Pages;
use App\Filament\Resources\ProductOptionValueResource\RelationManagers\IncompatibleWithRelationManager;
use App\Filament\Resources\ProductOptionValueResource\RelationManagers\RequiresRelationManager;
use App\Models\ProductOptionGroup;
use App\Models\ProductOptionValue;
use BackedEnum;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use UnitEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;

class ProductOptionValueResource extends Resource
{
    protected static ?string $model = ProductOptionValue::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-list-bullet';

    protected static string|UnitEnum|null $navigationGroup = 'Configurateur';

    protected static ?string $navigationLabel = 'Valeurs d\'options';

    protected static ?string $modelLabel = 'valeur d\'option';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Select::make('product_option_group_id')
                ->label('Groupe')
                ->options(ProductOptionGroup::pluck('label', 'id'))
                ->required()
                ->searchable(),

            Forms\Components\TextInput::make('value')
                ->label('Clé technique')
                ->required()
                ->alphaDash(),

            Forms\Components\TextInput::make('label')
                ->label('Libellé affiché')
                ->required(),

            Forms\Components\Select::make('price_modifier_type')
                ->options(['fixed' => 'Montant fixe', 'percent' => 'Pourcentage'])
                ->default('fixed')
                ->required(),

            Forms\Components\TextInput::make('price_modifier')
                ->label('Variation de prix (centimes)')
                ->numeric()
                ->default(0),

            Forms\Components\TextInput::make('shipping_weight_grams')
                ->numeric()
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('group.label')
                    ->label('Groupe')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('label')
                    ->searchable(),

                Tables\Columns\TextColumn::make('value')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('price_modifier')
                    ->label('Prix'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('product_option_group_id')
                    ->label('Groupe')
                    ->options(ProductOptionGroup::pluck('label', 'id')),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            IncompatibleWithRelationManager::class,
            RequiresRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductOptionValues::route('/'),
            'create' => Pages\CreateProductOptionValue::route('/create'),
            'edit' => Pages\EditProductOptionValue::route('/{record}/edit'),
        ];
    }
}