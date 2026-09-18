<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use BackedEnum;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Cristaux';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Product')
                ->columnSpanFull()
                ->tabs([
                    Tab::make('Photo')
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('price')
                                ->label('Prix')
                                ->numeric()
                                ->required()
                                ->minValue(0)
                                ->default(280),
                            FileUpload::make('photo')
                                //->image()
                                ->required()
                                ->directory('cristaux')
                                ->columnSpanFull(),
                            DateTimePicker::make('horodatage')
                                ->seconds(true)
                                ->required(),
                            Grid::make(3)
                                ->schema([
                                    TextInput::make('largeur')
                                        ->numeric()
                                        ->suffix('px')
                                        ->required(),
                                    TextInput::make('longueur')
                                        ->numeric()
                                        ->suffix('px')
                                        ->required(),
                                    TextInput::make('nombre_pixels')
                                        ->numeric()
                                        ->required(),
                                ]),
                            Select::make('orientation')
                                ->options([
                                    'portrait' => 'Portrait',
                                    'paysage' => 'Paysage',
                                    'carre' => 'Carré',
                                ])
                                ->required(),
                            TextInput::make('reference')
                                ->required()
                                ->maxLength(255),
                        ]),

                    Tab::make('Localisation & météo')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    TextInput::make('latitude')
                                        ->numeric(),
                                    TextInput::make('longitude')
                                        ->numeric(),
                                ]),
                            TextInput::make('altitude')
                                ->numeric()
                                ->suffix('m'),
                            TextInput::make('canton')
                                ->maxLength(255),
                            TextInput::make('commune')
                                ->maxLength(255),
                            TextInput::make('lieu_dit')
                                ->maxLength(255),
                            TextInput::make('support')
                                ->maxLength(255),
                            Toggle::make('eclairage')
                                ->label('Éclairage artificiel'),
                            TextInput::make('meteo')
                                ->maxLength(255)
                                ->columnSpanFull(),
                            Grid::make(3)
                                ->schema([
                                    TextInput::make('temperature')
                                        ->numeric()
                                        ->suffix('°C'),
                                    TextInput::make('point_de_rosee')
                                        ->numeric()
                                        ->suffix('°C'),
                                    TextInput::make('humidite_relative')
                                        ->numeric()
                                        ->suffix('%'),
                                ]),
                            Grid::make(2)
                                ->schema([
                                    TextInput::make('pression_atmospherique')
                                        ->numeric()
                                        ->suffix('hPa'),
                                    TextInput::make('luminosite_ambiante')
                                        ->numeric()
                                        ->suffix('lux'),
                                ]),
                        ]),

                    Tab::make('Cristal')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    TextInput::make('type_cristal')
                                        ->maxLength(255),
                                    TextInput::make('classe_morphologique')
                                        ->maxLength(255),
                                ]),
                            TextInput::make('structure')
                                ->maxLength(255),
                            Grid::make(3)
                                ->schema([
                                    TextInput::make('nombre_branches')
                                        ->numeric(),
                                    TextInput::make('symetrie')
                                        ->maxLength(255),
                                    TextInput::make('nombre_axes')
                                        ->numeric(),
                                ]),
                            Grid::make(4)
                                ->schema([
                                    Toggle::make('presence_dendrites'),
                                    Toggle::make('presence_plaquettes'),
                                    Toggle::make('presence_colonnes'),
                                    Toggle::make('presence_aiguilles'),
                                ]),
                            Grid::make(3)
                                ->schema([
                                    Toggle::make('presence_givre'),
                                    Toggle::make('presence_gouttelettes'),
                                    Toggle::make('presence_fonte'),
                                ]),
                            Textarea::make('fractures_deformations')
                                ->columnSpanFull(),
                            Textarea::make('ramification')
                                ->columnSpanFull(),
                            Grid::make(2)
                                ->schema([
                                    TextInput::make('taille_approximative')
                                        ->numeric()
                                        ->suffix('mm'),
                                    Select::make('degre_riming')
                                        ->options([
                                            0 => '0 — aucun',
                                            1 => '1 — léger',
                                            2 => '2 — modéré',
                                            3 => '3 — fort',
                                            4 => '4 — givré (graupel)',
                                        ]),
                                ]),
                        ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->square(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('horodatage')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('type_cristal')
                    ->searchable(),
                TextColumn::make('degre_riming')
                    ->label('Riming')
                    ->badge(),
                TextColumn::make('commune')
                    ->searchable(),
                TextColumn::make('canton')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                \Filament\Actions\EditAction::make(),
            ])
            ->toolbarActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
