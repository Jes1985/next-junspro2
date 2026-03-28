<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormationTrackMirrorSeeder extends Seeder
{
    private const SHARED_SLUGS = [
        '01-je-me-rencontre',
        '02-je-reconnais-mes-blessures',
        '03-je-decris-mon-bonheur',
        '04-j-ecoute-mon-souffle',
        '05-je-decouvre-ma-mission',
        '06-je-visualise-ma-vie',
    ];

    public function run(): void
    {
        // ⛔ DÉSACTIVÉ — Les deux tracks ont maintenant des contenus DISTINCTS :
        //   · Parcours 01–06  : contenu voyage intérieur PERSONNEL (FormationParcoursContentSeeder)
        //   · Formation 01–06 : contenu formation PROFESSIONNELLE praticien (FormationProContentSeeder)
        // Ne plus copier Parcours → Formation : cela écraserait le contenu pro de la Formation.
        $this->command->warn('[FormationTrackMirrorSeeder] Désactivé — utiliser FormationParcoursContentSeeder et FormationProContentSeeder.');
    }
}