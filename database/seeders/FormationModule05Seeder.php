<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * MODULE 5 — Je découvre ma mission unique
 * Arc pédagogique : valeurs profondes · dons naturels · ikigai corporel · mission en une phrase
 */
class FormationModule05Seeder extends Seeder
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

        $intro =
            $this->card($gold, 'Promesse', 'Pourquoi ce module change tout',
                '<div style="font-size:.88rem;line-height:2.1;color:rgba(232,224,208,.82);">
                Un praticien qui ne sait pas pourquoi il fait ce qu\'il fait finit par s\'épuiser.<br><br>
                Un praticien qui connaît sa mission tient sur la durée.<br>
                Il rayonne. Il attire les bons clients. Il transforme les vies.<br><br>
                Ce module ne te demande pas de tout changer dans ta vie.<br>
                Il te demande de nommer <strong>ce qui est déjà là</strong>.<br><br>
                <em style="color:rgba(201,168,76,.8);">"Ce n\'est pas votre métier qui vous donne votre mission. C\'est votre mission qui transforme votre métier." — Viktor Frankl (adapté)</em>
                </div>'
            );

        $valeurs =
            $this->card($purple, 'Leçon 1', 'Tes valeurs profondes — le socle de ta pratique',
                '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
                Les valeurs ne sont pas des idéaux abstraits.<br>
                Ce sont des <strong>réalités vécues dans le corps</strong>.<br><br>
                Quand vous agissez selon vos valeurs : légèreté, clarté, énergie.<br>
                Quand vous trahissez vos valeurs : lourdeur, malaise, tension dans la poitrine.<br><br>
                <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.75rem 1rem;margin-top:.75rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(168,85,247,.55);margin-bottom:.5rem;">─ Exercice de découverte ─</div>
                Complète ces 3 phrases :<br>
                <strong>① "Je ne supporte pas quand…"</strong> (l\'opposé = ta valeur)<br>
                <strong>② "Je suis vraiment vivant·e quand je…"</strong> (action = ta valeur en acte)<br>
                <strong>③ "Les moments dont je suis le plus fier·e sont…"</strong> (contexte = ta valeur récompensée)<br>
                </div>
                </div>
                <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(168,85,247,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
                🎙 <strong style="color:rgba(168,85,247,.8);">Script audio ElevenLabs ·</strong>
                <em>"Placez une main sur votre cœur. Pensez à quelque chose qui vous tient vraiment à cœur. Quelque chose pour lequel vous seriez prêt·e à vous battre. Comment votre corps réagit-il ? C\'est ça, une valeur profonde — elle parle avant que vous pensiez."</em>
                </div>'
            );

        $dons =
            $this->card($teal, 'Leçon 2', 'Tes dons naturels — ce que tu fais sans effort',
                '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
                Un don naturel est une compétence qui te coûte peu d\'énergie<br>
                mais qui en apporte beaucoup à ceux qui la reçoivent.<br><br>
                Ironiquement, les dons naturels sont souvent invisibles à ceux qui les possèdent.<br>
                "Mais tout le monde fait ça, non ?" — Non. C\'est précisément pour ça que c\'est un don.<br><br>
                <strong>Les 4 indices d\'un don naturel :</strong><br>
                · Le temps disparaît quand tu l\'utilises (état de flow)<br>
                · Les autres te remercient pour quelque chose qui te semble évident<br>
                · Tu t\'énerves quand tu vois quelqu\'un ne pas faire ce que tu trouves "si simple"<br>
                · Tu as commencé à le faire spontanément, sans apprendre
                </div>'
            );

        $ikigai =
            $this->card($orange, 'Leçon 3', 'L\'Ikigai adapté au praticien Pause Souffle',
                '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
                L\'Ikigai japonais : la raison d\'être se trouve à l\'intersection de 4 cercles.<br><br>
                <strong>① Ce que tu aimes</strong> (passion)<br>
                <strong>② Ce dont le monde a besoin</strong> (mission)<br>
                <strong>③ Ce pour quoi tu peux être payé·e</strong> (vocation)<br>
                <strong>④ Ce en quoi tu es doué·e</strong> (profession)<br><br>
                Pour un praticien Pause Souffle, la question centrale est :<br>
                <em style="color:rgba(249,115,22,.9);">"Quel type de voyage intérieur suis-je le mieux équipé·e pour guider ?"</em><br><br>
                Pas "que puis-je faire" — mais "qui suis-je quand j\'aide vraiment bien quelqu\'un ?"
                </div>
                <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(249,115,22,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
                🎙 <strong style="color:rgba(249,115,22,.8);">Script audio ElevenLabs ·</strong>
                <em>"Imaginez la personne que vous aidez le mieux. Pas la personne idéale. Celle qui ressemble à ce que vous étiez avant. Celui ou celle dont vous comprenez instinctivement la douleur. Sentez dans votre corps ce que vous ressentez quand vous aidez cette personne à avancer. C\'est là que se trouve votre mission."</em>
                </div>'
            );

        $corps_mission =
            $this->card($blue, 'Leçon 4', 'La mission ancrée dans le corps — pas dans la tête',
                '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
                Une mission intellectuelle ne résiste pas aux jours difficiles.<br>
                Une mission ancrée dans le corps, oui.<br><br>
                La différence :<br>
                <strong>Mission intellectuelle</strong> → "Je veux aider les gens à aller mieux."<br>
                <strong>Mission incarnée</strong> → "Quand j\'aide quelqu\'un à retrouver son souffle, je sens une chaleur dans ma poitrine et je sais que c\'est exactement là où je dois être."<br><br>
                Nous allons construire ta mission incarnée.<br>
                Elle tient en une phrase — précise, corporelle, unique.
                </div>'
            );

        $exercice_ikigai =
            $this->card($green, 'Pratique', 'L\'exercice Ikigai en 4 étapes — 45 minutes',
                '<div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.85rem 1.1rem;margin-bottom:.75rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(34,197,94,.55);margin-bottom:.5rem;">─ Séquence ─</div>
                <strong>Étape 1 (10 min)</strong> → Liste 10 choses que tu aimes vraiment faire. Pas ce que tu "devrais" aimer.<br>
                <strong>Étape 2 (10 min)</strong> → Liste 5 problèmes du monde que tu trouves insupportables et que tu pourrais contribuer à résoudre.<br>
                <strong>Étape 3 (10 min)</strong> → Liste 5 compétences que les autres reconnaissent chez toi (demande à 3 proches si tu ne sais pas).<br>
                <strong>Étape 4 (15 min)</strong> → Cherche l\'intersection. Qu\'est-ce qui apparaît dans les 3 listes à la fois ?<br><br>
                <em>Ce qui se trouve dans les 3 cercles simultanément — c\'est là que vit ta mission.</em>
                </div>'
            );

        $mission_phrase =
            $this->card($indigo, 'Intégration', 'Ma mission en une phrase — l\'ancre de ma pratique',
                '<div style="font-size:.85rem;line-height:2.2;color:rgba(232,224,208,.82);">
                La structure de la phrase :<br><br>
                <em style="color:rgba(99,102,241,.9);">"J\'accompagne [qui] à [quoi] grâce à [comment] pour que [pourquoi]."</em><br><br>
                Exemples :<br>
                "J\'accompagne les femmes épuisées à retrouver leur souffle grâce au toucher et à la respiration consciente, pour qu\'elles puissent se choisir à nouveau."<br><br>
                "J\'accompagne les hommes sous pression à reconnecter leur corps et leur tête grâce au mouvement doux et au souffle, pour qu\'ils puissent agir depuis leur centre."<br><br>
                <strong>Règle :</strong> Si ta phrase ne te fait pas légèrement vibrer dans la poitrine — ce n\'est pas encore la bonne.
                </div>'
            );

        $activities = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — Ta mission change tout',
                'duration'    => '~15 min',
                'description' => 'Un praticien qui ne sait pas pourquoi il fait ce qu\'il fait finit par s\'épuiser. Un praticien qui connaît sa mission tient sur la durée et rayonne.',
                'content'     => $intro,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 1 — Tes valeurs profondes',
                'duration'    => '~25 min',
                'description' => 'Les valeurs sont des réalités vécues dans le corps (légèreté vs lourdeur). 3 exercices pour les identifier sans se raconter d\'histoires.',
                'content'     => $valeurs,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 2 — Tes dons naturels',
                'duration'    => '~20 min',
                'description' => 'Un don naturel : peu d\'énergie pour toi, beaucoup de valeur pour l\'autre. Les 4 indices pour les reconnaître.',
                'content'     => $dons,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 3 — L\'Ikigai adapté au praticien',
                'duration'    => '~20 min',
                'description' => 'Les 4 cercles de l\'Ikigai. La question centrale : quel type de voyage intérieur suis-je le mieux équipé·e pour guider ?',
                'content'     => $ikigai,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 4 — La mission ancrée dans le corps',
                'duration'    => '~15 min',
                'description' => 'Mission intellectuelle vs mission incarnée. La différence tient dans une sensation. Construire une mission qui résiste aux jours difficiles.',
                'content'     => $corps_mission,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Pratique — L\'exercice Ikigai en 4 étapes',
                'duration'    => '~45 min',
                'description' => 'Ce que j\'aime · Ce dont le monde a besoin · Ce pour quoi je suis doué·e. L\'intersection des 3 cercles révèle la mission.',
                'content'     => $exercice_ikigai,
            ],
            [
                'type'        => 'exercice',
                'title'       => 'Intégration — Ma mission en une phrase',
                'duration'    => '~30 min',
                'description' => '"J\'accompagne [qui] à [quoi] grâce à [comment] pour que [pourquoi]." Si la phrase ne fait pas vibrer la poitrine, ce n\'est pas encore la bonne.',
                'content'     => $mission_phrase,
            ],
            [
                'type'        => 'reflexion',
                'title'       => 'Lettre — À la personne que j\'accompagne',
                'duration'    => '~20 min',
                'description' => 'Commence par : "Je t\'ai imaginé·e. Je sais qui tu es. Je sais pourquoi tu viens me voir. Voici ce que je t\'offre…"',
            ],
        ];

        DB::table('formation_modules')
            ->where('slug', '05-je-decouvre-ma-mission')
            ->update([
                'intro_text'  => "JE DÉCOUVRE MA MISSION UNIQUE — La Raison d'Être du Praticien\n\nUn praticien qui connaît sa mission tient sur la durée.\nIl rayonne. Il attire les bons clients. Il transforme les vies.\n\nValeurs profondes · Dons naturels · Ikigai corporel · Mission en une phrase.",
                'description' => '4 leçons · Exercice Ikigai · Mission incarnée. Nommer ce qui est déjà là — et le transformer en intention de pratique.',
                'activities'  => json_encode($activities),
                'updated_at'  => now(),
            ]);

        $this->command->info('[FormationModule05Seeder] ✓ 8 activités — Je découvre ma mission unique.');
    }
}
