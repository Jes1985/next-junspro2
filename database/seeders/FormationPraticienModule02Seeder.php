<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * MODULE 02 — Je maîtrise les outils du souffle
 * Formation Praticien · Condensé des modules 04-05-06 du Parcours
 * Arc pédagogique : techniques respiratoires · mission incarnée · vision professionnelle
 * Prisme professionnel : boîte à outils complète du praticien Pause Souffle
 */
class FormationPraticienModule02Seeder extends Seeder
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

        $intro = $this->card($gold, 'Module 02 · Praticien', 'Trois fondations — une pratique',
            '<div style="font-size:.88rem;line-height:2.1;color:rgba(232,224,208,.82);">
            Ce module condense trois voyages du Parcours :<br><br>
            <strong>Module 04 — Le souffle :</strong> les 7 techniques thérapeutiques<br>
            <strong>Module 05 — La mission :</strong> l\'Ikigaï incarné dans le corps<br>
            <strong>Module 06 — La vision :</strong> l\'ancrage de la direction dans le réel<br><br>
            Avec un filtre unique : <strong>le prisme professionnel du praticien.</strong><br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;border:1px solid rgba(201,168,76,.15);margin:.75rem 0;">
            La compétence la plus rare d\'un praticien corporel ?<br>
            Pas la technique. Pas la science.<br>
            <strong>Savoir quand utiliser quel outil — et pourquoi.</strong><br><br>
            Un marteau sans clou, c\'est inutile.<br>
            Un praticien sans mission, c\'est épuisant.<br>
            Un praticien sans vision de sa pratique, c\'est perdu dans un an.
            </div>
            À la fin de ce module :<br>
            · Vous maîtrisez 7 techniques respiratoires et savez quand les utiliser<br>
            · Vous avez rédigé votre mission de praticien en une phrase incarnée<br>
            · Vous avez ancré votre vision professionnelle dans un tableau de vie
            </div>'
        );

        $outils_souffle = $this->card($teal, 'Leçon 1', 'Les 7 techniques du praticien — quand utiliser quoi',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Un praticien ne "fait respirer" pas. Il <strong>choisit</strong> une technique en fonction de l\'état du client.<br><br>
            <div style="background:rgba(20,184,166,.07);border-radius:10px;padding:.85rem 1.1rem;display:flex;flex-direction:column;gap:.8rem;margin:.75rem 0;">
            <div>
            <strong style="color:rgba(20,184,166,.9);">① Cohérence cardiaque 5-5 · Usage : ouverture/clôture de séance</strong><br>
            5s inspire · 5s expire. 5 min = 30 cycles. Active le parasympathique. Idéal pour toute séance.
            </div>
            <div>
            <strong style="color:rgba(20,184,166,.9);">② Pause Souffle 5-5-5 · Usage : ancrage au cœur de la séance</strong><br>
            5s inspire · 5s retenir · 5s expire. Le protocole signature Pause Souffle. Crée l\'espace de présence.
            </div>
            <div>
            <strong style="color:rgba(20,184,16,.9);">③ Box Breathing 4-4-4-4 · Usage : client en état de stress aigu</strong><br>
            Inspire 4s · retenir 4s · expire 4s · retenir 4s. Technique Navy SEALs. Reset immédiat.
            </div>
            <div>
            <strong style="color:rgba(20,184,166,.9);">④ Souffle 4-7-8 · Usage : client anxieux, insomniaque</strong><br>
            Inspire 4s · retenir 7s · expire 8s. Effet sédatif puissant. Max 4 cycles par session.
            </div>
            <div>
            <strong style="color:rgba(20,184,166,.9);">⑤ Ujjayi · Usage : ancrage profond, chaleur intérieure</strong><br>
            Inspiration et expiration par le nez, légère constriction de la gorge. Son de l\'océan. Chaleur et présence.
            </div>
            <div>
            <strong style="color:rgba(20,184,166,.9);">⑥ Soupir physiologique · Usage : reset express 30 secondes</strong><br>
            Double inspiration courte par le nez + longue expiration bouche. Reset neurologique instantané.
            </div>
            <div>
            <strong style="color:rgba(20,184,166,.9);">⑦ Respiration alternée (Nadi Shodhana) · Usage : équilibre après émotion forte</strong><br>
            Narine droite · narine gauche, alternance. Harmonise les deux hémisphères. Clarté mentale.
            </div>
            </div>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.75rem 1rem;border:1px solid rgba(201,168,76,.15);margin-top:.75rem;">
            <strong style="color:rgba(201,168,76,.9);">La règle du praticien :</strong><br>
            Maîtriser d\'abord chaque technique sur soi. Pendant 7 jours minimum chacune.<br>
            <em>On ne transmet bien que ce qu\'on a soi-même traversé.</em>
            </div>
            </div>
            <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(20,184,166,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
            🎙 <strong style="color:rgba(20,184,166,.8);">Script audio ·</strong>
            <em>"Chaque technique a son moment. Votre travail n\'est pas de toutes les utiliser dans une séance. C\'est de sentir laquelle correspond à l\'état de l\'autre en ce moment précis. Ça, ça vient avec la pratique — et avec votre propre connaissance du souffle."</em>
            </div>'
        );

        $mission_praticien = $this->card($purple, 'Leçon 2', 'La mission du praticien — une phrase qui tient dans les jours difficiles',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Tout le monde peut apprendre à guider une respiration.<br>
            Ce qui distingue un praticien qui dure d\'un praticien qui abandonne en 18 mois ?<br>
            <strong>Une mission incarnée — pas intellectuelle.</strong><br><br>
            <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;border:1px solid rgba(168,85,247,.12);">
            <strong style="color:rgba(168,85,247,.9);">La structure Ikigaï du praticien :</strong><br><br>
            <strong>Ce que vous avez traversé</strong> (votre expérience vécue)<br>
            +&nbsp;<strong>Ce que vous faites avec une facilité naturelle</strong> (votre don)<br>
            +&nbsp;<strong>Ce dont vos clients ont besoin</strong> (le problème que vous résolvez)<br>
            = <strong>Votre mission singulière de praticien</strong>
            </div>
            <strong>La phrase-mission du praticien :</strong><br>
            <em style="color:rgba(168,85,247,.9);">"J\'accompagne [qui précisément] à [quoi exactement] grâce à [votre méthode ou don] pour que [transformation concrète]."</em><br><br>
            <strong>Exemples réels :</strong><br>
            · "J\'accompagne les dirigeants sous pression à retrouver leur clarté grâce au souffle et à la présence corporelle, pour qu\'ils décident depuis leur centre."<br>
            · "J\'accompagne les femmes qui ont donné à tout le monde sauf à elles-mêmes, à se reconnecter à leur corps grâce à la Pause Souffle, pour qu\'elles puissent enfin se choisir."<br><br>
            <strong style="color:rgba(239,68,68,.8);">Test de validation :</strong><br>
            Si votre phrase ne crée pas une légère vibration dans la poitrine quand vous la lisez — ce n\'est pas encore la bonne.
            </div>
            <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(168,85,247,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
            🎙 <strong style="color:rgba(168,85,247,.8);">Script audio ·</strong>
            <em>"Imaginez la personne que vous aidez le mieux. Pas la cliente idéale. Celle qui vous ressemble — avant. Celle dont vous comprenez instinctivement la douleur parce que vous l\'avez connue. C\'est elle votre mission. Nommez-la maintenant."</em>
            </div>'
        );

        $vision_praticien = $this->card($orange, 'Leçon 3', 'La vision de la pratique — dans 3 ans, à quoi ressemble votre journée ?',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            La vision n\'est pas un objectif chiffré.<br>
            C\'est une <strong>scène concrète</strong> — à laquelle vous pouvez retourner quand la route est longue.<br><br>
            <strong>La vision en 5 territoires de la pratique :</strong><br><br>
            <strong style="color:rgba(249,115,22,.9);">① Le client idéal</strong><br>
            Qui est-il/elle ? Quel est son état avant de vous rencontrer ? Comment est-il/elle après ?<br><br>
            <strong style="color:rgba(249,115,22,.9);">② Le cadre de la pratique</strong><br>
            Où pratiquez-vous ? À domicile, cabinet, retraites ? Seul·e ou en groupe ?<br>
            Décrivez l\'espace — les textures, la lumière, l\'atmosph​ère.<br><br>
            <strong style="color:rgba(249,115,22,.9);">③ L\'impact concret</strong><br>
            Une phrase qu\'un client vous a dite qui vous prouve que votre travail a compté.<br><br>
            <strong style="color:rgba(249,115,22,.9);">④ L\'équilibre de vie</strong><br>
            Combien de séances par semaine ? Quel temps pour votre propre pratique ?<br>
            La pratique dure si elle nourrit aussi le praticien.<br><br>
            <strong style="color:rgba(249,115,22,.9);">⑤ La transmission</strong><br>
            Dans 5 ans, transmettez-vous à d\'autres ? Formez-vous ? Créez-vous une communauté ?<br><br>
            <div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.75rem 1rem;margin-top:.75rem;">
            <strong>Ancrage Pause Souffle :</strong><br>
            Fermez les yeux. Choisissez le territoire le plus fort de votre vision.<br>
            Entrez dans la scène avec tous vos sens. Laissez l\'émotion monter.<br>
            3 cycles 5-5-5 depuis l\'intérieur de cette scène.
            </div>
            </div>'
        );

        $pratique_7_techniques = $this->card($blue, 'Pratique', 'Maîtriser les 7 techniques — 35 minutes de terrain',
            '<div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.9rem 1.1rem;border:1px solid rgba(59,130,246,.12);">
            <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(59,130,246,.55);margin-bottom:.75rem;">─ Séquence pratique complète ─</div>
            <strong>① Observation (3 min)</strong> → Quel est mon souffle naturel en ce moment ?<br>
            <strong>② Cohérence 5-5 (5 min)</strong> → 30 cycles. Note l\'état avant/après.<br>
            <strong>③ Pause Souffle 5-5-5 (5 min)</strong> → Avec intention : libérer / accueillir / connecter.<br>
            <strong>④ Box Breathing (3 min)</strong> → 6 cycles. Clarté immédiate.<br>
            <strong>⑤ 4-7-8 (3 min)</strong> → 4 cycles. État de calme profond.<br>
            <strong>⑥ Ujjayi (3 min)</strong> → Yeux fermés. Son de l\'océan.<br>
            <strong>⑦ Alternée (3 min)</strong> → 5 cycles chaque côté.<br>
            <strong>⑧ Soupir physiologique (1 min)</strong> → 3 cycles. Reset final.<br>
            <strong>⑨ Observation finale (5 min)</strong> → Qu\'est-ce qui a changé ?<br><br>
            <em>Pour chaque technique : noter celle qui te parle le plus, celle qui te déstabilise, celle que tu utiliserais avec tel type de client.</em>
            </div>'
        );

        $protocole_personnel = $this->card($green, 'Intégration', 'Mon protocole souffle · ma mission · ma vision — les 3 piliers de ma pratique',
            '<div style="font-size:.85rem;line-height:2.2;color:rgba(232,224,208,.82);">
            <div style="background:rgba(34,197,94,.06);border-radius:10px;padding:.85rem 1.1rem;margin-bottom:.75rem;">
            <strong>MON PROTOCOLE SOUFFLE :</strong><br>
            Ouverture de séance : ___<br>
            Client anxieux : ___<br>
            Client dans la tête (déconnecté) : ___<br>
            Après exploration émotionnelle : ___<br>
            Clôture de séance : ___<br>
            </div>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;margin-bottom:.75rem;border:1px solid rgba(201,168,76,.15);">
            <strong style="color:rgba(201,168,76,.9);">MA MISSION EN UNE PHRASE :</strong><br>
            "J\'accompagne ___ à ___ grâce à ___ pour que ___"<br>
            </div>
            <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.85rem 1.1rem;border:1px solid rgba(168,85,247,.12);">
            <strong style="color:rgba(168,85,247,.9);">MA SCÈNE DE VISION (5 ans) :</strong><br>
            Lieu : ___ · Type de clients : ___ · Impact : ___ · Équilibre : ___<br>
            </div>
            <br>
            <em style="color:rgba(34,197,94,.8);">Ces 3 éléments forment la colonne vertébrale de votre pratique.<br>
            Revenez-y chaque fois que vous doutez de la direction.</em>
            </div>'
        );

        $activities = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — Trois fondations, une pratique',
                'duration'    => '15 min',
                'description' => 'Souffle · Mission · Vision : les 3 piliers du praticien qui dure. Pourquoi la technique sans mission s\'épuise. Pourquoi la mission sans vision se perd.',
                'content'     => $intro,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 1 — Les 7 techniques du praticien',
                'duration'    => '30 min',
                'description' => 'Cohérence 5-5 · Pause Souffle 5-5-5 · Box Breathing · 4-7-8 · Ujjayi · Soupir physiologique · Alternée. Quand utiliser chaque technique en séance.',
                'content'     => $outils_souffle,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 2 — La mission du praticien',
                'duration'    => '25 min',
                'description' => 'L\'Ikigaï du praticien : expérience vécue + don naturel + besoin du client. La phrase-mission en une ligne. Le test de validation corporel.',
                'content'     => $mission_praticien,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 3 — La vision de la pratique',
                'duration'    => '20 min',
                'description' => 'La scène concrète dans 3 ans : client idéal · cadre · impact · équilibre · transmission. Ancrage 5-5-5 dans la vision.',
                'content'     => $vision_praticien,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Pratique — Les 7 techniques en 35 minutes',
                'duration'    => '35 min',
                'description' => 'Séquence complète : observation → cohérence → 5-5-5 → box → 4-7-8 → ujjayi → alternée → soupir → observation finale. Identifier votre technique signature.',
                'content'     => $pratique_7_techniques,
            ],
            [
                'type'        => 'exercice',
                'title'       => 'Intégration — Protocole souffle · Mission · Vision',
                'duration'    => '30 min',
                'description' => 'Compléter les 3 tableaux : protocole souffle personnalisé · phrase-mission incarnée · scène de vision en 5 territoires. La colonne vertébrale de votre pratique.',
                'content'     => $protocole_personnel,
            ],
            [
                'type'        => 'reflexion',
                'title'       => 'Lettre — Au client que j\'accompagne depuis ma mission',
                'duration'    => '20 min',
                'description' => 'Commence par : "Je sais pourquoi tu viens me voir. Parce que j\'y suis allé avant toi. Et voici ce que je peux t\'offrir que personne d\'autre ne peut t\'offrir de la même façon..."',
            ],
        ];

        DB::table('formation_modules')->updateOrInsert(
            ['slug' => '02-je-maitrise-les-outils-du-souffle', 'track' => 'praticien'],
            [
                'slug'        => '02-je-maitrise-les-outils-du-souffle',
                'title'       => 'Je maîtrise les outils du souffle — Respiration, Mission & Vision',
                'week_label'  => 'Module 02',
                'track'       => 'praticien',
                'order'       => 2,
                'is_active'   => true,
                'intro_text'  => "JE MAÎTRISE LES OUTILS DU SOUFFLE — Module Praticien 02\n\nLe souffle est votre outil principal. La mission est votre direction. La vision est votre cap.\n\nCe module condense les 3 fondations pratiques :\nles 7 techniques respiratoires · la phrase-mission incarnée · la vision de la pratique en 5 territoires.",
                'description' => '7 techniques respiratoires avec indication clinique · Mission en une phrase (Ikigaï praticien) · Vision en 5 territoires. Les 3 piliers du praticien qui dure.',
                'activities'  => json_encode($activities),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        );

        $this->command->info('[FormationPraticienModule02Seeder] ✓ 7 activités — Je maîtrise les outils du souffle.');
    }
}
