<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Symetrie: string implements HasLabel
{
    case HEXAGONALE = 'hexagonale';
    case SIX_BRANCHES = 'six_branches';
    case RADIALE = 'radiale';
    case BILATERALE = 'bilaterale';
    case ASYMETRIQUE = 'asymetrique';
    case IRREGULIERE = 'irreguliere';
    case INDETERMINEE = 'indeterminee';

    public function getLabel(): ?string
    {
        return __("enums.symetrie.{$this->value}");
    }
}