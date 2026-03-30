<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * MODULE 11 — Lire un Client · Adapter le Protocole
 * Formation Praticien · Module professionnel
 * Arc pédagogique : 4 profils client · signaux non-verbaux · adaptation du 5-5-5 · question d'entrée
 */
class FormationPraticienModule11Seeder extends Seeder
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

        $intro = $this->card($gold, 'Module 11 · Praticien', 'Un protocole sur mesure commence avant de parler',
            '<div style="font-size:.88rem;line-height:2.1;color:rgba(232,224,208,.82);">
            Le protocole 5-5-5 est une base. Pas une formule figée.<br>
            <strong>Un praticien expert lit le client dès les 3 premières minutes</strong> et adapte la séance en conséquence.<br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;border:1px solid rgba(201,168,76,.15);margin:.75rem 0;">
            Il existe 4 grands profils de clients dans le travail corporel :<br><br>
            <strong>① L\'Analytique</strong> — dans sa tête, intellectualise, contrôle<br>
            <strong>② L\'Émotionnel</strong> — submergé, larmes proches, peu de contact avec le corps<br>
            <strong>③ Le Corporel</strong> — déjà présent, bon contact sensations, avance vite<br>
            <strong>④ Le Dissocié</strong> — absent, regard flou, pas de contact somatique<br><br>
            Même souffle · même durée · intention différente · mots différents.
            </div>
            Ce module vous donne les outils pour lire le profil en 3 minutes<br>
            et adapter votre protocole sans que le client ne s\'en rende compte.
            </div>'
        );

        $quatre_profils = $this->card($teal, 'Leçon 1', 'Les 4 profils client — caractéristiques et besoins',
            '<div style="font-size:.88rem;line-height:2.1;color:rgba(232,224,208,.82);">
            <div style="display:flex;flex-direction:column;gap:.9rem;margin:.75rem 0;">
            <div style="background:rgba(59,130,246,.08);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(59,130,246,.5);">
            <strong style="color:rgba(59,130,246,.9);">① L\'Analytique (dans la tête)</strong><br>
            <strong>Signaux</strong> : parle beaucoup avant, questions techniques, justifie ses émotions, respiration haute (clavicules)<br>
            <strong>Besoin</strong> : comprendre avant de lâcher prise — donner la logique avant la pratique<br>
            <strong>Adapter</strong> : expliquer brièvement la neurobiologie ("le 5-5 active votre nerf vague..."), puis guider<br>
            <strong>À éviter</strong> : "Arrêtez d\'analyser et ressentez" → panique assurée
            </div>
            <div style="background:rgba(168,85,247,.08);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(168,85,247,.5);">
            <strong style="color:rgba(168,85,247,.9);">② L\'Émotionnel (submergé)</strong><br>
            <strong>Signaux</strong> : larmes vite, voix qui tremble, déborde dans le récit, peut avoir peur de "trop sentir"<br>
            <strong>Besoin</strong> : sécurité et conteneur stable avant expansion<br>
            <strong>Adapter</strong> : cohérence 5-5 plus longue au départ (10 min), pas de soupir physiologique en ouverture<br>
            <strong>À éviter</strong> : visualisations chargées émotionnellement dès le début
            </div>
            <div style="background:rgba(34,197,94,.08);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(34,197,94,.5);">
            <strong style="color:rgba(34,197,94,.9);">③ Le Corporel (déjà présent)</strong><br>
            <strong>Signaux</strong> : contact direct, mots sensoriels naturels ("je sens...", "j\'ai l\'impression de..."), peu de résistance<br>
            <strong>Besoin</strong> : aller vite vers la profondeur, ne pas rester trop longtemps en surface<br>
            <strong>Adapter</strong> : cohérence courte (3 min) puis Pause Souffle 5-5-5 direct + visualisation<br>
            <strong>À éviter</strong> : trop d\'explications — ça rompt le lien somatique
            </div>
            <div style="background:rgba(249,115,22,.08);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(249,115,22,.5);">
            <strong style="color:rgba(249,115,22,.9);">④ Le Dissocié (absent)</strong><br>
            <strong>Signaux</strong> : regard qui fuit, réponses brèves, semble "flotter", peu de contact visuel, voix plate<br>
            <strong>Besoin</strong> : ancrage corporel progressif avant tout travail<br>
            <strong>Adapter</strong> : commencer par l\'ancrage pieds-sol ("sentez vos pieds..."), box breathing 4-4-4-4, contact tactile si accord<br>
            <strong>À éviter</strong> : aller dans les émotions avant d\'avoir ancré — risque de dissociation plus profonde
            </div>
            </div>
            </div>'
        );

        $signaux_nonverbaux = $this->card($blue, 'Leçon 2', 'Lire les signaux non-verbaux — les 5 canaux',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Avant que le client parle, cinq canaux vous informent déjà.<br><br>
            <div style="display:flex;flex-direction:column;gap:.75rem;margin:.75rem 0;">
            <div>
            <strong style="color:rgba(59,130,246,.9);">① La posture :</strong><br>
            · Dos voûté → charge portée, fatigue chronique → praticien = conteneur sécurisant<br>
            · Bras croisés → défense → pas de toucher d\'emblée, créer de la sécurité verbale<br>
            · Corps ouvert → disponibilité → vous pouvez aller plus loin
            </div>
            <div>
            <strong style="color:rgba(59,130,246,.9);">② La respiration observable :</strong><br>
            · Haute (épaules/clavicules) → stress, analytique, déconnexion<br>
            · Abdominale → présence, corporel, relatif équilibre<br>
            · Retenue (apnée fréquente) → dissociation ou trauma stocké
            </div>
            <div>
            <strong style="color:rgba(59,130,246,.9);">③ Le regard :</strong><br>
            · Regard direct mais doux → contact, disponibilité<br>
            · Regard fuyant → timidité ou dissociation → pas de fixation de votre part<br>
            · Regard vague, perdu → dissociation → ancrage prioritaire
            </div>
            <div>
            <strong style="color:rgba(59,130,246,.9);">④ La voix :</strong><br>
            · Voix rapide, débit élevé → analytique ou anxieux<br>
            · Voix très douce, peu de volume → émotionnel, besoin de sécurité<br>
            · Voix plate → dissociation possible · voix tremblante → émotion proche de la surface
            </div>
            <div>
            <strong style="color:rgba(59,130,246,.9);">⑤ Le premier mot sur l\'état :</strong><br>
            · "Je suis épuisé" → corps d\'abord → corporel ou dissocié<br>
            · "Je ne comprends pas pourquoi je ressens ça" → analytique<br>
            · "Je suis à bout" → émotionnel, conteneur prioritaire
            </div>
            </div>
            <em style="color:rgba(201,168,76,.8);">Vous avez 3 minutes. 5 canaux. Une intention : adapter sans que ça se voit.</em>
            </div>'
        );

        $adapter_5_5_5 = $this->card($purple, 'Leçon 3', 'Adapter le protocole 5-5-5 selon le profil',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Le 5-5-5 s\'adapte. La durée, l\'intention et les mots changent — la structure reste.<br><br>
            <div style="display:flex;flex-direction:column;gap:.9rem;margin:.75rem 0;">
            <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.75rem 1rem;">
            <strong style="color:rgba(59,130,246,.8);">Analytique :</strong><br>
            Ouverture : "Je vous explique ce qui va se passer neurologiquement..."<br>
            Cohérence 5-5 : 7-8 min (logique, ancrage)<br>
            5-5-5 : "Chaque cycle active votre système parasympathique"<br>
            Moins de "ressentez" → plus de "observez, notez"
            </div>
            <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.75rem 1rem;">
            <strong style="color:rgba(168,85,247,.8);">Émotionnel :</strong><br>
            Ouverture : Accueil long, validation de l\'état ("C\'est ok d\'être là comme ça")<br>
            Cohérence 5-5 : 10-12 min (sécurité d\'abord)<br>
            5-5-5 : "Vous pouvez rester en sécurité dans votre corps"<br>
            Silences plus longs. Voix encore plus posée.
            </div>
            <div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.75rem 1rem;">
            <strong style="color:rgba(34,197,94,.8);">Corporel :</strong><br>
            Ouverture : Minimum de préambule<br>
            Cohérence 5-5 : 3-4 min (déjà là)<br>
            5-5-5 + visualisation dès le 2e cycle<br>
            "Laissez venir... Restez dans le ressenti..."
            </div>
            <div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.75rem 1rem;">
            <strong style="color:rgba(249,115,22,.8);">Dissocié :</strong><br>
            Ouverture : Ancrage pieds (5 min debout si possible)<br>
            Box 4-4-4-4 avant le 5-5 (stimule le système nerveux)<br>
            5-5-5 : "Sentez vos pieds · vos fesses sur la chaise · le sol"<br>
            Pas de visualisation ce jour. Présence corporelle prioritaire.
            </div>
            </div>
            </div>'
        );

        $question_entree = $this->card($green, 'Leçon 4', 'La question d\'entrée selon le profil',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            La question d\'entrée est la clé qui ouvre ou ferme la porte.<br>
            Elle doit être calibrée sur le profil.<br><br>
            <div style="background:rgba(34,197,94,.06);border-radius:10px;padding:.85rem 1.1rem;display:flex;flex-direction:column;gap:.85rem;margin:.75rem 0;">
            <div>
            <strong style="color:rgba(59,130,246,.8);">Analytique :</strong><br>
            ✗ "Comment vous sentez-vous physiquement ?" (trop vague)<br>
            ✓ "Si vous deviez décrire votre état mental aujourd\'hui sur une échelle de 1 à 10, vous êtes où ?"<br>
            <em>Logique + structure → porte ouverte</em>
            </div>
            <div>
            <strong style="color:rgba(168,85,247,.8);">Émotionnel :</strong><br>
            ✗ "Qu\'est-ce que vous voulez travailler aujourd\'hui ?" (trop direct)<br>
            ✓ "Comment vous êtes-vous réveillé·e ce matin ?"<br>
            <em>Douceur + invitation non menaçante → sécurité</em>
            </div>
            <div>
            <strong style="color:rgba(34,197,94,.8);">Corporel :</strong><br>
            ✗ "Qu\'est-ce que vous avez sur le cœur ?" (trop intellectuel)<br>
            ✓ "Avant qu\'on commence — posez la main sur le ventre. Qu\'est-ce qui est là ?"<br>
            <em>Direct + somatique → déjà dans la séance</em>
            </div>
            <div>
            <strong style="color:rgba(249,115,22,.8);">Dissocié :</strong><br>
            ✗ "Comment vous sentez-vous ?" (pas de réponse disponible)<br>
            ✓ "Prenez un moment. Sentez vos pieds sur le sol. Je reste là avec vous."<br>
            <em>Pas de question — une invitation à revenir</em>
            </div>
            </div>
            </div>'
        );

        $grille_pratique = $this->card($orange, 'Intégration', 'Grille de lecture rapide — les 3 premières minutes',
            '<div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.9rem 1.1rem;border:1px solid rgba(249,115,22,.12);">
            <strong>Pendant l\'accueil, observer silencieusement :</strong><br><br>
            □ Posture : ouverte / fermée / effondrée / rigide<br>
            □ Respiration : haute / abdominale / retenue<br>
            □ Regard : contact / fuyant / vague<br>
            □ Voix : rapide / douce / plate / tremblante<br>
            □ Premier mot sur l\'état : corps / mental / émotions<br><br>
            <strong>Profil probable :</strong> ___<br>
            <strong>Question d\'entrée choisie :</strong> ___<br>
            <strong>Adaptation protocole :</strong><br>
            · Cohérence : ___ min<br>
            · Ouverture 5-5-5 : avec ou sans visualisation<br>
            · Technique complémentaire si besoin : ___<br><br>
            <em>Cette grille devient automatique après 20-30 séances. Au début, prenez une note mentale pendant l\'accueil.</em>
            </div>'
        );

        $activities = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — Le protocole sur mesure commence avant de parler',
                'duration'    => '10 min',
                'description' => 'Les 4 profils client. Même souffle, intention différente. L\'adaptation invisible.',
                'content'     => $intro,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 1 — Les 4 profils : analytique, émotionnel, corporel, dissocié',
                'duration'    => '30 min',
                'description' => 'Caractéristiques · signaux · besoins · adaptation · ce qu\'il ne faut pas dire. Tableau comparatif des 4 profils.',
                'content'     => $quatre_profils,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 2 — Les 5 canaux non-verbaux',
                'duration'    => '25 min',
                'description' => 'Posture · respiration observable · regard · voix · premier mot. 3 minutes pour profiler silencieusement.',
                'content'     => $signaux_nonverbaux,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 3 — Adapter le 5-5-5 selon le profil',
                'duration'    => '20 min',
                'description' => 'Structure identique, durée · intention · mots · techniques adaptés. 4 variantes concrètes du protocole.',
                'content'     => $adapter_5_5_5,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 4 — La question d\'entrée par profil',
                'duration'    => '15 min',
                'description' => 'Ce qui ouvre ou ferme la porte. 4 questions précises et 4 contre-exemples à éviter.',
                'content'     => $question_entree,
            ],
            [
                'type'        => 'exercice',
                'title'       => 'Intégration — Grille de lecture rapide',
                'duration'    => '20 min',
                'description' => 'Grille des 3 premières minutes : observer · profiler · adapter. À utiliser dès la prochaine séance.',
                'content'     => $grille_pratique,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Pratique — Séance test avec observation guidée',
                'duration'    => '60 min',
                'description' => 'Pratiquer avec un proche ou volontaire. Identifier le profil avant de commencer. Adapter. Après séance : noter ce qui a fonctionné et ce qui était difficile.',
            ],
        ];

        DB::table('formation_modules')->updateOrInsert(
            ['slug' => '11-lire-un-client-adapter-le-protocole', 'track' => 'praticien'],
            [
                'slug'        => '11-lire-un-client-adapter-le-protocole',
                'title'       => 'Lire un Client — Adapter le Protocole',
                'week_label'  => 'Module 11',
                'track'       => 'praticien',
                'order'       => 7,
                'is_active'   => true,
                'intro_text'  => "LIRE UN CLIENT — ADAPTER LE PROTOCOLE — Module Praticien 11\n\nUn protocole sur mesure commence avant même la première respiration guidée.\n\nLes 4 profils client · 5 canaux non-verbaux · adaptation du 5-5-5 · question d'entrée calibrée. La personnalisation invisible.",
                'description' => '4 profils (analytique · émotionnel · corporel · dissocié) · 5 canaux non-verbaux · adaptation protocole 5-5-5 · question d\'entrée par profil · grille de lecture en 3 minutes.',
                'activities'  => json_encode($activities),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        );

        $this->command->info('[FormationPraticienModule11Seeder] ✓ 7 activités — Lire un Client, Adapter le Protocole.');
    }
}
