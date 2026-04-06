<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * MODULE PRATICIEN 16 — L'Argent du Soin
 * Formation Praticien Freelance · Module 12 (compte rond)
 * Arc pédagogique : psychologie de l'argent dans le soin ·
 *                   prix avec souveraineté · appel découverte · programme vs séance ·
 *                   revenus récurrents · pratique durable
 */
class FormationPraticienModule16Seeder extends Seeder
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

        // ── INTRO ──────────────────────────────────────────────────────────────
        $intro = $this->card($gold, 'Module 16 · Le Chaînon Manquant', 'La raison pour laquelle des praticiens brillants abandonnent',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Ce module ne parle pas de techniques de souffle.<br>
            Il parle de quelque chose que presque aucune formation bien-être n\'aborde jamais :<br><br>
            <div style="background:rgba(239,68,68,.07);border-radius:10px;padding:.9rem 1.2rem;border:1px solid rgba(239,68,68,.18);margin:.75rem 0;">
            <strong>La statistique que personne ne vous dit :</strong><br><br>
            90% des praticiens en arts du soin <strong>abandonnent dans les 3 premières années</strong>.<br>
            Pas par manque de talent. Pas par manque de passion.<br><br>
            Par incapacité à avoir <em>la conversation sur l\'argent</em><br>
            sans se sentir corrompus.<br><br>
            Ils sous-facturent par culpabilité.<br>
            Ils s\'épuisent à donner plus que ce qu\'ils reçoivent.<br>
            Ils finissent par détester quelque chose qu\'ils aimaient profondément.
            </div>
            Ce module est le chaînon manquant entre une formation brillante et une pratique durable.<br><br>
            Il ne vous rend pas "commercial".<br>
            Il vous rend <strong>libre</strong>.
            </div>'
        );

        // ── LEÇON 1 : La Psychologie de l'Argent dans le Soin ────────────────
        $psychologie = $this->card($teal, 'Leçon 1', 'La Psychologie de l\'Argent dans le Soin — les croyances qui sabotent',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            <div style="display:flex;flex-direction:column;gap:.95rem;margin:.75rem 0;">
            <div style="background:rgba(239,68,68,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(239,68,68,.5);">
            <strong style="color:rgba(239,68,68,.8);">Croyance saboteuse n°1 : "Je ne peux pas facturer cher quelque chose de spirituel"</strong><br>
            Origine : confusion entre la valeur du don et la valeur du service.<br>
            Réalité : votre temps, votre formation, votre espace et votre soin ont une valeur économique réelle.<br>
            Un plombier qui répare ce qui fuit dans votre maison est précieux. Un praticien qui répare ce qui fuit dans votre corps l\'est autant.<br>
            <em>Le "spirituel" ne justifie pas la précarité.</em>
            </div>
            <div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(249,115,22,.5);">
            <strong style="color:rgba(249,115,22,.8);">Croyance saboteuse n°2 : "Si je facture peu, les gens seront plus nombreux à venir"</strong><br>
            L\'inverse est souvent vrai.<br>
            Un prix trop bas communique une valeur faible. Les clients investissent plus dans ce qu\'ils valorisent.<br>
            Un client qui paie 50€ une séance annule plus facilement qu\'un client qui en a payé 150€.<br>
            <em>Le prix est un signal de valeur. Pas seulement pour vous — pour votre client.</em>
            </div>
            <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(168,85,247,.5);">
            <strong style="color:rgba(168,85,247,.8);">Croyance saboteuse n°3 : "Si je gagne bien ma vie, je perds mon intégrité"</strong><br>
            Cette croyance fait des ravages dans le monde du soin.<br>
            Réalité : un praticien financièrement épuisé ne peut pas servir pleinement.<br>
            La durabilité financière <em>est</em> un acte de service envers vos clients.<br>
            <em>Vous ne pouvez pas donner de l\'eau si votre puits est vide.</em>
            </div>
            <div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(34,197,94,.5);">
            <strong style="color:rgba(34,197,94,.8);">La vérité libératrice :</strong><br>
            Votre prix juste n\'est pas le plus bas que vous osez demander.<br>
            C\'est le prix auquel vous pouvez travailler avec <strong>toute votre énergie et toute votre présence</strong>,<br>
            sans ressentiment, sans épuisement, sur plusieurs années.
            </div>
            </div>
            </div>'
        );

        // ── LEÇON 2 : Fixer son prix avec Souveraineté ────────────────────────
        $prix = $this->card($blue, 'Leçon 2', 'Fixer son Prix avec Souveraineté — la méthode des 3 calculs',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Arrêtez de regarder ce que les autres pratiquent.<br>
            Votre prix vient de votre réalité — pas de la moyenne du marché.<br><br>
            <strong>Calcul n°1 — Le Prix de Survie (votre plancher absolu) :</strong><br>
            <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.5rem 0;">
            Vos charges mensuelles complètes ÷ nombre de séances réaliste par mois<br>
            = votre seuil sous lequel vous ne pouvez jamais aller.<br>
            <em>Exemple : 2 500€/mois de charges · 40 séances/mois = 62,50€ minimum.</em>
            </div>
            <strong>Calcul n°2 — Le Prix de Dignité (votre cible) :</strong><br>
            <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.5rem 0;">
            Le revenu qui vous permet de vivre bien, de vous former, de partir en vacances<br>
            et de dormir sereinement · ÷ nombre de séances réaliste (sans vous épuiser)<br>
            = votre prix de dignité.<br>
            <em>Exemple : 4 500€/mois souhaités · 30 séances/mois = 150€ par séance.</em>
            </div>
            <strong>Calcul n°3 — Le Prix de Valeur (votre plafond de légitimité) :</strong><br>
            <div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.5rem 0;">
            Quelle transformation concrète apportez-vous ? Combien vaut-elle pour le client ?<br>
            Un client qui dort enfin après 5 ans d\'insomnie — combien valait ce résultat pour lui ?<br>
            Votre prix peut aller jusqu\'à 10% de la valeur perçue de la transformation.
            </div>
            <strong>La règle d\'or :</strong><br>
            Votre prix juste se situe entre le prix de dignité et le prix de valeur.<br>
            Il doit vous faire légèrement peur — mais ne pas vous empêcher de le dire.
            </div>'
        );

        // ── LEÇON 3 : L'Appel Découverte ─────────────────────────────────────
        $appel = $this->card($purple, 'Leçon 3', 'L\'Appel Découverte — convertir sans se trahir',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            L\'appel découverte (ou "entretien offert") est l\'outil le plus puissant du praticien freelance.<br>
            Et le plus mal maîtrisé.<br><br>
            <div style="background:rgba(239,68,68,.08);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(239,68,68,.4);margin:.5rem 0;">
            <strong style="color:rgba(239,68,68,.8);">Ce que n\'est PAS l\'appel découverte :</strong><br>
            Pas un argumentaire. Pas une présentation de vos services. Pas une négociation.<br>
            Si ça ressemble à "vendre" — vous avez perdu l\'appel avant de commencer.
            </div>
            <strong>La structure en 4 temps qui convertit avec intégrité :</strong><br><br>
            <div style="display:flex;flex-direction:column;gap:.75rem;margin:.5rem 0;">
            <div style="background:rgba(20,184,166,.07);border-radius:8px;padding:.8rem 1rem;">
            <strong style="color:rgba(20,184,166,.9);">① L\'accueil (5 min)</strong><br>
            Créez l\'espace. Pas de pitch. Juste une présence.<br>
            "Avant qu\'on commence — comment vous sentez-vous en ce moment ?"<br>
            La première question n\'est jamais sur leurs objectifs. Elle est sur leur état.
            </div>
            <div style="background:rgba(59,130,246,.07);border-radius:8px;padding:.8rem 1rem;">
            <strong style="color:rgba(59,130,246,.9);">② La situation (15 min)</strong><br>
            "Qu\'est-ce qui vous a amené à chercher ce type d\'accompagnement maintenant ?"<br>
            "Depuis combien de temps vivez-vous avec ça ?"<br>
            "Qu\'avez-vous déjà essayé ? Qu\'est-ce que ça n\'a pas résolu ?"<br>
            Écoutez vraiment. Ne prenez pas de notes — soyez présent.
            </div>
            <div style="background:rgba(168,85,247,.07);border-radius:8px;padding:.8rem 1rem;">
            <strong style="color:rgba(168,85,247,.9);">③ La vision (10 min)</strong><br>
            "Si dans 3 mois vous vous regardez en arrière — qu\'est-ce qui aurait changé dans votre vie quotidienne ?"<br>
            "Comment vous sentirez-vous dans votre corps ?"<br>
            Laissez-les voir leur propre transformation — vous n\'avez rien à vendre.
            </div>
            <div style="background:rgba(201,168,76,.07);border-radius:8px;padding:.8rem 1rem;">
            <strong style="color:rgba(201,168,76,.9);">④ L\'alignement (10 min)</strong><br>
            "Voici ce que j\'accompagne, comment je travaille, et ce que ça demande de votre part."<br>
            Puis le prix — clairement, calmement, sans s\'excuser.<br>
            Puis silence. Ne remplissez pas le silence après avoir annoncé votre prix.<br>
            <em>Celui qui parle en premier après le prix — perd.</em>
            </div>
            </div>
            </div>'
        );

        // ── LEÇON 4 : Séance vs Programme ─────────────────────────────────────
        $programme = $this->card($orange, 'Leçon 4', 'La Différence qui Change Tout — Séance vs Programme',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Vendre des séances à l\'unité, c\'est le modèle qui épuise le plus vite.<br>
            Les clients n\'ont pas de continuité. Vous n\'avez pas de revenu prévisible.<br>
            La transformation est partielle. Tout le monde y perd.<br><br>
            <div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.9rem 1.2rem;border:1px solid rgba(249,115,22,.18);margin:.75rem 0;">
            <strong>La structure en programme change tout :</strong><br><br>
            → La transformation est complète — vos clients voient de vrais résultats durables<br>
            → Vous avez des revenus prévisibles sur 3-6 mois<br>
            → Vous pouvez réellement construire quelque chose avec chaque client<br>
            → Votre valeur est perçue différemment — c\'est un engagement, pas une dépense
            </div>
            <strong>Exemple concret — Programme "Équilibre Nerveux 8 semaines" :</strong><br>
            <div style="background:rgba(0,0,0,.2);border-radius:8px;padding:.8rem 1rem;margin:.5rem 0;">
            8 séances hebdomadaires · Accès à une bibliothèque audio personnalisée<br>
            Journal de pratique guidé · 2 appels de soutien entre séances · Clôture rituelle<br><br>
            Prix à l\'unité théorique : 8 × 150€ = 1 200€<br>
            Prix programme : 950€ (tarif unique) ou 3 × 340€ (facilité)<br>
            Valeur perçue par le client : bien supérieure à 8 séances.
            </div>
            <strong>Les 3 types de revenus à construire progressivement :</strong><br>
            <strong style="color:rgba(20,184,166,.9);">① Revenus actifs</strong> — séances, programmes (votre fondation)<br>
            <strong style="color:rgba(59,130,246,.9);">② Revenus semi-passifs</strong> — ateliers, formations en groupe, journées thématiques<br>
            <strong style="color:rgba(201,168,76,.9);">③ Revenus passifs</strong> — audios guidés vendus, programme en ligne enregistré<br><br>
            <em>Construire les 3 niveaux = ne plus jamais dépendre d\'une seule source.</em>
            </div>'
        );

        // ── LEÇON 5 : La Conversation sur le Prix ─────────────────────────────
        $conversation = $this->card($green, 'Leçon 5', 'Parler du Prix — les phrases exactes qui libèrent',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Le prix n\'est pas un obstacle à surmonter. C\'est une limite à honorer.<br>
            La façon dont vous en parlez dit tout sur ce que vous pensez de vous-même.<br><br>
            <strong>Ce qui NE fonctionne pas :</strong><br>
            <div style="background:rgba(239,68,68,.07);border-radius:8px;padding:.75rem 1rem;margin:.5rem 0;border-left:2px solid rgba(239,68,68,.4);">
            "Enfin, je veux dire — c\'est 150€ mais bon... si c\'est trop je peux m\'adapter."<br>
            "Normalement je fais 120€ mais pour vous je peux..."<br>
            "C\'est peut-être un peu cher mais..."<br>
            <em>→ Chaque excuse après le prix annule la valeur avant le prix.</em>
            </div>
            <strong>Ce qui fonctionne — exemples de formulations souveraines :</strong><br>
            <div style="background:rgba(34,197,94,.07);border-radius:8px;padding:.75rem 1rem;margin:.5rem 0;border-left:2px solid rgba(34,197,94,.4);">
            "Mon programme de 8 semaines est à 950€ en paiement unique, ou 3 fois 340€.<br>
            Vous avez une préférence ?"<br>
            (Proposer deux options de paiement — pas de négociation, juste du choix.)<br><br>
            "L\'investissement pour ce programme est [prix]. Qu\'est-ce qui se passe de votre côté avec ça ?"<br>
            (Nommer c\'est un investissement, pas un coût. Puis écouter.)<br><br>
            "Je comprends que ce n\'est pas anodin. C\'est fait pour les personnes prêtes à aller au bout."<br>
            (Ne jamais descendre le prix — repositionner l\'enjeu.)
            </div>
            <strong>Quand quelqu\'un dit "c\'est trop cher" :</strong><br>
            Ne justifiez pas. Ne descendez pas. Demandez :<br>
            <em>"Trop cher par rapport à quoi ?"</em><br>
            La réponse vous dira si c\'est une vraie contrainte budget ou une hésitation de valeur.<br>
            Deux situations différentes appellent deux réponses différentes.
            </div>'
        );

        // ── ACTIVITÉS ─────────────────────────────────────────────────────────
        $activities = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — Le Chaînon Manquant',
                'duration'    => '10 min',
                'description' => 'Pourquoi 90% des praticiens abandonnent dans les 3 ans. Pas le talent — la conversation sur l\'argent. Ce module est la différence entre une formation brillante et une pratique libre.',
                'content'     => $intro,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 1 — La Psychologie de l\'Argent dans le Soin',
                'duration'    => '30 min',
                'description' => '3 croyances qui sabotent · Pourquoi sous-facturer blesse le client autant que le praticien · La vérité libératrice sur le prix juste.',
                'content'     => $psychologie,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 2 — Fixer son Prix avec Souveraineté',
                'duration'    => '25 min',
                'description' => 'La méthode des 3 calculs : Prix de Survie · Prix de Dignité · Prix de Valeur. Là où aucun chiffre ne vient du marché — il vient de votre réalité.',
                'content'     => $prix,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 3 — L\'Appel Découverte : convertir sans se trahir',
                'duration'    => '25 min',
                'description' => 'La structure en 4 temps : accueil · situation · vision · alignement. Les questions exactes. La règle du silence après le prix. Convertir avec intégrité.',
                'content'     => $appel,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 4 — Séance vs Programme : la différence qui change tout',
                'duration'    => '20 min',
                'description' => 'Pourquoi vendre à la séance épuise et fragmente. La structure en programme : transformation complète, revenus prévisibles, valeur perçue supérieure. 3 niveaux de revenus à construire.',
                'content'     => $programme,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 5 — Parler du Prix : les phrases exactes',
                'duration'    => '20 min',
                'description' => 'Les formulations souveraines vs les formulations qui s\'excusent. Comment répondre à "c\'est trop cher". La règle : ne jamais descendre le prix — repositionner l\'enjeu.',
                'content'     => $conversation,
            ],
            [
                'type'        => 'exercice',
                'title'       => 'Exercice — Calculer mon Prix Juste en 3 étapes',
                'duration'    => '30 min',
                'description' => 'Appliquer les 3 calculs (Survie · Dignité · Valeur) à VOTRE réalité. Définir votre programme phare. Rédiger votre présentation tarifaire en une phrase calme et souveraine.',
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Jeu de Rôle — Simuler un Appel Découverte',
                'duration'    => '30 min',
                'description' => 'Avec un partenaire (collègue, pair, conjoint) : l\'un joue le prospect, l\'autre le praticien. Objectif : traverser les 4 temps et annoncer le prix sans s\'excuser. Retour immédiat.',
            ],
        ];

        // ── EN ACTIVITÉS ──────────────────────────────────────────────────────
        $activities_en = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — The Missing Link',
                'duration'    => '10 min',
                'description' => 'Why 90% of practitioners quit within 3 years. Not talent — the money conversation. This module is the difference between a brilliant training and a sustainable practice.',
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Lesson 1 — The Psychology of Money in Care',
                'duration'    => '30 min',
                'description' => '3 sabotaging beliefs · Why undercharging harms the client as much as the practitioner · The liberating truth about a fair price.',
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Lesson 2 — Setting Your Price with Sovereignty',
                'duration'    => '25 min',
                'description' => 'The 3-calculation method: Survival Price · Dignity Price · Value Price. No number comes from the market — it comes from your reality.',
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Lesson 3 — The Discovery Call: converting without betraying yourself',
                'duration'    => '25 min',
                'description' => 'The 4-stage structure: welcome · situation · vision · alignment. The exact questions. The silence rule after stating the price. Converting with integrity.',
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Lesson 4 — Session vs Programme: the difference that changes everything',
                'duration'    => '20 min',
                'description' => 'Why selling per session exhausts and fragments. The programme structure: full transformation, predictable income, higher perceived value. 3 income streams to build.',
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Lesson 5 — Talking About Price: the exact phrases',
                'duration'    => '20 min',
                'description' => 'Sovereign vs apologetic formulations. How to respond to "it\'s too expensive". The rule: never lower the price — reposition the stakes.',
            ],
            [
                'type'        => 'exercice',
                'title'       => 'Exercise — Calculate My Fair Price in 3 Steps',
                'duration'    => '30 min',
                'description' => 'Apply the 3 calculations to YOUR reality. Define your flagship programme. Write your pricing presentation in one calm, sovereign sentence.',
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Role Play — Simulate a Discovery Call',
                'duration'    => '30 min',
                'description' => 'With a partner: one plays the prospect, the other the practitioner. Goal: go through all 4 stages and state the price without apologising. Immediate feedback.',
            ],
        ];

        DB::table('formation_modules')->updateOrInsert(
            ['slug' => '16-l-argent-du-soin', 'track' => 'praticien'],
            [
                'slug'           => '16-l-argent-du-soin',
                'title'          => 'L\'Argent du Soin — Pratiquer Librement sans s\'Appauvrir',
                'title_en'       => 'The Money of Care — Practising Freely Without Impoverishing Yourself',
                'week_label'     => 'Module 16 · Freelance',
                'track'          => 'praticien',
                'order'          => 12,
                'is_active'      => true,
                'intro_text'     => "L'ARGENT DU SOIN — Le Chaînon Manquant\n\n90% des praticiens abandonnent dans les 3 ans. Pas par manque de talent — par incapacité à avoir la conversation sur l'argent sans se sentir corrompus.\n\nPsychologie de l'argent dans le soin · 3 croyances saboteuses · Prix avec souveraineté (3 calculs) · L'Appel Découverte en 4 temps · Séance vs Programme · Les phrases exactes qui libèrent.",
                'intro_text_en'  => "THE MONEY OF CARE — The Missing Link\n\n90% of practitioners quit within 3 years. Not for lack of talent — for inability to have the money conversation without feeling corrupted.\n\nPsychology of money in care · 3 sabotaging beliefs · Sovereign pricing (3 calculations) · The Discovery Call in 4 stages · Session vs Programme · The exact phrases that liberate.",
                'description'    => "Psychologie argent-soin (3 croyances) · Méthode des 3 calculs · Appel découverte (4 temps) · Programme vs séance · 3 niveaux de revenus · Phrases souveraines · Jeu de rôle",
                'description_en' => "Money-care psychology (3 beliefs) · 3-calculation method · Discovery call (4 stages) · Programme vs session · 3 income streams · Sovereign phrases · Role play",
                'activities'     => json_encode($activities),
                'activities_en'  => json_encode($activities_en),
                'audio_path'     => null,
                'audio_path_en'  => null,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]
        );

        $this->command->info('[FormationPraticienModule16Seeder] ✓ 8 activités — L\'Argent du Soin.');
    }
}
