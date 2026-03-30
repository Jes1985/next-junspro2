<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * MODULE 12 — Construire une Pratique Professionnelle
 * Formation Praticien · Module professionnel
 * Arc pédagogique : offre · tarification · 3 premiers clients · présence digitale · administration
 */
class FormationPraticienModule12Seeder extends Seeder
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

        $intro = $this->card($gold, 'Module 12 · Praticien', 'La pratique ne se construit pas — elle se conçoit',
            '<div style="font-size:.88rem;line-height:2.1;color:rgba(232,224,208,.82);">
            La majorité des praticiens formés n\'exercent jamais —<br>
            ou abandonnent dans les 18 premiers mois.<br><br>
            Pas par manque de compétence. Mais parce qu\'ils n\'ont pas défini leur offre,<br>
            pas osé fixer leurs tarifs, pas su comment trouver leurs 3 premiers clients.<br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;border:1px solid rgba(201,168,76,.15);margin:.75rem 0;">
            Ce module traite ce que les formations ne disent jamais :<br>
            <strong>le business de la pratique des soins.</strong><br><br>
            Ce n\'est pas la séance qui vous fait praticien.<br>
            C\'est la décision de vous installer — et de continuer.
            </div>
            Ce module couvre 5 blocs concrets :<br>
            ① L\'offre de services<br>
            ② La tarification<br>
            ③ Les 3 premiers clients<br>
            ④ La présence digitale minimale<br>
            ⑤ L\'administration simple
            </div>'
        );

        $offre = $this->card($teal, 'Leçon 1', 'Définir son offre — 4 formats de service',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            <div style="display:flex;flex-direction:column;gap:.85rem;margin:.75rem 0;">
            <div style="background:rgba(20,184,166,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(20,184,166,.4);">
            <strong style="color:rgba(20,184,166,.9);">① Séance individuelle (75-90 min)</strong><br>
            Format de base. Idéal pour démarrer. Tout profil de client.<br>
            Structure : accueil (10 min) · ancrage respiratoire (15 min) · travail principal (40 min) · intégration (15 min) · clôture (10 min)<br>
            <em>Tarif suggéré pour un praticien débutant : 60-80€</em>
            </div>
            <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(59,130,246,.4);">
            <strong style="color:rgba(59,130,246,.9);">② Suivi 3 séances (package)</strong><br>
            Pour un enjeu spécifique : épuisement professionnel / transition de vie / reconnexion après période difficile.<br>
            Structure : séance 1 (diagnostic somatique) · séance 2 (travail principal) · séance 3 (intégration + ancrage)<br>
            <em>Tarif suggéré : 180-220€ (léger avantage vs séance à l\'unité)</em>
            </div>
            <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(168,85,247,.4);">
            <strong style="color:rgba(168,85,247,.9);">③ Suivi 6 séances (accompagnement)</strong><br>
            Pour une transformation durable. Client qui veut une pratique régulière.<br>
            Engagement sur 6-8 semaines. Bilan à mi-parcours.<br>
            <em>Tarif suggéré : 350-420€ — fidélité + profondeur</em>
            </div>
            <div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(249,115,22,.4);">
            <strong style="color:rgba(249,115,22,.9);">④ Atelier en groupe (90-120 min)</strong><br>
            6-12 personnes. Format collectif idéal pour toucher un public plus large et créer de la communauté.<br>
            Themes : gestion du stress · reconnexion au corps · cohérence cardiaque · rituel du matin.<br>
            <em>Tarif suggéré : 25-45€/personne (rentable dès 6 personnes)</em>
            </div>
            </div>
            <strong>Recommandation de démarrage :</strong><br>
            Commencer par la séance individuelle + 1 atelier groupe/mois.<br>
            L\'atelier crée la visibilité. La séance individuelle crée la profondeur.
            </div>'
        );

        $tarification = $this->card($blue, 'Leçon 2', 'La tarification — se positionner sans se brader',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            La question du tarif est la plus difficile pour les praticiens débutants.<br>
            <strong>La peur de demander de l\'argent pour aider les gens est réelle — et limitante.</strong><br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;border:1px solid rgba(201,168,76,.15);">
            <strong style="color:rgba(201,168,76,.9);">La vérité sur les tarifs bas :</strong><br>
            Un tarif trop bas envoie 3 signaux négatifs :<br>
            ① "Mon travail n\'a pas beaucoup de valeur"<br>
            ② "Je ne suis pas vraiment professionnel"<br>
            ③ Attire des clients qui testent plutôt que des clients qui s\'engagent<br><br>
            <em>La valeur d\'une séance ne se mesure pas au tarif d\'un massage. Elle se mesure à l\'impact.</em>
            </div>
            <strong>Fourchettes tarifaires du praticien Pause Souffle :</strong><br><br>
            <div style="display:flex;flex-direction:column;gap:.6rem;margin:.75rem 0;">
            <div style="display:flex;justify-content:space-between;padding:.5rem .85rem;background:rgba(0,0,0,.2);border-radius:8px;">
            <span>Praticien en formation / 1ères séances</span>
            <strong style="color:rgba(34,197,94,.9);">40-60 €</strong>
            </div>
            <div style="display:flex;justify-content:space-between;padding:.5rem .85rem;background:rgba(0,0,0,.2);border-radius:8px;">
            <span>Praticien certifié · 0-1 an d\'expérience</span>
            <strong style="color:rgba(34,197,94,.9);">65-85 €</strong>
            </div>
            <div style="display:flex;justify-content:space-between;padding:.5rem .85rem;background:rgba(0,0,0,.2);border-radius:8px;">
            <span>Praticien confirmé · 1-3 ans d\'expérience</span>
            <strong style="color:rgba(34,197,94,.9);">90-120 €</strong>
            </div>
            <div style="display:flex;justify-content:space-between;padding:.5rem .85rem;background:rgba(0,0,0,.2);border-radius:8px;">
            <span>Praticien spécialisé / reconnu</span>
            <strong style="color:rgba(201,168,76,.9);">130-180 €+</strong>
            </div>
            </div>
            <strong>Augmenter ses tarifs :</strong><br>
            Augmenter dès que vous avez 10-15 témoignages solides. Pas avant, pas après.
            </div>'
        );

        $premiers_clients = $this->card($purple, 'Leçon 3', 'Les 3 premiers clients — stratégie concrète en 4 étapes',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            <strong>Le plus dur n\'est pas les 100 clients. C\'est les 3 premiers.</strong><br>
            Parce qu\'ils valident votre légitimité à vos propres yeux.<br><br>
            <div style="display:flex;flex-direction:column;gap:.9rem;margin:.75rem 0;">
            <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.85rem 1.1rem;">
            <strong style="color:rgba(168,85,247,.9);">Étape 1 — Faire une liste de 20 personnes</strong><br>
            Famille, amis, collègues, anciens collègues, contacts réseaux sociaux.<br>
            Critère unique : qui <em>pourrait bénéficier</em> d\'une séance de souffle ?<br>
            Pas qui va dire oui. Qui pourrait bénéficier.
            </div>
            <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.85rem 1.1rem;">
            <strong style="color:rgba(59,130,246,.9);">Étape 2 — Les 3 premières offerts</strong><br>
            Proposer 3 séances gratuites ou symboliques (20€) à 3 personnes de la liste.<br>
            Objectif : pratiquer en conditions réelles + obtenir 3 témoignages écrits.
            </div>
            <div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.85rem 1.1rem;">
            <strong style="color:rgba(34,197,94,.9);">Étape 3 — Le message de lancement</strong><br>
            SMS/WhatsApp personnel (pas de post public) :<br>
            <em>"Coucou [prénom], je viens de terminer ma formation de praticien Pause Souffle. Je cherche 3 personnes pour une séance offerte en échange d\'un retour honnête. Si tu es intéressé·e ou si tu connais quelqu\'un, tu peux me répondre ici."</em>
            </div>
            <div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.85rem 1.1rem;">
            <strong style="color:rgba(249,115,22,.9);">Étape 4 — Le témoignage demandé</strong><br>
            Après chaque séance offerte, demander :<br>
            <em>"Si tu devais expliquer à quelqu\'un ce que tu as vécu aujourd\'hui en 2-3 phrases pour l\'aider à décider, qu\'est-ce que tu dirais ?"</em><br>
            Recueillez-le par écrit ou vocal. Ces témoignages valent plus que n\'importe quelle publicité.
            </div>
            </div>
            </div>'
        );

        $presence_digitale = $this->card($orange, 'Leçon 4', 'Présence digitale minimale — ce qu\'il faut vraiment',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Vous n\'avez pas besoin d\'un site web pour démarrer.<br>
            Vous n\'avez pas besoin de 1000 abonnés Instagram.<br><br>
            <strong>Ce dont vous avez besoin :</strong><br><br>
            <div style="display:flex;flex-direction:column;gap:.75rem;margin:.75rem 0;">
            <div style="background:rgba(34,197,94,.06);border-radius:10px;padding:.75rem 1rem;">
            <strong style="color:rgba(34,197,94,.8);">① Un profil clair en 3 lignes</strong><br>
            "Praticien Pause Souffle certifié. J\'accompagne [qui] à [quoi] grâce aux techniques respiratoires et à la présence corporelle."<br>
            Utilisable : Instagram bio / WhatsApp status / signature email / LinkedIn
            </div>
            <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.75rem 1rem;">
            <strong style="color:rgba(59,130,246,.8);">② 3 témoignages écrits ou vocaux</strong><br>
            Pas de témoignage vague ("c\'était bien"). Des témoignages de transformation spécifique.<br>
            Format idéal : avant → pendant → après.
            </div>
            <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.75rem 1rem;">
            <strong style="color:rgba(168,85,247,.8);">③ Un lien de réservation simple</strong><br>
            Calendly gratuit. Ou simplement : "Envoie-moi un message pour réserver."<br>
            La friction zéro sur la prise de contact est prioritaire.
            </div>
            <div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.75rem 1rem;">
            <strong style="color:rgba(249,115,22,.8);">④ Un contenu par semaine (optionnel mais puissant)</strong><br>
            Pas de stratégie Instagram complexe — une astuce souffle par semaine :<br>
            texte / carotte / reel 30s. La régularité > le volume.
            </div>
            </div>
            </div>'
        );

        $admin = $this->card($green, 'Leçon 5', 'Administration simple — facturation, agenda et contrat',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            La partie que personne ne mentionne — et qui sauve de beaucoup d\'ennuis :<br><br>
            <div style="display:flex;flex-direction:column;gap:.75rem;margin:.75rem 0;">
            <div>
            <strong style="color:rgba(201,168,76,.9);">Statut légal :</strong><br>
            Auto-entrepreneur ou micro-entreprise si vous êtes en France.<br>
            Inscription Urssaf obligatoire dès le premier euro encaissé.<br>
            Code APE à choisir : 8690F (Autres activités de santé humaine)
            </div>
            <div>
            <strong style="color:rgba(20,184,166,.9);">Facturation :</strong><br>
            Applications gratuites recommandées : Freebe / Shine / Henrri (factures légales en 5 min)<br>
            Chaque séance = une facture. Même les offerts (facture à 0€ pour le suivi).
            </div>
            <div>
            <strong style="color:rgba(59,130,246,.9);">Agenda :</strong><br>
            Calendly (gratuit) pour la prise de rdv automatisée.<br>
            Google Agenda pour la gestion des jours/heures disponibles.<br>
            Bloquer les plages de supervision et de votre propre pratique EN PREMIER.
            </div>
            <div>
            <strong style="color:rgba(168,85,247,.9);">Contrat de prestation :</strong><br>
            Un document simple (1 page) que le client signe avant ou lors de la première séance :<br>
            · Nature de la prestation (accompagnement corporel)<br>
            · Ce que ce n\'est pas (pas de médecine, pas de psychothérapie)<br>
            · Confidentialité des échanges<br>
            · Tarif et modalités d\'annulation
            </div>
            </div>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.75rem 1rem;margin-top:.75rem;border:1px solid rgba(201,168,76,.15);">
            <strong style="color:rgba(201,168,76,.9);">La règle de base :</strong><br>
            Un praticien qui n\'a pas de contrat, pas de statut et pas de facture<br>
            n\'est pas un praticien professionnel — c\'est un bénévole stressé.
            </div>
            </div>'
        );

        $plan_action = $this->card($teal, 'Intégration', 'Mon plan de lancement en 30 jours',
            '<div style="background:rgba(20,184,166,.07);border-radius:10px;padding:.9rem 1.1rem;border:1px solid rgba(20,184,166,.12);">
            <strong>Semaine 1 — Les fondations :</strong><br>
            □ Créer le statut auto-entrepreneur<br>
            □ Rédiger ma phrase-offre en 3 lignes<br>
            □ Créer mon lien Calendly<br><br>
            <strong>Semaine 2 — Les 3 premières séances :</strong><br>
            □ Liste de 20 contacts potentiels<br>
            □ Envoyer 5 messages personnels (offre de séance)<br>
            □ Réaliser 3 séances offertes<br><br>
            <strong>Semaine 3 — Les témoignages :</strong><br>
            □ Demander 3 témoignages écrits ou vocaux<br>
            □ Publier 1 contenu avec un témoignage sur réseau social<br><br>
            <strong>Semaine 4 — Le premier tarif :</strong><br>
            □ Annoncer votre tarif ouvertement (même bas est ok au départ)<br>
            □ Envoyer votre première vraie facture<br>
            □ Planifier votre première session de supervision
            </div>'
        );

        $activities = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — La pratique se conçoit, pas seulement se fait',
                'duration'    => '10 min',
                'description' => 'Pourquoi 70% des praticiens formés n\'exercent jamais. Les 5 blocs qui font tenir une pratique dans le temps.',
                'content'     => $intro,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 1 — Les 4 formats de service',
                'duration'    => '25 min',
                'description' => 'Séance individuelle · suivi 3 · suivi 6 · atelier groupe. Structure, durée et tarif indicatif pour chaque format.',
                'content'     => $offre,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 2 — La tarification sans se brader',
                'duration'    => '20 min',
                'description' => 'Pourquoi un tarif bas nuit. 4 niveaux de tarif praticien Pause Souffle. Quand et comment augmenter.',
                'content'     => $tarification,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 3 — Les 3 premiers clients',
                'duration'    => '25 min',
                'description' => '4 étapes concrètes : liste 20 personnes · 3 séances offertes · message de lancement · témoignage guidé.',
                'content'     => $premiers_clients,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 4 — Présence digitale minimale',
                'duration'    => '20 min',
                'description' => 'Profil en 3 lignes · 3 témoignages · lien de réservation · 1 contenu/semaine optionnel. La friction zéro comme priorité.',
                'content'     => $presence_digitale,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 5 — Administration simple',
                'duration'    => '20 min',
                'description' => 'Statut auto-entrepreneur · facturation (Freebe/Shine) · agenda Calendly · contrat de prestation 1 page.',
                'content'     => $admin,
            ],
            [
                'type'        => 'exercice',
                'title'       => 'Intégration — Plan de lancement en 30 jours',
                'duration'    => '30 min',
                'description' => 'Checklist semaine par semaine : statut · 3 premières séances · témoignages · premier tarif affiché. Action concrète, pas de théorie.',
                'content'     => $plan_action,
            ],
        ];

        DB::table('formation_modules')->updateOrInsert(
            ['slug' => '12-construire-une-pratique-professionnelle', 'track' => 'praticien'],
            [
                'slug'        => '12-construire-une-pratique-professionnelle',
                'title'       => 'Construire une Pratique Professionnelle',
                'week_label'  => 'Module 12',
                'track'       => 'praticien',
                'order'       => 8,
                'is_active'   => true,
                'intro_text'  => "CONSTRUIRE UNE PRATIQUE PROFESSIONNELLE — Module Praticien 12\n\nCe que les formations ne disent jamais : le business de la pratique des soins.\n\n4 formats de service · tarification sans se brader · 3 premiers clients · présence digitale minimale · administration simple.",
                'description' => '4 formats de service (séance · suivi 3 · suivi 6 · groupe) · tarification avec fourchettes praticien PS · stratégie 3 premiers clients · présence digitale minimale · statut/facturation/contrat.',
                'activities'  => json_encode($activities),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        );

        $this->command->info('[FormationPraticienModule12Seeder] ✓ 7 activités — Construire une Pratique Professionnelle.');
    }
}
