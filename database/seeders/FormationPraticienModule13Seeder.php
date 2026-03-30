<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * MODULE 13 — Limites, Contre-indications & Responsabilité
 * Formation Praticien · Module professionnel
 * Arc pédagogique : situations d'arrêt · contre-indications · orientation · RGPD · déontologie
 */
class FormationPraticienModule13Seeder extends Seeder
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

        $intro = $this->card($gold, 'Module 13 · Praticien', 'Savoir s\'arrêter est une compétence professionnelle',
            '<div style="font-size:.88rem;line-height:2.1;color:rgba(232,224,208,.82);">
            Dans ce module, pas de visualisation. Pas de connexion intérieure.<br>
            Un seul objectif : <strong>votre sécurité et celle de vos clients.</strong><br><br>
            <div style="background:rgba(239,68,68,.07);border-radius:10px;padding:.85rem 1.1rem;border:1px solid rgba(239,68,68,.15);margin:.75rem 0;">
            La pratique corporelle touche à des couches profondes de l\'être.<br>
            Parfois, quelque chose de non prévu remonte.<br>
            Un praticien non préparé peut aggraver une situation en essayant de "continuer quand même".<br><br>
            <strong>Le praticien professionnel sait :</strong><br>
            · Reconnaître les signaux d\'alarme en séance<br>
            · Arrêter en douceur et sécuriser le client<br>
            · Ce qu\'il peut et ne peut pas accompagner<br>
            · Comment orienter vers un autre professionnel<br>
            · Ses obligations légales (consentement, confidentialité, RGPD)
            </div>
            Ce module peut sauver une vie.<br>
            Il peut aussi protéger votre pratique pendant des années.
            </div>'
        );

        $situations_arret = $this->card($red, 'Leçon 1', '5 situations d\'arrêt de séance — reconnaître et agir',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            <div style="display:flex;flex-direction:column;gap:.85rem;margin:.75rem 0;">
            <div style="background:rgba(239,68,68,.08);border-radius:10px;padding:.85rem 1.1rem;">
            <strong style="color:rgba(239,68,68,.9);">① Dissociation</strong><br>
            <strong>Signaux</strong> : regard vide, déconnexion soudaine, absence verbale, mouvement automatique, "je ne suis plus dans mon corps"<br>
            <strong>Arrêt doux</strong> : "Je vais vous inviter à ouvrir les yeux doucement. Sentez vos pieds. Posez vos mains sur vos cuisses. Je suis là."<br>
            <strong>Ne pas</strong> : continuer la guidance, aller plus loin, demander "qu\'est-ce qui s\'est passé ?" immédiatement.
            </div>
            <div style="background:rgba(239,68,68,.08);border-radius:10px;padding:.85rem 1.1rem;">
            <strong style="color:rgba(239,68,68,.9);">② Crise anxieuse aiguë / Attaque de panique</strong><br>
            <strong>Signaux</strong> : rythme respiratoire très rapide, tremblement, sentiment de mort imminente, engourdissements<br>
            <strong>Arrêt doux</strong> : soupir physiologique 3 cycles + voix ferme et calme + "Regardez mes yeux. Vous êtes en sécurité ici."<br>
            <strong>Ne pas</strong> : paniquer vous-même, dire "respirez normalement" (aggrave), laisser seul.
            </div>
            <div style="background:rgba(249,115,22,.08);border-radius:10px;padding:.85rem 1.1rem;">
            <strong style="color:rgba(249,115,22,.9);">③ Douleur physique intense</strong><br>
            <strong>Signaux</strong> : grimace, verbalisation de douleur, refus de continuer, positionnement défensif<br>
            <strong>Arrêt doux</strong> : interrompre immédiatement. "On s\'arrête maintenant. Est-ce que vous pouvez me dire où vous avez mal ?"<br>
            <strong>Orienter vers</strong> : médecin ou kinésithérapeute si la douleur persiste après la séance.
            </div>
            <div style="background:rgba(168,85,247,.08);border-radius:10px;padding:.85rem 1.1rem;">
            <strong style="color:rgba(168,85,247,.9);">④ Pleurs intenses + perte de contrôle émotionnel</strong><br>
            <strong>Signaux</strong> : pleurs qui s\'intensifient sans descente, incapacité à reprendre souffle, état d\'agitation croissant<br>
            <strong>Arrêt doux</strong> : "On ralentit ici. Je reste avec vous. On ne va nulle part. Juste votre souffle maintenant."<br>
            <strong>Différencier</strong> : pleurs libérateurs (descente progressive) vs débordement (escalade). Le deuxième = arrêt.
            </div>
            <div style="background:rgba(59,130,246,.08);border-radius:10px;padding:.85rem 1.1rem;">
            <strong style="color:rgba(59,130,246,.9);">⑤ Confusion / Désorientation</strong><br>
            <strong>Signaux</strong> : ne sait plus où il est, questions incohérentes, confusion temporelle, état second prolongé<br>
            <strong>Arrêt doux</strong> : ancrage progressif par les 5 sens + "Vous vous appelez [prénom]. Vous êtes [lieu]. C\'est [date]."<br>
            <strong>Si ça ne remonte pas en 5 min</strong> : appeler les secours. Ne pas être seul avec le client.
            </div>
            </div>
            <div style="background:rgba(34,197,94,.06);border-radius:10px;padding:.75rem 1rem;border:1px solid rgba(34,197,94,.12);margin-top:.5rem;">
            <strong style="color:rgba(34,197,94,.8);">Le protocole d\'arrêt doux universel :</strong><br>
            ① Interrompre la guidance doucement · ② Ancrage pieds-sol en 3 souffles doux · ③ Contact verbal réel (prénom, lieu) · ④ Demander: "Comment êtes-vous là ?" · ⑤ Attendre la stabilisation avant tout.
            </div>
            </div>'
        );

        $contre_indications = $this->card($orange, 'Leçon 2', 'Contre-indications — ce que vous ne pouvez pas prendre en charge',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Le praticien corporel n\'est pas un psychothérapeute. Il n\'est pas un médecin.<br>
            <strong>Certaines situations dépassent le cadre de la pratique Pause Souffle.</strong><br><br>
            <div style="display:flex;flex-direction:column;gap:.75rem;margin:.75rem 0;">
            <div style="background:rgba(239,68,68,.1);border-radius:10px;padding:.85rem 1.1rem;border:1px solid rgba(239,68,68,.2);">
            <strong style="color:rgba(239,68,68,.9);">CONTRE-INDICATIONS ABSOLUES — Ne pas prendre en charge</strong><br><br>
            · Épisode psychotique actif (hallucinations, délires, rupture du réel)<br>
            · Épisode maniaque (bipolarité en phase haute)<br>
            · Intoxication aiguë (alcool, drogues)<br>
            · Idées suicidaires actives avec plan précis<br>
            · Épilepsie non contrôlée<br>
            · Troubles cardiovasculaires graves non traités (insuffisance cardiaque aiguë)
            </div>
            <div style="background:rgba(249,115,22,.08);border-radius:10px;padding:.85rem 1.1rem;border:1px solid rgba(249,115,22,.15);">
            <strong style="color:rgba(249,115,22,.9);">CONTRE-INDICATIONS RELATIVES — Adapter ou orienter d\'abord</strong><br><br>
            · Dépression sévère sans suivi thérapeutique en cours<br>
            · Deuil récent (&lt; 3 mois pour un deuil majeur)<br>
            · Trauma non traité avec symptômes actifs (SSPT)<br>
            · Grossesse : certaines techniques à exclure (4-7-8 intense, hypoxie volontaire)<br>
            · Pathologie respiratoire sévère (BPCO, asthme non contrôlé)
            </div>
            </div>
            <strong>La question systématique en bilan initial :</strong><br>
            <em>"Êtes-vous actuellement suivi par un professionnel de santé mental ou physique ?"</em><br>
            <em>"Avez-vous un antécédent de crise de panique, dissociation ou épisode traumatique intense ?"</em>
            </div>'
        );

        $orientation = $this->card($green, 'Leçon 3', 'Orienter avec soin — sans rompre la relation',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Orienter n\'est pas abandonner. C\'est <strong>honorer les limites de votre rôle</strong>.<br><br>
            <div style="display:flex;flex-direction:column;gap:.75rem;margin:.75rem 0;">
            <div style="background:rgba(34,197,94,.06);border-radius:10px;padding:.85rem 1.1rem;">
            <strong style="color:rgba(34,197,94,.8);">Comment orienter sans blesser :</strong><br>
            ✗ "Je ne peux pas vous aider, vous avez besoin d\'un psy."<br>
            ✓ "Ce que vous traversez mérite un accompagnement plus spécialisé que ce que je propose. Je reste là pour le souffle et la présence. Pour le reste, voici quelqu\'un en qui j\'ai confiance."<br><br>
            La différence : vous <em>ajoutez</em> un soin, vous n\'excluez pas.
            </div>
            <div>
            <strong style="color:rgba(20,184,166,.9);">Vers qui orienter :</strong><br><br>
            · <strong>Trauma, SSPT, dissociation</strong> → Psychologue spécialisé trauma / EMDR / Somatic Experiencing<br>
            · <strong>Dépression sévère, anxiété invalidante</strong> → Psychiatre ou médecin généraliste psychiatrie<br>
            · <strong>Douleurs chroniques, problématiques corporelles</strong> → Kinésithérapeute / ostéopathe<br>
            · <strong>Deuil complexe</strong> → Psychologue / groupe de soutien<br>
            · <strong>Idées suicidaires</strong> → SOS Amitié (09 72 39 40 50) · médecin traitant · urgences
            </div>
            </div>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.75rem 1rem;margin-top:.75rem;border:1px solid rgba(201,168,76,.15);">
            <strong>Construire son réseau d\'orientation :</strong><br>
            Identifiez 2-3 professionnels de confiance (psys, médecins, kiné) dans votre secteur.<br>
            Échangez avec eux sur vos pratiques respectives. La confiance mutuelle rend l\'orientation naturelle.
            </div>
            </div>'
        );

        $rgpd_consentement = $this->card($blue, 'Leçon 4', 'RGPD · Consentement éclairé · Confidentialité',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            <strong>3 obligations légales que tout praticien doit respecter :</strong><br><br>
            <div style="display:flex;flex-direction:column;gap:.85rem;margin:.75rem 0;">
            <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.85rem 1.1rem;">
            <strong style="color:rgba(59,130,246,.9);">① RGPD — Protection des données</strong><br>
            Toute information sur votre client (nom, âge, état de santé, notes de séance) est une <em>donnée personnelle sensible</em>.<br><br>
            Vos obligations :<br>
            · Notes papier ou numériques sécurisées (pas de carnet non verrouillé, pas de fichier cloud non chiffré)<br>
            · Durée de conservation définie (ex: 3 ans après la dernière séance)<br>
            · Droit de suppression : si le client demande, vous effacez.<br>
            · Le client peut demander à voir ses notes vous concernant.
            </div>
            <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.85rem 1.1rem;">
            <strong style="color:rgba(168,85,247,.9);">② Consentement éclairé</strong><br>
            Avant la première séance, le client doit comprendre et accepter :<br>
            · Ce qu\'est une séance (techniques respiratoires + présence corporelle accompagnée)<br>
            · Ce que ce n\'est pas (médecine, psychothérapie, traitement)<br>
            · Les risques potentiels (émergences émotionnelles, sensations inhabituelles)<br>
            · Son droit d\'arrêter à tout moment<br><br>
            Ce consentement s\'obtient par écrit — une fiche simple, signée.
            </div>
            <div style="background:rgba(34,197,94,.06);border-radius:10px;padding:.85rem 1.1rem;">
            <strong style="color:rgba(34,197,94,.8);">③ Confidentialité</strong><br>
            Ce qui se dit et se vit en séance reste en séance.<br>
            Pas de partage avec la famille du client (sauf urgence vitale).<br>
            Pas de mention dans des posts publics, même anonymisée sans accord explicite.<br>
            En supervision : vous pouvez parler de vos cas pour votre formation — toujours de façon anonymisée.
            </div>
            </div>
            </div>'
        );

        $deontologie = $this->card($purple, 'Leçon 5', 'Déontologie du praticien corporel',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            La déontologie, ce n\'est pas un ensemble de règles rigides.<br>
            C\'est <strong>l\'éthique incarnée</strong> — la façon dont vous portez votre rôle.<br><br>
            <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.85rem 1.1rem;display:flex;flex-direction:column;gap:.75rem;margin:.75rem 0;border:1px solid rgba(168,85,247,.12);">
            <div>
            <strong>Le non-jugement :</strong><br>
            Ce que le client vit, pense, ressent — n\'est pas votre affaire à évaluer. Votre rôle est d\'accueillir, pas de corriger.
            </div>
            <div>
            <strong>L\'absence de dépendance :</strong><br>
            Un bon praticien rend le client indépendant de lui. Pas l\'inverse.<br>
            Si un client vient depuis plus de 6 mois sans autonomie croissante — posez-vous la question.
            </div>
            <div>
            <strong>Les limites relationnelles :</strong><br>
            Pas de relation affective ou intime avec les clients. Pas d\'amitié "pendant" l\'accompagnement.<br>
            La règle des 2 ans : attendre 2 ans après la fin de l\'accompagnement avant tout changement de relation.
            </div>
            <div>
            <strong>L\'humilité professionnelle :</strong><br>
            "Je ne sais pas" est une réponse professionnelle.<br>
            "Ça dépasse mon cadre" est une réponse professionnelle.<br>
            Prétendre être thérapeute ou médecin est une faute.
            </div>
            <div>
            <strong>La formation continue :</strong><br>
            Le champ du soin corporel évolue. La supervision régulière n\'est pas optionnelle pour un praticien éthique.<br>
            Au minimum : 1 séance de supervision/mois les 2 premières années.
            </div>
            </div>
            <em style="color:rgba(201,168,76,.8);">"Le praticien qui connaît ses limites est plus utile que celui qui prétend n\'en avoir pas."</em>
            </div>'
        );

        $serment_praticien = $this->card($gold, 'Intégration', 'Serment du praticien Pause Souffle',
            '<div style="background:rgba(201,168,76,.06);border-radius:10px;padding:1.1rem 1.3rem;border:1px solid rgba(201,168,76,.2);">
            <div style="font-size:.9rem;line-height:2.3;color:rgba(232,224,208,.88);font-style:italic;">
            Je m\'engage à accompagner chaque personne avec <strong>respect</strong> et <strong>humilité</strong>.<br><br>
            Je reconnaîtrai mes limites et orienterai quand nécessaire,<br>
            sans honte ni sentiment d\'échec.<br><br>
            Je protégerai les informations partagées avec moi<br>
            comme un bien précieux et confidentiel.<br><br>
            Je prendrai soin de moi pour pouvoir prendre soin des autres.<br>
            Je chercherai supervision et soutien quand la route est difficile.<br><br>
            Je pratiquerai ce que j\'enseigne.<br>
            Je transmettrai ce que j\'ai moi-même traversé.<br><br>
            Je serai praticien Pause Souffle —<br>
            un accompagnant du souffle et de la présence,<br>
            pas plus, jamais moins.
            </div>
            <div style="margin-top:1rem;font-size:.78rem;color:rgba(232,224,208,.5);text-align:right;">
            Signature : ___________________ · Date : ___________________
            </div>
            </div>'
        );

        $activities = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — Savoir s\'arrêter est une compétence',
                'duration'    => '10 min',
                'description' => 'Ce module traite de la sécurité. Le praticien professionnel connaît ses limites et protège ses clients et lui-même.',
                'content'     => $intro,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 1 — 5 situations d\'arrêt de séance',
                'duration'    => '30 min',
                'description' => 'Dissociation · panique aiguë · douleur physique · débordement émotionnel · confusion. Signes, protocole d\'arrêt doux universel.',
                'content'     => $situations_arret,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 2 — Contre-indications absolues et relatives',
                'duration'    => '20 min',
                'description' => 'Ce que le praticien Pause Souffle ne peut pas prendre en charge. Questions systématiques du bilan initial.',
                'content'     => $contre_indications,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 3 — Orienter avec soin',
                'duration'    => '20 min',
                'description' => 'Comment orienter sans blesser. Vers qui orienter selon la situation. Construire son réseau de confiance.',
                'content'     => $orientation,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 4 — RGPD · Consentement · Confidentialité',
                'duration'    => '25 min',
                'description' => '3 obligations légales : protection des données (RGPD) · consentement éclairé avant séance · confidentialité totale.',
                'content'     => $rgpd_consentement,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 5 — Déontologie du praticien corporel',
                'duration'    => '20 min',
                'description' => 'Non-jugement · indépendance du client · limites relationnelles · humilité professionnelle · formation continue.',
                'content'     => $deontologie,
            ],
            [
                'type'        => 'reflexion',
                'title'       => 'Intégration — Le Serment du Praticien Pause Souffle',
                'duration'    => '15 min',
                'description' => 'Lire, signer et dater. Ce n\'est pas symbolique — c\'est un acte d\'engagement déontologique personnel.',
                'content'     => $serment_praticien,
            ],
        ];

        DB::table('formation_modules')->updateOrInsert(
            ['slug' => '13-limites-contre-indications-responsabilite', 'track' => 'praticien'],
            [
                'slug'        => '13-limites-contre-indications-responsabilite',
                'title'       => 'Limites, Contre-indications & Responsabilité',
                'week_label'  => 'Module 13',
                'track'       => 'praticien',
                'order'       => 9,
                'is_active'   => true,
                'intro_text'  => "LIMITES, CONTRE-INDICATIONS & RESPONSABILITÉ — Module Praticien 13\n\nSavoir s'arrêter est une compétence professionnelle.\n\n5 situations d'arrêt de séance · contre-indications absolues et relatives · orientation vers autres professionnels · RGPD et consentement éclairé · déontologie du praticien corporel · Serment du Praticien Pause Souffle.",
                'description' => '5 situations d\'arrêt (dissociation·panique·douleur·débordement·confusion) · contre-indications absolues/relatives · orientation professionnelle · RGPD/consentement/confidentialité · déontologie · Serment du Praticien.',
                'activities'  => json_encode($activities),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        );

        $this->command->info('[FormationPraticienModule13Seeder] ✓ 7 activités — Limites, Contre-indications & Responsabilité.');
    }
}
