<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Structure: string implements HasLabel
{
    case CRISTAL_SIMPLE = 'cristal_simple';
    case AGREGAT = 'agregat';

    public function getLabel(): ?string
    {
        return __("enums.structure.{$this->value}");
    }
}