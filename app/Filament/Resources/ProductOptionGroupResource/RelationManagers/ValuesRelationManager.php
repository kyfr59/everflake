<?php

namespace App\Filament\Resources\ProductOptionGroupResource\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ValuesRelationManager extends RelationManager
{
    protected static string $relationship = 'values';

    protected static ?string $title = 'Valeurs';

    protected static ?string $recordTitleAttribute = 'label';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()
                ->columns(2)
                ->schema([
                    TextInput::make('value')
                        ->label('Valeur technique')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('label')
                        ->label('Libellé affiché')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('price_modifier')
                        ->label('Modification de prix')
                        ->numeric()
                        ->step(0.01)
                        ->default(0),

                    TextInput::make('position')
                        ->label('Ordre d’affichage')
                        ->numeric()
                        ->default(0),

                    Toggle::make('active')
                        ->label('Active')
                        ->default(true),
                ]),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('position')
            ->defaultSort('position')
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->label('Libellé')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('value')
                    ->label('Valeur')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('price_modifier')
                    ->label('Modification de prix')
                    ->money('CHF')
                    ->sortable(),

                Tables\Columns\IconColumn::make('active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Ajouter une valeur'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}