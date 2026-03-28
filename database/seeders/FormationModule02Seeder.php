<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * MODULE 2 — Je reconnais mes blessures
 * Arc pédagogique : blessures émotionnelles · mémoire corporelle · cicatrisation consciente
 */
class FormationModule02Seeder extends Seeder
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
            $this->card($gold, 'Promesse', 'Ce que ce module t\'apprend à faire',
                '<div style="font-size:.88rem;line-height:2.1;color:rgba(232,224,208,.82);">
                Le corps se souvient de tout.<br>
                D\'une peur subie à 7 ans.<br>
                D\'une honte portée pendant des années.<br>
                D\'une perte jamais pleurée.<br><br>
                Ce module n\'est pas là pour rouvrir les blessures.<br>
                Il est là pour apprendre à <strong>les reconnaître</strong>.<br><br>
                Reconnaître, c\'est la première étape de la libération.<br><br>
                <em style="color:rgba(201,168,76,.8);">Important : ce module n\'est pas une thérapie. Si une blessure profonde remonte, nous orientons vers un professionnel de santé mentale.</em>
                </div>'
            );

        $blessures =
            $this->card($purple, 'Leçon 1', 'Les 5 blessures fondamentales — ce que le corps porte',
                '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
                Ces 5 blessures universelles ont été identifiées par Lise Bourbeau et enrichies par des décennies de pratique corporelle :<br><br>
                <strong style="color:rgba(168,85,247,.9);">① L\'abandon</strong> → corps : affaissé, en recherche de contact, respiration superficielle<br>
                <strong style="color:rgba(168,85,247,.9);">② Le rejet</strong> → corps : rétracté, épaules vers l\'avant, présence minimale<br>
                <strong style="color:rgba(168,85,247,.9);">③ La trahison</strong> → corps : rigide, mâchoires serrées, thorax fermé<br>
                <strong style="color:rgba(168,85,247,.9);">④ L\'humiliation</strong> → corps : replié, ventre comprimé, regard bas<br>
                <strong style="color:rgba(168,85,247,.9);">⑤ L\'injustice</strong> → corps : hypertendu, dos droit mais rigide, contrôle permanent<br><br>
                <em>Le praticien ne diagnostique pas. Il observe et accueille.</em>
                </div>
                <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(168,85,247,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
                🎙 <strong style="color:rgba(168,85,247,.8);">Script audio ElevenLabs ·</strong>
                <em>"Le corps porte les blessures de l\'âme. Ce n\'est pas une métaphore. C\'est une réalité physiologique. Quand nous avons vécu une expérience douloureuse, elle laisse une empreinte… dans les muscles, dans la posture, dans la façon de respirer. Observez simplement : où est-ce que votre corps se ferme en ce moment ?"</em>
                </div>'
            );

        $memoire =
            $this->card($blue, 'Leçon 2', 'La mémoire du corps — comment les blessures s\'installent',
                '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
                Peter Levine (Waking the Tiger) l\'a démontré :<br>
                <strong>le corps garde la trace des expériences non intégrées.</strong><br><br>
                Mécanisme :<br>
                1. Expérience difficile → réponse de survie (fuite, combat, gel)<br>
                2. Si la réponse n\'est pas complétée → tension résiduelle stockée<br>
                3. La tension devient chronique → posture, douleur, respiration bloquée<br><br>
                Ce n\'est pas une faiblesse. C\'est le corps qui a fait son travail de protection.
                </div>
                <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(59,130,246,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
                🎙 <strong style="color:rgba(59,130,246,.8);">Script audio ElevenLabs ·</strong>
                <em>"Le corps n\'oublie jamais. Mais il peut apprendre à laisser partir. Ce n\'est pas une question de volonté. C\'est une question de sécurité. Quand le corps se sent en sécurité, il libère naturellement ce qu\'il retenait."</em>
                </div>'
            );

        $armures =
            $this->card($orange, 'Leçon 3', 'Les armures corporelles — protections devenues prisons',
                '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
                Wilhelm Reich a découvert le concept d\'<strong>armure musculaire</strong> :<br>
                des tensions chroniques organisées pour protéger l\'individu d\'émotions insupportables.<br><br>
                Les 7 segments d\'armure (de haut en bas) :<br>
                <strong>① Oculaire</strong> → yeux figés, regard vide ou fuyant<br>
                <strong>② Oral</strong> → mâchoires serrées, lèvres pincées<br>
                <strong>③ Cervical</strong> → cou rigide, voix contrainte<br>
                <strong>④ Thoracique</strong> → poitrine fermée, respiration haute<br>
                <strong>⑤ Diaphragmatique</strong> → coupure entre le haut et le bas du corps<br>
                <strong>⑥ Abdominal</strong> → ventre rentré, durci, protégé<br>
                <strong>⑦ Pelvien</strong> → bassin bloqué, marche rigide<br><br>
                <em>Observer l\'armure = comprendre l\'histoire corporelle du client.</em>
                </div>'
            );

        $reconnaitre =
            $this->card($teal, 'Leçon 4', 'Reconnaître sans juger — la posture du praticien',
                '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
                La blessure reconnue perd déjà une partie de son emprise.<br><br>
                Règle d\'or du praticien face à la blessure d\'un client :<br><br>
                <strong>Ne pas nommer ce que le client n\'a pas nommé.</strong><br>
                <strong>Ne pas interpréter. Jamais.</strong><br>
                <strong>Créer l\'espace où la blessure peut se montrer.</strong><br><br>
                La question qui ouvre : <em>"Où est-ce que vous sentez ça dans votre corps ?"</em><br>
                La question qui ferme : <em>"Ça vient de votre enfance, n\'est-ce pas ?"</em>
                </div>'
            );

        $pratique =
            $this->card($green, 'Pratique', 'Localisation des tensions émotionnelles — cartographie personnelle',
                '<div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.85rem 1.1rem;margin-bottom:.75rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(34,197,94,.55);margin-bottom:.5rem;">─ Exercice ─</div>
                Prends une feuille. Dessine un corps (très simple).<br><br>
                <strong>Étape 1</strong> → Pense à une situation difficile récente (légère, pas traumatique).<br>
                <strong>Étape 2</strong> → Localise dans le corps où tu ressens quelque chose.<br>
                <strong>Étape 3</strong> → Note : zone · qualité de la sensation · intensité (1-10).<br>
                <strong>Étape 4</strong> → Respire sur cette zone. Observe si elle change.<br><br>
                <em>Tu viens de faire ta première cartographie émotionnelle.</em>
                </div>'
            );

        $securite =
            $this->card($red, 'Sécurité praticien', 'Ce que tu ne feras jamais avec les blessures d\'un client',
                '<div style="font-size:.85rem;line-height:2.2;color:rgba(232,224,208,.82);">
                <strong style="color:rgba(239,68,68,.9);">⛔ Ne pas rouvrir une blessure sans filet.</strong><br>
                Si un client pleure, tremble, se dissocie → arrêt doux, retour au corps (pieds au sol), sécurité.<br><br>
                <strong style="color:rgba(239,68,68,.9);">⛔ Ne pas interpréter les symptômes comme des blessures identifiées.</strong><br>
                "Vous avez des épaules tendues parce que votre mère…" → Jamais. C\'est du territoire médical/psy.<br><br>
                <strong style="color:rgba(239,68,68,.9);">⛔ Ne pas forcer la libération émotionnelle.</strong><br>
                La libération survient dans la sécurité et le temps — pas dans l\'effort.<br><br>
                <em style="color:rgba(239,68,68,.7);">Ton rôle : créer un espace sûr. Pas diagnostiquer. Pas guérir. Accompagner.</em>
                </div>'
            );

        $activities = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — Le corps qui se souvient',
                'duration'    => '~15 min',
                'description' => 'Le corps garde la trace des expériences non intégrées. Ce module apprend à reconnaître — pas à rouvrir. La reconnaissances est la première étape de la libération.',
                'content'     => $intro,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 1 — Les 5 blessures fondamentales',
                'duration'    => '~25 min',
                'description' => 'Les 5 blessures universelles (abandon, rejet, trahison, humiliation, injustice) et leurs expressions corporelles. Le praticien observe — il ne diagnostique pas.',
                'content'     => $blessures,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 2 — La mémoire du corps',
                'duration'    => '~20 min',
                'description' => 'Comment les blessures s\'installent dans les tissus (Peter Levine). Réponse de survie · tension résiduelle · armure chronique. Ce n\'est pas une faiblesse — c\'est une protection.',
                'content'     => $memoire,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 3 — Les armures corporelles',
                'duration'    => '~25 min',
                'description' => 'Les 7 segments d\'armure musculaire (Reich). Observer l\'armure = comprendre l\'histoire corporelle. Lecture de posture pour le praticien.',
                'content'     => $armures,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 4 — Reconnaître sans juger',
                'duration'    => '~15 min',
                'description' => 'La posture du praticien face à la blessure. Ne pas nommer ce que le client n\'a pas nommé. La question qui ouvre vs la question qui ferme.',
                'content'     => $reconnaitre,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Pratique — Cartographie des tensions émotionnelles',
                'duration'    => '~30 min',
                'description' => 'Exercice personnel : dessiner le corps, localiser les zones de tension émotionnelle, noter la qualité et l\'intensité. Respirer sur chaque zone.',
                'content'     => $pratique,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Sécurité praticien — Ce que tu ne feras jamais',
                'duration'    => '~15 min',
                'description' => 'Les 3 interdits absolus avec les blessures d\'un client. Protocole d\'arrêt doux si dissociation ou larmes intenses.',
                'content'     => $securite,
            ],
            [
                'type'        => 'exercice',
                'title'       => 'Intégration — Ma carte des blessures reconnues',
                'duration'    => '~30 min',
                'description' => 'Synthèse personnelle : quelle blessure résonne le plus en moi ? Où est-ce que je la sens ? Comment est-ce que je l\'ai compensée ? Qu\'est-ce que cela change dans ma pratique ?',
            ],
            [
                'type'        => 'reflexion',
                'title'       => 'Lettre — À la blessure que je reconnais',
                'duration'    => '~20 min',
                'description' => 'Commence par : "Je te reconnais maintenant. Tu m\'as protégé·e à ta façon. Je ne te demande plus de te battre seul·e…"',
            ],
        ];

        DB::table('formation_modules')
            ->where('slug', '02-je-reconnais-mes-blessures')
            ->update([
                'intro_text'  => "JE RECONNAIS MES BLESSURES — La Mémoire Corporelle\n\nLe corps se souvient de tout. D'une peur, d'une honte, d'une perte.\n\nCe module apprend à reconnaître — pas à rouvrir.\nLa reconnaissance est la première étape de la libération.",
                'description' => '4 leçons · Cartographie des tensions émotionnelles · Sécurité praticien · Intégration personnelle. Comprendre la mémoire du corps pour mieux accompagner.',
                'activities'  => json_encode($activities),
                'updated_at'  => now(),
            ]);

        $this->command->info('[FormationModule02Seeder] ✓ 9 activités — Je reconnais mes blessures.');
    }
}
