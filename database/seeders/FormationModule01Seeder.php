<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * MODULE 1 — Je me rencontre
 * Arc pédagogique : auto-observation · présence corporelle · ancrage dans le soi
 */
class FormationModule01Seeder extends Seeder
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
        $indigo = 'rgba(99,102,241,.8)';
        $pink   = 'rgba(236,72,153,.8)';

        // ─── INTRODUCTION ──────────────────────────────────────────────
        $intro =
            $this->card($gold, 'Promesse', 'Ce que ce module t\'apprend',
                '<div style="font-size:.88rem;line-height:2.1;color:rgba(232,224,208,.82);">
                Ce module n\'est pas un test psychologique.<br>
                Ce n\'est pas une thérapie.<br><br>
                C\'est un <strong>rendez-vous avec toi-même</strong>.<br><br>
                À travers le corps — pas malgré lui.<br><br>
                Avant d\'accompagner quelqu\'un, tu dois avoir fait ce voyage :<br>
                · Te rencontrer<br>
                · T\'observer sans te juger<br>
                · Reconnaître tes signaux corporels<br><br>
                <em style="color:rgba(201,168,76,.8);">Un praticien qui se connaît peut accueillir l\'autre pleinement.</em>
                </div>'
            )
            .$this->card($teal, 'Leçon 1', 'L\'écoute de soi — le premier outil du praticien',
                '<div style="font-size:.92rem;line-height:2.3;color:rgba(232,224,208,.82);font-style:italic;margin-bottom:.9rem;">
                Écouter l\'autre commence par s\'écouter soi-même.<br><br>
                La plupart des gens vivent dans leur tête.<br>
                Un praticien Pause Souffle vit dans son corps.
                </div>
                <div style="background:rgba(20,184,166,.07);border-radius:10px;padding:.85rem 1.1rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(20,184,166,.55);margin-bottom:.5rem;">─ Exercice · Le scan de 3 minutes ─</div>
                Assieds-toi. Ferme les yeux.<br>
                Parcours mentalement ton corps de la tête aux pieds.<br>
                Pose une question à chaque zone : <em>qu\'est-ce que tu ressens là ?</em><br><br>
                Note sans juger. Juste observer.
                </div>
                <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(20,184,166,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
                🎙 <strong style="color:rgba(20,184,166,.8);">Script audio ElevenLabs ·</strong>
                <em>"Prenez quelques instants pour vous installer confortablement. Fermez doucement les yeux. Commencez par la tête… est-ce qu\'il y a des tensions ? Des zones de chaleur ? Descendez lentement… le cou… les épaules… la poitrine… le ventre… Ne cherchez pas à changer quoi que ce soit. Juste observer."</em>
                </div>'
            )
            .$this->card($blue, 'Leçon 2', 'Les signaux du corps — ton corps te parle déjà',
                '<div style="font-size:.92rem;line-height:2.3;color:rgba(232,224,208,.82);font-style:italic;margin-bottom:.9rem;">
                Le corps communique en permanence.<br><br>
                Avant les mots, avant les pensées :<br>
                il y a une sensation.
                </div>
                <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.85rem 1.1rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(59,130,246,.55);margin-bottom:.5rem;">─ Le dictionnaire des signaux ─</div>
                <strong>Nœud dans la gorge</strong> → quelque chose à dire qui reste bloqué<br>
                <strong>Pression dans la poitrine</strong> → émotion retenue (peur, tristesse)<br>
                <strong>Tension dans les épaules</strong> → charge, responsabilité, contrôle<br>
                <strong>Ventre noué</strong> → insécurité, anticipation, anxiété<br>
                <strong>Mâchoires serrées</strong> → colère rentrée, frustration non exprimée<br><br>
                <em>Apprendre à lire ces signaux chez soi — avant de les lire chez l\'autre.</em>
                </div>
                <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(59,130,246,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
                🎙 <strong style="color:rgba(59,130,246,.8);">Script audio ElevenLabs ·</strong>
                <em>"Votre corps connaît vos émotions avant votre mental. Portez votre attention sur votre gorge… est-ce qu\'elle est libre ou serrée ? Sur votre poitrine… légère ou lourde ? Sur votre ventre… calme ou noué ? Chaque sensation est une information précieuse."</em>
                </div>'
            )
            .$this->card($purple, 'Leçon 3', 'Les émotions comme informations — ne plus les fuir',
                '<div style="font-size:.92rem;line-height:2.3;color:rgba(232,224,208,.82);font-style:italic;margin-bottom:.9rem;">
                Une émotion n\'est pas un problème.<br>
                C\'est une information.
                </div>
                <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.85rem 1.1rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(168,85,247,.55);margin-bottom:.5rem;">─ Les 4 émotions fondamentales ─</div>
                <strong style="color:rgba(168,85,247,.9);">Joie</strong> → expansion · chaleur · légèreté · envie d\'avancer<br>
                <strong style="color:rgba(168,85,247,.9);">Peur</strong> → contraction · froid · protection · signal de danger<br>
                <strong style="color:rgba(168,85,247,.9);">Colère</strong> → énergie · chaleur · limite franchie · besoin de respect<br>
                <strong style="color:rgba(168,85,247,.9);">Tristesse</strong> → lourdeur · lenteur · deuil · besoin d\'intégration<br><br>
                Aucune n\'est mauvaise. Toutes ont un rôle.
                </div>
                <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(168,85,247,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
                🎙 <strong style="color:rgba(168,85,247,.8);">Script audio ElevenLabs ·</strong>
                <em>"Quelle est l\'émotion présente en ce moment dans votre corps ? Ne cherchez pas à la nommer parfaitement. Juste… est-ce qu\'elle est légère ou lourde ? Chaude ou froide ? Accueillez-la. Elle est là pour vous informer."</em>
                </div>'
            )
            .$this->card($orange, 'Leçon 4', 'Le miroir intérieur — observer sans se juger',
                '<div style="font-size:.92rem;line-height:2.3;color:rgba(232,224,208,.82);font-style:italic;margin-bottom:.9rem;">
                L\'auto-observation n\'est pas de la navel-gazing.<br><br>
                C\'est la compétence la plus rare et la plus précieuse<br>
                d\'un praticien corporel.
                </div>
                <div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.85rem 1.1rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(249,115,22,.55);margin-bottom:.5rem;">─ La règle des 3 O ─</div>
                <strong>Observer</strong> → ce qui se passe dans le corps, sans filtre<br>
                <strong>Objectiver</strong> → "je ressens X" et non "je suis X" ni "c\'est X qu\'il faut ressentir"<br>
                <strong>Ouvrir</strong> → laisser la sensation évoluer, ne pas la fixer<br><br>
                <em>La différence entre "j\'ai une douleur à l\'épaule" et "je suis quelqu\'un qui souffre".</em>
                </div>'
            );

        // ─── PRATIQUES ─────────────────────────────────────────────────
        $scan =
            $this->card($green, 'Pratique', 'Le scan corporel complet — 10 minutes',
                '<div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.85rem 1.1rem;margin-bottom:.75rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(34,197,94,.55);margin-bottom:.5rem;">─ Protocole ─</div>
                <strong>Minute 1–2</strong> : Installation. Assis ou allongé. 3 respirations profondes.<br>
                <strong>Minute 3–4</strong> : Tête et cou. Tensions ? Lourdeur ? Température ?<br>
                <strong>Minute 5–6</strong> : Épaules, bras, mains. Qu\'est-ce qui est là ?<br>
                <strong>Minute 7–8</strong> : Poitrine et ventre. Souffle libre ou retenu ?<br>
                <strong>Minute 9–10</strong> : Bassin, jambes, pieds. Ancré ou flottant ?
                </div>
                À chaque zone : observez, ne corrigez pas.<br>
                <em>Le scan n\'est pas un exercice de relaxation — c\'est un exercice de présence.</em>'
            );

        $journal =
            $this->card($indigo, 'Pratique', 'Le journal de bord du corps — outil quotidien',
                '<div style="font-size:.85rem;line-height:2.1;color:rgba(232,224,208,.82);">
                Chaque matin ou soir, 5 minutes :<br><br>
                <strong>Question 1</strong> → Quelle zone de mon corps a retenu mon attention aujourd\'hui ?<br>
                <strong>Question 2</strong> → Quelle émotion était présente dans mon corps aujourd\'hui ?<br>
                <strong>Question 3</strong> → Qu\'est-ce que mon corps m\'a dit que mon mental n\'avait pas voulu entendre ?<br><br>
                <em style="color:rgba(99,102,241,.8);">Pas besoin d\'écrire beaucoup. Trois lignes suffisent. La régularité prime sur la profondeur.</em>
                </div>'
            );

        $integration =
            $this->card($gold, 'Intégration', 'Mon portrait corporel — synthèse du module',
                '<div style="font-size:.85rem;line-height:2.1;color:rgba(232,224,208,.82);">
                Remplis ces phrases :<br><br>
                <strong>La zone de mon corps que j\'habite le mieux est :</strong> ___<br>
                <strong>La zone que j\'ai tendance à ignorer est :</strong> ___<br>
                <strong>L\'émotion que mon corps exprime le plus souvent est :</strong> ___<br>
                <strong>Un signal corporel que j\'ai appris à reconnaître dans ce module :</strong> ___<br>
                <strong>Ce que je vais observer en priorité chez mes clients :</strong> ___<br><br>
                <em style="color:rgba(201,168,76,.8);">Ce portrait n\'est pas un diagnostic. C\'est un point de départ vivant.</em>
                </div>'
            );

        $lettre =
            $this->card($pink, 'Lettre', 'Lettre à mon corps — clôture du module',
                '<div style="font-size:.88rem;line-height:2.1;color:rgba(232,224,208,.82);font-style:italic;">
                Commence par :<br><br>
                <em>"Corps, je t\'ai écouté différemment cette semaine. Voici ce que j\'ai découvert en te rencontrant vraiment…"</em><br><br>
                </div>
                <div style="background:rgba(236,72,153,.07);border-radius:10px;padding:.75rem 1rem;font-size:.78rem;color:rgba(232,224,208,.65);">
                Durée recommandée : 15 minutes d\'écriture libre.<br>
                Pas de correction. Pas de relecture immédiate.<br>
                Juste laisser venir ce qui vient.
                </div>'
            );

        $activities = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — Pourquoi se rencontrer avant d\'accompagner',
                'duration'    => '~15 min',
                'description' => 'La promesse du module : te rencontrer, t\'observer, reconnaître tes signaux. Un praticien qui se connaît peut accueillir l\'autre pleinement.',
                'content'     => $intro,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 1 — L\'écoute de soi',
                'duration'    => '~20 min',
                'description' => 'Écouter l\'autre commence par s\'écouter soi-même. Le scan de 3 minutes comme outil quotidien du praticien.',
                'content'     => $this->card($teal, 'Leçon 1', 'L\'écoute de soi — le premier outil du praticien',
                    '<div style="font-size:.88rem;line-height:2.1;color:rgba(232,224,208,.82);">
                    La plupart des gens vivent dans leur tête.<br>
                    Un praticien Pause Souffle vit dans son corps.<br><br>
                    L\'écoute de soi est une <strong>compétence qui se cultive</strong>.<br>
                    Elle ne s\'apprend pas dans les livres — elle s\'ancre dans la pratique quotidienne.
                    </div>'),
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 2 — Les signaux du corps',
                'duration'    => '~20 min',
                'description' => 'Le dictionnaire des 5 signaux corporels fondamentaux. Apprendre à les lire chez soi avant de les reconnaître chez l\'autre.',
                'content'     => $this->card($blue, 'Leçon 2', 'Les signaux du corps — ton corps te parle déjà',
                    '<div style="font-size:.88rem;line-height:2.1;color:rgba(232,224,208,.82);">
                    Le corps communique en permanence.<br>
                    Avant les mots, avant les pensées — il y a une sensation.<br><br>
                    <strong>Nœud dans la gorge</strong> → quelque chose à dire qui reste bloqué<br>
                    <strong>Pression dans la poitrine</strong> → émotion retenue<br>
                    <strong>Tension dans les épaules</strong> → charge, contrôle<br>
                    <strong>Ventre noué</strong> → insécurité, anxiété<br>
                    <strong>Mâchoires serrées</strong> → colère rentrée
                    </div>'),
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 3 — Les émotions comme informations',
                'duration'    => '~20 min',
                'description' => 'Les 4 émotions fondamentales et leurs expressions corporelles. Ne plus fuir — accueillir, lire, utiliser.',
                'content'     => $this->card($purple, 'Leçon 3', 'Les émotions comme informations',
                    '<div style="font-size:.88rem;line-height:2.1;color:rgba(232,224,208,.82);">
                    Une émotion n\'est pas un problème. C\'est une information.<br><br>
                    <strong>Joie</strong> → expansion · légèreté · envie d\'avancer<br>
                    <strong>Peur</strong> → contraction · protection · signal de danger<br>
                    <strong>Colère</strong> → énergie · limite franchie · besoin de respect<br>
                    <strong>Tristesse</strong> → lourdeur · deuil · besoin d\'intégration<br><br>
                    Aucune n\'est mauvaise. Toutes ont un rôle.
                    </div>'),
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 4 — Le miroir intérieur',
                'duration'    => '~15 min',
                'description' => 'La règle des 3 O : Observer · Objectiver · Ouvrir. L\'auto-observation sans jugement comme compétence fondamentale.',
                'content'     => $this->card($orange, 'Leçon 4', 'Le miroir intérieur',
                    '<div style="font-size:.88rem;line-height:2.1;color:rgba(232,224,208,.82);">
                    L\'auto-observation n\'est pas de l\'égocentrisme.<br>
                    C\'est la compétence la plus rare d\'un praticien corporel.<br><br>
                    <strong>Observer</strong> → ce qui se passe, sans filtre<br>
                    <strong>Objectiver</strong> → "je ressens X" et non "je suis X"<br>
                    <strong>Ouvrir</strong> → laisser évoluer, ne pas fixer
                    </div>'),
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Pratique — Le scan corporel complet',
                'duration'    => '~25 min',
                'description' => 'Protocole de scan 10 minutes : de la tête aux pieds, zone par zone. Observer sans corriger. La présence avant la relaxation.',
                'content'     => $scan,
            ],
            [
                'type'        => 'exercice',
                'title'       => 'Outil quotidien — Le journal de bord du corps',
                'duration'    => '~15 min',
                'description' => '3 questions chaque matin ou soir. La régularité prime sur la profondeur. Outil que tu transmettras à tes clients.',
                'content'     => $journal,
            ],
            [
                'type'        => 'exercice',
                'title'       => 'Intégration — Mon portrait corporel',
                'duration'    => '~30 min',
                'description' => 'Synthèse du module : 5 phrases à compléter sur soi. La zone habitée, la zone ignorée, l\'émotion dominante, le signal appris, l\'observation prioritaire.',
            ],
            [
                'type'        => 'reflexion',
                'title'       => 'Lettre à mon corps — clôture du module',
                'duration'    => '~20 min',
                'description' => 'Commence par : "Corps, je t\'ai écouté différemment cette semaine. Voici ce que j\'ai découvert..."',
            ],
        ];

        DB::table('formation_modules')
            ->where('slug', '01-je-me-rencontre')
            ->update([
                'intro_text'  => "JE ME RENCONTRE — Le Voyage Intérieur du Praticien\n\nAvant d'accompagner quelqu'un, tu dois avoir fait ce voyage toi-même.\n\nSe rencontrer, s'observer, reconnaître ses signaux corporels.\nPas une thérapie. Un rendez-vous avec soi — à travers le corps.",
                'description' => '4 leçons · Scan corporel complet · Journal de bord · Portrait corporel · Lettre au corps. L\'auto-connaissance corporelle comme fondation de la pratique.',
                'activities'  => json_encode($activities),
                'updated_at'  => now(),
            ]);

        $this->command->info('[FormationModule01Seeder] ✓ 9 activités — Je me rencontre.');
    }
}
