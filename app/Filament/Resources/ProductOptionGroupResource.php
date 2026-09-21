<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductOptionGroupResource\Pages;
use App\Filament\Resources\ProductOptionGroupResource\RelationManagers\ValuesRelationManager;
use App\Models\ProductOptionGroup;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use UnitEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;

class ProductOptionGroupResource extends Resource
{
    protected static ?string $model = ProductOptionGroup::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static string|UnitEnum|null $navigationGroup = 'Configurateur';

    protected static ?string $navigationLabel = 'Groupes d\'options';

    protected static ?string $modelLabel = 'groupe d\'options';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()
                ->columns(2)
                ->schema([
                    TextInput::make('key')
                        ->label('Clé technique')
                        ->helperText('Identifiant unique utilisé dans le code, ex: taille_cadre')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->alphaDash(),

                    TextInput::make('label')
                        ->label('Libellé affiché')
                        ->required(),

                    Select::make('input_type')
                        ->label('Type de champ')
                        ->options([
                            'select' => 'Liste de choix',
                            'boolean' => 'Oui / Non',
                        ])
                        ->required()
                        ->default('select'),

                    Toggle::make('affects_price')
                        ->label('Fait varier le prix')
                        ->default(true),

                    Toggle::make('is_required')
                        ->label('Obligatoire')
                        ->helperText('Le client doit choisir une valeur dans ce groupe')
                        ->default(false),

                    TextInput::make('position')
                        ->label('Ordre d’affichage')
                        ->numeric()
                        ->default(0),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('position')
            ->defaultSort('position')
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('key')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('input_type')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => $state === 'boolean' ? 'Oui / Non' : 'Liste'),

                Tables\Columns\IconColumn::make('affects_price')
                    ->label('Prix variable')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_required')
                    ->label('Obligatoire')
                    ->boolean(),

                Tables\Columns\TextColumn::make('values_count')
                    ->label('Valeurs')
                    ->counts('values'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ValuesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductOptionGroups::route('/'),
            'create' => Pages\CreateProductOptionGroup::route('/create'),
            'edit' => Pages\EditProductOptionGroup::route('/{record}/edit'),
        ];
    }
}