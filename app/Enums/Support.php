<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Support: string implements HasLabel
{
    case VERRE = 'verre';
    case ECHARPE_BLEUE = 'echarpe_bleue';
    case ECHARPE_ROUGE = 'echarpe_rouge';
    case PAPIER = 'papier';
    case AUTRE = 'autre';

    public function getLabel(): ?string
    {
        return __("enums.support.{$this->value}");
    }
}