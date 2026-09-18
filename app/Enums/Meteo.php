<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Meteo: string implements HasLabel
{
    case DEBUT_CHUTE_NEIGE = 'debut_chute_neige';
    case NEIGEUX = 'neigeux';
    case FIN_CHUTE_NEIGE = 'fin_chute_neige';
    case NUAGEUX = 'nuageux';
    case ENSOLEILLE = 'ensoleille';

    public function getLabel(): ?string
    {
        return __("enums.meteo.{$this->value}");
    }
}