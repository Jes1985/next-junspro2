<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * MODULE 01 — Je me connais pour accompagner
 * Formation Praticien · Condensé des modules 01-02-03 du Parcours
 * Arc pédagogique : auto-observation corporelle · mémoire des blessures · ressources intérieures
 * Prisme professionnel : ce que j'ai vécu est ma matière première
 */
class FormationPraticienModule01Seeder extends Seeder
{
    private function card(string $color, string $badge, string $title, string $body): string
    {
        return '<div style="border-left:3px solid '.$color.';padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(0,0,0,.15);border-radius:0 10px 10px 0;">'
            .'<h4 style="color:#fff;font-size:.87rem;font-weight:700;margin:0 0 .5rem;display:flex;align-items:center;gap:.6rem;">'
            .'<span style="font-size:.68rem;color:'.$color.';background:rgba(0,0,0,.35);border:1px solid '.$color.';border-radius:6px;padding:.1rem .4rem;flex-shrink:0;">'.$badge.'</span>'
            .$title.'</h4>'
            .'<div style="font-size:.8rem;color:rgba(232,224,208,.72);line-height:1.85;">'.$body.'</div>'
            .'</div>';
    }

    public function run(): void
    {
        $gold   = 'rgba(201,168,76,.9)';
        $teal   = 'rgba(20,184,166,.8)';
        $blue   = 'rgba(59,130,246,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $orange = 'rgba(249,115,22,.8)';
        $green  = 'rgba(34,197,94,.8)';
        $red    = 'rgba(239,68,68,.8)';

        $intro = $this->card($gold, 'Module 01 · Praticien', 'Pourquoi se connaître est la première compétence du praticien',
            '<div style="font-size:.88rem;line-height:2.1;color:rgba(232,224,208,.82);">
            Dans le Parcours, ces trois explorations prennent chacune une semaine.<br>
            Dans la Formation Praticien, nous les traversons ensemble — vite, dense, avec le prisme professionnel.<br><br>
            La question n\'est plus <em>"qui suis-je ?"</em><br>
            Elle devient : <strong>"ce que j\'ai vécu — comment m\'équipe-t-il pour accompagner ?"</strong><br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;border:1px solid rgba(201,168,76,.15);margin:.75rem 0;">
            <strong style="color:rgba(201,168,76,.9);">Le principe fondateur :</strong><br><br>
            Un praticien qui n\'a pas fait son propre voyage ne peut accompagner que dans la théorie.<br>
            Un praticien qui a traversé la présence, la blessure, et les ressources — accompagne depuis le vivant.<br><br>
            <em>"Ce n\'est pas votre diplôme qui inspire confiance. C\'est la profondeur de votre propre voyage."</em>
            </div>
            Ce module vous donne 3 outils actifs :<br>
            ① L\'auto-observation corporelle — votre boussole intérieure permanente<br>
            ② La reconnaissance de vos blessures — et comment elles deviennent des ressources<br>
            ③ L\'inventaire de vos ressources — ce que vous apportez de singulier<br><br>
            <em style="color:rgba(201,168,76,.8);">À la fin de ce module : vous rédigez votre Portrait du Praticien — la synthèse de votre voyage personnel au service de votre pratique.</em>
            </div>'
        );

        $auto_observation = $this->card($teal, 'Leçon 1', 'L\'auto-observation corporelle — votre instrument de bord',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Avant d\'observer le corps de l\'autre, observez le vôtre.<br>
            Pas une fois — <strong>en continu, comme une compétence professionnelle.</strong><br><br>
            <strong style="color:rgba(20,184,166,.9);">Les 4 niveaux d\'observation interne :</strong><br><br>
            <strong>① Les sensations physiques</strong><br>
            Température · Tension · Pression · Légèreté · Vibration<br>
            "Où dans mon corps est-ce que je porte quelque chose en ce moment ?"<br><br>
            <strong>② Les états émotionnels</strong><br>
            Les émotions ont une adresse corporelle. Peur = ventre. Colère = mâchoires/poitrine. Tristesse = gorge/poitrine.<br>
            "Quelle émotion est présente — et où ?"<br><br>
            <strong>③ L\'état d\'énergie</strong><br>
            Tonique, neutre, fatigué, débordé, centré.<br>
            Un praticien épuisé transfère son état à son client. La gestion de l\'énergie est éthique.<br><br>
            <strong>④ La présence à soi</strong><br>
            Suis-je dans ma tête, dans le passé, dans le futur — ou ici, maintenant, dans mon corps ?<br>
            La présence à soi est la condition de la présence à l\'autre.<br><br>
            <div style="background:rgba(20,184,166,.07);border-radius:10px;padding:.75rem 1rem;margin-top:.75rem;">
            <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(20,184,166,.55);margin-bottom:.5rem;">─ Outil quotidien ─</div>
            <strong>Le check-in du praticien (2 min avant chaque séance) :</strong><br>
            Fermer les yeux. 3 souffles 5-5-5.<br>
            1. Où est mon corps ? (tension dominante)<br>
            2. Quelle est mon émotion du moment ?<br>
            3. Mon énergie est à : ___/10<br>
            4. Suis-je disponible pour cet·te client·e ? (oui/presque/non)<br><br>
            <em>Si la réponse à 4 est "non" : 5 minutes de cohérence cardiaque avant de commencer.</em>
            </div>
            </div>
            <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(20,184,166,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
            🎙 <strong style="color:rgba(20,184,166,.8);">Script audio ·</strong>
            <em>"Fermez les yeux. Faites un rapport rapide à votre corps. Pas de jugement — juste de l\'observation. Questionnez chaque zone : les épaules, le ventre, la gorge, la mâchoire. Qu\'est-ce qui est là aujourd\'hui ?"</em>
            </div>'
        );

        $blessures_ressources = $this->card($purple, 'Leçon 2', 'Vos blessures comme ressources — le retournement praticien',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            La blessure non reconnue reste un filtre.<br>
            La blessure reconnue et traversée devient une <strong>antenne de précision</strong>.<br><br>
            <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;border:1px solid rgba(168,85,247,.12);">
            <strong style="color:rgba(168,85,247,.9);">Le mécanisme du contre-transfert :</strong><br><br>
            Un praticien accompagne un client qui souffre d\'abandon.<br>
            Si sa propre blessure d\'abandon n\'est pas reconnue → son corps réagit, son jugement se trouble.<br>
            Si elle est reconnue et traversée → il peut tenir l\'espace avec une précision rare.
            </div>
            <strong style="color:rgba(168,85,247,.9);">Le retournement en 3 étapes :</strong><br><br>
            <strong>① Reconnaître la blessure</strong><br>
            Quelle blessure (abandon / rejet / trahison / humiliation / injustice) résonne le plus en moi ?<br>
            Où est-elle dans mon corps ? Comment se manifeste-t-elle encore aujourd\'hui ?<br><br>
            <strong>② Nommer ce qu\'elle m\'a coûté et ce qu\'elle m\'a appris</strong><br>
            Elle m\'a coûté : ___ / Elle m\'a appris : ___<br>
            Ce qu\'elle m\'a appris — c\'est ma ressource la plus précieuse en accompagnement.<br><br>
            <strong>③ Identifier la limite à ne pas franchir</strong><br>
            Quelle situation client est susceptible de réactiver cette blessure ?<br>
            Quel est mon signal d\'alarme corporel ? Que faire quand il s\'allume ?<br><br>
            <em>Ce travail n\'est pas à faire une fois. C\'est une pratique de supervision continue.</em>
            </div>
            <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(168,85,247,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
            🎙 <strong style="color:rgba(168,85,247,.8);">Script audio ·</strong>
            <em>"Pensez à la douleur que vous avez le mieux connue. Celle que vous avez réellement traversée. Maintenant — à quel type de client vous permet-elle de répondre avec une précision que personne d\'autre n\'aurait ? C\'est là que votre blessure devient puissance."</em>
            </div>'
        );

        $ressources_praticien = $this->card($orange, 'Leçon 3', 'L\'inventaire des ressources — ce que vous apportez de singulier',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Les ressources d\'un praticien ne sont pas ses diplômes.<br>
            Ce sont ses <strong>expériences vitales traversées et intégrées</strong>.<br><br>
            <strong>Les 5 catégories de ressources :</strong><br><br>
            <strong style="color:rgba(249,115,22,.9);">① Ressources de vie</strong> — ce que vous avez traversé<br>
            Un deuil, une maladie, une rupture majeure, un dépassement. Ces expériences vous donnent une crédibilité intérieure qu\'aucun livre ne donne.<br><br>
            <strong style="color:rgba(249,115,22,.9);">② Ressources corporelles</strong> — ce que votre corps sait<br>
            Les pratiques physiques, sportives, corporelles que vous avez intégrées. Ils informent votre lecture du corps de l\'autre.<br><br>
            <strong style="color:rgba(249,115,22,.9);">③ Ressources relationnelles</strong> — comment vous créez le lien<br>
            Votre façon naturelle de créer la confiance, d\'écouter, de tenir un espace. Le plus souvent sous-estimée.<br><br>
            <strong style="color:rgba(249,115,22,.9);">④ Ressources de bonheur</strong> — ce qui vous recharge<br>
            Ce qui vous rend pleinement vivant·e. Un praticien qui connaît ses sources de joie peut s\'y ressourcer — et ne pas pomper l\'énergie de ses clients.<br><br>
            <strong style="color:rgba(249,115,22,.9);">⑤ Ressources intuitives</strong> — ce que vous percevez sans l\'apprendre<br>
            Ce que vous détectez spontanément chez l\'autre. Ce que vous suivez sans savoir pourquoi — et qui s\'avère juste.
            </div>'
        );

        $pratique_scan = $this->card($blue, 'Pratique', 'Scan intégré — observer son corps, ses blessures, ses ressources',
            '<div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.9rem 1.1rem;border:1px solid rgba(59,130,246,.12);">
            <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(59,130,246,.55);margin-bottom:.75rem;">─ Protocole 30 minutes ─</div>
            <strong>Phase 1 — Le check-in corporel (10 min)</strong><br>
            Faire le scan complet du corps de la tête aux pieds.<br>
            Nommer 3 zones : la plus tendue · la plus légère · celle qui demande de l\'attention.<br>
            Pour chaque zone : quelle émotion ? quelle intensité ?<br><br>
            <strong>Phase 2 — La blessure reconnue (10 min)</strong><br>
            Fermer les yeux. Laisser venir la blessure qui résonne le plus aujourd\'hui.<br>
            Lui dire : "Je te reconnais. Tu m\'as protégé·e à ta façon. Voici ce que tu m\'as appris : ___"<br>
            3 souffles 5-5-5 vers cette zone.<br><br>
            <strong>Phase 3 — La ressource activée (10 min)</strong><br>
            Laisser venir un souvenir de pleine vie. Localiser la sensation dans le corps.<br>
            Amplifier avec 3 souffles 5-5-5.<br>
            Nommer la ressource dans une phrase courte : "Je suis quelqu\'un qui ___"<br>
            </div>'
        );

        $portrait = $this->card($green, 'Intégration', 'Le Portrait du Praticien — ma synthèse personnelle',
            '<div style="font-size:.85rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Ce portrait est votre boussole professionnelle.<br>
            Il résume ce que vous êtes — au service de qui vous accompagnez.<br><br>
            <div style="background:rgba(34,197,94,.06);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;">
            <strong>Complétez honnêtement :</strong><br><br>
            <strong>Mon signal corporel habituel (tension dominante) :</strong> ___<br>
            <strong>La blessure que j\'ai le mieux traversée :</strong> ___<br>
            <strong>Ce qu\'elle m\'a appris à percevoir chez l\'autre :</strong> ___<br>
            <strong>Ma ressource la plus singulière :</strong> ___<br>
            <strong>La situation client susceptible de me déstabiliser :</strong> ___<br>
            <strong>Mon geste de recentrage quand ça se passe :</strong> ___<br>
            <strong>Ce qui me recharge entre les séances :</strong> ___
            </div>
            <em style="color:rgba(34,197,94,.8);">Relisez ce portrait chaque trimestre. Il évolue avec votre pratique.</em>
            </div>'
        );

        $activities = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — Ce que j\'ai vécu m\'équipe pour accompagner',
                'duration'    => '15 min',
                'description' => 'Le prisme professionnel des 3 explorations de soi. Pourquoi l\'expérience vécue est plus précieuse que la technique apprise. Le principe du contre-transfert.',
                'content'     => $intro,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 1 — L\'auto-observation corporelle — votre instrument de bord',
                'duration'    => '25 min',
                'description' => 'Les 4 niveaux d\'observation interne (sensations · émotions · énergie · présence). Le check-in du praticien avant chaque séance — protocole 2 minutes.',
                'content'     => $auto_observation,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 2 — Vos blessures comme ressources',
                'duration'    => '25 min',
                'description' => 'Le mécanisme du contre-transfert. Le retournement en 3 étapes : reconnaître · nommer le coût et l\'apprentissage · identifier la limite. La blessure traversée comme antenne de précision.',
                'content'     => $blessures_ressources,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 3 — L\'inventaire des ressources',
                'duration'    => '20 min',
                'description' => 'Les 5 catégories de ressources du praticien : vie · corporelles · relationnelles · bonheur · intuitives. Ce que vous apportez de singulier qu\'aucun autre praticien n\'apporte.',
                'content'     => $ressources_praticien,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Pratique — Scan intégré en 3 phases',
                'duration'    => '30 min',
                'description' => 'Phase 1 : check-in corporel · Phase 2 : blessure reconnue + souffle · Phase 3 : ressource activée. La pratique complète du praticien qui se connaît.',
                'content'     => $pratique_scan,
            ],
            [
                'type'        => 'exercice',
                'title'       => 'Intégration — Mon Portrait du Praticien',
                'duration'    => '25 min',
                'description' => '7 phrases à compléter : signal corporel · blessure traversée · ce qu\'elle m\'apprend · ressource singulière · situation déstabilisante · geste de recentrage · source de recharge.',
                'content'     => $portrait,
            ],
            [
                'type'        => 'reflexion',
                'title'       => 'Lettre — À la personne que j\'accompagne déjà',
                'duration'    => '20 min',
                'description' => 'Commence par : "Je te connais mieux que tu ne le crois. Parce que j\'ai été toi. Voici ce que j\'ai traversé — et voici comment ça m\'équipe pour marcher à côté de toi..."',
            ],
        ];

        DB::table('formation_modules')->updateOrInsert(
            ['slug' => '01-je-me-connais-pour-accompagner', 'track' => 'praticien'],
            [
                'slug'        => '01-je-me-connais-pour-accompagner',
                'title'       => 'Je me connais pour accompagner — Soi, Blessures & Bonheur',
                'week_label'  => 'Module 01',
                'track'       => 'praticien',
                'order'       => 1,
                'is_active'   => true,
                'intro_text'  => "JE ME CONNAIS POUR ACCOMPAGNER — Module Praticien 01\n\nCe que j'ai vécu est ma matière première.\n\nCe module traverse en profondeur les 3 fondations de la connaissance de soi :\nauto-observation corporelle · blessures reconnues comme ressources · inventaire des forces.\n\nAvec le prisme professionnel : tout ce que vous êtes s'articule au service de ceux que vous accompagnez.",
                'description' => 'Auto-observation corporelle · Blessures comme ressources · Inventaire des forces · Portrait du Praticien. La connaissance de soi comme fondation de la pratique.',
                'activities'  => json_encode($activities),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        );

        $this->command->info('[FormationPraticienModule01Seeder] ✓ 7 activités — Je me connais pour accompagner.');
    }
}
