<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Canton: string implements HasLabel
{
    case AG = 'AG';
    case AI = 'AI';
    case AR = 'AR';
    case BE = 'BE';
    case BL = 'BL';
    case BS = 'BS';
    case FR = 'FR';
    case GE = 'GE';
    case GL = 'GL';
    case GR = 'GR';
    case JU = 'JU';
    case LU = 'LU';
    case NE = 'NE';
    case NW = 'NW';
    case OW = 'OW';
    case SG = 'SG';
    case SH = 'SH';
    case SO = 'SO';
    case SZ = 'SZ';
    case TG = 'TG';
    case TI = 'TI';
    case UR = 'UR';
    case VD = 'VD';
    case VS = 'VS';
    case ZG = 'ZG';
    case ZH = 'ZH';

    public function getLabel(): ?string
    {
        return __("enums.canton.{$this->value}");
    }
}