<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * MODULE 7 — Je transmets le Rituel Pause Souffle
 * Formation Praticien · Module 01
 * Arc pédagogique : architecture de séance · accueil · parcours corporel · clôture · éthique · première séance réelle
 * Déplacé depuis Module 06 (Parcours) → repositionné comme premier module de la Formation Praticien
 */
class FormationModule06Seeder extends Seeder
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
            $this->card($gold, 'Formation Praticien · Module 01', 'Tu as fait le voyage. Maintenant tu le transmets.',
                '<div style="font-size:.88rem;line-height:2.1;color:rgba(232,224,208,.82);">
                Le Parcours t\'a donné les 7 fondations :<br><br>
                · <strong>Module 00</strong> → L\'anatomie vivante — lire le corps<br>
                · <strong>Module 01</strong> → Te rencontrer — auto-observation<br>
                · <strong>Module 02</strong> → Reconnaître les blessures — la mémoire corporelle<br>
                · <strong>Module 03</strong> → Décrire le bonheur — les ressources<br>
                · <strong>Module 04</strong> → Le souffle — l\'outil principal<br>
                · <strong>Module 05</strong> → Ta mission — le pourquoi<br>
                · <strong>Module 06</strong> → J\'incarne ma Vision — clarté, courage et discipline<br><br>
                Ce module marque ton <strong>entrée dans la pratique professionnelle</strong>.<br>
                Tu vas apprendre à conduire une <strong>séance Pause Souffle complète</strong> — pour l\'autre.<br><br>
                <em style="color:rgba(201,168,76,.8);">À la fin de ce module : tu réalises ta première séance réelle. Pas idéale. Pas parfaite. Vraie.</em>
                </div>'
            );

        $architecture =
            $this->card($blue, 'Leçon 1', 'Architecture du rituel — les 4 temps de la séance',
                '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
                Chaque séance Pause Souffle respecte 4 temps, quelle que soit la durée.<br><br>
                <strong style="color:rgba(59,130,246,.9);">① L\'Accueil (15–20%)</strong><br>
                Créer l\'espace sécurisant. Check-in corporel. Intention de séance.<br><br>
                <strong style="color:rgba(59,130,246,.9);">② L\'Exploration (50–60%)</strong><br>
                Parcours des zones de tension ou d\'invitation. Souffle accompagnateur. Mouvement doux.<br><br>
                <strong style="color:rgba(59,130,246,.9);">③ L\'Intégration (15–20%)</strong><br>
                Retour au corps entier. Silence. Respiration naturelle. Laisser se déposer.<br><br>
                <strong style="color:rgba(59,130,246,.9);">④ La Clôture (10–15%)</strong><br>
                Check-out verbal. Ancrage (pieds au sol, respiration). Mot de fin du client.<br><br>
                <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.75rem 1rem;margin-top:.75rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(59,130,246,.55);margin-bottom:.5rem;">─ Minutage selon les formats ─</div>
                <strong>30 min</strong> : Accueil 5 · Exploration 15 · Intégration 5 · Clôture 5<br>
                <strong>45 min</strong> : Accueil 8 · Exploration 25 · Intégration 8 · Clôture 4<br>
                <strong>60 min</strong> : Accueil 10 · Exploration 35 · Intégration 10 · Clôture 5
                </div>
                </div>'
            );

        $accueil =
            $this->card($teal, 'Leçon 2', 'L\'accueil — créer l\'espace sécurisant',
                '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
                L\'accueil n\'est pas de la politesse. C\'est du soin.<br><br>
                <strong>Le protocole d\'accueil Pause Souffle :</strong><br><br>
                <strong>① Check-in physique</strong><br>
                "Comment est votre corps en ce moment ?" (pas "comment allez-vous")<br>
                Attendre. Écouter sans interrompre. Observer la posture pendant qu\'il parle.<br><br>
                <strong>② L\'intention</strong><br>
                "Qu\'est-ce que vous aimeriez laisser de côté pour cette heure ?" (externe)<br>
                "Qu\'est-ce que vous aimeriez accueillir ?" (interne)<br><br>
                <strong>③ L\'installation</strong><br>
                Respiration d\'entrée : 3 souffles lents ensemble. Synchronisation.<br>
                Établir l\'ancrage : pieds au sol, dos soutenu, yeux doux.
                </div>
                <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(20,184,166,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
                🎙 <strong style="color:rgba(20,184,166,.8);">Script audio ElevenLabs ·</strong>
                <em>"Prenons un moment pour arriver ici ensemble. Avant de commencer — posez les deux pieds bien à plat sur le sol. Sentez leur contact avec le sol. Inspirez doucement… expirez entièrement. Voici notre espace pour les prochaines minutes."</em>
                </div>'
            );

        $exploration =
            $this->card($purple, 'Leçon 3', 'L\'exploration — guider sans diriger',
                '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
                L\'erreur la plus commune du praticien débutant :<br>
                <strong>trop parler, trop guider, trop remplir le silence.</strong><br><br>
                Le silence est un outil.<br>
                L\'espace vide est ce dans lequel quelque chose peut émerger.<br><br>
                <strong>Les 5 gestes de l\'exploration :</strong><br>
                <strong>①</strong> Pointer une zone (pas nommer une pathologie) : "posez votre attention sur vos épaules"<br>
                <strong>②</strong> Accompagner le souffle : "respirez sur cette zone"<br>
                <strong>③</strong> Inviter le mouvement : "si votre corps voulait bouger, comment bougerait-il ?"<br>
                <strong>④</strong> Maintenir le silence actif : présent mais sans remplir<br>
                <strong>⑤</strong> Valider l\'expérience : "c\'est bien. Restez là."<br><br>
                <em>Ce que vous ne faites jamais : interpréter, juger, diagnostiquer, comparer à d\'autres clients.</em>
                </div>'
            );

        $integration =
            $this->card($orange, 'Leçon 4', 'L\'intégration et la clôture — finir bien',
                '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
                Une séance mal clôturée peut laisser le client fragilisé.<br>
                Une séance bien clôturée est elle-même thérapeutique.<br><br>
                <strong>Protocole d\'intégration :</strong><br>
                · Retour à la respiration naturelle (sans guide)<br>
                · 2–3 minutes de silence total<br>
                · Invitation douce : "quand vous êtes prêt·e, bougez doucement les doigts…"<br><br>
                <strong>Protocole de clôture :</strong><br>
                · Check-out : "un mot pour décrire comment est votre corps maintenant ?"<br>
                · Ancrage : pieds au sol, eau si disponible, regard vers l\'horizontale<br>
                · Mot de fin du praticien : court, ancré, chaleureux. Pas d\'analyse.<br><br>
                <em>Le praticien ne commente pas ce qui s\'est passé. Il garde l\'espace ouvert.</em>
                </div>
                <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(249,115,22,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
                🎙 <strong style="color:rgba(249,115,22,.8);">Script audio ElevenLabs ·</strong>
                <em>"Nous approchons doucement de la fin de notre séance. Laissez votre respiration revenir à son rythme naturel. Quand vous êtes prêt·e — à votre propre rythme — bougez légèrement les doigts, les orteils. Ramenez doucement votre présence dans la pièce."</em>
                </div>'
            );

        $ethique =
            $this->card($red, 'Éthique', 'Les limites du praticien — ce que tu ne feras jamais',
                '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
                <strong style="color:rgba(239,68,68,.9);">⛔ Diagnostiquer.</strong><br>
                "Vous avez telle blessure / telle pathologie." → Jamais. Référer au médecin.<br><br>
                <strong style="color:rgba(239,68,68,.9);">⛔ Promettre une guérison.</strong><br>
                "Je vais vous guérir de X." → Jamais. "Je vous accompagne" — toujours.<br><br>
                <strong style="color:rgba(239,68,68,.9);">⛔ Dépasser tes compétences.</strong><br>
                Si un client présente des signes de crise psychologique grave → arrêt, sécurité, référence psy.<br><br>
                <strong style="color:rgba(239,68,68,.9);">⛔ Créer une dépendance.</strong><br>
                L\'objectif de chaque séance : renforcer l\'autonomie du client. Pas sa dépendance.<br><br>
                <strong style="color:rgba(239,68,68,.9);">⛔ Confondre rôles.</strong><br>
                Praticien corporel ≠ ami ≠ thérapeute ≠ médecin. Le cadre protège les deux.<br><br>
                <em style="color:rgba(239,68,68,.7);">Un praticien qui respecte ses limites est un praticien qui dure. Et qui fait vraiment du bien.</em>
                </div>'
            );

        $seance_type =
            $this->card($green, 'Pratique', 'Séance type guidée — 45 minutes complètes',
                '<div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.85rem 1.1rem;margin-bottom:.75rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(34,197,94,.55);margin-bottom:.5rem;">─ Script complet ─</div>
                <strong>Accueil (8 min)</strong><br>
                "Comment est votre corps en ce moment ?" · Écoute · Check-in posture · Intention · 3 souffles ensemble<br><br>
                <strong>Exploration (25 min)</strong><br>
                Zone 1 (épaules) → souffle → mouvement libre → silence 2 min<br>
                Zone 2 (ventre) → souffle → intention · libérer ou accueillir → silence 3 min<br>
                Zone 3 (dos/colonne) → grandir · s\'allonger → souffle complet → silence 3 min<br>
                Zone globale → scan entier → "quel est le territoire le plus présent ?" → accompagner<br><br>
                <strong>Intégration (8 min)</strong><br>
                Respiration naturelle · Silence total 3 min · Retour doux<br><br>
                <strong>Clôture (4 min)</strong><br>
                Check-out · Ancrage pieds · Mot du praticien · Fin
                </div>'
            );

        $premiere_seance =
            $this->card($gold, 'Certification', 'Ta première séance — le passage de praticien',
                '<div style="font-size:.85rem;line-height:2.2;color:rgba(232,224,208,.82);">
                Tu as maintenant tous les outils.<br><br>
                <strong>La mission de ce module final :</strong><br>
                Conduire une séance Pause Souffle complète de 30 ou 45 minutes avec une vraie personne.<br><br>
                <strong>Le cadre :</strong><br>
                · Un proche de confiance, ou un partenaire de pratique de la formation<br>
                · Pas un vrai client (encore) — une séance d\'apprentissage<br>
                · Enregistre-toi si possible (audio seulement, avec accord)<br><br>
                <strong>Après la séance, note :</strong><br>
                → Ce qui s\'est bien passé<br>
                → Ce qui était difficile<br>
                → Ce que tu ferais différemment<br>
                → Ce que le client t\'a dit à la fin<br><br>
                <em style="color:rgba(201,168,76,.8);">Ce n\'est pas une évaluation. C\'est le début de ta pratique. Chaque séance t\'apprend quelque chose qu\'aucun module ne peut t\'apprendre.</em>
                </div>'
            );

        $activities = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — Tout s\'assemble maintenant',
                'duration'    => '~20 min',
                'description' => 'Synthèse des 5 modules précédents. Ce module final : conduire une séance complète. Les 4 temps du rituel Pause Souffle.',
                'content'     => $intro,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 1 — Architecture de la séance — les 4 temps',
                'duration'    => '~25 min',
                'description' => 'Accueil · Exploration · Intégration · Clôture. Minutage pour 30, 45 et 60 minutes. La structure qui tient quelle que soit la durée.',
                'content'     => $architecture,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 2 — L\'accueil — créer l\'espace sécurisant',
                'duration'    => '~20 min',
                'description' => 'L\'accueil n\'est pas de la politesse — c\'est du soin. Check-in corporel · Intention · Installation. La respiration d\'entrée en 3 souffles.',
                'content'     => $accueil,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 3 — L\'exploration — guider sans diriger',
                'duration'    => '~25 min',
                'description' => 'Le silence comme outil. Les 5 gestes de l\'exploration. Ce que tu ne fais jamais en séance.',
                'content'     => $exploration,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 4 — Intégration et clôture — finir bien',
                'duration'    => '~20 min',
                'description' => 'Une séance mal clôturée fragilise. Une bien clôturée est thérapeutique. Protocole d\'intégration · Check-out · Ancrage · Mot de fin.',
                'content'     => $integration,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Éthique — Les limites du praticien',
                'duration'    => '~15 min',
                'description' => 'Les 5 interdits absolus. Diagnostiquer, promettre, dépasser ses compétences, créer dépendance, confondre les rôles. Un praticien qui respecte ses limites est un praticien qui dure.',
                'content'     => $ethique,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Pratique — Séance type guidée 45 minutes',
                'duration'    => '~60 min',
                'description' => 'Script complet : Accueil 8 min · Exploration 3 zones 25 min · Intégration 8 min · Clôture 4 min. Pratiquer seul·e d\'abord, puis avec une personne.',
                'content'     => $seance_type,
            ],
            [
                'type'        => 'exercice',
                'title'       => 'Intégration — Ma première vraie séance',
                'duration'    => '~90 min',
                'description' => 'Conduire une séance complète avec un proche de confiance. Enregistrement audio (avec accord). Notes post-séance : ce qui s\'est bien passé, ce qui était difficile, ce que le client a dit.',
                'content'     => $premiere_seance,
            ],
            [
                'type'        => 'reflexion',
                'title'       => 'Lettre — Au praticien que je suis devenu·e',
                'duration'    => '~20 min',
                'description' => 'Commence par : "Je suis arrivé·e à la fin de ce parcours. Je ne suis plus la même personne qu\'au Module 0. Voici ce que j\'ai découvert sur moi, sur le corps, sur le soin…"',
            ],
        ];

        DB::table('formation_modules')
            ->where('slug', '07-je-transmets-le-rituel')
            ->update([
                'intro_text'  => "JE TRANSMETS LE RITUEL PAUSE SOUFFLE — Formation Praticien · Module 01\n\nTu as fait le voyage intérieur. 7 modules. Tu connais le corps, tes blessures, ton souffle, ta mission, ta vision.\n\nMaintenant tu apprends à guider l'autre dans ce même voyage.\n\nCe module : conduire une séance réelle. Pas idéale. Pas parfaite. Vraie.",
                'description' => '4 leçons · Éthique praticien · Séance type 45 min · Première séance réelle. Formation Praticien — Module 01.',
                'activities'  => json_encode($activities),
                'updated_at'  => now(),
            ]);

        $this->command->info('[FormationModule06Seeder] ✓ 9 activités — Je transmets le Rituel · Module 07 (Praticien Module 01).');
    }
}
