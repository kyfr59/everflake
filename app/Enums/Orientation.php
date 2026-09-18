<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Orientation: string implements HasLabel
{
    case PORTRAIT = 'portrait';
    case PAYSAGE = 'paysage';
    case CARRE = 'carre';

    public function getLabel(): ?string
    {
        return __("enums.orientation.{$this->value}");
    }
}