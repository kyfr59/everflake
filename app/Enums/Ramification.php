<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Ramification: string implements HasLabel
{
    case SIMPLE = 'simple';
    case FAIBLEMENT_RAMIFIEE = 'faiblement_ramifiee';
    case MODEREMENT_RAMIFIEE = 'moderement_ramifiee';
    case FORTEMENT_RAMIFIEE = 'fortement_ramifiee';
    case TRES_FORTEMENT_RAMIFIEE = 'tres_fortement_ramifiee';

    public function getLabel(): ?string
    {
        return __("enums.ramification.{$this->value}");
    }
}