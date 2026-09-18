<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ClasseMorphologique: string implements HasLabel
{
    case PLAQUETTE_HEXAGONALE = 'plaquette_hexagonale';
    case PLAQUETTE_SECTORIELLE = 'plaquette_sectorielle';

    case ETOILE = 'etoile';
    case DENDRITE = 'dendrite';
    case DENDRITE_STELLAIRE = 'dendrite_stellaire';
    case DENDRITE_FOUGERE = 'dendrite_fougere';

    case AIGUILLE = 'aiguille';
    case FAISCEAU_AIGUILLES = 'faisceau_aiguilles';

    case COLONNE = 'colonne';
    case COLONNE_CREUSE = 'colonne_creuse';
    case COLONNE_LONGUE = 'colonne_longue';
    case COLONNE_COIFFEE = 'colonne_coiffee';

    case PRISME_HEXAGONAL = 'prisme_hexagonal';
    case BULLET = 'bullet';
    case ROSETTE_COLONNES = 'rosette_colonnes';

    case CRISTAL_SQUELETTE = 'cristal_squelette';

    case AGREGAT = 'agregat';

    case CRISTAL_GIVRE = 'cristal_givre';
    case CRISTAL_FORTEMENT_GIVRE = 'cristal_fortement_givre';

    case CRISTAL_IRREGULIER = 'cristal_irregulier';

    public function getLabel(): ?string
    {
        return __("enums.classe_morphologique.{$this->value}");
    }
}