<?php

namespace App\Filament\Resources\ProductOptionGroupResource\Pages;

use App\Filament\Resources\ProductOptionGroupResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductOptionGroups extends ListRecords
{
    protected static string $resource = ProductOptionGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Ajouter un groupe'),
        ];
    }
}