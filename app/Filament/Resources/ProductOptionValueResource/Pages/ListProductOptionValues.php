<?php

namespace App\Filament\Resources\ProductOptionValueResource\Pages;

use App\Filament\Resources\ProductOptionValueResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductOptionValues extends ListRecords
{
    protected static string $resource = ProductOptionValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Ajouter une valeur'),
        ];
    }
}