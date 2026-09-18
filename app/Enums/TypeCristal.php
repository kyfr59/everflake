<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TypeCristal: string implements HasLabel
{
    case PLAQUETTE = 'plaquette';
    case ETOILE = 'etoile';
    case AIGUILLE = 'aiguille';
    case COLONNE = 'colonne';
    case DENDRITE = 'dendrite';
    case PRISME = 'prisme';
    case COLONNE_COIFFEE = 'colonne_coiffee';
    case CRISTAL_IRREGULIER = 'cristal_irregulier';
    case AGREGAT = 'agregat';
    case GIVRE = 'givre';

    public function getLabel(): ?string
    {
        return __("enums.type_cristal.{$this->value}");
    }
}