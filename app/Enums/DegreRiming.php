<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum DegreRiming: int implements HasLabel
{
    case NUL = 0;
    case FAIBLE = 1;
    case MODERE = 2;
    case FORT = 3;
    case TRES_FORT = 4;

    public function getLabel(): ?string
    {
        return __("enums.degre_riming.{$this->value}");
    }
}