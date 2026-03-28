<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * MODULE 4 — J'écoute mon souffle intérieur
 * Arc pédagogique : respiration consciente · cohérence cardiaque · souffles thérapeutiques · protocole personnel
 */
class FormationModule04Seeder extends Seeder
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
        $red    = 'rgba(239,68,68,.8)';
        $green  = 'rgba(34,197,94,.8)';
        $indigo = 'rgba(99,102,241,.8)';

        $intro =
            $this->card($gold, 'Promesse', 'Le souffle : l\'outil le plus puissant du praticien',
                '<div style="font-size:.88rem;line-height:2.1;color:rgba(232,224,208,.82);">
                Le souffle est le seul système autonome que tu peux contrôler consciemment.<br><br>
                Cœur, digestion, hormones — ils font leur travail sans toi.<br>
                La respiration — toi seul peux l\'influencer.<br><br>
                Et en l\'influençant, tu influences tout le reste.<br><br>
                Ce module te donne :<br>
                · Comprendre les <strong>3 types de respiration</strong><br>
                · Maîtriser la <strong>cohérence cardiaque</strong><br>
                · Connaître <strong>5 techniques thérapeutiques</strong><br>
                · Construire <strong>ton protocole souffle personnalisé</strong><br><br>
                <em style="color:rgba(201,168,76,.8);">Le souffle est le fil conducteur de chaque séance Pause Souffle. Maîtriser ce module, c\'est maîtriser ton outil principal.</em>
                </div>'
            );

        $types =
            $this->card($teal, 'Leçon 1', 'Les 3 types de respiration — anatomie du souffle',
                '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
                <strong style="color:rgba(20,184,166,.9);">① Respiration thoracique (haute)</strong><br>
                · Mouvement : poitrine monte et descend<br>
                · Signal : stress, urgence, activation du système nerveux sympathique<br>
                · Corps en état : "alerte"<br><br>
                <strong style="color:rgba(20,184,166,.9);">② Respiration abdominale (basse)</strong><br>
                · Mouvement : ventre gonfle à l\'inspiration, rentre à l\'expiration<br>
                · Signal : repos, sécurité, activation parasympathique<br>
                · Corps en état : "sécurité"<br><br>
                <strong style="color:rgba(20,184,166,.9);">③ Respiration complète</strong><br>
                · Mouvement : ventre + côtes + poitrine, vague montante puis descendante<br>
                · Signal : pleine présence, intégration, vitalité<br>
                · Corps en état : "pleine vie"<br><br>
                <em>Observer le type de respiration d\'un client donne plus d\'informations que 10 minutes de questions.</em>
                </div>
                <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(20,184,166,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
                🎙 <strong style="color:rgba(20,184,166,.8);">Script audio ElevenLabs ·</strong>
                <em>"Posez une main sur le ventre, une main sur la poitrine. Inspirez normalement. Quelle main bouge en premier ? Si c\'est la poitrine : vous respirez en thoracique. Si c\'est le ventre : vous êtes en abdominal. Maintenant essayons de faire monter le ventre d\'abord… doucement… sans forcer."</em>
                </div>'
            );

        $coherence =
            $this->card($blue, 'Leçon 2', 'La cohérence cardiaque — 5 minutes qui changent tout',
                '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
                La cohérence cardiaque est l\'état de synchronisation entre le rythme cardiaque et la respiration.<br><br>
                <strong>Protocole 365 (Dr David Servan-Schreiber) :</strong><br>
                · <strong>3</strong> fois par jour<br>
                · <strong>6</strong> respirations par minute (5 secondes inspiration / 5 secondes expiration)<br>
                · <strong>5</strong> minutes<br><br>
                <strong>Effets mesurés en 5 minutes :</strong><br>
                · Baisse du cortisol (hormone du stress)<br>
                · Hausse de la DHEA (hormone de vitalité)<br>
                · Amélioration de la variabilité de la fréquence cardiaque<br>
                · Clarté mentale augmentée<br><br>
                <em>À utiliser en début ou fin de séance avec le client.</em>
                </div>
                <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(59,130,246,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
                🎙 <strong style="color:rgba(59,130,246,.8);">Script audio ElevenLabs ·</strong>
                <em>"Nous allons faire 5 minutes de cohérence cardiaque. Inspirez pendant 5 secondes… 1, 2, 3, 4, 5. Expirez pendant 5 secondes… 1, 2, 3, 4, 5. Inspirez… lentement… expirez… complètement. Laissez le rythme s\'installer naturellement."</em>
                </div>'
            );

        $techniques =
            $this->card($purple, 'Leçon 3', 'Les 5 techniques thérapeutiques — la boîte à outils du souffle',
                '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
                <strong style="color:rgba(168,85,247,.9);">① 4-7-8 (Dr Weil) — Anti-anxiété</strong><br>
                Inspire 4s · Retiens 7s · Expire 8s. Effet sédatif puissant. Max 4 cycles.<br><br>
                <strong style="color:rgba(168,85,247,.9);">② Box Breathing — Anti-stress</strong><br>
                Inspire 4s · Retiens 4s · Expire 4s · Retiens 4s. Protocole Navy SEALs. Clarté immédiate.<br><br>
                <strong style="color:rgba(168,85,247,.9);">③ Souffle Ujjayi — Ancrage</strong><br>
                Inspiration et expiration par le nez, légère constriction de la gorge (son de l\'océan). Chaleur interne.<br><br>
                <strong style="color:rgba(168,85,247,.9);">④ Respiration alternée (Nadi Shodhana) — Équilibre</strong><br>
                Boucher alternativement une narine. Harmonise les deux hémisphères cérébraux.<br><br>
                <strong style="color:rgba(168,85,247,.9);">⑤ Soupir physiologique — Reset immédiat</strong><br>
                Double inspiration courte par le nez + longue expiration par la bouche. Reset du système nerveux en 1 cycle.
                </div>
                <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(168,85,247,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
                🎙 <strong style="color:rgba(168,85,247,.8);">Script audio ElevenLabs ·</strong>
                <em>"Commençons par le plus simple et le plus puissant : le soupir physiologique. Inspirez par le nez… courte deuxième inspiration pour remplir complètement les poumons… puis expirez longtemps par la bouche. C\'est tout. Votre système nerveux vient de se réinitialiser."</em>
                </div>'
            );

        $intention =
            $this->card($orange, 'Leçon 4', 'Le souffle avec intention — aller au-delà de la technique',
                '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
                Une technique sans intention est un exercice de gym.<br>
                Un souffle avec intention devient un acte thérapeutique.<br><br>
                Les 3 intentions possibles dans Pause Souffle :<br><br>
                <strong>· L\'intention de libérer</strong><br>
                "À chaque expiration, je laisse partir ce qui ne m\'appartient plus."<br><br>
                <strong>· L\'intention d\'accueillir</strong><br>
                "À chaque inspiration, j\'accueille ce dont j\'ai besoin maintenant."<br><br>
                <strong>· L\'intention de connecter</strong><br>
                "Ce souffle me relie à quelque chose de plus grand que moi."<br><br>
                <em>Proposer une intention au client en début de séance. Le laisser choisir la sienne.</em>
                </div>
                <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(249,115,22,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
                🎙 <strong style="color:rgba(249,115,22,.8);">Script audio ElevenLabs ·</strong>
                <em>"Avant de commencer, posez votre main sur le cœur. Quelle est votre intention pour cette séance ? Libérer quelque chose ? Accueillir quelque chose ? Juste être présent·e ? Il n\'y a pas de bonne réponse. Laissez venir ce qui vient."</em>
                </div>'
            );

        $pratique =
            $this->card($green, 'Pratique', 'Les 5 souffles en pratique — 30 minutes de terrain',
                '<div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.85rem 1.1rem;margin-bottom:.75rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(34,197,94,.55);margin-bottom:.5rem;">─ Séquence pratique ─</div>
                <strong>① 3 min</strong> → Observation : quel est mon souffle naturel en ce moment ?<br>
                <strong>② 5 min</strong> → Cohérence cardiaque : 6 respirations/min<br>
                <strong>③ 3 min</strong> → 4-7-8 : 4 cycles<br>
                <strong>④ 3 min</strong> → Box Breathing : 6 cycles<br>
                <strong>⑤ 3 min</strong> → Ujjayi : yeux fermés, son de l\'océan<br>
                <strong>⑥ 3 min</strong> → Respiration alternée : 5 cycles chaque côté<br>
                <strong>⑦ 5 min</strong> → Observation finale : qu\'est-ce qui a changé ?<br><br>
                <em>Note tes observations à chaud. Certaines techniques te parlent plus que d\'autres — ce sera la base de ton protocole personal.</em>
                </div>'
            );

        $protocole =
            $this->card($indigo, 'Intégration', 'Mon protocole souffle personnalisé',
                '<div style="font-size:.85rem;line-height:2.2;color:rgba(232,224,208,.82);">
                Construis ton protocole en répondant à ces questions :<br><br>
                <strong>La technique que j\'utilise en ouverture de séance :</strong> ___<br>
                <strong>La technique pour un client anxieux :</strong> ___<br>
                <strong>La technique pour un client dans la tête (déconnecté du corps) :</strong> ___<br>
                <strong>La technique pour clôturer une séance :</strong> ___<br>
                <strong>Mon souffle de référence (celui que je pratique moi chaque jour) :</strong> ___<br><br>
                <em style="color:rgba(99,102,241,.8);">Ce protocole n\'est pas gravé dans le marbre. Il évolue avec ta pratique. Révise-le dans 3 mois.</em>
                </div>'
            );

        $activities = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — Le souffle, outil principal du praticien',
                'duration'    => '~15 min',
                'description' => 'Le seul système autonome contrôlable consciemment. Ce module donne les 3 types, la cohérence cardiaque, 5 techniques, et le protocole personnel.',
                'content'     => $intro,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 1 — Les 3 types de respiration',
                'duration'    => '~25 min',
                'description' => 'Thoracique (alerte) · Abdominale (sécurité) · Complète (pleine vie). Lire le souffle d\'un client = comprendre son état intérieur.',
                'content'     => $types,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 2 — La cohérence cardiaque',
                'duration'    => '~20 min',
                'description' => 'Protocole 365 (Dr Servan-Schreiber). 5 minutes · 6 respirations/min. Effets mesurés sur le cortisol, la DHEA et la variabilité cardiaque.',
                'content'     => $coherence,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 3 — Les 5 techniques thérapeutiques',
                'duration'    => '~30 min',
                'description' => '4-7-8 · Box Breathing · Ujjayi · Nadi Shodhana · Soupir physiologique. Quand utiliser chaque technique en séance.',
                'content'     => $techniques,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 4 — Le souffle avec intention',
                'duration'    => '~15 min',
                'description' => 'Les 3 intentions (libérer · accueillir · connecter). Une technique sans intention est un exercice. Avec intention, c\'est un acte thérapeutique.',
                'content'     => $intention,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Pratique — Les 5 souffles en 30 minutes',
                'duration'    => '~35 min',
                'description' => 'Séquence complète : observation → cohérence → 4-7-8 → box → ujjayi → alternée → observation finale. Base de ton protocole personnel.',
                'content'     => $pratique,
            ],
            [
                'type'        => 'exercice',
                'title'       => 'Intégration — Mon protocole souffle',
                'duration'    => '~25 min',
                'description' => '5 questions pour construire ton protocole : ouverture, client anxieux, client déconnecté, clôture, souffle quotidien personnel.',
                'content'     => $protocole,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Pratique avancée — Guider le souffle d\'un autre',
                'duration'    => '~30 min',
                'description' => 'Exercice en binôme ou en solo face à un miroir. Verbaliser une technique à voix haute. Ajuster le rythme, la voix, les pauses. La qualité de ta voix est ton outil.',
            ],
            [
                'type'        => 'reflexion',
                'title'       => 'Lettre — Ce que le souffle m\'a appris sur moi',
                'duration'    => '~20 min',
                'description' => 'Commence par : "En pratiquant ces souffles, j\'ai découvert que mon corps…"',
            ],
        ];

        DB::table('formation_modules')
            ->where('slug', '04-j-ecoute-mon-souffle')
            ->update([
                'intro_text'  => "J'ÉCOUTE MON SOUFFLE INTÉRIEUR — La Maîtrise du Souffle Thérapeutique\n\nLe souffle est le seul système autonome que tu peux contrôler consciemment.\nEn l'influençant, tu influences tout le reste.\n\n3 types de respiration · Cohérence cardiaque · 5 techniques · Ton protocole.",
                'description' => '4 leçons · Pratique des 5 souffles · Protocole personnel · Guider le souffle d\'un autre. Le souffle comme outil principal de chaque séance Pause Souffle.',
                'activities'  => json_encode($activities),
                'updated_at'  => now(),
            ]);

        $this->command->info('[FormationModule04Seeder] ✓ 9 activités — J\'écoute mon souffle.');
    }
}
