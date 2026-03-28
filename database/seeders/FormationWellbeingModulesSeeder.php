<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Formation Pause Souffle — Extension Vie Complète (Modules 07-22)
 *
 * Modules :
 *   07 — Mouvement & Posture        08 — Système nerveux
 *   09 — Gestion des émotions       10 — Sommeil & Récupération
 *   11 — Relation à l'alimentation  12 — Présence à soi
 *   13 — Confiance corporelle       14 — Interactions sociales
 *   15 — Activité physique          16 — Loisirs, sorties & voyages
 *   17 — Relation à l'autre         18 — Énergie relationnelle & intimité
 *   19 — Médecines complémentaires  20 — Vivre, choisir, se reconstruire
 *   21 — Entretenir nos relations   22 — Nutrition & Vitalité
 */
class FormationWellbeingModulesSeeder extends Seeder
{
    // ── Helpers HTML ──────────────────────────────────────────────────────────
    private function card(string $color, string $badge, string $title, string $body): string
    {
        return '<div style="border-left:3px solid '.$color.';padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(0,0,0,.15);border-radius:0 10px 10px 0;">'
            .'<h4 style="color:#fff;font-size:.87rem;font-weight:700;margin:0 0 .5rem;display:flex;align-items:center;gap:.6rem;">'
            .'<span style="font-size:.68rem;color:'.$color.';background:rgba(0,0,0,.35);border:1px solid '.$color.';border-radius:6px;padding:.1rem .4rem;flex-shrink:0;">'.$badge.'</span>'
            .$title.'</h4>'
            .'<div style="font-size:.8rem;color:rgba(232,224,208,.72);line-height:1.85;">'.$body.'</div>'
            .'</div>';
    }

    private function exercice(string $color, string $num, string $titre, string $corps, bool $audio = false): string
    {
        $audioTag = $audio
            ? '<div style="margin-top:.6rem;background:rgba(0,0,0,.25);border-radius:8px;padding:.5rem 1rem;font-size:.75rem;color:'.$color.';border:1px dashed '.$color.';">🎧 Exercice guidé audio inclus</div>'
            : '';
        return '<div style="background:rgba(0,0,0,.2);border:1px solid '.$color.'22;border-radius:12px;padding:1.1rem 1.3rem;margin-bottom:.75rem;">'
            .'<div style="display:flex;align-items:center;gap:.65rem;margin-bottom:.55rem;">'
            .'<span style="width:28px;height:28px;border-radius:50%;background:'.$color.'22;border:1.5px solid '.$color.';display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:800;color:'.$color.';flex-shrink:0;">'.$num.'</span>'
            .'<span style="font-size:.88rem;font-weight:700;color:#fff;">'.$titre.'</span>'
            .'</div>'
            .'<div style="font-size:.79rem;color:rgba(232,224,208,.75);line-height:1.9;padding-left:2.1rem;">'.$corps.'</div>'
            .$audioTag.'</div>';
    }

    // ─────────────────────────────────────────────────────────────────────────
    // CONTENU PAR MODULE
    // ─────────────────────────────────────────────────────────────────────────

    private function m07(): array  // Mouvement & Posture
    {
        $teal   = 'rgba(20,184,166,.8)';
        $gold   = 'rgba(201,168,76,.9)';
        $blue   = 'rgba(59,130,246,.8)';
        $green  = 'rgba(34,197,94,.8)';
        $purple = 'rgba(168,85,247,.8)';

        $intro = $this->card($gold, 'Pourquoi', 'Le corps a besoin de bouger pour penser clairement',
            'La posture n\'est pas esthétique. Elle est <strong>neurologique</strong>.<br><br>
            Quand le corps est figé dans la même position trop longtemps : la circulation ralentit, les fascias se rigidifient, le diaphragme se comprime.<br><br>
            <strong>Le mouvement conscient n\'est pas du sport.</strong> C\'est une façon de parler à son système nerveux : <em>"Je suis vivant, je suis en sécurité, je peux m\'ouvrir."</em><br><br>
            Ce module vous apprend à bouger avec intelligence — 5 à 20 minutes par jour suffisent.'
        );

        $lecon1 = $this->card($teal, 'Les 3 axes', 'Comment le corps s\'organise dans l\'espace',
            '<strong>① Axe vertical (flexion/extension)</strong> — se courber en avant, se redresser.<br>
            Muscles concernés : érecteurs du rachis, psoas, abdominaux profonds.<br><br>
            <strong>② Axe horizontal (rotation)</strong> — tourner le buste, la tête, le bassin.<br>
            Muscles concernés : multifides, carrés des lombes, rotatoires du rachis.<br><br>
            <strong>③ Axe latéral (inclinaison)</strong> — se pencher sur le côté, s\'étirer.<br>
            Muscles concernés : quadratus lumborum, scalènes, fléchisseurs latéraux.<br><br>
            <em style="color:'.$teal.';">Un corps qui n\'utilise pas les 3 axes dans la journée accumule des tensions unilatérales.</em>'
        ).$this->card($blue, 'La posture debout', '5 repères pour se tenir debout sans effort',
            '① <strong>Pieds</strong> — parallèles, largeur des épaules, poids réparti sur les 3 points d\'appui (talon, métatarses 1 et 5).<br>
            ② <strong>Genoux</strong> — légèrement déverrouillés, jamais en hyperextension.<br>
            ③ <strong>Bassin</strong> — ni basculé en avant (lordose excessive), ni rentré en arrière (dos plat). Neutre.<br>
            ④ <strong>Épaules</strong> — relâchées, légèrement en arrière. Pas haussées vers les oreilles.<br>
            ⑤ <strong>Tête</strong> — comme suspendue par le sommet du crâne. Menton légèrement rentré (pas enfoncé).'
        );

        $lecon2 = $this->card($purple, 'Posture assise', 'Travailler assis sans se détruire',
            '<strong>Le problème :</strong> assis, le psoas se rétracte, le diaphragme se comprime, la circulation dans les jambes ralentit de 50%.<br><br>
            <strong>Solution Pause Souffle :</strong><br>
            · Toutes les 40 minutes : se lever 2 minutes<br>
            · Pieds bien à plat (pas croisés)<br>
            · Avant du siège utilisé, pas le dossier<br>
            · Écran à hauteur des yeux<br>
            · <strong>1 cycle 5-5-5</strong> à chaque transition assis ↔ debout'
        );

        $ex1 = $this->exercice($teal, '1', 'L\'ondulation vertébrale (3 min)',
            'Debout. Pieds largeur des hanches.<br>
            Commencez par plier légèrement les genoux.<br>
            Imprimez un mouvement de vague de bas en haut le long de la colonne.<br>
            Bassin → lombaires → thoracique → cervicales → tête.<br>
            5 ondulations lentes. Respirez librement.<br>
            <em>Ressenti cible : chaleur le long du dos, nuque qui se dépose.</em>', true
        );

        $ex2 = $this->exercice($gold, '2', 'L\'étirement des fascias (5 min)',
            'Allongé sur le dos. Jambes allongées. Bras en croix, paumes vers le haut.<br>
            Inspiration 5s : rien ne bouge.<br>
            Expiration 5s : laissez le dos "fondre" dans le sol, millimètre par millimètre.<br>
            Rétention 5s : ressentez toute la longueur de votre corps.<br>
            Répétez 6 cycles.<br>
            <em>Ce n\'est pas un étirement musculaire — c\'est une réhydratation fasciale par la gravité et le souffle.</em>', true
        );

        $ex3 = $this->exercice($green, '3', 'La rotation thoracique (4 min)',
            'Assis en tailleur ou sur une chaise. Main droite derrière la tête, coude pointé vers le plafond.<br>
            Inspiration 5s : préparez.<br>
            Expiration 5s : tournez lentement vers la droite en engageant le thorax (pas les hanches).<br>
            Rétention 5s : maintenez en douceur. Retour inspiration.<br>
            4 répétitions par côté.<br>
            <em>Les rotations thoraciques débloquent le nerf vague — effet calmant direct.</em>', false
        );

        $meditation = $this->card($teal, 'Méditation guidée', '🌬 Pause Souffle — Colonne vivante (8 min)',
            'Debout, pieds largeur des épaules. Fermez les yeux.<br><br>
            Portez toute l\'attention sur votre colonne vertébrale — depuis le coccyx jusqu\'au sommet du crâne.<br><br>
            <strong>Inspiration 5s</strong> — imaginez que la colonne grandit légèrement de la base vers le sommet. Chaque vertèbre s\'espace de quelques millimètres.<br>
            <strong>Rétention 5s</strong> — sentez l\'espace créé, la longueur, la solidité de votre axe central.<br>
            <strong>Expiration 5s</strong> — laissez les épaules fondre, le visage se détendre, les mains s\'alourdir.<br><br>
            8 cycles. À pratiquer en début de journée pour "activer" votre corps, ou après une longue session assise.<br><br>
            <em>Cette méditation posturale entraîne la conscience proprioceptive — vous saurez instinctivement où vous en êtes corporellement au fil du temps.</em>'
        );

        $reflexion = $this->card($gold, 'Journal', 'Clôture du module — Ma posture dans ma vie',
            'Prenez 5 minutes et répondez honnêtement par écrit :<br><br>
            · Dans quelle(s) situation(s) ma posture se contracte-t-elle ? (stress, fatigue, interactions difficiles)<br>
            · Quelle est "ma posture par défaut" quand personne ne me regarde ?<br>
            · Quel message est-ce que j\'envoie à mon système nerveux à travers cette posture habituelle ?<br>
            · Comment est-ce que je veux me tenir dans ma vie — physiquement et symboliquement ?<br><br>
            <em>La posture est le miroir de votre état intérieur — et elle le construit en retour.</em>'
        );

        return [
            'description' => 'Mouvement & Posture — apprendre à bouger avec intelligence pour libérer les tensions, activer la circulation et nourrir le système nerveux.',
            'intro_text'  => "MODULE 07 — Mouvement & Posture\n\nLe mouvement n'est pas du sport. C'est une conversation silencieuse avec votre système nerveux. Chaque posture que vous adoptez envoie un signal au cerveau — d'ouverture ou de contraction, de sécurité ou de danger. Ce module vous donne les outils pour bouger avec intelligence et habiter votre corps autrement.",
            'audio_path'  => 'formation/audio/07-mouvement-posture-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '🟤 Introduction — Le corps en mouvement',                 'duration' => '3 min', 'description' => 'Pourquoi le mouvement conscient parle directement au système nerveux.', 'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — Les 3 axes & la posture debout',                'duration' => '4 min', 'description' => 'Comment le corps s\'organise dans l\'espace et les 5 repères de la posture debout.', 'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Travailler assis sans se détruire',             'duration' => '3 min', 'description' => 'La posture assise, le psoas et la solution Pause Souffle.', 'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique guidée — L\'ondulation vertébrale',              'duration' => '3 min', 'description' => 'Réveiller la colonne en vague, de la base jusqu\'à la tête.', 'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — Étirement fascias & rotation thoracique',      'duration' => '9 min', 'description' => 'Deux pratiques complémentaires pour libérer les tensions profondes.', 'content' => $ex2.$ex3],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle — Colonne vivante',                      'duration' => '8 min', 'description' => 'Méditation debout pour développer la conscience posturale.', 'content' => $meditation],
                ['type' => 'reflexion', 'title' => 'Journal — Ma posture dans ma vie',                        'duration' => '5 min', 'description' => 'Explorer le lien entre posture habituelle et état intérieur.', 'content' => $reflexion],
            ],
        ];
    }

    private function m08(): array  // Système nerveux
    {
        $gold   = 'rgba(201,168,76,.9)';
        $red    = 'rgba(239,68,68,.8)';
        $green  = 'rgba(34,197,94,.8)';
        $blue   = 'rgba(59,130,246,.8)';
        $indigo = 'rgba(99,102,241,.8)';

        $intro = $this->card($gold, 'Fondation', 'Le système nerveux — le chef d\'orchestre invisible',
            'Tout ce que vous ressentez, tout ce que vous faites, tout ce que vous pensez passe par lui.<br><br>
            Il existe deux modes principaux :<br><br>
            <strong>🔴 Sympathique (urgence)</strong> — accélère tout. Cœur rapide, muscles en tension, digestion suspendue. Conçu pour les 3 à 5 minutes de fuite devant un prédateur. Problème : il reste activé des heures, des jours, des semaines chez beaucoup de personnes modernes.<br><br>
            <strong>🟢 Parasympathique (récupération)</strong> — ralentit tout. Cœur lent, muscles relâchés, digestion active. C\'est ICI que le corps répare, récupère, grandit.<br><br>
            <em style="color:'.$gold.';">La Pause Souffle 5-5-5 active délibérément le parasympathique en 3 cycles.</em>'
        );

        $lecon1 = $this->card($red, 'Le stress chronique', 'Pourquoi le stress dure plus longtemps qu\'il ne devrait',
            '<strong>Le problème n\'est pas le stress aigu</strong> — il est utile et temporaire.<br><br>
            <strong>Le problème est le stress chronique</strong> : le cortisol (hormone du stress) reste élevé sur la durée. Effets cumulatifs :<br>
            · Sommeil dégradé (cortisol inhibe la mélatonine)<br>
            · Inflammation chronique de bas grade<br>
            · Digestion perturbée (intestin = "deuxième cerveau")<br>
            · Immunité diminuée<br>
            · Humeur instable (cortisol interfère avec la sérotonine)<br><br>
            <strong>Donnée clé :</strong> la rétention respiratoire de 5 secondes stimule le nerf vague et réduit le cortisol salivaire de 24% en 4 semaines (étude Gerritsen & Band, 2018).'
        );

        $lecon2 = $this->card($green, 'Le nerf vague', 'La voie royale vers le calme',
            'Le nerf vague (10e nerf crânien) est la plus longue autoroute du système nerveux autonome.<br>
            Il relie le cerveau au cœur, aux poumons, à l\'estomac, aux intestins.<br><br>
            <strong>Stimuler le nerf vague = activer le mode récupération.</strong><br><br>
            3 façons prouvées :<br>
            ① La respiration lente (6 cycles/min ou moins)<br>
            ② Le fredonnement / vibrations vocales sur l\'expiration<br>
            ③ L\'eau froide sur le visage (active le réflexe de plongée)<br><br>
            <em>La Pause Souffle utilise les 3 mécanismes simultanément quand pratiquée correctement.</em>'
        ).$this->card($indigo, 'Sympathique vs Parasympathique', 'Naviguer entre les deux états',
            '<table style="width:100%;font-size:.75rem;border-collapse:collapse;">
            <tr style="color:rgba(201,168,76,.9);border-bottom:1px solid rgba(255,255,255,.1);">
            <td style="padding:.3rem .4rem;font-weight:700;">Signal</td>
            <td style="padding:.3rem .4rem;font-weight:700;color:'.$red.';">Sympathique (alerte)</td>
            <td style="padding:.3rem .4rem;font-weight:700;color:'.$green.';">Parasympathique (repos)</td></tr>
            <tr style="border-bottom:1px solid rgba(255,255,255,.04);"><td style="padding:.25rem .4rem;color:rgba(232,224,208,.6);">Souffle</td><td style="padding:.25rem .4rem;color:'.$red.';">Court, thoracique</td><td style="padding:.25rem .4rem;color:'.$green.';">Long, abdominal</td></tr>
            <tr style="border-bottom:1px solid rgba(255,255,255,.04);"><td style="padding:.25rem .4rem;color:rgba(232,224,208,.6);">Cœur</td><td style="padding:.25rem .4rem;color:'.$red.';">Rapide &gt; 80 bpm</td><td style="padding:.25rem .4rem;color:'.$green.';">Lent &lt; 70 bpm</td></tr>
            <tr style="border-bottom:1px solid rgba(255,255,255,.04);"><td style="padding:.25rem .4rem;color:rgba(232,224,208,.6);">Muscles</td><td style="padding:.25rem .4rem;color:'.$red.';">Contractés</td><td style="padding:.25rem .4rem;color:'.$green.';">Relâchés</td></tr>
            <tr style="border-bottom:1px solid rgba(255,255,255,.04);"><td style="padding:.25rem .4rem;color:rgba(232,224,208,.6);">Digestion</td><td style="padding:.25rem .4rem;color:'.$red.';">Suspendue</td><td style="padding:.25rem .4rem;color:'.$green.';">Active</td></tr>
            <tr><td style="padding:.25rem .4rem;color:rgba(232,224,208,.6);">Rituel PS</td><td style="padding:.25rem .4rem;color:'.$red.';">Avant : état de départ</td><td style="padding:.25rem .4rem;color:'.$green.';">Après 3 cycles : état cible</td></tr>
            </table>'
        );

        $ex1 = $this->exercice($green, '1', 'Le 5-5-5 anti-cortisol (5 min)',
            'S\'asseoir confortablement. Fermer les yeux.<br>
            <strong>Inspiration 5s</strong> — par le nez, ventre d\'abord puis thorax.<br>
            <strong>Rétention 5s</strong> — léger verrou périnéal. Pas de tension dans le visage.<br>
            <strong>Expiration 5s</strong> — lente, par le nez ou la bouche entrouverte.<br>
            6 cycles minimum. 12 cycles pour effet profond.<br>
            <em>Utilisez avant une réunion stressante, avant de dormir, au réveil.</em>', true
        );

        $ex2 = $this->exercice($blue, '2', 'Le fredonnement vagal (3 min)',
            'Sur chaque expiration : laissez sortir un son grave — "mmmm".<br>
            Sentez la vibration dans la poitrine, le cou, le visage.<br>
            6 expirations. Puis retour à la respiration silencieuse.<br>
            <em>Ce n\'est pas du chant. C\'est une stimulation directe du nerf vague par la vibration des cordes vocales.</em>', false
        );

        $meditation = $this->card($green, 'Méditation guidée', '🌬 Pause Souffle — Scan corporel & activation parasympathique (8 min)',
            'Allongé. Yeux fermés.<br><br>
            Portez l\'attention sur les pieds → chevilles → mollets → genoux → cuisses → bassin → ventre → dos → poitrine → épaules → bras → mains → cou → visage.<br><br>
            À chaque zone :<br>
            <strong>Inspiration 5s</strong> — envoyez l\'attention (et l\'air mentalement) vers cette zone.<br>
            <strong>Expiration 5s</strong> — relâchez tout ce qui est là, sans forcer.<br><br>
            Nommez intérieurement ce que vous sentez : chaleur, froid, lourdeur, légèreté, tension, absence.<br><br>
            Terminez par 3 cycles centrés sur la poitrine — sentez le cœur qui bat, lent et régulier.<br><br>
            <em>L\'objectif n\'est pas de tout relâcher — c\'est d\'observer sans juger. La présence suffit à enclencher la récupération parasympathique.</em>'
        );

        $reflexion = $this->card($gold, 'Journal', 'Clôture du module — Mon paysage nerveux',
            'Prenez 5 minutes et observez honnêtement :<br><br>
            · Dans quelle portion de mes journées suis-je en mode sympathique (alerte, tension, précipitation) ?<br>
            · Quels sont mes 3 principaux déclencheurs de stress chronique ?<br>
            · Quels moments de ma journée m\'offrent naturellement le mode parasympathique ?<br>
            · À quoi ressemberait ma vie si je passais 30 minutes de plus par jour en mode récupération ?<br><br>
            <em>La conscience de son état nerveux est le premier levier du changement.</em>'
        );

        return [
            'description' => 'Comprendre le système nerveux autonome (sympathique/parasympathique) et apprendre à naviguer entre les deux états grâce à la respiration et au nerf vague.',
            'intro_text'  => "MODULE 08 — Système Nerveux\n\nTout ce que vous ressentez passe par lui. Stress, calme, fatigue, énergie — votre système nerveux orchestre tout. Ce module vous explique comment fonctionne ce chef d'orchestre invisible, et surtout comment reprendre la main plutôt que d'en être le jouet.",
            'audio_path'  => 'formation/audio/08-systeme-nerveux-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '🧠 Introduction — Votre chef d\'orchestre intérieur',      'duration' => '4 min', 'description' => 'Les deux modes du système nerveux et leur impact sur votre vie quotidienne.', 'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — Le stress chronique et ses effets',             'duration' => '4 min', 'description' => 'Pourquoi le cortisol reste élevé et comment en sortir.', 'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Le nerf vague & les deux états',                'duration' => '5 min', 'description' => 'La voie royale vers le calme et le tableau comparatif des deux modes.', 'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique guidée — Le 5-5-5 anti-cortisol',               'duration' => '5 min', 'description' => 'La technique centrale de la Pause Souffle pour activer le parasympathique.', 'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — Le fredonnement vagal',                       'duration' => '3 min', 'description' => 'Stimuler directement le nerf vague par la vibration vocale.', 'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle — Scan corporel profond',               'duration' => '8 min', 'description' => 'Méditation guidée : balayage complet du corps pour activer la récupération.', 'content' => $meditation],
                ['type' => 'reflexion', 'title' => 'Journal — Mon paysage nerveux',                          'duration' => '5 min', 'description' => 'Observer et cartographier son état nerveux habituel.', 'content' => $reflexion],
            ],
        ];
    }

    private function m09(): array  // Gestion des émotions
    {
        $gold   = 'rgba(201,168,76,.9)';
        $orange = 'rgba(249,115,22,.8)';
        $blue   = 'rgba(59,130,246,.8)';
        $green  = 'rgba(34,197,94,.8)';
        $pink   = 'rgba(236,72,153,.8)';

        $intro = $this->card($gold, 'Fondation', 'Une émotion n\'est pas une faiblesse',
            '<em>"Je ne dois pas ressentir ça."</em><br>
            <em>"Je suis trop sensible."</em><br>
            <em>"Arrête de t\'émouvoir pour rien."</em><br><br>
            Ces phrases — entendues depuis l\'enfance — créent une rupture entre vous et vos émotions.<br><br>
            <strong>La réalité anatomique :</strong> les émotions sont des événements chimiques et électriques dans le corps. Elles ont une fonction précise :<br>
            · <strong>Peur</strong> → signal d\'alerte, prépare la survie<br>
            · <strong>Colère</strong> → signal de violation d\'une valeur ou d\'une limite<br>
            · <strong>Tristesse</strong> → signal de perte, nécessite du repos et de la connexion<br>
            · <strong>Joie</strong> → signal d\'alignement, renforce les comportements bénéfiques<br><br>
            <em>Réprimer une émotion ne la fait pas disparaître — elle se stocke dans le corps comme tension musculaire chronique.</em>'
        );
        $lecon1 = $this->card($orange, 'La fenêtre de tolérance', 'Rester dans la zone apprenante',
            'Le concept de fenêtre de tolérance (Dan Siegel, 1999) :<br><br>
            <strong>Zone haute (hyperactivation)</strong> : trop chargé émotionnellement — panique, agitation, colère incontrôlée, pensées en boucle.<br><br>
            <strong>🟢 Fenêtre de tolérance (optimal)</strong> : zone où vous pouvez ressentir ET réfléchir. Vous êtes en contact avec l\'émotion sans en être submergé.<br><br>
            <strong>Zone basse (hypoactivation)</strong> : trop fermé — engourdissement, dissociation, sentiment de vide, fatigue profonde.<br><br>
            <strong>L\'objectif de la régulation émotionnelle n\'est pas l\'absence d\'émotion.</strong><br>
            C\'est rester dans la fenêtre de tolérance même face aux émotions intenses.'
        );
        $lecon2 = $this->card($blue, 'Les 3 portes d\'entrée', 'Comment réguler une émotion forte',
            '<strong>① La porte du corps</strong><br>
            Sentez où l\'émotion vit dans votre corps. Gorge serrée ? Poitrine lourde ? Ventre noué ?<br>
            Respirez vers cet endroit. 5 cycles 5-5-5 suffisent pour desserrer la tension de 40 à 60%.<br><br>
            <strong>② La porte du nom</strong><br>
            Nommez précisément ce que vous ressentez. Pas "je me sens mal" — mais "je ressens de la honte" ou "c\'est de la peur de l\'abandon".<br>
            La recherche en neurosciences (Lieberman, 2007) montre que nommer une émotion <em>réduit l\'activation de l\'amygdale de 40%</em>.<br><br>
            <strong>③ La porte du contexte</strong><br>
            Demandez : <em>"Cette émotion m\'informe de quoi ?"</em> — pas "pourquoi je ressens ça" (qui boucle), mais "qu\'est-ce qu\'elle me dit ?"'
        );
        $ex1 = $this->exercice($orange, '1', 'STOP — la pause émotionnelle (1 minute)',
            '<strong>S</strong> — Stop. Arrêtez ce que vous faites.<br>
            <strong>T</strong> — Take a breath. Un cycle 5-5-5 complet.<br>
            <strong>O</strong> — Observe. Où est cette émotion dans votre corps ? Nommez-la.<br>
            <strong>P</strong> — Proceed. Choisissez votre réponse (au lieu de réagir automatiquement).<br>
            <em>À utiliser dès que vous sentez une émotion intense monter.</em>', true
        );
        $ex2 = $this->exercice($blue, '2', 'La lettre non envoyée (10 min)',
            'Prenez une feuille. Écrivez à quelqu\'un (ou à une situation) qui vous affecte émotionnellement.<br>
            Règle unique : ne vous censurez pas. Cette lettre ne sera jamais envoyée.<br><br>
            Après l\'écriture : 3 cycles 5-5-5. Puis lisez-la comme si elle avait été écrite par quelqu\'un que vous aimez.<br>
            <em>Que voudriez-vous lui dire en retour ?</em>', false
        );
        $meditation = $this->card($green, 'Méditation guidée', '🌬 Pause Souffle — Ancrage sensoriel 5-4-3-2-1 (5 min)',
            'Quand une émotion intense arrive, suivez les 3 étapes :<br><br>
            <strong>Étape 1 — Respiration (1 min)</strong><br>
            3 cycles 5-5-5. Sur chaque inspiration, nommez l\'émotion intérieurement. Sur chaque expiration, laissez-la traverser sans la retenir.<br><br>
            <strong>Étape 2 — Ancrage sensoriel</strong><br>
            👁 <strong>5 choses</strong> que vous voyez maintenant (nommez-les intérieurement)<br>
            👂 <strong>4 sons</strong> que vous entendez dans la pièce<br>
            🤲 <strong>3 textures</strong> que vous sentez (tissu, sol, peau)<br>
            👃 <strong>2 odeurs</strong> présentes ou imaginées<br>
            👅 <strong>1 goût</strong> perçu<br><br>
            <strong>Étape 3 — Retour</strong><br>
            3 respirations lentes. Ouvrez les yeux doucement.<br><br>
            <em>Cet exercice active le cortex préfrontal et stoppe l\'emballement de l\'amygdale en moins de 3 minutes.</em>'
        );
        $reflexion = $this->card($gold, 'Journal', 'Clôture du module — Ma météo émotionnelle',
            'Prenez 5 minutes pour observer et noter honnêtement :<br><br>
            · Quelle émotion est la plus fréquente dans ma vie en ce moment ?<br>
            · Qu\'est-ce qu\'elle tente de me signaler ?<br>
            · Est-ce que je me permets de la ressentir — ou est-ce que je la fuis (travail, écrans, compulsions) ?<br>
            · Quel est mon style de régulation habituel (corps / nom / contexte) ?<br>
            · Quelle émotion ai-je du mal à accueillir — et pourquoi ?<br><br>
            <em>La conscience émotionnelle est le début de la liberté — pas l\'absence d\'émotion.</em>'
        );

        return [
            'description' => 'Comprendre et réguler ses émotions — les émotions comme signaux, la fenêtre de tolérance, et 3 techniques concrètes de régulation.',
            'intro_text'  => "MODULE 09 — Gestion des Émotions\n\nUne émotion n'est pas une faiblesse — c'est un signal. Colère, peur, tristesse, joie : chacune vous informe de quelque chose d'essentiel. Ce module vous apprend à écouter ces messagères plutôt qu'à les fuir, et à rester dans votre fenêtre de tolérance même face aux émotions les plus intenses.",
            'audio_path'  => 'formation/audio/09-gestion-emotions-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '💛 Introduction — Les émotions comme messagères',  'duration' => '4 min',  'description' => 'Comprendre la réalité anatomique des émotions et pourquoi les fuir est contre-productif.', 'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — La fenêtre de tolérance',                'duration' => '4 min',  'description' => 'Le modèle de Dan Siegel : rester dans la zone apprenante face aux émotions intenses.', 'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Les 3 portes de régulation',             'duration' => '4 min',  'description' => 'Corps, nom, contexte — trois façons de traverser une émotion forte sans en être submergé.', 'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique guidée — STOP la pause émotionnelle',     'duration' => '1 min',  'description' => 'La technique d\'urgence en 4 étapes pour sortir de la réaction automatique.', 'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — La lettre non envoyée',                 'duration' => '10 min', 'description' => 'Écriture libératrice pour évacuer une charge émotionnelle accumulée.', 'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle — Ancrage sensoriel 5-4-3-2-1',  'duration' => '5 min',  'description' => 'Méditation guidée en 3 étapes pour revenir dans la fenêtre de tolérance.', 'content' => $meditation],
                ['type' => 'reflexion', 'title' => 'Journal — Ma météo émotionnelle',                  'duration' => '5 min',  'description' => 'Observer et cartographier ses émotions dominantes du moment.', 'content' => $reflexion],
            ],
        ];
    }

    private function m07_soin(): array  // Je prends soin de moi en premier — le masque à oxygène
    {
        $gold   = 'rgba(201,168,76,.9)';
        $rose   = 'rgba(244,63,94,.8)';
        $orange = 'rgba(249,115,22,.8)';
        $teal   = 'rgba(20,184,166,.8)';
        $blue   = 'rgba(59,130,246,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $indigo = 'rgba(99,102,241,.8)';
        $green  = 'rgba(34,197,94,.8)';

        $intro =
            $this->card($rose, 'Le paradoxe du don', 'Pourquoi prendre soin de soi n\'est pas de l\'égoïsme',
                '<div style="font-size:.92rem;line-height:2.3;color:rgba(232,224,208,.85);font-style:italic;margin-bottom:1rem;border-left:3px solid rgba(244,63,94,.5);padding-left:1rem;">
                « Mettez votre propre masque avant d\'aider les autres. »<br>
                <span style="font-size:.75rem;color:rgba(244,63,94,.6);">— Manuel de sécurité de tous les avions du monde</span>
                </div>
                En cas de turbulences, le masque tombe. La consigne est universelle :<br>
                <strong>mettez d\'abord le vôtre avant d\'aider votre enfant, votre proche, votre voisin.</strong><br><br>
                Pourquoi ? Parce qu\'une personne inconsciente ne peut pas sauver une autre.<br>
                Un aidant épuisé protège moins bien ceux qu\'il aime qu\'une personne ressourcée.<br><br>
                Dans nos vies, nous faisons exactement l\'inverse.<br>
                On donne, on donne, on donne — les enfants, le travail, les amis, le couple —<br>
                et on se demande ensuite pourquoi on est vidé·e, irritable, absent·e.<br><br>
                <em><strong>Prendre soin de soi n\'est pas de l\'égoïsme. C\'est la condition de l\'amour durable.</strong></em>'
            );

        $lecon1 =
            $this->card($teal, 'Recherche', 'La science de l\'épuisement — ce qui arrive quand on donne sans se remplir',
                '<strong>Christina Maslach & Michael Leiter — La définition clinique du burn-out</strong><br><br>
                Le burn-out n\'est pas une faiblesse. C\'est une conséquence physiologique de donner sans recharger.<br>
                Ses 3 dimensions cliniques :<br>
                <div style="background:rgba(20,184,166,.08);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.1;">
                <strong style="color:rgba(20,184,166,.9);">① Épuisement émotionnel</strong> — ressources intérieures à zéro<br>
                <strong style="color:rgba(20,184,166,.9);">② Dépersonnalisation</strong> — on commence à traiter les autres comme des numéros<br>
                <strong style="color:rgba(20,184,166,.9);">③ Sentiment d\'échec</strong> — même les choses bien faites ne procurent plus de satisfaction
                </div>
                Ce qui amène au burn-out : non pas la quantité de travail — mais l\'<strong>absence de récupération</strong>.<br><br>
                <em>On ne peut pas donner ce qu\'on n\'a pas. On ne peut pas aimer avec un cœur vide.</em>'
            )
            .$this->card($blue, 'Psychologie', 'Le compte en banque émotionnel — Covey & Gottman',
                'Stephen Covey parle d\'un <em>compte en banque émotionnel</em> — la relation avec soi-même :<br><br>
                <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;font-size:.85rem;">
                <strong style="color:rgba(34,197,94,.9);">DÉPÔTS (qui rechargent) :</strong><br>
                Dormir · Sport · Temps seul·e · Plaisir · Beauté · Amitiés choisies · Nature · Créativité<br><br>
                <strong style="color:rgba(249,115,22,.9);">RETRAITS (qui épuisent) :</strong><br>
                Obligations subies · Culpabilité · Conflits non résolus · Comparaison · Perfectionnisme
                </div>
                <em>La question n\'est pas "est-ce que je mérite de prendre soin de moi ?"<br>
                C\'est "est-ce que mon compte est dans le positif ou dans le rouge ?"</em>'
            );

        $lecon2 =
            $this->card($orange, 'Les 5 domaines', 'Le soin de soi — bien au-delà du bubble bath',
                'Le soin de soi n\'est pas une journée de spa (même si le spa est une excellente idée).<br>
                C\'est un système structuré de recharge sur 5 domaines :<br><br>
                <div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;">
                <strong style="color:rgba(249,115,22,.9);">① Corps & Beauté</strong> — Esthéticienne · Ongle · Coiffeur · Massages · Spa · Salle de sport<br>
                <strong style="color:rgba(249,115,22,.9);">② Esprit & Silence</strong> — Méditation · Lecture plaisir · Temps sans écran<br>
                <strong style="color:rgba(249,115,22,.9);">③ Plaisir choisi</strong> — Restaurant · Cinéma · Concert · Musée · Nature<br>
                <strong style="color:rgba(249,115,22,.9);">④ Social nourrissant</strong> — Sorties avec des ami·e·s qui <em>vous élèvent</em><br>
                <strong style="color:rgba(249,115,22,.9);">⑤ Projet qui vous appartient</strong> — Quelque chose pour vous seul·e, pas pour votre famille ou patron
                </div>'
            )
            .$this->card($purple, 'La règle du 1h pour soi', 'Chaque jour — sans négociation',
                'Dr. Nedra Tawwab (auteure de <em>Set Boundaries, Find Peace</em>) :<br><br>
                <div style="background:rgba(168,85,247,.08);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;font-style:italic;font-size:.88rem;color:rgba(232,224,208,.85);border-left:3px solid rgba(168,85,247,.4);">
                « Vous avez besoin d\'au moins 1 heure par jour d\'activité qui n\'appartient qu\'à vous.<br>
                Pas à vos enfants. Pas à votre partenaire. Pas à votre travail. À VOUS. »
                </div>
                Cette heure peut être découpée (30 + 30 min). Elle doit être <strong>choisie et plaisante</strong>.<br>
                Les personnes qui la protègent sont statistiquement : moins anxieuses, plus patientes, meilleurs au travail.<br>
                <em>(APA Work & Wellbeing Survey 2023)</em>'
            );

        $ex1 =
            $this->exercice($rose, '1', 'Mon agenda de soin — 3 rendez-vous à réserver MAINTENANT',
                '<strong>Ne passez pas à la suite sans l\'avoir fait.</strong><br><br>
                Ouvrez votre agenda. Réservez AU MOINS 3 de ces rendez-vous dans les 14 jours :<br><br>
                <div style="background:rgba(244,63,94,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.5;">
                ☐ <strong>Esthéticienne</strong> — soin du visage, soins du corps<br>
                ☐ <strong>Ongle</strong> — manucure ou pédicure<br>
                ☐ <strong>Coiffeur</strong> — un vrai rendez-vous<br>
                ☐ <strong>Spa ou hammam</strong> — même une séance courte<br>
                ☐ <strong>Massage</strong> — thérapeutique ou de relaxation<br>
                ☐ <strong>Salle de sport</strong> — inscription ou reprise (3×/semaine)<br>
                ☐ <strong>Sortie avec des ami·e·s choisi·e·s</strong> — restaurant, ciné, balade<br>
                ☐ <strong>Activité solo plaisir</strong> — ce que vous aimez faire pour vous seul·e
                </div>
                <em style="font-size:.8rem;color:rgba(232,224,208,.5);">Ces RDV ne s\'annulent pas pour "quelque chose d\'urgent". Vous ne vous annulez pas.</em>', false
            );

        $ex2 =
            $this->exercice($gold, '2', 'Mon audit bien-être — état des lieux honnête en 5 domaines',
                '<strong>Pas de bonne ou mauvaise réponse. Juste la vérité.</strong><br><br>
                Évaluez chaque domaine de 1 à 10 :<br><br>
                <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.5;font-size:.83rem;color:rgba(232,224,208,.78);">
                · <strong>Corps</strong> : Quand avez-vous fait quelque chose de beau pour votre corps — pour le plaisir pur ?<br>
                · <strong>Plaisir</strong> : Quel est le dernier moment où vous avez ri aux éclats avec des personnes choisies ?<br>
                · <strong>Solitude positive</strong> : Avez-vous 30 min/jour de temps vraiment pour vous ?<br>
                · <strong>Projet personnel</strong> : Avez-vous un projet qui n\'appartient qu\'à vous ?<br>
                · <strong>Énergie</strong> : Sur 10, combien vous sentez-vous ressourcé·e le matin auquotidien ?
                </div>
                <strong>Signal d\'alarme :</strong> Si vous êtes en dessous de 6 dans 3 domaines ou plus,<br>
                vous êtes en déficit de soin de soi — et cela affecte ceux que vous aimez.', false
            )
            .$this->exercice($green, '3', 'Le "moi d\'abord" du matin — les 10 premières minutes qui changent tout',
                'Avant d\'ouvrir les messages, avant de voir ce que les autres attendent :<br><br>
                <strong>Rituel des 10 premières minutes :</strong><br>
                <div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.5;">
                <strong style="color:rgba(34,197,94,.9);">① 3 min</strong> — Fenêtre ouverte. 5 respirations profondes. Corps debout.<br>
                <strong style="color:rgba(34,197,94,.9);">② 2 min</strong> — 1 verre d\'eau bu lentement. Ce geste dit à votre corps : "tu comptes."<br>
                <strong style="color:rgba(34,197,94,.9);">③ 5 min</strong> — 1 seule question : "Qu\'est-ce que j\'ai envie de vivre aujourd\'hui pour MOI ?"
                </div>
                <strong>La règle absolue :</strong> Ne touchez pas votre téléphone avant ces 3 étapes.<br>
                Pas de réseaux. Pas de messages. Pas d\'emails.<br>
                <em>Vous appartenez à vous-même en premier.</em>', false
            );

        $meditation =
            $this->exercice($orange, '4', '🌬 Pause Souffle de recharge',
                '<strong>Durée : 8 minutes · Matin ou après une longue journée</strong><br><br>
                <strong>① Connexion au corps (2 min)</strong><br>
                Posez les deux mains sur votre cœur. Fermez les yeux.<br>
                Sentez le battement. Ce cœur travaille pour vous depuis votre naissance, sans jamais s\'arrêter.<br><br>
                <strong>② Respiration de recharge — 5 cycles 5-5-5</strong><br>
                Inspirez 5s : imaginez que vous vous remplissez de lumière et d\'énergie.<br>
                Retenez 5s : laissez cette énergie s\'installer dans chaque cellule.<br>
                Expirez 5s : relâchez ce que vous portez pour les autres. Pour ces 8 minutes, vous existez pour vous.<br><br>
                <strong>③ Intention</strong><br>
                <em>"Je mérite de prendre soin de moi. Aujourd\'hui, je choisis de me remplir pour mieux donner."</em>', true
            );

        $reflexion =
            $this->exercice($indigo, '5', 'Ma déclaration de self-care — un engagement avec acte concret',
                '<strong>3 bilans honnêtes :</strong><br>
                <div style="background:rgba(99,102,241,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;font-size:.83rem;color:rgba(232,224,208,.78);">
                · Ce que je sacrifie depuis trop longtemps (1 chose précise, pas faite depuis 3 mois minimum)<br>
                · Ce qui se passe concrètement quand je ne prends pas soin de moi (impact réel sur mes proches)<br>
                · La personne qui bénéficiera le plus de mon soin de moi (souvent quelqu\'un que j\'aime)
                </div>
                <strong>Mon engagement de la semaine — à remplir et signer :</strong><br>
                <div style="background:rgba(0,0,0,.2);border-left:3px solid rgba(244,63,94,.4);border-radius:0 8px 8px 0;padding:.85rem 1rem;font-size:.85rem;font-style:italic;color:rgba(232,224,208,.75);">
                "Cette semaine, je réserve __________ le __________ (jour & heure).<br>
                Je ne l\'annulerai pour rien. Ce rendez-vous est aussi important que mes obligations professionnelles.<br>
                Je mérite d\'exister pour moi-même."
                </div>', false
            );

        return [
            'description' => 'Le principe du masque à oxygène dans la vie quotidienne. Science du burn-out, les 5 domaines du soin de soi, la règle du 1h, audit bien-être en 5 domaines et rendez-vous concrets à réserver cette semaine.',
            'intro_text'  => "MODULE 07 — Je prends soin de moi en premier\n\nDans un avion en turbulences, on met son masque avant d'aider les autres. Pas par égoïsme — par logique.\n\nMais dans nos vies, nous faisons l'inverse. On donne sans s'arrêter, et on se demande pourquoi on est vide.\n\nCe module réhabilite l'acte de prendre soin de soi comme la fondation de tout : votre présence, votre énergie, votre amour pour les autres.",
            'audio_path'  => 'formation/audio/07-je-prends-soin-de-moi-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '💗 Introduction — Le masque à oxygène & le paradoxe du don',            'duration' => '4 min',  'description' => 'Pourquoi prendre soin de soi n\'est pas de l\'égoïsme mais la condition de l\'amour durable.',                          'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — La science du burn-out & le compte en banque émotionnel',     'duration' => '7 min',  'description' => 'Maslach & Leiter : les 3 dimensions cliniques. Covey : dépôts et retraits émotionnels.',                              'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Les 5 domaines du soin de soi & la règle du 1h quotidienne', 'duration' => '5 min',  'description' => 'Corps & beauté · Esprit · Plaisir · Social nourrissant · Projet personnel. Dr. Nedra Tawwab.',                     'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique — Mon agenda de soin : 3 RDV à réserver maintenant',          'duration' => '20 min', 'description' => 'Action immédiate : ouvrir l\'agenda et réserver concrètement 3 rendez-vous de soin dans les 14 prochains jours.',  'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — Audit bien-être + le rituel "moi d\'abord" du matin',        'duration' => '25 min', 'description' => 'État des lieux en 5 domaines noté de 1 à 10 + installer les 10 premières minutes du matin qui vous appartiennent.', 'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle de recharge',                                           'duration' => '8 min',  'description' => 'Connexion au corps · Respiration de recharge · Intention : "Je mérite de prendre soin de moi."',                  'content' => $meditation, 'audio' => true],
                ['type' => 'reflexion', 'title' => 'Journal — Ma déclaration de self-care & mon engagement concret',        'duration' => '10 min', 'description' => '3 bilans honnêtes + signature d\'un engagement avec RDV précis, jour et heure.',                                   'content' => $reflexion],
            ],
        ];
    }

    private function m08_gratitude(): array  // La gratitude & l'intention — bilan du soir, élan du matin
    {
        $gold   = 'rgba(201,168,76,.9)';
        $green  = 'rgba(34,197,94,.8)';
        $orange = 'rgba(249,115,22,.8)';
        $teal   = 'rgba(20,184,166,.8)';
        $blue   = 'rgba(59,130,246,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $indigo = 'rgba(99,102,241,.8)';

        $intro =
            $this->card($gold, 'La gratitude n\'est pas une pensée positive', 'C\'est une technologie neurologique',
                '<div style="font-size:.92rem;line-height:2.3;color:rgba(232,224,208,.85);font-style:italic;margin-bottom:1rem;border-left:3px solid rgba(201,168,76,.5);padding-left:1rem;">
                « Ce n\'est pas le bonheur qui génère la gratitude.<br>
                C\'est la gratitude qui génère le bonheur. »<br>
                <span style="font-size:.75rem;color:rgba(201,168,76,.6);">— David Steindl-Rast</span>
                </div>
                Vous avez peut-être entendu "soyez positif·ve" des milliers de fois.<br>
                La gratitude n\'est pas ça. Ce n\'est pas ignorer ce qui ne va pas.<br>
                C\'est <strong>entraîner le cerveau à voir ce qui existe</strong> — vraiment, précisément.<br><br>
                Ce module vous donne deux outils précis :<br>
                · <strong>Le bilan du soir</strong> — fermer la journée avec conscience<br>
                · <strong>L\'intention du matin</strong> — ouvrir le lendemain avec direction<br><br>
                <em>Ensemble, ces deux rituels forment l\'architecture d\'une vie éveillée.</em>'
            );

        $lecon1 =
            $this->card($teal, 'Étude fondatrice', 'Robert Emmons & Michael McCullough (2003) — la gratitude mesurée',
                '<strong>Université de Californie Davis — 1er essai contrôlé randomisé sur la gratitude</strong><br><br>
                3 groupes pendant 10 semaines :<br>
                <div style="background:rgba(20,184,166,.08);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.1;font-size:.85rem;">
                Groupe A : Écrire 5 choses pour lesquelles ils sont reconnaissants<br>
                Groupe B : Écrire 5 irritations de la semaine<br>
                Groupe C : Écrire 5 événements neutres (groupe contrôle)
                </div>
                <strong style="color:rgba(20,184,166,.9);">Résultats groupe A après 10 semaines :</strong><br>
                · 25% plus heureux sur les échelles de bien-être subjectif<br>
                · 1,5h de sport supplémentaire par semaine (effet collatéral non attendu)<br>
                · Moins de plaintes somatiques (maux de tête, douleurs musculaires)<br>
                · Plus altruistes envers leur entourage<br><br>
                <em>La gratitude active littéralement les circuits de récompense du cerveau liés à la dopamine et à l\'ocytocine.</em>'
            )
            .$this->card($blue, 'Neuroscience', 'Ce que la gratitude fait au cerveau — Dr. Alex Korb',
                '<strong>Neuroplasticité et gratitude (UCLA Semel Institute, Dr. Alex Korb)</strong><br><br>
                L\'acte de chercher quelque chose d\'agréable à noter active deux régions clés :<br>
                <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;font-size:.85rem;line-height:2.1;">
                <strong style="color:rgba(59,130,246,.9);">Cortex préfrontal médian</strong> — la zone de la prise de décision consciente<br>
                <strong style="color:rgba(59,130,246,.9);">Noyaux de la base</strong> — la zone de la motivation et du plaisir anticipé
                </div>
                Plus vous pratiquez, plus ces circuits se renforcent — c\'est la neuroplasticité.<br>
                Le cerveau cherche automatiquement le positif (au lieu du négatif par défaut, biais de négativité).<br><br>
                <em>3 semaines de pratique suffisent à mesurer les premiers changements structurels (IRM fonctionnel).</em>'
            );

        $lecon2 =
            $this->card($orange, 'Le protocole 3-3-1', 'Le bilan du soir en moins de 5 minutes',
                '<strong>Le système le plus simple et le plus éprouvé :</strong><br><br>
                <div style="background:rgba(249,115,22,.08);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;">
                <strong style="color:rgba(249,115,22,.9);">3 gratitudes</strong> — 3 choses précises (pas vagues) pour lesquelles vous êtes reconnaissant·e aujourd\'hui<br>
                <em>Pas "ma famille" → "Le rire de mon fils ce soir au dîner"</em><br><br>
                <strong style="color:rgba(249,115,22,.9);">3 victoires</strong> — 3 choses que vous avez accomplies ou bien faites aujourd\'hui<br>
                <em>Pas forcément grandes. Un appel passé. Un repas cuisné. Un exercice fait.</em><br><br>
                <strong style="color:rgba(249,115,22,.9);">1 intention</strong> — 1 seule priorité pour demain<br>
                <em>Pas une liste. Une. La plus importante. Celle qui, si elle est faite, rend le reste secondaire.</em>
                </div>
                Total : 5 minutes. Carnet et stylo. Pas de téléphone.'
            )
            .$this->card($purple, 'La règle des 5 premières minutes', 'Ne pas toucher le téléphone avant l\'intention',
                '<strong>Le matin appartient à votre cerveau, pas aux notifications.</strong><br><br>
                Les premières minutes du réveil sont une fenêtre de vulnérabilité neurologique :<br>
                les ondes alfa/thêta (entre sommeil et éveil) rendent le cerveau particulièrement réceptif.<br><br>
                <div style="background:rgba(168,85,247,.08);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.3;font-size:.85rem;">
                <strong style="color:rgba(168,85,247,.9);">Ce que voient 78% des gens dans les 5 premières minutes :</strong> réseaux sociaux, emails, messages<br>
                <em>→ Cortisol (stress) + engagement réactif (vous répondez aux priorités des autres)</em><br><br>
                <strong style="color:rgba(34,197,94,.9);">Ce que font les personnes à haut niveau de bien-être :</strong> intention + gratitude AVANT le téléphone<br>
                <em>→ Dopamine (motivation) + engagement proactif (vous agissez sur vos priorités)</em>
                </div>
                <em>Le matin programme la journée. Le soir programme le matin.</em>'
            );

        $ex1 =
            $this->exercice($gold, '1', 'Préparer son outil de gratitude — carnet + stylo, pas une app',
                '<strong>La règle fondamentale : papier, pas numérique.</strong><br><br>
                Les études de Mueller & Oppenheimer (Princeton, 2014) montrent que l\'écriture manuscrite<br>
                active davantage les zones de traitement émotionnel que le clavier.<br><br>
                <strong>Cette semaine, préparez :</strong><br>
                <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.5;">
                ☐ Un carnet dédié uniquement à la gratitude (pas votre agenda pro)<br>
                ☐ Un stylo agréable à tenir<br>
                ☐ Positionnez-les sur votre table de nuit — le soir et le matin<br>
                ☐ Première entrée ce soir avant de dormir
                </div>
                <strong>Premier bilan du soir — faites-le maintenant :</strong><br>
                3 gratitudes précises d\'aujourd\'hui · 3 victoires du jour · 1 intention pour demain<br>
                <em>Durée : 5 minutes. Mais ces 5 minutes changent la structure du lendemain.</em>', false
            );

        $ex2 =
            $this->exercice($teal, '2', 'Le bilan du soir complet — 5 questions de clôture',
                'Une fois par semaine (idéalement le dimanche soir), prenez 15 minutes pour ce bilan élargi :<br><br>
                <div style="background:rgba(20,184,166,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.5;font-size:.83rem;color:rgba(232,224,208,.78);">
                ① <strong>Mon moment le plus fort de la semaine</strong> — lequel et pourquoi a-t-il eu lieu ?<br>
                ② <strong>Ce que j\'ai appris sur moi cette semaine</strong> — une information sur qui je suis<br>
                ③ <strong>Ma plus grande victoire</strong> — même petite. Qu\'est-ce que j\'ai accompli ?<br>
                ④ <strong>Ce que je veux faire différemment</strong> — sans culpabilité, juste une observation<br>
                ⑤ <strong>3 personnes auxquelles je suis reconnaissant·e</strong> — pour quoi précisément ?
                </div>
                <strong>Action immédiate :</strong> Envoyez un message à l\'une de ces 3 personnes cette semaine.<br>
                <em>"Je voulais juste te dire merci pour __________ ."</em><br>
                Ce geste renforce en vous ET dans votre relation.', false
            )
            .$this->exercice($green, '3', 'La préparation du lendemain — 10 minutes qui valent 1 heure',
                'Le soir, avant de poser le carnet :<br><br>
                <div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.5;font-size:.85rem;">
                <strong style="color:rgba(34,197,94,.9);">① Ma 1 priorité absolue de demain</strong> (une seule — celle qui change tout si c\'est fait)<br>
                <strong style="color:rgba(34,197,94,.9);">② Mes 3 tâches importantes</strong> (ce qui doit être fait, même si pas urgent)<br>
                <strong style="color:rgba(34,197,94,.9);">③ 1 acte de soin de moi programmé</strong> (même 20 min de marche, c\'est un dépôt)<br>
                <strong style="color:rgba(34,197,94,.9);">④ Mon heure de réveil</strong> (fixe, même le week-end — la régularité protège le sommeil)
                </div>
                <em>Cette liste n\'a pas pour but d\'être exhaustive. Elle a pour but de clore la journée avec ordre<br>
                et d\'ouvrir le lendemain sans devoir tout réinventer le matin, fatigué·e.</em>', false
            );

        $meditation =
            $this->exercice($orange, '4', '🌬 Pause Souffle de gratitude — clôture de journée',
                '<strong>Durée : 7 minutes · Le soir, juste avant de fermer le carnet</strong><br><br>
                <strong>① Scan de la journée (2 min)</strong><br>
                Parcourez mentalement votre journée. Sans jugement. De ce matin à maintenant.<br>
                Cherchez : qu\'est-ce qui était beau ? Même une seconde. Même minuscule.<br><br>
                <strong>② Respiration de gratitude — 5 cycles 4-6</strong><br>
                Inspirez 4 secondes : accueillez ce qui a été bien.<br>
                Expirez 6 secondes : relâchez ce qui n\'a pas été à la hauteur de vos attentes.<br>
                Expirez plus longtemps que vous ne respirez — c\'est le signal que le jour est terminé.<br><br>
                <strong>③ La phrase de clôture</strong><br>
                <em>"Aujourd\'hui a existé. Il y avait du beau. Je le reconnais. Je peux me reposer."</em>', true
            );

        $reflexion =
            $this->exercice($indigo, '5', 'Mon défi 21 jours — l\'engagement qui transforme le cerveau',
                '<strong>La science parle de 21 jours pour une nouvelle connexion neuronale.</strong><br><br>
                Prenez votre carnet. Écrivez aujourd\'hui :<br>
                <div style="background:rgba(99,102,241,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;font-size:.83rem;color:rgba(232,224,208,.78);">
                · <strong>Date de début</strong> : aujourd\'hui<br>
                · <strong>Date de D+21</strong> : calculez-la et notez-la<br>
                · <strong>Mon engagement</strong> : chaque soir pendant 21 jours, au moins 3 gratitudes précises<br>
                · <strong>Mon test de D+7</strong> : dans 7 jours, noter comment mon humeur du matin a changé
                </div>
                <strong>La règle des 48h :</strong> Si vous ratez un soir, reprenez le lendemain sans culpabilité.<br>
                Le compteur ne repart pas à zéro pour un seul manque.<br><br>
                <div style="background:rgba(0,0,0,.2);border-left:3px solid rgba(201,168,76,.4);border-radius:0 8px 8px 0;padding:.7rem 1rem;font-size:.8rem;font-style:italic;color:rgba(232,224,208,.65);">
                « Ce que vous appréciez s\'apprécie. » — Lynne Twist
                </div>', false
            );

        return [
            'description' => 'La gratitude comme outil neurologique. Emmons & McCullough (2003) : 25% plus heureux. Le protocole 3-3-1 du soir + la règle des 5 premières minutes du matin. Carnet, bilan du soir, préparation du lendemain.',
            'intro_text'  => "MODULE 08 — La gratitude & l'intention\n\nLa gratitude n'est pas de la pensée positive. C'est une technologie neurologique qui recâble littéralement le cerveau.\n\nCe module vous donne deux rituels précis : le bilan du soir (fermer la journée avec conscience) et l'intention du matin (ouvrir le lendemain avec direction). Ensemble, ils forment l'architecture d'une vie éveillée.",
            'audio_path'  => 'formation/audio/08-gratitude-et-intention-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '✨ Introduction — La gratitude comme technologie neurologique',        'duration' => '4 min',  'description' => 'Ce n\'est pas le bonheur qui génère la gratitude — c\'est la gratitude qui génère le bonheur.',                             'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — Emmons & McCullough + Dr. Alex Korb (UCLA)',               'duration' => '7 min',  'description' => '25% plus heureux · 1,5h de sport en plus · neuroplasticité mesurable en IRM en 3 semaines.',                              'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Le protocole 3-3-1 du soir & la règle des 5 min du matin', 'duration' => '5 min',  'description' => '3 gratitudes précises · 3 victoires · 1 intention. Le cerveau vulnérable au réveil : pourquoi pas de téléphone avant.', 'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique — Préparer son carnet de gratitude & premier bilan du soir', 'duration' => '15 min', 'description' => 'Carnet + stylo sur la table de nuit. Premier bilan : 3 gratitudes précises + 3 victoires + 1 intention pour demain.',     'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — Bilan du soir élargi & préparation du lendemain',         'duration' => '20 min', 'description' => '5 questions de clôture hebdomadaire + 10 minutes de préparation du lendemain (1 priorité, 3 tâches, 1 soin).',          'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle de gratitude',                                       'duration' => '7 min',  'description' => 'Scan de la journée · Respiration de clôture 4-6 · Phrase finale : "Il y avait du beau. Je peux me reposer."',           'content' => $meditation, 'audio' => true],
                ['type' => 'reflexion', 'title' => 'Journal — Mon défi 21 jours : date de début, date de D+21',          'duration' => '8 min',  'description' => 'Engagement 21 jours écrit dans le carnet + date de vérification D+7 + règle des 48h pour ne pas abandonner.',          'content' => $reflexion],
            ],
        ];
    }

    private function m09_priorites(): array  // Définir mes priorités — réalise tes rêves ou tu réaliseras ceux des autres
    {
        $gold   = 'rgba(201,168,76,.9)';
        $green  = 'rgba(34,197,94,.8)';
        $orange = 'rgba(249,115,22,.8)';
        $teal   = 'rgba(20,184,166,.8)';
        $blue   = 'rgba(59,130,246,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $indigo = 'rgba(99,102,241,.8)';
        $red    = 'rgba(239,68,68,.8)';

        $intro =
            $this->card($gold, 'Le choix fondamental', 'Réalise tes rêves ou tu réaliseras ceux de quelqu\'un d\'autre',
                '<div style="font-size:.92rem;line-height:2.3;color:rgba(232,224,208,.85);font-style:italic;margin-bottom:1rem;border-left:3px solid rgba(201,168,76,.5);padding-left:1rem;">
                « Si tu ne construis pas tes rêves, quelqu\'un t\'embauchera pour construire les siens. »<br>
                <span style="font-size:.75rem;color:rgba(201,168,76,.6);">— Tony Gaskins</span>
                </div>
                Regardez votre semaine dernière. Vraiment.<br>
                Combien d\'heures avez-vous passé sur VOS priorités ?<br>
                Combien sur les priorités de votre patron, de vos clients, de vos proches, de vos réseaux ?<br><br>
                La plupart des gens découvrent à 60 ans qu\'ils ont vécu 40 ans de la vie de quelqu\'un d\'autre.<br>
                Non par malveillance — mais par absence de définition de leur propre direction.<br><br>
                <em><strong>Ce module est un outil de souveraineté :<br>
                décider de ce qui compte vraiment POUR VOUS, et en faire la structure de votre temps.</strong></em>'
            );

        $lecon1 =
            $this->card($teal, 'La loi de Pareto', '20% des actions génèrent 80% des résultats',
                '<strong>Vilfredo Pareto, économiste, 1906 :</strong> 20% des pois de son jardin produisaient 80% des récoltes.<br>
                Richard Koch (auteur de <em>The 80/20 Principle</em>) a généralisé cette observation à toute vie humaine.<br><br>
                <div style="background:rgba(20,184,166,.08);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.3;font-size:.85rem;">
                20% de vos actions génèrent 80% de vos revenus<br>
                20% de vos relations créent 80% de votre bonheur social<br>
                20% de vos habitudes créent 80% de votre bien-être<br>
                20% de vos peurs bloquent 80% de votre potentiel
                </div>
                La question n\'est pas "comment faire plus ?" mais <strong>"sur quel 20% dois-je tout miser ?"</strong><br><br>
                <em>La stratégie des 25 objectifs de Warren Buffett :<br>
                Listez vos 25 aspirations. Entourez les 5 plus importantes. Évitez activement les 20 autres.<br>
                Les 20 autres ne sont pas secundaires — ils sont les plus dangereux car assez attrayants pour vous distraire.</em>'
            )
            .$this->card($blue, 'Stratégie', 'La différence entre urgence et importance — Eisenhower',
                '<strong>Dwight D. Eisenhower, 34e Président des États-Unis :</strong><br>
                "Ce qui est important est rarement urgent et ce qui est urgent est rarement important."<br><br>
                <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;font-size:.85rem;">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;">
                <div style="background:rgba(34,197,94,.08);border-radius:8px;padding:.65rem .85rem;border:1px solid rgba(34,197,94,.2);">
                <strong style="color:rgba(34,197,94,.9);">URGENT + IMPORTANT</strong><br>
                <em>Faire maintenant</em><br>
                Crise réelle, deadline critique
                </div>
                <div style="background:rgba(59,130,246,.08);border-radius:8px;padding:.65rem .85rem;border:1px solid rgba(59,130,246,.2);">
                <strong style="color:rgba(59,130,246,.9);">IMPORTANT + PAS URGENT</strong><br>
                <em>Planifier — C\'est ici que vivent vos rêves</em><br>
                Santé, relations, projets, formation
                </div>
                <div style="background:rgba(239,68,68,.08);border-radius:8px;padding:.65rem .85rem;border:1px solid rgba(239,68,68,.2);">
                <strong style="color:rgba(239,68,68,.9);">URGENT + PAS IMPORTANT</strong><br>
                <em>Déléguer</em><br>
                Notifications, demandes des autres
                </div>
                <div style="background:rgba(107,114,128,.08);border-radius:8px;padding:.65rem .85rem;border:1px solid rgba(107,114,128,.2);">
                <strong style="color:rgba(107,114,128,.7);">PAS URGENT + PAS IMPORTANT</strong><br>
                <em>Éliminer</em><br>
                Réseaux sociaux passifs, TV par défaut
                </div>
                </div>
                </div>
                <em>La majorité du temps des gens se passe dans le quadrant urgent-pas-important (réactivité).<br>
                Votre vie transformée vit dans le quadrant important-pas urgent (proactivité).</em>'
            );

        $lecon2 =
            $this->card($orange, 'Le système des 90 jours', 'Pourquoi 90 jours et pas 1 an',
                '<strong>Un an est trop long pour maintenir la motivation.</strong><br>
                Une semaine est trop court pour créer un changement de fond.<br>
                90 jours est le cycle optimal — assez court pour rester focalisé, assez long pour voir des résultats.<br><br>
                <div style="background:rgba(249,115,22,.08);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.3;font-size:.85rem;">
                <strong style="color:rgba(249,115,22,.9);">Structure des 90 jours :</strong><br>
                → <strong>1 objectif principal</strong> — celui qui change vraiment votre vie si atteint<br>
                → <strong>3 objectifs secondaires</strong> — qui soutiennent le principal<br>
                → <strong>1 revue hebdomadaire</strong> — chaque lundi, 15 min : suis-je sur la bonne voie ?<br>
                → <strong>1 bilan trimestriel</strong> — qu\'ai-je atteint ? Que modifie-je pour les 90 prochains ?
                </div>
                Le cerveau traite mieux les horizons à 90 jours (1 saison) que les objectifs annuels.<br>
                <em>(Recherche en psychologie de la motivation : Gollwitzer & Sheeran, 2006)</em>'
            )
            .$this->card($purple, 'Identifier vos vraies priorités', 'Le test des 3 filtres',
                '<strong>Pour savoir si quelque chose est vraiment une priorité pour VOUS :</strong><br><br>
                <div style="background:rgba(168,85,247,.08);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.3;font-size:.85rem;">
                <strong style="color:rgba(168,85,247,.9);">Filtre 1 — L\'origine</strong> : Cette priorité vient-elle de vous ou de l\'attente de quelqu\'un d\'autre ?<br>
                (parent, société, partenaire, réseau social)<br><br>
                <strong style="color:rgba(168,85,247,.9);">Filtre 2 — L\'énergie</strong> : Quand vous y pensez, êtes-vous animé·e ou obligé·e ?<br>
                (l\'animé est la bonne direction, l\'obligé est la priorité de quelqu\'un d\'autre)<br><br>
                <strong style="color:rgba(168,85,247,.9);">Filtre 3 — Le sacrifice</strong> : Êtes-vous prêt·e à sacrifier autre chose pour ça ?<br>
                (sans sacrifice réel, ce n\'est pas une priorité — c\'est un souhait)
                </div>
                <em>Ce qui passe les 3 filtres EST votre vraie priorité.</em>'
            );

        $ex1 =
            $this->exercice($gold, '1', 'Mes 3 priorités pour les 90 prochains jours — exercise de clarté',
                '<strong>Matériel : papier + stylo. Pas d\'ordinateur.</strong><br><br>
                <strong>Étape 1 — Déballer (5 min)</strong><br>
                Listez TOUT ce que vous voudriez faire/avoir/être dans les 90 jours.<br>
                Sans filtre. Tout. Même les choses "impossibles".<br><br>
                <strong>Étape 2 — Filtrer (3 min)</strong><br>
                Relisez chaque item. Appliquez les 3 filtres (origine, énergie, sacrifice).<br>
                Entourez les 3 qui passent le test.<br><br>
                <strong>Étape 3 — Planifier (7 min)</strong><br>
                Pour chaque priorité retenue :<br>
                <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.75rem 1rem;margin:.5rem 0;line-height:2.3;font-size:.83rem;">
                · Quelle est la première action concrète que je peux faire cette semaine ?<br>
                · Combien d\'heures/semaine est-ce que je lui alloue ?<br>
                · À quelle heure précise dans mon agenda ?
                </div>
                <em>Ce n\'est pas fait tant que ce n\'est pas dans l\'agenda.</em>', false
            );

        $ex2 =
            $this->exercice($red, '2', 'L\'audit de ma semaine — où va vraiment mon temps ?',
                'Prenez la semaine dernière. Estimez honnêtement :<br><br>
                <div style="background:rgba(239,68,68,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.5;font-size:.83rem;color:rgba(232,224,208,.78);">
                · Heures de travail pour les priorités DES AUTRES (patron, clients, obligations subies) : __h<br>
                · Heures sur les réseaux sociaux (passif, par ennui) : __h<br>
                · Heures sur mes 3 vraies priorités (exercice précédent) : __h<br>
                · Heures sur ma santé (sport, sommeil de qualité, soin de soi) : __h<br>
                · Heures sur des relations choisies (pas subies) : __h
                </div>
                <strong>La révélation :</strong> la plupart des gens découvrent qu\'ils passent <em>moins de 2 heures/semaine</em> sur leurs vraies priorités.<br><br>
                <strong>Mon engagement :</strong> Pour les 90 prochains jours, je réserve __ heures/semaine à chacune de mes 3 priorités.<br>
                Je mets ces blocs de temps dans mon agenda aujourd\'hui.', false
            )
            .$this->exercice($green, '3', 'Mon "non" le plus important — la compétence de la limite',
                '"Oui" à quelque chose est toujours un "non" à autre chose.<br><br>
                <strong>Identifiez :</strong><br>
                <div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;font-size:.83rem;color:rgba(232,224,208,.78);">
                · Le <strong>"oui" que je dis par culpabilité</strong> alors que ça empiète sur mes priorités<br>
                · La <strong>personne la plus difficile</strong> à qui dire non dans ma vie actuelle<br>
                · Le <strong>contexte récurrent</strong> où je laisse les priorités des autres remplacer les miennes
                </div>
                <strong>Pratique concrète de cette semaine :</strong><br>
                Choisissez 1 situation concrète où vous allez dire "non" ou "pas maintenant".<br>
                Formulez votre refus : <em>"Je ne suis pas disponible pour ça, mais je peux [alternative ou délai]."</em><br><br>
                <em>Le "non" dit avec respect et clarté est un des actes les plus aimants qui existent.<br>
                Il protège votre énergie pour ceux à qui vous dites vraiment "oui".</em>', false
            );

        $meditation =
            $this->exercice($orange, '4', '🌬 Pause Souffle de clarté',
                '<strong>Durée : 8 minutes · Idéale après l\'exercice de définition des priorités</strong><br><br>
                <strong>① Ancrage (2 min)</strong><br>
                Posez les mains à plat sur votre carnet de priorités.<br>
                Sentez le papier. Ce sont vos priorités. Elles existent maintenant.<br><br>
                <strong>② Visualisation des 90 jours — 5 cycles 5-5-5</strong><br>
                Inspirez 5s : imaginez dans 90 jours — vous avez accompli votre priorité principale.<br>
                Retenez 5s : ressentez ce que vous ressentez. La fierté, le soulagement, la joie.<br>
                Expirez 5s : ancrez cette image dans votre corps.<br><br>
                <strong>③ La décision</strong><br>
                <em>"Mes rêves comptent. Mon temps compte. Je choisis de vivre mes priorités, pas celles des autres.<br>
                À partir de maintenant."</em>', true
            );

        $reflexion =
            $this->exercice($indigo, '5', 'Ma déclaration de souveraineté — ce que je construis maintenant',
                'Pas un vœu. Une déclaration d\'action.<br><br>
                <strong>Complétez ces 4 phrases :</strong><br>
                <div style="background:rgba(99,102,241,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.5;font-size:.83rem;color:rgba(232,224,208,.78);">
                · "Dans 90 jours, si je reste concentré·e, j\'aurai __________ ."<br>
                · "Le plus grand obstacle que j\'anticipe est __________ — et je l\'anticipe en faisant __________ ."<br>
                · "La personne à qui je vais dire \'non\' cette semaine pour protéger ma priorité est __________ ."<br>
                · "Ce que je construis appartient à __________ (moi, mes enfants, ma communauté) — et c\'est pour ça que ça compte."
                </div>
                <strong>Action immédiate :</strong> Allez dans votre agenda en ce moment.<br>
                Bloquez les créneaux de votre priorité principale pour les 4 prochaines semaines.<br>
                <em>Ce qui n\'est pas schedulé n\'existe pas.</em>', false
            );

        return [
            'description' => 'Définir ses priorités — Pareto 80/20, Buffett\'s 2-list strategy, matrice Eisenhower, système des 90 jours. L\'audit de votre temps réel + les 3 vraies priorités + l\'art du "non" protecteur.',
            'intro_text'  => "MODULE 09 — Définir mes priorités\n\n\"Si tu ne construis pas tes rêves, quelqu'un t'embauchera pour construire les siens.\" — Tony Gaskins\n\nCe module est un outil de souveraineté. Il vous donne les outils pour identifier vos vraies priorités (pas celles qu'on vous a assignées), auditer où va vraiment votre temps, et bloquer concrètement des créneaux pour ce qui compte.\n\nCette formation n'est pas née dans une bibliothèque. Elle est née de quelqu'un qui a cherché à comprendre depuis l'intérieur — en vivant ce qu'elle décrit, en portant les questions jusqu'à trouver les réponses. 'Cherchez et vous trouverez' — non comme promesse abstraite, mais comme description précise de ce qui s'est passé.",
            'audio_path'  => 'formation/audio/09-mes-priorites-dabord-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '🎯 Introduction — Réalise tes rêves ou tu réaliseras ceux des autres',      'duration' => '4 min',  'description' => 'La phrase de Tony Gaskins appliquée à la vie réelle. Combien d\'heures sur VOS priorités la semaine dernière ?',               'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — Loi de Pareto (80/20) & stratégie des 25 objectifs de Buffett',   'duration' => '8 min',  'description' => '20% des actions génèrent 80% des résultats. Listez 25 aspirations, gardez 5, évitez activement les 20 autres.',           'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Système des 90 jours & les 3 filtres de la vraie priorité',       'duration' => '6 min',  'description' => 'Pourquoi 90 jours. Matrice Eisenhower. Les 3 filtres : origine, énergie, sacrifice.',                                      'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique — Mes 3 priorités des 90 jours + planification agenda',            'duration' => '25 min', 'description' => 'Déballer · Filtrer · Planifier. Chaque priorité retenue = heure précise dans l\'agenda cette semaine.',                 'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — Audit temps réel + mon "non" le plus important',                 'duration' => '20 min', 'description' => 'Combien d\'heures vraiment sur mes priorités la semaine dernière ? + choisir et formuler 1 refus protecteur.',             'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle de clarté',                                                 'duration' => '8 min',  'description' => 'Visualisation des 90 jours · Image de la priorité accomplie · Décision : "Mes rêves comptent. A partir de maintenant."', 'content' => $meditation, 'audio' => true],
                ['type' => 'reflexion', 'title' => 'Journal — Ma déclaration de souveraineté & l\'agenda bloqué',               'duration' => '10 min', 'description' => '4 phrases de déclaration + action immédiate : bloquer les créneaux dans l\'agenda pour les 4 prochaines semaines.',       'content' => $reflexion],
            ],
        ];
    }

    private function m10_interieur(): array  // Un intérieur propre et rangé — la discipline qui commence chez soi
    {
        $gold   = 'rgba(201,168,76,.9)';
        $green  = 'rgba(34,197,94,.8)';
        $orange = 'rgba(249,115,22,.8)';
        $teal   = 'rgba(20,184,166,.8)';
        $blue   = 'rgba(59,130,246,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $indigo = 'rgba(99,102,241,.8)';

        $intro =
            $this->card($gold, 'Le discours qui a changé des millions de vies', '"Make Your Bed" — l\'Amiral McRaven',
                '<div style="font-size:.92rem;line-height:2.3;color:rgba(232,224,208,.85);font-style:italic;margin-bottom:1rem;border-left:3px solid rgba(201,168,76,.5);padding-left:1rem;">
                « Si vous voulez changer le monde, commencez par faire votre lit. »<br>
                <span style="font-size:.75rem;color:rgba(201,168,76,.6);">— Amiral William H. McRaven, Université du Texas Austin, 2014</span>
                </div>
                L\'Amiral McRaven, commandant des Navy SEALs, explique :<br>
                <em>"Si vous faites votre lit chaque matin, vous aurez accompli une première tâche de la journée.<br>
                Cela vous donnera un sentiment de fierté, et vous encouragera à en faire une autre, puis une autre.<br>
                Et à la fin de la journée, UNE tâche accomplie se sera transformée en une multitude.<br>
                Faire votre lit montre aussi que les petites choses comptent."</em><br><br>
                Un espace ordonné n\'est pas une contrainte superficielle.<br>
                <strong>C\'est le premier signal que vous envoyez à votre cerveau chaque matin :<br>
                "Je suis capable. Je contrôle mon environnement. Je commence par gagner."</strong>'
            );

        $lecon1 =
            $this->card($teal, 'Science', 'L\'espace ordonné change littéralement le fonctionnement cognitif',
                '<strong>Princeton Neuroscience Institute (2011) — IRM et désordre visuel :</strong><br><br>
                Des participants sont exposés à des espaces ordonnés vs désordonnés pendant 30 minutes.<br>
                IRM montrent : le désordre visuel active en permanence le cortex visuel,<br>
                <strong>réduisant la capacité de concentration de 12 à 18%.</strong><br><br>
                <div style="background:rgba(20,184,166,.08);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.1;font-size:.85rem;">
                <strong style="color:rgba(20,184,166,.9);">Ce que génère un espace en désordre :</strong><br>
                · Cortisol élevé (état de stress de fond constant)<br>
                · Fatigue décisionnelle accélérée (trop de stimuli inutiles)<br>
                · Procrastination augmentée (l\'environnement reflète un état de "chaos acceptable")<br><br>
                <strong style="color:rgba(34,197,94,.9);">Ce que génère un espace ordonné :</strong><br>
                · Réduction mesurable de l\'anxiété au réveil<br>
                · Meilleure qualité de sommeil (UCLA study, 2015)<br>
                · Sentiment de contrôle et d\'auto-efficacité
                </div>'
            )
            .$this->card($blue, 'La théorie des vitres brisées', 'Kelling & Wilson — l\'effet de l\'environnement sur le comportement',
                '<strong>George Kelling & James Wilson, The Atlantic, 1982 :</strong><br>
                Si une vitre cassée dans un immeuble n\'est pas réparée rapidement,<br>
                toutes les autres vitres seront brisées peu après.<br><br>
                L\'environnement en désordre envoie le signal que <em>"ici, personne ne prend soin de quoi que ce soit"</em>.<br>
                Ce signal affecte le comportement de TOUS ceux qui y vivent.<br><br>
                <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;font-size:.85rem;font-style:italic;color:rgba(232,224,208,.75);border-left:3px solid rgba(59,130,246,.3);">
                Appliqué à votre espace de vie :<br>
                Un lit non fait → "nul besoin de ranger la chambre"<br>
                Une chambre non rangée → "nul besoin de nettoyer la maison"<br>
                Une maison négligée → "je ne mérite pas mieux que ça"
                </div>
                <em>L\'ordre chez soi est une déclaration silencieuse : "Je me respecte. Je prends soin de ce qui m\'entoure."</em>'
            );

        $lecon2 =
            $this->card($orange, 'La méthode', 'Le système hebdomadaire de discipline domestique',
                '<strong>Marie Kondo + héritage de nos grand-mères condensés en système :</strong><br><br>
                <div style="background:rgba(249,115,22,.08);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.5;font-size:.85rem;">
                <strong style="color:rgba(249,115,22,.9);">CHAQUE MATIN (10 min) :</strong><br>
                · Faire son lit — dès le lever, avant tout le reste<br>
                · Ouvrir les fenêtres — 10 min d\'air frais, toujours en hiver<br>
                · Ranger ce qui traîne — pas une liste, juste ce qui a été déplacé la veille<br><br>
                <strong style="color:rgba(249,115,22,.9);">CHAQUE SEMAINE (vendredi soir ou samedi matin) :</strong><br>
                · Changer les draps — chaque semaine sans exception<br>
                · Ménage complet — 2 heures, un espace à fond + entretien courant<br>
                · Faire le vide — 1 objet sorti / 1 objet rentré (règle "un entrée = une sortie")<br><br>
                <strong style="color:rgba(249,115,22,.9);">CHAQUE MOIS :</strong><br>
                · Reset complet d\'une pièce — "spark joy" complet (Kondo)
                </div>'
            )
            .$this->card($purple, 'L\'analogie la plus puissante', 'Entretenir sa maison comme on entretient ses relations',
                '<strong>Ce que nos espaces de vie révèlent de nos espaces intérieurs :</strong><br><br>
                Quand la maison est dans le chaos, les relations le ressentent.<br>
                L\'accueil que vous faites aux autres commence par l\'espace que vous habitez.<br><br>
                <div style="background:rgba(168,85,247,.08);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.3;font-size:.85rem;">
                On ne peut pas recevoir avec joie dans un espace qui génère de la honte.<br>
                On ne peut pas se ressourcer dans un espace qui épuise le regard.<br>
                On ne peut pas accueillir les autres si l\'on ne s\'est pas accueilli soi-même.
                </div>
                <em>Entretenir votre espace de vie, c\'est entretenir votre relation à vous-même<br>
                — et par extension, à tous ceux que vous aimez.</em><br><br>
                <strong>La règle des draps :</strong> Des draps propres chaque semaine.<br>
                Vous passez 7 à 9 heures dans votre lit chaque nuit — 1/3 de votre vie.<br>
                Ce n\'est pas du luxe. C\'est de la dignité.'
            );

        $ex1 =
            $this->exercice($gold, '1', 'La grande remise à niveau — faire MAINTENANT, pas demain',
                '<strong>Ne lisez pas et passez à la suite. Faites d\'abord.</strong><br><br>
                Dans les 24 prochaines heures, réalisez ces 4 actions PHYSIQUES :<br><br>
                <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.5;font-size:.85rem;">
                ☐ <strong>Faites votre lit</strong> — maintenant, si ce n\'est pas fait<br>
                ☐ <strong>Ouvrez les fenêtres de tous les espaces</strong> — 15 minutes d\'aération complète<br>
                ☐ <strong>Choisissez UNE pièce</strong> — et passez exactement 45 minutes à la ranger impeccablement<br>
                ☐ <strong>Sortez 5 objets</strong> que vous n\'utilisez plus — sac poubelle ou carton pour don
                </div>
                <strong>Ce que vous allez ressentir après :</strong><br>
                Une légèreté immédiate. Un sentiment de compétence. L\'envie de continuer.<br>
                <em>C\'est l\'effet McRaven. La première victoire de la journée appelle les suivantes.</em>', false
            );

        $ex2 =
            $this->exercice($teal, '2', 'Mon protocole de discipline domestique — la checklist à afficher',
                '<strong>Créez votre checklist physique — à imprimer ou écrire et afficher dans la cuisine ou la salle de bain.</strong><br><br>
                Modèle à personnaliser :<br>
                <div style="background:rgba(20,184,166,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.5;font-size:.83rem;color:rgba(232,224,208,.78);">
                <strong>CHAQUE MATIN :</strong><br>
                ☐ Lit fait (5 min) · ☐ Fenêtres ouvertes (10 min) · ☐ Cuisine nettoyée<br><br>
                <strong>CHAQUE SOIR :</strong><br>
                ☐ Vaisselle propre · ☐ Surfaces débarrassées · ☐ Entrée rangée<br><br>
                <strong>VENDREDI SOIR OU SAMEDI :</strong><br>
                ☐ Draps changés · ☐ Ménage complet 2h · ☐ Salle de bain désinfectée<br><br>
                <strong>1ER DU MOIS :</strong><br>
                ☐ Reset d\'une pièce complète · ☐ Placard / tiroir vidé et réorganisé
                </div>
                <strong>La règle d\'or :</strong> 10 minutes chaque matin = 70 minutes de propreté passive par semaine.<br>
                <em>C\'est 10 fois moins que de tout faire en une seule fois épuisante.</em>', false
            )
            .$this->exercice($green, '3', 'Ma pièce prioritaire — le projet de transformation de l\'espace',
                'Regardez votre logement. Une pièce ou un espace vous fait baisser l\'énergie à chaque fois que vous y entrez.<br>
                C\'est celle-là en premier.<br><br>
                <strong>Plan de transformation en 3 sessions :</strong><br>
                <div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;font-size:.83rem;color:rgba(232,224,208,.78);">
                <strong>Session 1 (1h)</strong> : Trier. Tout sortir. Décider : garde / donne / jette.<br>
                <strong>Session 2 (1h)</strong> : Nettoyer à fond l\'espace vide. Chaque coin. Poussière et détails.<br>
                <strong>Session 3 (1h)</strong> : Remettre uniquement ce qui a sa place et sa fonction.
                </div>
                <strong>La règle de Marie Kondo :</strong> "Est-ce que cet objet m\'apporte de la joie ?"<br>
                Si non, il n\'a pas sa place dans votre espace de vie.<br><br>
                <em>Vous n\'êtes pas en train de ranger votre maison.<br>
                Vous êtes en train de définir quel type de vie vous voulez habiter.</em>', false
            );

        $meditation =
            $this->exercice($orange, '4', '🌬 Pause Souffle dans l\'espace rangé',
                '<strong>Durée : 7 minutes · À pratiquer après avoir rangé — dans l\'espace que vous venez de transformer</strong><br><br>
                <strong>① Observation consciente (2 min)</strong><br>
                Regardez l\'espace rangé autour de vous. Ne faites rien d\'autre.<br>
                Notez ce que vous ressentez dans le corps. Ce calme est réel. Il est mesurable.<br><br>
                <strong>② Respiration de l\'espace — 5 cycles 5-5-5</strong><br>
                Inspirez 5s : imaginez que cette clarté physique entre dans votre esprit.<br>
                Retenez 5s : laissez l\'ordre extérieur créer l\'ordre intérieur.<br>
                Expirez 5s : relâchez le chaos mental que vous portiez.<br><br>
                <strong>③ L\'intention d\'entretien</strong><br>
                <em>"Cet espace me ressemble. Je le maintiens non par obligation mais par respect de moi-même.<br>
                Ce que j\'entretiens dehors, je le renforce dedans."</em>', true
            );

        $reflexion =
            $this->exercice($indigo, '5', 'Mon engagement de discipline — la pièce, la semaine, les draps',
                '<strong>3 engagements concrets à écrire maintenant :</strong><br>
                <div style="background:rgba(99,102,241,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.5;font-size:.83rem;color:rgba(232,224,208,.78);">
                ① <strong>Ma pièce prioritaire</strong> : __________ — je commence ma transformation le __________ (date)<br>
                ② <strong>Mon rituel du matin</strong> : lit fait + fenêtres ouvertes, chaque jour pendant __ semaines<br>
                ③ <strong>Mon jour de ménage hebdomadaire</strong> : chaque __________ (fixer un jour fixe)
                </div>
                <strong>La réflexion profonde :</strong><br>
                <div style="background:rgba(0,0,0,.2);border-left:3px solid rgba(201,168,76,.4);border-radius:0 8px 8px 0;padding:.85rem 1rem;line-height:2.2;font-size:.83rem;color:rgba(232,224,208,.65);">
                · En quoi l\'état de votre espace actuel reflète-t-il l\'état de votre vie intérieure ?<br>
                · Que voulez-vous que ceux qui entrent chez vous ressentent ?<br>
                · Quelle est la prochaine relation que vous allez "changer les draps" — c\'est-à-dire entretenir avec soin cette semaine ?
                </div>', false
            );

        return [
            'description' => 'La discipline qui commence par faire son lit. Amiral McRaven, Théorie des vitres brisées, Princeton Neuroscience Institute, Marie Kondo. Protocole quotidien + hebdomadaire + transformation d\'une pièce prioritaire.',
            'intro_text'  => "MODULE 10 — Un intérieur propre et rangé\n\n\"Si vous voulez changer le monde, commencez par faire votre lit.\" — Amiral McRaven, Navy SEALs\n\nUn espace en désordre crée un esprit en désordre. La science le mesure. Un lit fait chaque matin est la première victoire de la journée — et elle appelle toutes les autres.\n\nCe module vous donne un système simple, hebdomadaire, concret pour entretenir votre espace comme vous entretenez vos relations : avec soin et régularité.",
            'audio_path'  => 'formation/audio/10-interieur-propre-et-range-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '🏠 Introduction — "Make Your Bed" & la première victoire du matin',         'duration' => '4 min',  'description' => 'L\'Amiral McRaven aux Navy SEALs : faire son lit = première victoire du jour qui appelle toutes les suivantes.',              'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — Princeton Neuroscience + Théorie des vitres brisées',             'duration' => '7 min',  'description' => 'Le désordre réduit la concentration de 12-18% (IRM). L\'espace envoie le signal : "je mérite d\'être négligé(e)."',       'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Le système hebdomadaire & entretenir comme ses relations',        'duration' => '5 min',  'description' => 'Marie Kondo + rituel des draps chaque vendredi. Entretenir son espace = entretenir sa relation à soi-même.',             'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique — La grande remise à niveau : 4 actions physiques maintenant',     'duration' => '45 min', 'description' => 'Faire son lit + aérer + ranger 1 pièce 45 min + sortir 5 objets inutilisés. Action avant lecture.',                     'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — Ma checklist à afficher + ma pièce prioritaire en 3 sessions',  'duration' => '30 min', 'description' => 'Créer sa checklist physique routines matin/soir/semaine + plan de transformation d\'une pièce en 3 × 1h.',               'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle dans l\'espace rangé',                                      'duration' => '7 min',  'description' => 'Observer l\'espace rangé · Respiration clarté extérieure → clarté intérieure · Intention d\'entretien.',                 'content' => $meditation, 'audio' => true],
                ['type' => 'reflexion', 'title' => 'Journal — 3 engagements concrets : pièce, matin, jour de ménage',          'duration' => '10 min', 'description' => 'Écrire la pièce prioritaire + date de début + rituel du matin quotidien + jour de ménage hebdomadaire fixe.',          'content' => $reflexion],
            ],
        ];
    }

    private function m11_transmettre(): array  // Je transmets ma transformation — Rayonnement personnel
    {
        $gold   = 'rgba(201,168,76,.9)';
        $green  = 'rgba(34,197,94,.8)';
        $orange = 'rgba(249,115,22,.8)';
        $teal   = 'rgba(20,184,166,.8)';
        $blue   = 'rgba(59,130,246,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $indigo = 'rgba(99,102,241,.8)';

        $intro =
            $this->card($gold, 'Le passage', 'Votre transformation ne vous appartient pas qu\'à vous',
                '<div style="font-size:.92rem;line-height:2.3;color:rgba(232,224,208,.85);font-style:italic;margin-bottom:1rem;border-left:3px solid rgba(201,168,76,.5);padding-left:1rem;">
                « On ne donne vraiment quelque chose que lorsqu\'on le transmet. »<br>
                <span style="font-size:.75rem;color:rgba(201,168,76,.6);">— Antoine de Saint-Exupéry</span>
                </div>
                Vous avez terminé onze modules.<br>
                Vous avez appris à vous rencontrer, à traverser vos blessures, à décrire votre bonheur.<br>
                Vous avez bougé, régulé, compris — et choisi d\'être présent·e.<br><br>
                Ce que vous avez traversé <strong>ne vous appartient pas seulement à vous</strong>.<br>
                La transformation que vous portez en ce moment est une ressource pour ceux qui vous entourent.<br><br>
                Ce module est une invitation à faire le pont entre votre chemin intérieur et le monde extérieur :<br>
                <em>non pas pour convaincre, non pas pour enseigner — mais pour <strong>rayonner et montrer l\'exemple</strong>.</em>'
            );

        $lecon1 =
            $this->card($teal, 'Science', 'L\'effet de débordement — votre transformation agit sur les autres',
                '<strong>L\'étude de Christakis & Fowler (Harvard Medical School, 2007)</strong><br>
                La plus grande étude jamais conduite sur la contagion émotionnelle dans les réseaux sociaux réels.<br>
                12 067 personnes suivies sur 32 ans.<br><br>
                <div style="background:rgba(20,184,166,.08);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;font-size:.88rem;">
                <strong style="color:rgba(20,184,166,.9);">Le bonheur se propage jusqu\'à 3 degrés de séparation.</strong><br>
                <span style="color:rgba(232,224,208,.65);">Si vous devenez plus heureux·se, vos amis (1er degré) ont 15% de chances supplémentaires d\'être heureux.<br>
                Les amis de vos amis (2ème degré) : 10%. Les inconnus de vos connaissances (3ème degré) : 6%.</span>
                </div>
                <em>Travailler sur soi, c\'est aussi travailler pour son entourage — sans rien avoir à expliquer.</em><br><br>
                Votre simple présence transformée dépose quelque chose dans le champ relationnel autour de vous.<br>
                Vous n\'avez pas à "monter sur scène". Vous avez à être authentiquement vous.'
            )
            .$this->card($blue, 'Psychologie', 'Transmettre sans imposer — la différence essentielle',
                '<strong>La transmission authentique n\'est pas de la propagande.</strong><br><br>
                <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.75rem 1rem;margin:.6rem 0;">
                <strong style="color:rgba(249,115,22,.9);">Imposer :</strong><br>
                "Tu devrais faire de la respiration consciente, ça change tout."<br>
                → Résistance. Sentiment d\'être jugé·e. Effet opposé.<br><br>
                <strong style="color:rgba(34,197,94,.9);">Transmettre :</strong><br>
                "Depuis que je pratique, je me sens moins submergé·e. Si ça t\'intéresse un jour…"<br>
                → Curiosité naturelle. Invitation ouverte. Respect de l\'autre.
                </div>
                La théorie de l\'autodétermination (Deci & Ryan, 1985) est formelle :<br>
                Le changement durable naît de la motivation intrinsèque, jamais de la pression externe.<br><br>
                <em>Votre rôle : montrer ce que vous vivez, pas expliquer ce qu\'ils devraient vivre.</em>'
            );

        $lecon2 =
            $this->card($orange, 'Les 3 niveaux', 'Comment la transformation se transmet vraiment',
                '<strong style="color:rgba(249,115,22,.9);">Niveau 1 — L\'exemple silencieux</strong><br>
                Vous changez. Votre énergie change. Votre façon d\'écouter change.<br>
                Les gens autour de vous le sentent avant même que vous parliez.<br>
                C\'est la transmission la plus puissante — et la plus invisible.<br><br>
                <strong style="color:rgba(249,115,22,.9);">Niveau 2 — Le partage authentique</strong><br>
                Vous partagez votre vécu sans généraliser ("moi, j\'ai découvert que…").<br>
                Vous n\'êtes pas en train de convaincre. Vous témoignez.<br><br>
                <strong style="color:rgba(249,115,22,.9);">Niveau 3 — Le rituel partagé</strong><br>
                Vous introduisez la pratique dans un moment de vie commun.<br>
                Pause Souffle avant un repas en famille. 3 respirations avant un appel difficile avec un proche.<br>
                Un rituel partagé crée une mémoire commune et un lien plus profond.'
            )
            .$this->card($purple, 'Philosophie', 'Ce que l\'on donne pousse dans celui qui reçoit',
                '<div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.75rem 1rem;margin:.6rem 0;font-style:italic;font-size:.83rem;color:rgba(232,224,208,.75);border-left:3px solid rgba(168,85,247,.4);">
                « Les gens oublieront ce que tu as dit. Ils oublieront ce que tu as fait.<br>
                Mais ils n\'oublieront jamais ce que tu leur as <strong>fait ressentir</strong>. »<br>
                <span style="font-size:.72rem;color:rgba(201,168,76,.5);">— Maya Angelou</span>
                </div>
                Transmettre, c\'est créer une expérience — pas délivrer un message.<br><br>
                <em>Quand vous êtes calme, vous transmettez le calme.<br>
                Quand vous êtes présent·e, vous apprenez à l\'autre à être présent·e à son tour.</em>'
            );

        $ex1 =
            $this->exercice($gold, '1', 'Le partage du 5-5-5 — initier une pratique commune',
                'Choisissez une personne de votre entourage proche (partenaire, enfant, ami·e, collègue).<br>
                Dans les 7 prochains jours, proposez-lui — naturellement, dans un moment de détente :<br><br>
                <em style="color:rgba(201,168,76,.8);">"J\'ai découvert quelque chose de simple qui m\'aide beaucoup. On peut essayer ensemble ?"</em><br><br>
                <strong>Le protocole 5-5-5 à deux :</strong><br>
                · Assis face à face ou côte à côte<br>
                · 3 cycles ensemble : inspirez 5 secondes · retenez 5 · expirez 5<br>
                · En silence. Sans explication pendant l\'exercice.<br>
                · Après : "Comment tu te sens ?"<br><br>
                <em>La méthode prend racine dans l\'expérience partagée, pas dans l\'explication.</em>', false
            );

        $ex2 =
            $this->exercice($teal, '2', 'Mon cercle de rayonnement — cartographier mon influence',
                'Prenez une feuille blanche. Dessinez 3 cercles concentriques.<br><br>
                <strong>Cercle 1 — Les intimes :</strong> Partenaire, enfants, meilleur·e ami·e.<br>
                → Comment ma transformation les affecte-t-elle déjà ? Qu\'est-ce qu\'ils ont remarqué ?<br><br>
                <strong>Cercle 2 — Les proches :</strong> Famille, amis, collègues.<br>
                → Avec qui pourrais-je partager quelque chose de ce chemin ? Sous quelle forme ?<br><br>
                <strong>Cercle 3 — Le monde :</strong> Vos interactions quotidiennes.<br>
                → Ma façon d\'être dans l\'espace public a-t-elle changé ? Mon énergie rayonne-t-elle autrement ?<br><br>
                <em>Ce n\'est pas un exercice de performance. C\'est une observation honnête de votre impact.</em>', false
            )
            .$this->exercice($green, '3', 'La lettre non envoyée — ce que j\'aurais voulu recevoir',
                'Pensez à une période difficile de votre vie — avant ce parcours.<br>
                Qu\'auriez-vous voulu qu\'on vous dise ? Qu\'auriez-vous eu besoin d\'entendre ?<br><br>
                Écrivez une lettre à cette version passée de vous :<br>
                <div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.75rem 1rem;margin:.6rem 0;font-style:italic;font-size:.83rem;color:rgba(232,224,208,.78);">
                "Je t\'écris depuis l\'autre côté. Tu traverses quelque chose de difficile en ce moment.<br>
                Je veux que tu saches que..."
                </div>
                En écrivant cette lettre, vous clarifiez ce que vous avez réellement traversé et ce que vous portez à offrir aux autres.<br>
                <em>Cette lettre est la matière brute de votre transmission authentique.</em>', false
            );

        $meditation =
            $this->exercice($orange, '4', '🌬 Pause Souffle du rayonnement',
                '<strong>Durée : 7-10 minutes · Idéale en fin de journée</strong><br><br>
                <strong>① Ancrage (3 cycles 5-5-5)</strong><br>
                Installez-vous. Fermez les yeux. Ressentez le contact de votre corps avec le sol.<br><br>
                <strong>② Le scan de transformation</strong><br>
                Parcourez mentalement les 11 modules que vous avez traversés.<br>
                Pour chacun : une image, une sensation, un mot.<br><br>
                <strong>③ La visualisation du rayonnement</strong><br>
                Imaginez votre corps comme une source de lumière douce.<br>
                Inspirez : recevez votre propre transformation.<br>
                Expirez lentement : laissez-la rayonner autour de vous, sans forcer, sans direction.<br><br>
                <strong>④ L\'intention</strong><br>
                <em>"Ce que j\'ai appris ne m\'appartient pas. Je le porte pour moi et pour ceux qui m\'entourent."</em>', true
            );

        $reflexion =
            $this->exercice($indigo, '5', 'Journal — Ce que je veux transmettre',
                'Dans votre journal, répondez à ces questions :<br><br>
                <div style="background:rgba(99,102,241,.07);border-radius:10px;padding:.85rem 1.1rem;line-height:2.3;font-size:.83rem;color:rgba(232,224,208,.78);">
                · <strong>Quel est le cadeau invisible</strong> que vous portez maintenant — celui que les gens reçoivent sans que vous le sachiez ?<br>
                · <strong>Quelle phrase</strong> vous a-t-on dite qui a changé quelque chose en vous — et que vous aimeriez dire à quelqu\'un d\'autre ?<br>
                · <strong>Comment avez-vous changé</strong> dans votre façon d\'être avec les autres depuis le Module 01 ?<br>
                · <strong>Quel rituel</strong> issu de ce parcours pourriez-vous introduire naturellement dans votre vie familiale ou amicale ?
                </div>
                <br>
                <div style="background:rgba(0,0,0,.2);border-left:3px solid rgba(201,168,76,.4);border-radius:0 8px 8px 0;padding:.7rem 1rem;font-size:.8rem;font-style:italic;color:rgba(232,224,208,.65);">
                « Ce que vous êtes parle si fort que je ne peux pas entendre ce que vous dites. »<br>
                <span style="font-size:.72rem;color:rgba(201,168,76,.5);">— Ralph Waldo Emerson</span>
                </div>', false
            );

        return [
            'description' => 'Je transmets ma transformation — La science de la contagion émotionnelle, les 3 niveaux de transmission et les pratiques concrètes pour rayonner authentiquement auprès de ses proches.',
            'intro_text'  => "MODULE 11 — Je transmets ma transformation\n\nVous avez traversé onze modules. Ce que vous avez construit ne vous appartient pas seulement.\n\nHarvard a mesuré que votre bonheur influence vos proches jusqu'à 3 degrés de séparation. Vous n'avez pas à expliquer, convaincre ou enseigner. Votre façon d'être — calme, présent·e, ancré·e — se dépose dans le champ relationnel autour de vous.",
            'audio_path'  => 'formation/audio/11-je-transmets-ma-transformation-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '🌟 Introduction — Votre transformation rayonne au-delà de vous',        'duration' => '4 min',  'description' => 'Votre transformation est une ressource pour votre entourage. Non pas pour convertir — pour rayonner.',                             'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — La science de la contagion émotionnelle',                      'duration' => '6 min',  'description' => 'Harvard 2007 : le bonheur se propage à 3 degrés. Transmettre sans imposer — la différence essentielle (Deci & Ryan).', 'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Les 3 niveaux de transmission & la philosophie du don',        'duration' => '5 min',  'description' => 'Exemple silencieux · Partage authentique · Rituel partagé. Maya Angelou et l\'art de faire ressentir.',             'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique — Le partage du 5-5-5 avec un proche',                          'duration' => '15 min', 'description' => 'Initier une pratique commune en 3 cycles partagés. La méthode prend racine dans l\'expérience, pas l\'explication.',  'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — Mon cercle de rayonnement & la lettre non envoyée',           'duration' => '25 min', 'description' => 'Cartographier son influence sur 3 cercles + écrire à la version passée de soi ce qu\'on aurait voulu entendre.',       'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle du rayonnement',                                         'duration' => '7 min',  'description' => 'Scan des 11 modules · Visualisation du rayonnement · Intention finale.',                                              'content' => $meditation, 'audio' => true],
                ['type' => 'reflexion', 'title' => 'Journal — Ce que je veux transmettre',                                   'duration' => '10 min', 'description' => '4 questions sur l\'impact invisible : quel cadeau portez-vous maintenant ? Comment avez-vous changé ?',              'content' => $reflexion],
            ],
        ];
    }

    // ─────────────────────────────────────────────────────────────────────────
    // MODULE 29 — Je synthétise mon Parcours  (PARCOURS 3 · S'Ouvrir)
    // ─────────────────────────────────────────────────────────────────────────
    private function m29_synthese(): array
    {
        $gold   = 'rgba(201,168,76,.9)';
        $teal   = 'rgba(20,184,166,.8)';
        $indigo = 'rgba(99,102,241,.85)';
        $green  = 'rgba(34,197,94,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $amber  = 'rgba(245,158,11,.85)';

        $intro_card = $this->card($gold, '∞+', '28 modules. Voici ce que vous emportez.',
            '28 modules. Des centaines d\'heures intérieures. Des pratiques, des prises de conscience, des ruptures et des ancrages.<br><br>
            Ce module n\'est pas une conclusion — c\'est une <strong>consolidation</strong>.<br><br>
            Avant de tourner la page, revenons sur ce que vous avez traversé. Pas pour le revivre, mais pour <strong>mesurer le chemin parcouru</strong> — et ne jamais oublier qui vous êtes devenu(e).'
        );

        $recap_p1 = $this->card($indigo, 'Parcours 1 · Se Retrouver', 'Les 8 modules fondateurs',
            '<strong>M01</strong> Je me rencontre — Premier face à face avec soi, sans masque ni jugement. La pause comme porte d\'entrée.<br>
            <strong>M02</strong> Je reconnais mes blessures — Les 5 blessures fondamentales (Lise Bourbeau). Voir au lieu de fuir.<br>
            <strong>M03</strong> Je décris mon bonheur — Votre boussole intérieure. Ce qui est vrai pour vous — pas pour les autres.<br>
            <strong>M04</strong> J\'écoute mon souffle — Cohérence cardiaque, 5 min de souffle = 5 h de paix intérieure.<br>
            <strong>M05</strong> Je découvre ma mission — L\'ikigaï, la raison d\'être. Ce que vous êtes venu(e) faire ici.<br>
            <strong>M06</strong> J\'incarne ma Vision — Clarté, courage, discipline. Devenir la personne de sa vision.<br>
            <strong>M07</strong> Je prends soin de moi — Le masque à oxygène. Se nourrir avant de nourrir les autres.<br>
            <strong>M08</strong> Gratitude & intention — Protocole 3-3-1. Bilan du soir, élan du matin.'
        );

        $recap_p2 = $this->card($gold, 'Parcours 2 · Se Construire', 'Les 11 modules de fondation',
            '<strong>M09</strong> Mes priorités d\'abord — Pareto 80/20, Buffett 2-list, Eisenhower. Faire moins, mieux, avec clarté.<br>
            <strong>M10</strong> Un intérieur propre — McRaven, discipline spatiale, Marie Kondo. L\'espace reflète l\'état intérieur.<br>
            <strong>M11</strong> Je bouge avec conscience — Les 3 axes corporels. 5 min de mobilité = cerveau actif et clair.<br>
            <strong>M12</strong> Mon système nerveux — Fenêtre de tolérance, nerf vague, activation et régulation consciente.<br>
            <strong>M13</strong> Je régule mes émotions — STOP, TIPP, co-régulation. Les émotions sont de l\'information.<br>
            <strong>M14</strong> Ici et maintenant — MBSR, ancrage sensoriel 5-4-3-2-1. La présence est un muscle.<br>
            <strong>M15</strong> Je dors et récupère — Chronotypes, hygiène du sommeil, cycles de 90 min.<br>
            <strong>M16</strong> Je mange en conscience — Mindful Eating, signaux de faim/satiété, repas sans écran.<br>
            <strong>M17</strong> Je pratique — Activité physique régulière. Le corps en mouvement = esprit libre.<br>
            <strong>M18</strong> Nutrition & Vitalité — Nourrir intelligemment. Énergie, microbiome, anti-inflammation.<br>
            <strong>M19</strong> Choisir avec discernement — Médecines complémentaires. Intégrer sans tout croire.'
        );

        $recap_p3 = $this->card($teal, 'Parcours 3 · S\'Ouvrir', 'Les 9 modules de rayonnement',
            '<strong>M20</strong> Je suis présent(e) à moi — La pleine présence à soi comme point de départ de tout lien authentique.<br>
            <strong>M21</strong> Je m\'accepte — Confiance & image de soi. Le regard intérieur avant le regard des autres.<br>
            <strong>M22</strong> Je crée du lien — Interactions sociales conscientes. Se connecter sans se perdre.<br>
            <strong>M23</strong> Je vis pleinement — Loisirs, sorties, voyages. Le jeu est sérieux — la vie aussi.<br>
            <strong>M24</strong> Je communique — Écoute active, CNV, assertivité. Parler vrai, entendre vraiment.<br>
            <strong>M25</strong> Énergie relationnelle — Intimité & vitalité partagée. Les liens qui nous élèvent.<br>
            <strong>M26</strong> Vivre, choisir, reconstruire — Traverser les ruptures, choisir sa direction, renaître.<br>
            <strong>M27</strong> Entretenir nos relations — La durée du lien. Rituels relationnels, entretien affectif.<br>
            <strong>M28</strong> Je transmets — Rayonnement personnel. Transmettre ce qu\'on a reçu : le plus grand cadeau.'
        );

        $ex_top5 = $this->exercice($gold, '①', 'Mes 5 pratiques incontournables — ce que je ne lâche plus',
            '<strong>Instruction :</strong> Feuilletez mentalement les 28 modules. Parmi toutes les pratiques traversées, <strong>quelles sont les 5 qui ont le plus changé votre quotidien ?</strong><br><br>
            Pour chacune, notez :<br>
            → Le nom de la pratique et son module d\'origine<br>
            → En 1 phrase : ce qu\'elle vous a apporté concrètement<br>
            → La fréquence à laquelle vous la faites maintenant<br><br>
            <strong>Exemples :</strong><br>
            · Cohérence cardiaque (M04) — <em>"Elle me recentre en 5 min quand je suis débordé(e)."</em><br>
            · Protocole 3-3-1 du soir (M08) — <em>"Je vais au lit en paix, pas en rumination."</em><br>
            · Buffett 2-list (M09) — <em>"Elle a libéré mon agenda de 60% de bruit."</em><br>
            · Faire mon lit + aérer (M10) — <em>"C\'est le premier geste de ma nouvelle identité chaque matin."</em><br>
            · STOP émotionnel (M13) — <em>"J\'ai arrêté de réagir à chaud."</em><br><br>
            <em style="color:'.$gold.';">Ces 5 pratiques sont votre noyau dur. Le socle sur lequel tout le reste repose.</em>'
        );

        $ex_victoires = $this->exercice($teal, '②', 'Mes 10 victoires concrètes — depuis le Module 01',
            '<strong>Instruction :</strong> Listez 10 changements <em>concrets et mesurables</em> dans votre vie depuis votre premier module. Pas des intentions. Des <strong>faits observables</strong>.<br><br>
            <strong>Exemples :</strong><br>
            · "Je dors maintenant 7h en moyenne au lieu de 5h30."<br>
            · "Je ne mange plus devant mon téléphone."<br>
            · "J\'ai dit non à 3 engagements qui ne me correspondaient pas."<br>
            · "Je fais 5 min de souffle chaque matin depuis 6 semaines."<br>
            · "J\'ai eu une conversation difficile que j\'évitais depuis des mois."<br>
            · "Mon intérieur est rangé et propre — et ça l\'est resté."<br>
            · "Je reconnais ma fatigue avant qu\'elle ne devienne épuisement."<br>
            · "J\'ai défini mes 3 priorités hebdomadaires et je les protège."<br><br>
            <em style="color:'.$teal.';">Ces victoires prouvent que vous avez changé — pas dans votre tête, dans vos actes.</em>'
        );

        $ex_roue = $this->exercice($purple, '③', 'Ma roue de transformation — mesurer le chemin sur 8 dimensions',
            '<strong>Instruction :</strong> Notez-vous de 1 à 10 sur chacun des 8 domaines <strong>aujourd\'hui</strong>. Puis comparez à ce que vous vous seriez donné le jour du Module 01 :<br><br>
            🟣 <strong>Corps & santé</strong> — énergie, vitalité, sommeil, alimentation<br>
            🔵 <strong>Mental & émotions</strong> — régulation, clarté, stabilité intérieure<br>
            🟡 <strong>Vision & mission</strong> — sens, direction, alignement avec vos valeurs<br>
            🟢 <strong>Espace de vie</strong> — intérieur, ordre, environnement stimulant<br>
            🔴 <strong>Temps & priorités</strong> — gestion, limites saines, focalisation<br>
            🟠 <strong>Relations</strong> — qualité du lien, communication, intimité<br>
            ⚪ <strong>Plaisir & loisirs</strong> — joie, sorties, créativité, repos actif<br>
            🟤 <strong>Croissance & transmission</strong> — apprentissage, partage, rayonnement<br><br>
            <em style="color:'.$purple.';">La différence entre les deux scores — c\'est votre transformation mesurée. Pas imaginée. Mesurée.</em>'
        );

        $meditation = $this->card($purple, 'Méditation guidée', '🌬 Pause Souffle — Clôture du Parcours (10 min)',
            '<strong>Installez-vous confortablement. Asseyez-vous ou allongez-vous. Fermez les yeux.</strong><br><br>
            <strong>PHASE 1 — Ancrage (2 min)</strong><br>
            Portez toute votre attention sur votre souffle naturel. Ne le contrôlez pas encore — observez simplement.<br>
            Sentez le poids de votre corps sur la chaise ou le sol. Vous êtes là. Vous êtes arrivé(e).<br><br>
            À présent : <strong>inspirez 5s · retenez 5s · expirez 5s.</strong><br>
            4 cycles. À chaque expiration, laissez les épaules descendre un peu plus.<br><br>
            <strong>PHASE 2 — Traversée intérieure (5 min)</strong><br>
            Relâchez le contrôle de votre souffle. Laissez-le respirer pour vous.<br>
            Mentalement, traversez votre parcours — sans effort, comme des images qui défilent :<br><br>
            · <em>Module 01 — la première fois que vous vous êtes vraiment regardé(e) en face…</em><br>
            · <em>Module 04 — le souffle que vous avez appris à maîtriser…</em><br>
            · <em>Module 08 — le système nerveux que vous avez commencé à comprendre…</em><br>
            · <em>Module 10 — votre espace transformé, la discipline qui commence à la maison…</em><br>
            · <em>Module 15 — le corps que vous avez recommencé à bouger, à vivre…</em><br>
            · <em>Module 20 — les choix difficiles, la reconstruction, les ruptures traversées…</em><br>
            · <em>Module 28 — la transmission, ce que vous portez maintenant pour les autres…</em><br><br>
            Laissez monter ce qui monte. Une gratitude. Une image. Une paix.<br>
            Respirez dessus. N\'analysez pas. Sentez seulement.<br><br>
            <strong>PHASE 3 — Intention pour la suite (3 min)</strong><br>
            Inspiration profonde. Posez en silence cette question :<br>
            <em>"Qui suis-je maintenant, après tout ce que j\'ai traversé ?"</em><br><br>
            Laissez la réponse venir — pas dans les mots, dans le corps.<br><br>
            Puis formulez une intention pour la suite, en une seule phrase intérieure :<br>
            <em>"Je continue avec… · Je porte maintenant… · Je choisis désormais…"</em><br><br>
            Trois dernières respirations profondes.<br>
            Ouvrez doucement les yeux.<br>
            <em>⏱ Durée totale : 10 min · Prenez un moment avant de vous lever. Vous venez de fermer un cycle.</em>'
        );

        return [
            'description' => 'Bilan de vos 28 modules. Chaque pratique, chaque prise de conscience consolidée en une session. Votre miroir de transformation avant de commencer la suite : votre vie.',
            'intro_text'  => "MODULE 29 — Je synthétise mon Parcours\n\n28 modules. Des centaines d'heures intérieures. Des pratiques, des prises de conscience, des ruptures et des ancrages.\n\nCe module n'est pas une conclusion — c'est une consolidation. Avant de tourner la page, revenons sur ce que vous avez traversé. Pas pour le revivre, mais pour mesurer le chemin — et ne jamais oublier qui vous êtes devenu(e).",
            'audio_path'  => null,
            'activities'  => [
                ['type' => 'lecture',  'title' => '🗺 Vos 28 modules — le chemin en 1 page',           'duration' => '10 min', 'description' => 'Récapitulatif des 3 Parcours : chaque module, chaque pratique essentielle condensée.',         'content' => $intro_card.$recap_p1.$recap_p2.$recap_p3],
                ['type' => 'exercice', 'title' => '⭐ Mes 5 pratiques incontournables',                 'duration' => '20 min', 'description' => 'Identifier les 5 pratiques qui ont le plus changé votre quotidien. Votre noyau dur.',          'content' => $ex_top5],
                ['type' => 'exercice', 'title' => '🏆 Mes 10 victoires concrètes',                     'duration' => '15 min', 'description' => '10 changements mesurables dans votre vie depuis le Module 01. Des faits, pas des espoirs.',   'content' => $ex_victoires],
                ['type' => 'exercice', 'title' => '🌀 Ma roue de transformation',                      'duration' => '15 min', 'description' => 'Mesurer le chemin parcouru sur 8 dimensions de vie — la transformation en chiffres.',        'content' => $ex_roue],
                ['type' => 'ecriture', 'title' => '✍️ Lettre à mon ancien moi',                        'duration' => '20 min', 'description' => 'Écrivez à la personne que vous étiez avant de commencer ce Parcours. Avec bienveillance.'],
                ['type' => 'ecriture', 'title' => '🌟 Mon identité renouvelée — "Je suis quelqu\'un qui..."', 'duration' => '15 min', 'description' => 'Complétez 10 fois en présent, en actes concrets : "Je suis quelqu\'un qui..."'],
                ['type' => 'pratique', 'title' => '🌬 Méditation de clôture — 10 min de présence totale', 'duration' => '10 min', 'description' => 'Traversée méditative de vos 28 modules. Ancrer. Reconnaître. Formuler votre intention pour la suite.', 'content' => $meditation],
            ],
            'activities_en' => [
                ['type' => 'lecture',  'title' => '🗺 Your 28 Modules — the journey in one page',       'duration' => '10 min', 'description' => 'Full recap of all 3 Journeys: every module and its essential practice, condensed.'],
                ['type' => 'exercice', 'title' => '⭐ My 5 non-negotiable practices',                   'duration' => '20 min', 'description' => 'Identify the 5 practices that most changed your daily life. Your core foundation.'],
                ['type' => 'exercice', 'title' => '🏆 My 10 concrete victories',                        'duration' => '15 min', 'description' => '10 measurable changes in your life since Module 01. Facts, not wishes.'],
                ['type' => 'exercice', 'title' => '🌀 My wheel of transformation',                      'duration' => '15 min', 'description' => 'Measure your journey on 8 life dimensions — transformation in numbers.'],
                ['type' => 'ecriture', 'title' => '✍️ Letter to my former self',                        'duration' => '20 min', 'description' => 'Write to the person you were before starting this Journey. With compassion.'],
                ['type' => 'ecriture', 'title' => '🌟 My renewed identity — "I am someone who..."',    'duration' => '15 min', 'description' => 'Complete 10 times in present tense, in concrete actions: "I am someone who..."'],
                ['type' => 'pratique', 'title' => '🌬 Closing meditation — 10 min of full presence',   'duration' => '10 min', 'description' => 'A meditative journey through all 28 modules. Anchor. Acknowledge. Set an intention for what comes next.'],
            ],
        ];
    }

    // ─────────────────────────────────────────────────────────────────────────
    // MODULE 30 — Mon Programme Quotidien  (PARCOURS 3 · S'Ouvrir)
    // ─────────────────────────────────────────────────────────────────────────
    private function m30_rituel_quotidien(): array
    {
        $gold   = 'rgba(201,168,76,.9)';
        $teal   = 'rgba(20,184,166,.8)';
        $indigo = 'rgba(99,102,241,.85)';
        $green  = 'rgba(34,197,94,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $amber  = 'rgba(245,158,11,.85)';

        /* ── LECTURE : architecture ─────────────────────────────── */
        $intro_archi = $this->card($gold, 'Pourquoi', 'Une journée qui vous ressemble — construite sur 28 modules',
            'Ce programme n\'est pas un planning de plus. Ce n\'est pas une liste de tâches déguisée en rituel.<br><br>
            C\'est <strong>la structure d\'une journée vivante</strong> — née de vos 28 modules, adaptée à votre vie réelle, personnalisable selon votre profil.<br><br>
            Chaque étape est reliée à un module que vous avez traversé. Chaque pratique a été testée et calibrée.<br><br>
            <strong>La promesse :</strong> suivre ce programme 21 jours consécutifs et observer ce qui change.<br>
            <em>Pas de perfection. Pas de tout faire. Un ancrage à la fois.</em>'
        ).$this->card($teal, 'Architecture', 'Les 3 blocs d\'une journée consciente',
            '<strong>① MATIN — L\'élan</strong> (lever → départ/travail)<br>
            Ce qui se passe dans les 60 premières minutes détermine le registre émotionnel et cognitif du reste de la journée. Neurobiologie : cortisol awakening response.<br><br>
            <strong>② JOURNÉE — Le flux</strong> (travail → milieu de journée)<br>
            3 pivots stratégiques pour maintenir clarté et énergie. Sans effondrement de 15h. Sans réactivité inutile.<br><br>
            <strong>③ SOIR — La dépose</strong> (retour → coucher)<br>
            Le rituel du soir programme le cerveau pendant le sommeil. Ce que vous pensez avant de dormir influence ce que vous ressentez au réveil.'
        );

        /* ── EXERCICE : rituel matin ────────────────────────────── */
        $matin =
            $this->card($teal, 'Étape 1 · Au lever', '🌬 Souffle d\'ancrage — 3 min  (M04)',
                '• <strong>Avant</strong> de regarder votre téléphone, avant de parler, avant de réfléchir.<br>
                • Asseyez-vous au bord du lit ou debout, les yeux encore mi-clos.<br>
                • 3 respirations : inspirez 5 sec → retenez 2 sec → expirez 7 sec.<br>
                • Posez une intention silencieuse en 1 phrase : <em>"Aujourd\'hui, je choisis de..."</em><br>
                <em style="font-size:.75rem;color:'.$teal.';">3 min · Module 04</em>'
            )
            .$this->card($gold, 'Étape 2 · Corps & espace', '🛏 Faire son lit + aérer — 5 min  (M10)',
                '• Faire son lit sans exception = <strong>première victoire de la journée</strong> (McRaven). Ce geste signal au cerveau : "Je suis quelqu\'un de discipliné."<br>
                • Ouvrir une fenêtre 5 min minimum : renouveler l\'air, laisser entrer la lumière naturelle.<br>
                • Si vous avez 2 min de plus : 3 étirements en douceur — cou, épaules, dos (M11).<br>
                <em style="font-size:.75rem;color:'.$gold.';">5 min · Modules 10, 11</em>'
            )
            .$this->card($indigo, 'Étape 3 · Gratitude', '🙏 Moment de reconnaissance — 5 min  (M08)',
                '• <strong>Protocole 3-3-1 :</strong><br>
                — 3 choses pour lesquelles vous êtes reconnaissant(e) ce matin (même petites)<br>
                — 3 qualités que vous vous reconnaissez aujourd\'hui<br>
                — 1 intention claire en 1 phrase pour la journée<br>
                • Écrivez dans un <strong>carnet physique</strong> (pas sur téléphone).<br>
                <em style="font-size:.75rem;color:'.$indigo.';">5 min · Module 08</em>'
            )
            .$this->card($gold, 'Étape 4 · Clarté', '📋 Mon planning journalier — 5 min  (M09)',
                '• Ouvrez votre agenda ou carnet de bord.<br>
                • Identifiez vos <strong>3 priorités absolues</strong> du jour (pas plus — Eisenhower + Pareto).<br>
                • Bloquez les plages horaires pour ces 3 priorités — ne les laissez pas ouvertes à l\'improvisation.<br>
                • Tout le reste est secondaire ou délégable aujourd\'hui.<br>
                <em style="font-size:.75rem;color:'.$gold.';">5 min · Module 09</em>'
            )
            .$this->card($teal, 'Étape 5 · Corps éveillé', '🤸 Mobilité matinale — 5-10 min  (M11)',
                '• 5 à 10 min de mobilité douce — pas de sport, pas de performance : activer les 3 axes.<br>
                — Axe vertical : flexions avant, relevés lents de la colonne<br>
                — Axe rotatoire : rotations du buste gauche/droite<br>
                — Axe latéral : inclinaisons sur les côtés, ouverture des hanches<br>
                • Option : 1 salutation au soleil (yoga), ou simples cercles d\'épaules + stretch du cou.<br>
                <em style="font-size:.75rem;color:'.$teal.';">5-10 min · Module 11</em>'
            )
            .$this->card($amber, 'Étape 6 · Nourrir', '🍳 Petit-déjeuner conscient — 15 min  (M16, M18)',
                '• Mangez <strong>assis, sans écran, sans téléphone</strong>.<br>
                • Ratio : protéines + bonnes graisses + glucides complexes (pas seulement sucre rapide).<br>
                • Mastiquez lentement (20+ fois) — la digestion commence dans la bouche.<br>
                • Option Pause Souffle : 3 cycles 5-5-5 avant de commencer à manger (active les enzymes digestives).<br>
                <em style="font-size:.75rem;color:'.$amber.';">15 min · Modules 16, 18</em>'
            )
            .$this->card($green, 'Étape 7 · Départ', '🚀 Se préparer & partir — incarner sa vision  (M06)',
                '• Coup de rangement rapide : 5 min (M10) — <strong>ne partez jamais dans le désordre</strong>.<br>
                • Regardez-vous dans le miroir et dites intérieurement :<br>
                <em>"Je suis prêt(e). J\'ai mes 3 priorités. Je pars avec intention."</em><br>
                • Ce n\'est pas naïf : c\'est du conditionnement identitaire — incarner la personne que vous devenez (M06).<br>
                <em style="font-size:.75rem;color:'.$green.';">5 min · Modules 06, 10</em>'
            );

        /* ── EXERCICE : pivots journée ──────────────────────────── */
        $journee =
            $this->card($teal, 'Pivot 1 · Focus profond', '⏱ Cycles ultradiens de 90 min  (M12)',
                '• Travaillez en blocs de <strong>90 min maximum</strong> sans interruption (cycle ultradien biologique).<br>
                • Notifications coupées. Mails fermés. Réseaux sociaux invisibles.<br>
                • Après chaque bloc : 15-20 min de récupération (marche, respiration, pause visuelle au loin).<br>
                <em style="font-size:.75rem;color:'.$teal.';">Référence : Module 12 — Système nerveux & récupération</em>'
            )
            .$this->card($gold, 'Pivot 2 · Repas conscient', '🍽 Déjeuner + marche de 10 min  (M14, M16)',
                '• Repas <strong>sans écran</strong> — 20 min minimum. Mastication lente. Pause Souffle avant.<br>
                • Après manger : 10 min de marche lente (régule la glycémie, active la digestion).<br>
                • Option ancrage : exercice 5-4-3-2-1 pendant la marche (M14) — 5 choses vues, 4 entendues, etc.<br>
                • Évitez la sieste sur chaise ; si besoin : 20 min allongé(e), chrono.<br>
                <em style="font-size:.75rem;color:'.$gold.';">Référence : Modules 14, 16</em>'
            )
            .$this->card($indigo, 'Pivot 3 · Recentrage 15h', '🌬 5 min de cohérence cardiaque  (M04, M09)',
                '• L\'effondrement de 15h est réel et prévisible — anticipez-le.<br>
                • 5 min de cohérence cardiaque (5-5-5) : recharge cognitive complète en 5 min.<br>
                • Pas de café après 15h — il retarde le sommeil de 2 à 4h.<br>
                • Re-vérifiez vos 3 priorités du matin : qu\'est-ce qui est fait ? Qu\'est-ce qui est encore là ?<br>
                <em style="font-size:.75rem;color:'.$indigo.';">Référence : Modules 04, 09</em>'
            );

        /* ── EXERCICE : rituel soir ─────────────────────────────── */
        $soir =
            $this->card($teal, 'Étape 1 · Transition', '🚪 Décompression consciente — 5 min  (M13)',
                '• En rentrant ou en finissant le travail : pause obligatoire <strong>avant</strong> de "rentrer dans la vie privée".<br>
                • 3 respirations profondes. Mains posées à plat sur les cuisses. Sentez le passage.<br>
                • Formulez en silence : <em>"Je quitte le travail. Je retrouve ma vie. Je suis ici."</em><br>
                • Option physique : changez de vêtements — signal concret au système nerveux que le mode change.<br>
                <em style="font-size:.75rem;color:'.$teal.';">5 min · Module 13</em>'
            )
            .$this->card($amber, 'Étape 2 · Rangement léger', '🏠 10 min de mise en ordre  (M10)',
                '• Avant de vous poser : 10 min de rangement léger de l\'espace de vie.<br>
                • Pas de grand ménage — juste <strong>remettre chaque chose à sa place</strong>.<br>
                • L\'environnement ordonné programme un soir calme et un matin fluide.<br>
                • Si vous avez des enfants : c\'est un rituel familial apprenant — incluez-les.<br>
                <em style="font-size:.75rem;color:'.$amber.';">10 min · Module 10</em>'
            )
            .$this->card($gold, 'Étape 3 · Bilan du soir', '📖 Protocole 3-3-1 — 5 min  (M08)',
                '• Dans votre carnet, complétez :<br>
                — 3 choses positives qui se sont passées aujourd\'hui (même petites)<br>
                — 3 actes dont vous êtes fier(e) aujourd\'hui<br>
                — 1 intention claire pour demain matin, en 1 phrase<br>
                • Cet exercice programme le cerveau pendant le sommeil sur des contenus positifs (Emmons & McCullough, 2003).<br>
                <em style="font-size:.75rem;color:'.$gold.';">5 min · Module 08</em>'
            )
            .$this->card($purple, 'Étape 4 · Corps apaisé', '🧘 Étirements + souffle du soir — 10 min  (M11, M15)',
                '• 5 à 10 min d\'étirements doux : hanches, bas du dos, nuque, épaules.<br>
                • Terminez allongé(e) en savasana : 3 min de souffle 4-7-8 (inspirez 4, retenez 7, expirez 8).<br>
                • Ce rythme respiratoire active puissamment le système parasympathique — endormissement facilité.<br>
                <em style="font-size:.75rem;color:'.$purple.';">10 min · Modules 11, 15</em>'
            )
            .$this->card($green, 'Étape 5 · Coucher', '🌿 Sans écran + bonne nuit à soi-même  (M01, M15)',
                '• Éteignez tous les écrans <strong>30 min avant de dormir</strong> (lumière bleue = retard de mélatonine de 2h).<br>
                '.'• Dites-vous, ou dites à votre partenaire, vos enfants :<br>
                <em>"Bonne nuit. Tu es en sécurité. Demain est une chance."</em><br>
                • Ce n\'est pas une formule — c\'est un acte de self-compassion (M01) et de préparation du sommeil (M15).<br>
                <em style="font-size:.75rem;color:'.$green.';">5 min · Modules 01, 15</em>'
            );

        /* ── EXERCICE : 4 profils ───────────────────────────────── */
        $profils =
            $this->card($indigo, 'Profil A · Solo / sans contrainte familiale', 'Le programme complet — 75 min cumulés',
                '<strong>Matin :</strong> 45 min (toutes les 7 étapes sans exception).<br>
                <strong>Journée :</strong> 3 pivots intégrés dans le flux de travail.<br>
                <strong>Soir :</strong> 30 min (toutes les 5 étapes).<br><br>
                <strong>Conseil Semaine 1 :</strong> Ne faites que 3 pratiques (souffle + lit + bilan). Ajoutez 1 pratique par semaine jusqu\'au programme complet. La constance bat la perfection.'
            )
            .$this->card($gold, 'Profil B · Avec enfants', 'Programme adapté famille — 30-40 min personnel',
                '<strong>Matin raccourci (avant le réveil des enfants) :</strong><br>
                → Réveillez-vous 15 min plus tôt.<br>
                → Souffle 3 min + gratitude express 2-3 min (carnet de nuit, table de chevet).<br>
                → Faire son lit + aérer : 5 min.<br>
                → Mobilité : intégrez les enfants — étirements en famille, 5 min ensemble.<br>
                → Petit-déjeuner <strong>ensemble, sans écrans à table</strong>.<br><br>
                <strong>Soir en famille :</strong><br>
                → Bilan à voix haute avec les enfants : <em>"Quelle est ta meilleure chose d\'aujourd\'hui ?"</em><br>
                → Rangement 10 min ensemble (ritualisez-le, ludique).<br>
                → Rituel coucher enfants : histoire + <em>"Bonne nuit, je t\'aime, tu es en sécurité."</em><br>
                → Votre moment personnel après qu\'ils soient couchés : étirements + journal.'
            )
            .$this->card($teal, 'Profil C · Télétravail', 'Programme frontières travail / vie personnelle',
                '<strong>Risque principal :</strong> la journée n\'a plus de bords. Tout se mélange.<br><br>
                <strong>Adaptations essentielles :</strong><br>
                → <strong>Rituel "faux départ" :</strong> habillez-vous, sortez 5 min, rentrez — le cerveau comprend "c\'est une vraie journée de travail".<br>
                → Fermez symboliquement le bureau à heure fixe : rangez le matériel, fermez l\'ordinateur, éteignez la lumière de bureau.<br>
                → <strong>Transition soir obligatoire :</strong> quittez la pièce de travail, changez de vêtements, 3 respirations avant de rejoindre l\'espace de vie.<br>
                → Sortie physique 1x/jour minimum — même 15 min dehors. Ne restez jamais enfermé toute la journée.'
            )
            .$this->card($purple, 'Profil D · Nomade / déplacements fréquents', 'Le programme en format bagage à main — 20 min',
                '<strong>Kit minimal non-négociable :</strong><br>
                → Souffle 3 min (n\'importe où : avion, train, chambre d\'hôtel)<br>
                → Gratitude 3-3-1 sur carnet ou note téléphone<br>
                → Intention du jour + 3 priorités (note téléphone)<br>
                → Marche consciente 10 min en arrivant à destination (ancrage sensoriel)<br>
                → Soir : bilan 5 min + étirements dans la chambre<br><br>
                <strong>Règle d\'or nomade :</strong> 3 pratiques minimum quel que soit l\'emploi du temps. La constance bat la perfection. Toujours.'
            );

        /* ── ECRITURE : contrat 21 jours ────────────────────────── */
        $contrat = $this->card($amber, 'Pourquoi 21 jours ?', 'La science de l\'ancrage',
            'La recherche de Phillippa Lally (UCL, 2010) indique que l\'automatisation d\'une habitude prend en moyenne 66 jours — mais les <strong>3 premières semaines sont la phase d\'ancrage critique</strong>.<br><br>
            21 jours consécutifs d\'une même pratique = création d\'une trace neuronale stable (James Clear, <em>Atomic Habits</em>).<br><br>
            <strong>Mon contrat personnel :</strong><br>
            Je choisis <strong>3 pratiques</strong> (pas plus) tirées de ce programme et je m\'engage à les faire chaque jour pendant 21 jours consécutifs.<br><br>
            Pratique 1 : ___________________________________________<br>
            Pratique 2 : ___________________________________________<br>
            Pratique 3 : ___________________________________________<br><br>
            Je commence le : _______________ / Je termine le : _______________<br><br>
            Mon déclencheur quotidien (quand ? après quoi ?) :<br>
            ___________________________________________<br><br>
            <em>Ce contrat est signé pour moi — pas pour quelqu\'un d\'autre.</em>'
        );

        $meditation = $this->card($teal, 'Méditation guidée', '🌬 Pause Souffle — Ancrage du Programme (5 min)',
            '<strong>Asseyez-vous, dos droit, mains posées à plat sur les cuisses. Fermez les yeux.</strong><br><br>
            <strong>PHASE 1 — Cohérence cardiaque 5-5 (3 min)</strong><br>
            Respirez à ce rythme exact, régulier, sans forcer :<br><br>
            <strong>Inspirez 5 secondes</strong> — par le nez, laissez le ventre se gonfler en premier, puis la poitrine s\'ouvrir.<br>
            <strong>Expirez 5 secondes</strong> — par le nez ou la bouche, ventre qui rentre doucement, épaules qui fondent.<br><br>
            6 cycles complets. À chaque cycle, votre système nerveux entre en cohérence cardiaque.<br>
            C\'est <em>exactement</em> ce geste — chaque matin, avant tout le reste — qui ancre tout ce que vous venez de bâtir.<br><br>
            <strong>PHASE 2 — Ancrage du programme (2 min)</strong><br>
            Sans rouvrir les yeux, laissez venir une image de demain matin :<br><br>
            → Vous vous réveillez. <em>Avant le téléphone.</em> Vous inspirez lentement, 5 secondes.<br>
            → Vous faites votre lit. Vous ouvrez la fenêtre. L\'air entre.<br>
            → Vous prenez votre carnet. Vous notez vos 3 priorités. Trois mots. Clarté totale.<br><br>
            Ressentez dans le corps ce que c\'est de commencer ainsi.<br>
            Ce n\'est plus un programme sur une page — c\'est <strong>votre journée, votre architecture, votre vie</strong>.<br><br>
            Trois respirations finales, plus longues, plus profondes.<br>
            Ouvrez les yeux.<br>
            <em>⏱ Durée totale : 5 min · Cette pratique, chaque jour, change tout. Commencez demain.</em>'
        );

        return [
            'description' => 'Le programme quotidien né de vos 28 modules — matin, journée, soir — avec 4 configurations adaptées (solo, famille, télétravail, nomade). Personnalisable. Durable. Puissant.',
            'intro_text'  => "MODULE 30 — Mon Programme Quotidien\n\nCe n'est pas un planning. C'est une architecture.\n\nChaque étape est reliée à un module que vous avez traversé. Chaque pratique est calibrée pour fonctionner dans une vraie journée — pas dans une journée idéale qui n'existe pas.\n\nLe programme complet prend 45 min le matin et 30 min le soir. Il existe en version 20 min pour les jours chargés. Il a 4 configurations selon votre vie. Et il inclut un contrat de 21 jours pour l'ancrer définitivement dans votre quotidien.",
            'audio_path'  => null,
            'activities'  => [
                ['type' => 'lecture',  'title' => '🏛 Architecture d\'une journée consciente',            'duration' => '5 min',  'description' => 'Comprendre la logique des 3 blocs (matin, journée, soir) et pourquoi cette structure fonctionne neurologiquement.', 'content' => $intro_archi],
                ['type' => 'exercice', 'title' => '☀ Mon rituel du matin — 7 étapes chrono',             'duration' => '45 min', 'description' => 'Du lever au départ : souffle, lit, gratitude, planning, mobilité, petit-déjeuner, rangement & intention.', 'content' => $matin],
                ['type' => 'exercice', 'title' => '☉ Ma journée vivante — 3 pivots stratégiques',        'duration' => '5 min',  'description' => 'Cycles de 90 min, repas conscient + marche, recentrage de 15h : maintenir clarté et énergie.', 'content' => $journee],
                ['type' => 'exercice', 'title' => '🌙 Mon rituel du soir — 5 étapes',                    'duration' => '35 min', 'description' => 'Transition, rangement, bilan 3-3-1, étirements, coucher sans écran. Programmer le cerveau pour une nuit réparatrice.', 'content' => $soir],
                ['type' => 'exercice', 'title' => '◈ Mon profil quotidien — 4 configurations de vie',   'duration' => '10 min', 'description' => 'Adaptez le programme à votre réalité : solo, avec enfants, télétravail, ou nomade fréquent.', 'content' => $profils],
                ['type' => 'ecriture', 'title' => '🖊 Mon contrat 21 jours',                              'duration' => '10 min', 'description' => 'Choisir 3 pratiques. Signer un contrat personnel. Lancer les 21 jours d\'ancrage neuronal.', 'content' => $contrat],
                ['type' => 'pratique', 'title' => '🌬 Souffle d\'ancrage final — cohérence cardiaque 5 min', 'duration' => '5 min', 'description' => 'Fermer ce module avec 5 min de souffle. La pratique qui ancre tout le reste — chaque jour, pour toujours.', 'content' => $meditation, 'audio' => true],
            ],
            'activities_en' => [
                ['type' => 'lecture',  'title' => '🏛 Architecture of a conscious day',                   'duration' => '5 min',  'description' => 'Understand the 3-block structure (morning, day, evening) and the neuroscience behind why it works.'],
                ['type' => 'exercice', 'title' => '☀ My morning ritual — 7 timed steps',                 'duration' => '45 min', 'description' => 'From wake-up to departure: breath, bed, gratitude, planning, mobility, breakfast, tidy & intention.'],
                ['type' => 'exercice', 'title' => '☉ My living day — 3 strategic pivots',                'duration' => '5 min',  'description' => '90-min focus cycles, conscious lunch + walk, 3pm reset: stay clear and energised all day.'],
                ['type' => 'exercice', 'title' => '🌙 My evening ritual — 5 steps',                      'duration' => '35 min', 'description' => 'Decompression, light tidy, 3-3-1 review, stretches, screen-free bedtime. Programme your brain for a restorative night.'],
                ['type' => 'exercice', 'title' => '◈ My daily profile — 4 life configurations',          'duration' => '10 min', 'description' => 'Adapt the programme to your reality: solo, with children, remote work, or frequent nomad.'],
                ['type' => 'ecriture', 'title' => '🖊 My 21-day contract',                                'duration' => '10 min', 'description' => 'Choose 3 practices. Sign a personal contract. Launch 21 days of neural anchoring.'],
                ['type' => 'pratique', 'title' => '🌬 Final anchoring breath — cardiac coherence 5 min', 'duration' => '5 min',  'description' => 'Close this module with 5 min of breath. The practice that anchors everything else — every day, for good.', 'audio' => true],
            ],
        ];
    }

    // ─────────────────────────────────────────────────────────────────────────
    // MODULE 31 — L'Amour à l'ère du jetable  (PARCOURS 3 · S'Ouvrir)
    // ─────────────────────────────────────────────────────────────────────────
    private function m31_amour_jetable(): array
    {
        $gold   = 'rgba(201,168,76,.9)';
        $red    = 'rgba(239,68,68,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $teal   = 'rgba(20,184,166,.8)';
        $indigo = 'rgba(99,102,241,.85)';
        $amber  = 'rgba(245,158,11,.85)';

        /* ── INTRO ──────────────────────────────────────────────── */
        $intro = $this->card($gold, 'État des lieux', '💔 Ce que l\'époque fait à l\'amour',
            'Nous vivons une époque de paradoxe :<br><br>
            Jamais autant de possibilités de rencontres. Jamais autant de solitude.<br>
            Jamais autant accès à la sexualité. Jamais autant de personnes qui ne savent plus ce qu\'elles veulent.<br>
            Jamais autant de liberté de choisir son partenaire. Jamais autant d\'incapacité à rester.<br><br>
            Ce module ne juge pas. Il observe. Il analyse. Et il propose des ancrages concrets pour <strong>choisir consciemment</strong> — au lieu de subir les lois implicites d\'une culture du jetable qui prétend pourtant s\'appeler "liberté".'
        );

        /* ── LECTURE 1 : Le swipe comme modèle ─────────────────── */
        $lec1 = $this->card($red, 'Lecture 1 · Le supermarché émotionnel', '📱 Le swipe comme modèle de relation',
            '<strong>Les chiffres :</strong><br>
            · Tinder : 3 milliards de swipes par jour, 65 millions d\'utilisateurs actifs dans le monde.<br>
            · Durée moyenne d\'un match avant la première conversation : <strong>18 secondes</strong> de décision (étude QUT, 2016).<br>
            · Taux de personnes issues d\'applications de rencontre ayant eu une relation > 6 mois : <strong>moins de 25%</strong>.<br><br>
            <strong>Le phénomène du "paradoxe du choix" (Barry Schwartz, 2004) :</strong><br>
            Plus le choix est vaste, moins on est satisfait de ce qu\'on choisit. On compare en permanence. On pense toujours qu\'un meilleur match est à 2 swipes de là.<br><br>
            <strong>Ce que le design des apps induit :</strong><br>
            Les apps de rencontre sont conçues comme des jeux vidéo : interface gamifiée, variable reward (est-ce que j\'ai un nouveau match ?), indicateur de "popularité", points de swipe. Le cerveau est conditionné à traiter les personnes comme des items à filtrer — pas des individus à rencontrer.<br><br>
            <strong>L\'effet de déshumanisation progressive :</strong><br>
            Les études de psychologie sociale (Hobbs et al., 2017) montrent que l\'usage intensif des apps augmente l\'objectification d\'autrui, diminue l\'empathie situationnelle, et renforce un rapport consommateur à la relation amoureuse.<br><br>
            <em style="color:'.$red.';">À aucun moment dans l\'histoire humaine, la relation n\'avait été organisée autour d\'un mécanisme de rejet à la seconde. Cela a des conséquences réelles sur nos capacités d\'attachement.</em>'
        );

        /* ── LECTURE 2 : Peur de l'engagement ──────────────────── */
        $lec2 = $this->card($purple, 'Lecture 2 · Le syndrome de Peter Pan collectif', '🚀 La peur de l\'engagement',
            '<strong>Les données démographiques en France :</strong><br>
            · Âge moyen au premier mariage : <strong>35 ans pour les femmes, 37 ans pour les hommes</strong> (INSEE 2023).<br>
            · Part des 25-34 ans en union libre (sans mariage ni PACS) : +60% depuis 2000.<br>
            · 40% des millenials déclarent vouloir "garder leurs options ouvertes" avant de s\'engager durablement (IFOP, 2022).<br><br>
            <strong>Ce que les chercheurs appellent le FOMO relationnel :</strong><br>
            Fear Of Missing Out appliqué aux relations : l\'impression qu\'en s\'engageant avec quelqu\'un, on "perd" toutes les autres possibilités. Le partenaire choisi est toujours comparé à un hypothétique partenaire idéal qui reste dans le possible.<br><br>
            <strong>Le perfectionnisme du partenaire :</strong><br>
            Les études de Barry Schwartz sur les "maximisers" vs "satisficers" montrent que les individus qui cherchent systématiquement le meilleur choix possible sont significativement <em>moins heureux</em> dans leurs relations que ceux qui acceptent un choix "assez bon et réel".<br><br>
            <strong>Peter Pan syndrome (Dan Kiley, 1983) — actualisé :</strong><br>
            Ce que Kiley avait identifié chez certains hommes concerne maintenant, selon les cliniciens, des adultes des deux sexes : refus de grandir, évitement des responsabilités durables, priorité permanente donnée à ses propres désirs. L\'accélération culturelle et la montée de l\'individualisme ont généralisé ce profil.<br><br>
            <em style="color:'.$purple.';">L\'engagement n\'est pas une prison. C\'est l\'acte le plus courageux et le plus libre qu\'un être humain puisse poser : choisir quelqu\'un en sachant que tout le reste existe — et choisir quand même.</em>'
        );

        /* ── LECTURE 3 : Parentalité tardive ───────────────────── */
        $lec3 = $this->card($amber, 'Lecture 3 · L\'horloge oubliée', '⏳ Parentalité tardive — données et réalités',
            '<strong>Les chiffres en France (INSEE 2023) :</strong><br>
            · Âge moyen à la naissance du premier enfant : <strong>30,9 ans</strong> (2023) contre 26,5 ans en 1980.<br>
            · Taux de fécondité : <strong>1,68 enfant par femme</strong> (2023), le plus bas jamais enregistré en France.<br>
            · 23% des grossesses se terminent par une FIV ou procréation médicalement assistée — chiffre en hausse de 40% en 10 ans.<br><br>
            <strong>Biologie et fertilité féminine :</strong><br>
            · À 30 ans : 20% de chance de concevoir par cycle.<br>
            · À 35 ans : 15% de chance par cycle. Risque de fausse couche multiplié par 2.<br>
            · À 40 ans : 5% de chance par cycle. Risque chromosomique significativement augmenté.<br>
            · Ces données ne sont pas des jugements — ce sont des faits biologiques que les études sur la fertilité documentent depuis des décennies (ESHRE Guidelines, 2022).<br><br>
            <strong>L\'impact culturel de la désinformation :</strong><br>
            Des études montrent que les jeunes femmes de 18-30 ans surestiment significativement leur fertilité après 35 ans, en partie parce que la culture populaire valorise des maternités tardives de personnalités publiques, souvent obtenues par FIV non divulguée (Benzies et al., 2006).<br><br>
            <strong>Pour les hommes :</strong><br>
            La fertilité masculine décline aussi avec l\'âge (fragmentation ADN spermatique +20% après 45 ans), mais plus progressivement. Des études récentes (Stanford Medicine, 2023) montrent une augmentation des risques de complications néonatales (autisme, schizophrénie) avec l\'âge paternel avancé.<br><br>
            <em style="color:'.$amber.';">S\'informer honnêtement sur la biologie n\'est pas une pression — c\'est se donner le choix libre et éclairé que personne d\'autre ne vous offrira à la place.</em>'
        );

        /* ── LECTURE 4 : Recomposition familiale ───────────────── */
        $lec4 = $this->card($teal, 'Lecture 4 · La structure familiale en mutation', '🏛 Solitudes, monoparentalité & recomposition',
            '<strong>État des familles en France (INSEE 2023) :</strong><br>
            · <strong>25,8%</strong> des familles avec enfants sont monoparentales — en hausse de 60% depuis 1990.<br>
            · 85% des familles monoparentales sont des mères seules. Taux de pauvreté : 39% contre 12% dans les familles biparentales.<br>
            · 1 mariage sur 2 se termine par un divorce. 60% des divorces sont demandés par la femme (INSEE).<br>
            · Age moyen au divorce : 45 ans. Nombre moyen d\'enfants concernés : 1,3 par divorce.<br><br>
            <strong>Conséquences documentées sur les enfants :</strong><br>
            Les méta-analyses (Amato, 2006 ; McLanahan, 2013) montrent que les enfants de familles monoparentales présentent statistiquement des risques plus élevés de : difficultés scolaires, troubles comportementaux, pauvreté à l\'âge adulte, et instabilité relationnelle. Ces données ne sont pas des accusations — elles documentent un enjeu de politique publique majeur qui mobilise des milliards d\'euros en aide sociale.<br><br>
            <strong>Ce n\'est pas une question de morale — c\'est une question de coût humain :</strong><br>
            L\'explosion de la solitude : 40% des adultes en France déclarent se sentir "souvent" ou "toujours" seuls (Fondation de France, 2023). La solitude chronique présente des risques de santé équivalents à fumer 15 cigarettes par jour (Holt-Lunstad, 2015).<br><br>
            <strong>La reconstruction est toujours possible :</strong><br>
            Cette réalité n\'est pas une fatalité. Des dizaines d\'études montrent qu\'une relation stable construite consciemment — même tardive, même reconstruite après une rupture — est l\'un des plus puissants prédicteurs de santé physique, mentale et de longévité (Harvard Study of Adult Development, 85 ans de suivi).<br><br>
            <em style="color:'.$teal.';">La question n\'est pas "pourquoi les autres font-ils des erreurs ?" mais "quels choix je veux poser, lucidement, pour ma vie ?"</em>'
        );

        /* ── EXERCICE 1 : Schémas de fuite ─────────────────────── */
        $ex1 = $this->exercice($red, '①', 'Mes schémas de fuite relationnelle',
            '<strong>Instruction :</strong> Répondez honnêtement — ces questions ne sont pas des diagnostics, elles sont des miroirs.<br><br>
            <strong>A. La fuite par l\'évitement :</strong><br>
            → Ai-je tendance à rester dans des relations courtes pour éviter d\'aller profond ?<br>
            → Quand quelqu\'un se rapproche vraiment, est-ce que je crée une distance (critique, détachement, suroccupation) ?<br>
            → Sur quelle peur précise cette fuite repose-t-elle ? (peur d\'être abandonné(e) ? de perdre ma liberté ? d\'être déçu(e) ?)<br><br>
            <strong>B. La fuite par l\'idéalisation :</strong><br>
            → Est-ce que je compare régulièrement mon partenaire réel à un partenaire imaginaire "parfait" ?<br>
            → Est-ce que je quitte ou me désintéresse dès que la phase de séduction intense se termine ?<br>
            → Combien de temps durent mes relations intimes avant que je commence à lister leurs "défauts" ?<br><br>
            <strong>C. La fuite par la suroccupation :</strong><br>
            → Est-ce que je me réfugie dans le travail, les voyages ou les projets pour éviter l\'intimité quotidienne ?<br>
            → Est-ce que j\'utilise l\'indépendance comme valeur pour justifier de ne m\'engager avec personne pleinement ?<br><br>
            <strong>Après l\'inventaire :</strong><br>
            Identifiez le schéma principal (A, B ou C). Nommez la peur sous-jacente en une phrase. Ce n\'est pas votre faiblesse — c\'est votre point d\'ancrage pour changer.',
            false
        );

        /* ── EXERCICE 2 : Lettre à l'engagement ────────────────── */
        $ex2 = $this->exercice($purple, '②', 'La lettre à l\'engagement',
            '<strong>Instruction :</strong> Écrivez une lettre adressée directement à <em>l\'engagement</em> — comme à un personnage.<br><br>
            <strong>Débutez ainsi :</strong><br>
            <em>"Cher Engagement,<br>
            Voilà ce que tu m\'as toujours fait ressentir…<br>
            Voilà pourquoi je t\'ai évité…<br>
            Voilà ce que j\'aimerais pouvoir te dire aujourd\'hui…<br>
            Voilà la peur que tu réveilles en moi…<br>
            Et voilà ce que je choisis de faire maintenant…"</em><br><br>
            <strong>Durée recommandée :</strong> 20 min sans relire, écriture libre, flux de conscience. Pas de correction. Pas de censure.<br><br>
            <em>Cette lettre n\'est pas pour être lue par quelqu\'un d\'autre. Elle est pour vous. Pour mettre des mots sur ce que vous n\'avez peut-être jamais osé formuler.</em>',
            false
        );

        /* ── ECRITURE ───────────────────────────────────────────── */
        $ecrit = $this->card($indigo, 'Écriture', '✍️ Quel partenaire / quel parent je veux être',
            '<strong>Deux questions distinctes — deux pages séparées :</strong><br><br>
            <strong>① En tant que partenaire de vie :</strong><br>
            "La personne que je veux être dans une relation — pas la relation idéale, mais <em>moi</em>, à mon meilleur dans la relation — ressemble à…"<br>
            Décrivez en comportements concrets : comment vous gérez les conflits, comment vous montrez l\'amour, comment vous grandissez ensemble, comment vous protégez le lien dans la durée.<br><br>
            <strong>② En tant que parent — ou figure parentale potentielle :</strong><br>
            "Le parent que je veux être, ou que j\'aurais voulu avoir, se distingue par…"<br>
            Décrivez les valeurs que vous transmettriez, la façon dont vous seriez présent(e), ce que vos enfants diraient de vous dans 20 ans.<br><br>
            <em>Cette vision n\'est pas une pression — c\'est une boussole. Elle vous guide vers les choix alignés avec ce que vous voulez vraiment bâtir.</em>'
        );

        /* ── MÉDITATION ─────────────────────────────────────────── */
        $meditation = $this->card($gold, 'Méditation guidée', '🌬 Pause Souffle — Souffle d\'engagement (8 min)',
            '<strong>Installez-vous confortablement. Asseyez-vous, dos droit, yeux fermés.</strong><br><br>
            <strong>PHASE 1 — Cohérence cardiaque (3 min)</strong><br>
            Inspirez lentement par le nez : <strong>5 secondes</strong>. Ventre, puis poitrine.<br>
            Expirez par la bouche, lèvres légèrement entrouvertes : <strong>5 secondes</strong>. La tension quitte le corps.<br>
            6 cycles. À chaque expiration, laissez partir une pensée, une résistance, un "mais…"<br><br>
            <strong>PHASE 2 — Visualisation de l\'engagement (3 min)</strong><br>
            Laissez venir l\'image d\'un moment dans votre vie où vous avez <em>vraiment</em> été là pour quelqu\'un.<br>
            Entièrement présent(e). Sans réserve. Sans exit mental.<br><br>
            Sentez ce que cela fait dans le corps : la chaleur dans la poitrine, l\'ouverture des épaules, la solidité des pieds dans le sol.<br><br>
            Maintenant posez cette question intérieure :<br>
            <em>"Qu\'est-ce qui se dénoue en moi quand je choisis vraiment d\'être là ?"</em><br><br>
            Laissez monter la réponse — pas en mots, en sensations.<br><br>
            <strong>PHASE 3 — Ancrage intentionnel (2 min)</strong><br>
            Respirez profondément. En tenant cet espace ouvert dans la poitrine, formulez en silence :<br>
            <em>"Je choisis d\'être quelqu\'un qui reste. Qui s\'engage. Qui construit. Pas parfaitement — réellement."</em><br><br>
            Trois respirations finales, de plus en plus lentes.<br>
            Ouvrez doucement les yeux.<br>
            <em>⏱ 8 min · Revenez à cette méditation avant chaque décision relationnelle importante.</em>'
        );

        return [
            'description' => 'La culture du swipe, la peur de l\'engagement, la parentalité tardive, l\'explosion des familles monoparentales : comprendre les forces qui façonnent nos choix relationnels — pour les traverser lucidement, pas les subir.',
            'intro_text'  => "MODULE 31 — L'Amour à l'ère du jetable\n\nNous vivons une époque de paradoxe : jamais autant de possibilités de rencontres, jamais autant de solitude. Jamais autant d'accès à la sexualité, jamais autant de personnes qui ne savent plus ce qu'elles veulent.\n\nCe module ne juge pas. Il observe, il analyse, et il propose des ancrages concrets pour choisir consciemment — plutôt que de subir les lois implicites d'une culture du jetable.",
            'audio_path'  => null,
            'activities'  => [
                ['type' => 'lecture',  'title' => '💔 Ce que l\'époque fait à l\'amour — état des lieux',          'duration' => '5 min',  'description' => 'Paradoxe : jamais autant de choix, jamais autant de solitude. Poser honnêtement le constat.', 'content' => $intro],
                ['type' => 'lecture',  'title' => '📱 Le swipe comme modèle de relation',                           'duration' => '10 min', 'description' => '3 milliards de swipes/jour, paradoxe du choix, déshumanisation progressive. Ce que les apps font à notre capacité d\'attachement.', 'content' => $lec1],
                ['type' => 'lecture',  'title' => '🚀 La peur de l\'engagement — le syndrome Peter Pan collectif',  'duration' => '10 min', 'description' => 'FOMO relationnel, perfectionnisme du partenaire, âge du mariage à 37 ans. Pourquoi une génération refuse de choisir.', 'content' => $lec2],
                ['type' => 'lecture',  'title' => '⏳ Parentalité tardive — données et réalités biologiques',       'duration' => '10 min', 'description' => 'Âge moyen au 1er enfant : 30,9 ans. Fertilité, biologie, FIV. Les chiffres que personne ne vous dit vraiment.', 'content' => $lec3],
                ['type' => 'lecture',  'title' => '🏛 La structure familiale en mutation — monoparentalité & solitude', 'duration' => '10 min', 'description' => '25,8% des familles monoparentales, 1 mariage sur 2 + divorce, solitude épidémique. Coûts humains et chemins de reconstruction.', 'content' => $lec4],
                ['type' => 'exercice', 'title' => '🔍 Mes schémas de fuite relationnelle',                          'duration' => '20 min', 'description' => 'Explorer honnêtement les patterns d\'évitement, d\'idéalisation et de suroccupation dans vos relations.', 'content' => $ex1],
                ['type' => 'exercice', 'title' => '✉️ La lettre à l\'engagement',                                  'duration' => '20 min', 'description' => 'Écrire directement à l\'engagement comme à un personnage. Nommer la peur, formuler un choix.', 'content' => $ex2],
                ['type' => 'ecriture', 'title' => '✍️ Quel partenaire / quel parent je veux être',                 'duration' => '15 min', 'description' => 'Définir en comportements concrets l\'identité relationnelle que vous choisissez d\'incarner.', 'content' => $ecrit],
                ['type' => 'pratique', 'title' => '🌬 Méditation — Souffle d\'engagement (8 min)',                 'duration' => '8 min',  'description' => 'Cohérence cardiaque + visualisation d\'un engagement plein. Ancrer dans le corps ce que signifie vraiment choisir.', 'content' => $meditation],
            ],
            'activities_en' => [
                ['type' => 'lecture',  'title' => '💔 What the age is doing to love — a clear view',               'duration' => '5 min',  'description' => 'Paradox: more choice than ever, more loneliness than ever. An honest assessment.'],
                ['type' => 'lecture',  'title' => '📱 The swipe as relationship model',                            'duration' => '10 min', 'description' => '3 billion swipes/day, paradox of choice, progressive dehumanisation. What apps do to our capacity for attachment.'],
                ['type' => 'lecture',  'title' => '🚀 The fear of commitment — the collective Peter Pan syndrome', 'duration' => '10 min', 'description' => 'Relational FOMO, perfect partner syndrome, average marriage age at 37. Why a generation refuses to choose.'],
                ['type' => 'lecture',  'title' => '⏳ Late parenthood — biological data and realities',            'duration' => '10 min', 'description' => 'Average age at first child: 30.9. Fertility, biology, IVF. The numbers nobody really tells you.'],
                ['type' => 'lecture',  'title' => '🏛 Family structures in mutation — single-parenthood & solitude', 'duration' => '10 min', 'description' => '25.8% single-parent families, 1 in 2 marriages ending in divorce, solitude epidemic. Human costs and paths to rebuilding.'],
                ['type' => 'exercice', 'title' => '🔍 My relational avoidance patterns',                          'duration' => '20 min', 'description' => 'Explore honestly the avoidance, idealisation and over-occupation patterns in your relationships.'],
                ['type' => 'exercice', 'title' => '✉️ The letter to commitment',                                   'duration' => '20 min', 'description' => 'Write directly to commitment as a character. Name the fear, formulate a choice.'],
                ['type' => 'ecriture', 'title' => '✍️ What kind of partner / parent I want to be',                'duration' => '15 min', 'description' => 'Define in concrete behaviours the relational identity you choose to embody.'],
                ['type' => 'pratique', 'title' => '🌬 Meditation — Breath of commitment (8 min)',                  'duration' => '8 min',  'description' => 'Cardiac coherence + visualisation of full commitment. Anchor in the body what it truly means to choose.'],
            ],
        ];
    }

    // ─────────────────────────────────────────────────────────────────────────
    // MODULE 32 — Le Piège des Écrans  (PARCOURS 3 · S'Ouvrir)
    // ─────────────────────────────────────────────────────────────────────────
    private function m32_pieges_ecrans(): array
    {
        $indigo = 'rgba(99,102,241,.85)';
        $teal   = 'rgba(20,184,166,.8)';
        $orange = 'rgba(249,115,22,.8)';
        $gold   = 'rgba(201,168,76,.9)';
        $red    = 'rgba(239,68,68,.8)';
        $purple = 'rgba(168,85,247,.8)';

        /* ── INTRO ──────────────────────────────────────────────── */
        $intro = $this->card($indigo, 'Le constat', '📱 Vous n\'êtes pas le client — vous êtes le produit',
            'En 2017, Sean Parker — cofondateur de Facebook — a déclaré publiquement :<br>
            <em>"Nous vous avions sciemment créé une dépendance. La question que nous nous posions en réunion était : comment voler le plus de temps possible dans votre journée ? Comment vous faire revenir encore et encore ?"</em><br><br>
            Ce n\'est pas une théorie du complot. C\'est l\'aveu documenté d\'un des architectes du web social.<br><br>
            Ce module ne vous dira pas "éteignez vos écrans". Il vous donnera les outils pour <strong>comprendre exactement ce qui se passe dans votre cerveau</strong> quand vous scrollez — et reprendre consciemment le contrôle de votre attention, votre bien le plus précieux et le plus menacé.'
        );

        /* ── LECTURE 1 : L'économie de l'attention ──────────────── */
        $lec1 = $this->card($indigo, 'Lecture 1 · Le vol organisé de votre attention', '🎯 L\'économie de l\'attention',
            '<strong>Les chiffres :</strong><br>
            · Adulte moyen en 2024 : <strong>6h47 par jour</strong> passées sur des écrans (We Are Social / Hootsuite).<br>
            · Ados 13-18 ans : <strong>9h par jour</strong> en moyenne (Common Sense Media, 2023).<br>
            · Nombre moyen de consultations du smartphone par jour : <strong>2 617 fois</strong> (Dscout Research, 2016 — la réalité 2024 est probablement supérieure).<br>
            · Durée d\'attention soutenue moyenne en 2024 : <strong>47 secondes</strong> avant interruption (Gloria Mark, UC Irvine, 2023).<br>
            · En 2004, cette durée était de 2 min 30.<br><br>
            <strong>Le modèle économique :</strong><br>
            Les plateformes numériques ne vendent pas de contenu — elles vendent de <em>l\'attention humaine</em> aux annonceurs. Chaque seconde que vous passez sur leur plateforme est monnayée. Votre attention est une ressource naturelle extraite, traitée et revendue à des tiers.<br><br>
            <strong>Tim Wu, The Attention Merchants (2016) :</strong><br>
            "Le libre-échange du XXIe siècle, c\'est la commercialisation de l\'attention humaine. Et contrairement au pétrole, cette ressource saignée est remplacée par votre temps de vie — une ressource non renouvelable."<br><br>
            <em style="color:'.$indigo.';">6h47 par jour × 365 jours × 40 ans actifs = <strong>98 800 heures</strong> soit 11 ans de vie complète. Ce chiffre s\'appelle un choix — ou une dépossession.</em>'
        );

        /* ── LECTURE 2 : Le hijack dopaminergique ───────────────── */
        $lec2 = $this->card($orange, 'Lecture 2 · Le cerveau pris en otage', '🎰 Le hijack dopaminergique',
            '<strong>Le mécanisme du variable reward (récompense variable) :</strong><br>
            B.F. Skinner a découvert en 1950 que les rats pressaient un levier <em>beaucoup plus compulsivement</em> quand la récompense était aléatoire (parfois granule, parfois rien) que quand elle était systématique.<br>
            Les machines à sous utilisent ce principe. Et depuis 2010, toutes les grandes plateformes sociales le répliquent délibérément.<br><br>
            <strong>Ce qui se passe dans votre cerveau quand vous scrollez :</strong><br>
            1. Vous scrollez → parfois quelque chose d\'intéressant → pic de dopamine.<br>
            2. Vous scrollez → rien → le cerveau s\'impatiente et cherche plus fort.<br>
            3. L\'incertitude de la récompense est <strong>précisément ce qui crée la compulsion</strong>.<br>
            4. Le "pull-to-refresh" (tirer vers le bas pour actualiser) est un mécanisme de levier copié sur les machines à sous — conçu pour activer ce circuit.<br><br>
            <strong>L\'aveu de Aza Raskin, inventeur du scroll infini :</strong><br>
            "Si je devais évaluer le coût humain de ce que j\'ai créé, ce serait environ <em>200 000 heures</em> collectivement volées à l\'humanité par jour. Je regrette."<br><br>
            <strong>Similitudes avec les addictions comportementales :</strong><br>
            · Neuroimagerie : les patterns cérébraux du scroll compulsif ressemblent à ceux du jeu pathologique (fMRI, 2022).<br>
            · Sevrage : irritabilité, anxiété, difficulté à rester seul lorsqu\'on enlève le téléphone 24h.<br>
            · Tolérance : besoin de doses plus fortes (contenu plus extrême) pour le même effet.<br><br>
            <em style="color:'.$orange.';">Ce n\'est pas une faiblesse de caractère. C\'est une ingénierie neurologique intentionnelle appliquée à des milliards d\'humains simultanément.</em>'
        );

        /* ── LECTURE 3 : Ce que les écrans volent ───────────────── */
        $lec3 = $this->card($red, 'Lecture 3 · Le vrai coût personnel', '👁 Ce que les écrans nous volent',
            '<strong>1. La présence :</strong><br>
            · Dans les couples : 37% déclarent que leur partenaire est "souvent ou toujours" sur son téléphone pendant les repas (Pew Research, 2020).<br>
            · Les enfants dont les parents consultent fréquemment leur téléphone devant eux montrent davantage de comportements anxieux (Brandon McDaniel, 2019 — "phubbing parental").<br>
            · Effet "téléphone posé sur la table" : même <em>inactif</em>, la présence d\'un téléphone visible réduit la qualité de la conversation et la profondeur du lien créé (Ward et al., University of Texas, 2017).<br><br>
            <strong>2. Le sommeil :</strong><br>
            · La lumière bleue des écrans supprime la mélatonine jusqu\'à 3 heures après l\'exposition.<br>
            · 67% des Français consultent leur téléphone dans l\'heure précédant le coucher.<br>
            · Chaque heure d\'écran supplémentaire le soir = retard d\'endormissement de 24 min en moyenne (Sleep Foundation, 2023).<br><br>
            <strong>3. La capacité de concentration :</strong><br>
            · "L\'attention soutenue" — la capacité de rester focalisé sans chercher de stimulation — est documentairement en déclin depuis 2010. Coïncidence avec la démocratisation du smartphone.<br>
            · Les étudiants qui abandonnent leur téléphone 2 heures améliorent leurs scores de mémorisation de 26% (Sapien Labs, 2022).<br><br>
            <strong>4. La santé mentale — données récentes :</strong><br>
            · Jonathan Haidt (<em>The Anxious Generation</em>, 2024) : depuis 2012, les taux de dépression et d\'anxiété chez les 14-24 ans ont augmenté de 50-100% en corrélation directe avec la généralisation du smartphone.<br>
            · Chez les filles adolescentes, l\'utilisation de 3h+ de réseaux sociaux par jour est corrélée à un risque 3× supérieur de dépression sévère.<br><br>
            <em style="color:'.$red.';">Ce qui disparaît quand on regarde son écran, c\'est toujours quelque chose de réel, de présent et d\'irremplaçable.</em>'
        );

        /* ── LECTURE 4 : Les enfants dans la machine ─────────────── */
        $lec4 = $this->card($teal, 'Lecture 4 · Les enfants dans la machine', '👶 Développement, attention & éducation consciente',
            '<strong>Le développement attentionnel de l\'enfant :</strong><br>
            · De 0 à 3 ans, le cerveau est en période critique de développement des réseaux d\'attention. Les écrans passifs (TV, vidéos) à cet âge sont associés à des délais de langage et à des difficultés attentionnelles ultérieures (pediatrics.org, 2019).<br>
            · L\'OMS recommande : aucun écran avant 2 ans, 1h maximum de 2 à 5 ans, avec accompagnement parental systématique.<br><br>
            <strong>L\'érosion de l\'empathie :</strong><br>
            · Une étude de 5 jours en camp sans écrans (Michigan University, 2014) montre que des enfants de 11-12 ans améliorent significativement leur capacité à lire les émotions faciales — comparés au groupe contrôle resté avec leurs écrans.<br>
            · L\'empathie s\'apprend dans les interactions en face à face, dans l\'ennui, dans les conflits résolus réellement.<br><br>
            <strong>Ce que Steve Jobs n\'a pas dit, mais a fait :</strong><br>
            Dans une interview du New York Times (2011), Steve Jobs confirme qu\'il limitait strictement les iPad et produits Apple pour ses propres enfants à la maison :<br>
            <em>"Nous limitons l\'utilisation de la technologie à la maison."</em><br>
            De nombreux ingénieurs et cadres de la Silicon Valley scolarisent leurs enfants dans des écoles Waldorf — sans écrans — et limitent strictement l\'accès aux outils numériques hors école.<br><br>
            <strong>Des villes et pays agissent :</strong><br>
            · France (2023) : interdiction des smartphones à l\'école primaire et collège.<br>
            · Australie (2024) : interdiction légale des réseaux sociaux avant 16 ans.<br>
            · Suède (2023) : recommandations officielles de réduction drastique des écrans pour les mineurs.<br><br>
            <em style="color:'.$teal.';">Ce n\'est pas de la technophobie — c\'est de la responsabilité parentale et sociétale fondée sur des données.</em>'
        );

        /* ── EXERCICE 1 : Audit 7 jours ─────────────────────────── */
        $ex1 = $this->exercice($indigo, '①', 'Audit de présence numérique — 7 jours',
            '<strong>Instruction :</strong> Pendant 7 jours consécutifs, tenez un journal de présence numérique. Le but n\'est pas de culpabiliser — c\'est de <em>voir clairement</em>.<br><br>
            <strong>Chaque soir, notez :</strong><br>
            → Temps d\'écran total du jour (consultez les paramètres de votre téléphone).<br>
            → L\'application la plus consultée et la durée.<br>
            → Combien de fois avez-vous consulté votre téléphone par pur réflexe (sans intention) ?<br>
            → Quel moment de la journée était le plus "volé" par l\'écran ?<br>
            → Qu\'avez-vous remplacé / raté à cause de cette consultation (conversation, sommeil, travail, présence) ?<br><br>
            <strong>À J7, posez-vous ces questions :</strong><br>
            → Est-ce que je contrôle mes écrans ou sont-ce mes écrans qui me contrôlent ?<br>
            → Si je récupérais 2h/jour sur ce temps d\'écran, qu\'est-ce que je choisirais d\'en faire ?<br>
            → Quelles émotions le téléphone "traite" pour moi (ennui, anxiété, solitude) sans vraiment les résoudre ?<br><br>
            <em>La conscience précède le changement. Toujours.</em>',
            false
        );

        /* ── EXERCICE 2 : Protocole JOMO ─────────────────────────── */
        $ex2 = $this->exercice($teal, '②', 'Le protocole JOMO — créer des zones de présence réelle',
            '<strong>JOMO : Joy Of Missing Out</strong> — l\'inverse du FOMO.<br>
            La joie active de <em>rater</em> ce qui se passe sur les réseaux pour <em>être là</em> dans sa propre vie.<br><br>
            <strong>3 étapes concrètes à mettre en place cette semaine :</strong><br><br>
            <strong>① La zone sans téléphone :</strong><br>
            Choisissez 1 espace physique chez vous où le téléphone n\'entre plus : la chambre, la table à manger, ou les 30 min suivant le réveil. Inscrivez-le sous forme de règle, pas d\'intention floue.<br><br>
            <strong>② Le bloc de présence :</strong><br>
            Choisissez 1 moment par jour (30-60 min) sans aucun écran. Marche, repas, conversation, lecture physique. Pas de podcast. Pas d\'écouteurs. La présence nue.<br><br>
            <strong>③ Le rituel du "dernier écran" :</strong><br>
            Définissez une heure fixe chaque soir après laquelle aucun écran n\'est allumé. Commencez par 21h. Tenez-y 7 jours. Observez la qualité de votre sommeil.<br><br>
            <strong>Pour les parents :</strong><br>
            → Repas en famille : téléphones hors de la table, retournés ou dans une autre pièce.<br>
            → 1h d\'activité hebdomadaire sans écran avec les enfants : jeu de société, cuisine, promenade.<br>
            → Règle "chambre sans téléphone" pour les enfants dès le collège.<br><br>
            <em>JOMO n\'est pas un sacrifice. C\'est le retour au temps réel — le seul temps où la vie se passe vraiment.</em>',
            false
        );

        /* ── ECRITURE ───────────────────────────────────────────── */
        $ecrit = $this->card($orange, 'Écriture', '✍️ Ce que je veux retrouver quand j\'éteins l\'écran',
            '<strong>Instruction :</strong> Prenez 15 minutes, carnet et stylo (pas d\'écran pour cet exercice).<br><br>
            Complétez ces phrases librement, sans censure :<br><br>
            "Quand j\'éteins mon écran et que le silence arrive, ce que j\'ai peur de ressentir c\'est…"<br>
            "Ce que j\'aimerais avoir comme vie si je récupérais 2 heures par jour, c\'est…"<br>
            "La dernière fois que j\'ai été complètement présent(e) sans écran, c\'était…"<br>
            "Ce que mes enfants / mes proches méritent de moi, c\'est…"<br>
            "La qualité d\'attention que je veux avoir pour ma propre vie, ça ressemble à…"<br><br>
            <em>Ces phrases sont votre boussole. Ce n\'est pas ce que la culture vous impose de désirer — c\'est ce que vous, vraiment, voulez vivre.</em>'
        );

        /* ── MÉDITATION ─────────────────────────────────────────── */
        $meditation = $this->card($gold, 'Méditation guidée', '🌬 Pause Souffle — Retour à la présence (6 min)',
            '<strong>Posez votre téléphone. Fermez l\'ordinateur. Asseyez-vous, dos droit.</strong><br>
            Pour les 6 minutes qui suivent, votre seul objet d\'attention est votre souffle.<br><br>
            <strong>PHASE 1 — Déprogrammation (2 min)</strong><br>
            Inspirez par le nez : <strong>4 secondes</strong>.<br>
            Retenez : <strong>4 secondes</strong>.<br>
            Expirez lentement : <strong>6 secondes</strong>.<br><br>
            À chaque expiration, imaginez que vous relâchez une notification. Une alerte. Un ping. Un scroll jamais terminé.<br>
            Ils partent avec le souffle. Ils ne reviendront pas dans les 6 prochaines minutes.<br><br>
            4 cycles.<br><br>
            <strong>PHASE 2 — Présence à soi (3 min)</strong><br>
            Laissez le souffle redevenir naturel, sans contrôle.<br>
            Portez l\'attention sur les sons réels autour de vous — sans les nommer, juste les entendre.<br>
            Puis sur les sensations du corps : le contact des pieds avec le sol, la chaleur des paumes, le poids des épaules.<br><br>
            Vous êtes là. Entièrement là. Pas en train de consulter. Pas en train de scroller.<br>
            <em>Ce moment existe — et il ne peut pas être capturé en screenshot.</em><br><br>
            <strong>PHASE 3 — Intention (1 min)</strong><br>
            Formulez en silence :<br>
            <em>"Mon attention est précieuse. Je choisis à qui et à quoi je la donne."</em><br><br>
            Trois respirations profondes. Ouvrez les yeux.<br>
            <em>⏱ 6 min · Revenez à cette pratique chaque fois que vous sentez l\'écran prendre le contrôle.</em>'
        );

        return [
            'description' => 'L\'économie de l\'attention, le hijack dopaminergique, 6h47/jour d\'écran. Ce module décrypte exactement ce qui se passe dans votre cerveau — et vous donne des protocoles concrets pour reprendre le contrôle de votre bien le plus précieux : votre présence.',
            'intro_text'  => "MODULE 32 — Le Piège des Écrans\n\nSean Parker, cofondateur de Facebook, a avoué en 2017 : \"Nous vous avions sciemment créé une dépendance. La question que nous nous posions était : comment voler le plus de temps dans votre journée ?\"\n\nCe module ne vous dit pas d'éteindre vos écrans. Il vous donne les outils pour comprendre exactement ce qui se passe dans votre cerveau quand vous scrollez — et reprendre consciemment le contrôle de votre attention.",
            'audio_path'  => null,
            'activities'  => [
                ['type' => 'lecture',  'title' => '📱 Vous n\'êtes pas le client — vous êtes le produit',      'duration' => '5 min',  'description' => 'L\'aveu de Sean Parker, le modèle économique de l\'attention. Ce que les plateformes font de votre vie.', 'content' => $intro],
                ['type' => 'lecture',  'title' => '🎯 L\'économie de l\'attention — 6h47 par jour',            'duration' => '10 min', 'description' => '2 617 consultations/jour, 47 secondes d\'attention soutenue, 11 ans de vie sacrifiés. Les vrais chiffres.', 'content' => $lec1],
                ['type' => 'lecture',  'title' => '🎰 Le hijack dopaminergique — votre cerveau et les machines à sous', 'duration' => '10 min', 'description' => 'Variable reward, Skinner, scroll infini. Comment le design des apps crée une compulsion neurologique.', 'content' => $lec2],
                ['type' => 'lecture',  'title' => '👁 Ce que les écrans nous volent — présence, sommeil, concentration', 'duration' => '10 min', 'description' => 'Phubbing, lumière bleue, déclin attentionnel documenté, santé mentale des ados. Le coût réel en chiffres.', 'content' => $lec3],
                ['type' => 'lecture',  'title' => '👶 Les enfants dans la machine — développement & éducation consciente', 'duration' => '10 min', 'description' => 'Cerveau de l\'enfant, empathie, écoles Waldorf de la Silicon Valley, législations en cours. Agir maintenant.', 'content' => $lec4],
                ['type' => 'exercice', 'title' => '📊 Audit de présence numérique — 7 jours',                  'duration' => '7 jours', 'description' => 'Journal quotidien du temps d\'écran : voir clairement pour choisir librement.', 'content' => $ex1],
                ['type' => 'exercice', 'title' => '🌿 Protocole JOMO — zones de présence réelle',              'duration' => '20 min', 'description' => 'Zone sans téléphone, bloc de présence quotidien, rituel du dernier écran. Reprendre le contrôle cette semaine.', 'content' => $ex2],
                ['type' => 'ecriture', 'title' => '✍️ Ce que je veux retrouver quand j\'éteins l\'écran',     'duration' => '15 min', 'description' => 'Écriture libre sur ce que l\'attention recouvrée permettrait de vivre vraiment.', 'content' => $ecrit],
                ['type' => 'pratique', 'title' => '🌬 Méditation — Retour à la présence (6 min)',              'duration' => '6 min',  'description' => 'Déprogrammation respiratoire + ancrage sensoriel. Vivre 6 minutes hors de l\'écran — entièrement.', 'content' => $meditation],
            ],
            'activities_en' => [
                ['type' => 'lecture',  'title' => '📱 You are not the customer — you are the product',          'duration' => '5 min',  'description' => 'Sean Parker\'s confession, the attention economy. What platforms do with your life.'],
                ['type' => 'lecture',  'title' => '🎯 The attention economy — 6h47 per day',                   'duration' => '10 min', 'description' => '2,617 phone checks/day, 47-second attention span, 11 years of life spent. The real numbers.'],
                ['type' => 'lecture',  'title' => '🎰 The dopamine hijack — your brain and the slot machine',  'duration' => '10 min', 'description' => 'Variable reward, Skinner, infinite scroll. How app design creates neurological compulsion.'],
                ['type' => 'lecture',  'title' => '👁 What screens steal — presence, sleep, focus',            'duration' => '10 min', 'description' => 'Phubbing, blue light, documented attention decline, teen mental health. The real cost in numbers.'],
                ['type' => 'lecture',  'title' => '👶 Children in the machine — development & conscious parenting', 'duration' => '10 min', 'description' => 'Child brain development, empathy, Silicon Valley Waldorf schools, current legislation. Act now.'],
                ['type' => 'exercice', 'title' => '📊 Digital presence audit — 7 days',                        'duration' => '7 days', 'description' => 'Daily screen time journal: see clearly to choose freely.'],
                ['type' => 'exercice', 'title' => '🌿 JOMO Protocol — zones of real presence',                 'duration' => '20 min', 'description' => 'Phone-free zone, daily presence block, last screen ritual. Regain control this week.'],
                ['type' => 'ecriture', 'title' => '✍️ What I want to reclaim when I turn off the screen',     'duration' => '15 min', 'description' => 'Free writing on what reclaimed attention would allow you to actually live.'],
                ['type' => 'pratique', 'title' => '🌬 Meditation — Return to presence (6 min)',                'duration' => '6 min',  'description' => 'Respiratory deprogramming + sensory anchoring. 6 minutes completely off-screen — fully present.'],
            ],
        ];
    }

    // ─────────────────────────────────────────────────────────────────────────
    // MODULE 33 — L'Enfant abandonné  (PARCOURS 3 · S'Ouvrir)
    // VERSION 3 — Remonter à l'origine de la maladie
    // ─────────────────────────────────────────────────────────────────────────
    private function m33_education_sacrifiee(): array
    {
        $gold   = 'rgba(201,168,76,.9)';
        $red    = 'rgba(239,68,68,.8)';
        $orange = 'rgba(249,115,22,.8)';
        $teal   = 'rgba(20,184,166,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $indigo = 'rgba(99,102,241,.85)';
        $green  = 'rgba(34,197,94,.8)';

        /* ── PAMPHLET — La généalogie de la rupture ───────────────── */
        $pamphlet = $this->card($red, '⚠ Le diagnostic qu\'on refuse', 'La généalogie de la rupture — Chronologie d\'une catastrophe silencieuse',
            '<strong style="font-size:1.1rem;">La rupture de la famille a commencé il y a <span style="color:'.$red.';">60 ans</span>.<br>
            Les premiers thérapeutes sonnent l\'alarme depuis <span style="color:'.$orange.';">55 ans</span>.<br>
            Les institutions traitent à grande échelle depuis <span style="color:'.$orange.';">40 ans</span>.<br>
            Les symptômes <em>empirent</em>.</strong><br><br>
            Ce n\'est pas un échec de moyens.<br>
            Ce n\'est pas un manque de bonnes volontés.<br>
            C\'est la preuve irréfutable que depuis le début, <strong>nous nous trompons de problème.</strong><br><br>
            Si vous avez plus de 40 ans, relisez cette phrase lentement.<br>
            Quand vous étiez enfant, on parlait <em>déjà</em> de crise de la famille.<br>
            On organisait <em>déjà</em> des conférences. On prescrivait <em>déjà</em> des thérapies familiales.<br>
            <strong>Quarante ans plus tard : même diagnostic. Dégâts multipliés.</strong><br><br>
            La raison est simple et cruelle :<br>
            <em>on a soigné la fièvre sans jamais chercher l\'infection.</em><br><br>
            <strong>La chronologie exacte — ce qui s\'est passé, et quand :</strong><br>
            · <strong>1954</strong> — Dernière grande génération familiale. Moyenne : 3,7 enfants par femme (vs 1,68 en 2023). 70 % des Français vivaient à moins de 50 km de leurs parents (INSEE · INED).<br>
            · <strong>1962–1975</strong> — Exode rural massif : 3 millions de personnes arrachées à leurs racines en 13 ans (INED). La proximité géographique — socle invisible de la vie familiale — déchirée en une génération.<br>
            · <strong>1968</strong> — Révolution culturelle. Pour la première fois dans l\'histoire française, la liberté individuelle prime officiellement sur le devoir familial. « Faire sa vie » devient une valeur cardinale. Gilles Lipovetsky dans <em>L\'ère du vide</em> (1983) : <em>« L\'individualisme hédoniste érode les solidarités traditionnelles sans les remplacer. »</em><br>
            · <strong>1975</strong> — La télévision est dans 80 % des foyers français, contre 12 % en 1960. En 15 ans, la conversation familiale du soir a disparu. Le premier écran n\'était pas le smartphone — c\'était <em>le poste dans le salon de vos parents</em>.<br>
            · <strong>1980</strong> — Taux de divorce multiplié par 6 depuis 1960 : de 10 pour 1 000 mariages à plus de 56 pour 100 en 2020 (INSEE).<br>
            · <strong>1965–1985</strong> — La génération qui tenait naturellement la famille — les grands-parents nés avant 1935, survivants des deux guerres et de la famine — commence à mourir. Et avec elle disparaît un savoir invisible que personne n\'avait formalisé, enseigné ni transmis.<br>
            Université du Michigan : quand l\'aîné d\'une famille meurt, les réunions familiales chutent de <strong>40 à 60 % dans les 5 années qui suivent</strong>.<br><br>
            <strong>La question que 55 ans de thérapies n\'ont jamais osé poser :</strong><br>
            En France : la loi du 4 juin <strong>1970</strong> réforme l\'autorité parentale — première reconnaissance légale que l\'enfant a un intérêt propre distinct de ses parents. Premiers cursus de thérapie familiale en France. En 1991, l\'Association Européenne de Thérapie Familiale (EFTA) est fondée à Prague. Ce n\'est pas un manque de réponse — c\'est une réponse qui dure depuis 55 ans et qui n\'a pas résolu le problème.<br>
            On analyse les parents d\'aujourd\'hui. On les accuse, on les excuse, on les comprend.<br>
            Mais <em>de qui auraient-ils dû apprendre ?</em><br>
            De parents qui eux-mêmes n\'avaient plus de modèle.<br>
            Des enfants de la rupture — qui ont essayé d\'élever leurs enfants sans fondation.<br><br>
            Étienne de La Boétie, <em>De la Servitude Volontaire</em> (1549) :<br>
            <em>« La première raison de la servitude volontaire, c\'est l\'habitude. »</em><br><br>
            Nous avons pris l\'habitude que les familles se défassent.<br>
            Nous avons pris l\'habitude que les grands-parents vieillissent seuls dans des institutions financées par leurs propres impôts.<br>
            Nous avons pris l\'habitude que nos enfants grandissent <em>à côté</em> de nous — pas <em>avec</em> nous.<br>
            Et comme toute habitude — nous ne la voyons même plus.<br><br>
            <em style="color:'.$red.';">Ce module ne désigne pas de coupables.<br>
            Il nomme une généalogie précise. Celle d\'une rupture de 60 ans.<br>
            Et pose la seule question qui vaille : ça s\'arrête avec qui ?</em>'
        );

        /* ── LECTURE 1 : La génération ciment ────────────────────── */
        $lec1 = $this->card($gold, 'Lecture 1 · La génération que nous avons perdue', '🏛 La génération ciment — grands-parents nés entre 1900 et 1935',
            '<strong>Ce qui existait avant que tout se défasse :</strong><br>
            En 1954, une femme française avait en moyenne <strong>3,7 enfants</strong> (INSEE).<br>
            Avant l\'exode rural, <strong>70 % des Français</strong> vivaient à moins de 50 km de leurs parents (INED).<br>
            Les repas de famille n\'étaient pas organisés — ils étaient <em>structurels</em>.<br><br>
            Cette génération avait traversé deux guerres, la famine, la pénurie.<br>
            <strong>"Se serrer les coudes" n\'était pas une expression — c\'était de la survie.</strong><br>
            Le patriarche, la matriarche : des figures d\'autorité autour desquelles la famille gravitait naturellement.<br><br>
            <strong>Le grand-parent comme ciment social :</strong><br>
            L\'Université du Michigan a documenté ce que beaucoup sentent sans pouvoir le nommer :<br>
            → Quand le membre le plus âgé d\'une famille meurt, la fréquence des rassemblements familiaux<br>
            chute de <strong>40 à 60 % dans les 5 années qui suivent</strong>.<br>
            Le grand-parent n\'était pas qu\'une personne âgée. Il était la <em>colle</em>.<br>
            Sa disparition révèle que personne n\'avait appris à maintenir ce qu\'il organisait.<br><br>
            <strong>La transmission silencieuse :</strong><br>
            Cette génération savait faire — mais n\'avait pas besoin d\'enseigner.<br>
            Les enfants absorbaient par osmose : les recettes, les rituels, le respect des aînés, la loyauté entre frères.<br>
            Personne n\'a formalisé cette transmission. Personne ne l\'a documentée.<br>
            Puis cette génération est morte. Et avec elle — toute une façon d\'être famille.<br><br>
            <em style="color:'.$gold.';">Ce n\'est pas que la génération suivante était mauvaise.<br>
            C\'est qu\'elle a hérité d\'une maison dont elle ne connaissait pas les fondations — et qu\'elle a construit dessus comme si elles étaient éternelles.</em>'
        );

        /* ── LECTURE 2 : La génération rupture ──────────────────── */
        $lec2 = $this->card($orange, 'Lecture 2 · Ceux qui ont cassé la chaîne', '⚡ La génération rupture — Baby Boomers (60–80 ans aujourd\'hui)',
            '<strong>Les données que personne n\'ose lire ensemble :</strong><br>
            · Taux de divorce : <strong>10 pour 1 000 mariages</strong> en 1960 → <strong>56 pour 100</strong> en 2020 — multiplié par 6 en une génération (INSEE).<br>
            · Exode rural : <strong>3 millions de personnes</strong> ont quitté les campagnes entre 1950 et 1980 (INED) — la proximité géographique déchirée.<br>
            · 1968 : révolution culturelle qui a érigé <em>la libération individuelle</em> au rang de valeur suprême — au détriment des obligations familiales.<br><br>
            <strong>Gilles Lipovetsky, <em>L\'ère du vide</em> (1983) :</strong><br>
            Le post-1968 a installé un individualisme radical qui a érodé les liens collectifs<br>
            non pas brutalement, mais <em>progressivement</em> — comme l\'eau dissout la roche.<br>
            "Faire sa vie" est devenu une injonction. La famille étendue est passée de <em>ressource</em> à <em>obligation pesante</em>.<br><br>
            <strong>L\'invasion de la télévision — la première rupture du soir :</strong><br>
            · 1960 : <strong>12 %</strong> des foyers français possédaient une télévision.<br>
            · 1975 : <strong>80 %</strong> en possédaient une.<br>
            En 15 ans, la conversation du soir autour de la table a été remplacée par le regard vers l\'écran.<br>
            Le premier écran n\'était pas le smartphone — c\'était le poste dans le salon de vos parents.<br><br>
            <strong>Boris Cyrulnik — le syndrome du parent froid :</strong><br>
            La génération née après-guerre avait grandi avec un code implicite :<br>
            <em>"On ne dit pas \'je t\'aime\'. On travaille pour nourrir la famille."</em><br>
            L\'amour était une action — pas une parole ni un contact physique.<br>
            Résultat : des enfants nourris, logés, habillés — et <strong>émotionnellement affamés</strong>.<br>
            Ce pattern d\'indisponibilité émotionnelle s\'est transmis à leurs enfants, qui l\'ont transmis aux leurs.<br><br>
            <em style="color:'.$orange.';">Ce n\'est pas une génération mauvaise. C\'est une génération qui a choisi sa liberté sans mesurer ce qu\'elle déchirait.<br>
            Et qui aujourd\'hui attend, dans des maisons vides, un retour qui ne vient pas.</em>'
        );

        /* ── LECTURE 3 : Le paradoxe de Janus ───────────────────── */
        $lec3 = $this->card($purple, 'Lecture 3 · La vérité inconfortable', '🪞 Le paradoxe de Janus — quand l\'aîné solitaire a semé sa propre solitude',
            '<em>Ce qui suit est difficile à lire. C\'est précisément pour cela qu\'il faut le lire.</em><br><br>
            <strong>Les chiffres :</strong><br>
            · <strong>1 résident EHPAD sur 3</strong> ne reçoit aucune visite familiale dans le mois (Fondation de France, 2021).<br>
            · 84 % des Français déclarent qu\'ils ne mettront « jamais » leurs parents en maison de retraite.<br>
            · <strong>51 % finissent par le faire</strong> — souvent dans l\'urgence, dans la culpabilité, sans relation préalable (Fondation de France, 2022).<br><br>
            <strong>La question que la bienséance interdit :</strong><br>
            Pourquoi ces adultes ne rendent-ils pas visite à leurs parents ?<br>
            La réponse facile : ils sont ingrats, égoïstes, modernes.<br>
            La réponse scientifique est différente.<br><br>
            <strong>Lucy Blake (Université de Cambridge, 2015–2022) :</strong><br>
            Dans <strong>80 % des cas</strong> de rupture familiale, c\'est l\'enfant adulte qui prend la décision de couper le contact.<br>
            Raison principale : <em>négligence émotionnelle vécue dans l\'enfance, comportements toxiques non reconnus.</em><br><br>
            <strong>Karl Pillemer (Cornell University, <em>Fault Lines</em>, 2020) :</strong><br>
            27 % des Américains sont en rupture avec un membre de leur famille.<br>
            Parmi les personnes âgées seules et isolées, la probabilité statistique d\'avoir été<br>
            un parent émotionnellement indisponible est <em>significativement plus élevée</em>.<br><br>
            <strong>British Journal of Psychiatry (Agllias, 2016) :</strong><br>
            Les parents qui n\'ont jamais reconnu le tort causé à leurs enfants sont ceux<br>
            qui ont la plus forte probabilité d\'être seuls en fin de vie.<br><br>
            <strong>INSEE 2022 :</strong><br>
            Le meilleur prédicteur pour savoir si un enfant adulte prendra soin de son parent âgé à domicile ?<br>
            <strong>La qualité perçue de la relation dans son enfance.</strong><br>
            Ni la proximité géographique. Ni les obligations légales. Ni la culpabilité.<br>
            La relation. Ce qui a été — ou n\'a pas été — donné.<br><br>
            <em style="color:'.$purple.';">L\'aîné solitaire n\'est pas toujours une victime de l\'ingratitude moderne.<br>
            Parfois, il est la conséquence logique d\'une absence qui a duré trop longtemps pour être rattrapée par la biologie seule.<br>
            Cette vérité est cruelle. Elle est aussi — pour ceux qui la lisent encore à temps — une chance.</em>'
        );

        /* ── LECTURE 4 : Les accélérateurs ──────────────────────── */
        $lec4 = $this->card($teal, 'Lecture 4 · Ce que les écrans ont achevé — et ce qu\'ils cachent', '📡 Les accélérateurs — de la télévision aux réseaux sociaux',
            '<strong>Première clarification essentielle :</strong><br>
            Les écrans n\'ont pas <em>créé</em> la rupture familiale.<br>
            Ils ont trouvé un vide déjà installé — et s\'y sont engouffrés.<br>
            Une famille unie résiste aux écrans. Une famille déjà fracturée les utilise comme substitut de présence.<br>
            C\'est la différence entre un incendie qui ravage une forêt sèche et un incendie qui s\'éteint dans une forêt humide.<br>
            Le problème n\'est pas l\'écran. C\'est la sécheresse.<br><br>

            <strong>VAGUE 1 — La télévision (1960–1975) : la mort silencieuse de la conversation du soir</strong><br>
            En 1960, 12 % des foyers français possèdent un téléviseur. En 1975 : <strong>80 %</strong> (INSEE).<br>
            En 15 ans, le dîner en famille — lieu de transmission oral des valeurs, des histoires, des émotions du jour — a été remplacé par 1h30 de regard collectif vers un écran unique, asymétrique et non-interactif.<br>
            Ce n\'est pas anodin. Les neuropsychologues le documentent depuis les années 1980 :<br>
            le repas familial est le seul moment de la journée où l\'enfant voit ses deux parents simultanément, entend des adultes traiter des conflits en temps réel, et apprend à écouter et à formuler sa pensée en public.<br>
            La télévision ne l\'a pas supprimé d\'un seul coup. Elle a juste rendu le silence acceptable. Puis normal. Puis structurel.<br><br>

            <strong>VAGUE 2 — Le smartphone et les réseaux (2012–aujourd\'hui) : la crise documentée</strong><br>
            <strong>Jean Twenge (<em>iGen</em>, 2017 — données sur 11 millions d\'adolescents américains) :</strong><br>
            · 2012 : année où l\'équipement en smartphone dépasse les 50 % chez les adolescents américains.<br>
            · 2012–2017 : hausse de <strong>+ 70 %</strong> des syndromes dépressifs chez les 14–17 ans.<br>
            · Les adolescents passant <strong>plus de 5h par jour</strong> sur les réseaux sociaux ont <strong>66 % de probabilité supplémentaire</strong> de présenter au moins un facteur de risque suicidaire par rapport à ceux sous 1h.<br>
            · Ce pic est mondial, simultané dans tous les pays occidentaux — commençant exactement en 2012.<br>
            La corrélation est trop précise pour être fortuite.<br><br>

            <strong>Jonathan Haidt (<em>The Anxious Generation</em>, 2024) :</strong><br>
            Haidt nomme la rupture exacte : l\'enfance fondée sur le <em>jeu libre et l\'autonomie physique</em> a été remplacée depuis 2012 par l\'enfance <em>fondée sur l\'écran</em>.<br>
            Résultats documentés sur 10 ans :<br>
            → Effondrement du temps passé avec les amis en face-à-face<br>
            → Effondrement du sommeil (lumière bleue, stimulation nocturne)<br>
            → Effondrement de la capacité de concentration prolongée<br>
            → Hausse massive des troubles anxieux et dépressifs — notamment chez les filles (comparaison sociale permanente) et les garçons (addiction aux jeux vidéo et à la pornographie en accès libre)<br>
            Haidt résume ainsi : <em>"Nous avons donné à nos enfants un téléphone et supprimé leur enfance."</em><br><br>

            <strong>Sherry Turkle (MIT, <em>Alone Together</em>, 2011 — <em>Reclaiming Conversation</em>, 2015) :</strong><br>
            <em>"La technologie nous offre l\'illusion de la compagnie sans les exigences de l\'amitié."</em><br>
            Turkle documente ce qu\'elle appelle le <em>phubbing parental</em> — le parent qui, physiquement présent, consulte son téléphone.<br>
            · Étude 2021 (<em>Journal of Family Psychology</em>) : la présence du téléphone sur la table pendant un repas, même éteint, réduit la qualité de la conversation et la profondeur du lien ressenti par l\'enfant.<br>
            · L\'enfant ne demande plus « où est mon père ? » — il est là. Il demande : <em>« Pourquoi il regarde son téléphone quand je lui parle ? »</em><br>
            Ce n\'est pas une absence physique. C\'est une <em>présence fantôme</em> — et elle est au moins aussi destructrice pour le lien d\'attachement.<br><br>

            <strong>L\'effet sur la transmission intergénérationnelle — ce que les grands-parents ne peuvent plus faire :</strong><br>
            Avant l\'écran, la soirée familiale incluait le récit. Le grand-père qui raconte la guerre. La grand-mère qui explique comment elle cuisinait avec peu.<br>
            Ces récits transmettaient : l\'identité, les valeurs, la résilience, l\'histoire familiale.<br>
            Aujourd\'hui : <strong>les personnes âgées n\'ont plus accès à l\'attention de leurs petits-enfants</strong> — capturée par des algorithmes conçus pour maximiser l\'engagement, pas pour transmettre.<br>
            TikTok moyen : 7 secondes d\'attention. Un récit de grand-père : 5 minutes minimum. Il n\'y a pas de compétition possible.<br><br>

            <strong>La conclusion qui dérange :</strong><br>
            Les familles qui résistent aux effets destructeurs des réseaux sociaux ont toutes un point commun :<br>
            <em>elles avaient déjà une présence et une cohésion avant l\'arrivée des écrans.</em><br>
            Les familles africaines, maghrébines, asiatiques où les enfants restent bien ancrés malgré TikTok — ce sont celles où les grands-parents sont encore dans la maison, où le repas reste sacré, où la communauté remplace l\'algorithme.<br><br>
            <em style="color:'.$teal.';">Les écrans ne sont pas le problème. Ils sont le révélateur.<br>
            Ils amplifient ce qui existe déjà.<br>
            Là où il y a du lien : ils le perturbent mais ne le détruisent pas.<br>
            Là où il n\'y a plus de lien : ils achèvent ce que la rupture avait déjà commencé.</em>'
        );

        /* ── LECTURE 5 : Violence éducative et lien ───────────────── */
        $lec5 = $this->card($purple, 'Lecture 5 · Le débat le plus mal compris de notre époque', '🌍 Violence parentale, coups, humiliations et lien — l\'erreur logique qui traverse des continents',
            '<strong>Posons d\'abord la question avec précision :</strong><br>
            Pourquoi, dans les banlieues françaises, dans les communautés arabes, subsahariennes, asiatiques, latino-américaines, brésiliennes d\'Europe — des parents aimants, travaillant dur<br>
            continuent-ils à frapper leurs enfants — coups de ceinture, coups de pied, coups de poing, gifles, humiliations, rabaissements constants, cris, intimidations —<br>
            en croyant sincèrement que c\'est la bonne méthode d\'éducation ?<br><br>
            <strong>Soyons clairs sur ce dont on parle.</strong><br>
            Ce n\'est pas "une petite gifle de temps en temps". Ce n\'est pas anodin. Ce n\'est pas ordinaire.<br>
            Ce sont des corps frappés. Des psychés écrasées. Des enfants qui grandissent dans la peur.<br>
            La violence psychologique — humiliation permanente, rabaissement, "tu ne vaux rien", cris qui durent des années — produit des blessures plus profondes et plus durables que les coups physiques.<br>
            Des adultes passent des décennies en thérapie pour digérer exactement ça — et ils ont été "bien élevés" selon leurs parents.<br><br>
            <strong>Alors pourquoi des parents qui aiment leurs enfants font-ils cela ?</strong><br>
            Pas parce qu\'ils sont des monstres. Mais parce qu\'ils font une <em>erreur de raisonnement fondamentale</em> :<br>
            ils croient sincèrement que c\'est cette violence qui produit des enfants respectueux et bien structurés.<br>
            Ils observent une réalité vraie — leurs enfants vont mieux que certains enfants européens —<br>
            et ils en tirent la mauvaise conclusion sur la cause.<br>
            C\'est ce qu\'on appelle une <em>erreur de causalité</em> : confondre deux choses qui coexistent avec une relation de cause à effet.<br><br>
            <strong>Ce qu\'ils observent, et qui est réel :</strong><br>
            Ils voient des enfants de pays dits développés — européens, nord-américains — qui manquent de respect, qui rejettent l\'autorité, qui sont laxistes, perdus, sans boussole.<br>
            Ils voient leurs propres enfants — ou ceux de leur communauté d\'origine — mieux ancrés, plus respectueux, plus solides.<br>
            Cette observation est souvent réelle. Elle n\'est pas une illusion.<br><br>
            <strong>Mais voici l\'erreur — et elle est fondamentale :</strong><br>
            Entre l\'enfant bien ancré de leur communauté et l\'enfant européen en difficulté,<br>
            <strong>dix variables ont changé simultanément.</strong><br>
            Ils en isolent une — la correction physique — et en font la cause.<br>
            C\'est ce que les statisticiens appellent une <em>variable de confusion</em>.<br>
            C\'est la même erreur que de conclure, après avoir comparé deux villes, que les hôpitaux tuent des gens parce que la mortalité y est plus élevée.<br><br>
            <strong>Les vrais facteurs protecteurs — ceux qu\'ils ne voient pas parce qu\'ils sont évidents :</strong><br>
            · <strong>La famille étendue active</strong> : grands-parents impliqués dans l\'éducation quotidienne, pas à 300 km dans un EHPAD<br>
            · <strong>La communauté de référence</strong> : un enfant sait que ses actes ont des conséquences au-delà du cercle familial — le voisin le connaît par son prénom, l\'oncle répondra de lui<br>
            · <strong>Les repas collectifs réguliers</strong> : transmission orale des valeurs, des récits, du sens de l\'appartenance<br>
            · <strong>La présence du père</strong> : pas comme autorité punitive — comme présence réelle, masculine, structurante<br>
            · <strong>La transmission de la honte sociale</strong> (au sens positif) : "ce que tu fais rejaillit sur ta famille"<br>
            · <strong>Les rituels partagés</strong> : religieux, culturels ou familiaux — ils donnent un cadre temporel à l\'identité<br><br>
            Robert Sampson (Harvard, Projet PHDCN — 20 ans de suivi longitudinal) :<br>
            Le premier prédicteur de délinquance juvénile n\'est <em>ni le revenu, ni l\'origine, ni la discipline physique</em>.<br>
            C\'est la <strong>cohésion sociale et familiale</strong> — le sentiment d\'appartenance à quelque chose de plus grand que soi,<br>
            que des adultes veillent, que ses actes s\'inscrivent dans une communauté qui répond de lui.<br>
            Ces familles ont exactement ça. Mais elles ne le voient pas — parce que ça leur semble aussi naturel que l\'air qu\'on respire.<br><br>
            <strong>Ce qui se passe réellement : deux choses simultanées, pas une.</strong><br>
            Ces cultures ont accès à deux éléments en même temps :<br>
            <div style="background:rgba(168,85,247,.08);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;">
            <strong style="color:rgba(168,85,247,.95);">N°1 — Une cohésion familiale et communautaire forte :</strong><br>
            grands-parents présents, père actif, repas collectifs, communauté qui veille, rituels partagés, transmission des valeurs.<br>
            C\'est <strong>ce facteur-là</strong> qui éduque vraiment. C\'est lui qui ancre l\'enfant. C\'est lui qui structure l\'identité.<br><br>
            <strong style="color:rgba(239,68,68,.85);">N°2 — Des violences physiques et psychologiques :</strong><br>
            coups de ceinture, claques, humiliations, rabaissements, intimidations, cris répétés.<br>
            Ces violences <strong>coexistent</strong> avec la cohésion — mais elles n\'en sont pas la cause.
            </div>
            <strong>L\'erreur est d\'attribuer les résultats positifs au N°2 — alors qu\'ils viennent entièrement du N°1.</strong><br>
            Retirez le N°2 et gardez le N°1 intact ? Les enfants vont aussi bien, souvent mieux.<br>
            Retirez le N°1 et gardez le N°2 ? Les enfants s\'effondrent. C\'est exactement ce qu\'on observe à la 2e génération en Europe.<br>
            <strong>La violence n\'a jamais éduqué. La présence et le lien, oui.</strong><br><br>
            Gershoff & Grogan-Kaylor (<em>Journal of Family Psychology</em>, 2016) — méta-analyse de <strong>75 études, 160 927 enfants</strong> :<br>
            La violence physique exercée dans une famille aimante produit des effets légèrement moins sévères que dans un foyer froid et hostile — mais <strong>jamais nuls</strong>. <strong>Jamais acceptables. Jamais sans conséquence.</strong><br>
            Ce n\'est pas une atténuation qui absout. C\'est une blessure qui saigne moins vite — mais qui saigne quand même, et qui laisse des cicatrices à l\'âge adulte :<br>
            → Augmentation de l\'agressivité documentée dans 93 % des études<br>
            → Augmentation des comportements anxieux et des phobies<br>
            → Détérioration mesurable de la relation parent-enfant<br>
            → Troubles de santé mentale à l\'âge adulte (dépression, stress post-traumatique)<br>
            → <strong>Zéro bénéfice sur l\'obéissance à long terme</strong><br><br>
            Traduction : même quand les parents aiment vraiment leurs enfants, la violence laisse des traces. L\'amour n\'efface pas la douleur infligée. Les deux coexistent — et l\'adulte qui en sort le sait.<br><br>
            Diana Baumrind (Berkeley) a suivi des familles pendant <strong>40 ans</strong> — c\'est ce qu\'on appelle une <em>recherche longitudinale</em> : on ne mesure pas une fois et on tire des conclusions. On suit les mêmes enfants pendant des décennies pour voir ce qu\'ils deviennent vraiment. C\'est la méthode la plus fiable qui existe en psychologie.<br>
            Résultat de ces 40 ans : les meilleurs résultats proviennent du <em>parenting autoritatif</em> — être à la fois chaleureux et exigeant, sans jamais recourir à la violence physique ni à l\'humiliation.<br>
            <strong>Supprimez les violences physiques et psychologiques en gardant tout le reste — la présence, l\'amour, les exigences, les limites : les résultats sont préservés. Souvent améliorés.</strong><br><br>
            <strong>Ce qui se passe quand ces familles arrivent en Europe — la preuve par l\'expérience réelle :</strong><br>
            Première génération : la structure familiale est intacte, importée du pays d\'origine.<br>
            Père présent, grand-mère dans l\'appartement, repas collectifs, valeurs transmises, communauté active.<br>
            Les enfants sont <strong>mieux ancrés</strong> que beaucoup d\'enfants européens en rupture totale — la base est là.<br>
            Mais soyons précis : "mieux ancré" ne veut pas dire "bien". Les violences physiques et psychologiques sont déjà là, et elles blessent déjà. Les traumatismes s\'accumulent silencieusement derrière la façade de la cohésion familiale — <strong>moins visibles, jamais absents, jamais acceptables</strong>.<br>
            La chaleur familiale ne guérit pas une blessure infligée par cette même famille. Elle la dissimule — parfois pendant des décennies.<br>
            Ce qui tient l\'édifice, c\'est la cohésion. Pas les coups. Les coups n\'ont jamais tenu quoi que ce soit.<br><br>
            Deuxième génération, 15 à 20 ans plus tard :<br>
            · La mère — qui travaillait déjà — porte maintenant seule les enfants, le foyer, l\'éducation, et les émotions non résolues de toute la famille. Elle n\'a pas choisi l\'absence : on lui a simplement retiré tous les soutiens qui existaient avant.<br>
            · En France, la semaine légale est à 35 heures — ce n\'est pas l\'excès de travail du père qui explique son absence. C\'est le désengagement, la rupture, ou la séparation. Les pères présents dans les familles de la première génération ne travaillaient pas plus — ils étaient là parce que la structure familiale et communautaire les maintenait là.<br>
            · Ce qui se passe ensuite ressemble de plus en plus à ce qu\'on observe chez les Européens : séparations, pères absents, mère seule. Moins fréquent encore — mais la tendance est là, et elle s\'accélère avec chaque génération de naissance en France.<br>
            · Grand-mère restée au pays ou trop âgée pour s\'occuper des enfants au quotidien — elle n\'est plus dans l\'appartement, elle n\'est plus une présence active dans la vie de l\'enfant<br>
            · Communauté dispersée dans des cités où personne ne se connaît plus<br>
            · Enfants sur TikTok sans ancrage identitaire<br>
            · Repas devant la télévision si tant est qu\'on mange ensemble<br>
            La structure qui amortissait s\'est dissipée. Mais les violences physiques et psychologiques, elles, sont restées.<br>
            Et là, la vérité éclate au grand jour : <strong>les coups n\'ont jamais éduqué. Ils n\'ont jamais "fonctionné".</strong><br>
            Ce qui maintenait l\'enfant debout, c\'était la communauté, le père présent, la grand-mère qui veillait — pas la douleur infligée.<br>
            Supprimez la douleur avec la structure intacte : l\'enfant va mieux.<br>
            Supprimez la structure en gardant la douleur : l\'enfant s\'effondre.<br>
            La preuve est là. Elle est irréfutable. Elle se joue sous nos yeux dans chaque cité de France.<br>
            Ces enfants commencent à ressembler exactement aux enfants européens qui étaient regardés avec incompréhension.<br><br>
            <strong>La partie que la bienséance empêche de nommer :</strong><br>
            Ces parents ne voient pas les traumatismes qu\'ils infligent — parce que la chaleur familiale joue un rôle d\'amortisseur apparent.<br>
            Mais Lansford et al. (<em>Child Development</em>, 2005, 6 pays) documentent que même dans les cultures où c\'est normalisé,<br>
            les effets délétères sont <em>atténués</em>, pas supprimés.<br>
            Des adultes de ces communautés, en thérapie, expriment exactement cela :<br>
            <em>"Ma famille m\'a tout donné. Et certaines choses m\'ont blessé quand même."</em><br>
            Les deux sont vrais simultanément. La cohésion protège. La douleur marque.<br><br>
            <strong>Ce que les Européens ont compris — et mal appliqué :</strong><br>
            L\'Europe a fait un bond en avant réel : elle a commencé à écouter l\'enfant.<br>
            À reconnaître qu\'un enfant a un point de vue. Qu\'il a le droit de s\'exprimer. Que son ressenti compte.<br>
            Le droit de l\'enfant à être entendu sans être ridiculisé — c\'est une avancée civilisationnelle.<br>
            Des communautés entières croient encore qu\'un enfant "n\'a pas à donner son avis" — et c\'est une violence psychologique en soi.<br>
            Ne jamais écouter un enfant, le faire taire systématiquement, lui signifier que sa parole ne vaut rien :<br>
            c\'est une forme de violence qui ne laisse pas de traces visibles — mais qui brise l\'estime de soi pour des décennies.<br><br>
            Mais l\'Europe a commis une erreur symétrique :<br>
            elle a reconnu les droits de l\'enfant <strong>tout en détruisant simultanément le lien, la présence et la structure familiale.</strong><br>
            Elle a supprimé la violence — c\'est juste. Mais elle n\'a pas reconstruit ce qui rendait l\'autorité légitime.<br>
            Résultat : des enfants écoutés dans leurs droits, mais abandonnés dans leur construction.<br><br>
            <strong>Le paradoxe que personne n\'ose nommer — deux camps, deux erreurs inverses :</strong><br>
            <div style="background:rgba(239,68,68,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;border-left:3px solid rgba(239,68,68,.4);">
            <strong>Camp 1 — Les familles d\'immigration (arabes, subsahariennes, asiatiques, brésiliennes…) :</strong><br>
            Ils maintiennent la cohésion familiale — c\'est réel, c\'est une force.<br>
            Mais ils y ajoutent des violences physiques et psychologiques importantes.<br>
            Les enfants obéissent — mais souvent par <strong>peur</strong>, pas par adhésion.<br>
            À la maison : respectueux, obéissants. Dans la rue : "nike ta mère".<br>
            L\'obéissance par la peur ne se transfère pas. Elle s\'arrête à la porte.<br>
            Et quand les services sociaux interviennent, ces familles crient au racisme —<br>
            parce que pour elles, un enfant obéissant = un enfant bien élevé.<br>
            Elles ne voient pas la peur. Elles ne voient pas les blessures invisibles.<br>
            Elles ne voient pas que l\'obéissance achetée par la douleur ne produit pas un adulte libre et responsable.
            </div>
            <div style="background:rgba(99,102,241,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;border-left:3px solid rgba(99,102,241,.4);">
            <strong>Camp 2 — Les familles européennes :</strong><br>
            Elles ont supprimé la violence — c\'est le bon choix.<br>
            Elles ont reconnu les droits de l\'enfant, écouté sa parole — c\'est une avancée réelle.<br>
            Mais elles ont simultanément détruit la structure : père absent, famille dispersée, transmission rompue, communauté inexistante.<br>
            Résultat : des enfants avec des droits mais sans racines. Écoutés mais non ancrés.
            </div>
            <strong>Ce qui est particulièrement documenté :</strong><br>
            Les études sur le décrochage scolaire en France montrent que certaines communautés — notamment parmi les jeunes d\'origine algérienne, maghrébine — présentent des taux de décrochage et d\'entrée dans l\'économie informelle ou illicite parmi les plus élevés.<br>
            Pas parce que ces jeunes sont moins capables.<br>
            Mais parce qu\'ils cumulent : la perte de la cohésion familiale de la 1ère génération + la violence psychologique héritée + l\'absence de modèle d\'intégration + la discrimination réelle à l\'embauche.<br>
            C\'est un cumul de facteurs. Pas une fatalité ethnique. Mais une réalité qu\'on ne peut pas ignorer sous prétexte de politiquement correct — parce qu\'ignorer un problème, ce n\'est pas le respecter, c\'est l\'abandonner.<br><br>
            <strong>La double absence — la situation la plus douloureuse et la moins nommée</strong><br>
            <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;border-left:3px solid rgba(168,85,247,.4);">
            <strong>Abdelmalek Sayad — <em>La Double Absence</em> (Seuil, 1999)</strong><br>
            Sayad était lui-même algérien, sociologue, collaborateur de Bourdieu.<br>
            Son œuvre majeure, publiée à sa mort, décrit un phénomène qu\'il a observé et vécu :<br>
            <em>l\'immigré algérien est absent dans les deux pays simultanément.</em><br><br>
            · En France : il est perçu comme étranger, "l\'Arabe", celui qui n\'est "pas vraiment" français — même après 30 ans, même avec un passeport français.<br>
            · En Algérie : il est perçu comme "le Français", celui qui a trahi, qui a changé, qui ne comprend plus les codes, qui a honte de certaines choses que sa famille d\'origine trouve normales.<br>
            <strong>Il n\'appartient pleinement à aucun des deux espaces.</strong> Il est la frontière vivante de deux mondes qui ne se rejoignent pas.<br>
            Sayad a nommé cela "la double absence" — absent ici parce qu\'imaginé là-bas. Absent là-bas parce que transformé ici.
            </div>
            <strong>La génération suivante — encore plus perdue que les deux précédentes :</strong><br>
            Les enfants nés en France d\'origine algérienne vivent une version amplifiée de cette double absence.<br>
            Ils n\'ont souvent jamais vécu en Algérie. Ils parlent l\'arabe dialectal avec un accent. Ils ne connaissent pas les codes sociaux du bled.<br>
            Quand ils y vont l\'été, les cousins les appellent <em>"le Français"</em> — avec un mélange d\'admiration et de méfiance. Leurs comportements, leurs vêtements, leur rapport à la religion sont scrutés.<br>
            Leur famille algérienne les juge : "il ne respecte pas". "Elle est trop libre." "On leur a tout donné en France et regardez ce qu\'ils sont devenus."<br>
            <strong>La famille d\'origine en Algérie a honte d\'eux.</strong> Pas parce qu\'ils sont intrinsèquement mauvais — mais parce qu\'ils sont le symbole visible d\'une transmission échouée.<br><br>
            <strong>Hugues Lagrange — <em>Le Déni des cultures</em> (Seuil, 2010)</strong><br>
            Lagrange est chercheur au CNRS. Son livre a déclenché une tempête quand il est sorti, accusé de racisme — mais il n\'a jamais été réfuté sur le fond.<br>
            Ses données sur les adolescents des cités de Seine-Saint-Denis : à niveau socio-économique identique, les jeunes d\'origine subsaharienne et maghrébine présentent des comportements déviants plus fréquents que les autres groupes.<br>
            Sa conclusion — que ses détracteurs n\'ont pas voulu entendre :<br>
            <em>Ce n\'est pas l\'origine ethnique qui explique. C\'est la structure familiale spécifique.</em><br>
            Autorité parentale par la peur + père souvent absent ou peu impliqué dans la scolarité + mère surchargée + absence de dialogue = une bombe à retardement.<br>
            La discrimination réelle à l\'embauche aggrave tout — mais elle n\'explique pas tout.<br><br>
            <strong>Le paradoxe identitaire : plus perdus que les Européens</strong><br>
            Un enfant européen en rupture familiale a au moins un ancrage culturel majoritaire autour de lui — la langue, les institutions, les repères.<br>
            Un enfant d\'origine algérienne en rupture familiale en France n\'a rien de tout ça.<br>
            Il est rejeté par la société française ("tu n\'es pas d\'ici").<br>
            Il est rejeté par sa famille d\'origine ("tu n\'es plus des nôtres").<br>
            Il n\'est pas vraiment ancré dans la religion — il en prend les codes de surface sans la profondeur spirituelle.<br>
            Il n\'est pas vraiment ancré dans la culture française — il ne s\'y sent pas reconnu.<br>
            <strong>Il est entre deux mondes. Appartenant à aucun. Rejeté des deux.</strong><br>
            C\'est ce vide identitaire — pas la pauvreté, pas la discrimination seule — qui est le terreau réel de la dérive.<br>
            Et dans ce vide, le groupe de pairs devient la seule famille réelle. Le quartier devient le seul territoire d\'appartenance.<br>
            La violence qui y règne devient le seul code de reconnaissance.<br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.3;border-left:3px solid rgba(201,168,76,.4);font-style:italic;">
            "Je ne suis pas français pour les Français.<br>
            Je ne suis pas algérien pour les Algériens.<br>
            Je suis le fils de personne. Et le fils de personne peut tout faire."<br>
            <span style="font-size:.75rem;color:rgba(201,168,76,.6);">— Formulation documentée par Sayad dans ses entretiens avec des jeunes de la 2e génération, reprise dans <em>La Double Absence</em>, 1999</span>
            </div>
            <strong>Ce que cela révèle sur la transmission :</strong><br>
            La violence parentale — coups, humiliations, absence d\'écoute — n\'a pas seulement blessé ces enfants.<br>
            Elle a coupé le fil de la transmission identitaire : l\'enfant qui a peur de son père ne va pas vers lui pour comprendre d\'où il vient.<br>
            Il n\'hérite pas. Il fuit. Et en fuyant sa famille, il fuit aussi ses racines.<br>
            Il se retrouve sans lien avec sa culture d\'origine, sans lien avec sa société d\'accueil,<br>
            et sans les ressources intérieures que seul un attachement sécurisé construit.<br>
            <strong>La violence a détruit le lien qui aurait pu servir de pont entre les deux mondes.</strong><br><br>
            <strong>La Suède — l\'expérience naturelle décisive :</strong><br>
            Premier pays à avoir interdit <strong>toutes les violences éducatives</strong> — physiques comme psychologiques : <strong>1979</strong>.<br>
            45 ans plus tard : aucune explosion de délinquance, aucun effondrement de l\'autorité.<br>
            Meilleurs indicateurs de santé mentale des jeunes en Europe (Eurostat 2022), cohésion sociale parmi les plus élevées (OCDE 2023).<br>
            Ce n\'est pas l\'interdiction de la violence seule qui a préservé ces enfants.<br>
            C\'est que la Suède a <em>simultanément</em> renforcé les structures de cohésion familiale et communautaire — congé parental long, soutien à la famille, réseaux de voisinage, présence réelle.<br>
            Les deux ensemble. Supprimer la violence <strong>et</strong> reconstruire le lien. Pas l\'un sans l\'autre.<br><br>
            <em style="color:'.$purple.';">Les coups de ceinture ne sont pas la solution.<br>
            Les humiliations répétées ne sont pas la solution.<br>
            Le silence forcé, le "ferme ta gueule" et la peur permanente ne sont pas la solution.<br>
            Mais ce n\'est pas non plus leur absence seule qui protège les enfants d\'Europe.<br>
            Ce qui les détruit, c\'est qu\'on a supprimé la violence <strong>sans reconstruire le lien.</strong><br>
            Et ce qui protège encore les enfants des familles à forte cohésion,<br>
            c\'est cette cohésion — pas la douleur qui l\'accompagne et finira par la ronger.<br><br>
            Les deux camps ont une leçon à apprendre de l\'autre.<br>
            Et les deux camps ont une erreur à corriger.<br><br>
            La leçon unique, pour tous :<br>
            <strong>Construisez le lien. Supprimez la violence — physique et psychologique. Sans exception. Sans substitut. Maintenant.</strong></em>'
        );

        /* ── LECTURE 6 : Le paradoxe du confort ──────────────────── */
        $lec6 = $this->card($red, 'Lecture 6 · L\'idéologie invisible du sacrifice', '⚡ Le paradoxe du confort — travailler toujours plus pour financer ce qu\'on détruit par l\'absence',
            '<strong>La donnée brute — ce que la croissance économique a réellement produit :</strong><br>
            En France entre 1980 et 2023 :<br>
            · Les revenus réels des ménages ont augmenté de <strong>43 %</strong> (INSEE 2023)<br>
            · Le temps de travail moyen des parents actifs a progressé de <strong>18 %</strong><br>
            · Les syndromes dépressifs chez les 14–17 ans : <strong>+280 %</strong> (INSERM 2022)<br>
            · Les ruptures familiales (divorces + séparations) : <strong>+240 %</strong><br>
            · Enfants déclarant que leur parent "est rarement disponible" : <strong>3 sur 4</strong><br><br>
            Traduction sans détour : <em>en gagnant plus, nous avons perdu l\'essentiel.</em><br>
            Ce n\'est pas une corrélation anodine. C\'est la signature d\'un paradoxe systémique.<br><br>
            <strong>L\'analogie de la guerre — pour comprendre le mécanisme</strong><br>
            Considérez cette affirmation : <em>"Mourir pour la patrie est un honneur."</em><br>
            Pendant des siècles, cette idée a envoyé des millions d\'hommes se faire tuer —<br>
            non pas parce qu\'on les y forçait mentalement,<br>
            mais parce qu\'ils avaient intégré cette conviction comme une <em>vérité morale</em>.<br>
            Le soldat qui mourait croyait mourir pour quelque chose de sacré.<br>
            Ce qui profitait réellement de sa mort ? Les États, les industriels de l\'armement, les frontières tracées dans des bureaux.<br>
            Lui — il était mort. Et sa mort devenait la preuve permanente de son amour de la patrie.<br><br>
            Maintenant considérez cette affirmation : <em>"Travailler dur pour ma famille, c\'est de l\'amour."</em><br>
            <strong>Structure identique. Mécanique identique.</strong><br>
            Le parent qui revient épuisé chaque soir — après une journée de travail, les trajets, la charge mentale, parfois un deuxième emploi — croit donner quelque chose de sacré à ses enfants.<br>
            En France, la semaine légale est à 35 heures. En Belgique, 38 heures. Aux États-Unis, 40 heures. Ce n\'est pas l\'excès de travail en lui-même qui crée l\'absence : c\'est la fatigue accumulée, le désengagement progressif, la charge invisible — et pour beaucoup de mères, la double journée qui commence là où le travail s\'arrête.<br>
            Ce qui profite réellement de cet épuisement ? Les entreprises. La productivité nationale. Le PIB.<br>
            Et pendant qu\'il travaille, sa famille — la chose réelle qu\'il croyait servir — meurt progressivement de son absence.<br><br>
            <strong>Noam Chomsky & Edward Herman — <em>Manufacturing Consent</em>, 1988</strong><br>
            Les grandes idéologies ne s\'imposent pas par la force brute.<br>
            Elles se font <em>accepter comme des vérités morales</em> — de sorte que celui qui les questionne semble immoral, pas courageux.<br>
            Remettre en question "travailler plus = aimer plus" est perçu comme de l\'irresponsabilité.<br>
            <em>"Tu n\'aimes pas ta famille ?"</em><br>
            Exactement comme <em>"Tu n\'aimes pas ton pays ?"</em> répondait à celui qui refusait de se battre.<br>
            Le mécanisme est identique à deux siècles d\'écart.<br><br>
            <strong>Pierre Bourdieu — la nécessité économique convertie en vertu morale</strong><br>
            Bourdieu a observé une régularité anthropologique précise :<br>
            les contraintes économiques auxquelles on ne peut pas échapper <em>se transforment toujours en vertus morales</em>.<br>
            Parce qu\'accepter de subir une contrainte sans justification morale est psychologiquement insoutenable.<br>
            "Je travaille autant que je peux parce que je n\'ai pas le choix" est une vérité trop dure à tenir.<br>
            "Je travaille <em>pour ma famille</em>" est digne, courageux, admirable.<br>
            La contrainte économique réelle devient le sacrifice d\'un père ou d\'une mère qui aime.<br>
            Et le sacrifice d\'un parent aimant ne peut plus être questionné —<br>
            sans quoi c\'est son identité entière qui s\'effondre.<br><br>
            <strong>Ivan Illich — la contre-productivité (<em>La Convivialité</em>, 1973)</strong><br>
            Illich a nommé un seuil précis au-delà duquel tout outil détruit ce qu\'il prétend servir.<br>
            Exemple : la voiture.<br>
            Si vous comptez les heures de travail pour financer la voiture, l\'assurer, payer l\'essence, traverser les embouteillages —<br>
            la vitesse effective de l\'automobiliste moyen est inférieure à celle d\'un cycliste.<br>
            Plus on court, moins on avance.<br><br>
            Le même calcul appliqué au lien familial :<br>
            Vous acceptez les heures supplémentaires, les horaires décalés, parfois un deuxième emploi — pour "offrir un beau Noël à vos enfants".<br>
            Vous n\'êtes pas là 50 semaines sur 52.<br>
            Le beau Noël arrive. L\'enfant déballe les cadeaux.<br>
            Et ce qu\'il ressent <em>sous le cadeau</em>, c\'est votre absence.<br>
            Il ne peut pas le formuler à 9 ans.<br>
            Il le formulera précisément à 30 ans — peut-être en thérapie.<br>
            La contre-productivité d\'Illich s\'applique au foyer avec une précision clinique.<br><br>
            <strong>La fatigue parentale — un résultat mécanique, pas un échec moral</strong><br>
            Christina Maslach (Berkeley, 1981) a défini le burnout comme l\'épuisement de ressources face à des exigences qui les dépassent structurellement.<br>
            Un parent en 2025 fait face à des exigences simultanées sans précédent historique :<br>
            · Travailler pour financer le logement, la nourriture, les vêtements<br>
            · Être émotionnellement présent(e) pour ses enfants<br>
            · Gérer une administration de plus en plus complexe<br>
            · Surveiller un environnement numérique conçu pour capturer l\'attention des enfants<br>
            · Maintenir des limites dans un monde qui les supprime<br>
            · Faire tout cela seul(e) — sans famille étendue, sans village, sans communauté<br><br>
            Quand un parent "baisse les bras", c\'est la réponse physiologique normale<br>
            d\'un être humain face à une mission impossible,<br>
            dans un isolement structurel total,<br>
            après des années d\'épuisement cumulatif.<br>
            Ce n\'est pas un échec moral. C\'est la prédiction mécanique d\'un système mal conçu.<br><br>
            <strong>Le verrou du sacrifice — pourquoi cette idéologie résiste à tout questionnement</strong><br>
            Le soldat mort au combat ne peut plus dire :<br>
            <em>"En réalité, peut-être que ça n\'en valait pas la peine."</em><br>
            Il est mort. Le sacrifice est total. Sa mort est la preuve ultime de son amour de la patrie.<br><br>
            Le parent qui a "tout sacrifié pour ses enfants" est dans la même impossibilité psychologique.<br>
            Remettre en question le sacrifice — les heures, l\'absence choisie, l\'épuisement accumulé —<br>
            c\'est remettre en question trente ans d\'identité construite autour de ce sacrifice.<br>
            Alors on ne questionne pas. On dit : <em>"J\'ai tout donné pour eux."</em><br>
            Et la souffrance du sacrifice devient la preuve de l\'amour.<br>
            Même si les enfants souffrent essentiellement de l\'absence.<br><br>
            <em style="color:'.$red.';">Ce qu\'un enfant vous dira s\'il comprend avant qu\'il soit trop tard :<br>
            "Tu n\'avais pas besoin du grand appartement ni de la grande voiture.<br>
            J\'avais besoin que tu sois là. Juste là. Avec moi."<br><br>
            Ce n\'est pas un reproche.<br>
            C\'est la réponse à une question qu\'on ne lui a jamais laissé poser.<br><br>
            La richesse ne remplace pas la présence.<br>
            Le travail fourni pour la financer ne compte pas comme du temps ensemble.<br>
            Et le confort matériel apporté à une famille qui n\'existe plus comme famille<br>
            est — exactement comme vous l\'avez senti — travailler dans le vide.<br><br>
            <strong>Ce qui alimente une famille, c\'est le lien.<br>
            Pas le solde bancaire.<br>
            Ce n\'est pas une métaphore. C\'est une donnée neurobiologique.</strong></em>'
        );

        /* ── LECTURE 7 : L'environnement prédateur ──────────────────── */
        $lec7 = $this->card($orange, 'Lecture 7 · Ce que le système fait à vos enfants', '🌐 L\'environnement prédateur — élever un enfant dans un monde conçu contre lui',
            '<strong>Une clarification préalable :</strong><br>
            Le terme "environnement prédateur" n\'est pas métaphorique. Il est <em>techniquement exact</em>.<br>
            Des personnes intelligentes, dans des entreprises bien éclairées, ont passé des années à concevoir<br>
            des systèmes dont l\'objectif explicite est de capturer l\'attention de vos enfants le plus tôt possible,<br>
            aussi profondément que possible, aussi longtemps que possible.<br>
            C\'est leur modèle économique. Ils le savaient. Certains l\'ont avoué publiquement.<br><br>
            <strong>Sean Parker, co-fondateur de Facebook — Axios, novembre 2017</strong><br>
            <div style="background:rgba(249,115,22,.08);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;border-left:3px solid rgba(249,115,22,.4);font-style:italic;line-height:2.1;">
            "Nous exploitons une vulnérabilité de la psychologie humaine.<br>
            Comment consommons-nous le plus de votre temps et de votre conscience attentive ?<br>
            En vous donnant une petite dose de dopamine — un like, un commentaire —<br>
            ce qui vous pousse à en contribuer davantage.<br>
            C\'est une boucle de validation sociale.<br>
            Et Dieu sait les dommages psychologiques que nous causons à la génération actuelle."
            </div>
            Il savait. Ils savaient tous. <em>Ils ont continué.</em><br><br>
            <strong>Frances Haugen — les documents internes d\'Instagram (2021)</strong><br>
            Frances Haugen, ancienne ingénieure de Facebook, a remis aux régulateurs américains les études internes.<br>
            Ce qu\'elles révèlent :<br>
            · Chez les adolescentes : l\'application aggrave les troubles de l\'image corporelle dans <strong>32 % des cas</strong><br>
            · Les équipes internes savaient que l\'application rendait des millions d\'utilisatrices "malheureuses de leur corps"<br>
            · La décision de ne pas modifier l\'algorithme a été prise en connaissance de cause<br>
            · La croissance de l\'engagement primait sur la santé mentale documentée des adolescentes<br>
            Ce n\'est pas de la négligence accidentelle. C\'est un choix documenté, répété.<br><br>
            <strong>Tristan Harris — ancien ingénieur Google, fondateur du Center for Humane Technology</strong><br>
            "Il y a une course au fond du cerveau primitif.<br>
            Le contenu qui gagne n\'est pas le plus vrai ni le plus utile.<br>
            C\'est le contenu qui déclenche la colère, la peur, l\'indignation —<br>
            parce que ces émotions sont les plus addictives, les plus persistantes.<br>
            Un enfant de 11 ans n\'a aucun système de défense face à une ingénierie<br>
            qui emploie les meilleurs cerveaux du monde et 10 milliards de dollars d\'optimisation comportementale."<br><br>
            <strong>La pornographie comme première éducation sexuelle par défaut</strong><br>
            Chiara Sabina, Janis Wolak & David Finkelhor (<em>CyberPsychology &amp; Behavior</em>, 2008) :<br>
            · <strong>93 %</strong> des garçons exposés à de la pornographie en ligne avant 18 ans<br>
            · Âge moyen de première exposition : <strong>11 à 12 ans</strong><br>
            · <strong>36 %</strong> des filles exposées — souvent sans consentement, envoyé par d\'autres<br><br>
            Pour une majorité d\'enfants dans les pays développés,<br>
            la <em>première représentation de la sexualité humaine</em><br>
            est produite par une industrie qui objectifie, spectacularise et dégrade.<br>
            Ce n\'est pas une éducation. C\'est l\'inverse de toute éducation à la relation.<br>
            Et les parents épuisés par leur journée — et pour beaucoup par la double charge domestique qui commence quand le travail s\'arrête —<br>
            sont souvent absents quand c\'est arrivé, ne savent pas que c\'est arrivé,<br>
            et ne savent pas comment en parler quand ils finissent par le découvrir.<br><br>
            <strong>La saturation attentionnelle — une dégradation neurologique mesurée</strong><br>
            Gloria Mark (Université de Californie, Irvine — <em>Attention Span</em>, 2023) :<br>
            · En 2004 : temps moyen de concentration sur une tâche avant interruption : <strong>2 min 30 s</strong><br>
            · En 2023 : <strong>47 secondes</strong><br><br>
            Ce n\'est pas une métaphore du fait que "nous sommes distraits".<br>
            C\'est la mesure neurologique d\'une dégradation réelle et progressive de la <em>capacité d\'attention</em>,<br>
            documentée sur 20 ans d\'études longitudinales.<br>
            Un enfant élevé dans cet environnement sans contrepoids familial développe un cerveau<br>
            structurellement moins capable de tolérer l\'ennui, d\'attendre une récompense,<br>
            de s\'asseoir face à quelqu\'un et de <em>vraiment l\'écouter</em> —<br>
            trois capacités exactement nécessaires pour construire un lien humain durable.<br><br>
            <strong>John Cacioppo (Univ. Chicago — <em>Loneliness</em>, 2008)</strong><br>
            La solitude chronique augmente la mortalité prématurée autant que <strong>15 cigarettes par jour</strong>.<br>
            Le cerveau humain est câblé pour le lien en <em>présence physique</em> :<br>
            contact, regard, voix partagée, synchronie corporelle.<br>
            Aucun substitut numérique n\'active les mêmes circuits de l\'attachement.<br>
            Pas le téléphone. Pas FaceTime. Pas les 2 000 abonnés.<br>
            L\'enfant qui manque de lien réel ne le sait pas consciemment —<br>
            mais son système nerveux, lui, le sait.<br>
            Il cherche la dopamine là où elle est la plus accessible : likes, notifications, scroll infini.<br>
            Le cycle s\'auto-entretient jusqu\'au point de rupture.<br><br>
            <strong>La mission impossible du parent moderne — seul contre un système industriel</strong><br>
            Pour protéger efficacement un enfant de cet environnement, il faudrait :<br>
            · Être présent(e) une grande partie des heures d\'éveil de l\'enfant<br>
            · Connaître les plateformes, les algorithmes, les tendances et les dangers de chaque réseau<br>
            · Mener des conversations régulières sur la sexualité, la violence, les dépendances, les manipulations<br>
            · Contrebalancer 4 heures d\'algorithme par 4 heures de présence réelle et de sens partagé<br>
            · Maintenir des limites dans un monde qui les supprime systématiquement<br><br>
            Tout cela — après 10 heures de travail. Seul(e). Sans famille étendue. Sans communauté.<br>
            Ce n\'est pas un programme parental. C\'est un programme d\'épuisement organisé.<br><br>
            <strong>La lucidité stratégique — ce qui remplace la culpabilité</strong><br>
            Ce module ne vient pas accabler les parents.<br>
            La plupart font déjà l\'impossible.<br>
            Ce qu\'il vient nommer, c\'est que <em>l\'ennemi n\'est pas dans votre famille</em>.<br>
            Il est dans un système économique qui a décidé que l\'attention de vos enfants est une ressource extractible —<br>
            et qui a consacré des milliards à optimiser cette extraction.<br><br>
            La réponse n\'est pas la culpabilité. C\'est la <em>lucidité stratégique</em>.<br>
            Nommer ce qui est hostile. Construire autour de ce qu\'on peut encore contrôler.<br>
            Et comprendre que la chose la plus subversive qu\'un parent puisse faire<br>
            dans un monde industriellement conçu pour capturer l\'attention de son enfant,<br>
            c\'est d\'être <em>entièrement présent(e)</em> avec lui.<br>
            Pas parfait(e). Pas riche. Pas sans écran.<br>
            <strong>Présent(e). Réellement là.</strong><br><br>
            <em style="color:'.$orange.';">Un parent épuisé, surchargé, seul face à un système industriel n\'est pas un mauvais parent.<br>
            C\'est un être humain à qui on a demandé de nager contre une marée industrielle,<br>
            seul(e), sans bouée, après qu\'on lui a retiré toute la communauté qui aurait pu l\'aider.<br><br>
            Première étape : nommer la marée.<br>
            Deuxième étape : ne plus nager seul(e).</em>'
        );

        /* ── EXERCICE 1 : Généalogie émotionnelle ─────────────────── */
        $ex1 = $this->exercice($indigo, '①', 'La généalogie émotionnelle — cartographier 3 générations',
            '<strong>Prenez une grande feuille. Cet exercice prend 30 minutes. Ne le faites pas à moitié.</strong><br><br>
            <strong>ÉTAPE 1 — Dessiner l\'arbre (10 min)</strong><br>
            Trois niveaux :<br>
            → Vos <strong>grands-parents</strong> (génération ciment)<br>
            → Vos <strong>parents</strong> (génération rupture ou transition)<br>
            → <strong>Vous</strong> (et vos frères/sœurs)<br><br>
            Pour chaque personne, notez :<br>
            · <strong>Disponibilité émotionnelle</strong> : présent(e) / absent(e) / toxique / chaleureux(se)<br>
            · <strong>Rupture ?</strong> : divorce, exil, silence, coupure de contact<br>
            · <strong>Transmission</strong> : qu\'est-ce qu\'ils m\'ont donné ? qu\'est-ce qu\'ils n\'ont pas su donner ?<br><br>
            <strong>ÉTAPE 2 — Identifier le maillon cassé (10 min)</strong><br>
            → À quelle génération la chaîne s\'est-elle brisée dans votre famille ?<br>
            → Quel événement, quel choix, quelle absence a déclenché la rupture ?<br>
            → Y a-t-il un schéma qui se répète de génération en génération ?<br>
            (Ex : pères absents, mères envahissantes, fuite à l\'âge adulte, ruptures répétées)<br><br>
            <strong>ÉTAPE 3 — La question décisive (10 min)</strong><br>
            Écrivez en haut de la feuille :<br>
            <em>"Le schéma que j\'ai hérité de ma lignée et que je refuse de transmettre est :"</em><br>
            Complétez en une phrase. Une seule. La plus honnête possible.<br><br>
            <em>Cette cartographie n\'est pas un procès. C\'est une lecture de carte avant un voyage.<br>
            On ne peut choisir un autre chemin que si on voit clairement d\'où on vient.</em>',
            false
        );

        /* ── EXERCICE 2 : Protocole de rupture du cycle ────────────── */
        $ex2 = $this->exercice($teal, '②', 'Le protocole de rupture du cycle — ça s\'arrête avec moi',
            '<strong>Vous venez de cartographier votre lignée. Maintenant : un acte concret cette semaine.</strong><br><br>
            <strong>CHOISISSEZ UN acte — celui qui vous correspond :</strong><br><br>
            🔵 <strong>Si vous êtes parent :</strong><br>
            → Ce soir : 20 minutes sans écran, entièrement présent(e) avec votre enfant.<br>
            Pas d\'activité planifiée. Juste : <em>"Qu\'est-ce qui te rend heureux(se) en ce moment ?"</em><br>
            Écoutez jusqu\'au bout. Sans donner de conseil. Sans regarder votre téléphone.<br><br>
            🟠 <strong>Si vos parents sont encore vivants :</strong><br>
            → Cette semaine : appelez (pas un message — un appel) un de vos parents.<br>
            Pas pour une raison pratique. Juste pour dire :<br>
            <em>"Je pensais à toi. Comment tu vas — vraiment ?"</em><br>
            Donnez-leur 15 minutes. Sans regarder l\'heure.<br><br>
            🟣 <strong>Si la relation est cassée ou toxique :</strong><br>
            → Ne forcez pas le contact — mais écrivez dans un cahier privé :<br>
            <em>"Ce que je choisis de ne plus reproduire dans ma propre vie, c\'est..."</em><br>
            C\'est aussi une rupture du cycle. Elle commence en vous.<br><br>
            🟢 <strong>Engagement de clôture :</strong><br>
            Écrivez sur un post-it, visible chez vous :<br>
            <em>"Dans ma famille, le cycle de [...] s\'arrête avec moi."</em><br><br>
            <em>Vous n\'avez pas choisi votre point de départ. Vous choisissez votre direction.</em>',
            false
        );

        /* ── EXERCICE 3 : Réparer le lien maintenant ─────────────── */
        $ex3 = $this->exercice($orange, '③', 'Réparer le lien maintenant — pour les familles en situation de rupture, de violence ou de séparation',
            '<em>Cet exercice s\'adresse à ceux qui vivent ce que ce module décrit — pas comme concept, mais comme réalité quotidienne.<br>
            Séparé(e). Enfants suivis par des professionnels. Parent qui se remet en question. Lien abîmé. Il n\'est pas trop tard.</em><br><br>
            <strong>Ce que la science dit d\'abord — pour ne pas commencer par la culpabilité</strong><br>
            Edward Tronick (<em>Still Face Experiment</em>, Harvard, 1975) a documenté quelque chose de fondamental :<br>
            ce qui construit l\'attachement sécure d\'un enfant n\'est <strong>pas l\'absence d\'erreurs</strong>.<br>
            C\'est la <strong>qualité de la réparation après l\'erreur</strong>.<br>
            Les enfants dont les parents réparent leurs ratés relationnels — même petits — développent un attachement plus solide<br>
            que ceux dont les parents ne font jamais d\'erreurs.<br>
            <strong>La réparation est plus précieuse que la perfection.</strong><br>
            Vous n\'avez pas besoin d\'avoir tout fait juste. Vous avez besoin de commencer à réparer.<br><br>
            <div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;border-left:3px solid rgba(249,115,22,.4);">
            <strong>PARTIE 1 — Si vous criez, si vous avez crié : la réparation ce soir</strong><br><br>
            Kristin Neff (Univ. Texas, <em>Self-Compassion</em>, 2011) :<br>
            La honte ne change pas le comportement. Elle le fige.<br>
            Ce n\'est pas se pardonner facilement — c\'est s\'accorder la même compréhension qu\'on donnerait à un ami.<br>
            Pour changer, il faut voir clairement, pas rougir de honte dans le noir.<br><br>
            <strong>Ce soir, si vous avez crié :</strong><br>
            · Attendez que le calme soit revenu — pas avant.<br>
            · Allez vers l\'enfant. Pas pour expliquer. Pas pour vous justifier.<br>
            · Dites simplement, en le/la regardant :<br>
            <em>"Tout à l\'heure, j\'ai crié. Ce n\'était pas bien. Tu n\'y étais pour rien. Je travaille là-dessus."</em><br>
            · Posez la main sur son épaule si il/elle le permet. Restez une minute. Sans parler.<br><br>
            Ce n\'est pas une capitulation. C\'est exactement ce que Tronick a documenté comme acte de réparation.<br>
            Fait de façon régulière, cela transmet à l\'enfant quelque chose d\'inestimable :<br>
            <em>les adultes peuvent se tromper. Ils peuvent le reconnaître. Et le lien survit à l\'erreur.</em><br>
            C\'est le fondement de la santé relationnelle pour toute sa vie future.
            </div>
            <div style="background:rgba(99,102,241,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;border-left:3px solid rgba(99,102,241,.4);">
            <strong>PARTIE 2 — Si vos enfants sont suivis en CMP ou par un thérapeute</strong><br><br>
            Dan Siegel (UCLA, <em>The Whole-Brain Child</em>, 2011) :<br>
            Le cerveau d\'un enfant traumatisé a besoin dans cet ordre précis :<br>
            1. <strong>Sécurité physique et émotionnelle</strong> — votre foyer est un endroit où on ne le frappe pas, où on ne le rabaisse pas<br>
            2. <strong>Connexion relationnelle</strong> — vous êtes là, stable, prévisible, disponible<br>
            3. <strong>Sens</strong> — comprendre ce qui s\'est passé, mettre des mots<br>
            Vous ne pouvez pas sauter les étapes. Le thérapeute travaille sur le n°3.<br>
            <strong>Votre rôle irremplaçable est le n°1 et le n°2.</strong><br><br>
            <strong>Ce que vous faites chaque jour qui complète la thérapie :</strong><br>
            · Ne pas interroger l\'enfant sur ses séances CMP — laissez le thérapeute tenir cet espace<br>
            · Dire chaque soir, simplement : <em>"Je suis là. Tu es en sécurité ici."</em> (même si ça semble banal)<br>
            · Maintenir des rituels fixes : même heure de repas, même heure de coucher — la prévisibilité <strong>recâble</strong> un système nerveux traumatisé<br>
            · Si l\'enfant explose, régresse ou est difficile : c\'est souvent le signe que la thérapie avance. Le corps libère.<br>
            Tenez. Ne répondez pas à l\'explosion par une explosion.<br>
            · Une fois par semaine : 20 minutes d\'activité choisie par l\'enfant. Pas d\'écrans. Présence complète.
            </div>
            <div style="background:rgba(20,184,166,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;border-left:3px solid rgba(20,184,166,.4);">
            <strong>PARTIE 3 — La co-parentalité quand l\'autre parent a été violent</strong><br><br>
            Trois vérités difficiles à tenir ensemble :<br><br>
            <strong>Vérité 1 :</strong> Vous ne pouvez pas réparer ce que l\'autre parent a cassé. Ce n\'est pas votre travail. Ce n\'est pas votre responsabilité. C\'est la sienne — si jamais il en devient capable.<br><br>
            <strong>Vérité 2 :</strong> Ne pas parler en mal de l\'autre parent devant l\'enfant — <strong>pas pour protéger l\'autre parent, mais pour protéger l\'enfant.</strong><br>
            Un enfant est fait de ses deux parents. Quand on détruit l\'un, on abîme une partie de l\'identité de l\'enfant.<br>
            Vous pouvez nommer les faits sobrement si l\'enfant pose des questions : <em>"Ton père a fait des choses qui n\'étaient pas acceptables. Des professionnels s\'occupent de cela."</em><br>
            Pas de procès. Pas de silence non plus. La vérité sans la haine.<br><br>
            <strong>Vérité 3 :</strong> Votre foyer est maintenant le seul espace que vous contrôlez entièrement.<br>
            Concentrez toute votre énergie là. Pas sur ce que l\'autre fait ou ne fait pas.<br>
            Un parent stable, présent, sécurisant — dans un seul foyer — suffit à réparer énormément.
            </div>
            <strong>L\'engagement de la semaine — choisissez un seul acte :</strong><br>
            🟠 <strong>Si vous avez crié cette semaine :</strong> faites la réparation ce soir. Une phrase. Une minute. Répétez chaque fois.<br>
            🔵 <strong>Si vos enfants sont en thérapie :</strong> instaurez UN rituel fixe dès demain — même heure, chaque jour.<br>
            🟣 <strong>Si vous êtes épuisé(e) :</strong> écrivez dans un cahier privé : <em>"Ce que je fais bien pour mes enfants en ce moment, c\'est..."</em><br>
            La honte paralyse. La reconnaissance de ce qu\'on fait — même imparfaitement — donne la force de continuer.<br><br>
            <em>Vous n\'avez pas à avoir tout réparé pour commencer à réparer.<br>
            Vous n\'avez pas à être parfait(e) pour être suffisamment bon(ne).<br>
            L\'enfant qui voit son parent se lever après une erreur, reconnaître, recommencer —<br>
            cet enfant apprend la chose la plus précieuse qui soit :<br>
            <strong>qu\'on peut tomber. Et qu\'on se relève. Et que le lien tient.</strong></em>',
            false
        );

        /* ── EXERCICE 4 : Le Récit des Ancêtres ──────────────────── */
        $ex4 = $this->exercice($gold, '④', 'Le Récit des Ancêtres — installer la résilience par l\'histoire familiale',
            '<strong>La découverte la plus surprenante de la psychologie du développement de ces 25 dernières années</strong><br><br>
            Marshall Duke et Robyn Fivush (Université Emory, 2001) ont cherché pendant des années quel facteur unique prédit le mieux la résilience d\'un enfant face à l\'adversité.<br>
            Ce n\'était pas le revenu familial. Pas le niveau d\'études des parents. Pas les activités extrascolaires.<br><br>
            C\'était <strong>la quantité d\'histoires familiales que l\'enfant connaissait</strong> — et particulièrement les histoires de difficulté surmontée.<br><br>
            Ils ont créé l\'échelle <em>Do You Know?</em> — 20 questions simples :<br>
            <em>"Sais-tu comment tes grands-parents se sont rencontrés ? Sais-tu ce que ton père faisait quand il était enfant ? Sais-tu d\'où vient ton prénom ? Sais-tu comment ta famille a traversé telle période difficile ?"</em><br><br>
            Les enfants qui obtenaient des scores élevés sur cette échelle avaient :<br>
            · Une estime de soi significativement plus haute<br>
            · Un lieu de contrôle interne plus développé — <em>"je peux agir sur ma vie"</em><br>
            · Moins d\'anxiété chronique, moins de dépression<br>
            · Une meilleure capacité à traverser les crises — divorces, maladies, échecs<br><br>
            Pourquoi ? Parce que ces enfants avaient intégré quelque chose de fondamental :<br>
            <strong><em>"Je viens de gens qui ont souffert. Et qui ont tenu. Ce fil-là, je l\'ai en moi."</em></strong><br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;border-left:3px solid rgba(201,168,76,.5);">
            <strong>LE PROTOCOLE — Le Récit du Mercredi (ou du dimanche, ou du n\'importe quel soir fixe)</strong><br><br>
            <strong>Durée :</strong> 20 minutes. Même heure. Même lieu. Régulier.<br><br>
            <strong>Étape 1 — Choisir l\'histoire</strong><br>
            Un parent, un grand-parent, un oncle, une tante — n\'importe quel adulte de la famille — raconte UNE histoire.<br>
            Pas une belle histoire. Une vraie histoire. Avec cette structure obligatoire :<br>
            · Ce qui s\'est passé (les faits, sans embellissement)<br>
            · Ce qui a été difficile (nommer la peur, la honte, le manque, la perte — vraiment)<br>
            · Ce que la personne a fait malgré tout<br>
            · Comment la famille s\'en est sortie (ou comment elle a continué même sans s\'en sortir vraiment)<br><br>
            <strong>Étape 2 — L\'enfant re-raconte</strong><br>
            Dans ses propres mots. Immédiatement après. Même maladroitement.<br>
            Ne corrigez pas. Laissez sa version exister.<br>
            C\'est la ré-narration qui installe l\'histoire dans sa mémoire à long terme.<br><br>
            <strong>Étape 3 — La phrase de transmission</strong><br>
            Le parent dit, simplement :<br>
            <em>"Tu viens de ces gens-là. Leur force, tu l\'as déjà. Tu ne le sais pas encore — mais elle est là."</em><br>
            Pas plus. Pas moins.<br><br>
            <strong>Variantes selon l\'âge :</strong><br>
            · 4–7 ans : une seule anecdote courte, illustrée si possible par une photo<br>
            · 8–12 ans : l\'histoire complète, avec les émotions nommées<br>
            · 13 ans et + : invitez l\'adolescent à POSER des questions, à interviewer le grand-parent, à filmer sur téléphone<br>
            · Famille séparée : chaque foyer a ses propres histoires. On n\'a pas besoin de l\'autre parent pour transmettre une lignée.<br><br>
            <strong>Pour les familles d\'immigration :</strong><br>
            Vous avez les histoires les plus puissantes qui soient — traversées, arrachements, reconstitutions.<br>
            Ces histoires ne sont pas des hontes à taire. Elles sont la matière première de la résilience de vos enfants.<br>
            Un enfant qui sait que son grand-père est arrivé avec rien et a reconstruit — cet enfant sait qu\'il peut traverser.
            </div>
            <strong>L\'engagement :</strong> choisissez UNE histoire de votre famille — une vraie, pas une belle — et racontez-la cette semaine.',
            false
        );

        /* ── EXERCICE 5 : Le Mot de Code ─────────────────────────── */
        $ex5 = $this->exercice($purple, '⑤', 'Le Mot de Code — arrêter l\'escalade avant qu\'elle commence',
            '<strong>Ce que Gottman a mesuré sur 40 ans dans des centaines de familles</strong><br><br>
            John Gottman (University of Washington) a passé 40 ans à filmer des familles — parents/enfants, couples — et à prédire avec une précision de 94 % lesquelles allaient rester stables ou se désintégrer.<br><br>
            Sa découverte centrale : <strong>les familles stables ne se disputent pas moins que les autres.</strong><br>
            Elles réparent plus vite. Et elles réparent avec un <em>langage partagé</em>.<br><br>
            Il a nommé ces outils de désescalade les <strong>"repair attempts"</strong> — les tentatives de réparation.<br>
            Une blague. Un geste. Un mot. Une phrase convenue. N\'importe quoi qui signale :<br>
            <em>"Je suis en train de partir dans quelque chose de néfaste — et je veux en sortir avant d\'aller trop loin."</em><br><br>
            Le problème dans la plupart des familles : personne n\'a de <em>langage partagé</em> pour ça.<br>
            Quand la tension monte, tout le monde improvise dans le chaos. Ou se tait. Ou explose.<br><br>
            <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;border-left:3px solid rgba(168,85,247,.5);">
            <strong>LE PROTOCOLE — Créer le Mot de Code de votre famille</strong><br><br>
            <strong>Étape 1 — La réunion fondatrice (30 minutes, une seule fois)</strong><br>
            Installez-vous autour d\'une table — tous les membres de la famille capables de comprendre (dès 5-6 ans).<br>
            Posez la question sur la table : <em>"Qu\'est-ce qu\'on fait quand ça part en vrille ? Qu\'est-ce qu\'on fait quand on sent qu\'on va dire quelque chose qu\'on regrettera ?"</em><br><br>
            <strong>Étape 2 — Choisir le mot ensemble</strong><br>
            Il doit être :<br>
            · Absurde ou drôle — jamais sérieux, c\'est volontaire (l\'humour désamorce neurologiquement)<br>
            · Facile à dire en une seconde, même au milieu d\'une crise<br>
            · Choisi PAR les enfants — c\'est crucial pour qu\'ils l\'utilisent<br><br>
            Exemples réels de familles : "ananas", "Budapest", "cornichon", "niveau 5", "pause café".<br>
            Le vôtre sera le vôtre. Plus il est personnalisé à votre famille, plus il fonctionne.<br><br>
            <strong>Étape 3 — Les règles du mot</strong><br>
            Décidez ensemble et notez sur un papier affiché :<br>
            · Quand quelqu\'un dit le mot, <strong>tout s\'arrête</strong> — sans négociation, sans "mais j\'avais raison"<br>
            · La personne qui a dit le mot prend 10 minutes (minuteur visible)<br>
            · Après les 10 minutes, on peut reprendre — ou pas. Souvent, on n\'a plus besoin.<br>
            · Le mot ne peut PAS être utilisé pour esquiver une conversation importante. Il signale un pause, pas un refus définitif.<br><br>
            <strong>Étape 4 — S\'entraîner à froid</strong><br>
            Faites une fausse dispute — jouez la comédie. Puis quelqu\'un dit le mot. Riez.<br>
            Le cerveau a besoin de mémoriser le mot dans un contexte positif avant de pouvoir le retrouver sous stress.<br><br>
            <strong>Étape 5 — Le bilan mensuel</strong><br>
            Une fois par mois, 5 minutes : "Le mot a-t-il été utilisé ? Est-ce qu\'il a fonctionné ? Faut-il en choisir un autre ?"<br>
            Un mot qui ne fonctionne plus se remplace. Sans drame.<br><br>
            <strong>Pour les familles séparées :</strong><br>
            Chaque foyer peut avoir son propre mot. L\'enfant n\'a pas besoin que les deux parents utilisent le même.<br>
            Ce qui compte : qu\'il ait UN espace dans lequel une règle partagée existe.
            </div>
            <strong>À faire cette semaine :</strong> proposez à votre/vos enfant(s) de créer le mot. Laissez-les le choisir entièrement. Notez-le. Affichez-le.',
            false
        );

        /* ── EXERCICE 6 : L\'Installation de Mémoire Positive ─────── */
        $ex6 = $this->exercice($teal, '⑥', 'L\'Installation de Mémoire — rééquilibrer neurologiquement ce que la famille retient',
            '<strong>Pourquoi les familles se souviennent surtout des conflits — et comment changer ça</strong><br><br>
            Rick Hanson (Université de Californie, Berkeley — <em>Hardwiring Happiness</em>, 2013) a synthétisé 30 ans de recherche en neuroscience sur un fait brutal :<br><br>
            Le cerveau humain est câblé pour retenir le négatif de façon <strong>5 à 20 fois plus forte</strong> que le positif.<br>
            C\'est de l\'évolution : nos ancêtres survivaient en se souvenant des dangers, pas des couchers de soleil.<br><br>
            Conséquence concrète dans une famille :<br>
            Un conflit de 5 minutes laisse une trace mémorielle équivalente à <strong>25 à 100 minutes de moments positifs</strong>.<br>
            Ce n\'est pas une question de caractère ou de mauvaise volonté.<br>
            C\'est de la neurologie de base. Le cerveau fait exactement ce pour quoi il a été conçu.<br><br>
            Résultat : après des années, les familles se retrouvent avec une mémoire collective surtout constituée de tensions, de reproches, de cris —<br>
            <strong>même si les moments de tendresse et de connexion étaient réels et fréquents.</strong><br>
            Ils n\'ont simplement pas été <em>installés</em>.<br><br>
            Hanson a développé le protocole <strong>HEAL</strong> pour corriger ce déséquilibre neurologique :<br>
            <strong>H</strong>ave a positive experience → <strong>E</strong>nrich it → <strong>A</strong>bsorb it → <strong>L</strong>ink it<br><br>
            <div style="background:rgba(20,184,166,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;border-left:3px solid rgba(20,184,166,.5);">
            <strong>LE PROTOCOLE — L\'Installation du Soir (3 minutes, chaque soir)</strong><br><br>
            Ce n\'est pas "raconter ce qui était bien aujourd\'hui" — formule trop vague pour encoder quoi que ce soit.<br>
            C\'est un protocole en 4 étapes précises :<br><br>
            <strong>H — Avoir l\'expérience :</strong> chaque membre de la famille nomme UN moment de la journée — minuscule, pas forcément spectaculaire. Un sourire dans le couloir. Un repas mangé ensemble. Une blague. Une seconde de calme.<br>
            Règle : pas de compétition, pas de hiérarchie entre les moments. Le moment de l\'enfant de 6 ans vaut autant que celui de l\'adulte.<br><br>
            <strong>E — Enrichir :</strong> restez dans ce moment <strong>30 secondes minimum</strong>. Décrivez-le avec des détails sensoriels. Où étiez-vous ? Qu\'est-ce que vous avez ressenti dans le corps ? Quelle couleur, quelle lumière, quel son ?<br>
            Ce délai de 30 secondes est non négociable : en dessous, le circuit de mémorisation à long terme ne s\'active pas (recherche de consolidation de la mémoire — Cahill & McGaugh, UC Irvine, 1996).<br><br>
            <strong>A — Absorber :</strong> une main sur la poitrine. Trois respirations lentes. Imaginez que ce moment entre dans votre corps et reste là.<br>
            Ce n\'est pas de la spiritualité — c\'est de la neurologie : l\'association d\'une sensation corporelle à un souvenir renforce son encodage (James McGaugh).<br><br>
            <strong>L — Lier :</strong> facultatif mais puissant. Reliez ce moment à un souvenir plus ancien, positif lui aussi.<br>
            <em>"Ça me rappelle ce soir où..."</em> — le réseau neurologique associatif amplifie les deux souvenirs simultanément.<br><br>
            <strong>Variantes selon le contexte :</strong><br>
            · <strong>Enfants 4–8 ans :</strong> dessinez ensemble le moment sur un carnet dédié — un dessin rapide suffit. Le dessin force le cerveau à re-créer la scène en détail = encodage renforcé.<br>
            · <strong>Adolescents réticents :</strong> ne forcez pas la parole. Proposez juste de regarder ensemble 5 photos de téléphone de la semaine et de choisir une. L\'image fait le travail.<br>
            · <strong>Familles en crise :</strong> si la semaine a été difficile et qu\'il n\'y a pas eu de "bon moment" — choisissez le moins mauvais. Un moment neutre peut être installé comme ancre de stabilité. La neutralité n\'est pas un échec.<br>
            · <strong>Familles séparées :</strong> faites le protocole dans votre foyer, avec vos enfants, pour vos moments. Vous ne reconstruisez pas "la famille" — vous construisez UN lien solide, dans UN espace. C\'est suffisant. C\'est même tout.<br><br>
            <strong>Ce que ce protocole produit sur 3 mois :</strong><br>
            Hanson a documenté chez des familles pratiquant ce type de protocole quotidien :<br>
            · Une réduction de la rumination négative (mémoire de conflits) de 30 à 40 %<br>
            · Une augmentation de la "densité mémorielle positive" — les enfants et parents se souviennent de plus en plus des moments de connexion<br>
            · Un effet de "ressource" en cas de crise : quand la tension monte, le cerveau a des ancres positives réelles vers lesquelles se tourner — pas des abstractions, des souvenirs incarnés<br>
            La mémoire familiale n\'est pas un témoin passif de ce qui s\'est passé.<br>
            <strong>Elle est construite. Elle est choisie. Elle est un outil.</strong>
            </div>
            <strong>Ce soir :</strong> faites-le. Juste une fois. Trois minutes. Un moment. Trente secondes d\'attention. Voyez ce qui se passe.',
            false
        );

        /* ── EXERCICE 7 : L\'Entretien d\'Écoute ──────────────────── */
        $ex7 = $this->exercice($indigo, '⑦', 'L\'Entretien d\'Écoute — la compétence parentale la plus sous-estimée et la plus documentée',
            '<strong>Ce que Gottman a trouvé en filmant des milliers de familles pendant 40 ans</strong><br><br>
            John Gottman (University of Washington) a identifié deux types de parents selon leur réponse aux émotions de leurs enfants :<br><br>
            <strong>Les parents "Emotion Dismissing"</strong> — qui dévalorisent, minimisent, ou court-circuitent l\'émotion :<br>
            <em>"Arrête de pleurer pour ça." / "C\'est rien." / "T\'as qu\'à ne plus aller avec lui." / "Raisonne-toi."</em><br>
            Ces réponses semblent logiques. Elles sont en réalité destructrices.<br><br>
            <strong>Les parents "Emotion Coaching"</strong> — qui accueillent l\'émotion avant de résoudre :<br>
            <em>"Je vois que tu es vraiment en colère. Dis-moi ce qui s\'est passé." → Silence. → Écoute. → "C\'est dur." → Plus tard : "Qu\'est-ce qui pourrait aider ?"</em><br><br>
            Gottman a mesuré sur les enfants de parents "emotion coaching" :<br>
            · Meilleure performance scolaire<br>
            · <strong>Meilleure immunité mesurée dans le sang</strong> (taux d\'IgA salivaire) — c\'est là que la plupart des gens s\'arrêtent, incrédules<br>
            · Moins de troubles du comportement<br>
            · Meilleures relations avec les pairs<br>
            · Plus grande résilience face à l\'adversité<br><br>
            Ce n\'est pas une corrélation. C\'est une relation causale documentée sur des milliers de familles.<br>
            <strong>La manière dont vous répondez à l\'émotion de votre enfant change sa biologie.</strong><br><br>
            <div style="background:rgba(99,102,241,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;border-left:3px solid rgba(99,102,241,.5);">
            <strong>LES 5 NIVEAUX DE RÉPONSE — Où êtes-vous habituellement ?</strong><br><br>
            <strong>Niveau 1 — Résoudre immédiatement</strong> (le plus fréquent)<br>
            <em>"Tu as un problème avec Jules ? Parle-lui directement. C\'est simple."</em><br>
            Signal envoyé à l\'enfant : <em>"Ton émotion est un obstacle à traiter, pas une réalité à respecter."</em><br><br>
            <strong>Niveau 2 — Minimiser</strong><br>
            <em>"C\'est rien ça. Les autres ont de vrais problèmes."</em><br>
            Signal envoyé : <em>"Ce que tu ressens n\'est pas valide."</em><br><br>
            <strong>Niveau 3 — Corriger</strong><br>
            <em>"Tu n\'aurais pas dû faire ça. C\'est ta faute si ça s\'est passé comme ça."</em><br>
            Signal envoyé : <em>"Je suis ton juge, pas ton allié."</em><br><br>
            <strong>Niveau 4 — Accueillir</strong><br>
            <em>"Je t\'entends. C\'est difficile."</em> — suivi d\'un silence réel.<br>
            Signal envoyé : <em>"Tu peux ressentir ça ici. Tu ne risques rien."</em><br><br>
            <strong>Niveau 5 — Nommer et accompagner</strong><br>
            <em>"Tu as l\'air vraiment blessé par ce qu\'il a dit. Je me trompe ?"</em> → Silence. → <em>"Qu\'est-ce qui t\'a le plus touché ?"</em><br>
            Signal envoyé : <em>"Je veux comprendre ton monde intérieur, pas juste réparer la surface."</em><br><br>
            La solution vient après — pas avant.<br><br>
            <strong>LE PROTOCOLE — 10 jours d\'entraînement</strong><br><br>
            <strong>Jours 1–3 : Observer seulement</strong><br>
            Pendant 3 jours, ne changez rien. Notez simplement mentalement à quel niveau vous répondez habituellement.<br>
            Sans jugement. Sans honte. Juste l\'observation honnête.<br>
            La plupart des parents découvrent qu\'ils sont presque toujours au niveau 1, 2 ou 3.<br>
            Ce n\'est pas un échec — c\'est exactement ce qu\'on nous a appris.<br><br>
            <strong>Jours 4–7 : Une réponse par jour au niveau 4</strong><br>
            Une seule fois par jour, choisissez délibérément de répondre au niveau 4.<br>
            La phrase d\'ancrage : <em>"Je t\'entends. Continue."</em><br>
            Comptez jusqu\'à 5 en silence après. Ne remplissez pas le silence. Laissez l\'enfant l\'occuper.<br><br>
            <strong>Jours 8–10 : Ajouter la nomination</strong><br>
            Tentez une fois par jour la question de nomination : <em>"Tu sembles [triste/en colère/blessé/perdu]. C\'est ça ?"</em><br>
            Si vous vous trompez sur l\'émotion, l\'enfant vous corrigera. C\'est excellent — ça lui apprend à identifier ce qu\'il ressent vraiment.<br><br>
            <strong>Ce qui va se passer :</strong><br>
            Dans les 10 jours, la quantité et la profondeur des confidences de votre enfant va changer.<br>
            Les adolescents fermés depuis des mois commencent parfois à parler dans la première semaine.<br>
            Pas parce que vous avez posé les bonnes questions — mais parce que vous avez arrêté de fermer l\'espace avec des réponses.<br><br>
            <strong>Pour les familles en crise ou post-violence :</strong><br>
            Un enfant traumatisé ne confie pas — il teste d\'abord. Il lâche un détail. Si vous réagissez au niveau 1, 2 ou 3, le test échoue et il referme tout pour des semaines.<br>
            Si vous réagissez au niveau 4 ou 5, le test réussit. Et il en lâche un peu plus. C\'est ainsi que les enfants traumatisés ouvrent progressivement la porte.
            </div>
            <strong>Cette semaine :</strong> identifiez votre niveau de réponse habituel. Puis pratiquez une seule fois au niveau 4. Une phrase. Un silence.',
            false
        );

        /* ── EXERCICE 8 : La Cartographie du Corps Émotionnel ─────── */
        $ex8 = $this->exercice($red, '⑧', 'La Cartographie du Corps Émotionnel — donner une adresse à ce qui n\'a pas de mots',
            '<strong>La découverte de Nummenmaa — et ce qu\'elle change pour les familles</strong><br><br>
            Lauri Nummenmaa et son équipe (Université Aalto, Finlande — <em>Proceedings of the National Academy of Sciences</em>, 2014) ont mené une étude sur 700 participants issus de <strong>5 cultures différentes</strong> (Finlande, Suède, Taïwan, Grèce, Mexique).<br>
            Ils leur ont demandé de colorier sur une silhouette du corps humain les zones activées ou désactivées par 14 émotions différentes.<br><br>
            Le résultat a surpris la communauté scientifique :<br>
            Les cartes émotionnelles corporelles étaient <strong>quasi-identiques entre toutes les cultures</strong>.<br>
            La colère : chaleur dans le haut du corps et les bras. La peur : poitrine et ventre. La tristesse : poitrine creuse, jambes lourdes. La joie : lumière dans tout le corps sauf les extrémités.<br><br>
            Traduction concrète pour les familles :<br>
            Quand un enfant dit "je ne sais pas ce que je ressens" — ce n\'est pas de la mauvaise volonté.<br>
            La région verbale du cerveau s\'est déconnectée de la région émotionnelle (c\'est documenté en IRMf sous stress — Broca se désactive).<br>
            Mais le <strong>corps</strong>, lui, sait toujours. Il a enregistré.<br><br>
            Dan Siegel (<em>Brainstorm</em>, 2013) : les enfants qui peuvent localiser physiquement une émotion dans leur corps la régulent <strong>trois fois mieux</strong> que ceux qui ne peuvent que la nommer verbalement.<br>
            "Nommer pour apprivoiser" (Name it to tame it) commence par le corps — pas par les mots.<br><br>
            <div style="background:rgba(239,68,68,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;border-left:3px solid rgba(239,68,68,.5);">
            <strong>LE PROTOCOLE — La Carte du Corps de votre famille</strong><br><br>
            <strong>Matériel nécessaire :</strong> une feuille A4 par personne, des crayons de couleur. Rien d\'autre.<br><br>
            <strong>Étape 1 — Dessiner la silhouette (2 min)</strong><br>
            Tracez simplement le contour d\'un corps humain. Pas besoin d\'être précis. Un bonhomme suffit.<br>
            Chaque membre de la famille (capable de tenir un crayon) fait le sien.<br><br>
            <strong>Étape 2 — La question des émotions difficiles (5 min)</strong><br>
            Posez la question : <em>"Quand tu es vraiment en colère (ou triste / ou effrayé) — où dans ton corps tu le sens ?"</em><br>
            Chacun colorie sa zone sur sa silhouette. Couleur libre. Intensité libre.<br>
            Ne commentez pas les dessins des autres. Ne corrigez pas. Chaque carte est vraie.<br><br>
            <strong>Étape 3 — La question de l\'émotion positive (5 min)</strong><br>
            Même question : <em>"Quand tu te sens vraiment bien, aimé, en sécurité — où dans ton corps tu le ressens ?"</em><br>
            Chacun colorie cette zone avec une autre couleur — sa couleur de sécurité.<br><br>
            <strong>Étape 4 — Le Point d\'Ancrage (2 min)</strong><br>
            Chacun place son doigt sur sa zone de sécurité sur le dessin.<br>
            Puis sur son vrai corps — au même endroit.<br>
            Respirez ensemble 3 fois.<br>
            C\'est le Point d\'Ancrage personnel. Il peut être utilisé en 10 secondes n\'importe où, n\'importe quand.<br><br>
            <strong>Étape 5 — Afficher (facultatif mais puissant)</strong><br>
            Collez les cartes quelque part visible — sur un mur de chambre, le frigo.<br>
            Pas comme décoration. Comme langage.<br>
            Quand un enfant est en crise, vous pouvez dire simplement : <em>"C\'est dans ta poitrine ?"</em><br>
            Il n\'a pas à parler. Il hoche la tête. Et le lien s\'est créé sans mots.<br><br>
            <strong>Usage quotidien — le "check corporel" de 30 secondes</strong><br>
            Les soirs où la journée a été difficile :<br>
            <em>"Fermez les yeux. Faites le tour de votre corps. Où y a-t-il de la tension ce soir ? Où y a-t-il de la légèreté ?"</em><br>
            30 secondes. Chacun pour lui-même. Pas de partage obligatoire.<br>
            Juste l\'habitude de consulter son corps comme une source d\'information, pas comme un problème à gérer.<br><br>
            <strong>Pour les enfants traumatisés :</strong><br>
            Les enfants qui ont subi des violences physiques ont souvent une relation dissociée à leur corps —<br>
            ils ont appris à le "quitter" mentalement pour traverser la douleur.<br>
            Ce protocole est l\'un des outils recommandés en première ligne par les thérapeutes spécialisés en trauma somatique (Peter Levine, <em>Somatic Experiencing</em>) pour <strong>reconstruire le sentiment d\'habiter son corps en sécurité</strong>.<br>
            Ne forcez pas. Proposez. Si l\'enfant refuse, c\'est une information précieuse — pas un échec.<br><br>
            <strong>Pour les parents :</strong><br>
            Faites-le vous-même d\'abord. Seul. Avant de le proposer à vos enfants.<br>
            Beaucoup de parents découvrent en faisant l\'exercice qu\'ils n\'ont aucune idée d\'où ils vivent leurs propres émotions dans leur corps.<br>
            C\'est un point de départ, pas une lacune.
            </div>
            <strong>À faire maintenant :</strong> prenez une feuille. Tracez un corps. Posez-vous la question de la colère. Colorez. Faites-la la même chose avec la sécurité. Gardez les deux dessins.',
            false
        );

        /* ── EXERCICE 9 : La Reconnaissance du Tort ──────────────── */
        $ex9 = $this->exercice($orange, '⑨', 'La Reconnaissance du Tort — l\'acte le plus difficile et le plus libérateur',
            '<em>Ce n\'est pas un exercice de communication. C\'est un acte de courage moral.<br>
            Harriet Lerner a passé 40 ans à étudier pourquoi les excuses qui blessent au lieu de guérir. Voici la différence.</em><br><br>
            <strong>Pourquoi presque toutes les excuses ratent leur cible</strong><br><br>
            Harriet Lerner (Université du Kansas — <em>Why Won\'t You Apologize?</em>, 2017) a documenté que la majorité des excuses données dans les familles contiennent une ou plusieurs des défenses suivantes :<br><br>
            · <em>"Je suis désolé, mais tu m\'avais provoqué."</em> — justification<br>
            · <em>"Je suis désolé si tu as été blessé."</em> — conditionnel qui met le tord sur l\'enfant<br>
            · <em>"J\'ai fait ce que je pouvais avec ce que j\'avais."</em> — déflexion vers soi<br>
            · <em>"C\'était pour ton bien."</em> — réinterprétation qui efface la réalité de l\'autre<br>
            · <em>"Maintenant c\'est du passé, tournons la page."</em> — clôture unilatérale<br><br>
            <strong>Chacune de ces phrases inflige une deuxième blessure.</strong><br>
            Elle dit à l\'enfant (ou à l\'adulte en face) : <em>"Ce que tu as vécu n\'est pas réel, ou pas important, ou c\'était ta faute."</em><br><br>
            Bessel van der Kolk (<em>The Body Keeps the Score</em>, 2014) a documenté en IRMf ce qui se passe dans le cerveau d\'une personne traumatisée quand elle entend une fausse excuse :<br>
            les mêmes zones activées par le trauma original se réactivent. L\'excusenrate est neurologiquement plus douloureuse que le silence.<br><br>
            <div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;border-left:3px solid rgba(249,115,22,.5);">
            <strong>LES 5 ÉLÉMENTS D\'UNE RECONNAISSANCE RÉELLE</strong><br>
            (Lerner, 2017 — aucun des 5 n\'est facultatif)<br><br>
            <strong>1 — Nommer ce qui s\'est passé, précisément</strong><br>
            Pas : <em>"Si j\'ai fait des erreurs..."</em><br>
            Mais : <em>"Quand je t\'ai frappé. Quand je t\'ai dit que tu ne valais rien. Quand je suis parti sans revenir."</em><br>
            La vagueur protège celui qui a causé le tort. La précision protège celui qui l\'a subi.<br><br>
            <strong>2 — Nommer l\'impact, tel que l\'autre l\'a vécu — pas tel que vous le supposez</strong><br>
            Pas : <em>"Je sais que j\'ai dû te faire mal."</em><br>
            Mais : <em>"Je voudrais comprendre ce que ça t\'a coûté. Est-ce que tu peux me dire ?"</em> → Puis écouter. Vraiment. Sans se défendre.<br><br>
            <strong>3 — Assumer sans condition</strong><br>
            Pas : <em>"J\'ai fait ça parce que..."</em><br>
            Mais : <em>"J\'étais adulte. J\'étais le parent. C\'était ma responsabilité. Rien ne justifiait ça."</em><br><br>
            <strong>4 — Reconnaître le coût à long terme</strong><br>
            <em>"Je comprends que ça a peut-être changé ta façon de te voir, de faire confiance, de croire que tu mérites d\'être aimé."</em><br>
            Ce n\'est pas de la culpabilité. C\'est de l\'honnêteté.<br><br>
            <strong>5 — Ne pas demander le pardon</strong><br>
            La phrase <em>"est-ce que tu me pardonnes ?"</em> transforme l\'acte de réparation en demande — et remet le fardeau sur l\'enfant.<br>
            La reconnaissance est un acte sans réciprocité attendue. Elle est complète en elle-même.<br>
            <em>"Je ne te demande rien en retour. Je voulais juste que tu saches que je sais."</em><br><br>
            <strong>LE PROTOCOLE — La Conversation de Reconnaissance</strong><br><br>
            <strong>Préparation (seul, avant) :</strong><br>
            Écrivez sur papier, pour vous seul :<br>
            · CE QUE J\'AI FAIT — en précis, sans euphémismes<br>
            · CE QUE JE SUPPOSE QUE ÇA A COÛTÉ — sans minimiser<br>
            · CE QUE JE VEUX DIRE — les 5 éléments, rédigés<br>
            Lisez-le à voix haute, seul. Si vous ne pouvez pas le lire sans chercher à vous défendre — ce n\'est pas encore prêt.<br><br>
            <strong>La conversation :</strong><br>
            Demandez un moment. Pas dans un moment de tension — un moment neutre.<br>
            Dites les choses. Sans anticiper la réaction. Sans surveiller si l\'autre "accepte".<br>
            Si l\'autre répond par la colère : <em>"Tu as raison d\'être en colère. Je t\'écoute."</em><br>
            Si l\'autre répond par le silence : respectez-le. Le silence est souvent la réponse la plus honnête.<br>
            Si l\'autre n\'est pas prêt à vous entendre : écrivez. Envoyez la lettre. Ou gardez-la. L\'acte a sa valeur indépendamment de la réception.
            </div>
            <strong>Cette semaine :</strong> nommez une chose que vous avez faite et qui a blessé. Une seule. Rédigez les 5 éléments. Ne l\'envoyez pas encore si vous n\'êtes pas prêt — mais écrivez-le.',
            false
        );

        /* ── EXERCICE 10 : La Lettre d\'Impact ───────────────────── */
        $ex10 = $this->exercice($purple, '⑩', 'La Lettre d\'Impact — rendre la blessure visible pour que la réparation devienne possible',
            '<em>Cet exercice vient de la justice restaurative. Il est utilisé mondialement avec des victimes de crimes graves.<br>
            Howard Zehr (Université Mennonite de l\'Est — fondateur de la justice restaurative) a documenté un résultat systématique :<br>
            le moment où la personne qui a causé le tort ENTEND ou LIT l\'impact réel de ses actes est le seul moment qui produit une transformation durable.</em><br><br>
            <strong>Ce que la punition ne fait pas — et que l\'impact fait</strong><br><br>
            Howard Zehr (2002) et les recherches sur 40 ans de justice restaurative dans 35 pays montrent :<br>
            · Les personnes condamnées et punies récidivent à 63–70 %<br>
            · Les personnes qui ont participé à un processus restauratif (rencontre avec celui qu\'elles ont blessé, lecture de l\'impact) récidivent à 27 %<br><br>
            Le mécanisme : la punition active la honte — qui se transforme en rage ou en déni.<br>
            L\'impact réel — non censuré, non réduit — active quelque chose que la honte ne peut pas activer : <strong>l\'empathie.</strong><br>
            Et c\'est l\'empathie qui change le comportement. Pas la peur.<br><br>
            James Pennebaker (Université du Texas, 40 ans de recherche sur l\'écriture expressive) a documenté que nommer précisément ce qu\'on a vécu — même quand l\'autre ne le lira jamais — réduit le cortisol, l\'anxiété, les symptômes dépressifs de façon mesurable et durable.<br>
            L\'écriture est une forme de traitement neurologique. Ce qui est nommé peut être rencontré. Ce qui est rencontré peut être traversé.<br><br>
            <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;border-left:3px solid rgba(168,85,247,.5);">
            <strong>POUR CELUI QUI A ÉTÉ BLESSÉ — La Lettre d\'Impact</strong><br><br>
            Vous n\'avez pas à l\'envoyer. Vous n\'avez pas à la montrer. Elle est pour vous d\'abord.<br><br>
            Écrivez en répondant à ces questions — dans l\'ordre :<br><br>
            <em>1. Ce qui s\'est passé — les faits, sans euphémisme ni explication de l\'autre</em><br>
            Pas "il était sous pression" — les faits.<br><br>
            <em>2. Ce que j\'ai ressenti à ce moment-là — dans mon corps, dans ma tête</em><br>
            Nommez les sensations physiques. Pas seulement les émotions abstraites.<br><br>
            <em>3. Ce que ça a changé dans ma façon de me voir</em><br>
            Avez-vous intégré quelque chose de faux sur vous-même ? "Je ne vaux pas grand chose." "Je dois mériter l\'amour." "Je ne peux faire confiance à personne."<br><br>
            <em>4. Ce que ça m\'a coûté — dans mes relations, mes choix, mon corps</em><br>
            Les décisions que vous avez prises à cause de cette blessure. Les relations que vous avez évitées. Les opportunités que vous avez abandonnées.<br><br>
            <em>5. Ce que j\'aurais eu besoin — la vérité sur ce qui aurait changé les choses</em><br>
            Pas pour accuser. Pour informer. Pour vous-même d\'abord.<br><br>
            <em>6. Ce que je veux pour la suite — pour moi, pas pour l\'autre</em><br><br>
            <strong>POUR CELUI QUI A BLESSÉ — La Lecture de l\'Impact</strong><br><br>
            Si l\'autre vous remet une lettre ou vous parle :<br>
            · Lisez ou écoutez jusqu\'au bout sans interrompre<br>
            · Ne défendez pas. Ne justifiez pas. Ne contextualisez pas.<br>
            · Restez assis dans l\'inconfort — c\'est exactement là que la transformation se fait<br>
            · Après : <em>"Merci de m\'avoir dit ça. Je comprends mieux maintenant."</em> — rien de plus<br>
            La tentation de se défendre est le signal que l\'empathie commence à faire son travail. Tenez.<br><br>
            <strong>Si vous êtes seul(e) :</strong><br>
            Écrivez la lettre. Même si personne ne la lira jamais. Pennebaker a documenté l\'effet sur 40 000 participants :<br>
            l\'effet thérapeutique est identique que la lettre soit envoyée, lue, ou brûlée.<br>
            Ce qui compte : la mise en mots complète et non censurée.
            </div>
            <strong>Cette semaine :</strong> écrivez votre lettre d\'impact. Seul. Sans la montrer à personne pour l\'instant. Laissez-la reposer 48h. Relisez. Voyez ce que vous ressentez.',
            false
        );

        /* ── EXERCICE 11 : Le Conseil de Famille ─────────────────── */
        $ex11 = $this->exercice($teal, '⑪', 'Le Conseil de Famille — instaurer une démocratie dans le foyer',
            '<em>Ce n\'est pas une réunion de famille. C\'est une institution.<br>
            Rudolf Dreikurs (Institut Adlérien, Chicago — 40 ans de recherche, 1950–1990) a documenté que les familles qui pratiquent le Conseil ont 70 % moins de conflits récurrents — et des enfants avec une estime de soi mesurée significativement plus haute.</em><br><br>
            <strong>Pourquoi la plupart des familles fonctionnent en dictature bienveillante — et ce que ça coûte</strong><br><br>
            Dans la quasi-totalité des foyers, les décisions qui touchent toute la famille sont prises par un ou deux adultes.<br>
            Les enfants peuvent exprimer leur désaccord — mais n\'ont aucun mécanisme structurel pour être entendus.<br>
            Résultat prévisible : ils s\'expriment par l\'évitement, la résistance passive, ou l\'explosion.<br><br>
            Dreikurs a observé une corrélation directe :<br>
            <strong>un enfant qui a une voix dans les décisions de sa famille n\'a pas besoin de crier pour être entendu.</strong><br>
            Le comportement "difficile" d\'un enfant est souvent la seule forme de pouvoir qu\'il lui reste dans un système qui l\'exclut des décisions.<br><br>
            <div style="background:rgba(20,184,166,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;border-left:3px solid rgba(20,184,166,.5);">
            <strong>LA STRUCTURE DU CONSEIL — 4 règles fondamentales</strong><br><br>
            <strong>Règle 1 — Chaque voix a le même poids, quel que soit l\'âge</strong><br>
            Dès 4–5 ans, un enfant peut participer. Son opinion sur ce qui le concerne est valide.<br>
            Ce n\'est pas du laxisme — c\'est de la démocratie. Un enfant qui sent que sa voix compte obéit différemment : par adhésion, pas par peur.<br><br>
            <strong>Règle 2 — Aucune critique sans proposition</strong><br>
            On ne peut pas dire "ça ne va pas" sans dire "voici ce que je propose à la place".<br>
            Cette règle à elle seule transforme les réunions — elle oblige chacun à passer de la plainte à la construction.<br><br>
            <strong>Règle 3 — Un cahier d\'agenda tenu entre les séances</strong><br>
            N\'importe qui peut inscrire un sujet à tout moment de la semaine.<br>
            Les sujets sont traités au prochain Conseil — pas dans le couloir, pas dans le moment de tension.<br>
            Cette règle déplace les conflits du moment d\'explosion à un espace structuré.<br><br>
            <strong>Règle 4 — Les décisions du Conseil s\'appliquent jusqu\'au prochain Conseil</strong><br>
            Si une règle ne fonctionne pas, elle est discutée au prochain Conseil — pas unilatéralement abandonnée.<br>
            Cela enseigne à l\'enfant quelque chose d\'irremplaçable : les accords se respectent, et ils peuvent être renégociés par la parole.<br><br>
            <strong>LA SESSION TYPE — 20 à 45 minutes, une fois par semaine</strong><br><br>
            <em>Ouverture :</em> chacun dit en une phrase comment il va cette semaine. Sans commentaires des autres.<br><br>
            <em>Remerciements :</em> chacun nomme quelque chose que quelqu\'un d\'autre a fait cette semaine et qu\'il a apprécié.<br>
            Cette étape semble facultative. Elle est centrale. Elle installe un climat de sécurité avant les sujets difficiles.<br><br>
            <em>Ordre du jour :</em> les sujets du cahier, traités un à un. Chacun parle. Propositions. Vote ou consensus.<br><br>
            <em>Planification :</em> une activité ou un moment à partager ensemble avant le prochain Conseil.<br>
            Même 20 minutes ensemble planifiées valent plus que des heures imprévues et distraites.<br><br>
            <em>Clôture :</em> chacun dit en une phrase ce qu\'il emporte du Conseil.<br><br>
            <strong>Ce qui se passe dans les 3 premiers mois :</strong><br>
            · Les disputes spontanées diminuent — parce que les sujets ont un espace dédié<br>
            · Les enfants commencent à inscrire des sujets au lieu d\'exploser<br>
            · Les adultes découvrent ce que leurs enfants vivent vraiment — souvent très différent de ce qu\'ils supposaient<br>
            · Le respect mutuel monte mécaniquement — parce qu\'il est structurellement exercé<br><br>
            <strong>Pour les familles en reconstruction post-violence :</strong><br>
            Le Conseil peut être l\'espace où, pour la première fois, les enfants entendent un parent dire :<br>
            <em>"Je mets ce sujet à l\'ordre du jour : ce qui s\'est passé entre nous. Je veux qu\'on puisse en parler ici."</em><br>
            Ce n\'est pas une thérapie. C\'est une déclaration : <em>cette famille est un espace sûr maintenant.</em>
            </div>
            <strong>À faire cette semaine :</strong> proposez la première séance du Conseil. Expliquez les 4 règles. Laissez les enfants choisir le jour, l\'heure, et l\'endroit — ce choix leur appartient déjà.',
            false
        );

        /* ── EXERCICE 12 : Le Protocole de Ré-attachement ────────── */
        $ex12 = $this->exercice($gold, '⑫', 'Le Protocole de Ré-attachement — recoudre le lien quand il a été déchiré',
            '<em>Sue Johnson (Université d\'Ottawa — Emotionally Focused Therapy, 30 ans de recherche) a développé l\'approche la plus documentée au monde pour reconstruire les liens d\'attachement après une rupture.<br>
            Elle a été adaptée ici pour les relations parent-enfant post-conflit, post-violence, ou post-silence prolongé.</em><br><br>
            <strong>Ce que la plupart des tentatives de réparation ratent</strong><br><br>
            Quand un parent tente de se rapprocher d\'un enfant après une période de conflit ou de violence,<br>
            il part presque toujours du mauvais niveau.<br>
            Il essaie de résoudre le comportement de surface — alors que l\'enfant répond à une blessure d\'attachement profonde.<br><br>
            Sue Johnson appelle ça le "cycle négatif" :<br>
            Le parent s\'approche → l\'enfant se défend (attaque, se ferme, ignore) →<br>
            le parent interprète comme du rejet → le parent recule ou s\'énerve →<br>
            l\'enfant interprète comme une confirmation qu\'il n\'est pas aimable → le cycle se renforce.<br><br>
            <strong>Sous chaque comportement difficile, il y a une question d\'attachement non posée :</strong><br>
            · <em>"Est-ce que je compte pour toi ?"</em><br>
            · <em>"Est-ce que tu seras là si j\'en ai besoin ?"</em><br>
            · <em>"Est-ce que tu me vois vraiment ?"</em><br>
            Tant qu\'on répond au comportement sans répondre à la question sous-jacente, le cycle continue.<br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;border-left:3px solid rgba(201,168,76,.5);">
            <strong>LE PROTOCOLE — Les 3 Questions de Ré-attachement</strong><br><br>
            Ce protocole se pratique quand un moment de calme est possible — pas en plein conflit.<br>
            Il prend 15 à 30 minutes. Il peut être répété autant que nécessaire.<br><br>
            <strong>Question 1 — "Qu\'est-ce qui se passe en toi quand..."</strong><br>
            Pas : <em>"Pourquoi tu fais ça ?"</em> — qui demande une justification<br>
            Mais : <em>"Qu\'est-ce qui se passe en toi quand on se dispute ?"</em><br>
            Ou : <em>"Qu\'est-ce que tu ressens quand je m\'énerve ?"</em><br>
            Laissez l\'espace. Attendez la réponse. L\'enfant ne répondra peut-être pas tout de suite.<br>
            Revenez le lendemain. Et après-demain si nécessaire.<br><br>
            <strong>Question 2 — "Est-ce que j\'ai manqué quelque chose ?"</strong><br>
            <em>"Dans ce qui s\'est passé entre nous — est-ce que j\'ai manqué quelque chose d\'important pour toi ?"</em><br>
            Cette question fait quelque chose de rare dans la relation parent-enfant : elle reconnaît la possibilité de l\'erreur parentale sans forcer une réponse.<br>
            Elle crée un espace dans lequel l\'enfant peut dire ce qu\'il n\'a jamais pu dire.<br><br>
            <strong>Question 3 — "De quoi tu aurais besoin de ma part ?"</strong><br>
            Pas : <em>"Qu\'est-ce que tu veux ?"</em> — trop large<br>
            Mais : <em>"Dans notre relation — de quoi tu aurais besoin de ma part pour que ce soit mieux entre nous ?"</em><br>
            Écoutez. Notez mentalement. Ne répondez pas immédiatement par "je vais essayer de..."<br>
            La réponse juste après cette question : <em>"Merci de me dire ça."</em><br><br>
            <strong>Ce que vous faites avec les réponses :</strong><br>
            Vous en choisissez UNE. La plus petite. La plus concrète.<br>
            Vous la mettez en œuvre la semaine suivante — sans l\'annoncer.<br>
            L\'acte concret vaut plus que la promesse verbale pour un enfant qui a été blessé.<br>
            Il ne fera confiance qu\'à ce qu\'il voit se répéter dans le temps.<br><br>
            <strong>Pour les relations très abîmées — où l\'enfant refuse de parler :</strong><br>
            Ne forcez pas les questions orales. Écrivez-les sur un papier.<br>
            <em>"Je voulais juste te demander ça. Tu n\'as pas à répondre maintenant. Ou jamais. Mais je voulais que tu saches que je me pose ces questions."</em><br>
            Glissez le papier sous la porte si nécessaire.<br>
            Le geste de chercher à comprendre atterrit — même en silence.
            </div>
            <strong>Cette semaine :</strong> posez la Question 1 à un enfant ou à une personne avec qui quelque chose est abîmé. Une seule question. Puis le silence.',
            false
        );

        /* ── EXERCICE 13 : Le Pardon de Stanford ──────────────────── */
        $ex13 = $this->exercice($green, '⑬', 'Le Pardon de Stanford — reprendre sa vie à la blessure qui la gouverne',
            '<em>Fred Luskin a dirigé le Stanford Forgiveness Project de 1999 à 2010.<br>
            Il a travaillé avec des mères de victimes d\'assassinat en Irlande du Nord. Avec des survivants de la guerre civile en Sierra Leone.<br>
            Avec des familles dont les membres s\'étaient entretuées.<br>
            Sa conclusion après 11 ans et des milliers de participants : le pardon est le seul acte qui libère définitivement.</em><br><br>
            <strong>Ce que le pardon n\'est pas — et ce qu\'il est vraiment</strong><br><br>
            <strong>Le pardon n\'est pas :</strong><br>
            · Dire que ce qui a été fait était acceptable<br>
            · Oublier<br>
            · Reprendre contact<br>
            · Donner quelque chose à l\'autre<br>
            · Un acte religieux<br>
            · Une décision que vous prenez une seule fois<br><br>
            <strong>Le pardon est :</strong><br>
            Reprendre le récit de votre vie de la main de la blessure qui le tient.<br>
            Luskin a mesuré sur ses participants : avant le pardon, leur identité centrale était définie par ce qu\'on leur avait fait.<br>
            Après : leur identité était définie par ce qu\'ils choisissaient d\'être.<br><br>
            Il a mesuré physiologiquement :<br>
            · Pression artérielle : −10 à 12 mmHg en moyenne<br>
            · Cortisol (hormone de stress) : −23 % en 6 semaines<br>
            · Symptômes dépressifs : −40 %<br>
            · Douleurs physiques chroniques : −34 % (le lien entre rancœur et douleur somatique est documenté)<br><br>
            <div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;border-left:3px solid rgba(34,197,94,.5);">
            <strong>LE PROTOCOLE DU PARDON EN 6 ÉTAPES</strong><br><br>
            <strong>Étape 1 — Écrire l\'histoire de la blessure sans la censurer</strong><br>
            Tout ce qui s\'est passé. Comment c\'était. Ce que vous avez ressenti. Ce que ça a changé.<br>
            Pas pour l\'envoyer. Pour la voir entière, une fois — et la poser.<br><br>
            <strong>Étape 2 — Identifier la "grievance story"</strong><br>
            Luskin appelle ainsi le récit central que vous vous racontez, souvent sans le savoir :<br>
            <em>"À cause de ce qu\'il/elle m\'a fait, je ne peux pas... / je suis comme ça... / ma vie est comme ça..."</em><br>
            Nommez-la précisément. Une phrase. <em>"Ma grievance story, c\'est : je ne peux pas faire confiance parce que..."</em><br><br>
            <strong>Étape 3 — Mesurer le coût personnel de cette histoire</strong><br>
            Pendez cette histoire un instant. Regardez ce qu\'elle vous a coûté en énergie, en relations, en choix non faits.<br>
            Pas pour culpabiliser d\'avoir souffert — mais pour voir clairement le prix que vous payez à la porter.<br><br>
            <strong>Étape 4 — La distinction entre le fait et l\'histoire</strong><br>
            Le fait : ce qui s\'est passé.<br>
            L\'histoire : ce que vous en avez conclu sur vous-même, sur l\'autre, sur la vie.<br>
            Les faits ne changent pas. L\'histoire peut être réécrite.<br>
            <em>"Ce qui s\'est passé est réel. Ce que j\'en ai conclu n\'est peut-être pas définitif."</em><br><br>
            <strong>Étape 5 — L\'intention positive non satisfaite</strong><br>
            Derrière chaque rancœur, il y a un besoin légitime qui n\'a pas été satisfait.<br>
            <em>"Ce que je voulais vraiment, c\'était... (être vu, être protégé, être aimé, fairecconfiance...)"</em><br>
            Ce besoin reste légitime. Il peut maintenant être satisfait autrement — sans attendre l\'autre.<br><br>
            <strong>Étape 6 — La phrase de libération</strong><br>
            Non destinée à l\'autre. Pour vous :<br>
            <em>"Je reprends l\'espace que cette blessure occupait dans ma vie. Je choisis ce que j\'en fais maintenant."</em><br>
            Écrivez-la. Lisez-la à voix haute. Répétez-la quand la blessure remonte — et elle remontera.<br>
            Luskin : <em>"Le pardon n\'est pas un événement. C\'est une pratique."</em><br><br>
            <strong>Note sur le pardon entre parent et enfant :</strong><br>
            Le pardon peut exister sans réconciliation. Un enfant peut pardonner un parent qui ne s\'est jamais excusé — pour lui-même, pas pour l\'autre.<br>
            Un parent peut pardonner un enfant qui l\'a rejeté — pour lui-même, pas pour l\'autre.<br>
            Le pardon ne restaure pas nécessairement la relation. Il restaure la personne.
            </div>
            <strong>Cette semaine :</strong> écrivez votre "grievance story" en une phrase. Regardez-la. Posez-vous la question : est-ce que cette histoire vous sert encore ? Ou est-ce qu\'elle vous coûte plus qu\'elle ne vous protège ?',
            false
        );

        /* ── EXERCICE 14 : L\'Éveil de l\'Aîné ───────────────────── */
        $ex14 = $this->exercice($red, '⑭', 'L\'Éveil de l\'Aîné — avant qu\'il ne soit trop tard',
            '<em>Cet exercice s\'adresse à quelqu\'un de précis.<br>
            La personne qui a transmis la violence. Qui a donné des coups, des humiliations, des silences qui blessent.<br>
            Qui n\'a peut-être jamais reconnu ce qu\'elle a fait — parce que personne ne le lui avait jamais dit vraiment, parce que c\'était "normal", parce que la honte était trop lourde.<br>
            Certains de ses enfants sont déjà partis. D\'autres sont sur le départ. D\'autres ont encore un peu de temps.<br>
            Ce n\'est pas un jugement. C\'est un appel.</em><br><br>
            <strong>Ce que l\'approche de la mort révèle — la recherche de Yalom</strong><br><br>
            Irvin Yalom (Université de Stanford — psychiatre existentiel, <em>Staring at the Sun</em>, 2008) a passé 50 ans à travailler avec des personnes en fin de vie et avec des personnes confrontées à leur propre mortalité.<br>
            Sa découverte centrale : <strong>la conscience de sa propre mort est le catalyseur de changement le plus puissant qui existe.</strong><br>
            Non pas comme source de peur — mais comme clarificateur radical.<br>
            Face à la mort, ce qui comptait vraiment devient évident. Et ce qui avait semblé important se révèle souvent vide.<br><br>
            Bronnie Ware (infirmière en soins palliatifs, <em>The Top Five Regrets of the Dying</em>, 2012) a recueilli pendant des années les regrets des mourants.<br>
            Le regret N°4, exprimé par presque tous les parents en fin de vie :<br>
            <strong><em>"J\'aurais voulu garder le contact avec mes enfants."</em></strong><br>
            Pas "j\'aurais voulu leur donner plus". Pas "j\'aurais voulu mieux travailler".<br>
            Le lien. Ils regrettaient le lien.<br><br>
            Et Ira Byock (médecin en soins palliatifs — <em>The Four Things That Matter Most</em>, 2004) a documenté que les personnes capables de dire ces quatre phrases avant de mourir mouraient en paix :<br>
            <em>"Pardonne-moi. / Je te pardonne. / Merci. / Je t\'aime."</em><br>
            Ceux qui n\'avaient pu les dire — à cause de l\'orgueil, de la peur, du temps passé — mouraient dans une détresse qui n\'avait rien à voir avec la douleur physique.<br><br>
            <div style="background:rgba(239,68,68,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;border-left:3px solid rgba(239,68,68,.5);">
            <strong>LA LETTRE QU\'ON N\'A PAS LE DROIT DE NE PAS ÉCRIRE</strong><br><br>
            Ce protocole ne demande pas si vous avez bien ou mal agi.<br>
            Il part d\'un seul fait : <strong>le temps passe. Et il ne revient pas.</strong><br><br>
            <strong>Étape 1 — La projection dans le futur (exercice de Yalom)</strong><br>
            Imaginez-vous dans 10 ans. Vos enfants ne vous parlent plus, ou à peine.<br>
            Ou vous êtes à la fin de votre vie.<br>
            Posez-vous honnêtement ces questions — et écrivez les réponses :<br>
            <em>"Qu\'est-ce que j\'aurais voulu leur dire, et que je n\'ai pas pu ?"</em><br>
            <em>"Quelle vérité sur ce que j\'ai fait n\'ai-je jamais dite à voix haute ?"</em><br>
            <em>"Qu\'est-ce que je sais sur l\'impact de mes actes, et que je n\'ai jamais reconnu ?"</em><br><br>
            <strong>Étape 2 — L\'inventaire de ce qui a été transmis</strong><br>
            Sans minimiser, sans exagérer — une liste honnête :<br>
            · Ce que j\'ai transmis de bien (nommez-le — c\'est réel aussi)<br>
            · Ce que j\'ai transmis de douloureux (nommez-le — aussi précisément que vous le pouvez)<br>
            Ce n\'est pas un tribunal. C\'est une comptabilité honnête.<br><br>
            <strong>Étape 3 — Les Quatre Phrases de Byock</strong><br>
            Écrivez à chaque enfant une lettre contenant, à votre façon, ces quatre vérités :<br><br>
            <em>"Pardonne-moi."</em> — pour ce que vous avez fait de précis. Pas en général. En précis.<br>
            <em>"Je te pardonne."</em> — si vous portez de la rancœur envers eux. La nommer libère les deux parties.<br>
            <em>"Merci."</em> — pour ce qu\'ils vous ont donné. Nommez-le.<br>
            <em>"Je t\'aime."</em> — si vous le ressentez. Dit de façon directe, sans condition ni attente.<br><br>
            Cette lettre peut être envoyée. Ou pas. Ou remise en main propre. Ou lue à voix haute devant un miroir d\'abord.<br>
            Mais elle doit être écrite.<br><br>
            <strong>Étape 4 — L\'acte irréversible</strong><br>
            Choisissez UN geste concret et irréversible que vous allez poser cette semaine.<br>
            Pas une intention. Un acte qui existe dans le monde réel.<br>
            · Un appel téléphonique si vous ne vous êtes pas parlé depuis longtemps<br>
            · Une lettre envoyée par la poste — pas par message, par la poste<br>
            · Un déplacement pour aller les voir si vous le pouvez<br>
            · La transmission de la lettre à quelqu\'un de confiance qui la remettra si vous ne pouvez pas le faire vous-même<br><br>
            <strong>Pour ceux dont les enfants ont déjà fermé la porte définitivement :</strong><br>
            L\'acte garde sa valeur même sans réciprocité.<br>
            Viktor Frankl (<em>Man\'s Search for Meaning</em>, 1946) : le sens d\'un acte ne dépend pas de sa réception.<br>
            Écrire la lettre. La faire exister. C\'est déjà un acte de réparation — pour vous d\'abord.<br>
            Et parfois, des années plus tard, quelque chose s\'ouvre du côté de l\'enfant.<br>
            Personne ne peut promettre quand. Mais l\'acte posé maintenant est la seule chose qui peut rendre ce possible.<br><br>
            <strong>Ce que cette démarche demande :</strong><br>
            Elle demande de traverser l\'orgueil. La honte. La conviction que "c\'est trop tard".<br>
            Elle demande d\'accepter que la transformation ne vienne pas de l\'extérieur — ni d\'un enfant qui pardonne, ni d\'un thérapeute qui absout.<br>
            Elle vient de l\'intérieur. Et elle ne peut commencer que par vous.<br>
            <strong>Pas parce qu\'on vous le demande. Parce que vous le choisissez.</strong><br>
            C\'est la seule raison qui fonctionne. C\'est la seule qui soit vraie.
            </div>
            <em>Si vous avez lu jusqu\'ici — vous savez déjà ce que vous devez faire.<br>
            La question n\'est pas "est-ce que c\'est possible ?"<br>
            La question est : "est-ce que je choisis de le faire avant qu\'il ne soit trop tard ?"<br>
            <strong>Vous seul pouvez y répondre. Et vous pouvez le faire maintenant.</strong></em>',
            false
        );

        /* ── ECRITURE ─────────────────────────────────────────────── */
        $ecrit = $this->card($indigo, 'Écriture · Les lettres qu\'on écrit mais qu\'on n\'envoie peut-être pas', '✍️ Deux lettres pour nommer ce qui n\'a jamais été dit',
            '<em>Ces lettres n\'ont pas besoin d\'être envoyées. Elles ont besoin d\'être écrites.<br>
            Parce que ce qu\'on n\'a pas nommé continue de nous gouverner.</em><br><br>
            <strong>LETTRE 1 — À l\'aîné qui n\'a pas su créer le lien</strong><br>
            (parent, grand-parent, figure d\'autorité absente ou toxique de votre enfance)<br><br>
            Commencez par :<br>
            <em>"Ce que j\'aurais eu besoin que tu me donnes, et que tu n\'as pas donné, c\'est..."<br>
            "Ce que ta façon d\'être m\'a coûté, c\'est..."<br>
            "Ce que je comprends maintenant sur toi, sur ce que tu avais toi-même reçu, c\'est..."<br>
            "Ce que je choisis de lâcher — pas pour toi, mais pour moi — c\'est..."</em><br><br>
            <strong>LETTRE 2 — À l\'enfant que vous portez (réel ou potentiel)</strong><br>
            (ou à quelqu\'un que vous aimez et que vous ne voulez pas abandonner)<br><br>
            Commencez par :<br>
            <em>"Ce que je veux que tu saches, c\'est que tu comptes plus que..."<br>
            "Ce que je m\'engage à faire différemment de ce que j\'ai vécu, c\'est..."<br>
            "Ce que je t\'offre que personne ne m\'a offert, c\'est..."<br>
            "Ce que je veux que tu retiennes de notre relation, c\'est..."</em><br><br>
            <em style="color:'.$indigo.';">La guérison d\'une génération ne répare pas le passé.<br>
            Elle protège l\'avenir. Et elle commence avec le courage d\'écrire ce qu\'on n\'a jamais osé dire.</em>'
        );

        /* ── MÉDITATION ──────────────────────────────────────────── */
        $meditation = $this->card($gold, 'Méditation guidée', '🌬 Réparer en soi ce qu\'on ne peut pas toujours réparer dehors (8 min)',
            '<strong>Asseyez-vous. Dos droit. Mains ouvertes sur les genoux, paumes vers le ciel. Fermez les yeux.</strong><br><br>
            <strong>PHASE 1 — La lignée derrière vous (3 min)</strong><br>
            Inspirez : <strong>5 secondes</strong>. Le ventre, puis la poitrine.<br>
            Expirez : <strong>7 secondes</strong>. Les épaules descendent complètement.<br><br>
            Quatre cycles. À chaque expiration, visualisez :<br>
            → Derrière vous, votre père et votre mère — avec tout ce qu\'ils ont su donner, et tout ce qu\'ils n\'ont pas su.<br>
            → Derrière eux, vos grands-parents — la génération ciment qui portait la famille sans savoir qu\'elle partirait un jour.<br>
            → Derrière eux, tous ceux qui ont survécu pour que vous soyez là.<br>
            Vous êtes l\'aboutissement d\'une longue lignée. Imparfaite. Vivante.<br><br>
            <strong>PHASE 2 — Couper le fil de la transmission négative (3 min)</strong><br>
            Sans forcer, laissez venir un schéma de votre lignée que vous ne voulez pas reproduire.<br>
            Visualisez ce schéma comme un fil qui relie les générations passées jusqu\'à vous.<br><br>
            Inspirez profondément. Sur l\'expiration, dites intérieurement :<br>
            <em>"Je vois ce qui a été transmis. Je choisis ce que je transmets."</em><br>
            Répétez trois fois. Le fil ne se coupe pas dans la douleur — il se relâche dans la conscience.<br><br>
            <strong>PHASE 3 — Ce que vous plantez aujourd\'hui (2 min)</strong><br>
            Imaginez une personne que vous aimez — un enfant, un proche, un parent encore là.<br>
            Visualisez-vous <em>entièrement présent(e)</em> avec cette personne. Pas parfait(e). Là.<br><br>
            Formulez en silence :<br>
            <em>"Ce que je transmets est plus fort que ce que j\'ai reçu.<br>
            Parce que je le choisis. Et ce choix commence maintenant."</em><br><br>
            Trois respirations finales, longues, complètes.<br>
            Ouvrez les yeux.<br>
            <em>⏱ 8 min · Cette méditation peut se faire après avoir écrit les lettres. L\'un prépare l\'autre.</em>'
        );

        return [
            'description' => 'Le module le plus complet de la formation. 60 ans de rupture documentée, la confusion gifle/lien, le paradoxe du confort (Bourdieu, Illich, Chomsky), l\'environnement prédateur (Parker, Haugen, Sabina, Cacioppo). La base du bonheur — enfin traitée à sa vraie hauteur. Sources primaires. Exercices de rupture de cycle.',
            'intro_text'  => "MODULE 33 — L'Enfant abandonné : la généalogie de la rupture\n\nLa rupture familiale commence dans les années 1960. Les premiers thérapeutes sonnent l'alarme dès 1970 — loi française sur l'autorité parentale, premières structures de thérapie familiale en Europe. La réponse institutionnelle à grande échelle arrive dans les années 1980. L'Association Européenne de Thérapie Familiale est fondée en 1991. Soit 55 ans de traitement. Les symptômes empirent.\n\nCe module est le plus long de la formation — parce que c'est le sujet le plus fondamental. Il remonte à l'origine sur 3 générations, déconstruit la violence éducative ordinaire et l'erreur de lecture que des cultures entières répètent depuis des décennies, puis affronte ce que personne n'ose nommer : le paradoxe du confort (travailler toujours plus pour financer une famille qui meurt de l'absence) et l'environnement industriellement conçu pour capturer l'attention de vos enfants dès l'âge de 11 ans.\n\n'Mourir pour la patrie est un honneur' a la même structure idéologique que 'travailler dur pour ma famille, c'est de l'amour' — même mécanisme, même coût humain invisible. Bourdieu, Illich et Chomsky le démontent. Maslach nomme la fatigue parentale comme résultat mécanique d'un système, pas comme échec moral.\n\nLa base du bonheur n'est pas le revenu. C'est le lien.\n\nSources : INSEE, INED, Univ. Michigan, Cambridge (Blake 2022), Cornell (Pillemer 2020), BJP (Agllias 2016), Gershoff & Grogan-Kaylor (JFP 2016), Harvard (Sampson), Berkeley (Baumrind, Maslach), Chomsky/Herman (1988), Illich (1973), Gloria Mark (UC Irvine 2023), Sabina/Wolak/Finkelhor (2008), Cacioppo (Chicago 2008), Parker/Haugen (2017–2021), EFTA (1991).\n\nCe module n'est pas né dans une bibliothèque. Il est né de quelqu'un qui a cherché à comprendre depuis l'intérieur — en vivant ce qu'il décrit, en portant les questions jusqu'à trouver les réponses. 'Cherchez et vous trouverez' — non comme promesse abstraite, mais comme description précise de ce qui s'est passé. Le savoir et l'expérience vécue ne sont pas opposés. Parfois, l'un naît de l'autre.",
            'audio_path'  => null,
            'activities'  => [
                ['type' => 'lecture',  'title' => '⚠ La généalogie de la rupture — le pamphlet',                                                       'duration' => '5 min',  'description' => 'La thèse : 60 ans de ruptures documentées ont produit la crise familiale actuelle. La génération présente n\'a pas créé le problème — elle en est l\'héritière. Et peut en être le dernier maillon.',                              'content' => $pamphlet],
                ['type' => 'lecture',  'title' => '🏛 La génération ciment — grands-parents nés entre 1900 et 1935',                                   'duration' => '10 min', 'description' => 'INSEE 1954 : 3,7 enfants/femme (vs 1,68 en 2023). INED : 70 % des Français à moins de 50 km de leurs parents avant l\'exode. Université du Michigan : mort de l\'aîné → réunions familiales −40 à 60 % en 5 ans. Ce qui existait — et que personne n\'a appris à remplacer.',  'content' => $lec1],
                ['type' => 'lecture',  'title' => '⚡ La génération rupture — Baby Boomers (60–80 ans aujourd\'hui)',                                   'duration' => '10 min', 'description' => 'INSEE : taux de divorce ×6 (10/1 000 en 1960 → 56/100 en 2020). INED : 3 millions de déracinés en 30 ans. TV : 12 % → 80 % des foyers en 15 ans. Cyrulnik : le syndrome du parent froid. Lipovetsky, L\'ère du vide (1983). La chronologie précise d\'une rupture non intentionnelle.',       'content' => $lec2],
                ['type' => 'lecture',  'title' => '🪞 Le paradoxe de Janus — la vérité sur les aînés seuls',                                          'duration' => '10 min', 'description' => 'Lucy Blake (Cambridge, 2022) : 80 % des ruptures familiales décidées par l\'enfant adulte — cause principale : négligence émotionnelle non reconnue. Pillemer (Cornell, 2020) : 27 % d\'Américains en rupture. INSEE 2022 : qualité du lien dans l\'enfance = seul prédicteur fiable du maintien à domicile. La vérité que la bienséance empêche de dire.',  'content' => $lec3],
                ['type' => 'lecture',  'title' => '📡 Les accélérateurs — de la télévision aux réseaux sociaux',                                       'duration' => '12 min', 'description' => 'TV 1960–75 : mort de la conversation du soir. Twenge (iGen, 2017) : +70 % dépression ados en 5 ans après 2012. Haidt (The Anxious Generation, 2024) : l\'enfance basée sur l\'écran vs le jeu libre. Turkle (MIT) : phubbing parental. TikTok 7 secondes vs récit de grand-père. Les écrans révèlent la rupture — ils ne la créent pas.',                              'content' => $lec4],
                ['type' => 'lecture',  'title' => '🌍 Violence parentale & lien — l\'erreur logique qui traverse des continents',                                         'duration' => '15 min', 'description' => 'Coups, ceintures, humiliations, rabaissements permanents : ces cultures ont deux choses — la cohésion (N°1, qui éduque) et les violences physiques et psychologiques (N°2, qu\'elles croient éduquer). Sampson Harvard 20 ans. Gershoff 2016 : 75 études, 160 927 enfants. Paradoxe des 2 camps. La 2e génération : le lien disparaît, la violence reste — effondrement.',   'content' => $lec5],
                ['type' => 'lecture',  'title' => '⚡ Le paradoxe du confort — travailler toujours plus pour financer ce qu\'on détruit par l\'absence',           'duration' => '15 min', 'description' => 'Chomsky/Herman (Manufacturing Consent, 1988) : "travailler = aimer" a la même structure idéologique que "mourir au combat = un honneur". Bourdieu : nécessité économique convertie en vertu morale. Illich (La Convivialité, 1973) : contre-productivité. Maslach : la fatigue parentale comme résultat mécanique. Revenus +43 %, ruptures +240 %, dépression ados +280 %. Le verrou du sacrifice.',  'content' => $lec6],
                ['type' => 'lecture',  'title' => '🌐 L\'environnement prédateur — élever un enfant dans un monde conçu contre lui',                    'duration' => '12 min', 'description' => 'Sean Parker (Facebook, 2017) : "nous exploitons une vulnérabilité de la psychologie humaine". Frances Haugen (Instagram, 2021). Chiara Sabina : 93 % des garçons exposés à la pornographie avant 18 ans, âge moyen 11 ans. Gloria Mark (UC Irvine, 2023) : attention moyenne 47 secondes. Cacioppo (Chicago) : solitude = 15 cigarettes/jour. La mission impossible du parent seul contre un système industriel.',  'content' => $lec7],
                ['type' => 'exercice', 'title' => '🧬 La généalogie émotionnelle — cartographier 3 générations',                                       'duration' => '30 min', 'description' => 'Dessiner l\'arbre sur 3 niveaux. Identifier disponibilité émotionnelle, ruptures et transmissions par génération. Trouver le maillon cassé. Nommer en une phrase le schéma hérité qu\'on refuse de reproduire. L\'exercice fondateur.',                         'content' => $ex1],
                ['type' => 'exercice', 'title' => '🔄 Le protocole de rupture du cycle — ça s\'arrête avec moi',                                       'duration' => '15 min', 'description' => 'Un acte précis cette semaine — pas une intention floue. Adapté à votre position : parent actif, enfant adulte en tension, relation cassée ou toxique. Le cycle se brise par acte, pas par résolution.',                                               'content' => $ex2],
                ['type' => 'exercice', 'title' => '🔧 Réparer le lien maintenant — familles en rupture, violence ou séparation',                          'duration' => '20 min', 'description' => 'Pour le parent qui crie et veut changer. Pour celui qui élève seul des enfants ayant vécu de la violence. Pour les enfants suivis en CMP. Tronick : la réparation après l\'erreur construit plus que la perfection. Siegel : sécurité → connexion → sens, dans cet ordre. Co-parentalité après violence : ce qui est possible, ce qui ne l\'est pas. L\'auto-compassion qui permet de changer.',  'content' => $ex3],
                ['type' => 'exercice', 'title' => '📖 Le Récit des Ancêtres — installer la résilience par l\'histoire familiale',                           'duration' => '20 min', 'description' => 'Duke & Fivush (Emory, 2001) : le meilleur prédicteur de résilience chez l\'enfant jamais trouvé = connaître les histoires de difficulté surmontée dans sa famille. Protocole précis : raconter, faire re-raconter, transmettre la phrase. Adapté à toutes les familles — y compris immigration. Les histoires d\'arrachement sont les plus puissantes qui soient.',  'content' => $ex4],
                ['type' => 'exercice', 'title' => '🔑 Le Mot de Code — arrêter l\'escalade avant qu\'elle commence',                                       'duration' => '15 min', 'description' => 'Gottman (40 ans, U. Washington) : les familles stables ne se disputent pas moins — elles réparent avec un langage partagé. Créer ensemble le mot de code de la famille : absurde, choisi par les enfants, avec des règles claires. Une réunion fondatrice de 30 min. Fonctionne dès 5-6 ans.',  'content' => $ex5],
                ['type' => 'exercice', 'title' => '🧠 L\'Installation de Mémoire — rééquilibrer ce que la famille retient',                             'duration' => '10 min', 'description' => 'Rick Hanson (Berkeley, 2013) : le cerveau encode 5 à 20× plus fortement le négatif. Protocole HEAL en 4 étapes, 3 minutes par soir. 30 secondes d\'attention = encodage longue durée (Cahill & McGaugh, UC Irvine). Sur 3 mois : −30 à 40 % de rumination négative. La mémoire familiale est un outil, pas un témoin.',  'content' => $ex6],
                ['type' => 'exercice', 'title' => '👂 L\'Entretien d\'Écoute — la compétence parentale qui change la biologie de l\'enfant',               'duration' => '15 min', 'description' => 'Gottman (40 ans) : les parents "emotion coaching" ont des enfants avec une meilleure immunité mesurée dans le sang, de meilleures notes, moins de troubles du comportement. 5 niveaux de réponse : de "résoudre" (niveau 1) à "nommer et accompagner" (niveau 5). Protocole 10 jours. La quasi-totalité des parents sont bloqués aux niveaux 1–3.',  'content' => $ex7],
                ['type' => 'exercice', 'title' => '🗺 La Cartographie du Corps Émotionnel — donner une adresse à ce qui n\'a pas de mots',              'duration' => '15 min', 'description' => 'Nummenmaa (PNAS, 2014) : 700 participants, 5 cultures — les cartes corporelles des émotions sont quasi-identiques entre toutes les cultures. Siegel : localiser une émotion dans le corps = la réguler 3× mieux. Protocole du dessin de corps + point d\'ancrage personnel = outil de régulation en 10 secondes. Particulièrement puissant pour enfants traumatisés.',  'content' => $ex8],
                ['type' => 'exercice', 'title' => '🙏 La Reconnaissance du Tort — l\'acte le plus difficile et le plus libérateur',                          'duration' => '20 min', 'description' => 'Harriet Lerner (2017) : la quasi-totalité des excuses blessent au lieu de guérir — parce qu\'elles contiennent une défense cachée. Van der Kolk (IRMf) : une fausse excuse réactive le trauma. Les 5 éléments d\'une reconnaissance réelle : précision, impact de l\'autre, assomption sans condition, coût à long terme, aucune demande de pardon en retour.',  'content' => $ex9],
                ['type' => 'exercice', 'title' => '📜 La Lettre d\'Impact — rendre la blessure visible pour que la réparation soit possible',               'duration' => '25 min', 'description' => 'Howard Zehr (Justice Restaurative, 35 pays, 40 ans) : le seul moment qui produit une transformation durable est quand la personne qui a causé le tort ENTEND l\'impact réel. Pennebaker (UT Austin, 40 000 participants) : l\'effet thérapeutique est identique que la lettre soit envoyée, lue ou brûlée. Ce qui compte : la mise en mots complète et non censurée.',  'content' => $ex10],
                ['type' => 'exercice', 'title' => '🏛 Le Conseil de Famille — instaurer une démocratie dans le foyer',                                    'duration' => '20 min', 'description' => 'Dreikurs (Institut Adlérien, 40 ans) : 70 % moins de conflits récurrents dans les familles pratiquant le Conseil. 4 règles fondamentales : voix égale quel que soit l\'âge, aucune critique sans proposition, cahier d\'agenda tenu entre séances, décisions respectées jusqu\'au prochain Conseil. Un enfant entendu n\'a pas besoin de crier.',  'content' => $ex11],
                ['type' => 'exercice', 'title' => '🔗 Le Protocole de Ré-attachement — recoudre le lien quand il a été déchiré',                          'duration' => '20 min', 'description' => 'Sue Johnson (EFT, 30 ans, U. Ottawa) : sous chaque comportement difficile se cache une question d\'attachement non posée. Les 3 questions qui passent sous la défense : "Qu\'est-ce qui se passe en toi quand..." / "Est-ce que j\'ai manqué quelque chose ?" / "De quoi tu aurais besoin de ma part ?". Adapté aux relations très abîmées.',  'content' => $ex12],
                ['type' => 'exercice', 'title' => '🌿 Le Pardon de Stanford — reprendre sa vie à la blessure qui la gouverne',                              'duration' => '30 min', 'description' => 'Fred Luskin (Stanford Forgiveness Project, 1999–2010) : −23 % de cortisol, −40 % de dépression, −34 % de douleurs chroniques. Protocole en 6 étapes. Le pardon n\'est pas un événement — c\'est une pratique. Testé avec des victimes de violence extrême en Irlande du Nord et en Sierra Leone.',  'content' => $ex13],
                ['type' => 'exercice', 'title' => '🕯 L\'Éveil de l\'Aîné — avant qu\'il ne soit trop tard',                                              'duration' => '40 min', 'description' => 'Yalom (Stanford, *Staring at the Sun*, 2008) : la conscience de sa mort est le catalyseur de changement le plus puissant. Bronnie Ware (soins palliatifs) : regret N°4 de presque tous les mourants = "j\'aurais voulu garder le contact avec mes enfants". Byock (4 phrases) : "Pardonne-moi / Je te pardonne / Merci / Je t\'aime". Frankl : le sens d\'un acte ne dépend pas de sa réception.',  'content' => $ex14],
                ['type' => 'ecriture', 'title' => '✍️ Deux lettres — à l\'aîné qui n\'a pas su créer le lien, et à l\'enfant que je ne veux pas abandonner', 'duration' => '20 min', 'description' => 'Lettre 1 : à l\'aîné — nommer le coût, comprendre sans excuser, choisir de lâcher. Lettre 2 : à l\'enfant — promettre avec précision, pas avec des mots. Ces lettres n\'ont pas besoin d\'être envoyées. Elles ont besoin d\'être vraies.',             'content' => $ecrit],
                ['type' => 'pratique', 'title' => '🌬 Méditation — Réparer en soi ce qu\'on ne peut pas toujours réparer dehors (8 min)',               'duration' => '8 min',  'description' => 'Phase 1 (3 min) : ancrage dans la lignée — 3 générations derrière soi. Phase 2 (3 min) : couper consciemment le fil de transmission négative. Phase 3 (2 min) : visualiser et planter ce qu\'on choisit de transmettre.',                               'content' => $meditation],
            ],
            'activities_en' => [
                ['type' => 'lecture',  'title' => '⚠ The genealogy of the rupture — the pamphlet',                                                      'duration' => '5 min',  'description' => 'The thesis: 60 years of documented ruptures produced the current family crisis. Today\'s generation didn\'t create the problem — they inherited it. They can choose to be the last link in the chain.'],
                ['type' => 'lecture',  'title' => '🏛 The cement generation — grandparents born between 1900 and 1935',                                  'duration' => '10 min', 'description' => 'INSEE 1954: 3.7 children/woman (vs 1.68 in 2023). INED: 70% of French within 50 km of parents pre-exodus. Univ. Michigan: death of eldest → family gatherings −40–60% within 5 years. What existed — and that nobody learned to replace.'],
                ['type' => 'lecture',  'title' => '⚡ The rupture generation — Baby Boomers (aged 60–80 today)',                                         'duration' => '10 min', 'description' => 'INSEE: divorce ×6 (10/1,000 in 1960 → 56/100 in 2020). INED: 3 million uprooted in 30 years. TV: 12% → 80% of households in 15 years. Cyrulnik: the cold parent syndrome. Lipovetsky, The Era of Emptiness (1983). The precise timeline of an unintentional rupture.'],
                ['type' => 'lecture',  'title' => '🪞 The Janus paradox — the truth about lonely elders',                                               'duration' => '10 min', 'description' => 'Lucy Blake (Cambridge, 2022): 80% of family estrangements decided by the adult child — main cause: unacknowledged emotional neglect. Pillemer (Cornell, 2020): 27% of Americans estranged. INSEE 2022: childhood relationship quality = only reliable predictor of home care. The truth propriety prevents saying.'],
                ['type' => 'lecture',  'title' => '📡 The accelerators — from television to social media',                                               'duration' => '12 min', 'description' => 'TV 1960–75: death of evening conversation. Twenge (iGen, 2017): +70% teen depression in 5 years post-2012. Haidt (The Anxious Generation, 2024): screen-based vs play-based childhood. Turkle (MIT): parental phubbing. TikTok 7-second attention vs grandfather\'s story. Screens reveal the rupture — they don\'t create it.'],
                ['type' => 'lecture',  'title' => '🌍 Parental violence & the bond — a logical error that crosses continents',                                        'duration' => '15 min', 'description' => 'Belts, kicks, humiliations, constant put-downs: these cultures have two things — cohesion (N°1, which educates) and physical/psychological violence (N°2, which they believe educates). Sampson Harvard 20 years. Gershoff 2016: 75 studies, 160,927 children. Two-camp paradox. 2nd generation: bond disappears, violence stays — collapse.'],
                ['type' => 'lecture',  'title' => '⚡ The comfort paradox — working ever more to finance what absence destroys',                               'duration' => '15 min', 'description' => 'Chomsky/Herman (Manufacturing Consent, 1988): "working = loving" has the same ideological structure as "dying in combat = honour". Bourdieu: economic necessity converted to moral virtue. Illich (Tools for Conviviality, 1973): counter-productivity. Maslach: parental burnout as mechanical result. Income +43%, family breakdown +240%, teen depression +280%. The sacrifice lock.'],
                ['type' => 'lecture',  'title' => '🌐 The predatory environment — raising a child in a world designed against them',                     'duration' => '12 min', 'description' => 'Sean Parker (Facebook, 2017): "we exploit a vulnerability in human psychology". Frances Haugen (Instagram, 2021). Chiara Sabina: 93% of boys exposed to pornography before 18, average age 11. Gloria Mark (UC Irvine, 2023): average attention 47 seconds. Cacioppo (Chicago): loneliness = 15 cigarettes/day. The impossible mission of the parent alone against an industrial system.'],
                ['type' => 'exercice', 'title' => '🧬 Emotional genealogy — mapping 3 generations',                                                     'duration' => '30 min', 'description' => 'Map 3 levels: emotional availability, ruptures, and transmissions per generation. Find the broken link. Name in one sentence the inherited pattern you refuse to pass on. The foundational exercise.'],
                ['type' => 'exercice', 'title' => '🔄 The cycle-breaking protocol — it stops with me',                                                  'duration' => '15 min', 'description' => 'One precise act this week — not a vague intention. Adapted to your position: active parent, adult child in tension, or broken/toxic relationship. A cycle breaks through action, not resolution.'],
                ['type' => 'exercice', 'title' => '🔧 Repairing the bond now — families facing breakdown, violence or separation',                          'duration' => '20 min', 'description' => 'For the parent who shouts and wants to change. For those raising children alone who have experienced violence. For children in therapy. Tronick: repair after error builds more than perfection. Siegel: safety → connection → meaning, in that order. Co-parenting after violence: what is possible, what is not. Self-compassion that enables change.'],
                ['type' => 'exercice', 'title' => '📖 The Ancestor Story — building resilience through family history',                                    'duration' => '20 min', 'description' => 'Duke & Fivush (Emory, 2001): the strongest single predictor of child resilience ever found = knowing family stories of hardship overcome. Precise protocol: tell, re-tell, transmit the phrase. Adapted for all families including immigration. Stories of uprooting are the most powerful of all.'],
                ['type' => 'exercice', 'title' => '🔑 The Code Word — stopping escalation before it starts',                                              'duration' => '15 min', 'description' => 'Gottman (40 years, U. Washington): stable families do not fight less — they repair faster with a shared language. Create your family code word together: absurd, chosen by the children, with clear rules. One 30-minute founding meeting. Works from age 5-6.'],
                ['type' => 'exercice', 'title' => '🧠 Memory Installation — rebalancing what the family retains',                                        'duration' => '10 min', 'description' => 'Rick Hanson (Berkeley, 2013): the brain encodes negative 5–20× more strongly. HEAL protocol, 4 steps, 3 minutes per evening. 30 seconds of attention = long-term encoding (Cahill & McGaugh, UC Irvine). Over 3 months: −30 to 40% negative rumination. Family memory is a tool, not a witness.'],
                ['type' => 'exercice', 'title' => '👂 The Listening Interview — the parenting skill that changes a child\'s biology',                   'duration' => '15 min', 'description' => 'Gottman (40 years): "emotion coaching" parents have children with measurably better immune function (blood tests), better grades, fewer behavioural issues. 5 response levels: from "solve it" (level 1) to "name and accompany" (level 5). 10-day protocol. Most parents are stuck at levels 1–3 without knowing it.'],
                ['type' => 'exercice', 'title' => '🗺 The Emotional Body Map — giving an address to what has no words',                               'duration' => '15 min', 'description' => 'Nummenmaa (PNAS, 2014): 700 participants, 5 cultures — bodily emotion maps are near-identical across all cultures. Siegel: locating an emotion in the body = regulating it 3× better. Body-drawing protocol + personal anchor point = regulation tool in 10 seconds. Especially powerful for traumatised children.'],
                ['type' => 'exercice', 'title' => '🙏 Acknowledging the Wrong — the hardest and most liberating act',                                    'duration' => '20 min', 'description' => 'Harriet Lerner (2017): almost all apologies harm rather than heal — they contain a hidden defense. Van der Kolk (fMRI): a false apology reactivates the trauma. The 5 elements of genuine acknowledgment: precision, the other\'s impact, unconditional assumption, long-term cost, no request for forgiveness in return.'],
                ['type' => 'exercice', 'title' => '📜 The Impact Letter — making the wound visible so repair becomes possible',                           'duration' => '25 min', 'description' => 'Howard Zehr (Restorative Justice, 35 countries, 40 years): the only moment producing lasting transformation is when the person who caused harm HEARS the real impact. Pennebaker (UT Austin, 40,000 participants): therapeutic effect is identical whether the letter is sent, read or burned. What matters: complete, uncensored naming.'],
                ['type' => 'exercice', 'title' => '🏛 The Family Council — establishing democracy in the home',                                          'duration' => '20 min', 'description' => 'Dreikurs (Adlerian Institute, 40 years): 70% fewer recurring conflicts in families practising the Council. 4 core rules: equal voice regardless of age, no criticism without a proposal, agenda kept between sessions, decisions respected until the next Council. A child who is heard does not need to shout.'],
                ['type' => 'exercice', 'title' => '🔗 The Re-attachment Protocol — restitching the bond when it has been torn',                          'duration' => '20 min', 'description' => 'Sue Johnson (EFT, 30 years, U. Ottawa): beneath every difficult behaviour lies an unasked attachment question. The 3 questions that bypass defences: "What happens inside you when..." / "Did I miss something?" / "What would you need from me?". Adapted for severely damaged relationships.'],
                ['type' => 'exercice', 'title' => '🌿 The Stanford Forgiveness Protocol — reclaiming your life from the wound that governs it',          'duration' => '30 min', 'description' => 'Fred Luskin (Stanford Forgiveness Project, 1999–2010): −23% cortisol, −40% depression, −34% chronic pain. 6-step protocol. Forgiveness is not an event — it is a practice. Tested with victims of extreme violence in Northern Ireland and Sierra Leone.'],
                ['type' => 'exercice', 'title' => '🕯 The Elder Awakening — before it is too late',                                                      'duration' => '40 min', 'description' => 'Yalom (Stanford, *Staring at the Sun*, 2008): awareness of death is the most powerful catalyst for change. Bronnie Ware (palliative care): regret #4 of almost all dying people = "I wish I had stayed in touch with my children". Byock (4 phrases): "Forgive me / I forgive you / Thank you / I love you". Frankl: the meaning of an act does not depend on how it is received.'],
                ['type' => 'ecriture', 'title' => '✍️ Two letters — to the elder who couldn\'t build the bond, and to the child I won\'t abandon',      'duration' => '20 min', 'description' => 'Letter 1: to the elder — name the cost, understand without excusing, choose to release. Letter 2: to the child — promise with precision, not with words. These letters don\'t need to be sent. They need to be true.'],
                ['type' => 'pratique', 'title' => '🌬 Meditation — Healing within what cannot always be healed outside (8 min)',                        'duration' => '8 min',  'description' => 'Phase 1 (3 min): grounding in lineage — 3 generations behind you. Phase 2 (3 min): consciously cutting the thread of negative transmission. Phase 3 (2 min): visualising and planting what you choose to pass on.'],
            ],
        ];
    }

    private function m08_discipline_praticien(): array  // Je renforce ma Discipline — le Pouvoir du Quotidien (PRATICIEN)
    {
        $gold   = 'rgba(201,168,76,.9)';
        $green  = 'rgba(34,197,94,.8)';
        $orange = 'rgba(249,115,22,.8)';
        $teal   = 'rgba(20,184,166,.8)';
        $blue   = 'rgba(59,130,246,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $indigo = 'rgba(99,102,241,.8)';

        $intro =
            $this->card($gold, 'La vérité sur la discipline', 'Ce n\'est pas de la volonté — c\'est de l\'architecture',
                '<div style="font-size:.92rem;line-height:2.3;color:rgba(232,224,208,.85);font-style:italic;margin-bottom:1rem;border-left:3px solid rgba(201,168,76,.5);padding-left:1rem;">
                « La motivation vous fait démarrer. L\'habitude vous fait continuer. »<br>
                <span style="font-size:.75rem;color:rgba(201,168,76,.6);">— Jim Ryun</span>
                </div>
                Vous avez parcouru 7 modules. Vous avez clarifié votre vision. Vous avez appris le Rituel.<br>
                Maintenant vient la question que tous les praticiens éludent :<br>
                <strong>Est-ce que vous pratiquez vraiment, chaque jour, ce que vous enseignez ?</strong><br><br>
                Un praticien qui ne pratique pas est un musicien qui n\'joue plus.<br>
                La technique reste — mais l\'authenticité de transmission disparaît.<br><br>
                <em><strong>Ce module vous donne l\'architecture concrète<br>
                d\'une discipline de praticien qui tient sur le long terme.</strong></em>'
            );

        $lecon1 =
            $this->card($teal, 'Neuroscience', 'La règle des 66 jours — comment les habitudes s\'installent vraiment',
                '<strong>Phillippa Lally, University College London (2010)</strong><br><br>
                L\'étude la plus rigoureuse jamais conduite sur la formation des habitudes :<br>
                96 sujets, mesures quotidiennes pendant 12 semaines.<br><br>
                <div style="background:rgba(20,184,166,.08);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.1;font-size:.85rem;">
                Résultat moyen : <strong>66 jours</strong> pour qu\'un comportement devienne automatique<br>
                Fourchette réelle : 18 à 254 jours selon la complexité de l\'habitude<br>
                <em>→ "21 jours" est un mythe marketing. La médiane honnête est 66.</em>
                </div>
                Ce qui accélère l\'installation :<br>
                · <strong>Invariance du contexte</strong> : même endroit, même moment, même signal déclencheur<br>
                · <strong>Séquence attachée</strong> : ancrer la nouvelle habitude après une existante (habit stacking, James Clear)<br>
                · <strong>Récompense immédiate</strong> : noter une phrase dans le carnet = complétion, satisfaction<br><br>
                <em>Le cerveau crée littéralement une nouvelle autoroute neurale. La régularité creuse ce sillon.</em>'
            )
            .$this->card($blue, 'BJ Fogg', 'Tiny Habits — commencer infiniment petit pour ne jamais arrêter',
                '<strong>Dr BJ Fogg (Stanford Persuasive Technology Lab) — <em>Tiny Habits</em>, 2019</strong><br><br>
                La raison n°1 pour laquelle les praticiens abandonnent leur pratique personnelle :<br>
                <em>ils ont commencé trop grand, et la réduction leur semble un échec.</em><br><br>
                <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.3;font-size:.85rem;">
                <strong style="color:rgba(59,130,246,.9);">La règle de Fogg :</strong><br>
                Une nouvelle habitude doit tenir en moins de 2 minutes les jours difficiles.<br>
                Pas parce que 2 minutes sont plus efficaces —<br>
                <strong>mais parce qu\'une pratique de 2 minutes maintenue 365 jours<br>
                bat une pratique de 20 minutes abandonnée au 30ème.</strong>
                </div>
                <strong>Pour votre pratique Pause Souffle :</strong><br>
                · Minimum infranchissable : 3 cycles 5-5-5. Rien d\'autre.<br>
                · Si vous les faites, la plupart du temps vous continuez plus longtemps.<br>
                · Si vous connaissez des jours difficiles : les 3 cycles suffisent. La chaîne est maintenue.<br><br>
                <em>"Je ne rate jamais deux fois de suite." — James Clear</em>'
            );

        $lecon2 =
            $this->card($orange, 'La règle d\'or du praticien', 'Pratiquer ce que vous transmettez — sans exception',
                '<strong>Le principe de congruence — ce que vos clients ressentent avant vos mots</strong><br><br>
                En consultation, vos clients ne perçoivent pas seulement votre technique.<br>
                Ils perçoivent votre <em>état</em>. Votre présence. Votre ancrage.<br><br>
                Un praticien qui n\'a pas fait sa pause souffle ce matin est,<br>
                dans une séance, légèrement moins disponible — même s\'il croit le contraire.<br><br>
                <div style="background:rgba(249,115,22,.08);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.3;font-size:.85rem;border-left:3px solid rgba(249,115,22,.4);">
                « Un praticien qui a guidé 100 séances sur lui-même<br>
                est plus puissant qu\'un praticien qui a guidé 100 personnes<br>
                sans jamais s\'être guidé lui-même. »
                </div>
                <strong>La règle d\'or :</strong> Avant chaque séance avec un client — même une courte —<br>
                3 cycles 5-5-5 pour vous. Vous vous passez votre propre masque en premier.<br><br>
                <em>Ce n\'est pas du ritualisme. C\'est ce qui sépare un technicien d\'un praticien.</em>'
            )
            .$this->card($purple, 'Votre protocole de discipline', 'Le système en 3 couches',
                '<strong>Couche 1 — Pratique quotidienne (le minimum infranchissable)</strong><br>
                <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.75rem 1rem;margin:.5rem 0 .75rem;font-size:.83rem;line-height:2.1;">
                Minimum : 3 cycles 5-5-5 + 1 phrase dans le carnet<br>
                Standard : 10 minutes (3 souffles · 1 scan corporel · 1 vision · 1 note)<br>
                Complet : 20 minutes (protocole complet Pause Souffle)
                </div>
                <strong>Couche 2 — Revue hebdomadaire (le dimanche, 20 min)</strong><br>
                <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.75rem 1rem;margin:.5rem 0 .75rem;font-size:.83rem;line-height:2.1;">
                Combien de jours ai-je pratiqué ? (honnêteté brutale)<br>
                Qu\'est-ce qui m\'a résisté ? (obstacle à nommer et résoudre)<br>
                Mon énergie de praticien cette semaine : sur 10
                </div>
                <strong>Couche 3 — Bilan du trimestre (les 90 jours)</strong><br>
                <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.75rem 1rem;margin:.5rem 0;font-size:.83rem;line-height:2.1;">
                Quelle est la qualité de ma transmission depuis 90 jours ?<br>
                Est-ce que mes clients progressent en corrélation avec ma propre pratique ?<br>
                Mon prochain défi de discipline pour les 90 prochains jours
                </div>'
            );

        $ex1 =
            $this->exercice($gold, '1', 'Mon contrat de praticien — l\'engagement des 66 jours',
                '<strong>Pas une résolution. Un contrat signé avec vous-même.</strong><br><br>
                Ouvrez votre carnet. Écrivez aujourd\'hui :<br>
                <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.5;font-size:.83rem;color:rgba(232,224,208,.82);">
                · Date de début : _____<br>
                · Date de J+66 : _____ (calculez-la maintenant)<br>
                · Mon minimum infranchissable : 3 cycles 5-5-5 chaque matin<br>
                · Mon standard habituel : 10 minutes complètes<br>
                · Mon moment dédié : _____ (heure précise)<br>
                · Mon endroit : _____ (toujours le même si possible)<br>
                · Revue hebdomadaire : chaque _____ (jour fixe)
                </div>
                <strong>La règle des deux jours</strong> (James Clear) :<br>
                Ne ratez jamais deux jours de suite. Un seul manque est humain. Deux est une habitude.<br>
                Si vous ratez un jour : le lendemain est non-négociable.', false
            );

        $ex2 =
            $this->exercice($teal, '2', 'Mon audit de discipline actuelle — état des lieux honnête',
                'Avant de construire, regardez où vous en êtes réellement.<br><br>
                <strong>Répondez honnêtement :</strong><br>
                <div style="background:rgba(20,184,166,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.5;font-size:.83rem;color:rgba(232,224,208,.78);">
                · Sur les 14 derniers jours, combien de fois ai-je pratiqué pour moi ?  __ / 14<br>
                · Quel est l\'obstacle principal qui me fait sauter la pratique ?<br>
                · Est-ce que je fais ma pause souffle avant mes séances clients ? ☐ Toujours ☐ Parfois ☐ Rarement<br>
                · Ma pratique personnelle est-elle plus intense ou moins intense que ce que je transmets ?
                </div>
                <strong>Signal d\'alarme :</strong> En dessous de 8/14 jours de pratique,<br>
                votre transmission commence à s\'appauvrir — même si vous ne le sentez pas encore.<br><br>
                <strong>Action directe :</strong> Identifiez votre obstacle principal.<br>
                Résolvez-le avec Tiny Habits : réduisez le minimum jusqu\'à ce que cet obstacle disparaisse.', false
            )
            .$this->exercice($green, '3', 'Mon habit stacking — accrocher la pratique à un existant',
                '<strong>James Clear (Atomic Habits, 2018) — la technique la plus efficace pour ancrer une habitude :</strong><br><br>
                La formule :<br>
                <div style="background:rgba(34,197,94,.08);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;font-size:.85rem;font-style:italic;color:rgba(232,224,208,.82);border-left:3px solid rgba(34,197,94,.4);">
                "Après [HABITUDE EXISTANTE], je ferai [NOUVELLE HABITUDE]."
                </div>
                Exemples pour la pratique Pause Souffle :<br>
                <div style="background:rgba(34,197,94,.06);border-radius:10px;padding:.75rem 1rem;margin:.5rem 0;font-size:.82rem;line-height:2.3;color:rgba(232,224,208,.72);">
                "Après avoir préparé mon café du matin, je fais mes 3 cycles 5-5-5."<br>
                "Après m\'être assis·e sur ma chaise de méditation, je fais 10 minutes de Pause Souffle."<br>
                "Avant de regarder mon téléphone, je fais ma minute de souffle."
                </div>
                <strong>Votre formule personnelle pour ce module :</strong><br>
                <em>Après __________ , je pratique ma Pause Souffle pendant __________ minutes.</em><br><br>
                Notez-la. Affichez-la là où vous commencez votre journée.', false
            );

        $meditation =
            $this->exercice($orange, '4', '🌬 Pause Souffle du praticien — le souffle de préparation à la séance',
                '<strong>Durée : 8 minutes · À faire avant chaque séance client</strong><br><br>
                <strong>① Ancrage du corps (1 min)</strong><br>
                Pieds à plat sur le sol. Épaules relâchées. Mains ouvertes sur les genoux.<br>
                Vous n\'êtes pas encore le praticien de votre client. Vous êtes encore vous.<br>
                Prenez ce temps pour faire la transition.<br><br>
                <strong>② Le souffle de clarté — 5 cycles 5-5-5</strong><br>
                Inspirez 5s : recevez l\'énergie du moment présent.<br>
                Retenez 5s : laissez se dissoudre les pensées qui appartiennent à votre vie personnelle.<br>
                Expirez 5s : relâchez tout ce qui n\'est pas ce client, cet espace, ce moment.<br><br>
                <strong>③ L\'intention du praticien</strong><br>
                <em>"Je suis présent·e. Je suis ancré·e. Je suis disponible pour ce qui vient.<br>
                Mon rôle n\'est pas de guérir — mais d\'accompagner.</em><br>
                <em>Je pratique ce que je transmets. Je suis le premier bénéficiaire de ce Rituel."</em>', true
            );

        $reflexion =
            $this->exercice($indigo, '5', 'Mon engagement de praticien — la lettre à ma pratique',
                'Cet exercice semble simple. Il est profond.<br><br>
                <strong>Écrivez une lettre à votre pratique Pause Souffle :</strong><br>
                <div style="background:rgba(99,102,241,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;line-height:2.4;font-size:.83rem;color:rgba(232,224,208,.78);">
                · Comment avez-vous honoré votre pratique depuis le début de cette formation ?<br>
                · Quels jours avez-vous préféré transmettre plutôt que pratiquer vous-même ?<br>
                · Qu\'est-ce que vous vous engagez à ne plus négliger à partir de maintenant ?<br>
                · Ce que votre pratique personnelle vous apporte que rien d\'autre ne peut donner
                </div>
                <strong>La dernière phrase :</strong><br>
                <div style="background:rgba(0,0,0,.2);border-left:3px solid rgba(201,168,76,.4);border-radius:0 8px 8px 0;padding:.85rem 1rem;font-size:.85rem;font-style:italic;color:rgba(232,224,208,.65);">
                "Je m\'engage, à partir d\'aujourd\'hui, à pratiquer __________ (minimum) par jour,<br>
                non pas parce que je le dois — mais parce que c\'est le plus beau cadeau<br>
                que je peux faire à mes clients : être moi-même ancré·e dans ce Rituel."
                </div>', false
            );

        return [
            'description' => 'Je renforce ma Discipline — Règle des 66 jours (Lally, UCL), Tiny Habits (BJ Fogg), habit stacking (James Clear), la règle d\'or du praticien. Contrat de 66 jours + audit de pratique actuelle + préparation souffle avant chaque séance client.',
            'intro_text'  => "MODULE 08 — Je renforce ma Discipline\n\nVous avez parcouru 7 modules. Vous avez votre vision. Vous avez le Rituel.\n\nMaintenant vient la question que tous les praticiens éludent : pratiquez-vous vraiment, chaque jour, ce que vous enseignez ?\n\nCe module vous donne l'architecture concrète d'une discipline de praticien qui tient sur le long terme — pas de la volonté, mais de l'ingénierie comportementale.",
            'audio_path'  => 'formation/audio/08-je-renforce-ma-discipline-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '⚡ Introduction — La discipline n\'est pas de la volonté',            'duration' => '4 min',  'description' => 'La différence entre motivation (démarrer) et habitude (continuer). Un praticien qui ne pratique pas.',                           'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — Règle des 66 jours (Lally) + Tiny Habits (BJ Fogg)',       'duration' => '7 min',  'description' => '66 jours = médiane réelle. Tiny Habits : commencer infiniment petit. "Je ne rate jamais deux fois de suite."',             'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — La règle d\'or du praticien + protocole en 3 couches',     'duration' => '6 min',  'description' => 'Pratiquer avant de transmettre. Système : minimum / standard / complet + revue hebdo + bilan trimestriel.',                  'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique — Mon contrat des 66 jours',                                'duration' => '15 min', 'description' => 'Date début + J+66 + minimum infranchissable + moment + endroit + revue hebdo. Règle des deux jours.',                       'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — Audit de discipline + habit stacking',                    'duration' => '20 min', 'description' => 'Combien de jours pratiqués sur 14 ? Identifier l\'obstacle principal. Formule habit stacking personnalisée à afficher.',       'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle du praticien — souffle de préparation à la séance', 'duration' => '8 min',  'description' => 'Ancrage · 5 cycles de clarté · Intention : "Je suis présent·e. Je pratique ce que je transmets."',                           'content' => $meditation, 'audio' => true],
                ['type' => 'reflexion', 'title' => 'Journal — Ma lettre à ma pratique & engagement final',               'duration' => '10 min', 'description' => 'Lettre à la pratique + engagement écrit : "Je pratique __ par jour non parce que je le dois mais parce que c\'est le plus beau cadeau à mes clients."', 'content' => $reflexion],
            ],
        ];
    }

    private function m12_rituel(): array  // Je transmets le Rituel — Praticien Pause Souffle Niveau 1
    {
        $gold   = 'rgba(201,168,76,.9)';
        $green  = 'rgba(34,197,94,.8)';
        $orange = 'rgba(249,115,22,.8)';
        $teal   = 'rgba(20,184,166,.8)';
        $blue   = 'rgba(59,130,246,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $indigo = 'rgba(99,102,241,.8)';

        $intro =
            $this->card($gold, 'Le passage', 'Vous avez parcouru un chemin — maintenant transmettez-le',
                '<div style="font-size:.92rem;line-height:2.3;color:rgba(232,224,208,.85);font-style:italic;margin-bottom:1rem;border-left:3px solid rgba(201,168,76,.5);padding-left:1rem;">
                « On ne donne vraiment quelque chose que lorsqu\'on le transmet. »<br>
                <span style="font-size:.75rem;color:rgba(201,168,76,.6);">— Antoine de Saint-Exupéry</span>
                </div>
                Vous vous êtes rencontré·e. Vous avez reconnu vos blessures.<br>
                Vous avez décrit votre bonheur. Vous avez écouté votre souffle.<br>
                Vous avez bougé, régulé, visualisé — et choisi de vivre ici et maintenant.<br><br>
                <strong>Ce module est le rite de passage.</strong><br>
                Pas une leçon de plus — une consécration.<br>
                Vous avez vécu le Rituel Pause Souffle de l\'intérieur. Il est temps de le guider pour les autres.<br><br>
                Le Rituel que vous allez apprendre à transmettre n\'est pas une technique.<br>
                <em>C\'est une <strong>présence</strong>.</em><br><br>
                <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;font-size:.85rem;color:rgba(232,224,208,.75);">
                Ce module vous ouvre les portes de la <strong>Certification Praticien Pause Souffle Niveau 1</strong>.<br>
                Vous serez habilité·e à guider des séances individuelles et collectives — pour vos proches, votre entourage, ou vos futurs clients.
                </div>'
            );

        $lecon1 =
            $this->card($teal, 'Déontologie', 'L\'éthique du praticien — la colonne vertébrale de votre pratique',
                '<strong>Guider est un acte de responsabilité.</strong><br><br>
                Quand vous guidez une séance Pause Souffle, vous entrez dans l\'espace intérieur de quelqu\'un.<br>
                Cet espace est fragile et précieux. L\'éthique du praticien n\'est pas une formalité — c\'est votre fondation.<br><br>
                <div style="background:rgba(20,184,166,.08);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;">
                <strong style="color:rgba(20,184,166,.9);">Ce que le Rituel Pause Souffle EST :</strong><br>
                · Une pratique de <em>bien-être et de régulation du système nerveux</em><br>
                · Un espace de douceur, de présence et de ralentissement<br>
                · Un outil de prévention du burn-out et de reconnexion à soi<br>
                · Un accompagnement <em>complémentaire</em> à tout suivi médical
                </div>
                <div style="background:rgba(249,115,22,.06);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;">
                <strong style="color:rgba(249,115,22,.9);">Ce que le Rituel Pause Souffle N\'EST PAS :</strong><br>
                · Pas une thérapie — vous n\'êtes pas thérapeute ni médecin<br>
                · Pas un diagnostic — vous ne posez pas de diagnostic sur l\'état de quelqu\'un<br>
                · Pas un traitement — vous ne remplacez pas un suivi psychiatrique<br>
                · Pas un espace de conseil personnel — vous n\'orientez pas les décisions de vie
                </div>
                <strong>Les 4 piliers déontologiques :</strong><br>
                <strong style="color:rgba(201,168,76,.9);">① Confidentialité absolue</strong> — Ce qui se passe en séance reste entre vous et la personne.<br>
                <strong style="color:rgba(201,168,76,.9);">② Limites claires</strong> — Crise, deuil récent, dépression sévère : orientez vers un professionnel de santé.<br>
                <strong style="color:rgba(201,168,76,.9);">③ Non-jugement constant</strong> — Accueillir et guider, jamais évaluer ni corriger.<br>
                <strong style="color:rgba(201,168,76,.9);">④ Consentement éclairé</strong> — Expliquez ce que vous proposez et ce que vous ne proposez pas.<br><br>
                <div style="background:rgba(0,0,0,.2);border-left:3px solid rgba(20,184,166,.4);border-radius:0 8px 8px 0;padding:.7rem 1rem;font-size:.8rem;font-style:italic;color:rgba(232,224,208,.65);">
                « La première responsabilité d\'un praticien est de ne pas nuire — et d\'avoir la clarté de savoir quand orienter vers quelqu\'un d\'autre. »<br>
                <span style="font-size:.72rem;color:rgba(201,168,76,.5);">— Code de déontologie ICF</span>
                </div>'
            )
            .$this->card($blue, 'Posture', 'La posture du praticien — ce qui se transmet avant les mots',
                '<strong>Votre état intérieur précède toujours vos paroles.</strong><br><br>
                Avant de guider, vous devez vous ancrer vous-même.<br>
                Un praticien stressé, distrait ou non-présent transmet son état — pas la pratique.<br><br>
                <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;font-size:.85rem;">
                <strong style="color:rgba(59,130,246,.9);">Avant chaque séance :</strong><br>
                · 3 cycles de 5-5-5 en solo pour vous ancrer<br>
                · Posez l\'intention : <em>"Mon rôle est de créer un espace sécurisé."</em><br>
                · Voix posée, rythme lent — parlez comme vous respirez<br><br>
                <strong style="color:rgba(59,130,246,.9);">Pendant la séance :</strong><br>
                · Guidez à voix haute en pratiquant vous-même en silence<br>
                · Vos pauses sont aussi importantes que vos mots<br>
                · Observez sans juger — chaque personne vit la pratique différemment<br><br>
                <strong style="color:rgba(59,130,246,.9);">Après la séance :</strong><br>
                · Notez brièvement ce qui s\'est passé<br>
                · Ce que vous pouvez améliorer pour la prochaine fois
                </div>
                <em>La phrase à garder :<br>
                "Mon rôle est de créer un espace sécurisé pour que cette personne rencontre son propre calme intérieur.<br>
                Je ne guéris pas — j\'accompagne."</em>'
            );

        $lecon2 =
            $this->card($orange, 'Protocole 30 min', 'La structure complète d\'une séance guidée',
                '<strong>Le protocole standard — 30 minutes :</strong><br><br>
                <div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;font-size:.85rem;line-height:2.2;">
                <strong style="color:rgba(249,115,22,.9);">① Accueil — 5 minutes</strong><br>
                Créer l\'espace. Expliquer brièvement le déroulé. Obtenir le consentement de la personne.<br>
                <em>"Nous allons prendre 30 minutes ensemble. Il n\'y a rien à faire sauf respirer et observer."</em><br><br>
                <strong style="color:rgba(249,115,22,.9);">② Scan corporel — 5 minutes</strong><br>
                Guider l\'attention vers le corps. De la tête aux pieds, poser la présence.<br>
                <em>"Sentez le contact de votre corps avec la chaise… Comment est votre ventre ?"</em><br><br>
                <strong style="color:rgba(249,115,22,.9);">③ Pratique respiratoire — 15 minutes</strong><br>
                Le cœur de la séance. 5 à 7 cycles de 5-5-5 guidés, avec pauses de retour à la respiration naturelle.<br>
                Possibilité d\'intégrer cohérence cardiaque (5-5) ou respiration alternée selon la personne.<br><br>
                <strong style="color:rgba(249,115,22,.9);">④ Intégration et clôture — 5 minutes</strong><br>
                Retour progressif. Un mot, une image, une sensation. Ne pas précipiter.<br>
                <em>"Prenez un moment pour noter ce que vous avez ressenti — il n\'y a pas de bonne réponse."</em>
                </div>'
            )
            .$this->card($purple, 'Protocole 60 min', 'La séance approfondie — approfondissement et visualisation',
                '<strong>Version étendue — 60 minutes :</strong><br><br>
                <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;font-size:.85rem;line-height:2.2;">
                <strong style="color:rgba(168,85,247,.9);">① Accueil & intention — 10 min</strong><br>
                Accueil + question d\'intention : <em>"Qu\'est-ce que vous aimeriez recevoir de cette séance ?"</em><br><br>
                <strong style="color:rgba(168,85,247,.9);">② Scan corporel complet — 8 min</strong><br>
                Scan lent, tête aux pieds, avec observation des zones de tension.<br><br>
                <strong style="color:rgba(168,85,247,.9);">③ Exercice d\'ancrage — 5 min</strong><br>
                Contact sol, poids du corps, 3 respirations d\'ancrage avant la pratique principale.<br><br>
                <strong style="color:rgba(168,85,247,.9);">④ Cohérence cardiaque — 10 min</strong><br>
                5 minutes de respiration 5-5, rythmée et guidée.<br><br>
                <strong style="color:rgba(168,85,247,.9);">⑤ Visualisation guidée — 15 min</strong><br>
                Un voyagequide : lieu sécurisant intérieur, rencontre avec soi, ressource à ramener.<br><br>
                <strong style="color:rgba(168,85,247,.9);">⑥ Journal rapide — 7 min</strong><br>
                3 questions simples par écrit, non partagées, pour ancrer l\'expérience.<br><br>
                <strong style="color:rgba(168,85,247,.9);">⑦ Clôture — 5 min</strong><br>
                Un mot, une intention, un geste de gratitude envers soi.
                </div>'
            );

        $ex1 =
            $this->exercice($teal, '1', 'Pratiquer les deux protocoles sur soi-même',
                '<strong>Avant de guider, pratiquez sur vous-même.</strong><br><br>
                C\'est la règle fondamentale : vous ne pouvez pas guider ce que vous n\'avez pas vécu.<br><br>
                <strong>Exercice A — Le 30 minutes solo :</strong><br>
                Mettez un timer. Suivez la structure ①②③④ décrite en Leçon 2.<br>
                Guidez-vous à voix haute ou dans votre tête, comme si quelqu\'un était face à vous.<br>
                Notez : qu\'est-ce qui était fluide ? Qu\'est-ce qui était difficile à nommer ?<br><br>
                <strong>Exercice B — Le 60 minutes solo :</strong><br>
                Même exercice avec la structure complète. Enregistrez-vous si possible.<br>
                Réécoutez — pas pour vous juger, mais pour sentir votre rythme naturel.<br><br>
                <div style="background:rgba(20,184,166,.07);border-radius:10px;padding:.75rem 1rem;margin:.6rem 0;font-size:.82rem;color:rgba(232,224,208,.72);">
                <em>Un praticien qui a guidé 100 séances sur lui-même est plus puissant qu\'un praticien qui a guidé 100 personnes sans jamais s\'être guidé lui-même.</em>
                </div>', false
            );

        $ex2 =
            $this->exercice($gold, '2', 'La séance témoin — guider quelqu\'un pour la première fois',
                'Choisissez un proche volontaire : partenaire, ami·e, collègue de confiance.<br>
                Expliquez-lui : <em>"Je m\'entraîne à guider une séance de respiration consciente. C\'est 30 minutes. Tu peux t\'arrêter quand tu veux."</em><br><br>
                <strong>Déroulé :</strong><br>
                · Guidez la séance 30 minutes (protocole Leçon 2)<br>
                · Restez présent·e — observez sans intervenir<br>
                · À la fin, posez 2 questions seulement :<br>
                <em>"Comment tu te sens ?" · "Y a-t-il quelque chose que tu veux partager ?"</em><br><br>
                <strong>Après la séance, notez pour vous :</strong><br>
                · Ce qui s\'est bien passé<br>
                · Ce que je veux améliorer<br>
                · Ce que cette personne m\'a appris sur ma façon de guider<br><br>
                <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.75rem 1rem;font-size:.82rem;color:rgba(232,224,208,.72);">
                Cette première séance témoin est votre baptême en tant que praticien·ne.<br>
                <em>Elle compte. Même si elle est imparfaite — surtout si elle est imparfaite.</em>
                </div>', false
            )
            .$this->exercice($green, '3', 'Ma boîte à outils praticien — préparer mon espace de guidage',
                'Un bon praticien prépare son environnement autant que sa pratique.<br><br>
                <strong>Créez votre "kit praticien" minimal :</strong><br>
                · <strong>Espace physique</strong> : une pièce calme, lumière tamisée, température agréable<br>
                · <strong>Son</strong> : musique d\'ambiance optionnelle à 40-60 BPM (sons natura, bols tibétains)<br>
                · <strong>Timer</strong> : pour ne pas surveiller l\'heure pendant la séance<br>
                · <strong>Carnet</strong> : pour noter après chaque séance guidée<br>
                · <strong>Fiche de consentement</strong> : une phrase simple que la personne valide avant<br><br>
                <strong>Les mots à éviter :</strong><br>
                · "Vous devriez ressentir…" → <em>chacun vit la séance différemment</em><br>
                · "Détendez-vous" → <em>l\'injonction produit l\'effet inverse</em><br>
                · "C\'est normal de…" → <em>ne normalisez pas ce que vous n\'avez pas vécu</em><br><br>
                <strong>Les mots qui créent l\'espace :</strong><br>
                "Vous pouvez…" · "Si vous le souhaitez…" · "Peut-être remarquerez-vous…" · "Il n\'y a rien à faire sauf…"', false
            );

        $meditation =
            $this->exercice($orange, '4', '🌬 Pause Souffle de la transmission',
                '<strong>Durée : 10 minutes · La dernière Pause Souffle de la Formation 1</strong><br><br>
                <strong>① Ancrage du chemin parcouru (2 min)</strong><br>
                Installez-vous. Fermez les yeux. Sentez votre corps.<br>
                Parcourez mentalement les 11 modules en laissant une image, une sensation, un mot pour chacun.<br><br>
                <strong>② Le souffle du praticien (5 cycles 5-5-5)</strong><br>
                Inspirez 5 secondes : recevez ce que vous avez appris.<br>
                Retenez 5 secondes : laissez-le s\'intégrer jusqu\'au dernier atome de votre corps.<br>
                Expirez 5 secondes : offrez-le. Sans nom. Sans direction. Juste… libérer.<br><br>
                <strong>③ L\'intention du praticien</strong><br>
                Avant d\'ouvrir les yeux, posez cette intention intérieure :<br>
                <div style="background:rgba(249,115,22,.08);border-radius:10px;padding:.75rem 1rem;margin:.6rem 0;font-style:italic;font-size:.85rem;color:rgba(232,224,208,.8);">
                "Je guide depuis ce que j\'ai vécu.<br>
                Je transmets depuis ce que j\'ai traversé.<br>
                Mon rôle n\'est pas de guérir — c\'est de créer l\'espace où quelqu\'un peut se rencontrer lui-même."
                </div>', true
            );

        $reflexion =
            $this->exercice($indigo, '5', 'Ma déclaration de praticien·ne — le serment de la Formation 1',
                'Prenez votre journal. Écrivez en une page (ou plus) votre déclaration personnelle.<br><br>
                Commencez par ces 3 entrées :<br><br>
                <div style="background:rgba(99,102,241,.07);border-radius:10px;padding:.85rem 1.1rem;line-height:2.3;font-size:.83rem;color:rgba(232,224,208,.78);">
                <strong>① Qui j\'étais avant :</strong><br>
                <em>Avant cette Formation 1, j\'étais quelqu\'un qui…</em><br>
                Ce que je portais. Ce que je fuyais. Ce que j\'ignorais de moi.<br><br>
                <strong>② Ce que cette formation a transformé :</strong><br>
                <em>Aujourd\'hui, je sais que…</em><br>
                Un outil qui a changé quelque chose. Une leçon que je n\'oublierai pas. Un moment décisif.<br><br>
                <strong>③ Comment je compte transmettre le Rituel Pause Souffle :</strong><br>
                <em>Je veux guider…</em><br>
                À qui ? Sous quelle forme ? Dans quel contexte ? Avec quelle intention ?
                </div>
                <br>
                <div style="background:rgba(0,0,0,.2);border-left:3px solid rgba(201,168,76,.4);border-radius:0 8px 8px 0;padding:.7rem 1rem;font-size:.8rem;font-style:italic;color:rgba(232,224,208,.65);">
                «&nbsp;J\'ai couru très longtemps. J\'ai tout arrêté.<br>
                Et c\'est là que j\'ai tout trouvé — et infiniment plus. ∞+ »
                </div>', false
            );

        return [
            'description' => 'Je transmets le Rituel Pause Souffle — Éthique du praticien, protocoles de séance 30 et 60 minutes, séance témoin et déclaration de praticien·ne. Le module qui ferme la Formation 1 et ouvre la Certification Niveau 1.',
            'intro_text'  => "MODULE 12 — Je transmets le Rituel\n\nVous avez parcouru un chemin complet. Vous vous êtes rencontré·e, soigné·e, ancré·e et transformé·e.\n\nCe module est le rite de passage : apprendre à guider une séance Pause Souffle pour vos proches, votre entourage ou vos futurs clients. L'éthique, les protocoles, la posture — et la Déclaration qui consacre votre certification Praticien Pause Souffle Niveau 1.\n\nLe Rituel que vous transmettez n'est pas une technique. C'est une présence.",
            'audio_path'  => 'formation/audio/12-je-transmets-le-rituel-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '🎖 Introduction — Le rite de passage vers la certification',             'duration' => '4 min',  'description' => 'Le chemin parcouru en 11 modules. Ce module vous ouvre la Certification Praticien Pause Souffle Niveau 1.',                         'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — L\'éthique du praticien & la posture de guidage',              'duration' => '8 min',  'description' => 'Les 4 piliers déontologiques (ICF) · Ce que le Rituel est et n\'est pas · La posture avant, pendant et après la séance.',       'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Protocoles séance 30 min et 60 min',                           'duration' => '6 min',  'description' => 'Structure complète de la séance standard (30 min) et approfondie (60 min). Étape par étape, avec les mots exacts à utiliser.', 'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique — Les deux protocoles sur soi-même',                            'duration' => '30 min', 'description' => 'Se guider soi-même sur les deux protocoles avant de guider les autres. La règle fondamentale : pratiquer ce qu\'on enseigne.',  'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — Séance témoin & boîte à outils praticien',                    'duration' => '45 min', 'description' => 'Guider un proche volontaire pour la première fois + préparer son kit praticien (espace, son, mots à éviter / à utiliser).',      'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle de la transmission',                                     'duration' => '10 min', 'description' => 'Ancrage du chemin parcouru · Le souffle du praticien · Intention finale : guider depuis ce qu\'on a vécu.',                    'content' => $meditation, 'audio' => true],
                ['type' => 'reflexion', 'title' => 'Journal — Ma déclaration de praticien·ne',                               'duration' => '15 min', 'description' => 'Qui j\'étais avant · Ce que la Formation 1 a transformé · Comment je compte transmettre le Rituel Pause Souffle.',           'content' => $reflexion],
            ],
        ];
    }

    private function m10_present(): array  // Vivre ici et maintenant — La présence comme art de vivre
    {
        $gold   = 'rgba(201,168,76,.9)';
        $green  = 'rgba(34,197,94,.8)';
        $orange = 'rgba(249,115,22,.8)';
        $teal   = 'rgba(20,184,166,.8)';
        $blue   = 'rgba(59,130,246,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $indigo = 'rgba(99,102,241,.8)';

        $intro =
            $this->card($gold, 'Fondation', 'La seule question qui compte vraiment',
                '<div style="font-size:.92rem;line-height:2.3;color:rgba(232,224,208,.85);font-style:italic;margin-bottom:1rem;border-left:3px solid rgba(201,168,76,.5);padding-left:1rem;">
                « L\'instant présent est la seule porte qui ouvre sur tous les autres instants. »<br>
                <span style="font-size:.75rem;color:rgba(201,168,76,.6);">— Thich Nhat Hanh</span>
                </div>
                Vous avez traversé neuf modules.<br>
                Vous avez appris à vous rencontrer, à reconnaître vos blessures, à décrire votre bonheur.<br>
                Vous avez écouté votre souffle, découvert votre mission, incarné votre vision.<br>
                Vous avez bougé avec conscience, compris votre système nerveux, appris à réguler vos émotions.<br><br>
                Il reste une question — <strong>la plus importante de toutes</strong> :<br><br>
                <em>Où étiez-vous pendant tout ce temps ?</em><br><br>
                Nous construisons des projets qui n\'auront de sens que si nous sommes présents pour les vivre.<br>
                Nous travaillons pour un avenir qui n\'existera jamais, au détriment du seul moment réel : <strong>maintenant</strong>.<br><br>
                Ce module est une invitation à rentrer chez vous.<br>
                <em>Pas chez vous demain. Ici. Ce soir. Avec ceux qui sont là.</em>'
            );

        $lecon1 =
            $this->card($teal, 'Science', '47% du temps, vous n\'êtes pas là',
                '<strong>Killingsworth & Gilbert — Harvard, 2010</strong><br>
                L\'étude la plus rigoureuse jamais conduite sur le bonheur quotidien.<br>
                2 250 adultes · 83 pays · 250 000 moments de vie mesurés en temps réel.<br><br>
                Le résultat :<br>
                <div style="background:rgba(20,184,166,.08);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;font-size:.88rem;text-align:center;">
                <strong style="color:rgba(20,184,166,.9);font-size:1.1rem;">46,9% du temps de veille</strong><br>
                <span style="color:rgba(232,224,208,.65);">les êtres humains pensent à autre chose que ce qu\'ils font</span>
                </div>
                Et ce chiffre monte à <strong>65%</strong> pendant les transports, <strong>50%</strong> au travail, <strong>40%</strong> même lors d\'activités agréables.<br><br>
                Conclusion directe : <em>Un esprit qui vagabonde est un esprit malheureux</em>.<br>
                La qualité de l\'activité importe moins que la qualité de la présence à cette activité.<br><br>
                Ce n\'est pas une métaphore spirituelle. C\'est une donnée mesurée de votre vie.'
            )
            .$this->card($blue, 'Neuroscience', 'Le réseau par défaut — le fantôme dans la machine',
                'Le <strong>Default Mode Network (DMN)</strong> est le réseau neuronal qui s\'active quand vous n\'êtes pas concentré·e.<br>
                Il implique le cortex préfrontal médian, le cortex cingulaire postérieur et le précuneus.<br><br>
                Son rôle : ruminer le passé, projeter l\'avenir, comparer, planifier, fantasmer.<br><br>
                Le problème : il s\'active <em>aussi</em> pendant les moments importants.<br>
                Pendant un repas en famille. Pendant que votre enfant vous parle. Pendant que votre partenaire vous regarde.<br><br>
                <strong>Ce n\'est pas un défaut. C\'est une fonction.</strong><br>
                Mais non régulée, elle vole votre vie en direct.<br><br>
                La bonne nouvelle : les études en neuroimagerie (fMRI) montrent que la pratique régulière de pleine conscience <strong>réduit l\'activation excessive du DMN</strong>.<br>
                Vous n\'éteignez pas le réseau. Vous n\'en êtes plus capturé·e.'
            );

        $lecon2 =
            $this->card($orange, 'Les 3 temps', 'Passé, présent, futur — les utiliser sans en être esclave',
                '<strong>Le passé</strong><br>
                ✓ Ressource : mémoriser, apprendre, s\'équiper, reconnaître ses forces acquises<br>
                ✗ Piège : ruminer en boucle ce qu\'on ne peut plus modifier<br><br>
                <strong>Le futur</strong><br>
                ✓ Utilité : planifier avec clarté, poser des intentions, construire une trajectoire<br>
                ✗ Piège : anxiété compulsive, sacrifier le présent pour un futur hypothétique<br><br>
                <strong>Le présent</strong><br>
                ✓ C\'est ici que vous agissez, ressentez, aimez, créez, existez vraiment<br>
                ✗ Paradoxe : c\'est le seul temps réel, et c\'est celui où vous êtes le moins<br><br>
                <div style="background:rgba(249,115,22,.08);border-radius:10px;padding:.75rem 1rem;margin-top:.75rem;font-style:italic;font-size:.82rem;color:rgba(232,224,208,.75);border-left:3px solid rgba(249,115,22,.4);">
                « Perdez-vous dans le présent. Vous n\'avez jamais besoin d\'autre chose. »<br>
                <span style="font-size:.72rem;color:rgba(249,115,22,.6);">— Marc Aurèle, Méditations, Livre VIII</span>
                </div>'
            )
            .$this->card($purple, 'Philosophie & Psychologie', 'Le seul endroit où la vie se passe vraiment',
                'La thérapie ACT (Acceptance and Commitment Therapy, Steven Hayes) pose un principe fondateur :<br>
                <em>Le seul moment où vous pouvez agir selon vos valeurs, c\'est maintenant.</em><br><br>
                Viktor Frankl, survivant des camps de concentration, a démontré que même dans l\'extrême,<br>
                il reste une liberté intacte : <strong>choisir sa réponse</strong> — dans cet instant précis.<br><br>
                L\'infirmière Bronnie Ware, après deux décennies en soins palliatifs, a compilé les regrets les plus fréquents de ses patients mourants :<br>
                <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.75rem 1rem;margin:.75rem 0;font-size:.82rem;color:rgba(232,224,208,.75);">
                <strong>1.</strong> "J\'aurais voulu avoir le courage de vivre ma propre vie, pas celle qu\'on attendait de moi."<br>
                <strong>2.</strong> "J\'aurais voulu ne pas avoir autant travaillé."<br>
                <strong>3.</strong> "J\'aurais voulu avoir gardé contact avec mes amis."<br>
                <strong>5.</strong> "J\'aurais voulu m\'être permis d\'être plus heureux·se."
                </div>
                <em>Personne ne dit : "J\'aurais voulu avoir fini mon projet plus vite."</em><br>
                Tout le monde dit : "J\'aurais voulu être plus là."'
            );

        $ex1 =
            $this->exercice($gold, '1', 'La technique STOP — 60 secondes pour revenir',
                'Protocole issu du programme MBSR (Jon Kabat-Zinn, UMass Medical School) :<br><br>
                <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.9rem 1.1rem;margin:.75rem 0;">
                <strong style="color:rgba(201,168,76,.9);">S — Stop</strong><br>
                Arrêtez physiquement toute activité. Lâchez le téléphone. Levez les yeux de l\'écran.<br><br>
                <strong style="color:rgba(201,168,76,.9);">T — Take a breath</strong><br>
                Une seule inspiration lente (5s) · Une expiration complète (5s).<br>
                Une seule suffit pour rompre le pilotage automatique.<br><br>
                <strong style="color:rgba(201,168,76,.9);">O — Observe</strong><br>
                Qu\'est-ce qui se passe en vous EN CE MOMENT MÊME ?<br>
                Corps → émotions → pensées. Sans juger. Sans corriger.<br><br>
                <strong style="color:rgba(201,168,76,.9);">P — Proceed</strong><br>
                Continuez ce que vous faisiez — mais <em>conscient·e</em>.<br>
                Ce que vous faites change quand vous y êtes vraiment.
                </div>
                <strong>À intégrer avant :</strong><br>
                · Chaque repas en famille<br>
                · Chaque entrée dans votre domicile après le travail<br>
                · Chaque conversation importante<br>
                · Chaque fois que vous sentez votre esprit "décrocher" de la pièce', false
            );

        $ex2 =
            $this->exercice($teal, '2', 'L\'audit de présence — mesurer sa propre absence',
                '<strong>Durée : 1 journée complète</strong><br>
                Programmez 5 alarmes aléatoires dans la journée.<br>
                À chaque alarme, répondez immédiatement dans un carnet :<br>
                · Est-ce que je pense à ce que je fais EN CE MOMENT ?<br>
                · Si non : où est mon esprit ? (passé / futur / inquiétude / distraction)<br>
                · Qui est avec moi maintenant ? Suis-je vraiment là pour cette personne ?<br><br>
                <strong>En fin de journée :</strong><br>
                Combien de vos moments ont été vraiment vécus ?<br>
                Dans quelles situations étiez-vous le plus absent·e ?<br>
                Qui était présent dans votre vie pendant que vous étiez ailleurs ?<br><br>
                <em>Cet audit ne génère pas de culpabilité. Il génère de la conscience.<br>
                Ce que l\'on mesure, on peut le transformer.</em>', false
            )
            .$this->exercice($green, '3', 'La lettre de présence — réparer l\'absence avant qu\'il soit trop tard',
                'Choisissez une personne à qui vous devez de la présence.<br>
                (Un enfant, un partenaire, un ami, un parent — quelqu\'un qui vous attendait<br>
                pendant que vous étiez "ailleurs".)<br><br>
                Écrivez-lui une lettre. À la main si possible.<br><br>
                Commencez par :<br>
                <div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.75rem 1rem;margin:.6rem 0;font-style:italic;font-size:.83rem;color:rgba(232,224,208,.78);">
                "Je t\'écris parce que j\'ai réalisé que j\'étais souvent ailleurs quand nous étions ensemble.<br>
                Pas par manque d\'amour. Par manque de présence.<br>
                Voici ce que j\'aurais voulu te donner davantage..."
                </div>
                Ne l\'envoyez pas immédiatement (sauf si vous le souhaitez vraiment).<br>
                Cet exercice est un acte de conscience — pas de culpabilité.<br>
                <em>L\'intention sincère de revenir est déjà un cadeau.</em>', false
            );

        $meditation =
            $this->exercice($orange, '4', '🌬 Pause Souffle de l\'instant présent',
                '<strong>Durée : 5-7 minutes · À pratiquer avant ou après un moment important</strong><br><br>
                <strong>① Installez-vous</strong> (assis ou debout, là où vous êtes)<br>
                3 cycles 5-5-5 pour entrer dans le calme.<br><br>
                <strong>② La question intérieure</strong><br>
                Posez-vous : <em>"Que se passe-t-il dans mon corps, en ce moment même ?"</em><br>
                Parcourez : tête → épaules → poitrine → ventre → mains → pieds.<br><br>
                <strong>③ L\'ancrage sensoriel 5-4-3-2-1</strong><br>
                · 5 sensations physiques sur votre peau (température, texture, contact)<br>
                · 4 sons que vous pouvez entendre maintenant<br>
                · 3 éléments que vous pouvez voir (sans bouger la tête)<br>
                · 2 odeurs ou goûts résiduels<br>
                · 1 sensation de souffle (à l\'entrée des narines)<br><br>
                <strong>④ Respiration d\'ancrage</strong><br>
                Inspirez en pensant : <em>"Je suis ICI."</em><br>
                Expirez en pensant : <em>"Je vis MAINTENANT."</em><br>
                3 fois. Lentement.<br><br>
                <em>Ce n\'est pas une technique. C\'est une décision : choisir d\'être là où vous êtes.</em>', true
            );

        $reflexion =
            $this->exercice($indigo, '5', 'Mon présent le plus précieux',
                'Dans votre journal, répondez aux questions suivantes. Prenez le temps qu\'il faut.<br>
                Pas de bonne réponse. Juste de la vérité.<br><br>
                <div style="background:rgba(99,102,241,.07);border-radius:10px;padding:.85rem 1.1rem;line-height:2.1;font-size:.83rem;color:rgba(232,224,208,.78);">
                · <strong>Si demain n\'existait pas</strong>, comment vivrais-je aujourd\'hui ?<br>
                · <strong>À qui</strong> est-ce que je dois davantage de ma présence — et est-ce que je la leur donne vraiment ?<br>
                · Quelle est la différence entre <strong>construire sa vie</strong> et <strong>vivre sa vie</strong> ?<br>
                · Qu\'est-ce que j\'ai <strong>manqué ces derniers mois</strong> parce que j\'étais "ailleurs" ?<br>
                · Qu\'est-ce que je veux <strong>vivre vraiment</strong>, pas juste accomplir — cette semaine ?
                </div>
                <br>
                <div style="background:rgba(0,0,0,.2);border-left:3px solid rgba(201,168,76,.4);border-radius:0 8px 8px 0;padding:.7rem 1rem;font-size:.8rem;font-style:italic;color:rgba(232,224,208,.65);">
                « Dans dix ans, vous serez bien plus déçu·e des choses que vous n\'avez pas faites<br>
                que de celles que vous avez faites. »<br>
                <span style="font-size:.72rem;color:rgba(201,168,76,.5);">— Mark Twain</span>
                </div>', false
            );

        return [
            'description' => 'Vivre ici et maintenant — La présence comme art de vivre. Harvard, neurosciences et philosophie au service d\'une seule décision : être là, vraiment, pour ce qui compte.',
            'intro_text'  => "MODULE 10 — Je vis ici et maintenant\n\nVous avez traversé neuf modules. Vous savez vous rencontrer, réguler vos émotions, bouger avec conscience.\n\nIl reste la question la plus fondamentale : où êtes-vous pendant tout ce temps ?\n\nHarvard a mesuré que nous passons 46,9% de notre vie à penser à autre chose qu'à ce que nous faisons. Et les personnes en fin de vie ne regrettent pas d'avoir trop peu travaillé. Elles regrettent d'avoir trop peu été là.\n\nCe module est le capstone de votre première formation. Avant de changer de niveau, posez-vous une seule question : est-ce que je vis vraiment le présent que je construis si durement ?",
            'audio_path'  => 'formation/audio/10-vivre-ici-maintenant-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '⏳ Introduction — La seule question qui compte',              'duration' => '4 min',  'description' => 'Le paradoxe humain : nous construisons notre avenir si intensément que nous oublions de vivre le présent que nous avons déjà.',          'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — La science de l\'absence',                          'duration' => '6 min',  'description' => 'Harvard 2010 : 47% du temps, vous n\'êtes pas là. Le Default Mode Network et comment la pratique le régule.',                       'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Passé, présent, futur & philosophie de la présence', 'duration' => '5 min',  'description' => 'Marc Aurèle, Viktor Frankl, ACT, Bronnie Ware. Ce que les mourants regrettent le plus — et ce que vous pouvez encore choisir.', 'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique — La technique STOP',                                'duration' => '15 min', 'description' => 'MBSR (Jon Kabat-Zinn) : Stop · Take a breath · Observe · Proceed. 60 secondes pour sortir du pilotage automatique.',              'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — Audit de présence & Lettre',                       'duration' => '30 min', 'description' => 'Une journée d\'audit de présence (5 alarmes) + lettre à une personne à qui vous devez davantage d\'attention.',               'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle de l\'instant présent',                      'duration' => '7 min',  'description' => 'Ancrage 5-4-3-2-1 + respiration guidée : "Je suis ICI — Je vis MAINTENANT." Le rituel de retour à soi.',                     'content' => $meditation, 'audio' => true],
                ['type' => 'reflexion', 'title' => 'Journal — Mon présent le plus précieux',                      'duration' => '10 min', 'description' => '5 questions qui changent la perspective : si demain n\'existait pas, à qui dois-je ma présence, que veux-je vivre vraiment ?', 'content' => $reflexion],
            ],
        ];
    }

    private function m10(): array  // Sommeil & Récupération
    {
        $gold   = 'rgba(201,168,76,.9)';
        $indigo = 'rgba(99,102,241,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $green  = 'rgba(34,197,94,.8)';
        $blue   = 'rgba(59,130,246,.8)';

        $intro = $this->card($gold, 'Pourquoi', 'Le sommeil n\'est pas un luxe — c\'est la base du système',
            'Pendant le sommeil :<br>
            · Les neurones consolident les apprentissages (mémoire à long terme)<br>
            · Le système lymphatique nettoie les déchets métaboliques du cerveau<br>
            · Le cortisol chute au minimum (fenêtre de récupération surrénalienne)<br>
            · Les cellules immunitaires se multiplient (pic nocturne entre 1h et 3h)<br>
            · La leptine (hormone de satiété) est sécrétée (manque de sommeil = fringales)<br><br>
            <strong>7 à 9 heures ne sont pas une préférence — c\'est le besoin biologique minimum de 98% des adultes.</strong><br>
            Dormir 6h génère un déficit cognitif équivalent à 1,5 jour sans dormir (Van Dongen, 2003).'
        );
        $lecon1 = $this->card($indigo, 'L\'architecture du sommeil', 'Comprendre les cycles pour mieux dormir',
            '<strong>Un cycle dure 90 minutes.</strong> Pour 7h30 de sommeil = 5 cycles complets.<br><br>
            <strong>Phases :</strong><br>
            · <strong>N1 (5%)</strong> — endormissement, facile à réveiller<br>
            · <strong>N2 (50%)</strong> — sommeil léger, début de la consolidation<br>
            · <strong>N3 — Sommeil lent profond (20%)</strong> — récupération physique maximale, sécrétions GH (hormone de croissance)<br>
            · <strong>REM / Paradoxal (25%)</strong> — rêves, consolidation émotionnelle et mémorielle<br><br>
            <strong>Astuce pro :</strong> les cycles N3 sont plus longs en début de nuit. Se coucher à minuit au lieu de 22h prive de 30 à 40% du sommeil profond.'
        );
        $lecon2 = $this->card($purple, 'Hygiène du sommeil', '8 règles non-négociables',
            '① <strong>Température pièce</strong> : 17-19°C optimal (la chute de température centrale déclenche l\'endormissement)<br>
            ② <strong>Obscurité totale</strong> : même la lumière d\'un écran de veille supprime la mélatonine<br>
            ③ <strong>Régularité</strong> : même heure de lever 7j/7 (y compris weekend)<br>
            ④ <strong>Lumière bleue</strong> : éteindre les écrans 90 minutes avant de dormir ou lunettes anti-lumière bleue<br>
            ⑤ <strong>Caféine</strong> : demi-vie de 5-7 heures → pas après 14h<br>
            ⑥ <strong>Alcool</strong> : fragmente le REM (sensation de sommeil non réparateur)<br>
            ⑦ <strong>Repas du soir</strong> : finir 2h avant le coucher<br>
            ⑧ <strong>Rituel de décompression</strong> : 20 minutes de transition entre activité et sommeil (lecture, étirements, Pause Souffle)'
        );
        $ex1 = $this->exercice($indigo, '1', 'La Pause Souffle du soir (10 min, couché)',
            'Allongé sur le dos. Lumière éteinte.<br>
            <strong>Inspiration 5s</strong> — par le nez, très lentement.<br>
            <strong>Rétention 5s</strong> — léger. Pas d\'effort.<br>
            <strong>Expiration 5s</strong> — par la bouche entrouverte en faisant "haaaaa".<br>
            8 cycles.<br>
            <em>Le relâchement de la mâchoire et le son sur l\'expiration activent le réflexe de somnolence via le nerf vague.</em>', true
        );
        $ex2 = $this->exercice($purple, '2', 'La technique 4-7-8 (anti-insomnie)',
            'Si vous n\'arrivez pas à dormir :<br>
            Inspiration 4s → Rétention 7s → Expiration 8s.<br>
            4 répétitions. Jamais plus.<br>
            <em>La rétention de 7s augmente le CO2 sanguin, ce qui provoque un ralentissement réflexe du rythme cardiaque — effet somnifère naturel (Dr Andrew Weil).</em>', false
        );
        $meditation = $this->card($indigo, 'Méditation guidée', '🌬 Pause Souffle — Préparation au sommeil (10 min)',
            'Allongé dans votre lit. Lumière éteinte ou très tamisée.<br><br>
            <strong>Phase 1 — Relâchement progressif (5 min)</strong><br>
            Commencez par les pieds. Inspirez 5s en contractant légèrement, rétention 2s, expirez 5s en relâchant tout.<br>
            Remontez lentement : mollets → cuisses → fessiers → ventre → poitrine → épaules → mains → visage.<br><br>
            <strong>Phase 2 — Respiration de somnolence (5 min)</strong><br>
            Inspirez 5s — par le nez, ventre d\'abord.<br>
            Rétention 5s — très douce, presque imperceptible.<br>
            Expirez 5s — par la bouche entrouverte, son "haaaaa" à peine audible.<br><br>
            Laissez les pensées passer comme des nuages — ne les retenez pas.<br><br>
            <em>Ce protocole réduit le temps d\'endormissement et augmente le sommeil profond N3.</em>'
        );
        $reflexion = $this->card($green, 'Journal', 'Clôture du module — Ma décharge du soir',
            'Chaque soir, 5 minutes avant le rituel de sommeil :<br><br>
            Prenez un carnet et notez :<br>
            <strong>1.</strong> Trois choses concrètes accomplies aujourd\'hui (même petites)<br>
            <strong>2.</strong> Une chose que vous relâchez (un souci, une inquiétude, quelque chose d\'inachevé)<br>
            <strong>3.</strong> L\'intention de demain en une phrase<br><br>
            Fermez le carnet. Le cerveau n\'a plus besoin de "tenir" ces informations.<br><br>
            <em>Cette technique réduit le temps d\'endormissement de 37% en évacuant la rumination nocturne (Harvey, Bélanger — Cognitive Therapy Approach).</em>'
        );

        return [
            'description' => 'Le sommeil comme fondation de la santé — comprendre les cycles, l\'hygiène du sommeil et 3 rituels pour mieux dormir dès ce soir.',
            'intro_text'  => "MODULE 10 — Sommeil & Récupération\n\nOn récupère la nuit. On consolide les apprentissages, on répare les cellules, on régule les hormones. Sans sommeil de qualité, rien ne fonctionne correctement — ni le corps, ni les émotions, ni la concentration. Ce module vous donne les outils pour transformer vos nuits.",
            'audio_path'  => 'formation/audio/10-sommeil-recuperation-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '🌙 Introduction — Le sommeil, base de tout',            'duration' => '4 min',  'description' => 'Pourquoi le sommeil n\'est pas optionnel et ce qui se passe réellement la nuit.', 'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — L\'architecture du sommeil',                  'duration' => '4 min',  'description' => 'Les cycles de 90 minutes, les phases N1/N2/N3/REM et comment en tirer le meilleur.', 'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Les 8 règles d\'hygiène du sommeil',          'duration' => '4 min',  'description' => 'Les règles non-négociables pour un sommeil réparateur.', 'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique guidée — Pause Souffle du soir couché',         'duration' => '10 min', 'description' => 'La technique respiratoire à pratiquer dans le lit pour favoriser l\'endormissement.', 'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — Technique 4-7-8 anti-insomnie',              'duration' => '5 min',  'description' => 'Le protocole d\'urgence quand le sommeil refuse de venir.', 'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle — Préparation au sommeil',             'duration' => '10 min', 'description' => 'Méditation de relâchement progressif pour préparer le corps au sommeil profond.', 'content' => $meditation],
                ['type' => 'reflexion', 'title' => 'Journal — Ma décharge du soir',                         'duration' => '5 min',  'description' => 'Le rituel d\'écriture en 3 étapes pour libérer le mental avant de dormir.', 'content' => $reflexion],
            ],
        ];
    }

    private function m11(): array  // Relation à l'alimentation
    {
        $gold   = 'rgba(201,168,76,.9)';
        $green  = 'rgba(34,197,94,.8)';
        $orange = 'rgba(249,115,22,.8)';
        $teal   = 'rgba(20,184,166,.8)';
        $blue   = 'rgba(59,130,246,.8)';

        $intro = $this->card($gold, 'Philosophie', 'L\'alimentation comme relation — pas comme règle',
            'La plupart des approches nutritionnelles créent une relation de contrôle avec la nourriture.<br>
            Des règles. Des interdits. Des calculs.<br><br>
            Cette approche génère souvent l\'effet inverse : obsession, culpabilité, cycles restriction/excès.<br><br>
            <strong>Pause Souffle propose une autre voie :</strong><br>
            Revenir à l\'écoute du corps.<br>
            Manger quand le corps a faim (pas l\'horloge).<br>
            Reconnaître la satiété avant la saturation.<br>
            Sentir comment chaque aliment affecte l\'énergie, l\'humeur, la clarté mentale.<br><br>
            <em>Ce n\'est pas un régime. C\'est un retour à l\'intelligence corporelle.</em>'
        );
        $lecon1 = $this->card($green, 'Les signaux du corps', 'Faim physique vs faim émotionnelle',
            '<strong>Faim physique :</strong><br>
            · Apparaît progressivement<br>
            · Tout aliment appétissant (y compris brocoli)<br>
            · Disparaît quand le corps est rassasié<br>
            · Pas de culpabilité après avoir mangé<br><br>
            <strong>Faim émotionnelle :</strong><br>
            · Apparaît soudainement<br>
            · Envie spécifique (sucré, salé, gras — pas "du brocoli")<br>
            · Ne disparaît pas vraiment même après avoir mangé<br>
            · Culpabilité ou vide émotionnel après<br><br>
            <em>La faim émotionnelle n\'est pas un défaut de volonté — c\'est le corps qui cherche du dopamine, pas des nutriments.</em>'
        );
        $lecon2 = $this->card($orange, 'Digestion & système nerveux', 'Pourquoi manger stressé nuit à la digestion',
            'En mode sympathique (stress), la digestion est suspendue.<br>
            Le sang quitte les organes digestifs pour aller vers les muscles (réflexe de fuite/combat).<br><br>
            <strong>Conséquences d\'un repas pris sous stress :</strong><br>
            · Ralentissement du transit<br>
            · Fermentation bactérienne dans l\'intestin grêle<br>
            · Malabsorption des micronutriments<br>
            · Reflux, ballonnements, fatigue postprandiale<br><br>
            <strong>Solution Pause Souffle :</strong> 3 cycles 5-5-5 avant chaque repas principal.<br>
            Résultat : activation du parasympathique — la digestion redevient prioritaire.'
        );
        $ex1 = $this->exercice($gold, '1', 'La Pause Souffle avant le repas (2 min)',
            'Avant de vous asseoir pour manger :<br>
            Posez les mains sur la table ou sur les cuisses.<br>
            3 cycles 5-5-5 complets. Les yeux fermés si possible.<br>
            Avant de commencer : observez votre assiette 10 secondes. Sentez les arômes. Notez les couleurs.<br>
            <em>Ces 2 minutes activent les enzymes digestives et réduisent le cortisol avant le repas.</em>', false
        );
        $ex2 = $this->exercice($teal, '2', 'Manger en pleine conscience — 1 repas par jour',
            'Choisissez UN repas par jour pour cette pratique (idéalement le déjeuner).<br>
            Pas d\'écran. Pas de conversation stressante.<br>
            Posez la fourchette entre chaque bouchée.<br>
            Mastiquez 15 à 20 fois (la digestion des glucides commence dans la bouche).<br>
            Notez mentalement : sucré, salé, umami, texture, température.<br>
            <em>Après 3 semaines : la satiété se perçoit 10 à 15 minutes plus tôt.</em>', false
        );
        $meditation = $this->card($teal, 'Méditation guidée', '🌬 Pause Souffle — Connexion corps-nourriture (5 min)',
            'À pratiquer avant chaque repas principal :<br><br>
            <strong>Posez les mains à plat sur la table.</strong><br>
            Fermez les yeux.<br><br>
            <strong>Inspiration 5s</strong> — imaginez que vous "accueillez" le repas à venir dans votre corps.<br>
            <strong>Rétention 5s</strong> — posez la question intérieure : "Ai-je physiquement faim ?"<br>
            <strong>Expiration 5s</strong> — relâchez le stress ou les pensées extérieures au repas.<br><br>
            3 cycles. Ouvrez les yeux. Regardez votre assiette 10 secondes avant de commencer.<br><br>
            <em>Ce rituel de 2 minutes bascule le système nerveux vers le mode parasympathique — la digestion optimale commence ici, pas dans l\'estomac.</em>'
        );
        $reflexion = $this->card($gold, 'Journal', 'Clôture du module — Mon journal alimentaire émotionnel',
            'Pendant 7 jours, notez après chaque repas en 3 points :<br><br>
            · <strong>État avant</strong> (calme, stressé, triste, joyeux, distrait)<br>
            · <strong>Ce que j\'ai mangé</strong> (1 ligne, sans culpabilité)<br>
            · <strong>État après</strong> (léger, lourd, satisfait, coupable, neutre)<br><br>
            Après 7 jours : cherchez les patterns.<br>
            · Quel état émotionnel déclenche quelle envie alimentaire ?<br>
            · Quels repas me laissent léger et rechargé ?<br>
            · Y a-t-il une heure ou un contexte où manger me sert à fuir quelque chose ?<br><br>
            <em>Ce retour d\'information personnalisé vaut plus que n\'importe quelle règle nutritionnelle générale.</em>'
        );

        return [
            'description' => 'Relation à l\'alimentation — manger en conscience, reconnaître la faim émotionnelle, et activer la digestion grâce à la respiration.',
            'intro_text'  => "MODULE 11 — Relation à l'Alimentation\n\nManger n'est pas une règle à respecter. C'est une relation à construire — avec votre corps, ses signaux, et ce dont il a réellement besoin. Ce module vous ramène à l'intelligence naturelle de la faim et de la satiété, que la modernité nous a fait oublier.",
            'audio_path'  => 'formation/audio/11-relation-alimentation-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '🍽 Introduction — L\'alimentation comme relation',        'duration' => '3 min',  'description' => 'Pourquoi les régimes créent l\'effet inverse et comment revenir à l\'intelligence corporelle.', 'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — Les signaux du corps',                          'duration' => '4 min',  'description' => 'Distinguer la faim physique de la faim émotionnelle — les 8 différences clés.', 'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Digestion & système nerveux',                   'duration' => '4 min',  'description' => 'Pourquoi manger stressé nuit à la digestion et comment y remédier.', 'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique — Pause Souffle avant le repas',                 'duration' => '2 min',  'description' => 'Le rituel de 2 minutes qui active la digestion et la conscience alimentaire.', 'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — Manger en pleine conscience',                  'duration' => '20 min', 'description' => 'Un repas par jour en présence totale pour retrouver les signaux naturels de satiété.', 'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle — Connexion corps-nourriture',           'duration' => '5 min',  'description' => 'Méditation de préparation au repas pour activer le mode digestif parasympathique.', 'content' => $meditation],
                ['type' => 'reflexion', 'title' => 'Journal — Mon journal alimentaire émotionnel',            'duration' => '7 jours','description' => 'Une semaine d\'observation pour identifier ses patterns alimentaires émotionnels.', 'content' => $reflexion],
            ],
        ];
    }

    private function m12(): array  // Présence à soi
    {
        $gold   = 'rgba(201,168,76,.9)';
        $teal   = 'rgba(20,184,166,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $blue   = 'rgba(59,130,246,.8)';

        $intro = $this->card($gold, 'Fondation', 'Qu\'est-ce que la présence à soi ?',
            'La présence à soi n\'est pas de l\'égocentrisme.<br>
            C\'est la capacité à <strong>sentir ce qui se passe en vous — maintenant</strong>.<br><br>
            Sans être emporté par le passé (rumination) ou le futur (anxiété).<br><br>
            <strong>Pourquoi c\'est difficile :</strong><br>
            · Le cerveau humain passe 47% de son temps à "vagabonder" hors du moment présent (Harvard Mind-Wandering Study, 2010)<br>
            · Chaque notification, chaque scrolling, chaque multitâche fragmente la présence<br>
            · La culture de la productivité récompense l\'action constante et pénalise le "ne rien faire"<br><br>
            <em>La présence est un muscle. Elle se développe par la pratique régulière.</em>'
        );
        $lecon1 = $this->card($teal, 'Ralentir', 'Pourquoi aller moins vite est un acte de courage',
            'Ralentir n\'est pas du luxe. C\'est une nécessité biologique.<br><br>
            Le cortex préfrontal — siège de la créativité, du jugement, de l\'empathie — ne fonctionne bien qu\'en mode lent.<br>
            La vitesse constante maintient le sympathique actif : décisions réactives, pensée en mode survie.<br><br>
            <strong>Les 3 pratiques qui développent la présence :</strong><br>
            ① La respiration consciente (déjà intégrée dans votre Pause Souffle)<br>
            ② La marche sans téléphone (marchepied sensoriel)<br>
            ③ Le silence voulu (5 à 20 min/jour sans stimulation externe)'
        );
        $lecon2 = $this->card($purple, 'Présence et corps', 'Le corps comme ancre dans le présent',
            'Quand l\'esprit vagabonde, le corps lui est toujours là — dans le présent.<br><br>
            C\'est pourquoi les techniques somatiques (corps) sont plus efficaces que les techniques purement cognitives pour revenir au moment présent :<br>
            · Sentir ses pieds sur le sol<br>
            · Sentir le contact du dos contre la chaise<br>
            · Porter l\'attention sur la chaleur des mains<br>
            · Écouter les sons ambiants sans les nommer<br><br>
            <em>Ces micro-pratiques d\'ancrage prennent 10 secondes et ramènent immédiatement le système nerveux dans le présent.</em>'
        );
        $ex1 = $this->exercice($gold, '1', 'La Pause Présence (2 min, à tout moment)',
            'Arrêtez. Posez les deux pieds à plat sur le sol.<br>
            Sentez le sol sous vos pieds. Toute la plante.<br>
            Sentez votre dos (dossier, chaise, mur — ce qui est là).<br>
            Inspiration 5s — en observant comment l\'air entre.<br>
            Rétention 5s — en remarquant le silence intérieur.<br>
            Expiration 5s — en sentant le relâchement.<br>
            3 cycles. Rouvrez les yeux doucement.<br>
            <em>Résultat immédiat : reconnexion au corps, réduction du bruit mental.</em>', true
        );
        $ex2 = $this->exercice($teal, '2', 'La marche sensorielle (10 min)',
            'Marchez seul, sans téléphone, sans musique.<br>
            Ralentissez de 30% par rapport à votre rythme habituel.<br>
            Sentez chaque appui de pied. Talon → voûte → avant-pied.<br>
            Notez 3 sons. 3 textures (vent, tissu). 3 choses que vous voyez vraiment.<br>
            Respirez librement — pas de 5-5-5, juste la respiration naturelle consciente.<br>
            <em>La marche consciente active le réseau de repos du cerveau (Default Mode Network) — source de créativité et d\'insight.</em>', false
        );
        $meditation = $this->card($purple, 'Méditation guidée', '🌬 Pause Souffle — Présence totale (8 min)',
            'Asseyez-vous. Fermez les yeux.<br><br>
            <strong>Étape 1 — Ancrage corporel (2 min)</strong><br>
            Sentez vos pieds sur le sol. Sentez le contact de la chaise sous vous.<br>
            Sentez la chaleur de vos mains posées sur les cuisses.<br>
            3 cycles 5-5-5 en portant l\'attention sur ces 3 ancrages.<br><br>
            <strong>Étape 2 — Présence sensorielle (3 min)</strong><br>
            Sans ouvrir les yeux :<br>
            · 3 sons que vous entendez maintenant (nommez-les intérieurement)<br>
            · L\'air sur votre peau (température, mouvement)<br>
            · Le rythme naturel de votre respiration<br><br>
            <strong>Étape 3 — Retour dans le moment (3 min)</strong><br>
            3 derniers cycles 5-5-5 très lents.<br>
            Sur chaque inspiration : "Je suis ici."<br>
            Sur chaque expiration : "Maintenant."<br><br>
            <em>Cette pratique développe le muscle attentionnel qui résiste au vagabondage mental.</em>'
        );
        $reflexion = $this->card($gold, 'Rituel', 'Le rituel du seuil — Clôture du module',
            'À chaque franchissement de porte (bureau, voiture, maison) :<br>
            Faites une pause de 10 secondes.<br>
            Un souffle profond. Un relâchement des épaules.<br>
            Posez l\'intention : <em>"De quoi ai-je besoin dans la prochaine heure ?"</em><br><br>
            <strong>Journal de clôture (5 min) :</strong><br>
            · Dans quelles situations suis-je vraiment présent(e) ? (sport, nature, créativité...)<br>
            · Dans quelles situations mon esprit s\'échappe-t-il le plus ? (repas, conversations, trajets...)<br>
            · Qu\'est-ce que je manque en n\'étant pas présent(e) dans ces moments ?<br><br>
            <em>Les plus beaux moments de la vie ne sont pas mémorables parce qu\'ils étaient extraordinaires — mais parce que vous y étiez vraiment.</em>'
        );

        return [
            'description' => 'Présence à soi — ralentir, s\'ancrer dans le moment présent, utiliser le corps comme ancre. 3 pratiques simples pour sortir du pilotage automatique.',
            'intro_text'  => "MODULE 12 — Présence à Soi\n\nVotre cerveau passe 47% de son temps à vagabonder hors du moment présent. Ce n'est pas un défaut — c'est une habitude. Ce module vous donne les outils pour revenir : dans votre corps, dans l'instant, dans votre vie telle qu'elle est vraiment.\n\nCette formation n'est pas née dans une bibliothèque. Elle est née de quelqu'un qui a cherché à comprendre depuis l'intérieur — en vivant ce qu'elle décrit, en portant les questions jusqu'à trouver les réponses. 'Cherchez et vous trouverez' — non comme promesse abstraite, mais comme description précise de ce qui s'est passé.",
            'audio_path'  => 'formation/audio/12-presence-a-soi-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '🟢 Introduction — Qu\'est-ce que la présence ?',         'duration' => '3 min',  'description' => 'Le cerveau qui vagabonde, et pourquoi la présence est un muscle à entraîner.', 'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — L\'art de ralentir',                            'duration' => '3 min',  'description' => 'Ralentir comme nécessité biologique et les 3 pratiques qui développent la présence.', 'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Le corps comme ancre',                          'duration' => '3 min',  'description' => 'Pourquoi les techniques somatiques sont plus efficaces que les techniques cognitives pour revenir au présent.', 'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique guidée — La Pause Présence',                     'duration' => '2 min',  'description' => 'Le micro-rituel d\'ancrage à utiliser à tout moment de la journée.', 'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — La marche sensorielle',                        'duration' => '10 min', 'description' => 'Marcher sans téléphone ni musique, en pleine attention sensorielle.', 'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle — Présence totale',                      'duration' => '8 min',  'description' => 'Méditation d\'ancrage en 3 étapes pour entraîner le muscle attentionnel.', 'content' => $meditation],
                ['type' => 'reflexion', 'title' => 'Rituel du seuil & journal de clôture',                    'duration' => '5 min',  'description' => 'Le micro-rituel quotidien et l\'exploration de vos zones de présence et d\'absence.', 'content' => $reflexion],
            ],
        ];
    }

    private function m13(): array  // Confiance corporelle
    {
        $gold   = 'rgba(201,168,76,.9)';
        $pink   = 'rgba(236,72,153,.8)';
        $teal   = 'rgba(20,184,166,.8)';
        $green  = 'rgba(34,197,94,.8)';
        $blue   = 'rgba(59,130,246,.8)';
        $purple = 'rgba(168,85,247,.8)';

        $intro = $this->card($gold, 'Ouverture', 'Votre corps n\'est pas un problème à résoudre',
            'Nous vivons dans une culture qui traite le corps comme un objet :<br>
            à corriger, façonner, contrôler, comparer.<br><br>
            Résultat : la grande majorité des personnes adultes entretient une relation critique avec leur corps.<br>
            56% des femmes et 40% des hommes déclarent se sentir "insatisfaits de leur corps" (IFOP 2019).<br><br>
            <strong>Ce module ne propose pas un régime, ni une transformation physique.</strong><br>
            Il propose une transformation du <em>regard</em> — d\'abord le regard sur soi-même.<br><br>
            <em>Votre corps n\'est pas la prison. Il est la maison.</em>'
        );
        $lecon1 = $this->card($pink, 'L\'image corporelle', 'Ce que nous "voyons" au miroir n\'est pas objectif',
            'L\'image corporelle est construite par :<br>
            · Les messages reçus dans l\'enfance ("tu grossis", "tu es maigre")<br>
            · Les comparaisons sociales (réseaux sociaux, magazines)<br>
            · Les expériences de honte autour du corps (moqueries, remarques)<br>
            · Le regard intériorisé des autres (qui devient notre propre regard)<br><br>
            <strong>Ce que cela signifie :</strong> ce que vous voyez au miroir est une <em>interprétation</em>, pas la réalité objective.<br>
            Deux personnes avec le même corps peuvent avoir une image corporelle radicalement différente.<br><br>
            <em>On ne guérit pas l\'image corporelle avec un régime — on la guérit avec un regard différent.</em>'
        );
        $lecon2 = $this->card($teal, 'La gratitude corporelle', 'Revoir le corps par ses capacités',
            'Exercice de perspective :<br><br>
            <strong>Ce que votre cœur fait pendant que vous lisez ceci :</strong><br>
            · Bat 70 fois par minute, sans votre intervention<br>
            · Pompe 5 litres de sang par minute<br>
            · Le fait depuis votre naissance, sans s\'arrêter<br><br>
            <strong>Ce que vos poumons font :</strong><br>
            · 15 000 respirations par jour<br>
            · 100% automatiques<br>
            · Chaque respiration = échange de vie avec le monde extérieur<br><br>
            <em>Avant de penser à ce que votre corps "n\'est pas" — regardez ce qu\'il fait pour vous, maintenant, en ce moment.</em>'
        ).$this->card($purple, 'Le regard neutre', 'Apprendre à observer sans juger',
            'Ni critique ni compliment forcé.<br>
            Juste : <strong>observer ce qui est là</strong>.<br><br>
            Quand vous vous regardez dans un miroir et qu\'une pensée critique arrive :<br>
            ① Nommez la pensée : <em>"J\'ai la pensée que..."</em><br>
            ② Respirez (1 cycle 5-5-5)<br>
            ③ Cherchez une chose neutre ou positive à observer<br><br>
            Ce n\'est pas du positivisme forcé. C\'est de la réorientation de l\'attention.<br>
            Le cerveau est plastique — ce regard se construit par répétition.'
        );
        $ex1 = $this->exercice($gold, '1', 'L\'exercice du miroir (5 min)',
            'Devant un miroir. À votre rythme.<br>
            Regardez-vous 2 minutes sans rien faire.<br>
            Notez les pensées critiques qui arrivent sans les retenir.<br>
            Puis posez une main sur le cœur.<br>
            Dites intérieurement ou à voix basse : <em>"Ce corps est vivant. Ce corps m\'a accompagné jusqu\'ici."</em><br>
            Inspirez 5s. Expirez 5s. 3 fois.<br>
            <em>Objectif : ni compliment forcé, ni critique intérieure — juste présence.</em>', true
        );
        $ex2 = $this->exercice($teal, '2', 'La lettre au corps (10 min)',
            'Écrivez une lettre à votre corps.<br>
            Commencez par reconnaître tout ce qu\'il a traversé avec vous.<br>
            Reconnaissez les moments où vous l\'avez négligé, malmené, ignoré.<br>
            Terminez par une phrase d\'intention : ce que vous souhaitez lui offrir désormais.<br>
            <em>Pas de performance. Pas de beauté littéraire. Juste l\'honnêteté.</em>', false
        );
        $meditation = $this->card($teal, 'Méditation guidée', '🌬 Pause Souffle — Habiter son corps (8 min)',
            'Allongé ou assis. Fermez les yeux.<br><br>
            <strong>Étape 1 — Balayage bienveillant (5 min)</strong><br>
            Portez l\'attention sur chaque partie du corps, de bas en haut.<br>
            Pour chaque zone : inspirez 5s en l\'accueillant, expirez 5s avec cette phrase intérieure :<br>
            <em>"Je te reconnais. Tu es là. Merci."</em><br><br>
            Pieds → jambes → ventre → dos → poitrine → épaules → bras → visage.<br><br>
            <strong>Étape 2 — Présence au cœur (3 min)</strong><br>
            Posez une main sur le cœur.<br>
            Sentez le battement. Respirez vers lui lentement.<br>
            <em>"Ce corps est vivant. Il est de mon côté."</em><br><br>
            <em>Cette pratique de réconciliation corporelle reconfigure progressivement l\'image de soi.</em>'
        );
        $reflexion = $this->card($gold, 'Journal', 'Clôture — Ma liste de gratitudes corporelles',
            'Chaque matin, en 3 minutes :<br>
            Notez 3 choses que votre corps a faites ou vous a permis de faire hier.<br><br>
            Exemples :<br>
            · "J\'ai marché jusqu\'au café"<br>
            · "Mes bras ont serré quelqu\'un fort"<br>
            · "Mes poumons ont filtré l\'air toute la nuit"<br>
            · "Mes yeux ont vu quelque chose de beau"<br><br>
            Ce n\'est pas de la naïveté — c\'est une reconnaîssance intentionnelle.<br>
            <em>Ce rituel reconfigure progressivement le regard du manque vers la reconnaissance — la seule thérapie qui guérit vraiment l\'image corporelle.</em>'
        );

        return [
            'description' => 'Confiance corporelle & image de soi — comprendre la construction de l\'image corporelle, développer un regard neutre et bienveillant sur son propre corps.',
            'intro_text'  => "MODULE 13 — Confiance Corporelle\n\nVotre corps n'est pas un problème à résoudre. Il est la maison dans laquelle vous vivez. Ce module vous guide vers une réconciliation — non pas avec un idéal de beauté — mais avec la réalité vivante de votre corps tel qu'il est.",
            'audio_path'  => 'formation/audio/13-confiance-corporelle-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '🪞 Introduction — Le corps n\'est pas un problème',       'duration' => '3 min',  'description' => 'Les 56% d\'insatisfaction corporelle et pourquoi la transformation passe par le regard.', 'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — L\'image corporelle construite',                'duration' => '4 min',  'description' => 'Comment l\'image de soi se construit et pourquoi elle n\'est jamais objective.', 'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Gratitude corporelle & regard neutre',          'duration' => '5 min',  'description' => 'Revoir le corps par ses capacités et apprendre à observer sans juger.', 'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique guidée — L\'exercice du miroir',                 'duration' => '5 min',  'description' => 'Se regarder sans critique ni compliment forcé — la pratique du regard neutre.', 'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — La lettre au corps',                           'duration' => '10 min', 'description' => 'Écriture honnête pour reconnaître ce que votre corps a traversé avec vous.', 'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle — Habiter son corps',                    'duration' => '8 min',  'description' => 'Méditation de réconciliation corporelle zone par zone.', 'content' => $meditation],
                ['type' => 'reflexion', 'title' => 'Journal — Ma liste de gratitudes corporelles',            'duration' => '3 min',  'description' => 'Le rituel quotidien du matin pour reconfigurer le regard sur son corps.', 'content' => $reflexion],
            ],
        ];
    }

    private function m14(): array  // Interactions sociales
    {
        $gold   = 'rgba(201,168,76,.9)';
        $blue   = 'rgba(59,130,246,.8)';
        $teal   = 'rgba(20,184,166,.8)';
        $green  = 'rgba(34,197,94,.8)';
        $orange = 'rgba(249,115,22,.8)';
        $pink   = 'rgba(236,72,153,.8)';

        $intro = $this->card($gold, 'Biologie sociale', 'Le lien humain est un besoin biologique',
            'L\'isolement social cause une augmentation du cortisol similaire au stress au travail.<br>
            Les interactions sociales positives libèrent :<br>
            · <strong>Ocytocine</strong> — hormone du lien, réduit l\'anxiété, renforce la confiance<br>
            · <strong>Sérotonine</strong> — stabilise l\'humeur, régule l\'impulsivité<br>
            · <strong>Endorphines</strong> — lors de rires partagés, du toucher social (poignée de main, accolade)<br><br>
            <strong>Le paradoxe moderne :</strong> nous sommes hyperconnectés numériquement et de plus en plus seuls corporellement.<br>
            Les connexions digitales n\'activent pas les mêmes circuits que le contact en présence.<br><br>
            <em>Votre système nerveux a besoin d\'yeux qui vous voient vraiment — pas d\'un algorithme.</em>'
        );
        $lecon1 = $this->card($blue, 'Les 3 types d\'interactions', 'Reconnaître ce qui nourrit vs ce qui dreine',
            '<strong>🟢 Interactions nourrissantes</strong><br>
            Présence mutuelle. Écoute réelle. Rire partagé. Silence confortable.<br>
            → Après : vous vous sentez léger, rechargé.<br><br>
            <strong>🟡 Interactions neutres</strong><br>
            Fonctionnelles, polies. Lieu de travail, commerce.<br>
            → Ni gain, ni perte d\'énergie.<br><br>
            <strong>🔴 Interactions drainantes</strong><br>
            Jugement, compétition, plainte chronique, manipulation passive.<br>
            → Après : vous vous sentez vidé, irritable, doutant de vous-même.<br><br>
            <em>Auditer ses relations ne signifie pas "couper les gens" — c\'est doser son énergie avec conscience.</em>'
        );
        $lecon2 = $this->card($teal, 'L\'écoute active', 'La compétence relationnelle la plus rare',
            'La majorité des conversations sont deux monologues parallèles.<br>
            Pendant que l\'autre parle, nous préparons notre réponse.<br><br>
            <strong>L\'écoute active (Carl Rogers) :</strong><br>
            ① <strong>Attention pleine</strong> — yeux, corps tourné vers l\'autre, téléphone hors vue<br>
            ② <strong>Non-jugement</strong> — pas de conclusion avant la fin<br>
            ③ <strong>Reflet</strong> — reformuler : <em>"Si je comprends bien, tu ressens..."</em><br>
            ④ <strong>Silence toléré</strong> — les silences sont des espaces de pensée, pas des vides à combler<br><br>
            <em>Une écoute vraiment active change la relation — l\'autre se sent vu. C\'est le fondement de la confiance.</em>'
        ).$this->card($pink, 'Solitude choisie vs isolement subi', 'Apprendre à être avec soi pour mieux être avec les autres',
            'Il y a une différence fondamentale entre :<br><br>
            <strong>La solitude choisie</strong> — se retrouver seul intentionnellement pour recharger, créer, penser.<br>
            C\'est une ressource. Un besoin légitime.<br><br>
            <strong>L\'isolement subi</strong> — être seul par peur du jugement, fatigue sociale, évitement des conflits.<br>
            C\'est un appauvrissement progressif du lien.<br><br>
            <em>Les introvertis ont besoin de solitude choisie après les interactions pour recharger.<br>
            Les extravertis rechargent pendant les interactions.</em><br>
            Les deux sont valides. Se connaître ici évite beaucoup de culpabilité.'
        );
        $ex1 = $this->exercice($gold, '1', 'L\'audit relationnel (30 min, par écrit)',
            'Dessinez 3 cercles concentriques.<br>
            <strong>Cercle 1 (centre)</strong> : 1 à 5 personnes avec qui vous vous sentez vraiment vous-même.<br>
            <strong>Cercle 2</strong> : 5 à 15 personnes proches, de qualité.<br>
            <strong>Cercle 3</strong> : connaissances, collègues.<br><br>
            Questions : Vers quel cercle souhaitez-vous investir plus de temps ?<br>
            Qui dans votre entourage vous draine systématiquement ?<br>
            <em>Pas pour juger — pour choisir avec conscience.</em>', false
        );
        $ex2 = $this->exercice($teal, '2', 'La conversation pleine présence (à deux)',
            '15 minutes avec quelqu\'un que vous choisissez.<br>
            Règles : téléphones hors vue.<br>
            · Une personne parle 7 min pendant que l\'autre écoute (vraiment — pas de réponse, juste présence)<br>
            · Puis échange de rôle<br>
            · 1 minute de silence à la fin, côte à côte<br>
            <em>Ce format simple crée des conversations plus profondes que des heures de bavardage ordinaire.</em>', false
        );
        $meditation = $this->card($teal, 'Méditation guidée', '🌬 Pause Souffle — Ouverture au lien (5 min)',
            'Avant une rencontre importante, un repas avec des proches, une interaction que vous redoutez :<br><br>
            <strong>1. Régulation (3 cycles 5-5-5)</strong><br>
            Inspirez 5s — imaginez votre cœur qui s\'ouvre légèrement.<br>
            Rétention 5s — sentez la chaleur dans la poitrine.<br>
            Expirez 5s — relâchez les attentes, les scénarios, les peurs.<br><br>
            <strong>2. Intention (1 phrase)</strong><br>
            Posez l\'intention intérieure : <em>"Je souhaite être vraiment présent(e) dans cette rencontre."</em><br><br>
            <strong>3. Retour (1 min)</strong><br>
            Sentez vos pieds sur le sol. Vous êtes ancré(e). Vous pouvez y aller.<br><br>
            <em>Le système nerveux calmé permet une présence relationnelle authentique. L\'anxiété sociale diminue quand on vient de la régulation — pas de l\'effort.</em>'
        );
        $reflexion = $this->card($gold, 'Journal', 'Clôture — Mon acte de lien intentionnel',
            'Chaque jour cette semaine : un geste de lien intentionnel.<br><br>
            · Un message audio vocal (pas texte) à quelqu\'un que vous n\'avez pas contacté depuis longtemps<br>
            · Un café avec une personne de votre cercle 1<br>
            · Une question sincère à quelqu\'un : <em>"Comment tu vas <u>vraiment</u> ?"</em><br><br>
            <strong>Journal de clôture :</strong><br>
            · Qui est dans mon cercle 1 en ce moment ?<br>
            · Quelle relation ai-je tendance à négliger par manque de temps ?<br>
            · Quel type d\'interaction me recharge le plus — seul ou avec les autres ?<br><br>
            <em>La qualité d\'une relation se construit en micro-gestes quotidiens, pas en grandes occasions.</em>'
        );

        return [
            'description' => 'Interactions sociales — comprendre la biologie du lien humain, distinguer les interactions nourrissantes des drainantes, et pratiquer l\'écoute active.',
            'intro_text'  => "MODULE 14 — Interactions Sociales\n\nVotre système nerveux a besoin d'yeux qui vous voient vraiment. Pas d'un algorithme. Le lien humain est un besoin biologique — pas une option. Ce module vous aide à auditer vos relations, pratiquer l'écoute active, et créer des connexions plus profondes.",
            'audio_path'  => 'formation/audio/14-interactions-sociales-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '🤝 Introduction — Le lien humain, un besoin biologique',  'duration' => '4 min',  'description' => 'Ocytocine, sérotonine, endorphines — la chimie des interactions sociales positives.', 'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — Les 3 types d\'interactions',                   'duration' => '4 min',  'description' => 'Reconnaître ce qui nourrit vs ce qui draine et pourquoi.', 'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Écoute active & solitude choisie',              'duration' => '5 min',  'description' => 'La compétence relationnelle la plus rare et la différence essentielle entre solitude et isolement.', 'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique — L\'audit relationnel',                         'duration' => '30 min', 'description' => 'Les 3 cercles concentriques pour cartographier et choisir ses relations consciemment.', 'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — La conversation pleine présence',              'duration' => '15 min', 'description' => 'Une conversation de 15 minutes avec des règles simples pour une profondeur réelle.', 'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle — Ouverture au lien',                    'duration' => '5 min',  'description' => 'Méditation de préparation avant une rencontre importante.', 'content' => $meditation],
                ['type' => 'reflexion', 'title' => 'Journal — Mon acte de lien intentionnel',                 'duration' => '5 min',  'description' => 'Un geste quotidien de connexion et l\'exploration de son cercle relationnel.', 'content' => $reflexion],
            ],
        ];
    }

    private function m15(): array  // Activité physique
    {
        $gold   = 'rgba(201,168,76,.9)';
        $green  = 'rgba(34,197,94,.8)';
        $orange = 'rgba(249,115,22,.8)';
        $blue   = 'rgba(59,130,246,.8)';
        $teal   = 'rgba(20,184,166,.8)';

        $intro =
            $this->card($gold, 'Philosophie', 'L\'activité physique comme médecine de premier recours',
                'L\'OMS recommande 150 min d\'activité modérée par semaine.<br>
                21 min par jour. Soit 1,5% du temps éveillé.<br><br>
                Ce que l\'activité physique régulière provoque :<br>
                · Augmentation de 30% du BDNF (facteur neuro-trophique — "engrais des neurones")<br>
                · Réduction de 48% du risque de dépression (méta-analyse Schuch, 2016)<br>
                · Amélioration de 23% du sommeil profond<br>
                · Réduction de la mortalité toutes causes de 35%<br><br>
                <strong>Mais attention au piège :</strong> l\'exercice forcé, punitif, comme "dépense calorique" génère du stress et de la relation instrumentale au corps.<br>
                <em>L\'objectif de ce module : trouver le mouvement qui procure du plaisir — pas de la souffrance.</em>'
            );

        $lecon1 =
            $this->card($green, 'Choisir son activité', 'Les 4 questions pour trouver la bonne pratique',
                '① <strong>Seul ou avec d\'autres ?</strong><br>
                Certains se rechargent pendant l\'effort en groupe (cours collectifs, sports d\'équipe).<br>
                D\'autres ont besoin de solitude (course, natation, randonnée).<br><br>
                ② <strong>Intérieur ou extérieur ?</strong><br>
                L\'exercice en plein air augmente les effets bénéfiques sur l\'humeur de 30% (Harris, 2020).<br><br>
                ③ <strong>Cardio ou résistance ou souplesse ?</strong><br>
                L\'idéal : les 3. Mais commencer par ce qui plait et y ajouter progressivement.<br><br>
                ④ <strong>À quelle heure ?</strong><br>
                Matin → cortisol naturellement haut → idéal pour l\'intensité<br>
                Soir → attention à l\'activité intense dans les 3h avant le sommeil'
            )
            .$this->card($orange, 'La cohérence de l\'effort', '3 niveaux d\'intensité',
                '<strong>Zone 1 — Intensité légère</strong> (marche rapide, yoga, étirements)<br>
                Récupération active, gestion du stress, stimulation légère du système cardiovasculaire.<br>
                Fréquence cardiaque : 50-60% du max.<br><br>
                <strong>Zone 2 — Intensité modérée</strong> (vélo, natation, course légère, danse)<br>
                Développement de l\'endurance aérobie, brûle les graisses, améliore le sommeil.<br>
                Fréquence cardiaque : 60-75% du max. Conversation possible mais laborieuse.<br><br>
                <strong>Zone 3 — Intensité élevée (HIIT, spinning, CrossFit)</strong><br>
                Efficacité maximale en temps court. Attention : trop fréquent = surcharge neuro-endocrine.<br>
                Max 2 fois par semaine si le reste de la vie est déjà stressant.'
            );

        $lecon2 =
            $this->card($blue, 'Progressivité & régularité', 'Construire l\'habitude qui dure',
                'Le cerveau intègre une habitude physique en <strong>66 jours en moyenne</strong> (Lally, UCL 2010) — pas 21.<br><br>
                <strong>Les principes de progressivité :</strong><br>
                · Commencez par 10-15 min 3×/semaine — le minimum viable<br>
                · Augmentez de 10% par semaine maximum (règle des 10%)<br>
                · Variations alternées : intensité / volume / fréquence (jamais les 3 en même temps)<br><br>
                <strong>Les signes que vous allez trop vite :</strong><br>
                · Fatigue persistante même après une nuit de sommeil<br>
                · Baisse de motivation soudaine<br>
                · Irritabilité et humeur basse<br>
                · Douleurs articulaires récurrentes<br><br>
                <em>La régularité modeste bat l\'intensité épisodique. Deux sessions par semaine pendant un an valent mieux que 5 sessions pendant deux mois.</em>'
            )
            .$this->card($teal, 'La récupération active', 'L\'autre moitié de l\'entraînement',
                'La récupération n\'est pas l\'absence d\'entraînement — c\'est une partie intégrante.<br><br>
                <strong>Ce qui se passe pendant le repos :</strong><br>
                · Le muscle se reconstruit plus fort (supercompensation)<br>
                · Le BDNF atteint son pic 1-2h après l\'effort<br>
                · La mémoire motrice est consolidée<br><br>
                <strong>Récupération active :</strong><br>
                · Marche légère, yoga doux, étirements (Zone 1)<br>
                · Hydratation suffisante (+500 ml les jours d\'effort)<br>
                · Sommeil de 7-9h (le manque annule les gains musculaires)<br><br>
                <strong>Ratio recommandé :</strong> 3 jours d\'effort / 1 jour de récupération active / 1 jour de repos complet par semaine.<br>
                <em>Le repos est du travail. L\'ignorer est la première cause d\'abandon.</em>'
            );

        $ex1 =
            $this->exercice($gold, '1', 'La marche Pause Souffle (20 min)',
                'Marchez à rythme modéré — suffisamment vite pour sentir le souffle s\'activer.<br>
                Les 5 premières minutes : respiration libre. Sentez le corps se débloquer.<br>
                Minutes 5-15 : Pause Souffle 5-5-5 en marchant.<br>
                Inspiration 5 pas → Rétention 5 pas → Expiration 5 pas.<br>
                Minutes 15-20 : relâchement progressif. Ralentissement.<br>
                <em>Cette technique synchronise le mouvement et le souffle — double effet sur le système nerveux.</em>', true
            );

        $ex2 =
            $this->exercice($teal, '2', 'Le protocole 5-minute (anti-sédentarité)',
                'Toutes les 90 minutes de travail assis :<br>
                5 minutes de mouvement intentionnel :<br>
                · 1 min rotations cervicales douces (3 de chaque côté)<br>
                · 1 min épaules (cercles avant + arrière)<br>
                · 1 min hanche (flexion / extension debout)<br>
                · 1 min étirement des mollets contre le mur<br>
                · 1 min Pause Souffle 5-5-5 debout<br>
                <em>Ce protocole inverse les effets néfastes de la position assise prolongée.</em>', false
            )
            .$this->exercice($green, '3', 'Le contrat de mouvement (à remplir)',
                'Prenez 10 minutes pour définir :<br>
                · Quelle activité me procure du plaisir ?<br>
                · Combien de fois par semaine je peux réalistement pratiquer ?<br>
                · Quel est le minimum viable ? (même 15 min 3×/sem = résultats significatifs)<br>
                · Quel partenaire d\'engagement puis-je solliciter ?<br>
                Notez-le. Partagez-le avec quelqu\'un.<br>
                <em>A public commitment increases follow-through by 65% (Gollwitzer, intentions study).</em>', false
            );

        $meditation =
            $this->exercice($blue, '4', '🌬 Pause Souffle — Ancrage après l\'effort (5 min)',
                'Dans les 5 minutes qui suivent votre activité physique :<br>
                Allongez-vous ou asseyez-vous dos droit. Fermez les yeux.<br><br>
                <strong>Phase 1 — Retour (2 min) :</strong><br>
                Respirez naturellement. Observez les sensations dans le corps : chaleur, picotements, flux sanguin.<br>
                Ne cherchez pas à contrôler — observez.<br><br>
                <strong>Phase 2 — Ancrage (3 min) :</strong><br>
                5 cycles 5-5-5.<br>
                À chaque expiration, laissez le corps s\'alourdir davantage dans la surface de repos.<br><br>
                <em>Ce rituel signale au cerveau que l\'effort est terminé. Il amplifie la libération d\'endorphines et ancre les bénéfices neurochimiques dans la mémoire corporelle.</em>', true
            );

        $reflexion =
            $this->exercice($gold, '5', 'Journal — Mon mouvement idéal',
                'Répondez honnêtement dans votre journal :<br><br>
                · Quelle activité physique dans mon passé m\'a procuré du vrai plaisir ?<br>
                · Qu\'est-ce qui m\'en a éloigné(e) — temps, blessure, honte, découragement ?<br>
                · Quel est le principal obstacle qui me sépare d\'une pratique régulière aujourd\'hui ?<br>
                · Si je pouvais choisir une seule activité à intégrer cette semaine — laquelle ?<br>
                · À quelle heure de la journée mon énergie est-elle la plus disponible pour bouger ?<br><br>
                <em>Le mouvement idéal n\'est pas le plus intense — c\'est celui que vous ferez encore dans 1 an.</em>', false
            );

        return [
            'description' => 'Activité physique & bien-être — trouver le mouvement qui vous ressource, construire une habitude durable et 3 protocoles concrets.',
            'intro_text'  => "MODULE 15 — Activité Physique\n\nLe mouvement n'est pas une punition. C'est une médecine. 21 minutes d'activité modérée par jour suffisent pour transformer votre neurochimie, votre sommeil et votre humeur. Ce module vous aide à trouver le mouvement qui vous procure du plaisir — pas de la souffrance.",
            'audio_path'  => 'formation/audio/15-activite-physique-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '🏃 Introduction — Le mouvement comme médecine',        'duration' => '4 min',  'description' => '150 min/semaine, BDNF, dépression, sommeil — la science du mouvement.',                                       'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — Choisir son activité & zones d\'intensité', 'duration' => '5 min',  'description' => '4 questions pour trouver sa pratique et comprendre les 3 zones d\'effort.',                                 'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Progressivité & récupération active',       'duration' => '4 min',  'description' => 'Construire une habitude durable et pourquoi la récupération est aussi de l\'entraînement.',               'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique — La marche Pause Souffle (20 min)',         'duration' => '20 min', 'description' => 'Synchroniser le mouvement et le souffle pour un double effet sur le système nerveux.',                      'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — Protocole 5 min & contrat de mouvement',  'duration' => '15 min', 'description' => 'Contrer la sédentarité toutes les 90 min et définir son engagement de mouvement personnel.',              'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle — Ancrage après l\'effort',          'duration' => '5 min',  'description' => 'Rituel de récupération post-effort pour ancrer les bénéfices dans le système nerveux.',                    'content' => $meditation],
                ['type' => 'reflexion', 'title' => 'Journal — Mon mouvement idéal',                       'duration' => '5 min',  'description' => 'Définir son rapport au mouvement et l\'activité qui procure du plaisir durablement.',                      'content' => $reflexion],
            ],
        ];
    }

    private function m16(): array  // Loisirs, sorties & voyages
    {
        $gold   = 'rgba(201,168,76,.9)';
        $orange = 'rgba(249,115,22,.8)';
        $teal   = 'rgba(20,184,166,.8)';
        $pink   = 'rgba(236,72,153,.8)';
        $green  = 'rgba(34,197,94,.8)';
        $purple = 'rgba(168,85,247,.8)';

        $intro =
            $this->card($gold, 'Fondation', 'Le loisir n\'est pas du temps perdu',
                'Dans la culture de la productivité, le loisir est souvent vécu comme :<br>
                · Quelque chose à mériter ("je me reposerai quand j\'aurai fini")<br>
                · Quelque chose de coupable ("je devrais travailler")<br>
                · Quelque chose de superficiel ("c\'est pas sérieux")<br><br>
                <strong>La réalité neurologique :</strong><br>
                Le boredom (ennui) et le jeu activent le réseau de repos (DMN) — source d\'intégration, de créativité et de sens.<br>
                Les meilleurs insights créatifs arrivent sous la douche, en marchant, en cuisine — pas devant un écran.<br><br>
                <em>Prendre du plaisir n\'est pas une récompense. C\'est une nécessité neuro-psychologique.</em>'
            );

        $lecon1 =
            $this->card($orange, 'Les loisirs qui nourrissent', '7 catégories à explorer',
                '🎭 <strong>Créatif</strong> — dessin, musique, cuisine, écriture, artisanat<br>
                👥 <strong>Social</strong> — sorties en groupe, soirées, jeux de société, dîners<br>
                🌿 <strong>Nature</strong> — randonnée, jardinage, camping, baignade<br>
                🏃 <strong>Physique</strong> — voir Module 15<br>
                📚 <strong>Culture</strong> — théâtre, cinéma, musées, lectures non-pro<br>
                ✈️ <strong>Exploration</strong> — voyages, nouveaux quartiers, nouvelles cuisines<br>
                🎯 <strong>Contemplation</strong> — observer, flâner, méditer, rêvasser intentionnellement<br><br>
                <em>Question clé : quels loisirs vous restituent de l\'énergie — et lesquels vous en coûtent davantage qu\'ils n\'en donnent ?</em>'
            )
            .$this->card($pink, 'Les sorties sociales — les soirées entre amis', 'Pourquoi c\'est vital',
                'Une soirée entre amis n\'est pas anodine neurologiquement :<br>
                · Rires partagés → libération d\'endorphines (effet antidouleur + anesthésiant naturel)<br>
                · Histoires partagées → activation de l\'ocytocine<br>
                · Contact physique (accolades) → réduction du cortisol<br>
                · Appartenance au groupe → besoin fondamental (Maslow tier 3)<br><br>
                <strong>Pour les femmes :</strong> les soirées filles créent un espace de dépressurisation sociale essentiel.<br>
                <strong>Pour les hommes :</strong> les sorties entre hommes libèrent du cortisol accumulé dans les rôles sociaux (travail, responsabilités).<br><br>
                <em>Ces moments ne sont pas du "temps perdu" — ils sont de la régulation neuro-sociale.</em>'
            );

        $lecon2 =
            $this->card($purple, 'Le voyage comme expansion', 'Pourquoi partir change le cerveau',
                'Le voyage stimule :<br>
                · La <strong>neuroplasticité</strong> (nouvelles stimulations = nouveaux neurones)<br>
                · La <strong>flexibilité cognitive</strong> (résoudre des problèmes inattendus)<br>
                · L\'<strong>empathie</strong> (exposition à d\'autres cultures, visions du monde)<br>
                · La <strong>gratitude</strong> (retour = regard neuf sur sa vie ordinaire)<br><br>
                <strong>Le voyage n\'exige pas de l\'argent ou de la distance :</strong><br>
                · Un week-end à 100 km<br>
                · Un quartier ethnique d\'une grande ville<br>
                · Un marché inconnu<br>
                · Une nuit chez des amis d\'une autre région<br>
                <em>Ce qui compte : la nouveauté, pas la distance.</em>'
            )
            .$this->card($green, 'La permission de ne rien faire', 'L\'art du loisir contemplatif',
                'Le cerveau a besoin de phases <strong>sans objectif</strong> — ce n\'est pas de la paresse, c\'est de la neurologie.<br><br>
                <strong>Ce que le vide intentionnel permet :</strong><br>
                · Consolidation des apprentissages (comme le sommeil)<br>
                · Créativité spontanée (le DMN génère de nouvelles connexions)<br>
                · Régulation émotionnelle (les émotions non traitées remontent et se dissolvent)<br>
                · Reconnexion à soi (hors des rôles sociaux)<br><br>
                <strong>Pratique :</strong> Planifiez 30 minutes de "rien faire intentionnel" par semaine.<br>
                Règles : pas d\'écran, pas de podcast, pas de productivité déguisée.<br>
                Flâner, observer, rêvasser, être.<br><br>
                <em>Les plus grandes décisions de vie se prennent souvent dans ces espaces vides — pas dans les agendas pleins.</em>'
            );

        $ex1 =
            $this->exercice($gold, '1', 'La carte des plaisirs (20 min)',
                'Prenez une feuille. Écrivez au centre : "Ce qui me fait du bien".<br>
                Notez tout ce qui vous vient — aucune censure, aucun jugement de "productivité".<br>
                Puis classifiez : lesquels sont dans ma vie régulièrement ? Lesquels sont absents ?<br>
                Choisissez UN plaisir absent et planifiez de le réintroduire cette semaine.<br>
                <em>Un plaisir planifié est 3x plus susceptible de se produire qu\'un plaisir "quand j\'aurai le temps".</em>', false
            );

        $ex2 =
            $this->exercice($orange, '2', 'Le plan de 30 jours de vitalité',
                'Sur les 30 prochains jours, planifiez :<br>
                · 4 sorties sociales (soirées, cafés, dîners avec des gens que vous aimez)<br>
                · 2 activités créatives (même 1h)<br>
                · 1 expérience nouvelle (endroit, cuisine, activité inconnue)<br>
                · 1 plage de "rien faire intentionnel" (flânerie, rêvasserie)<br>
                Mettez-les dans votre agenda dès maintenant, comme des rendez-vous professionnels.', false
            );

        $meditation =
            $this->exercice($teal, '3', '🌬 Pause Souffle — Sceller l\'expérience (5 min)',
                'Après une sortie, un moment de loisir, une soirée :<br>
                Avant de regarder votre téléphone, avant de "revenir"…<br>
                Asseyez-vous. Fermez les yeux.<br><br>
                <strong>5 cycles 5-5-5 :</strong><br>
                Inspiration 5s → Rétention 5s → Expiration 5s.<br><br>
                À chaque cycle, posez la question intérieure :<br>
                <em>"Qu\'est-ce que je rapporte de ce moment dans mon corps ?"</em><br><br>
                Notez : une sensation, une émotion, une image, une pensée.<br>
                <em>Ce rituel de "scellement" ancre l\'expérience positive dans la mémoire à long terme. Le cerveau mémorise mieux ce qu\'il a physiquement intégré.</em>', true
            );

        $reflexion =
            $this->exercice($gold, '4', 'Journal — Que me manque-t-il pour vivre pleinement ?',
                'Répondez dans votre journal :<br><br>
                · Quand ai-je pris du vrai plaisir pour la dernière fois — sans guilt, sans productivité ?<br>
                · Quelle catégorie de loisir est complètement absente de ma vie (créatif, nature, contemplation...) ?<br>
                · Qu\'est-ce qui m\'empêche de me permettre davantage de plaisir — croyances, agenda, honte ?<br>
                · Un loisir que j\'aimais enfant et qui a disparu ? Pourquoi m\'en suis-je éloigné(e) ?<br>
                · Quel serait mon "oui" de cette semaine — une chose que je me permets uniquement pour le plaisir ?<br><br>
                <em>La joie n\'est pas une récompense. Elle est une orientation de vie.</em>', false
            );

        return [
            'description' => 'Loisirs, sorties & voyages — comprendre la valeur neurologique du loisir, les soirées entre amis, les voyages, et retrouver le plaisir de vivre pleinement.',
            'intro_text'  => "MODULE 16 — Loisirs & Vie\n\nLe loisir n'est pas du temps perdu. C'est une nécessité neuro-psychologique. Sans plaisir, sans jeu, sans temps vide — le cerveau s'étiole. Ce module vous aide à réintroduire le plaisir comme priorité, pas comme récompense.",
            'audio_path'  => 'formation/audio/16-loisirs-vie-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '🎉 Introduction — Le loisir comme nécessité neurologique', 'duration' => '4 min',  'description' => 'DMN, créativité, culpabilité du plaisir — pourquoi se reposer est productif.',                                    'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — 7 catégories de loisir & sorties sociales',    'duration' => '5 min',  'description' => 'Cartographier les loisirs nourrissants et la neurologie des soirées entre amis.',                              'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Voyage & la permission de ne rien faire',       'duration' => '4 min',  'description' => 'Comment le voyage change le cerveau et l\'art du loisir contemplatif.',                                       'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique — La carte des plaisirs (20 min)',               'duration' => '20 min', 'description' => 'Identifier les loisirs absents et planifier leur réintroduction concrète.',                                      'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — Le plan de 30 jours de vitalité',             'duration' => '15 min', 'description' => 'Programmer 4 sorties sociales, 2 activités créatives et 1 expérience nouvelle ce mois.',                        'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle — Sceller l\'expérience',               'duration' => '5 min',  'description' => 'Rituel d\'ancrage post-loisir pour graver l\'expérience positive dans la mémoire à long terme.',                'content' => $meditation],
                ['type' => 'reflexion', 'title' => 'Journal — Que me manque-t-il pour vivre pleinement ?',   'duration' => '5 min',  'description' => 'Explorer ses croyances sur le plaisir et identifier ce qui vous manque pour rayonner.',                          'content' => $reflexion],
            ],
        ];
    }

    private function m17(): array  // Relation à l'autre
    {
        $gold   = 'rgba(201,168,76,.9)';
        $blue   = 'rgba(59,130,246,.8)';
        $teal   = 'rgba(20,184,166,.8)';
        $green  = 'rgba(34,197,94,.8)';
        $orange = 'rgba(249,115,22,.8)';
        $pink   = 'rgba(236,72,153,.8)';

        $intro =
            $this->card($gold, 'Fondation', 'La relation à l\'autre commence par la relation à soi',
                'Vous ne pouvez pas donner ce que vous n\'avez pas.<br>
                Vous ne pouvez pas écouter vraiment si votre système nerveux est en alerte.<br>
                Vous ne pouvez pas établir des limites claires si vous ne savez pas ce que vous ressentez.<br><br>
                C\'est pourquoi ce module arrive après les 8 précédents :<br>
                Corps → Nerfs → Émotions → Présence → Confiance → Lien social<br>
                → <strong>Relation à l\'autre</strong><br><br>
                <em>Ce que vous avez construit jusqu\'ici est la fondation. Ce module est la structure.</em>'
            );

        $lecon1 =
            $this->card($blue, 'Les limites', 'Dire non — l\'acte d\'amour le plus honnête',
                'Une limite n\'est pas un mur.<br>
                C\'est une frontière claire qui dit : <em>"voilà ce qui me respecte, voilà ce qui ne me respecte pas"</em>.<br><br>
                <strong>Pourquoi les limites sont difficiles :</strong><br>
                · Peur de blesser l\'autre<br>
                · Confusion entre "dire non" et "rejeter la personne"<br>
                · Éducation qui récompense le sacrifice de soi<br>
                · Peur de la solitude qui résulterait du "non"<br><br>
                <strong>La vérité sur les limites :</strong><br>
                Les personnes sans limites claires finissent par ressentir du ressentiment envers ceux à qui elles disent toujours "oui".<br>
                Un "non" honnête respecte plus la relation qu\'un "oui" forcé.<br><br>
                <em>Formula : "Je ne peux pas faire ça maintenant — ce qui est possible pour moi c\'est..."</em>'
            )
            .$this->card($teal, 'La communication non-violente (CNV)', 'Dire ce qui est vrai sans agression',
                'La CNV (Marshall Rosenberg) en 4 étapes :<br><br>
                <strong>① Observation</strong> — les faits sans interprétation<br>
                <em>"Quand tu arrives en retard..."</em> (pas "tu es toujours en retard" — c\'est un jugement)<br><br>
                <strong>② Ressenti</strong> — émotion (pas accusation)<br>
                <em>"Je ressens de la frustration..."</em> (pas "tu me fais sentir...")<br><br>
                <strong>③ Besoin</strong> — le besoin derrière l\'émotion<br>
                <em>"Parce que j\'ai besoin de fiabilité dans nos arrangements..."</em><br><br>
                <strong>④ Demande</strong> — concrète, réalisable, pas une exigence<br>
                <em>"Est-ce que tu peux me prévenir si tu es en retard ?"</em>'
            );

        $lecon2 =
            $this->card($orange, 'Les styles d\'attachement', 'Comprendre son mode relationnel',
                '<strong>Sécure</strong> — confiance en l\'autre, à l\'aise avec l\'intimité et l\'autonomie<br>
                → Relations stables et satisfaisantes en général<br><br>
                <strong>Anxieux</strong> — peur de l\'abandon, besoin de réassurance fréquent<br>
                → Tendance à la sur-dépendance émotionnelle<br><br>
                <strong>Évitant</strong> — inconfort avec l\'intimité, valorise l\'autonomie excessive<br>
                → Tendance à se fermer lors des conflits<br><br>
                <strong>Désorganisé</strong> — l\'autre est à la fois source de sécurité et de danger<br>
                → Souvent lié à un attachement traumatique<br><br>
                <em>Le style d\'attachement n\'est pas une condamnation — il est le résultat d\'une histoire. Il est modifiable par le travail sur soi et des relations sécurisantes.</em>'
            )
            .$this->card($pink, 'Réparer après un conflit', 'L\'art de la rupture-réparation',
                'Tous les couples et toutes les amitiés ont des conflits.<br>
                Ce qui distingue les relations durables : la capacité à <strong>réparer</strong>.<br><br>
                <strong>Le processus en 4 temps :</strong><br>
                <strong>① Pause</strong> — se retirer si l\'activation est trop haute (> 5 min minimum)<br>
                <strong>② Régulation</strong> — système nerveux d\'abord (5-5-5, marche, eau)<br>
                <strong>③ Accountability</strong> — reconnaître sa part sans minimiser<br>
                <em>"J\'aurais pu mieux gérer ce moment. Je suis désolé(e) pour..."</em><br>
                <strong>④ Reconnexion</strong> — un geste physique simple (main, regard, accolade)<br><br>
                <strong>Important :</strong> La réparation n\'exige pas d\'avoir tort.<br>
                Elle exige d\'aimer plus la relation que d\'avoir raison.<br><br>
                <em>Les relations résilientes ne sont pas celles sans conflits — ce sont celles qui réparent vite et bien.</em>'
            );

        $ex1 =
            $this->exercice($gold, '1', 'La CNV — entraînement écrit',
                'Choisissez une situation relationnelle qui vous affecte.<br>
                Écrivez les 4 étapes CNV :<br>
                1. Observation (faits)<br>
                2. Mon ressenti (1 mot d\'émotion)<br>
                3. Mon besoin derrière cette émotion<br>
                4. Ma demande concrète et réaliste<br>
                <em>Ne pas envoyer immédiatement. Relire le lendemain et ajuster.</em>', false
            );

        $ex2 =
            $this->exercice($green, '2', 'L\'inventaire de mes relations (1h)',
                'Pour chaque relation importante :<br>
                · Cette relation me nourrit-elle ou me draine-t-elle ?<br>
                · Ai-je des limites claires dans cette relation ?<br>
                · Y a-t-il quelque chose d\'important que je n\'ai pas dit ?<br>
                · Quel est mon style d\'attachement dans cette relation ?<br>
                Pas pour agir immédiatement — pour voir clairement.<br>
                <em>La clarté précède toujours l\'action juste.</em>', false
            );

        $meditation =
            $this->exercice($teal, '3', '🌬 Pause Souffle — Avant une conversation difficile',
                'Avant toute conversation difficile (conflits, annonce délicate, demande importante) :<br><br>
                <strong>5 cycles 5-5-5 :</strong><br>
                Fermez les yeux. Inspirez 5s → Retenez 5s → Expirez 5s.<br><br>
                Ensuite, posez l\'intention :<br>
                <em>"Je souhaite être présent(e) et honnête — pas gagner ou convaincre."</em><br><br>
                <strong>Pendant la conversation :</strong><br>
                Si vous sentez le système nerveux s\'emballer (voix qui tremble, accélération cardiaque, besoin urgent de répondre) — ralentissez votre débit. Respirez.<br><br>
                <em>La régulation de soi pendant le conflit est la compétence relationnelle la plus puissante et la plus rare.</em>', true
            );

        $reflexion =
            $this->exercice($gold, '4', 'Journal — Ma relation à l\'autre',
                'Répondez dans votre journal :<br><br>
                · Quel est mon style d\'attachement dominant ? Comment se manifeste-t-il dans mes relations proches ?<br>
                · Y a-t-il une limite que j\'ai du mal à poser ? Pourquoi ?<br>
                · Y a-t-il quelque chose que j\'aurais besoin de dire (CNV) à quelqu\'un — mais que je retiens ?<br>
                · Dans quelle relation est-ce que je perds le plus facilement moi-même ?<br>
                · Qu\'est-ce que je voudrais que les personnes qui m\'aiment comprennent mieux de moi ?<br><br>
                <em>Les relations les plus profondes sont celles où l\'on peut être vu(e) — vraiment.</em>', false
            );

        return [
            'description' => 'Relation à l\'autre — communication non-violente, limites saines, styles d\'attachement et 3 outils pour des relations plus authentiques.',
            'intro_text'  => "MODULE 17 — Relation à l'Autre\n\nVous ne pouvez pas donner ce que vous n'avez pas. La qualité de vos relations dépend directement de votre relation à vous-même. Ce module vous donne les outils concrets : poser des limites, communiquer sans blesser, comprendre votre style d'attachement, et réparer après un conflit.",
            'audio_path'  => 'formation/audio/17-relation-a-lautre-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '❤️ Introduction — La relation à soi, fondation de la relation à l\'autre', 'duration' => '4 min',  'description' => 'Pourquoi ce module arrive après les 8 précédents — la logique de la progression.',                                        'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — Les limites & la CNV',                                          'duration' => '6 min',  'description' => 'Dire non avec respect et communiquer ce qui est vrai sans agression.',                                                    'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Styles d\'attachement & réparation après conflit',              'duration' => '5 min',  'description' => 'Comprendre son mode relationnel et l\'art de réparer ce qui a été brisé.',                                             'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique — La CNV — entraînement écrit',                                  'duration' => '20 min', 'description' => 'Écrire les 4 étapes CNV pour une situation réelle qui vous affecte.',                                                    'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — L\'inventaire de mes relations',                               'duration' => '60 min', 'description' => 'Évaluer chaque relation importante : nourrit ou draine, limites claires, non-dits.',                                    'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle — Avant une conversation difficile',                     'duration' => '5 min',  'description' => 'Réguler son système nerveux avant un échange délicat pour être présent(e) et non réactif(ve).',                      'content' => $meditation],
                ['type' => 'reflexion', 'title' => 'Journal — Ma relation à l\'autre',                                        'duration' => '10 min', 'description' => 'Explorer son style d\'attachement, ses non-dits, et ce qu\'on veut être dans ses relations.',                         'content' => $reflexion],
            ],
        ];
    }

    private function m18(): array  // Énergie relationnelle & Intimité
    {
        $gold   = 'rgba(201,168,76,.9)';
        $pink   = 'rgba(236,72,153,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $teal   = 'rgba(20,184,166,.8)';
        $blue   = 'rgba(59,130,246,.8)';
        $green  = 'rgba(34,197,94,.8)';

        $intro =
            $this->card($gold, 'Positionnement', 'L\'intimité — un prolongement naturel, pas une performance',
                '<div style="background:rgba(201,168,76,.06);border:1px solid rgba(201,168,76,.2);border-radius:10px;padding:.9rem 1.1rem;margin-bottom:.75rem;font-size:.82rem;color:rgba(232,224,208,.7);line-height:1.8;">
                <strong style="color:#c9a84c;">⚠️ Note pédagogique :</strong> Ce module traite de l\'intimité dans la perspective du corps, de la présence et du lien — pas comme une technique ni une performance. Il s\'inscrit dans la progression de cette formation : connaissance du corps → gestion émotionnelle → confiance en soi → relation à l\'autre → <strong>intimité vécue comme extension naturelle de ce lien</strong>.
                </div>
                L\'intimité n\'est pas un sujet à part.<br>
                Elle est la <strong>convergence de tout ce que vous avez travaillé</strong> jusqu\'ici :<br>
                · Présence corporelle (Module 12)<br>
                · Confiance en soi (Module 13)<br>
                · Communication (Module 17)<br>
                · Système nerveux régulé (Module 08)<br><br>
                <em>Une intimité épanouie n\'est pas le résultat d\'une technique. C\'est le fruit d\'une relation à soi qui permet une vraie relation à l\'autre.</em>'
            );

        $lecon1 =
            $this->card($pink, 'Le corps dans l\'intimité', 'Présence vs automatisme',
                'La plupart des difficultés dans l\'intimité viennent d\'une <strong>déconnexion du corps</strong> :<br>
                · Penser (planifier, analyser, s\'observer) au lieu de ressentir<br>
                · Être dans la performance plutôt que dans la présence<br>
                · Tensions corporelles non reconnues qui bloquent le ressenti<br><br>
                <strong>Le système nerveux autonome joue un rôle central :</strong><br>
                En mode sympathique (stress, peur, performance) : la réponse du corps est inhibée.<br>
                En mode parasympathique (sécurité, confiance, présence) : le corps peut s\'ouvrir pleinement.<br><br>
                <em>La Pause Souffle 5-5-5 crée exactement ce contexte — c\'est l\'outil de préparation le plus puissant à une intimité consciente.</em>'
            )
            .$this->card($purple, 'La sécurité intérieure', 'Le préalable à toute intimité',
                '<strong>On ne peut s\'ouvrir qu\'à la mesure où l\'on se sent en sécurité.</strong><br><br>
                La sécurité dans l\'intimité vient de :<br>
                · Confiance en l\'autre (construite dans la durée)<br>
                · Confiance en soi (se connaître, connaître ses besoins et ses limites)<br>
                · Régulation émotionnelle (ne pas être submergé par la vulnérabilité)<br>
                · Communication claire (savoir dire ce que l\'on veut et ce que l\'on ne veut pas)<br><br>
                <em>C\'est pourquoi ce module arrive en dernier — tout ce qui précède le construit.</em>'
            );

        $lecon2 =
            $this->card($teal, 'La synchronisation', 'Être avec l\'autre plutôt que devant l\'autre',
                'L\'intimité profonde se construit sur la synchronisation :<br>
                · <strong>Du souffle</strong> — respirer à un rythme proche (sans forcer)<br>
                · <strong>Du regard</strong> — se voir vraiment, sans agenda<br>
                · <strong>Du toucher</strong> — contact conscient, attentif, non mécanique<br>
                · <strong>Du silence</strong> — être ensemble sans que tout soit dit<br><br>
                Ces signaux comportementaux envoient au système nerveux :<br>
                <em>"Tu es en sécurité ici. Tu peux t\'ouvrir."</em><br><br>
                Ce n\'est pas de la technique. C\'est de la <strong>présence partagée</strong>.'
            )
            .$this->card($blue, 'La sexualité — comme prolongement', 'En parler avec justesse',
                '<div style="background:rgba(99,102,241,.06);border:1px solid rgba(99,102,241,.2);border-radius:10px;padding:.9rem 1.1rem;margin-bottom:.75rem;">
                La sexualité est une composante légitime et importante du bien-être humain.<br>
                Elle a un impact documenté sur le système nerveux, les hormones, l\'humeur et le lien humain.<br><br>
                Quand elle est vécue dans la <strong>présence, la sécurité et le respect mutuel</strong> :<br>
                · Libération d\'ocytocine, dopamine, endorphines et prolactine<br>
                · Réduction du cortisol et de l\'inflammation<br>
                · Amélioration du sommeil<br>
                · Renforcement du lien de couple<br><br>
                Elle n\'est <strong>jamais</strong> une performance à réussir ni une technique à maîtriser.<br>
                Elle est une <strong>expression naturelle de la présence partagée</strong> que vous avez construite dans ce parcours.
                </div>
                <em>Tout ce que les modules précédents vous ont appris — respiration, présence, confiance en soi, communication — converge ici naturellement.</em>'
            );

        $ex1 =
            $this->exercice($gold, '1', 'La respiration synchronisée (à deux, 5 min)',
                'Assis face à face ou côte à côte.<br>
                Sans se toucher dans un premier temps.<br>
                Fermez les yeux. Respirez chacun naturellement.<br>
                Après 2 minutes : laissez naturellement les rythmes se rapprocher — sans forcer.<br>
                Si cela se fait naturellement, bien. Sinon, c\'est une information précieuse sur l\'état du système nerveux.<br>
                Ouvrez les yeux doucement. Restez en silence 30 secondes.<br>
                <em>La synchronisation respiratoire est l\'un des marqueurs biologiques les plus fiables de la connexion relationnelle.</em>', true
            );

        $ex2 =
            $this->exercice($pink, '2', 'Le regard (à deux, 3 min)',
                'Face à face, assis à distance confortable.<br>
                Se regarder dans les yeux — 3 minutes.<br>
                Sans parler. Sans sourire forcé. Sans analyser.<br>
                Juste observer l\'autre. Juste être vu.<br>
                Après : partager en une phrase ce que vous avez ressenti.<br>
                <em>Cet exercice active l\'ocytocine et crée un niveau d\'intimité plus profond que des heures de conversation.</em>', false
            )
            .$this->exercice($purple, '3', 'Le contact conscient (à deux, 5 min)',
                'L\'un pose doucement une main sur l\'avant-bras de l\'autre.<br>
                Aucun des deux ne bouge pendant 3 minutes.<br>
                Celui qui reçoit : portez l\'attention sur la chaleur de la main. La pression. Le poids.<br>
                Celui qui donne : soyez dans la présence totale — pas dans la pensée.<br>
                Échangez les rôles. 3 minutes également.<br>
                <em>Le toucher conscient (non sexualisé) libère de l\'ocytocine et développe la sensorialité — fondation d\'une intimité épanouie.</em>', false
            );

        $meditation =
            $this->exercice($teal, '4', '🌬 Pause Souffle — Ouverture au lien (5 min)',
                'Avant un moment de connexion avec votre partenaire :<br>
                Asseyez-vous dos droit. Fermez les yeux.<br><br>
                <strong>5 cycles 5-5-5 :</strong><br>
                Inspirez 5s en sentant la poitrine s\'ouvrir → Retenez 5s → Expirez 5s en relâchant les épaules.<br><br>
                À chaque expiration, relâchez une zone de tension :<br>
                · Expiration 1 : mâchoire et cou<br>
                · Expiration 2 : épaules et bras<br>
                · Expiration 3 : poitrine et thorax<br>
                · Expiration 4 : ventre et bassin<br>
                · Expiration 5 : jambes et pieds<br><br>
                Posez l\'intention : <em>"Je suis disponible. Je suis présent(e)."</em><br><br>
                <em>Ce rituel prépare le système nerveux à la sécurité et à l\'ouverture — les deux fondations de toute connexion profonde.</em>', true
            );

        $reflexion =
            $this->exercice($gold, '5', 'Journal — Mon rapport à l\'intimité',
                'Répondez honnêtement dans votre journal :<br><br>
                · Dans quels moments me suis-je senti(e) vraiment présent(e) avec quelqu\'un ?<br>
                · Y a-t-il des tensions ou des peurs qui m\'empêchent de m\'ouvrir pleinement ? D\'où viennent-elles ?<br>
                · Est-ce que je me permets d\'être vu(e) — vraiment vu(e) — dans mes relations proches ?<br>
                · Quelle est la différence entre connexion et performance dans ma vie relationnelle ?<br>
                · Un pas concret que je pourrais faire pour approfondir une relation proche cette semaine ?<br><br>
                <em>L\'intimité n\'est pas une destination. C\'est une pratique quotidienne de présence et de courage.</em>', false
            );

        return [
            'description' => 'Énergie relationnelle & intimité — la présence comme fondation de l\'intimité, la sécurité intérieure, la synchronisation corps/souffle et l\'intimité comme prolongement naturel.',
            'intro_text'  => "MODULE 18 — Énergie Relationnelle & Intimité\n\nL'intimité n'est pas une technique. C'est la convergence de tout ce que vous avez construit : présence corporelle, confiance en soi, régulation émotionnelle, communication. Ce module vous guide vers une connexion plus profonde, fondée sur la sécurité et la présence — pas la performance.",
            'audio_path'  => 'formation/audio/18-intimite-energie-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '💎 Introduction — L\'intimité comme convergence',               'duration' => '4 min',  'description' => 'Pourquoi l\'intimité arrive en dernier — et ce que ce parcours a construit.',                                                  'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — Corps, présence & sécurité intérieure',               'duration' => '5 min',  'description' => 'Déconnexion du corps, rôle du système nerveux et préalables à une intimité épanouie.',                                   'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Synchronisation & sexualité comme prolongement',      'duration' => '5 min',  'description' => 'Être avec l\'autre (souffle, regard, toucher, silence) et la sexualité comme expression naturelle.',                    'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique — La respiration synchronisée (à deux)',               'duration' => '5 min',  'description' => 'Laisser les rythmes respiratoires se rapprocher naturellement — marqueur de connexion relationnelle.',                  'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — Le regard & le contact conscient (à deux)',          'duration' => '10 min', 'description' => '3 min de regard profond + 5 min de toucher conscient pour activer l\'ocytocine et la sensorialité.',                   'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle — Ouverture au lien',                          'duration' => '5 min',  'description' => 'Préparation du système nerveux à la sécurité et à l\'ouverture avant un moment de connexion.',                         'content' => $meditation],
                ['type' => 'reflexion', 'title' => 'Journal — Mon rapport à l\'intimité',                           'duration' => '10 min', 'description' => 'Explorer ses peurs, ses ouvertures et un pas concret vers plus de connexion.',                                            'content' => $reflexion],
            ],
        ];
    }

    private function m19(): array  // Médecines complémentaires
    {
        $gold   = 'rgba(201,168,76,.9)';
        $green  = 'rgba(34,197,94,.8)';
        $red    = 'rgba(239,68,68,.8)';
        $blue   = 'rgba(59,130,246,.8)';
        $orange = 'rgba(249,115,22,.8)';
        $teal   = 'rgba(20,184,166,.8)';

        $intro =
            $this->card($gold, 'Positionnement', 'Ce module ne prescrit rien — il éclaire',
                '<div style="background:rgba(239,68,68,.06);border:1px solid rgba(239,68,68,.2);border-radius:10px;padding:.85rem 1.1rem;margin-bottom:.75rem;font-size:.82rem;color:rgba(232,224,208,.7);line-height:1.8;">
                <strong style="color:rgba(239,68,68,.9);">⚠️ Important :</strong> Ce module n\'est pas un conseil médical. Toute décision de santé doit être prise avec votre médecin et les professionnels de santé compétents. Ce module vous aide à poser les bonnes questions et à développer votre discernement — pas à remplacer un avis médical.
                </div>
                Ce module existe à cause d\'une réalité douloureuse :<br>
                des personnes sont mortes ou ont souffert inutilement en un confondant <em>complémentaire</em> et <em>alternatif</em>.<br><br>
                Il n\'a pas pour objectif de juger des choix passés — mais de donner les outils pour des choix futurs éclairés.<br><br>
                <em>Comprendre la différence entre "en complément de" et "à la place de" peut sauver des vies.</em>'
            );

        $lecon1 =
            $this->card($green, 'La distinction fondamentale', 'Complémentaire ≠ Alternatif',
                '<strong>Médecine complémentaire :</strong><br>
                Utilisée EN PLUS du traitement médical conventionnel.<br>
                Ex : acupuncture + chimiothérapie / yoga + traitement antihypertenseur<br>
                → Réduit les effets secondaires, améliore le bien-être, soutient la guérison<br>
                → Nombreuses preuves d\'efficacité documentées<br><br>
                <strong>Médecine alternative :</strong><br>
                Utilisée À LA PLACE du traitement médical conventionnel.<br>
                → Dans certains cas : risque vital réel<br>
                → Aucune preuve d\'efficacité équivalente aux traitements conventionnels pour les pathologies graves<br><br>
                <em>La tentation de l\'alternatif naît souvent de la peur des effets secondaires ou d\'une défiance récente envers la médecine — ce qui est compréhensible.</em>'
            )
            .$this->card($red, 'Le piège des solutions miracles', 'Comprendre pourquoi on y croit',
                'Il n\'existe pas de "méchants" dans cette histoire.<br>
                Il existe des personnes qui souffrent et qui cherchent de l\'espoir.<br>
                Et des systèmes qui exploitent cette recherche d\'espoir.<br><br>
                <strong>Les signaux d\'alerte d\'une approche non-fiable :</strong><br>
                ① <em>"Guéris en 30 jours — garanti"</em> → Aucune pathologie sérieuse ne guérit en 30 jours<br>
                ② <em>"La médecine traditionnelle ne veut pas que vous sachiez ça"</em> → Théorie du complot<br>
                ③ <em>"Aucun effet secondaire"</em> → Tout ce qui a un effet a potentiellement des effets secondaires<br>
                ④ <em>"Témoignages uniquement"</em> → Les anecdotes ne constituent pas des preuves<br>
                ⑤ Absence d\'études cliniques publiées dans des revues à comité de lecture<br><br>
                <em>La vraie naturopathie, l\'ostéopathie reconnue, l\'acupuncture evidence-based : ce sont des compléments sérieux et documentés.</em>'
            );

        $lecon2 =
            $this->card($blue, 'Les approches complémentaires validées', 'Ce qui est documenté',
                '<strong>✅ Preuves solides :</strong><br>
                · <strong>Méditation mindfulness</strong> — réduction du stress, douleur chronique, rechutes dépressives<br>
                · <strong>Yoga thérapeutique</strong> — lombalgie, anxiété, hypertension légère<br>
                · <strong>Acupuncture</strong> — nausées post-chimio, douleur chronique, céphalées<br>
                · <strong>Massage thérapeutique</strong> — douleur, anxiété, qualité de vie en oncologie<br>
                · <strong>Cohérence cardiaque / respiration lente</strong> — hypertension, anxiété, récupération post-effort<br><br>
                <strong>⚠️ Preuves limitées (peut aider, mais pas de remplacement) :</strong><br>
                · Phytothérapie (certaines plantes interagissent avec des médicaments)<br>
                · Aromathérapie (bien-être, mais pas traitement)<br>
                · Homéopathie (effet placebo documenté, efficacité propre débattue)'
            )
            .$this->card($orange, 'Face à la maladie grave', 'Faire des choix éclairés sous pression',
                'Quand le diagnostic arrive, le système nerveux passe en mode survie.<br>
                Le cerveau cherche des solutions rapides, des promesses rassurantes, de l\'espoir.<br>
                C\'est un mécanisme de survie naturel — pas une naïveté.<br><br>
                <strong>Comment faire des choix éclairés :</strong><br>
                ① Prendre le temps — sauf urgence vitale, un diagnostic ne nécessite pas une décision en 24h<br>
                ② Demander un second avis médical — toujours légitime et souvent recommandé<br>
                ③ S\'entourer — famille, proches, associations de patients<br>
                ④ Poser des questions au médecin : taux de réussite, effets secondaires, alternatives médicales<br>
                ⑤ Évaluer les complémentaires — lesquels peuvent aider sans interférer avec le traitement ?<br><br>
                <em>Un médecin qui respecte son patient encourage ces questions. Il ne les craint pas.</em>'
            );

        $ex1 =
            $this->exercice($gold, '1', 'La question des 3 colonnes (exercice de discernement)',
                'Face à toute approche de santé (conventionnelle ou complémentaire), remplissez :<br><br>
                <strong>Colonne 1 — Preuves</strong><br>
                Quelles études cliniques soutiennent cette approche ?<br>
                Méta-analyses ? Journal médical reconnu ?<br><br>
                <strong>Colonne 2 — Risques</strong><br>
                Quels sont les effets secondaires connus ?<br>
                Interférences avec d\'autres traitements ?<br><br>
                <strong>Colonne 3 — Sources</strong><br>
                Qui recommande cela ? Quel est leur intérêt financier éventuel ?<br>
                <em>Ce cadre s\'applique aussi bien à un médicament qu\'à une plante ou un protocole alternatif.</em>', false
            );

        $ex2 =
            $this->exercice($green, '2', 'Mes questions pour mon médecin',
                'Préparez votre prochaine consultation médicale en notant :<br><br>
                <strong>Sur le traitement proposé :</strong><br>
                · Quel est le taux de réussite / bénéfice attendu dans mon cas ?<br>
                · Quels sont les effets secondaires les plus fréquents ?<br>
                · Y a-t-il des alternatives au traitement proposé ?<br>
                · Quelle est la conséquence de ne pas traiter — ou d\'attendre ?<br><br>
                <strong>Sur les complémentaires :</strong><br>
                · Y a-t-il des approches complémentaires qui pourraient m\'aider et qui ne contre-indiquent pas le traitement ?<br>
                · Recommandez-vous un suivi psychologique ou nutritionnel en parallèle ?<br><br>
                <em>Un patient qui pose des questions est un patient qui prend soin de lui. C\'est votre droit.</em>', false
            );

        $meditation =
            $this->exercice($teal, '3', '🌬 Pause Souffle — Clarté avant une décision de santé',
                'Avant de prendre une décision de santé importante :<br>
                Asseyez-vous dans un endroit calme. Fermez les yeux.<br><br>
                <strong>5 cycles 5-5-5 :</strong><br>
                Inspirez 5s → Retenez 5s → Expirez 5s.<br><br>
                Après les 5 cycles, posez-vous la question :<br>
                <em>"Ma décision vient-elle de la clarté — ou de la peur ?"</em><br><br>
                · Si elle vient de la peur : attendez. Dormez dessus. Consultez un proche de confiance.<br>
                · Si elle vient de la clarté : avancez.<br><br>
                Respirez encore 3 cycles. Ouvrez les yeux.<br><br>
                <em>La peur est un mauvais conseiller médical. La clarté est le seul état dans lequel une grande décision devrait être prise.</em>', true
            );

        $reflexion =
            $this->exercice($gold, '4', 'Journal — Mes choix de santé',
                'Répondez honnêtement dans votre journal :<br><br>
                · Y a-t-il un aspect de ma santé que j\'évite d\'affronter — une consultation reportée, un symptôme ignoré ?<br>
                · Quelles croyances ai-je sur la médecine (conventionnelle ou complémentaire) ? D\'où viennent-elles ?<br>
                · Y a-t-il une approche complémentaire que j\'utilise actuellement ? Suis-je certain(e) qu\'elle complète et ne remplace pas ?<br>
                · Si j\'apprenais un diagnostic difficile demain — qui sont les personnes sur qui je pourrais compter ?<br>
                · Qu\'est-ce que je pourrais faire cette semaine pour prendre soin de ma santé de manière concrète ?<br><br>
                <em>La santé n\'est pas absente de maladie. C\'est la capacité à prendre soin de soi avec discernement et bienveillance.</em>', false
            );

        return [
            'description' => 'Médecines complémentaires & choix éclairés — comprendre la différence entre complémentaire et alternatif, reconnaître les approches validées et faire des choix éclairés face à la maladie.',
            'intro_text'  => "MODULE 19 — Médecines Complémentaires\n\nIl n'existe pas de solution miracle. Il existe des approches complémentaires sérieuses — et des alternatives qui peuvent coûter une vie. Ce module vous donne les outils du discernement : savoir ce qui est documenté, poser les bonnes questions, et décider depuis la clarté — pas depuis la peur.",
            'audio_path'  => 'formation/audio/19-medecines-complementaires-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '🔬 Introduction — Ce module ne prescrit rien, il éclaire',    'duration' => '4 min',  'description' => 'Disclaimer et pourquoi ce module existe — complémentaire vs alternatif, une différence vitale.',                'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — La distinction fondamentale & les pièges',         'duration' => '5 min',  'description' => 'Complémentaire ≠ Alternatif et les 5 signaux d\'alerte d\'une approche non-fiable.',                              'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Approches validées & décisions sous pression',     'duration' => '5 min',  'description' => 'Ce qui est documenté (mindfulness, acupuncture...) et comment décider face à un diagnostic grave.',             'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique — L\'exercice des 3 colonnes',                      'duration' => '20 min', 'description' => 'Évaluer toute approche de santé (preuves, risques, sources) avec un cadre de discernement clair.',               'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — Mes questions pour mon médecin',                  'duration' => '15 min', 'description' => 'Préparer ses consultations avec les bonnes questions sur le traitement et les complémentaires.',                   'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle — Clarté avant une décision de santé',     'duration' => '5 min',  'description' => 'Réguler le système nerveux pour distinguer une décision de clarté d\'une décision de peur.',                      'content' => $meditation],
                ['type' => 'reflexion', 'title' => 'Journal — Mes choix de santé',                               'duration' => '10 min', 'description' => 'Explorer ses croyances sur la médecine, ses évitements et un acte concret de soin de soi.',                       'content' => $reflexion],
            ],
        ];
    }

    private function m20(): array  // Vivre, choisir, se reconstruire
    {
        $gold   = 'rgba(201,168,76,.9)';
        $teal   = 'rgba(20,184,166,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $blue   = 'rgba(59,130,246,.8)';
        $green  = 'rgba(34,197,94,.8)';
        $orange = 'rgba(249,115,22,.8)';
        $pink   = 'rgba(236,72,153,.8)';

        $intro =
            $this->card($gold, 'Introduction', 'Ce qui ne peut pas être dit autrement',
                '<div style="font-size:.92rem;line-height:2.3;text-align:center;color:rgba(232,224,208,.85);font-style:italic;padding:.5rem 0 1rem;">
                Il arrive dans une vie<br>des moments où le corps change.<br><br>
                Une maladie.<br>
                Un diagnostic.<br>
                Une transformation imposée.<br><br>
                Et parfois...<br>un choix impossible :<br><br>
                Garder une partie de son corps...<br>
                ou sauver sa vie.<br><br>
                <strong style="color:#c9a84c;font-style:normal;font-size:.97rem;">Ce module est là pour accompagner.</strong><br>
                Sans jugement.<br>
                Sans réponse toute faite.<br>
                Juste pour revenir à l\'essentiel :<br>
                la vie.
                </div>
                <div style="background:rgba(239,68,68,.06);border:1px solid rgba(239,68,68,.2);border-radius:10px;padding:.85rem 1.1rem;font-size:.81rem;color:rgba(232,224,208,.7);line-height:1.8;">
                ⚠️ Ce module ne contient aucun conseil médical. Il est un espace d\'accompagnement psychologique et corporel. En cas de situation médicale sérieuse, consultez vos médecins et les professionnels de santé compétents.
                </div>'
            )
            .$this->card($teal, 'Les approches de santé', 'Complémentaire et conventionnel — ensemble',
                'Ce module reprend et approfondit ce qui a été posé au Module 19 :<br>
                la médecine conventionnelle et les approches complémentaires <strong>ne s\'opposent pas</strong>.<br><br>
                Dans les situations graves :<br>
                · La médecine conventionnelle peut être vitale — et elle peut être dure à traverser<br>
                · Les approches complémentaires peuvent soutenir traverser cette dureté<br><br>
                <strong>Ce que Pause Souffle peut apporter pendant un traitement médical :</strong><br>
                · Réduction du stress pré-opératoire (respiration)<br>
                · Gestion de la douleur chronique (scan corporel, méditation)<br>
                · Amélioration du sommeil en cours de traitement<br>
                · Soutien émotionnel continu<br>
                · Reconnexion au corps après une transformation physique'
            );

        $lecon1 =
            $this->card($purple, 'Le corps face à la maladie', 'Ce qui se passe à l\'intérieur',
                'Quand le corps est touché par une maladie grave :<br><br>
                <strong>Choc :</strong> incompréhension, sentiment d\'irréalité, "ça ne peut pas m\'arriver à moi"<br>
                <strong>Colère :</strong> injustice, "pourquoi moi", rage contre le corps<br>
                <strong>Peur :</strong> de la douleur, de la mort, du regard des autres, de l\'après<br>
                <strong>Deuil :</strong> du corps d\'avant, de l\'image de soi, des projets<br>
                <strong>Adaptation :</strong> progressivement, le système nerveux trouve un nouveau équilibre<br><br>
                <em>Toutes ces étapes sont normales. Aucune n\'est une faiblesse.<br>
                Elles peuvent se présenter dans n\'importe quel ordre, se répéter, se mêler.</em>'
            )
            .$this->card($pink, 'Perdre une partie de son corps', 'Une réalité que peu de formations osent aborder',
                'Amputation, mastectomie, perte des cheveux, stomie, cicatrices visibles...<br>
                La transformation du corps n\'est pas qu\'une épreuve physique — c\'est une épreuve <strong>identitaire</strong>.<br><br>
                <strong>Ce qui se joue :</strong><br>
                · L\'image de soi (miroir)<br>
                · La féminité / masculinité<br>
                · Le regard des autres (réel ou imaginé)<br>
                · La peur de ne plus être désirable<br>
                · La question : <em>"Suis-je encore moi ?"</em><br><br>
                <div style="background:rgba(236,72,153,.07);border-left:3px solid rgba(236,72,153,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;font-size:.8rem;line-height:1.85;color:rgba(232,224,208,.8);">
                Une femme de 20 ans a choisi de ne pas vivre plutôt que d\'être amputée d\'une jambe.<br>
                Cette réalité douloureuse existe. Elle ne devrait pas exister.<br>
                Elle n\'existerait peut-être pas si davantage de personnes avaient accès à ce qui est abordé dans ce parcours : confiance en soi, regard bienveillant sur son corps, relation stable, communication, soutien du lien humain.
                </div>'
            );

        $lecon2 =
            $this->card($blue, 'La reconstruction', 'Se reconstruire n\'est pas redevenir comme avant',
                'Se reconstruire ne signifie pas "faire comme si rien ne s\'était passé".<br>
                C\'est <strong>apprendre à être autrement</strong>.<br><br>
                La reconstruction se fait à plusieurs niveaux :<br><br>
                <strong>① Identité</strong> — <em>"Je suis plus que mon corps. Je suis plus que mon apparence."</em><br>
                Ce que vous êtes n\'est pas contenu dans l\'intégrité physique de votre corps.<br><br>
                <strong>② Regard sur soi</strong> — le travail du Module 13 (confiance corporelle) prend ici toute son importance.<br>
                Le miroir après une transformation physique demande une pratique spécifique d\'observation neutre et bienveillante.<br><br>
                <strong>③ Regard des autres</strong> — la plupart des regards négatifs redoutés vivent dans notre imagination.<br>
                Les études sur la perception sociale post-cancer montrent que l\'entourage perçoit les survivants avec davantage d\'admiration que de rejet.<br><br>
                <strong>④ Lien humain</strong> — l\'isolement aggrave tout. Le lien humain (Module 14, 17) est la première ressource.'
            )
            .$this->card($green, 'Ce qu\'il faut retenir', 'Le message central de ce module',
                '<div style="font-size:1rem;line-height:2.3;text-align:center;color:rgba(232,224,208,.9);padding:.5rem 0;">
                Vous n\'êtes pas votre maladie.<br><br>
                Vous n\'êtes pas votre apparence.<br><br>
                Vous n\'êtes pas votre diagnostic.<br><br>
                <strong style="color:#c9a84c;font-size:1.05rem;">Vous êtes une personne vivante.</strong><br><br>
                Et tant qu\'il y a de la vie...<br>
                il y a encore des possibilités.
                </div>'
            )
            .$this->card($orange, 'Conclusion du parcours', 'Ce que vous avez construit',
                '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
                Vous êtes arrivé(e) au bout de ce parcours.<br><br>
                Vingt modules.<br>
                Vingt rendez-vous avec vous-même.<br><br>
                Vous avez traversé :<br>
                → Le corps et ses territoires<br>
                → Le souffle et le système nerveux<br>
                → Les émotions et leur régulation<br>
                → Le sommeil, l\'alimentation, la présence<br>
                → L\'image de soi et la confiance<br>
                → Le lien social et la communication<br>
                → L\'intimité et la connexion<br>
                → La santé et le discernement<br>
                → Et enfin — la vie dans ce qu\'elle peut avoir de plus difficile<br><br>
                <strong style="color:#c9a84c;">Ce que vous avez construit n\'est pas une formation.</strong><br>
                C\'est une méthode de vie.<br><br>
                <em>Elle vous appartient maintenant.</em>
                </div>'
            );

        $ex1 =
            $this->exercice($gold, '1', 'Respiration de sécurité (5 min)',
                'Inspirez lentement 5s...<br>
                Expirez 5s...<br>
                Dites intérieurement :<br>
                <em>"Je suis en sécurité ici et maintenant."</em><br>
                <em>"Ce corps est vivant."</em><br>
                <em>"Je suis toujours moi."</em><br>
                8 cycles. Mains sur le cœur ou sur le ventre.<br>
                <em>À pratiquer chaque fois que la peur ou le doute sur l\'identité surgit.</em>', true
            );

        $ex2 =
            $this->exercice($blue, '2', 'L\'écriture des deux colonnes',
                'Prenez une feuille. Tracez une ligne au centre.<br><br>
                <strong>Colonne gauche : "Ce que j\'ai perdu / Ce qui a changé"</strong><br>
                Écrivez honnêtement. Sans minimiser.<br><br>
                <strong>Colonne droite : "Ce qui est encore là / Ce que je peux encore vivre"</strong><br>
                Prenez le temps. Cherchez dans les petites choses.<br><br>
                Terminez par une phrase : <em>"Ce que je souhaite encore vivre..."</em><br>
                <em>Cet exercice n\'est pas du positivisme forcé — c\'est une vision équilibrée de la réalité complète.</em>', false
            )
            .$this->exercice($pink, '3', 'Briser l\'isolement — parler à quelqu\'un',
                'L\'étape la plus difficile et la plus importante :<br>
                Choisissez une personne de confiance.<br>
                Partagez quelque chose de vrai sur ce que vous traversez.<br>
                Pas pour obtenir des conseils — pour ne pas être seul(e) avec ça.<br>
                Si vous n\'avez personne : une ligne d\'écoute, une association de patients, un groupe de parole.<br>
                <em>Le lien humain est le premier médicament contre l\'isolement de la maladie.</em>', false
            );

        $meditation =
            $this->exercice($teal, '4', '🌬 Pause Souffle — Réappropriation du corps (5 min)',
                'Allongé(e) confortablement. Yeux fermés.<br><br>
                <strong>5 cycles 5-5-5 :</strong><br>
                Inspirez 5s → Retenez 5s → Expirez 5s.<br><br>
                Puis portez les mains sur différentes parties du corps, l\'une après l\'autre.<br>
                Sentez la chaleur. Le contact. La vie sous la peau.<br>
                Dites intérieurement à chaque zone : <em>"Je te reconnais. Tu es là."</em><br><br>
                Parcourez : tête → gorge → poitrine → ventre → bras → jambes → pieds.<br><br>
                Terminez avec les deux mains sur le cœur :<br>
                <em>"Ce corps m\'a porté jusqu\'ici. Il continue. Je suis là."</em><br><br>
                <em>Cet exercice de réappropriation somatique aide après toute transformation physique — petite ou grande. Il recrée un dialogue de bienveillance entre soi et son corps.</em>', true
            );

        $reflexion =
            $this->exercice($purple, '5', 'Journal — L\'exercice du miroir bienveillant',
                'Asseyez-vous devant un miroir.<br>
                Regardez-vous sans rien faire — 2 minutes.<br>
                Cherchez UNE chose qui est encore là, qui n\'a pas changé.<br>
                Les yeux. Le sourire. Les mains. La voix. Un geste. Quelque chose.<br>
                Posez la main sur cette partie. Respirez vers elle.<br>
                Dites intérieurement : <em>"Ceci est toujours moi."</em><br><br>
                Ensuite, dans votre journal :<br>
                · Qu\'est-ce que j\'ai trouvé — cette partie qui est encore là ?<br>
                · Qu\'est-ce que cette partie représente pour moi ?<br>
                · Quel est un souhait concret pour ma vie dans les 6 prochains mois ?<br><br>
                <em>La reconstruction de l\'image corporelle commence par un seul regard bienveillant — posé sur ce qui est là, pas sur ce qui manque.</em>', false
            );

        return [
            'description' => 'Vivre, choisir, se reconstruire — accompagner le corps et l\'être humain face à la maladie, aux transformations corporelles, et à la reconstruction identitaire.',
            'intro_text'  => "MODULE 20 — Vivre, Choisir, Se Reconstruire\n\nCe module existe pour les moments les plus difficiles. Quand le corps change. Quand un choix impossible se présente. Il ne prescrit rien — il accompagne. Avec respect, sans jugement, avec la conviction que tant qu'il y a de la vie, il y a des possibilités.",
            'audio_path'  => 'formation/audio/20-vivre-choisir-reconstruire-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '🌿 Introduction — Accompagner ce qui ne peut pas être dit autrement', 'duration' => '5 min',  'description' => 'Le poème d\'ouverture, le disclaimer et comment Pause Souffle soutient pendant un traitement médical.',           'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — Le corps face à la maladie & l\'épreuve identitaire',     'duration' => '5 min',  'description' => 'Les 5 étapes intérieures face à une maladie grave et ce qui se joue lors d\'une transformation corporelle.',     'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Reconstruction & message de clôture du parcours',         'duration' => '5 min',  'description' => 'Les 4 niveaux de reconstruction identitaire et le message final du parcours Pause Souffle.',                    'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique — Respiration de sécurité',                                'duration' => '5 min',  'description' => '8 cycles avec affirmations corporelles — à pratiquer chaque fois que la peur ou le doute surgit.',              'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — Les deux colonnes & briser l\'isolement',                'duration' => '30 min', 'description' => 'Écrire ce qui est perdu et ce qui est encore là — puis partager avec une personne de confiance.',                 'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle — Réappropriation du corps',                       'duration' => '5 min',  'description' => 'Scan corporel guidé de réappropriation somatique après toute transformation physique.',                          'content' => $meditation],
                ['type' => 'reflexion', 'title' => 'Journal — L\'exercice du miroir bienveillant',                      'duration' => '10 min', 'description' => 'Retrouver ce qui est encore là et poser un regard bienveillant sur soi depuis ce corps transformé.',              'content' => $reflexion],
            ],
        ];
    }

    private function m21(): array  // Entretenir nos relations
    {
        $gold   = 'rgba(201,168,76,.9)';
        $teal   = 'rgba(20,184,166,.8)';
        $blue   = 'rgba(59,130,246,.8)';
        $green  = 'rgba(34,197,94,.8)';
        $orange = 'rgba(249,115,22,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $pink   = 'rgba(236,72,153,.8)';

        $intro =
            $this->card($gold, 'Fondation', 'Ce qui distingue les relations qui durent',
                'Créer un lien est accessible à presque tout le monde.<br>
                <strong>Entretenir ce lien dans la durée</strong> — c\'est là que la plupart des relations s\'étiolent.<br><br>
                La Harvard Study of Adult Development — la plus longue étude longitudinale sur le bonheur jamais conduite (1938 → aujourd\'hui) — conclut :<br><br>
                <div style="background:rgba(201,168,76,.07);border-left:3px solid rgba(201,168,76,.6);border-radius:0 8px 8px 0;padding:.65rem 1.1rem;margin:.4rem 0;font-style:italic;color:rgba(232,224,208,.82);">
                "Ce ne sont pas les richesses, la gloire ou le travail qui rendent heureux sur la durée.<br>
                Ce sont la qualité et la chaleur des relations."
                </div>
                <em>Ce module est dédié aux relations déjà là — et à comment les nourrir consciemment.</em>'
            );

        $lecon1 =
            $this->card($teal, 'La loi de l\'entropie relationnelle', 'Toute relation sans soin se dégrade',
                'Les relations ne restent pas stables passivement.<br>
                Comme tout système vivant, elles suivent la loi de l\'entropie :<br>
                sans apport d\'énergie, d\'attention, de soin — elles se dégradent.<br><br>
                <strong>Ce n\'est pas de la malveillance.</strong><br>
                C\'est la vie : les emplois changent, les priorités se déplacent, les habitudes évoluent.<br><br>
                <strong>3 signaux qu\'une relation s\'érode :</strong><br>
                ① Les conversations se réduisent au logistique ("t\'as vu le médecin ?" / "les courses ?") sans espace pour le personnel<br>
                ② Le silence devient inconfort plutôt que confort partagé<br>
                ③ Les irritations s\'accumulent sans être exprimées<br><br>
                <em>Identifier ces signaux tôt permet d\'agir avant que la distance devienne habitude.</em>'
            )
            .$this->card($blue, 'Les 5 langages de l\'amour', 'Comprendre comment chacun reçoit l\'amour',
                'Gary Chapman (1992) identifie 5 façons dont les humains expriment et reçoivent l\'amour :<br><br>
                🗣 <strong>Les mots d\'affirmation</strong> — compliments, encouragements, reconnaissance verbale<br>
                🕐 <strong>Le temps de qualité</strong> — présence totale, sans distraction<br>
                🎁 <strong>Les cadeaux</strong> — symboles de pensée et d\'attention (pas forcément matériels)<br>
                🤝 <strong>Les services rendus</strong> — faire des choses concrètes pour l\'autre<br>
                🤗 <strong>Le toucher physique</strong> — contact, tendresse, présence corporelle<br><br>
                <strong>Le problème courant :</strong> chacun exprime l\'amour dans son propre langage — mais l\'autre le reçoit dans le sien.<br>
                <em>Exemple : vous faites des services, mais l\'autre a besoin de temps de qualité.<br>
                Effort réel de votre part — réception nulle de la sienne.</em><br><br>
                Connaître le langage de l\'autre transforme l\'efficacité de chaque geste d\'amour.'
            );

        $lecon2 =
            $this->card($orange, 'Le compte en banque émotionnel', 'Dépôts et retraits relationnels',
                'John Gottman (chercheur en relations de couple) propose ce modèle :<br><br>
                Chaque interaction positive = <strong>un dépôt</strong> dans le compte en banque émotionnel.<br>
                Chaque interaction négative = <strong>un retrait</strong>.<br><br>
                <strong>Le ratio magique (Gottman) :</strong> pour qu\'une relation reste saine, il faut <strong>5 interactions positives pour 1 négative</strong>.<br><br>
                <strong>Exemples de dépôts :</strong><br>
                · "Je pensais à toi" (message inattendu)<br>
                · Rire ensemble<br>
                · Reconnaître une qualité à voix haute<br>
                · Être là sans agenda pendant une difficulté<br><br>
                <strong>Exemples de retraits :</strong><br>
                · Critique de la personne (pas du comportement)<br>
                · Mépris (le signe le plus toxique selon Gottman)<br>
                · Déni de responsabilité<br>
                · Mutisme punitif'
            )
            .$this->card($purple, 'Le temps de qualité', 'La ressource la plus rare dans les relations modernes',
                'Dans une vie saturée de notifications et d\'obligations :<br>
                <strong>la présence totale à l\'autre est devenue rare.</strong><br><br>
                Le temps de qualité n\'est pas la quantité de temps passé ensemble.<br>
                C\'est la <em>densité de présence</em> dans ce temps.<br><br>
                <strong>20 minutes de présence totale</strong> (téléphone absent, regard donné, écoute vraie)<br>
                nourrit plus qu\'une soirée passée côte à côte chacun sur son écran.<br><br>
                <strong>Rituels relationnels avérés :</strong><br>
                · Le café du matin sans écran (15 min)<br>
                · La question du soir : "Quel a été ton moment de la journée ?" — et vraiment écouter<br>
                · Un repas par semaine designé "sans téléphone"<br>
                · Une sortie mensuelle rien qu\'à deux'
            )
            .$this->card($pink, 'Traverser les conflits sans rompre', 'Le conflit comme outil de reconnexion',
                'Les relations sans conflit ne sont pas des relations saines.<br>
                Ce sont des relations où quelqu\'un tait quelque chose.<br><br>
                <strong>Le conflit bien traversé rapproche.</strong><br>
                Le conflit évité crée une distance silencieuse et cumulative.<br><br>
                <strong>3 règles du conflit constructif :</strong><br>
                ① Attaquez le problème, pas la personne<br>
                ("ce comportement me fait de la peine" vs "tu es comme ça")<br>
                ② Restez dans le présent — ne ressortez pas l\'inventaire des 5 dernières années<br>
                ③ Visez la compréhension avant la victoire :<br>
                "Qu\'est-ce qui est important pour toi dans cette situation ?"<br><br>
                <em>Rappel : voir le Module 17 (CNV) pour les outils de communication non-violente.</em>'
            );

        $ex1 =
            $this->exercice($gold, '1', 'L\'audit de la relation (30 min — par écrit)',
                'Choisissez une relation importante (couple, ami proche, famille).<br><br>
                Répondez honnêtement :<br>
                · Quel est son langage de l\'amour principal ?<br>
                · Quel est mon langage de l\'amour principal ?<br>
                · Quel est l\'état du "compte en banque émotionnel" de cette relation en ce moment ?<br>
                · Quand ai-je fait un dépôt significatif la dernière fois ?<br>
                · Y a-t-il quelque chose que je n\'ai pas dit et qui occupe de la place ?<br><br>
                <em>Pas pour agir immédiatement — pour voir clairement avant d\'agir juste.</em>', false
            );

        $ex2 =
            $this->exercice($green, '2', 'Le geste de dépôt quotidien',
                'Chaque jour : UN geste de dépôt intentionnel dans une relation importante.<br><br>
                Selon les langages :<br>
                · <em>Mots d\'affirmation</em> → "Je suis content(e) que tu sois dans ma vie"<br>
                · <em>Temps de qualité</em> → 10 min ensemble sans agenda<br>
                · <em>Service</em> → faire quelque chose sans qu\'on vous le demande<br>
                · <em>Toucher</em> → une main posée, une accolade qui dure vraiment<br>
                · <em>Cadeau</em> → un article envoyé, un café acheté "en pensant à toi"<br>
                <em>Les grandes relations se construisent en micro-gestes quotidiens — pas en grandes occasions.</em>', false
            );

        $meditation =
            $this->exercice($teal, '3', '🌬 Pause Souffle — Rituel de reconnexion (10 min — à deux)',
                'Un soir par semaine, avec la personne choisie :<br>
                Installez-vous face à face. Pas d\'écran.<br><br>
                <strong>Chacun répond à deux questions :</strong><br>
                1. Ce que j\'ai apprécié en toi cette semaine...<br>
                2. Ce dont j\'aurais eu besoin et que je n\'ai pas osé demander...<br><br>
                L\'autre écoute sans répondre. Pas de débat. Pas de justification.<br>
                Échangez les rôles.<br><br>
                <strong>Pour conclure :</strong> 3 cycles 5-5-5 côte à côte ou mains jointes.<br>
                Inspiration 5s → Rétention 5s → Expiration 5s.<br><br>
                <em>Ce rituel simple empêche l\'accumulation silencieuse qui étiole les relations. La respiration partagée crée une synchronisation neurologique qui renforce le lien.</em>', true
            );

        $reflexion =
            $this->exercice($gold, '4', 'Journal — Mes relations les plus importantes',
                'Répondez dans votre journal :<br><br>
                · Quelles sont les 3 relations les plus importantes dans ma vie en ce moment ?<br>
                · Pour chacune : quel est son langage de l\'amour ? Quand ai-je fait un dépôt significatif dernièrement ?<br>
                · Y a-t-il une relation que je néglige depuis trop longtemps — et qui mérite un soin intentionnel ?<br>
                · Y a-t-il quelque chose de non-dit qui crée une distance silencieuse dans une relation proche ?<br>
                · Quel est UN rituels relationnel que je pourrais introduire dès cette semaine ?<br><br>
                <em>Les relations ne se maintiennent pas d\'elles-mêmes. Elles se construisent — en gestes quotidiens, en présence, en parole honnête.</em>', false
            );

        return [
            'description' => 'Entretenir nos relations — l\'entropie relationnelle, les 5 langages de l\'amour, le ratio de Gottman et 3 pratiques concrètes pour nourrir les liens qui comptent dans la durée.',
            'intro_text'  => "MODULE 21 — Entretenir Nos Relations\n\nCréer un lien est accessible à presque tout le monde. L'entretenir dans la durée — c'est là que la plupart des relations s'étiolent. Ce module vous donne les outils pour nourrir consciemment les relations qui comptent : langages de l'amour, compte en banque émotionnel, rituels de reconnexion.",
            'audio_path'  => 'formation/audio/21-entretenir-nos-relations-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '🌱 Introduction — Ce qui distingue les relations qui durent', 'duration' => '4 min',  'description' => 'L\'étude Harvard sur le bonheur et pourquoi la qualité des relations prime sur tout.',                                   'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — Entropie relationnelle & 5 langages de l\'amour', 'duration' => '5 min',  'description' => 'Comprendre pourquoi les relations s\'étiolent et comment chaque personne reçoit l\'amour.',                           'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Compte en banque, temps de qualité & conflits',   'duration' => '5 min',  'description' => 'Le ratio 5:1 de Gottman, la présence totale et comment traverser les conflits sans rompre.',                         'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique — L\'audit de la relation (30 min)',               'duration' => '30 min', 'description' => 'Évaluer langages, état du compte émotionnel et non-dits d\'une relation importante.',                                  'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — Le geste de dépôt quotidien',                   'duration' => '5 min',  'description' => 'Pratiquer chaque jour un micro-geste de connexion adapté au langage de l\'autre.',                                      'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle — Rituel de reconnexion (à deux)',         'duration' => '10 min', 'description' => 'Questions d\'appréciation + respiration partagée 5-5-5 — un rituel hebdomadaire qui empêche la distance silencieuse.', 'content' => $meditation],
                ['type' => 'reflexion', 'title' => 'Journal — Mes relations les plus importantes',              'duration' => '10 min', 'description' => 'Faire le point sur ses 3 relations clés et choisir un rituel relationnel à introduire.',                              'content' => $reflexion],
            ],
        ];
    }

    private function m22(): array  // Nutrition & Vitalité
    {
        $gold   = 'rgba(201,168,76,.9)';
        $green  = 'rgba(34,197,94,.8)';
        $orange = 'rgba(249,115,22,.8)';
        $teal   = 'rgba(20,184,166,.8)';
        $blue   = 'rgba(59,130,246,.8)';
        $purple = 'rgba(168,85,247,.8)';

        $intro =
            $this->card($gold, 'Philosophie', 'La nutrition n\'est pas un régime',
                '<div style="background:rgba(239,68,68,.06);border:1px solid rgba(239,68,68,.2);border-radius:10px;padding:.85rem 1.1rem;margin-bottom:.75rem;font-size:.81rem;color:rgba(232,224,208,.7);line-height:1.8;">
                ⚠️ Ce module est éducatif. Toute adaptation nutritionnelle dans un contexte médical (diabète, pathologie digestive, trouble alimentaire) doit être conduite avec un professionnel de santé.
                </div>
                Le Module 11 vous a introduit à l\'alimentation consciente — <em>comment</em> manger.<br>
                Ce module aborde <strong>ce que manger</strong> — la biochimie de la nutrition au service de la vitalité.<br><br>
                Un régime crée de la restriction, de la culpabilité et de l\'effet yo-yo.<br>
                La nutrition intelligente informe sans contraindre.<br><br>
                <em>L\'objectif : comprendre comment la nourriture affecte l\'énergie, les hormones, le cerveau et l\'humeur — pour choisir avec conscience, pas par règle.</em>'
            );

        $lecon1 =
            $this->card($green, 'Les macronutriments', 'Les 3 carburants du corps',
                '<strong>🔵 Glucides (4 kcal/g)</strong> — carburant principal du cerveau et des muscles<br>
                Sources de qualité : légumineuses, céréales complètes, fruits, légumes racines<br>
                À limiter : sucres raffinés, sodas, farines blanches industrielles<br>
                <em>Le pic glycémique provoque un rebond insulinique → fringale 1-2h après</em><br><br>
                <strong>🔴 Protéines (4 kcal/g)</strong> — construction cellulaire, précurseurs des neurotransmetteurs<br>
                Sources : œufs, poissons, légumineuses, viandes, tofu, yaourts<br>
                Besoin adulte actif : 1,4 à 2 g / kg de poids corporel / jour<br>
                <em>Le déficit protéique chronique = fatigue, masse musculaire réduite, humeur instable</em><br><br>
                <strong>🟡 Lipides (9 kcal/g)</strong> — membranes cellulaires, cerveau (60% de graisse), hormones<br>
                Sources de qualité : huile d\'olive, avocat, noix, poissons gras (oméga-3)<br>
                À limiter : graisses trans (produits ultra-transformés), huiles végétales hydrogénées'
            )
            .$this->card($teal, 'Les micronutriments clés', 'Ce que l\'alimentation moderne épuise',
                '<strong>🧠 Magnésium</strong> — cofacteur de 300 réactions enzymatiques<br>
                Rôle : réduction du stress, sommeil, contraction musculaire. Déficit très courant.<br>
                Sources : amandes, noix du Brésil, légumes verts feuillus, cacao.<br><br>
                <strong>⚡ Vitamine D</strong> — régulation immunitaire, humeur, os<br>
                95% de la synthèse = exposition solaire. Supplémentation recommandée oct → avril en Europe.<br><br>
                <strong>🌊 Oméga-3 (EPA/DHA)</strong> — anti-inflammatoire, cerveau, cœur<br>
                Sources : sardines, maquereaux, saumon, huile de lin, graines de chia.<br><br>
                <strong>🦠 Fibres (prébiotiques)</strong> — nourriture du microbiote intestinal<br>
                Le microbiote produit 90% de la sérotonine (humeur). Objectif : 25-30g/jour.<br>
                Sources : légumes variés, légumineuses, fruits entiers.'
            );

        $lecon2 =
            $this->card($orange, 'L\'inflammation chronique', 'Le lien méconnu entre alimentation et santé globale',
                'L\'inflammation de bas grade chronique est impliquée dans :<br>
                dépression, fatigue chronique, maladies cardiovasculaires, diabète type 2.<br><br>
                <strong>Aliments pro-inflammatoires (à réduire) :</strong><br>
                · Ultra-transformés (additifs, colorants, émulsifiants)<br>
                · Sucres raffinés en excès<br>
                · Huiles végétales riches en oméga-6 (tournesol en excès, maïs)<br>
                · Alcool (même modéré sur la durée)<br><br>
                <strong>Aliments anti-inflammatoires (à privilégier) :</strong><br>
                · Poissons gras (oméga-3)<br>
                · Fruits rouges (polyphénols)<br>
                · Curcuma + poivre noir (biodisponibilité ×20)<br>
                · Huile d\'olive extra vierge (oléocanthal)<br>
                · Légumes crucifères (brocoli, chou, chou-fleur)<br>
                · Thé vert (EGCG)'
            )
            .$this->card($blue, 'Le cerveau & l\'alimentation', 'Ce que vous mangez détermine comment vous pensez',
                '<strong>Sérotonine (humeur, sommeil)</strong><br>
                Précurseur : tryptophane → sources : œufs, dinde, banane, noix, fromage.<br>
                90% fabriquée dans l\'intestin. Un microbiote sain = une humeur plus stable.<br><br>
                <strong>Dopamine (motivation, plaisir)</strong><br>
                Précurseur : tyrosine → sources : œufs, viandes, fèves, amandes.<br>
                Le sucre rapide crée une libération de dopamine → habituation → cravings.<br><br>
                <strong>GABA (calme, anti-anxiété)</strong><br>
                Cofacteur : magnésium. Sources : légumes fermentés, thé vert, légumineuses.<br><br>
                <strong>BDNF (neuroplasticité)</strong><br>
                Augmenté par : exercice, oméga-3, curcuma, café modéré, jeûne intermittent léger.'
            )
            .$this->card($purple, 'Respiration & digestion — la synergie Pause Souffle',
                'Nutrition et pratique respiratoire se renforcent mutuellement',
                'En mode parasympathique (activé par le 5-5-5 avant le repas) :<br>
                · Les enzymes digestives sont sécrétées (amylase, lipase, pepsine)<br>
                · Le péristaltisme intestinal s\'active<br>
                · L\'absorption des micronutriments est optimisée<br>
                · Le reflux gastro-œsophagien diminue<br><br>
                <strong>Le duo gagnant :</strong><br>
                Bons choix nutritionnels + état nerveux parasympathique au repas<br>
                = digestion optimale + absorption maximale des nutriments.<br><br>
                <em>Rappel : Pause Souffle 3 cycles 5-5-5 avant chaque repas principal (Module 11).</em>'
            );

        $ex1 =
            $this->exercice($gold, '1', 'L\'assiette Pause Souffle — le modèle visuel',
                'Un repas équilibré sans calcul — la règle des 4 zones :<br><br>
                🟢 <strong>½ assiette — légumes</strong> (cuits ou crus, variés, colorés)<br>
                🔴 <strong>¼ assiette — protéines</strong> (poisson, œufs, légumineuses, viande)<br>
                🔵 <strong>¼ assiette — glucides de qualité</strong> (céréales complètes, légumineuses, tubercules)<br>
                🟡 <strong>Filet — bonne graisse</strong> (huile d\'olive, avocat, poignée de noix)<br><br>
                Le ratio coloré assure la diversité des micronutriments.<br>
                <em>Pas de comptage. Pas de pesée. Juste le regard conscient sur les proportions.</em>', false
            );

        $ex2 =
            $this->exercice($teal, '2', 'La semaine anti-inflammatoire',
                'Pendant 7 jours, un seul objectif : <strong>ajouter sans enlever</strong>.<br><br>
                Chaque jour, ajoutez UNE des choses suivantes :<br>
                · 1 poignée de noix au petit-déjeuner<br>
                · 1 portion de légumes crucifères (brocoli, chou)<br>
                · 1 c.à.c. de curcuma dans un plat (+ pincée de poivre noir)<br>
                · 1 tasse de thé vert sans sucre<br>
                · 1 filet d\'huile d\'olive sur le plat (pas en cuisson à haute température)<br>
                · 1 portion de poisson gras (sardines, maquereaux, saumon)<br>
                · 1 grande poignée de fruits rouges (frais ou surgelés)<br>
                <em>Ajouter sans culpabiliser sur le reste. Le changement progressif est le seul durable.</em>', false
            )
            .$this->exercice($green, '3', 'Le journal de vitalité (10 jours)',
                'Après chaque repas, notez en 1 minute :<br>
                · Énergie 30 min après : (faible / moyenne / haute)<br>
                · Énergie 2h après : (faible / moyenne / haute)<br>
                · Humeur : (instable / neutre / bonne)<br>
                · Digestion : (légère / normale / lourde)<br><br>
                Après 10 jours : identifiez vos patterns personnels.<br>
                Quels repas donnent une énergie stable ?<br>
                Quels repas précèdent une baisse ou une humeur instable ?<br>
                <em>Ce retour d\'information personnalisé vaut plus que n\'importe quel régime universel.</em>', false
            );

        $meditation =
            $this->exercice($orange, '4', 'La Pause Souffle nutritionnelle (rituel quotidien)',
                '<strong>Avant chaque repas principal :</strong><br>
                3 cycles 5-5-5. Yeux fermés si possible.<br>
                Puis observez votre assiette 10 secondes avant de commencer.<br>
                Notez intérieurement : est-ce une faim physique ou émotionnelle ?<br>
                (Voir Module 11 pour les signaux de distinction)<br><br>
                <em>Ce rituel bi-fonctionne : active la digestion ET renforce la conscience alimentaire.</em>', true
            );

        $reflexion =
            $this->exercice($purple, '5', 'Mon rapport à la nourriture',
                'Posez-vous ces questions dans votre journal :<br><br>
                · Quelle est mon histoire avec la nourriture ? Y a-t-il des règles héritées (parents, culture, régimes passés) ?<br>
                · Est-ce que je mange surtout par faim physique ou par émotion (stress, ennui, récompense) ?<br>
                · Quels aliments me donnent une énergie stable et durable ? Lesquels m\'alourdissent ou m\'agitent ?<br>
                · Quel est le changement nutritionnel le plus simple et le plus durable que je pourrais adopter cette semaine ?<br><br>
                <em>La nutrition durable naît de la conscience, pas de la discipline forcée.</em>', false
            );

        return [
            'description' => 'Nutrition & Vitalité — macronutriments, micronutriments clés, inflammation chronique et cerveau alimentaire : comprendre pour choisir avec conscience et nourrir la vitalité.',
            'intro_text'  => "MODULE 22 — Nutrition & Vitalité\n\nLa nutrition n'est pas un régime. C'est une relation.\nCe module vous donne la biochimie essentielle : macronutriments, micronutriments, inflammation chronique, lien cerveau-alimentation — pour choisir avec conscience, pas par règle.\n\nUn corps bien nourri pense mieux, récupère plus vite, résiste mieux au stress. La vitalité n'est pas un objectif esthétique : c'est votre substrat énergétique pour tout le reste.",
            'audio_path'  => 'formation/audio/22-nutrition-vitalite-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => '🥦 Introduction — La nutrition comme médecine',       'duration' => '4 min',  'description' => 'La nutrition intelligente informe sans contraindre. Comprendre avant de changer.',             'content' => $intro],
                ['type' => 'lecture',   'title' => 'Leçon 1 — Macronutriments & micronutriments',         'duration' => '6 min',  'description' => 'Les 3 carburants du corps et les micronutriments que l\'alimentation moderne épuise.',  'content' => $lecon1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Inflammation, cerveau & digestion',         'duration' => '6 min',  'description' => 'Le lien alimentation-humeur, les aliments anti-inflammatoires et la synergie Pause Souffle.', 'content' => $lecon2],
                ['type' => 'pratique',  'title' => 'Pratique — L\'assiette Pause Souffle',                'duration' => '15 min', 'description' => 'Le modèle visuel des 4 zones pour un repas équilibré sans calcul ni comptage.',              'content' => $ex1],
                ['type' => 'exercice',  'title' => 'Exercice — Semaine anti-inflammatoire & journal',     'duration' => '20 min', 'description' => 'Ajouter sans enlever : 7 petits gestes sur 7 jours + journal de vitalité sur 10 jours.',  'content' => $ex2],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle nutritionnelle',                     'duration' => '5 min',  'description' => 'Rituel avant chaque repas : 3 cycles 5-5-5 pour activer la digestion et la conscience.',   'content' => $meditation, 'audio' => true],
                ['type' => 'reflexion', 'title' => 'Journal — Mon rapport à la nourriture',               'duration' => '8 min',  'description' => 'Explorer son histoire avec la nourriture, ses patterns et le changement le plus durable.', 'content' => $reflexion],
            ],
        ];
    }

    // ─────────────────────────────────────────────────────────────────────────
    // MODULES MANQUANTS — NOUVEAUX (6 modules ajoutés)
    // ─────────────────────────────────────────────────────────────────────────

    private function m03_accepte_limites(): array   // P1 — M03 nouveau
    {
        $indigo = 'rgba(99,102,241,.85)';
        $teal   = 'rgba(20,184,166,.8)';
        $gold   = 'rgba(201,168,76,.9)';
        $purple = 'rgba(168,85,247,.8)';
        $blue   = 'rgba(59,130,246,.8)';

        $lec1 = $this->card($gold, 'Épictète · 135 ap. J.-C.', 'La dichotomie du contrôle — 2 000 ans d\'avance',
            'Le philosophe stoïcien Épictète, ancien esclave, a formulé le principe fondateur de toute liberté intérieure :<br><br>
            <em style="color:'.$gold.';">"Il y a ce qui dépend de nous, et ce qui n\'en dépend pas. Ce qui dépend de nous : nos jugements, nos désirs, nos aversions. Ce qui n\'en dépend pas : le corps, la réputation, la richesse, le pouvoir."</em><br><br>
            <strong>Le problème des gens qui souffrent :</strong> ils consacrent 80 % de leur énergie à contrôler ce qu\'ils ne peuvent pas contrôler, et aucune énergie à ce qu\'ils pourraient transformer.<br><br>
            Marc Aurèle, Sénèque, Épictète — trois millénaires avant les neurosciences — avaient découvert que <strong>la souffrance est proportionnelle à la résistance</strong> : non pas à la douleur elle-même, mais à notre refus qu\'elle soit là.'
        ).$this->card($indigo, 'Steven Hayes · 1986', 'L\'ACT — Acceptance and Commitment Therapy',
            'Steven Hayes (Université du Nevada) a fondé l\'ACT en partant d\'un constat radical : <strong>la tentative de contrôle des pensées et émotions difficiles aggrave invariablement la souffrance.</strong><br><br>
            L\'ACT repose sur 6 processus :<br>
            <strong>① Défusion cognitive</strong> — observer ses pensées sans s\'y identifier<br>
            <strong>② Acceptation</strong> — laisser les émotions difficiles être présentes sans les combattre<br>
            <strong>③ Contact avec le moment présent</strong> — ancrage ici et maintenant<br>
            <strong>④ Soi comme contexte</strong> — "je suis celui qui observe, pas ce que j\'observe"<br>
            <strong>⑤ Valeurs</strong> — identifier ce qui compte vraiment pour soi<br>
            <strong>⑥ Action engagée</strong> — agir selon ses valeurs malgré l\'inconfort<br><br>
            <em style="color:'.$indigo.';">Plus de 300 études randomisées confirment l\'efficacité de l\'ACT sur l\'anxiété, la dépression, la douleur chronique et le burn-out.</em>'
        ).$this->card($purple, 'Kristin Neff · 2003', 'L\'auto-compassion — la troisième voie',
            'La psychologue Kristin Neff (Université du Texas) a been the first to operationalize <strong>l\'auto-compassion comme pratique scientifique</strong>. Elle distingue :<br><br>
            <strong>Auto-compassion ≠ apitoiement</strong> (l\'apitoiement isole ; l\'auto-compassion relie)<br>
            <strong>Auto-compassion ≠ narcissisme</strong> (le narcissisme demande la perfection ; l\'auto-compassion l\'accepte impossible)<br><br>
            Les 3 composantes :<br>
            · <strong>Mindfulness</strong> — voir clairement sans amplifier<br>
            · <strong>Humanité commune</strong> — "je ne suis pas seul(e) à souffrir de ça"<br>
            · <strong>Bienveillance envers soi</strong> — se parler comme à un ami<br><br>
            <em style="color:'.$purple.';">Méta-analyse 2021 (Zessin et al.) : l\'auto-compassion est un prédicteur aussi puissant du bien-être que l\'estime de soi — sans ses effets secondaires (fragilité, comparaison).</em>'
        );

        $lec2 = $this->card($teal, 'La science du lâcher-prise', 'Ce que le cerveau fait quand on arrête de résister',
            'L\'équipe de Matthew Lieberman (UCLA) a montré en 2007 que <strong>nommer une émotion difficile réduit l\'activation de l\'amygdale de 50%</strong>. Pas la supprimer — la nommer.<br><br>
            Ce phénomène s\'appelle <em>affect labeling</em>. Quand vous dites "je ressens de la colère" plutôt que de la subir, le cortex préfrontal s\'active et reprend la régulation.<br><br>
            <strong>Le paradoxe de l\'acceptation :</strong> accepter une émotion difficile ne la renforce pas — elle la laisse passer. C\'est la résistance qui la maintient.<br><br>
            Des études d\'imagerie IRM sur des méditants bouddhistes expérimentés (Lutz, 2004) montrent que lors de stimuli douloureux, leur activation de l\'amygdale est <strong>similaire aux non-méditants — mais la récupération est 4× plus rapide</strong>. Ils n\'évitent pas la douleur. Ils ne s\'y accrochent pas.'
        ).$this->card($blue, 'Viktor Frankl', 'L\'espace entre stimulus et réponse',
            'Viktor Frankl, psychiatre autrichien survivant d\'Auschwitz, a formulé peut-être la phrase la plus citée en psychologie humaine :<br><br>
            <em style="color:'.$blue.';">"Between stimulus and response, there is a space. In that space lies our power to choose our response. In our response lies our growth and our freedom."</em><br><br>
            Frankl ne disait pas qu\'on pouvait choisir ce qui nous arrive. Il disait qu\'on peut toujours choisir son rapport à ce qui arrive.<br><br>
            <strong>Ce module ne vous demande pas de ne plus souffrir.</strong> Il vous demande d\'apprendre à souffrir différemment — à garder cet espace ouvert entre ce qui arrive et ce que vous en faites.'
        );

        $ex1 = $this->exercice($gold, '①', 'Le Triage du Contrôlable (Steven Hayes)',
            'Matériel : une feuille, deux colonnes.<br><br>
            <strong>Étape 1 — Vider (5 min)</strong><br>
            Écrivez tout ce qui vous préoccupe en ce moment : situations, personnes, résultats, pensées.<br><br>
            <strong>Étape 2 — Trier (5 min)</strong><br>
            Pour chaque élément, posez la question : <em>"Est-ce que je peux agir directement sur ça en ce moment ?"</em><br>
            · OUI → colonne <strong>Influence</strong><br>
            · NON → colonne <strong>Laisser être</strong><br><br>
            <strong>Étape 3 — Décider (5 min)</strong><br>
            Pour chaque élément de la colonne Influence : une action concrète, petite, faisable cette semaine.<br>
            Pour chaque élément de la colonne Laisser être : écrivez à côté : <em>"Je lâche prise sur ça."</em><br><br>
            <em>Résultat attendu : une libération immédiate de l\'énergie mentale mobilisée à tort.</em>'
        );

        $ex2 = $this->exercice($purple, '②', 'La Pause d\'Auto-compassion (Kristin Neff)',
            'Cet exercice se fait en 3 minutes dans n\'importe quelle situation difficile. Mémorisez les 3 étapes.<br><br>
            <strong>1 — Reconnaître</strong> (30 secondes)<br>
            Posez la main sur le cœur. Dites intérieurement :<br>
            <em>"C\'est un moment difficile. Je souffre en ce moment."</em><br>
            (Pas de jugement. Juste la vérité.)<br><br>
            <strong>2 — Relier</strong> (30 secondes)<br>
            <em>"La souffrance fait partie de la vie humaine. Je ne suis pas seul(e) à traverser ce genre de moment."</em><br><br>
            <strong>3 — Offrir</strong> (1 minute)<br>
            <em>"Puissé-je me traiter avec bienveillance. Puissé-je me donner ce dont j\'ai besoin."</em><br><br>
            <em>Neff (2011) : pratiqué quotidiennement pendant 4 semaines, cet exercice réduit l\'auto-critique de 43% et l\'anxiété de 35%.</em>', true
        );

        $ex3 = $this->exercice($teal, '③', 'La Défusion Cognitive — "Je remarque que je pense que…"',
            'Cet exercice de l\'ACT crée une distance avec les pensées auto-destructrices.<br><br>
            <strong>Étape 1</strong> : Identifiez une pensée qui vous fait souffrir. Ex : "Je suis incompétent(e)."<br><br>
            <strong>Étape 2</strong> : Transformez-la en :<br>
            <em>"Je remarque que j\'ai la pensée que je suis incompétent(e)."</em><br><br>
            <strong>Étape 3</strong> : Transformez la encore :<br>
            <em>"Mon mental produit la pensée que je suis incompétent(e) — et c\'est une information sur mon état actuel, pas une vérité sur moi."</em><br><br>
            La pensée est toujours là. Mais vous n\'êtes plus dedans. Vous la regardez.<br><br>
            <em>L\'effet neuroscientifique : ce simple changement de formulation active le cortex préfrontal et désactive l\'amygdale — mesurable en IRM fonctionnelle en moins de 30 secondes.</em>'
        );

        $meditation = $this->card($teal, 'Méditation guidée', '🌬 Pause Souffle — Le Ciel et les Nuages (8 min)',
            'Imaginez que vous êtes le ciel. Vos pensées et émotions sont des nuages — parfois orageux, parfois légers — qui traversent.<br>
            Le ciel n\'est jamais détruit par les nuages. Il les contient, les laisse passer.<br>
            3 cycles 5-5-5 en début. Puis observation silencieuse. Puis retour au souffle.'
        );

        return [
            'description' => 'Épictète, ACT (Hayes), Kristin Neff — trois traditions qui convergent : la souffrance vient de la résistance, pas de la réalité. Apprendre à lâcher ce qui ne dépend pas de soi.',
            'intro_text'  => "Ce module vous demande d'oser quelque chose de contre-intuitif.\n\nNon pas vous battre davantage. Non pas trouver une solution.\nMais reconnaître ce qui ne peut pas être changé — et choisir de ne plus y dépenser votre vie.\n\nÉpictète était esclave. Frankl était dans un camp de concentration.\nNi l'un ni l'autre n'avait de pouvoir sur ce qui leur arrivait.\nLes deux ont découvert qu'ils avaient un pouvoir absolu sur ce qu'ils en faisaient.\n\nC'est ce pouvoir que ce module vous transmet.",
            'audio_path'  => 'formation/audio/03-j-accepte-mes-limites-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => 'Leçon 1 — La dichotomie du contrôle (Épictète, ACT, ACT)',         'duration' => '8 min',  'description' => 'Les 2 000 ans de philosophie stoïcienne + les 300 études ACT qui confirment la même vérité : résister ce qu\'on ne contrôle pas amplifie la souffrance.', 'content' => $lec1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Ce que le cerveau fait quand on cesse de résister',     'duration' => '6 min',  'description' => 'Lieberman (UCLA, 2007) : nommer une émotion réduit l\'amygdale de 50%. Frankl : l\'espace entre stimulus et réponse. La neurologie du lâcher-prise.', 'content' => $lec2],
                ['type' => 'exercice',  'title' => '① Le Triage du Contrôlable (Hayes / stoïcisme)',                  'duration' => '15 min', 'description' => 'Deux colonnes : ce que je peux influencer / ce que je dois laisser être. Une action ou un lâcher-prise pour chaque ligne.', 'content' => $ex1],
                ['type' => 'exercice',  'title' => '② La Pause d\'Auto-compassion (Kristin Neff)',                    'duration' => '10 min', 'description' => 'Le protocole en 3 étapes de Neff : reconnaître · relier · offrir. Réduction de l\'auto-critique de 43% en 4 semaines (étude 2011).', 'content' => $ex2],
                ['type' => 'exercice',  'title' => '③ La Défusion Cognitive — "Je remarque que je pense que…" (ACT)', 'duration' => '8 min',  'description' => 'Transformer les pensées auto-destructrices en observations. Effet mesurable en IRM en moins de 30 secondes.', 'content' => $ex3],
                ['type' => 'pratique',  'title' => '🌬 Pause Souffle — Le Ciel et les Nuages (8 min)',               'duration' => '8 min',  'description' => 'Vous êtes le ciel. Vos pensées sont des nuages. Méditation de défusion et d\'acceptance — 3 cycles 5-5-5 + observation silencieuse.', 'content' => $meditation, 'audio' => true],
            ],
            'activities_en' => [
                ['type' => 'lecture',   'title' => 'Lesson 1 — The Dichotomy of Control (Epictetus, Stoicism, ACT)',  'duration' => '8 min',  'description' => '2,000 years of Stoic philosophy + 300 ACT studies confirming the same truth: resisting what we can\'t control amplifies suffering.'],
                ['type' => 'lecture',   'title' => 'Lesson 2 — What the brain does when we stop resisting',           'duration' => '6 min',  'description' => 'Lieberman (UCLA, 2007): naming an emotion reduces amygdala activation by 50%. Frankl\'s space between stimulus and response.'],
                ['type' => 'exercice',  'title' => '① The Controllability Sort (Hayes / Stoicism)',                   'duration' => '15 min', 'description' => 'Two columns: what I can influence / what I must let be. One action or one release for each item.'],
                ['type' => 'exercice',  'title' => '② The Self-Compassion Break (Kristin Neff)',                      'duration' => '10 min', 'description' => 'Neff\'s 3-step protocol: acknowledge · common humanity · offer kindness. 43% reduction in self-criticism in 4 weeks.'],
                ['type' => 'exercice',  'title' => '③ Cognitive Defusion — "I notice that I am thinking that…" (ACT)','duration' => '8 min', 'description' => 'Transforming self-destructive thoughts into observations. Measurable via fMRI in under 30 seconds.'],
                ['type' => 'pratique',  'title' => '🌬 Breathe Break — The Sky and the Clouds (8 min)',               'duration' => '8 min',  'description' => 'You are the sky. Your thoughts are clouds. Defusion and acceptance meditation — 3×5-5-5 cycles + silent observation.'],
            ],
        ];
    }

    private function m04_drains_energie(): array   // P1 — M04 nouveau — VERSION ENRICHIE
    {
        $orange = 'rgba(249,115,22,.8)';
        $red    = 'rgba(239,68,68,.8)';
        $gold   = 'rgba(201,168,76,.9)';
        $teal   = 'rgba(20,184,166,.8)';
        $green  = 'rgba(34,197,94,.8)';
        $indigo = 'rgba(99,102,241,.85)';

        /* ── LEÇON 1 ── Schwartz + Nagoski ──────────────────────── */
        $lec1 = $this->card($gold, 'Tony Schwartz & Jim Loehr · 2003', 'The Power of Full Engagement — les 4 réservoirs d\'énergie',
            'Schwartz et Loehr ont passé 20 ans à étudier ce qui distinguait les athlètes et dirigeants qui performaient durablement de ceux qui s\'effondraient. Leur conclusion :<br><br>
            <em style="color:'.$gold.';">"Le problème central de l\'homme moderne n\'est pas le manque de temps. C\'est le manque d\'énergie à chaque niveau de son être."</em><br><br>
            <strong>Les 4 réservoirs hiérarchiques :</strong><br><br>
            <strong>① PHYSIQUE — le carburant de base</strong><br>
            Nutrition, sommeil, mouvement. Si ce réservoir est vide, les trois autres ne compensent pas. Schwartz documente : <em>après 17h d\'éveil continu, les capacités cognitives équivalent à un taux d\'alcoolémie de 0,05%.</em> Un dirigeant épuisé physiquement prend des décisions que son cerveau reposé n\'aurait jamais prises.<br><br>
            <strong>② ÉMOTIONNEL — la qualité de l\'énergie</strong><br>
            Sécurité, confiance, curiosité, plaisir. Un drain émotionnel chronique (relation toxique, conflit non résolu, environnement hostile) consomme de l\'énergie cognitive en arrière-fond — comme une application ouverte qui tourne invisiblement. La créativité, l\'empathie et la résilience disparaissent les premières.<br><br>
            <strong>③ MENTAL — la focalisation</strong><br>
            Concentration, organisation, pensée créative. Dépend entièrement des deux niveaux précédents. Un cerveau émotionnellement épuisé ne peut pas se concentrer — c\'est physiologiquement impossible : l\'amygdale chroniquement activée inhibe le cortex préfrontal.<br><br>
            <strong>④ SENS — la direction</strong><br>
            Valeurs, mission, raison d\'agir. Sans sens perçu, chaque effort coûte 3 à 4 fois plus d\'énergie qu\'un effort librement consenti. Frankl l\'avait formulé avant Schwartz dans les camps de concentration.<br><br>
            <strong>Le principe fondateur :</strong> l\'énergie se <em>dépense</em> ET se <em>récupère</em>. La récupération n\'est pas de la paresse — c\'est de la gestion stratégique de ressource. Les sportifs de haut niveau oscillent consciemment entre effort et récupération. Les burn-outs ignorent la récupération jusqu\'à ce qu\'elle s\'impose de force.'
        ).$this->card($orange, 'Emily & Amelia Nagoski · 2019', 'Burnout — le cycle du stress biologiquement non complété',
            'Les sœurs Nagoski ont introduit un concept que la plupart des approches du burn-out ignorent totalement :<br><br>
            <strong>La réponse au stress est un cycle biologique complet. Elle commence, elle monte, elle doit se terminer.</strong><br><br>
            <em style="color:'.$orange.';">Le problème central : nous gérons le stresseur (la cause) sans jamais compléter le cycle (la réponse biologique du corps).</em><br><br>
            Exemple concret : vous avez une conversation difficile avec votre patron. Elle se termine. Mais votre corps est encore en état de réponse au stress — cortisol élevé, muscles tendus, système immunitaire supprimé. Vous rentrez chez vous. Vous ruminez. Vous dormez mal. Le lendemain, vous portez un cycle non complété de la veille en plus des nouvelles charges du jour.<br><br>
            <strong>Ce que le corps attend pour fermer le cycle :</strong><br>
            · <strong>Mouvement physique</strong> — 20-30 min de marche ou sport (solution la plus efficace biologiquement)<br>
            · <strong>Respiration profonde</strong> — 5-10 cycles lents signalent au système nerveux que le danger est passé<br>
            · <strong>Contact physique sincère</strong> — 20 secondes d\'étreinte libèrent de l\'ocytocine et stoppent le cortisol<br>
            · <strong>Expression émotionnelle</strong> — pleurer, chanter, créer, écrire — compléter l\'émotion par l\'expression<br>
            · <strong>Rire authentique</strong> — pas de politesse — 30 secondes de rire profond modifient la chimie du cerveau, mesurable en IRM<br><br>
            <em style="color:'.$orange.';">Les gens épuisés croient avoir besoin de moins de stress. Nagoski corrige : ils ont besoin de compléter les cycles. Un seul cycle non fermé par jour pendant 30 jours constitue un réservoir de fatigue chronique impossible à compenser par le week-end.</em>'
        );

        /* ── LEÇON 2 ── Hochschild + Cameron + neurobiologie ────── */
        $lec2 = $this->card($red, 'Arlie Hochschild · 1983 & Kim Cameron · 2003', 'Le travail émotionnel invisible & les 4 profils qui drainent',
            '<strong>Arlie Hochschild — The Managed Heart (Berkeley, 1983)</strong><br>
            5 ans d\'interviews d\'hôtesses de l\'air et d\'agents de recouvrement. Sa découverte : ces métiers exigent de <em>gérer ses émotions comme une marchandise.</em><br><br>
            Elle nomme ça <strong>emotional labor</strong> — le travail invisible de ressentir ou montrer les émotions requises par un rôle.<br><br>
            Deux stratégies reconnues :<br>
            · <strong>Surface acting</strong> — masque : on montre ce qu\'on ne ressent pas. Épuisement immédiat, dissociation progressive.<br>
            · <strong>Deep acting</strong> — méthode Stanislavski : on se convainc de ressentir ce qu\'on doit montrer. Épuisement différé mais identité progressivement érodée.<br><br>
            La révélation pour les non-soignants : <em>vous faites de l\'emotional labor dans presque toutes vos relations</em> — avec votre patron (enthousiasme simulé), vos enfants (patience infinie), vos parents (non-dit chronique), vos ami(e)s (soutien asymétrique). Sans en avoir conscience. Sans compensation.<br><br>
            <strong>Kim Cameron — Michigan Business School (2003)</strong><br>
            116 organisations sur 2 années. La découverte qui choque :<br>
            <em style="color:'.$red.';">Une seule personne à énergie négative annule l\'effet positif de plusieurs personnes énergisantes dans le même groupe.</em><br><br>
            Les 4 profils chroniquement drainants :<br>
            <strong>① Le Vampire Émotionnel</strong> — prend sans donner. Chaque échange vous laisse vide sans raison identifiable.<br>
            <strong>② Le Dramaturge</strong> — transforme chaque événement anodin en catastrophe existentielle. Anxiété contagieuse.<br>
            <strong>③ Le Juge externalisé</strong> — critique systématique, jamais satisfait. Nourrit votre propre juge intérieur.<br>
            <strong>④ Le Passif Absorbant</strong> — ni positif ni négatif, aspire l\'énergie par inertie totale. Communication à sens unique indéfiniment.'
        ).$this->card($teal, 'Robert Sapolsky · 2004 & Bruce McEwen · 2000', 'La biologie du drain chronique — quand le corps tient les comptes',
            '<strong>Robert Sapolsky — Why Zebras Don\'t Get Ulcers (Stanford, 2004)</strong><br>
            Sa formule brutale :<br>
            <em style="color:'.$teal.';">"Les zèbres n\'ont pas d\'ulcères. Parce qu\'ils ne ruminent pas leur stress passé ni n\'anticipent leur stress futur. Ils répondent — puis ils s\'arrêtent."</em><br><br>
            Chez l\'humain moderne, la réponse au stress est <strong>chroniquement activée sans jamais se refermer</strong>. Les effets cumulés du cortisol élevé en continu :<br>
            · Système immunitaire supprimé en permanence<br>
            · Inflammation systémique (marqueur commun à toutes les maladies chroniques modernes)<br>
            · Atrophie progressive de l\'hippocampe (mémoire, apprentissage, régulation émotionnelle)<br>
            · Hypertrophie de l\'amygdale (réactivité émotionnelle et anxiété augmentées durablement)<br>
            · Réduction du sommeil récupérateur et de la régénération cellulaire<br><br>
            <strong>Bruce McEwen — Allostatic Load (Rockefeller University, 2000)</strong><br>
            McEwen a nommé la charge cumulative du stress sur le corps : <em>allostatic load</em>. Elle est mesurable biologiquement (cortisol basal, CRP, ratio cortisol/DHEA). Au-delà d\'un seuil critique, le corps ne récupère plus spontanément — même avec du repos forcé ou des vacances.<br><br>
            <strong>Guy Winch (2013)</strong> complète : la rumination mentale autour des drains réduit le volume hippocampal exactement comme le PTSD. Ce n\'est pas "de la pensée" — c\'est une blessure neurologique mesurable.'
        );

        /* ── EXERCICE 1 ── Cartographie complète ─────────────────── */
        $ex1 = $this->exercice($orange, '①', 'La Cartographie Complète des Drains — 7 domaines, scoring, prioritisation',
            'Matériel : feuille A4 ou tableur. Durée : 25-30 minutes seul(e), sans interruption.<br><br>
            <strong>ÉTAPE 1 — Inventaire brut (10 min)</strong><br>
            Pour chaque domaine, listez TOUT ce qui vous vient — sans filtrer, sans juger.<br><br>
            <strong>① PERSONNES</strong><br>
            Qui vous laisse régulièrement plus épuisé(e) après chaque échange ? Plus irritable sans raison claire ? Qui vous donne l\'impression de porter quelque chose qui n\'était pas là avant ?<br><br>
            <strong>② ENVIRONNEMENTS</strong><br>
            Quels espaces physiques compriment votre énergie dès l\'entrée ? (bureau, salle de réunion, certaines pièces chez vous, transports, supermarchés...)<br><br>
            <strong>③ NUMÉRIQUE & MÉDIAS</strong><br>
            Quelles apps, flux, newsletters, groupes vous laissent plus agité(e), anxieux(se) ou vide qu\'avant les avoir consultés ?<br><br>
            <strong>④ HABITUDES & COMPORTEMENTS</strong><br>
            Quels comportements répétez-vous alors qu\'ils vous coûtent plus qu\'ils ne vous apportent ? (procrastination, over-commitment, perfectionnisme, réseaux la nuit, repas sautés...)<br><br>
            <strong>⑤ PENSÉES RÉCURRENTES</strong><br>
            Quels films mentaux tournent en boucle ? ("je devrais", "et si", "c\'est ma faute", "il/elle pense que...")<br><br>
            <strong>⑥ ENGAGEMENTS & RÔLES</strong><br>
            Quels oui avez-vous donnés alors que tout en vous disait non — et que vous maintenez encore ? (associations, obligations sociales, responsabilités non désirées...)<br><br>
            <strong>⑦ CORPS & SIGNAUX IGNORÉS</strong><br>
            Quels signaux votre corps envoie depuis des semaines sans être entendus ? (tension cervicale, fatigue au réveil, digestion difficile, serrement de poitrine...)<br><br>
            <strong>ÉTAPE 2 — Scoring (10 min)</strong><br>
            Pour chaque item listé, attribuez 3 notes :<br>
            · <strong>F = Fréquence</strong> (1-5) : expositions par semaine<br>
            · <strong>I = Intensité</strong> (1-5) : niveau d\'épuisement à chaque exposition<br>
            · <strong>M = Modifiabilité</strong> (1-3) : 1=impossible à changer / 2=possible avec effort / 3=facile<br><br>
            <strong>Score Drain</strong> = F × I &nbsp;&nbsp; | &nbsp;&nbsp; <strong>Priorité d\'action</strong> = F × I × M<br><br>
            <strong>ÉTAPE 3 — Top 5 (5 min)</strong><br>
            Classez par Priorité d\'action décroissante. Entourez les 5 premiers.<br>
            Ce tableau est votre carte de travail pour l\'exercice ③ (Protocole de Décontamination).', true
        );

        /* ── EXERCICE 2 ── Bilan 7 jours ──────────────────────────── */
        $ex2 = $this->exercice($red, '②', 'Le Bilan Énergétique 7 Jours — mesurer avant d\'agir',
            'Avant de changer quoi que ce soit, mesurez. La plupart des personnes épuisées ont une image très imprécise de leur énergie réelle au fil de la journée et de la semaine.<br><br>
            <strong>Le tracker (3 minutes chaque soir pendant 7 jours)</strong><br><br>
            <strong>1 — Niveau d\'énergie aux 3 moments clés (0-10)</strong><br>
            Réveil : ___ &nbsp;|&nbsp; 14h : ___ &nbsp;|&nbsp; 19h : ___<br><br>
            <strong>2 — Le plus grand drain du jour</strong> — une phrase.<br>
            Format : [domaine] + [cause précise] + [intensité /10]<br>
            Ex : "Personnes — échange tendu avec X — intensité 7/10"<br><br>
            <strong>3 — Le plus grand boost du jour</strong> — une phrase.<br>
            Ex : "Mouvement — 30 min de marche seul(e) — remontée +6/10"<br><br>
            <strong>4 — Cycle de stress complété ? (Nagoski)</strong><br>
            OUI = j\'ai fait quelque chose (physique, créatif, émotionnel) pour fermer un stress du jour.<br>
            NON = le stress est encore dans le corps.<br><br>
            <strong>Analyse après 7 jours :</strong><br>
            · Quel jour de la semaine est systématiquement le plus creux ?<br>
            · Quelle heure de la journée ?<br>
            · Quel type de drain revient 3 fois ou plus ?<br>
            · Quel boost est le plus reproductible avec le moins d\'effort ?<br>
            · Combien de cycles de stress non fermés sur 7 jours ?<br><br>
            <em style="color:'.$red.';">Le simple fait de mesurer change le comportement (effet observateur). Des participants rapportent des modifications spontanées de leurs habitudes dès la semaine de mesure — sans qu\'aucune instruction supplémentaire ne leur ait été donnée.</em>'
        );

        /* ── EXERCICE 3 ── Protocole de décontamination ── NOUVEAU ─ */
        $ex3 = $this->exercice($teal, '③', 'Le Protocole de Décontamination — plan d\'action concret sur 30 jours',
            'Cet exercice démarre après les exercices ① et ②. Vous avez identifié vos 3 drains les plus coûteux. Ce protocole vous donne la méthode exacte pour agir sur chacun.<br><br>
            <strong>Pour chaque drain, posez les 3 questions dans l\'ordre :</strong><br><br>
            <strong>QUESTION A — Puis-je l\'éliminer dans les 30 prochains jours ?</strong><br>
            Est-il réaliste de supprimer complètement l\'exposition ?<br>
            · OUI → planifiez la date et la méthode précise. Qui prévenir ? Quelle conversation nécessaire ?<br>
            · NON (engagement légal, relation non quittable, contrainte réelle) → passer à B.<br><br>
            <strong>QUESTION B — Puis-je réduire l\'exposition de 50% ?</strong><br>
            Exemples concrets :<br>
            · Personne drainante au travail → réunions quotidiennes → hebdomadaires + emails plutôt qu\'appels<br>
            · Réseaux sociaux → désactiver les notifications + fenêtre dédiée de 15 min vs scroll libre<br>
            · Engagement non désiré → négocier une réduction de responsabilité plutôt qu\'une démission immédiate<br>
            · Pensée récurrente → "règle des 5 min" : lui accorder 5 min dédiées puis la ranger consciemment<br><br>
            <strong>QUESTION C — Puis-je créer une barrière protectrice ?</strong><br>
            3 types de barrières :<br>
            · <strong>Temporelle</strong> — "Je ne réponds pas aux messages professionnels après 20h." Règle simple, visible, non négociable.<br>
            · <strong>Physique</strong> — Distance, écran, fermeture de porte, casque anti-bruit en open-space.<br>
            · <strong>Cognitive</strong> — Pré-cadrer la réaction avant l\'exposition : "Quand X dit Y, je note l\'information sans l\'absorber émotionnellement."<br><br>
            <strong>Tableau de bord 30 jours :</strong><br>
            Drain 1 : ___ · Stratégie : A/B/C · Action J+1 : ___ · Bilan J+30 : ___<br>
            Drain 2 : ___ · Stratégie : A/B/C · Action J+1 : ___ · Bilan J+30 : ___<br>
            Drain 3 : ___ · Stratégie : A/B/C · Action J+1 : ___ · Bilan J+30 : ___<br><br>
            <em>La différence entre ce qui change et ce qui reste identique n\'est pas la motivation — c\'est la spécificité du plan. Gollwitzer (1999, NYU) — implementation intentions : une action associée à un contexte précis (quand X, je fais Y) a 3× plus de chances d\'être réalisée qu\'une intention vague.</em>'
        );

        /* ── EXERCICE 4 ── Inventaire des recharges ── NOUVEAU ────── */
        $ex4 = $this->exercice($green, '④', 'L\'Inventaire des Recharges — construire l\'autre côté de l\'équation',
            'Identifier les drains ne suffit pas. Il faut construire activement les recharges — les sources d\'énergie qui compensent et dépassent les pertes.<br><br>
            <strong>Deux types fondamentaux :</strong><br><br>
            <strong>RECHARGES PASSIVES</strong> — récupération par absence de dépense<br>
            · Sommeil de qualité (régularité, obscurité, fraîcheur, rituel de nuit)<br>
            · Temps non-structuré sans agenda ni objectif<br>
            · Nature : 20 min en environnement naturel réduisent le cortisol de 21% (Ulrich, 1984 ; White & Alcock, 2019)<br>
            · Solitude intentionnelle (voir Module 27 — Apprivoiser la solitude choisie)<br><br>
            <strong>RECHARGES ACTIVES</strong> — récupération par investissement positif<br>
            · Mouvement physique — complétion du cycle de stress (Nagoski)<br>
            · Activités en flow — absorption totale, sans décision de volonté requise<br>
            · Relations nourrissantes — les personnes après qui vous êtes plus grand(e) qu\'avant<br>
            · Création — cuisine, musique, écriture, jardinage — produire quelque chose de tangible<br><br>
            <strong>L\'exercice en 4 étapes :</strong><br><br>
            <strong>① Listez 10 recharges</strong> actuelles (même celles que vous faites rarement)<br>
            <strong>② Notez pour chacune</strong> : fréquence réelle / fréquence idéale / ratio énergie récupérée/temps investi (1-10)<br>
            <strong>③ Identifiez vos 3 meilleures</strong> (forte récupération, temps minimal, reproductible)<br>
            <strong>④ Planifiez-en une</strong> dans votre agenda des 7 prochains jours — date, heure, durée, avec qui si nécessaire<br><br>
            <strong>Règle de contre-programmation :</strong><br>
            Pour chaque drain identifié en ①, programmez une recharge dans le même domaine :<br>
            Drain relationnel → recharge dans la nature ou solitude | Drain mental → recharge physique ou créative | Drain physique → sommeil + mouvement doux<br><br>
            <em style="color:'.$green.';">Konicz & Miller (Scandinavian Journal of Psychology, 2018) : les personnes qui identifient et pratiquent consciemment leurs 3 recharges les plus efficaces récupèrent 2× plus vite du burn-out que celles qui attendent que l\'envie vienne.</em>'
        );

        /* ── ÉCRITURE ─────────────────────────────────────────────── */
        $ecrit = $this->exercice($gold, '✍', 'La Lettre de Séparation Symbolique (Pennebaker)',
            'Choisissez votre drain prioritaire absolu — celui qui figure en tête de votre classement de l\'exercice ①.<br><br>
            Écrivez-lui une lettre. Pas nécessairement pour l\'envoyer. Mais complète, honnête, courageuse.<br><br>
            <strong>"Voici ce que tu m\'as coûté jusqu\'ici…"</strong> (6-8 lignes)<br>
            Soyez précis(e). Temps, énergie, opportunités ratées, joies annulées, santé sacrifiée. Quantifiez si vous pouvez : heures par semaine, jours par an, années cumulées.<br><br>
            <strong>"Voici pourquoi je suis resté(e) malgré ce coût…"</strong> (6-8 lignes)<br>
            Sans vous juger. La peur de quoi exactement ? Quelle croyance sur vous-même ? Quelle loyauté inconsciente ? Quelle identité à protéger ?<br><br>
            <strong>"Voici ce que j\'ai besoin de te dire directement…"</strong> (4-6 lignes)<br>
            Ce que vous n\'avez jamais osé dire — ni à la personne/situation, ni à vous-même à voix haute.<br><br>
            <strong>"Et voici ce que je choisis maintenant…"</strong> (4-6 lignes)<br>
            Pas ce que vous devriez faire. Ce que <em>vous</em> choisissez librement. La différence est immense.<br><br>
            <em style="color:'.$gold.';">James Pennebaker (UT Austin, 40 000+ participants, 30 ans de recherche) : l\'écriture expressive de cette forme réduit les marqueurs biologiques du stress dans le sang en 14 jours. Moins de consultations médicales. Meilleur sommeil. Immunité renforcée. Effet identique que la lettre soit envoyée, conservée ou brûlée.</em>'
        );

        /* ── MÉDITATION ── NOUVEAU ───────────────────────────────── */
        $meditation = $this->card($teal, 'Méditation guidée · 10 min', '🌬 Scan Énergétique — localiser et libérer le drain dans le corps',
            'Cette pratique s\'appuie sur la somatique — l\'observation fondamentale que les drains émotionnels et mentaux chroniques se logent dans des zones précises du corps, sous forme de tension, compression ou pesanteur.<br><br>
            <strong>Installez-vous :</strong> assis(e) ou allongé(e). Téléphone en mode avion. Yeux fermés ou mi-clos. Laissez le souffle se stabiliser. Trois expirations longues et complètes — sans forcer l\'inspiration.<br><br>
            <strong>Phase 1 — Inventaire corporel (2 min)</strong><br>
            Parcourez mentalement votre corps de la tête aux pieds, comme un scanner.<br>
            Notez intérieurement : où y a-t-il de la tension ? De la chaleur inhabituellement localisée ? Une lourdeur ? Un serrement ? Un vide ?<br>
            Ne cherchez pas à changer. Observez uniquement. Localisez.<br><br>
            <strong>Phase 2 — Scan ciblé des 7 zones de drain (5 min)</strong><br>
            Posez votre attention 30 secondes sur chaque zone. Laissez venir ce qui vient :<br>
            · <strong>Mâchoire</strong> — mots retenus, jugements non exprimés, colère ravalée<br>
            · <strong>Gorge</strong> — vérités non dites, demandes jamais formulées, dialogue intérieur étouffé<br>
            · <strong>Épaules & nuque</strong> — responsabilités portées qui n\'appartiennent peut-être pas<br>
            · <strong>Poitrine</strong> — chagrin non traité, peur ancienne, colère rentrée depuis longtemps<br>
            · <strong>Ventre</strong> — anxiété du futur, "et si…", attente chronique, instabilité<br>
            · <strong>Bas du dos</strong> — peur de perdre un appui, insécurité de survie<br>
            · <strong>Jambes & pieds</strong> — contact avec le sol, stabilité, présence ici ou fuite continuelle<br><br>
            Pour chaque zone tendue : posez votre attention comme une main bienveillante — sans forcer, sans analyser.<br>
            Souvent, la seule attention consciente amorcera le relâchement.<br><br>
            <strong>Phase 3 — Libération ciblée (3 min)</strong><br>
            Identifiez la zone la plus tendue de votre corps en ce moment.<br>
            Inspirez lentement en dirigeant mentalement le souffle vers cette zone — comme si l\'air allait la toucher.<br>
            À l\'expiration complète : laissez-la se relâcher de la quantité qu\'elle peut. Pas forcé. Pas parfait.<br>
            Répétez 5 fois sur cette même zone.<br><br>
            Avant d\'ouvrir les yeux, demandez-vous en silence :<br>
            <em>"À quelle source de drain correspond cette tension ?"</em><br>
            La réponse arrive souvent sans qu\'on la cherche. Notez-la si vous pouvez.<br><br>
            <em style="color:'.$teal.';">Peter Levine (Somatic Experiencing) et Bessel van der Kolk (The Body Keeps the Score, 2014) : les stress chroniques se stockent dans les tissus corporels. Le scan somatique régulier est aussi efficace que la TCC pour le stress chronique (Journal of Traumatic Stress, 2018).</em>'
        );

        return [
            'description' => 'Schwartz, Nagoski, Hochschild, Sapolsky — l\'épuisement n\'est pas un manque de volonté. C\'est une biologie. Cartographier · mesurer · décontaminer · recharger — dans cet ordre.',
            'intro_text'  => "La plupart des gens qui se sentent épuisés pensent qu'ils manquent de temps.\nIls ont tort. Ils manquent d'énergie.\n\nEt ce n'est pas le même problème.\n\nOn peut avoir toute la journée devant soi et n'avoir aucune ressource pour l'habiter.\nOn peut n'avoir que deux heures — et accomplir l'essentiel si l'énergie est pleine.\n\nCe module ne cherche pas à vous rendre plus productif(ve).\nIl cherche à vous rendre à votre propre vitalité —\ncette énergie qui était là avant que vous appreniez à vivre sans elle.",
            'audio_path'  => 'formation/audio/04-je-reconnais-ce-qui-me-draine-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',  'title' => 'Leçon 1 — Les 4 réservoirs d\'énergie & le cycle du stress (Schwartz, Nagoski)',         'duration' => '9 min',  'description' => 'Full Engagement : les 4 niveaux hiérarchiques d\'énergie humaine. Nagoski (2019) : le cycle biologique du stress non complété — pourquoi le week-end ne suffit pas.', 'content' => $lec1],
                ['type' => 'lecture',  'title' => 'Leçon 2 — Travail émotionnel invisible & neurobiologie du drain (Hochschild, Sapolsky)', 'duration' => '8 min',  'description' => 'Emotional labor (Hochschild 1983). Les 4 profils drainants (Cameron 2003). Allostatic load (McEwen 2000). Rumination = blessure hippocampale (Winch 2013, Sapolsky 2004).', 'content' => $lec2],
                ['type' => 'exercice', 'title' => '① La Cartographie Complète des Drains — 7 domaines, scoring F×I×M',                    'duration' => '25 min', 'description' => 'Inventaire brut × 7 domaines (personnes, environnements, numérique, habitudes, pensées, engagements, corps). Scoring Fréquence × Intensité × Modifiabilité. Top 5 prioritaires.', 'content' => $ex1],
                ['type' => 'exercice', 'title' => '② Le Bilan Énergétique 7 Jours — mesurer avant d\'agir',                              'duration' => '7 jours', 'description' => '3 min/soir : énergie aux 3 moments clés, drain du jour, boost du jour, cycle de stress fermé ? Courbes et patterns révélés après 7 jours de données réelles.', 'content' => $ex2],
                ['type' => 'exercice', 'title' => '③ Le Protocole de Décontamination — 30 jours sur vos 3 drains prioritaires',          'duration' => '30 min', 'description' => 'Pour chaque drain : A=éliminer / B=réduire 50% / C=créer une barrière. Plan J+1 et J+30. Implementation intentions de Gollwitzer : 3× plus de chances de succès.', 'content' => $ex3],
                ['type' => 'exercice', 'title' => '④ L\'Inventaire des Recharges — l\'autre côté de l\'équation',                        'duration' => '20 min', 'description' => 'Recharges passives vs actives. Identifier les 3 plus efficaces (ratio énergie/temps). Une planifiée dans les 7 jours. Règle de contre-programmation drain/recharge par domaine.', 'content' => $ex4],
                ['type' => 'ecriture', 'title' => '✍ La Lettre de Séparation Symbolique (Pennebaker)',                                   'duration' => '20 min', 'description' => 'Écrire au drain prioritaire : coût précis quantifié, raisons de rester, ce qui doit être dit, ce qui est maintenant choisi. Réduction mesurable du cortisol en 14 jours.', 'content' => $ecrit],
                ['type' => 'pratique', 'title' => '🌬 Scan Énergétique — localiser et libérer le drain dans le corps (10 min)',           'duration' => '10 min', 'description' => 'Scan somatique des 7 zones corporelles (mâchoire, gorge, épaules, poitrine, ventre, dos, pieds). Respiration ciblée + relâchement conscient. Levine & van der Kolk.', 'content' => $meditation, 'audio' => true],
            ],
            'activities_en' => [
                ['type' => 'lecture',  'title' => 'Lesson 1 — The 4 energy reservoirs & the stress cycle (Schwartz, Nagoski)',            'duration' => '9 min',  'description' => 'Full Engagement: 4 hierarchical energy levels. Nagoski (2019): the incomplete biological stress cycle — why the weekend isn\'t enough.'],
                ['type' => 'lecture',  'title' => 'Lesson 2 — Invisible emotional labor & the neurobiology of drain',                    'duration' => '8 min',  'description' => 'Emotional labor (Hochschild 1983). 4 draining profiles (Cameron 2003). Allostatic load (McEwen). Rumination = hippocampal damage (Winch, Sapolsky).'],
                ['type' => 'exercice', 'title' => '① The Complete Drain Map — 7 domains, F×I×M scoring',                                'duration' => '25 min', 'description' => 'Raw inventory × 7 domains (people, environments, digital, habits, thoughts, commitments, body). Frequency × Intensity × Modifiability scoring. Top 5 priorities.'],
                ['type' => 'exercice', 'title' => '② The 7-Day Energy Audit — measure before acting',                                   'duration' => '7 days', 'description' => '3 min/evening: energy at 3 key moments, day\'s drain, day\'s boost, stress cycle closed? Curves and patterns revealed after 7 days of real data.'],
                ['type' => 'exercice', 'title' => '③ The Decontamination Protocol — 30 days on your 3 priority drains',                 'duration' => '30 min', 'description' => 'For each drain: A=eliminate / B=reduce 50% / C=create barrier. Plan at D+1 and D+30. Implementation intentions: 3× more likely to succeed.'],
                ['type' => 'exercice', 'title' => '④ The Recharge Inventory — the other side of the equation',                          'duration' => '20 min', 'description' => 'Passive vs active recharges. Identify top 3 most efficient (energy/time ratio). Schedule one in 7 days. Drain/recharge counter-programming by domain.'],
                ['type' => 'ecriture', 'title' => '✍ The Symbolic Separation Letter (Pennebaker)',                                       'duration' => '20 min', 'description' => 'Write to your priority drain: precise quantified cost, reasons for staying, what must be said, what is now chosen. Measurable cortisol reduction in 14 days.'],
                ['type' => 'pratique', 'title' => '🌬 Energy Scan — locate and release drain in the body (10 min)',                      'duration' => '10 min', 'description' => 'Somatic scan of 7 body zones (jaw, throat, shoulders, chest, belly, back, feet). Targeted breathing + conscious release. Levine & van der Kolk approach.'],
            ],
        ];
    }

    private function m10b_maitriser_temps(): array   // P2 — M12 nouveau
    {
        $purple = 'rgba(168,85,247,.8)';
        $indigo = 'rgba(99,102,241,.85)';
        $gold   = 'rgba(201,168,76,.9)';
        $blue   = 'rgba(59,130,246,.8)';
        $teal   = 'rgba(20,184,166,.8)';

        $lec1 = $this->card($gold, 'Cal Newport · 2016', 'Deep Work — la capacité rare qui devient précieuse',
            'Le professeur d\'informatique Cal Newport (Georgetown) a publié en 2016 ce qui est considéré comme le livre fondateur de l\'économie de l\'attention :<br><br>
            <em style="color:'.$gold.';">"Deep Work : la capacité à se concentrer sans distraction sur une tâche cognitivement exigeante est en train de devenir rare et en même temps de plus en plus précieuse dans notre économie."</em><br><br>
            Son observation centrale : <strong>la plupart des knowledge workers ne font jamais de vraie concentration profonde</strong>. Ils font du shallow work — emails, réunions, multitâches — et appellent ça "travailler dur".<br><br>
            Newport a analysé des génies de l\'histoire — Darwin (4h de travail réel/jour), Jung (retraite annuelle en Suisse), Thoreau — et conclut : <strong>les grandes œuvres se font en blocs de concentration ininterrompue, jamais dans le flux de l\'urgence</strong>.<br><br>
            Sa formule :<br>
            <em style="color:'.$gold.';">Résultats = Temps × Intensité de concentration (≠ Temps + Effort éparpillé)</em>'
        ).$this->card($purple, 'Loi de Parkinson · 1955', 'Le travail se dilate pour occuper tout le temps disponible',
            'En 1955, l\'historien britannique Cyril Northcote Parkinson a formulé sa loi célèbre dans <em>The Economist</em> :<br><br>
            <em style="color:'.$purple.';">"Work expands so as to fill the time available for its completion."</em><br><br>
            Ce qui semble un bon mot est une observation profondément vérifiée :<br>
            · Si vous avez 3 heures pour rédiger un rapport, il prend 3 heures.<br>
            · Si vous en avez 6, il prend 6 heures.<br>
            · Si vous avez une deadline dans 30 minutes, vous trouvez l\'essentiel en 30 minutes.<br><br>
            <strong>La conclusion contre-intuitive :</strong> avoir plus de temps ne produit pas un meilleur résultat. Il produit davantage de procrastination, de perfectionnisme, et de travail superficiel.<br><br>
            <em style="color:'.$purple.';">La solution : se fixer volontairement des contraintes de temps inférieures au temps disponible.</em>'
        );

        $lec2 = $this->card($indigo, 'Kahneman · 2011 + Ciotti', 'Le biais de planification — pourquoi tout prend toujours plus longtemps que prévu',
            'Daniel Kahneman (Nobel d\'économie 2002) a documenté le <strong>planning fallacy</strong> :<br><br>
            <em style="color:'.$indigo.';">Nous sous-estimons systématiquement le temps que prendront nos projets, même quand nous avons vécu la même chose par le passé.</em><br><br>
            La cause : nous planifions dans le meilleur scénario imaginable — aucune interruption, aucun imprévu, concentration parfaite — alors que la réalité est toujours plus complexe.<br><br>
            La correction de Kahneman :<br>
            · <strong>Reference class forecasting</strong> : "Pour une tâche similaire, combien de temps ai-je réellement mis ?"<br>
            · Multiplier son estimation par 1,5 pour les tâches courtes et par 2 pour les projets.<br><br>
            Et pour la concentration : le neuroscientifique Andreas Trafton (MIT) a mesuré qu\'après une interruption, le cerveau met <strong>23 minutes en moyenne</strong> à retrouver un niveau d\'immersion équivalent (pas 5, pas 10 — 23 minutes).'
        ).$this->card($teal, 'Csikszentmihalyi · 1990', 'Le Flow — l\'état d\'absorption totale',
            'Le psychologue Mihaly Csikszentmihalyi a étudié pendant 30 ans ce qu\'il appelle le <strong>flow</strong> : l\'état d\'immersion totale dans une activité.<br><br>
            Les conditions du flow :<br>
            · La <strong>difficulté de la tâche est légèrement supérieure au niveau de compétence</strong> (trop facile = ennui ; trop difficile = anxiété)<br>
            · L\'<strong>objectif est clair</strong><br>
            · Le <strong>feedback est immédiat</strong><br>
            · Les <strong>distractions sont absentes</strong><br><br>
            Ce que Csikszentmihalyi a découvert : les personnes en flow rapportent une <strong>satisfaction subjective maximale</strong> — plus que pendant leurs vacances ou leurs loisirs. La concentration profonde n\'est pas une contrainte. C\'est l\'expérience humaine la plus riche.'
        );

        $ex1 = $this->exercice($gold, '①', 'L\'Audit du Temps — 7 jours de réalité brute',
            'La plupart des gens ont une image très imprécise de comment ils passent vraiment leur temps.<br><br>
            Pendant 7 jours, notez chaque activité dans des blocs de 30 minutes. Utilisez 4 couleurs :<br>
            🟢 <strong>Deep Work</strong> — concentration complète, objectif clair, zéro distraction<br>
            🟡 <strong>Shallow Work</strong> — emails, réunions, tâches administratives<br>
            🔴 <strong>Distraction</strong> — réseaux, scroll, procrastination<br>
            🔵 <strong>Récupération</strong> — pause consciente, sport, repas, sommeil<br><br>
            A la fin des 7 jours : <strong>calculez le % de chaque catégorie.</strong><br>
            La plupart des knowledge workers découvrent avec stupéfaction qu\'ils font moins d\'1h de Deep Work réel par jour — même en "travaillant" 8-10 heures.<br><br>
            <em>Cette mesure seule transforme souvent le rapport au temps — sans aucune technique supplémentaire.</em>', true
        );

        $ex2 = $this->exercice($purple, '②', 'Time Blocking — l\'architecture des journées (Newport)',
            'Le Time Blocking est la technique centrale de Newport. Principes :<br><br>
            <strong>① Désigner les blocs Deep Work</strong><br>
            Réservez 2-3 blocs de 90 minutes par semaine uniquement pour le travail profond. Mettez-les dans votre agenda comme des rendez-vous indéplaçables. Bloquez toute notification.<br><br>
            <strong>② Appliquer des timeboxes (Parkinson inversé)</strong><br>
            Pour chaque tâche de la journée, estimez le temps, puis fixez-vous <strong>75% de ce temps</strong> comme contrainte. Ex : "je pense que ça prend 2h → je me donne 90 min."<br><br>
            <strong>③ Rituel d\'ouverture</strong> (5 min avant chaque bloc Deep Work)<br>
            · Poser son intention : "Aujourd\'hui dans ce bloc, je produis ___"<br>
            · 3 cycles de Pause Souffle 5-5-5<br>
            · Notifications coupées. Téléphone retourné. Porte fermée si possible.<br><br>
            <strong>④ Rituel de clôture</strong> (5 min à la fin de chaque journée)<br>
            Newport appelle ça le <em>shutdown ritual</em> : noter les tâches non terminées sur un système de confiance, puis dire à voix haute : "La journée est terminée." Le cerveau arrête de ruminer.'
        );

        $ex3 = $this->exercice($indigo, '③', 'La Semaine Idéale — architecture du temps (Newport × Barker)',
            'Une semaine non planifiée appartient à l\'urgence des autres. Une semaine planifiée appartient à ce qui compte.<br><br>
            <strong>Étape 1 — Identifier vos 3 "blocs souverains" (10 min)</strong><br>
            Ce sont vos 3 rendez-vous les plus importants de la semaine — ceux qui, si vous les honorez systématiquement, font avancer ce qui compte profondément.<br>
            Exemples : écriture créative · projet de vie · formation · activité physique · relation de couple · lecture approfondie.<br>
            Ce ne sont pas des tâches urgentes. Ce sont les tâches importantes-mais-non-urgentes du Quadrant II d\'Eisenhower — celles que tout le monde reconnaît comme essentielles, et que personne ne fait vraiment.<br><br>
            <strong>Étape 2 — Le template hebdomadaire (20 min, dimanche soir)</strong><br>
            Sur une feuille ou un agenda numérique, dessinez votre semaine 7 colonnes × 16 heures (7h–23h).<br>
            Bloquez dans cet ordre :<br>
            🔵 <strong>Blocs souverains</strong> — vos 3 rendez-vous sacrés, minimum 90 min chacun, inviolables<br>
            🟢 <strong>Récupération</strong> — sport, repas sans écran, promenade, sommeil<br>
            🟡 <strong>Shallow Work</strong> — emails, messages, réunions — regroupés en blocs, jamais éparpillés<br>
            ⬜ <strong>Libre</strong> — ce qui reste appartient aux imprévus<br><br>
            <strong>Règle absolue de Newport :</strong> si un bloc souverain est interrompu, il ne "saute" pas — il se déplace dans la même semaine. Jamais annulé, toujours reporté.<br><br>
            <strong>Étape 3 — Le bilan hebdomadaire (dimanche soir, 15 min)</strong><br>
            · Mes 3 blocs souverains ont-ils été honorés ? (Oui / Partiellement / Non → pourquoi ?)<br>
            · Quelle urgence a le plus volé mon temps cette semaine ?<br>
            · Une chose à protéger différemment la semaine prochaine ?<br><br>
            <em style="color:'.$indigo.';">Eric Barker (Barking Up the Wrong Tree, 2017) : les personnes qui planifient leur semaine le dimanche soir sont 4,2× plus susceptibles d\'accomplir leurs priorités profondes sur 3 mois. Le simple acte de planifier — même imparfaitement — active le cortex préfrontal et réduit la réactivité aux urgences de 35%.</em>'
        );

        $meditation = $this->card($teal, 'Visualisation guidée · 8 min', '🌬 Le Fil Conducteur — ancrage & intention avant la journée',
            'Cette pratique se fait le matin, <strong>avant de toucher au téléphone ou aux emails</strong>. Elle prend 8 minutes. Elle peut éviter des heures de dispersion.<br><br>
            <strong>Installez-vous.</strong> Assis(e), dos droit, pieds posés à plat sur le sol. Mains sur les genoux. Yeux fermés ou regard baissé.<br><br>
            <strong>Phase 1 — Ancrage (2 min)</strong><br>
            Sentez le poids de votre corps dans la chaise. Le contact des pieds avec le sol. Trois cycles lents : inspirez 5 temps — retenez 2 — expirez 5. Laissez chaque expiration être un relâchement complet.<br>
            Posez intérieurement la question sans attendre de réponse : <em>"Qui suis-je ce matin, en dehors des urgences ?"</em><br><br>
            <strong>Phase 2 — Visualisation de la journée idéale (3 min)</strong><br>
            Imaginez votre journée comme si elle s\'était <em>déjà passée</em> de façon optimale.<br>
            Voyez votre premier bloc de travail profond — le téléphone est hors de portée, quelque chose prend forme. Comment se sent votre corps quand vous travaillez ainsi ? Quelle est la texture de cet état de concentration ?<br>
            Voyez les transitions : un repas pris lentement, un moment sans écran, une courte marche.<br>
            Voyez le soir : vous pouvez vous dire honnêtement — <em>"Aujourd\'hui, j\'ai avancé sur ce qui compte."</em><br>
            Ce n\'est pas un fantasme. C\'est une <strong>répétition mentale</strong> — exactement comme les athlètes de haut niveau visualisent leur performance avant de la vivre.<br><br>
            <strong>Phase 3 — Les résistances dans le corps (2 min)</strong><br>
            Remarquez maintenant les tensions qui précèdent le travail profond. Où se loge la résistance ? Gorge serrée ? Poitrine comprimée ? Envie de vérifier quelque chose ?<br>
            Ne les combattez pas. Reconnaissez-les :<br>
            <em>"Je remarque la résistance. Et je choisis quand même."</em><br>
            Ces tensions sont normales. Elles précèdent tout travail important. Elles ne sont pas un signal d\'arrêt — elles sont la preuve que ce qui suit compte vraiment.<br><br>
            <strong>Phase 4 — L\'intention (1 min)</strong><br>
            Formulez intérieurement une phrase simple et précise :<br>
            <em>"Aujourd\'hui, je crée ___."</em><br>
            Pas une liste de tâches — une intention lumineuse. Quelque chose qui a une valeur intrinsèque.<br>
            Gardez cette phrase comme ancre tout au long de la journée. Quand la dispersion arrive, revenez-y.<br><br>
            <em style="color:'.$teal.';">Pham & Taylor (1999, UCLA, Journal of Personality and Social Psychology) : simuler mentalement le processus d\'accomplissement d\'une tâche — pas seulement le résultat final, mais le chemin — réduit l\'anxiété de performance de 40% et augmente le temps effectivement alloué à la tâche de 2,1× en moyenne. La visualisation du processus crée un chemin neurologique avant l\'action elle-même.</em>'
        );

        return [
            'description' => 'Cal Newport, Loi de Parkinson, Kahneman, Csikszentmihalyi — le temps ne manque pas. C\'est l\'architecture des journées qui fait la différence entre l\'agitation et la maîtrise.',
            'intro_text'  => "Vous avez le même nombre d'heures que Darwin, que Mozart, que Marie Curie.\n24h. Pas une de plus.\n\nAlors pourquoi certains construisent des œuvres remarquables\nquand d'autres finissent la journée épuisés sans avoir avancé sur ce qui compte ?\n\nLa réponse n'est pas la motivation. Ce n'est pas le talent.\nC'est l'architecture — comment le temps est organisé, protégé, habité.\n\nCe module vous donne les outils pour passer de subir votre temps à le gouverner.",
            'audio_path'  => 'formation/audio/12-maitriser-son-temps-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',  'title' => 'Leçon 1 — Deep Work & la loi de Parkinson (Newport, 2016)',          'duration' => '9 min',  'description' => 'La concentration profonde est une capacité rare qui devient précieuse. La loi de Parkinson : le travail se dilate pour remplir le temps alloué.', 'content' => $lec1],
                ['type' => 'lecture',  'title' => 'Leçon 2 — Le biais de planification & le flow (Kahneman, Csikszentmihalyi)', 'duration' => '7 min', 'description' => 'Pourquoi on sous-estime toujours la durée des tâches. Et comment le flow — l\'absorption totale — est l\'expérience humaine la plus satisfaisante.', 'content' => $lec2],
                ['type' => 'exercice', 'title' => '① L\'Audit du Temps — 7 jours de réalité brute',                     'duration' => '7 jours', 'description' => 'Colorier ses activités en Deep Work / Shallow Work / Distraction / Récupération. Révèle souvent moins d\'1h de vraie concentration par jour.', 'content' => $ex1],
                ['type' => 'exercice', 'title' => '② Time Blocking — l\'architecture des journées (Newport)',            'duration' => '20 min', 'description' => 'Désigner des blocs Deep Work, appliquer des timeboxes Parkinson, créer des rituels d\'ouverture et de clôture de journée.', 'content' => $ex2],
                ['type' => 'exercice', 'title' => '③ La Semaine Idéale — architecture du temps (Newport × Barker)',     'duration' => '45 min', 'description' => 'Identifier ses 3 blocs souverains. Template hebdomadaire en 4 couleurs. Bilan dominical. 4,2× plus d\'accomplissement des priorités profondes sur 3 mois (Barker, 2017).', 'content' => $ex3],
                ['type' => 'pratique', 'title' => '🌬 Le Fil Conducteur — visualisation guidée 8 min (matin)',          'duration' => '8 min',  'description' => 'Ancrage · visualisation de la journée idéale · neutraliser les résistances dans le corps · formuler l\'intention du jour. Pham & Taylor (UCLA) : 2,1× de temps alloué à la tâche après répétition mentale.', 'content' => $meditation, 'audio' => true],
            ],
            'activities_en' => [
                ['type' => 'lecture',  'title' => 'Lesson 1 — Deep Work & Parkinson\'s Law (Newport, 2016)',             'duration' => '9 min',  'description' => 'Deep concentration is a rare skill becoming more valuable. Parkinson\'s Law: work expands to fill the time available.'],
                ['type' => 'lecture',  'title' => 'Lesson 2 — Planning fallacy & flow (Kahneman, Csikszentmihalyi)',     'duration' => '7 min',  'description' => 'Why we always underestimate task duration. And how flow — total absorption — is the richest human experience.'],
                ['type' => 'exercice', 'title' => '① The Time Audit — 7 days of raw reality',                           'duration' => '7 days', 'description' => 'Color-code activities as Deep Work / Shallow Work / Distraction / Recovery. Reveals often less than 1h of real concentration per day.'],
                ['type' => 'exercice', 'title' => '② Time Blocking — engineering your days (Newport)',                   'duration' => '20 min', 'description' => 'Designate Deep Work blocks, apply Parkinson timeboxes, create opening and closing rituals for each workday.'],
                ['type' => 'exercice', 'title' => '③ The Ideal Week — time architecture (Newport × Barker)',             'duration' => '45 min', 'description' => 'Identify 3 sovereign blocks. 4-color weekly template. Sunday debrief. 4.2× more deep priority completion over 3 months (Barker, 2017).'],
                ['type' => 'pratique', 'title' => '🌬 The Guiding Thread — 8-min morning visualization',                'duration' => '8 min',  'description' => 'Anchoring · ideal day visualization · neutralize body resistance · set day\'s intention. Pham & Taylor (UCLA): 2.1× task time after mental rehearsal.'],
            ],
        ];
    }

    private function m10c_gerer_finances(): array   // P2 — M13 nouveau
    {
        $gold   = 'rgba(201,168,76,.9)';
        $green  = 'rgba(34,197,94,.8)';
        $blue   = 'rgba(59,130,246,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $teal   = 'rgba(20,184,166,.8)';

        $lec1 = $this->card($purple, 'Brad Klontz · 2011', 'Mind Over Money — l\'argent comme héritage émotionnel',
            'Le psychologue financier Brad Klontz (Creighton University) a introduit le concept de <strong>Money Scripts</strong> — les croyances inconscientes sur l\'argent héritées de la famille et de la culture, opérant en pilote automatique.<br><br>
            Les 4 scripts financiers pathologiques :<br><br>
            <strong>① Money Avoidance</strong> — "L\'argent est mauvais. Les riches sont corrompus. Je ne mérite pas d\'en avoir." Origine souvent : famille pauvre + morale religieuse.<br>
            <strong>② Money Worship</strong> — "Plus d\'argent = plus de bonheur. Le problème se résoudra quand j\'en aurai davantage." Résultat : addiction à l\'accumulation sans satisfaction.<br>
            <strong>③ Money Status</strong> — "Ma valeur = ce que je dépense / ce que je possède." Dépenses ostentatoires pour acheter l\'estime sociale.<br>
            <strong>④ Money Vigilance</strong> — "L\'argent peut disparaître. Il faut tout garder." Anxiété chronique, incapacité à jouir, méfiance de tout.<br><br>
            <em style="color:'.$purple.';">Klontz (2011) : 90% des comportements financiers problématiques sont directement traçables à un de ces 4 scripts — et sont modifiables en quelques semaines de travail conscient.</em>'
        ).$this->card($blue, 'Dan Ariely · 2008', 'Predictably Irrational — pourquoi nos décisions financières sont systématiquement irrationnelles',
            'L\'économiste comportemental Dan Ariely (Duke, MIT) a documenté les biais qui sabotent nos décisions financières :<br><br>
            <strong>① L\'effet d\'ancrage</strong> : le premier chiffre vu oriente toutes les décisions suivantes. Ex : voir "5 000€" en premier rend 2 500€ attractif — même si c\'est trop cher.<br>
            <strong>② La douleur du paiement</strong> : payer en cash active les zones de douleur du cerveau ; payer par carte ne les active pas. Les cartes de crédit = anesthésie de la douleur financière.<br>
            <strong>③ L\'argent caché</strong> : les abonnements récurrents (Netflix, Spotify × 15) sont quasi-invisibles au cerveau. L\'addition mensuelle est souvent 2-3× l\'estimation spontanée.<br>
            <strong>④ L\'hyperbolic discounting</strong> : 100€ maintenant vaut plus que 120€ dans un mois — même si c\'est mathématiquement absurde. Notre cerveau dévalue le futur de façon prévisible.<br><br>
            <em style="color:'.$blue.';">La solution n\'est pas la volonté — c\'est la conception de systèmes qui contournent ces biais automatiquement.</em>'
        );

        $lec2 = $this->card($gold, 'Ramit Sethi · 2009 / Thaler & Sunstein · 2008', 'L\'automatisation financière — ne plus avoir à y penser',
            'Ramit Sethi (I Will Teach You to Be Rich, 2009) et Thaler & Sunstein (Nudge, 2008) convergent vers la même solution :<br><br>
            <em style="color:'.$gold.';">"Ne comptez pas sur la volonté. Automatisez. Les décisions prises une fois valent infiniment plus que les décisions répétées quotidiennement."</em><br><br>
            Le système en 3 comptes de Sethi :<br>
            <strong>① Compte Sécurité</strong> — virements automatiques pour loyer, charges, épargne de précaution (6 mois de charges idéalement).<br>
            <strong>② Compte Projet</strong> — virement automatique mensuel vers un objectif spécifique (retraite, projet, enfants).<br>
            <strong>③ Compte Plaisir</strong> — le reste est à dépenser sans culpabilité ni calcul.<br><br>
            La règle de base : <strong>tout automatiser dans les 24h après réception du salaire</strong>. Ce qui arrive sur le compte principal n\'est plus "l\'argent à gérer" — c\'est uniquement l\'argent de vie courante.<br><br>
            <em style="color:'.$gold.';">Thaler (Nobel 2017) : le simple fait de définir une règle de virement automatique augmente l\'épargne de 300% sur 10 ans par rapport à l\'épargne volontaire.</em>'
        );

        $ex1 = $this->exercice($purple, '①', 'L\'Audit des Croyances Financières (Klontz)',
            'Répondez sans réfléchir (première réaction) :<br><br>
            <strong>Section A — Ce que vous avez entendu sur l\'argent en grandissant</strong><br>
            · "L\'argent c\'est…" (3 mots spontanés)<br>
            · "Les gens riches sont…"<br>
            · "Dans ma famille, l\'argent signifiait…"<br>
            · "Ma mère / mon père parlait de l\'argent en disant…"<br><br>
            <strong>Section B — Vos comportements actuels</strong><br>
            · Je dépense plus que prévu quand je suis : (fatigué / stressé / heureux / ennuyé…)<br>
            · Quand je pense à mes finances, je ressens : ___<br>
            · Ma plus grande peur financière : ___<br>
            · Ma relation à l\'argent ressemble à : ___<br><br>
            <strong>Après avoir répondu</strong> : identifiez votre script dominant (Avoidance, Worship, Status, Vigilance) et les deux événements familiaux qui l\'ont installé.<br><br>
            <em>Klontz : cette seule prise de conscience réduit les comportements automatiques de 60% dès les 30 premiers jours.</em>'
        );

        $ex2 = $this->exercice($green, '②', 'Les 3 Comptes — automatiser en 2h (Sethi)',
            'Exercice d\'implémentation concrète. Durée réelle : 90 à 120 minutes.<br><br>
            <strong>Étape 1 — Le snapshot (30 min)</strong><br>
            Listez TOUS vos revenus et ALL vos débits récurrents des 3 derniers mois. Total mensuel réel.<br><br>
            <strong>Étape 2 — Créer les 3 comptes (si pas encore fait)</strong><br>
            Dans votre banque ou une banque en ligne (Boursorama, N26, Revolut…) :<br>
            · Compte principal (courant)<br>
            · Compte Projet (livret ou compte épargne)<br>
            · Compte Plaisir (même si c\'est symbolique, 50€/mois)<br><br>
            <strong>Étape 3 — Programmer les virements automatiques (40 min)</strong><br>
            Le 5 de chaque mois (J+5 après salaire) :<br>
            · 10-20% → Compte Projet<br>
            · 5-10% → Compte Plaisir<br>
            · Tout le reste reste sur le compte courant pour les dépenses de vie<br><br>
            <em>Une fois ce système en place, vous ne prenez plus de décision financière quotidienne. La sécurité se construit seule.</em>'
        );

        $ecrit = $this->exercice($gold, '③', 'La Lettre de Réconciliation avec l\'Argent',
            'Cet exercice s\'inspire à la fois de la logothérapie de Frankl et de l\'écriture expressive de Pennebaker (UT Austin).<br><br>
            Écrivez une lettre à l\'argent. Oui — directement à l\'argent comme s\'il était une personne.<br><br>
            <strong>Structure :</strong><br>
            · "Voici ce que j\'ai cru que tu étais pendant des années…" (4 lignes)<br>
            · "Voici comment j\'ai agi à cause de cette croyance…" (4 lignes)<br>
            · "Voici ce que j\'ai appris de toi…" (4 lignes)<br>
            · "Voici ce que je veux que notre relation devienne…" (4 lignes)<br><br>
            <em>Cet exercice externalise la relation à l\'argent — elle passe de l\'inconscient au conscient, où elle peut être modifiée. Les praticiens en psychologie financière reportent des transformations comportementales significatives dans les 30 jours suivants.</em>'
        );

        $ex4 = $this->exercice($teal, '④', 'Le Budget des Valeurs — l\'argent réel vs l\'argent souhaité (George Kinder)',
            'George Kinder (Kinder Institute of Life Planning, Harvard) a développé une approche simple et dévastatrice : <strong>regarder où va vraiment l\'argent, et demander à quelle valeur profonde chaque dépense correspond</strong>.<br><br>
            La plupart des gens pensent savoir comment ils dépensent. Ils ont tort — de 30 à 50%.<br><br>
            <strong>Étape 1 — Relevé complet (20 min)</strong><br>
            Téléchargez ou imprimez vos relevés bancaires des 3 derniers mois. Listez chaque dépense récurrente ou significative (pas les cafés — les postes de 50€+ par mois).<br><br>
            <strong>Étape 2 — Classer chaque dépense dans une catégorie (30 min)</strong><br>
            😊 <strong>Joie</strong> — cette dépense me vivifie vraiment, elle correspond à ce que je valorise profondément<br>
            🔁 <strong>Habitude</strong> — je paie sans y penser, je ne suis même plus sûr(e) que j\'en aie besoin<br>
            😰 <strong>Peur</strong> — j\'achète pour ne pas ressentir quelque chose (ennui, solitude, stress, vide)<br>
            👥 <strong>Social</strong> — j\'achète pour appartenir, pour correspondre à une image, pour être vu(e) d\'une certaine façon<br><br>
            <strong>Étape 3 — Analyse des résultats (15 min)</strong><br>
            · Quel pourcentage de vos dépenses appartient à chaque catégorie ?<br>
            · Quelle catégorie vous surprend le plus ?<br>
            · Quel poste classé "Habitude" ou "Peur" pourriez-vous supprimer sans que votre vie en soit diminuée ?<br><br>
            <strong>Étape 4 — Une décision concrète</strong><br>
            Identifiez une dépense à éliminer ou réduire (catégorie Habitude ou Peur) et une dépense à augmenter (catégorie Joie vraie). Modifiez votre système des 3 comptes en conséquence.<br><br>
            <em style="color:'.$teal.';">Kinder : la plupart de ses clients découvrent qu\'ils dépensent entre 15% et 30% de leur revenu dans la catégorie "Peur" — des achats conçus pour neutraliser une anxiété intérieure, sans jamais la résoudre. Cette seule prise de conscience libère en moyenne 200 à 600€/mois sans aucune privation ressentie.</em>'
        );

        $meditation = $this->card($blue, 'Pratique somatique · 8 min', '🌬 La Sécurité Intérieure — méditation sur la relation à l\'argent',
            'Cette pratique travaille là où les budgets ne vont jamais : dans le corps. Les croyances financières sont stockées somatiquement — elles ont une texture, une localisation, une sensation précise. Les changer passe par les ressentir.<br><br>
            <strong>Installez-vous.</strong> Assis(e), dos droit, pieds au sol, mains sur les genoux. Fermez les yeux.<br><br>
            <strong>Phase 1 — Ancrage dans le présent (2 min)</strong><br>
            Trois respirations longues et complètes : inspirez 5 temps, retenez 2, expirez 7. L\'expiration est particulièrement longue pour activer le système nerveux parasympathique — le calme.<br>
            Sentez votre corps dans cet instant. Vous êtes en sécurité. Vous avez un toit. Vous respirez.<br><br>
            <strong>Phase 2 — Inviter la question dans le corps (3 min)</strong><br>
            Sans chercher à répondre avec votre tête, posez intérieurement la question :<br>
            <em>"Que se passe-t-il dans mon corps quand je pense à l\'argent ?"</em><br>
            Ne répondez pas avec des mots. Cherchez les sensations :<br>
            · Y a-t-il une contraction quelque part ? Gorge, poitrine, ventre, estomac ?<br>
            · Y a-t-il une sensation de vide ? De peur ? D\'urgence ?<br>
            · Y a-t-il une forme de honte, de mérite, de colère ?<br>
            Restez avec ces sensations. Ne les jugez pas. Ne les résolvez pas. <em>Observez simplement.</em><br><br>
            <strong>Phase 3 — Trouver l\'endroit de sécurité (2 min)</strong><br>
            Maintenant, cherchez dans votre corps un endroit qui se sent stable, neutre, en sécurité — malgré tout.<br>
            Ce peut être les pieds au sol. Les mains. Le dos contre la chaise. Un point de chaleur dans la poitrine.<br>
            Posez votre attention là. Amplifiez cette sensation. Elle est réelle. Elle est en vous, maintenant, indépendamment de votre solde bancaire.<br>
            C\'est la sécurité intérieure — celle que vous avez peut-être cherchée à l\'extérieur toute votre vie.<br><br>
            <strong>Phase 4 — L\'intention (1 min)</strong><br>
            Formulez intérieurement, depuis cet endroit de stabilité :<br>
            <em>"La sécurité que je cherche dans l\'argent existe déjà en moi. L\'argent est un outil — pas une preuve."</em><br>
            Restez avec cette phrase jusqu\'à ce qu\'elle se dépose dans votre corps plutôt que dans votre tête.<br><br>
            <em style="color:'.$blue.';">Bessel van der Kolk (The Body Keeps the Score, 2014) : les croyances de menace — y compris financières — sont stockées dans l\'amygdale sous forme de patterns somatiques, pas de concepts intellectuels. Seule une pratique corporelle répétée peut les déplacer durablement. Cette méditation, pratiquée 3× par semaine pendant un mois, reconfigure la réponse émotionnelle à la gestion d\'argent.</em>'
        );

        return [
            'description' => 'Brad Klontz, Dan Ariely, Ramit Sethi — nos comportements financiers sont des héritages émotionnels déguisés en décisions rationnelles. Identifier ses scripts, automatiser la sécurité, réconcilier sa relation à l\'argent.',
            'intro_text'  => "L'argent n'est pas un problème mathématique.\nC'est un problème psychologique.\n\nLa plupart des gens qui n'arrivent pas à épargner ne manquent pas de revenu —\nils portent des croyances héritées qui sabotent chaque décision financière,\nsouvent sans le savoir.\n\nCe module ne vous apprend pas à « faire des économies ».\nIl vous apprend à comprendre votre relation à l'argent, à automatiser la sécurité,\net à libérer l'espace mental que les finances occupaient pour construire autre chose.",
            'audio_path'  => 'formation/audio/13-gerer-ses-finances-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',  'title' => 'Leçon 1 — Les Money Scripts & les biais financiers (Klontz, Ariely)', 'duration' => '9 min',  'description' => '4 scripts inconscients hérités (Klontz). Les 4 biais qui sabotent les décisions (Ariely). 90% des problèmes financiers viennent de là — pas du revenu.', 'content' => $lec1],
                ['type' => 'lecture',  'title' => 'Leçon 2 — L\'automatisation financière : ne plus décider (Sethi, Thaler)', 'duration' => '6 min', 'description' => 'Le système 3 comptes de Sethi. Les virements automatiques augmentent l\'épargne de 300% sur 10 ans (Thaler, Nobel 2017). La volonté n\'est pas une stratégie.', 'content' => $lec2],
                ['type' => 'exercice', 'title' => '① L\'Audit des Croyances Financières (Klontz)',                        'duration' => '20 min', 'description' => 'Identifier son Money Script dominant (Avoidance / Worship / Status / Vigilance) et les deux événements familiaux qui l\'ont programmé.', 'content' => $ex1],
                ['type' => 'exercice', 'title' => '② Les 3 Comptes — automatiser en 2h (Sethi)',                          'duration' => '2 h',   'description' => 'Snapshot financier complet → créer 3 comptes → programmer les virements automatiques. Une configuration, des bénéfices permanents.', 'content' => $ex2],
                ['type' => 'ecriture', 'title' => '③ La Lettre de Réconciliation avec l\'Argent (Klontz × Pennebaker)',   'duration' => '20 min', 'description' => 'Écrire une lettre à l\'argent : ce que j\'ai cru, comment j\'ai agi, ce que j\'ai appris, ce que je veux. Externalise la relation inconsciente.', 'content' => $ecrit],
                ['type' => 'exercice', 'title' => '④ Le Budget des Valeurs — argent réel vs argent souhaité (Kinder)',    'duration' => '45 min', 'description' => 'Classer chaque dépense en Joie / Habitude / Peur / Social. Kinder : 15-30% du revenu dépensé en catégorie "Peur". Identifier ce à supprimer et ce à amplifier.', 'content' => $ex4],
                ['type' => 'pratique', 'title' => '🌬 La Sécurité Intérieure — méditation somatique 8 min',               'duration' => '8 min',  'description' => 'Localiser les croyances financières dans le corps · trouver l\'endroit de sécurité intérieure · ancrer : "La sécurité existe déjà en moi." Van der Kolk : reconfiguration somatique des patterns de peur.', 'content' => $meditation, 'audio' => true],
            ],
            'activities_en' => [
                ['type' => 'lecture',  'title' => 'Lesson 1 — Money Scripts & financial biases (Klontz, Ariely)',         'duration' => '9 min',  'description' => '4 inherited unconscious scripts (Klontz). 4 biases that sabotage decisions (Ariely). 90% of financial problems come from these — not income.'],
                ['type' => 'lecture',  'title' => 'Lesson 2 — Financial automation: stop deciding (Sethi, Thaler)',       'duration' => '6 min',  'description' => 'Sethi\'s 3-account system. Automatic transfers 3× savings over 10 years (Thaler, Nobel 2017). Willpower is not a strategy.'],
                ['type' => 'exercice', 'title' => '① The Money Script Audit (Klontz)',                                    'duration' => '20 min', 'description' => 'Identify your dominant Money Script (Avoidance / Worship / Status / Vigilance) and the two family events that programmed it.'],
                ['type' => 'exercice', 'title' => '② The 3-Account System — automate in 2h (Sethi)',                     'duration' => '2 h',   'description' => 'Full financial snapshot → create 3 accounts → set automatic transfers. One configuration, permanent benefits.'],
                ['type' => 'ecriture', 'title' => '③ The Reconciliation Letter to Money (Klontz × Pennebaker)',           'duration' => '20 min', 'description' => 'Write a letter to money: what I believed, how I acted, what I learned, what I want. Externalizes the unconscious relationship.'],
                ['type' => 'exercice', 'title' => '④ The Values Budget — real money vs desired money (Kinder)',           'duration' => '45 min', 'description' => 'Classify each expense as Joy / Habit / Fear / Social. Kinder: 15-30% of income spent in "Fear" category. Identify what to remove and amplify.'],
                ['type' => 'pratique', 'title' => '🌬 Inner Security — somatic meditation 8 min',                         'duration' => '8 min',  'description' => 'Locate financial beliefs in the body · find the inner security anchor · embody: "Security already exists within me." Van der Kolk: somatic reconfiguration of fear patterns.'],
            ],
        ];
    }

    private function m27_solitude_choisie(): array   // P3 — M27 — VERSION ENRICHIE
    {
        $teal   = 'rgba(20,184,166,.8)';
        $indigo = 'rgba(99,102,241,.85)';
        $gold   = 'rgba(201,168,76,.9)';
        $blue   = 'rgba(59,130,246,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $green  = 'rgba(34,197,94,.8)';

        /* ── LEÇON 1 ── Buchholz + Winnicott + Storr ─────────────── */
        $lec1 = $this->card($teal, 'D.W. Winnicott · 1958 & Ester Buchholz · 1997', 'La capacité d\'être seul — fondation de la maturité psychologique',
            'En 1958, le pédiatre et psychanalyste britannique D.W. Winnicott présente devant la British Psychoanalytical Society un essai qui va remodeler la théorie du développement :<br><br>
            <em style="color:'.$teal.';">"La capacité à être seul est l\'un des signes les plus importants de la maturité du développement émotionnel. Elle suppose qu\'un individu s\'est suffisamment construit pour ne pas avoir besoin d\'un autre pour exister."</em><br><br>
            Paradoxe de Winnicott : cette capacité à être seul se développe toujours <strong>en présence de quelqu\'un d\'autre</strong> — l\'enfant apprend à être seul parce qu\'il a la certitude interne que l\'adulte est là s\'il en a besoin. C\'est l\'intériorisation de la présence aimante qui rend la solitude possible.<br><br>
            <strong>Implications pour l\'adulte :</strong> si la solitude génère systématiquement de l\'anxiété, de l\'agitation ou une compulsion de remplissage, c\'est souvent le signal que cette capacité n\'a pas pu se construire — et qu\'elle peut encore s\'apprendre.<br><br>
            <strong>Ester Buchholz (NYU, 1997) — The Call of Solitude</strong> :<br>
            Buchholz documente ce que Winnicott pressentait : la solitude n\'est pas une absence de lien — c\'est un <em>besoin biologique alternatif</em> au lien, aussi fondamental que lui. Elle montre que les sociétés occidentales hyperconnectées ont <strong>pathologisé la solitude</strong> — la transformant de ressource en symptôme.<br><br>
            Sa conclusion radicale : <em style="color:'.$teal.';">nous avons appris à nous méfier de notre propre compagnie. Désapprendre cette méfiance est l\'un des actes thérapeutiques les plus profonds qui soit.</em>'
        ).$this->card($indigo, 'Anthony Storr · 1988', 'Solitude : A Return to the Self — l\'intégration se fait seul',
            'Le psychiatre britannique Anthony Storr (Oxford) a passé des années à analyser les biographies de créateurs extraordinaires — Newton, Kafka, Wittgenstein, Descartes, Beethoven, Kierkegaard.<br><br>
            Sa découverte centrale, formulée avec soin :<br>
            <em style="color:'.$indigo.';">"Ce n\'est pas dans la relation interpersonnelle que réside le bonheur le plus profond, mais dans la relation avec soi-même, avec ses travaux, avec ses idées. La plupart des thérapies survaluent l\'importance de la relation humaine et sous-valuent l\'importance de la solitude."</em><br><br>
            <strong>Exemples documentés :</strong><br>
            · Newton développe le calcul infinitésimal, la loi de la gravitation et l\'optique pendant 18 mois de retraite forcée (épidémie de peste, 1665). Son collègue le plus proche ne le voit pas une seule fois pendant cette période.<br>
            · Descartes consacre ses matinées entières, couché, à une méditation solitaire. Il ne commence à travailler que l\'après-midi.<br>
            · Beethoven refuse toute compagnie pendant ses périodes de composition. Ses cahiers de conversation montrent qu\'il se parlait à lui-même comme à un interlocuteur.<br><br>
            <strong>Ce que Storr tire de ces biographies :</strong><br>
            La solitude n\'est pas le signe d\'un problème relationnel. C\'est souvent le <em>signe d\'une richesse intérieure</em> — et la condition de son développement.<br><br>
            <em style="color:'.$indigo.';">"La capacité à être seul et à apprécier la solitude est une ressource précieuse. Ceux qui l\'ont développée ont toujours quelqu\'un dont ils peuvent profiter de la compagnie : eux-mêmes."</em>'
        );

        /* ── LEÇON 2 ── Csikszentmihalyi + Dunbar + Rilke ──────────── */
        $lec2 = $this->card($gold, 'Csikszentmihalyi · 1990 & Adam Grant · 2021', 'Le paradoxe du flow solitaire — on est plus heureux seul qu\'en groupe',
            'Dans son étude fondatrice sur le flow, Csikszentmihalyi (Université de Chicago) a équipé 250 adolescents et adultes de bippers aléatoires pendant plusieurs semaines. À chaque signal, les participants notaient ce qu\'ils faisaient <em>et</em> comment ils se sentaient.<br><br>
            Le résultat a stupéfié son équipe :<br>
            <em style="color:'.$gold.';">"Les états de flow — immersion totale, sentiment d\'efficacité, satisfaction profonde — survenaient bien davantage pendant les activités solitaires (lire, écrire, jardiner, bricoler, marcher seul) que pendant les activités sociales."</em><br><br>
            Pourtant, interrogés sur <em>ce qu\'ils préféraient faire</em>, les mêmes participants choisissaient presque toujours une activité sociale.<br><br>
            <strong>La dissociation entre préférence déclarée et satisfaction réelle</strong> : nous voulons la compagnie mais nous nous épanouissons davantage dans la solitude active. Nous confondons le soulagement de l\'inconfort de la solitude avec la satisfaction — et nous appelons ça "profiter de la vie sociale".<br><br>
            <strong>Adam Grant (Wharton, Think Again, 2021)</strong> y ajoute une dimension : les "penseurs originaux" — ceux qui changent de domaine, innovent, remettent en question les consensus — passent en moyenne <strong>40% plus de temps seuls</strong> que leurs pairs moins innovants. Non par introversion, mais par choix délibéré de temps de réflexion non structurée.<br><br>
            <em style="color:'.$gold.';">La solitude choisie n\'est pas une fuite de la vie sociale. C\'est le lieu où la vie intérieure se construit — sans laquelle la vie sociale reste un spectacle que l\'on joue pour les autres.</em>'
        ).$this->card($blue, 'Robin Dunbar · 1992 & Rainer Maria Rilke · 1929', 'L\'économie d\'attention et la lettre au jeune poète',
            '<strong>Robin Dunbar — Le nombre 150 (Oxford, 1992)</strong><br>
            L\'anthropologue Dunbar a démontré, en comparant la taille du néocortex de 38 espèces de primates avec la taille de leurs groupes sociaux, que le cerveau humain peut maintenir des liens sociaux <em>signifiants</em> avec un maximum de 150 personnes.<br><br>
            Structure interne :<br>
            · 5 personnes très intimes (cercle de confiance absolue, ~40% du temps social)<br>
            · 15 amis proches (confiance élevée, ~20% du temps social)<br>
            · 50 contacts réguliers et connus<br>
            · 150 relations sociales stables<br><br>
            <strong>Conséquence directe pour l\'ère des réseaux :</strong> chaque connexion maintenue activement au-delà de 150 dilue la qualité des connexions existantes. L\'hyperconnexion n\'élargit pas la richesse relationnelle — elle la dilue. La solitude choisie est une <em>hygiène de l\'attention</em>.<br><br>
            <strong>Rilke — Lettres à un jeune poète (1929, lettre n°1)</strong><br>
            <em style="color:'.$blue.';">"Je voudrais vous prier, cher ami, autant que je puisse, d\'être patient envers tout ce qui est non résolu dans votre cœur, et d\'essayer d\'aimer les questions elles-mêmes… Vivez maintenant les questions. Peut-être alors, un jour dans un futur lointain, entrerez-vous progressivement dans les réponses, sans même le remarquer."</em><br><br>
            Ce que Rilke pressent avant les neurosciences : les réponses les plus importantes à notre vie ne se trouvent pas dans le bruit, l\'urgence ou la conversation — mais dans la patience de la solitude avec soi-même.'
        );

        /* ── EXERCICE 1 ── La Cartographie de la Fuite ─────────────── */
        $ex1 = $this->exercice($gold, '①', 'La Cartographie de la Fuite — que faites-vous quand vous êtes seul(e) ?',
            'Avant de pratiquer la solitude, il faut comprendre comment vous la fuyez. Cet exercice est une cartographie honnête de vos patterns de fuite.<br><br>
            <strong>PARTIE A — Inventaire des fuites automatiques (15 min)</strong><br><br>
            Listez tous les comportements que vous déclenchez dès que la solitude arrive — souvent sans même vous en rendre compte :<br><br>
            <strong>Fuites numériques</strong> : téléphone (quelle app en premier ?), TV, musique de fond, podcast, radio, scroll<br>
            <strong>Fuites sociales</strong> : appeler quelqu\'un, envoyer un message, chercher compagnie<br>
            <strong>Fuites de remplissage</strong> : manger sans faim, faire le ménage, ranger ce qui n\'en avait pas besoin, se donner une tâche immédiatement<br>
            <strong>Fuites mentales</strong> : planer dans le futur (planifier, projeter), ruminer le passé, imaginer des scénarios<br>
            <strong>Fuites de "productivité"</strong> : travailler alors qu\'on n\'est pas au bureau, répondre à des emails non urgents<br><br>
            Pour chaque fuite identifiée :<br>
            · Fréquence (combien de fois par semaine ?)<br>
            · Déclencheur (quand exactement — quel vide, quelle sensation précède la fuite ?)<br>
            · Durée (combien de temps absorbée par cette fuite en moyenne ?)<br><br>
            <strong>PARTIE B — L\'inconfort sous la fuite (10 min)</strong><br><br>
            Pour vos 3 fuites les plus fréquentes, posez la question :<br>
            <em>"Quelle sensation exactement est-ce que j\'évite en me réfugiant là ?"</em><br><br>
            Les réponses fréquentes : vide / ennui / quelque chose que je ne sais pas comment nommer / la peur que mes pensées me rattrapent / l\'impression de ne rien valoir si je ne fais rien / la peur de ce qui pourrait émerger si je me taisais vraiment<br><br>
            Notez sans juger. Ce que vous fuyez est précisément ce que la solitude choisie va vous permettre d\'apprivoiser.<br><br>
            <em style="color:'.$gold.';">Sherry Turkle (MIT, Alone Together, 2011) : dans ses études sur 300 adolescents et adultes, la résistance à la solitude n\'est presque jamais une préférence pour les autres — c\'est une fuite de soi. "Nous utilisons la connexion pour protéger nos solitudes."</em>', true
        );

        /* ── EXERCICE 2 ── La Retraite Quotidienne 21 jours ──────────── */
        $ex2 = $this->exercice($teal, '②', 'La Retraite Quotidienne — protocole 21 jours (Buchholz × Csikszentmihalyi)',
            'La solitude choisie est une compétence. Comme toute compétence, elle s\'installe par la pratique régulière avant de devenir naturelle. 21 jours est le minimum pour ancrer l\'habitude.<br><br>
            <strong>CONDITIONS NON NÉGOCIABLES :</strong><br>
            · Même heure chaque jour (idéalement matin ou début de soirée)<br>
            · Téléphone en mode avion <em>et hors de portée visuelle</em> (pas sur la table, pas dans la pièce)<br>
            · Aucun média de background — pas de musique, pas de podcast, pas de télé en fond<br>
            · Aucune tâche productive — ce n\'est pas une session de réflexion planifiée<br>
            · Un espace fixe si possible (le cerveau associe le lieu à l\'état)<br><br>
            <strong>DURÉE ET PROGRESSION :</strong><br>
            Jours 1-7 : 10 minutes. Inconfort probable et normal. Résistez à l\'envie de remplir.<br>
            Jours 8-14 : 15 minutes. L\'inconfort diminue ou se transforme.<br>
            Jours 15-21 : 20-25 minutes. L\'espace commence à avoir une "saveur".<br><br>
            <strong>STRUCTURE INTERNE (les 3 phases) :</strong><br><br>
            <strong>Phase 1 — Atterrissage (3-5 minutes)</strong><br>
            Asseyez-vous. Remarquez où vous êtes physiquement. 3 expirations lentes.<br>
            Observez le mouvement naturel qui veut faire quelque chose — l\'agitation, l\'envie de checker, l\'urgence de "profiter du temps".<br>
            Ne le combattez pas. Notez-le intérieurement : <em>"Je remarque l\'envie de…"</em> Puis laissez-la passer sans lui obéir.<br><br>
            <strong>Phase 2 — Présence ouverte (le cœur de la pratique)</strong><br>
            Aucune instruction particulière. Votre esprit peut aller où il veut.<br>
            Des pensées créatives peuvent émerger — laissez-les venir. Des émotions peuvent apparaître — accueillez-les sans les analyser.<br>
            Si rien ne vient : c\'est aussi une information. La neutralité a sa propre texture.<br>
            Votre seul rôle : rester là. Ne pas fuir.<br><br>
            <strong>Phase 3 — Recueil (2-3 minutes)</strong><br>
            Avant de fermer la session : notez en 2-3 mots ce qui a émergé. Pas d\'analyse — juste un marqueur.<br>
            Ce marqueur, cumulé sur 21 jours, devient un journal de votre vie intérieure.<br><br>
            <em style="color:'.$teal.';">Après 7 jours de pratique, 80% des participants de l\'étude ESM de Csikszentmihalyi reportent au moins un insight significatif apparu pendant ces moments — qu\'ils n\'auraient pas eu dans l\'agitation. Après 21 jours, le rapport à la solitude est structurellement modifié pour une majorité.</em>'
        );

        /* ── EXERCICE 3 ── Journal de Solitude enrichi ────────────── */
        $ex3 = $this->exercice($indigo, '③', 'Le Journal de Solitude — 7 questions, 7 jours, 7 vérités',
            'Chaque soir de la semaine de pratique, prenez 5 minutes. Ces 7 questions vous révèleront votre relation réelle à la solitude — bien au-delà de ce que vous en pensez a priori.<br><br>
            <strong>Q1 — Ai-je eu un moment de vraie solitude aujourd\'hui ?</strong><br>
            (définition : seul(e), sans écran, sans tâche, sans musique — juste moi avec moi)<br>
            OUI / NON. Si oui : heure, durée, lieu.<br><br>
            <strong>Q2 — Comment s\'est passé cet espace ?</strong><br>
            Choisissez parmi : Anxieux · Agité · Neutre · Calme · Surprenant · Créatif · Vide (et précisez)<br><br>
            <strong>Q3 — Quelle a été ma première fuite du jour ?</strong><br>
            (la première chose que j\'ai faite pour éviter l\'espace vide) — à quelle heure ? vers quoi ?<br><br>
            <strong>Q4 — Une pensée ou image est-elle apparue spontanément pendant un moment de calme ?</strong><br>
            (notez-la, même si elle semble banale — même si c\'est une simple image, un souvenir, un désir)<br><br>
            <strong>Q5 — Y a-t-il quelque chose que j\'ai besoin de me dire et que l\'agitation du quotidien m\'empêche d\'entendre ?</strong><br>
            (laissez venir — ne filtrez pas — c\'est souvent là que les vraies réponses attendent)<br><br>
            <strong>Q6 — Ai-je été en compagnie de moi-même aujourd\'hui, ou en fuite de moi-même ?</strong><br>
            Pas de jugement. Juste une observation honnête.<br><br>
            <strong>Q7 — Qu\'est-ce que j\'ai envie de moins fuir demain ?</strong><br><br>
            <strong>Bilan après 7 jours :</strong><br>
            · Quel jour ai-je eu le plus de solitude vraie ?<br>
            · Quelle fuite est apparue le plus souvent ?<br>
            · Quelle était la question 5 la plus récurrente — que me dit-elle ?<br>
            · Est-ce que ma relation à la solitude a changé entre J1 et J7 ?<br><br>
            <em style="color:'.$indigo.';">La plupart des participants découvrent deux choses : 1° Ils n\'ont eu aucune vraie solitude sur 7 jours — y compris en vivant seuls. 2° Leur propre compagnie, une fois apprivoisée, est bien plus intéressante qu\'ils ne le pensaient.</em>'
        );

        /* ── EXERCICE 4 ── Lettre à sa solitude ─────────────────── */
        $ex4 = $this->exercice($purple, '④', 'La Lettre à sa Solitude — réconciliation expressive',
            'Cet exercice s\'inspire de la technique Pennebaker d\'écriture expressive, mais il est ici tourné non pas vers un événement passé, mais vers une <em>relation</em> — votre relation à la solitude elle-même.<br><br>
            Écrivez une lettre à votre solitude. Comme à quelqu\'un que vous auriez mal traité, ignoré, ou fui pendant des années.<br><br>
            <strong>Bloc 1 — "Voici comment je t\'ai traitée jusqu\'ici…"</strong> (5-8 lignes)<br>
            Comment avez-vous évité la solitude ? Avec quoi l\'avez-vous remplacée ?<br>
            Depuis quand fuyez-vous de cette façon ? Est-ce que vous avez toujours su que c\'était une fuite ?<br><br>
            <strong>Bloc 2 — "Voici ce que tu me faisais ressentir quand je ne pouvais pas t\'éviter…"</strong> (5-8 lignes)<br>
            Quelle sensation exactement ? Ennui ? Angoisse ? Tristesse ? Vertige ?<br>
            D\'où vient cette sensation selon vous ? Quand est-elle apparue pour la première fois ?<br><br>
            <strong>Bloc 3 — "Ce que j\'ai perdu en te fuyant…"</strong> (4-6 lignes)<br>
            Quelle vie intérieure n\'a pas pu se construire ? Quels insights sont restés au seuil ?<br>
            Quelle partie de vous n\'a jamais eu la chance d\'exister pleinement ?<br><br>
            <strong>Bloc 4 — "Ce que je te propose maintenant…"</strong> (4-6 lignes)<br>
            Pas une promesse impossible. Une intention honnête et réaliste.<br>
            <em>"Je t\'offre 10 minutes par matin. D\'abord inconfortables. Puis, peut-être, familières."</em><br><br>
            <em style="color:'.$purple.';">James Pennebaker (2001, Handbook of Self-Regulation) : l\'écriture expressive adressée à une relation — même non-humaine — active les mêmes circuits neurologiques de traitement émotionnel que la relation réelle. Effets mesurables sur le cortisol salivaire en 10 jours.</em>'
        );

        /* ── MÉDITATION ── Profonde et guidée ────────────────────── */
        $meditation = $this->card($indigo, 'Méditation guidée · 12 min', '🌬 L\'Espace Entre — méditation de présence nue',
            'Cette pratique n\'est pas une technique de relaxation. C\'est une invitation à rencontrer votre propre présence — sans bruit de fond, sans objectif, sans performance.<br><br>
            <strong>Installez-vous.</strong> Assis(e) sur une chaise, les deux pieds au sol, le dos droit mais non rigide. Ou assis(e) en tailleur si c\'est naturel pour vous. Posez les mains sur les cuisses, paumes vers le haut ou vers le bas — selon ce qui semble juste. Fermez doucement les yeux.<br><br>
            <strong>Phase 1 — L\'atterrissage dans le corps (3 min)</strong><br>
            Commencez par sentir le <em>poids</em> de votre corps. Le contact des pieds avec le sol. Le contact des fesses avec ce sur quoi vous êtes assis(e). Ne cherchez pas à changer quoi que ce soit — juste sentir ce contact.<br>
            Maintenant les mains — leur poids, leur chaleur. La texture de ce qu\'elles touchent.<br>
            Maintenant le souffle — sans le modifier. Il entre. Il sort. Il a un rythme qui lui appartient.<br>
            Vous n\'avez rien à faire. Vous êtes déjà là.<br>
            Trois cycles lents : inspirez sur 5 temps, retenez sur 2, expirez sur 7. Laissez l\'expiration être longue et complète — comme poser quelque chose d\'lourd.<br><br>
            <strong>Phase 2 — Rencontrer l\'inconfort (3 min)</strong><br>
            C\'est ici que la plupart des gens voudraient faire quelque chose. Une pensée arrive : "Je dois…" "Et si…" "J\'ai oublié de…" Le téléphone est probablement dans l\'autre pièce et déjà vous y pensez.<br>
            Ne combattez pas ces pensées. Regardez-les.<br>
            Imaginez que vous êtes assis(e) dans un café, devant une fenêtre. Les pensées sont des passants dans la rue — ils arrivent, ils traversent, ils partent. Vous ne les retenez pas. Vous ne leur criez pas de revenir. Vous regardez.<br>
            Remarquez aussi les sensations physiques qui accompagnent l\'inconfort de la solitude : une légère agitation dans la poitrine ? Un pincement ? Une envie de bouger les jambes ?<br>
            Posez votre attention sur ces sensations avec une curiosité douce — comme si vous observiez un phénomène naturel intéressant, sans urgence de le résoudre.<br><br>
            <strong>Phase 3 — L\'espace qui reste (4 min)</strong><br>
            Quelque chose d\'étrange commence à se produire après quelques minutes de présence silencieuse.<br>
            L\'agitation se dépose. Non pas parce que vous l\'avez combattue — mais parce que vous n\'avez pas alimenté le feu de la fuite. La pensée a arrêté de chercher une prise.<br>
            Dans cet espace qui reste, il n\'y a rien à faire. Il n\'y a personne à impressionner. Il n\'y a aucune performance attendue.<br>
            Il y a simplement <em>vous — ici — maintenant.</em><br>
            Ce n\'est pas rien. Pour beaucoup, c\'est la première fois depuis très longtemps.<br>
            Restez dans cet espace. S\'il se resserre : revenez au souffle. S\'il s\'agite : revenez au poids du corps. S\'il s\'ouvre davantage : laissez-le s\'ouvrir.<br><br>
            <strong>Phase 4 — La question qui n\'a pas besoin de réponse (2 min)</strong><br>
            Avant de termine, posez intérieurement cette question — pas pour y répondre, mais pour la laisser résonner :<br>
            <em>"Qu\'est-ce qui veut être entendu en moi, et que le bruit quotidien empêche d\'entendre ?"</em><br>
            Après avoir posé la question : ne cherchez pas la réponse. Restez simplement dans le silence qui suit.<br>
            Parfois rien ne vient. Parfois quelque chose émerge — une image, un mot, une sensation dans la gorge ou dans la poitrine.<br>
            Dans les deux cas : c\'est juste.<br><br>
            <strong>Retour.</strong> Trois respirations amplifiées. Sentez à nouveau le contact du corps avec le sol. Remuez doucement les doigts, les orteils. Ouvrez les yeux lentement. Restez assis(e) encore 30 secondes avant de bouger.<br><br>
            <em style="color:'.$indigo.';">Recherches de Brown & Ryan (2003, Journal of Personality and Social Psychology) : les individus qui pratiquent des formes de présence silencieuse à elle seul(e)s — même 10-15 minutes quotidiennes — développent une tolérance à la solitude plus élevée, une anxiété de séparation plus faible, et une capacité d\'intimité avec les autres significativement augmentée. La solitude choisie nourrit le lien — elle ne le détruit pas.</em>'
        );

        return [
            'description' => 'Winnicott, Buchholz, Storr, Csikszentmihalyi, Rilke — la solitude choisie n\'est pas un repli. C\'est une compétence fondamentale de la maturité : apprendre à habiter sa propre présence, source de toute créativité et condition d\'une vraie présence aux autres.',
            'intro_text'  => "Avant de s'ouvrir pleinement aux autres, il y a quelque chose à apprendre —\nune compétence que personne n'enseigne, que notre culture décourage,\net dont l'absence coûte infiniment.\n\nC'est la capacité d'être avec soi.\n\nPas seul(e) par manque. Pas seul(e) par défaut.\nSeul(e) par choix — et trouver dans cet espace quelque chose de précieux,\nquelque chose qui n'existe nulle part ailleurs.\n\nNewton y a développé la gravitation. Descartes y a fondé la philosophie moderne.\nBeethoven y a entendu ses symphonies avant de les écrire.\n\nEt vous — qu'est-ce qui vous attend dans votre silence ?",
            'audio_path'  => 'formation/audio/27-solitude-choisie-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',   'title' => 'Leçon 1 — La capacité d\'être seul (Winnicott 1958, Buchholz 1997, Storr 1988)', 'duration' => '10 min', 'description' => 'Winnicott : la solitude comme compétence qui se développe. Buchholz : besoin biologique d\'alternance lien/solitude pathologisé par la modernité. Storr : les grandes œuvres naissent dans l\'isolement choisi.', 'content' => $lec1],
                ['type' => 'lecture',   'title' => 'Leçon 2 — Le paradoxe du flow solitaire & l\'économie d\'attention (Csikszentmihalyi, Dunbar, Rilke)', 'duration' => '8 min', 'description' => 'Le paradoxe de Csikszentmihalyi : plus heureux seul qu\'en groupe — et pourtant on choisit le groupe. Dunbar : 150 relations maximum. Rilke : aimer les questions dans leur solitude.', 'content' => $lec2],
                ['type' => 'exercice',  'title' => '① La Cartographie de la Fuite — que faites-vous quand vous êtes seul(e) ?', 'duration' => '25 min', 'description' => 'Inventaire complet des fuites automatiques (numériques, sociales, productives, mentales). Identifier le déclencheur et l\'inconfort sous-jacent que chaque fuite évite. Sherry Turkle (MIT).', 'content' => $ex1],
                ['type' => 'pratique',  'title' => '② La Retraite Quotidienne — protocole 21 jours (Buchholz × Csikszentmihalyi)', 'duration' => '10-25 min/j', 'description' => 'Progression 10→15→25 min. 3 phases : atterrissage, présence ouverte, recueil. Conditions non négociables. 80% d\'insights importants apparus après 7 jours de pratique.', 'content' => $ex2],
                ['type' => 'reflexion', 'title' => '③ Le Journal de Solitude — 7 questions, 7 jours, 7 vérités', 'duration' => '7 jours / 5 min', 'description' => '7 questions chaque soir : présence réelle, qualité, fuites, émergences, vérités intérieures. Bilan révèle le rapport structurel à la solitude. La plupart découvrent qu\'ils n\'en ont eu aucune.', 'content' => $ex3],
                ['type' => 'ecriture',  'title' => '④ La Lettre à sa Solitude — réconciliation expressive (Pennebaker)',           'duration' => '20 min', 'description' => 'Écrire à sa solitude comme à quelqu\'un de mal traité. 4 blocs : comment je t\'ai fuie / ce que je ressentais / ce que j\'ai perdu / ce que je propose maintenant. Réduction cortisol mesurable.', 'content' => $ex4],
                ['type' => 'pratique',  'title' => '🌬 L\'Espace Entre — méditation de présence nue (12 min)', 'duration' => '12 min', 'description' => '4 phases : atterrissage corporel / rencontrer l\'inconfort / l\'espace qui reste / la question sans réponse. Méditation de présence solitaire — Brown & Ryan (2003) : intimité avec les autres augmentée.', 'content' => $meditation, 'audio' => true],
            ],
            'activities_en' => [
                ['type' => 'lecture',   'title' => 'Lesson 1 — The capacity to be alone (Winnicott 1958, Buchholz 1997, Storr 1988)', 'duration' => '10 min', 'description' => 'Winnicott: solitude as a learnable developmental skill. Buchholz: biological need for connection/solitude alternation, pathologized by modernity. Storr: great works born in chosen isolation.'],
                ['type' => 'lecture',   'title' => 'Lesson 2 — The solitary flow paradox & attention economy (Csikszentmihalyi, Dunbar, Rilke)', 'duration' => '8 min', 'description' => 'Csikszentmihalyi\'s paradox: happier alone but we choose company. Dunbar: 150 relationships maximum. Rilke: love the questions in their solitude.'],
                ['type' => 'exercice',  'title' => '① The Escape Map — what do you do when you\'re alone?',                       'duration' => '25 min', 'description' => 'Full inventory of automatic escape behaviors (digital, social, productive, mental). Identify the trigger and the underlying discomfort each escape avoids. Sherry Turkle (MIT).'],
                ['type' => 'pratique',  'title' => '② The Daily Retreat — 21-day protocol (Buchholz × Csikszentmihalyi)',          'duration' => '10-25 min/d', 'description' => 'Progression 10→15→25 min. 3 phases: landing, open presence, harvest. Non-negotiable conditions. 80% of significant insights emerge after 7 days of practice.'],
                ['type' => 'reflexion', 'title' => '③ The Solitude Journal — 7 questions, 7 days, 7 truths',                      'duration' => '7 days / 5 min', 'description' => '7 questions each evening: real presence, quality, escapes, emergences, inner truths. Reveals structural relationship to solitude. Most discover they\'ve had none.'],
                ['type' => 'ecriture',  'title' => '④ The Letter to Your Solitude — expressive reconciliation (Pennebaker)',       'duration' => '20 min', 'description' => 'Write to your solitude as to someone mistreated. 4 blocks: how I fled you / what I felt / what I lost / what I now offer. Measurable cortisol reduction.'],
                ['type' => 'pratique',  'title' => '🌬 The Space Between — naked presence meditation (12 min)',                    'duration' => '12 min', 'description' => '4 phases: body landing / meeting discomfort / the remaining space / the unanswered question. Solitary presence — Brown & Ryan (2003): intimacy with others significantly increased.'],
            ],
        ];
    }

    private function m36_sens_de_la_vie(): array   // P3 — M36 nouveau
    {
        $gold   = 'rgba(201,168,76,.9)';
        $indigo = 'rgba(99,102,241,.85)';
        $teal   = 'rgba(20,184,166,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $red    = 'rgba(239,68,68,.8)';

        $lec1 = $this->card($gold, 'Viktor Frankl · 1946', 'Man\'s Search for Meaning — la volonté de sens',
            'Viktor Frankl était un psychiatre viennois. En 1942, il fut déporté à Auschwitz. Il observa qui survivait et qui capitulait — non physiquement, mais mentalement.<br><br>
            Sa conclusion, transformée en logothérapie :<br><br>
            <em style="color:'.$gold.';">"Celui qui a un pourquoi peut supporter presque tous les comment."</em> (Nietzsche, repris par Frankl)<br><br>
            <strong>La découverte centrale :</strong> ce n\'est pas la souffrance elle-même qui brise les gens. C\'est la souffrance perçue comme absurde, sans sens, sans direction.<br><br>
            Les prisonniers qui survivaient mentalement avaient quelque chose à accomplir, quelqu\'un à retrouver, une raison d\'être qui les dépassait.<br><br>
            <strong>Les 3 voies vers le sens selon Frankl :</strong><br>
            <strong>① La création</strong> — produire une œuvre, contribuer à quelque chose<br>
            <strong>② L\'expérience</strong> — rencontrer la beauté, l\'amour, la vérité<br>
            <strong>③ L\'attitude</strong> — choisir son rapport à la souffrance qu\'on ne peut éviter<br><br>
            <em style="color:'.$gold.';">Sa conclusion la plus radicale : même dans une situation qu\'on ne peut changer, l\'être humain garde la liberté ultime — choisir son attitude.</em>'
        ).$this->card($indigo, 'Irvin Yalom · 1980', 'Existential Psychotherapy — les 4 grandes préoccupations',
            'Le psychiatre Irvin Yalom (Stanford) a défini 4 "préoccupations ultimes" avec lesquelles tout être humain doit se réconcilier :<br><br>
            <strong>① La mort</strong> — la conscience de la finitude qui, paradoxalement, donne son prix à l\'existence<br>
            <strong>② La liberté</strong> — la responsabilité absolue de ses choix, sans dieu ni destin pour s\'en exonérer<br>
            <strong>③ L\'isolement existentiel</strong> — personne ne peut vivre ma vie à ma place, ni mourir pour moi<br>
            <strong>④ L\'absurde</strong> — l\'univers n\'a pas de sens intrinsèque ; c\'est à nous de le créer<br><br>
            Yalom ne présente pas ces réalités comme des tragédies — mais comme des <strong>éveilleurs</strong>.<br><br>
            <em style="color:'.$indigo.';">"Ce qui est vraiment triste n\'est pas de mourir. C\'est de mourir sans avoir vécu." — Yalom</em><br><br>
            Sa pratique consiste à demander à ses patients : <strong>"Si tu savais que tu meurs dans un an, qu\'est-ce que tu ferais différemment ?"</strong> Les réponses révèlent invariablement ce qui compte vraiment.'
        );

        $lec2 = $this->card($teal, 'Ikigai · García & Miralles 2016 / Ken Mogi 2017', 'Votre raison de vous lever le matin',
            'L\'ikigai (生き甲斐) est un concept d\'Okinawa souvent résumé dans un diagramme à 4 cercles : ce que vous aimez / ce dans quoi vous êtes doué(e) / ce dont le monde a besoin / ce pour quoi vous pouvez être payé(e).<br><br>
            <strong>Mais le neuroscientifique Ken Mogi (2017) nuance :</strong><br>
            <em style="color:'.$teal.';">"L\'ikigai des habitants d\'Okinawa ne ressemble pas au diagramme viral. Ce n\'est pas une mission grandiose. C\'est le plaisir de préparer le café du matin. D\'arroser ses plantes. De voir ses petits-enfants. Des petites raisons, multiples, quotidiennes."</em><br><br>
            Mogi identifie 5 piliers de l\'ikigai réel :<br>
            ① Commencer par de petites choses<br>
            ② S\'accepter tel qu\'on est<br>
            ③ S\'harmonie avec autrui et le monde<br>
            ④ Chercher les petites joies<br>
            ⑤ Être au présent<br><br>
            <strong>La conclusion contraire au développement personnel mainstream :</strong> le sens n\'est pas une grande mission à trouver une fois pour toutes. C\'est une pratique quotidienne d\'attention.'
        ).$this->card($purple, 'Martin Seligman · 2011', 'PERMA — la psychologie du flourishing',
            'Le fondateur de la psychologie positive (Seligman, U. Pennsylvania) a révisé son modèle du bonheur en 2011 avec son livre <em>Flourish</em>.<br><br>
            La nouvelle équation du bien-être : <strong>P.E.R.M.A.</strong><br><br>
            <strong>P — Positive Emotions</strong> : joie, gratitude, espoir, curiosité, émerveillement<br>
            <strong>E — Engagement</strong> : flow, immersion totale dans une activité<br>
            <strong>R — Relationships</strong> : liens authentiques et signifiants<br>
            <strong>M — Meaning</strong> : sentir que ce qu\'on fait dépasse son propre intérêt<br>
            <strong>A — Achievement</strong> : progresser vers des objectifs choisis librement<br><br>
            <strong>L\'insight central :</strong> aucun des 5 éléments n\'est suffisant seul. Le sens (M) sans engagement (E) reste abstrait. L\'engagement sans relations (R) devient isolement.<br><br>
            <em style="color:'.$purple.';">Seligman : les individus qui développent les 5 dimensions vivent en moyenne 7,5 ans de plus — avec une qualité de vie subjective considérablement supérieure.</em>'
        );

        $ex1 = $this->exercice($gold, '①', 'Les 4 Questions de Yalom — confrontation existentielle',
            'Prenez un temps seul(e), crayon en main. Répondez à ces 4 questions le plus honnêtement possible. Pas la "bonne" réponse — la vraie.<br><br>
            <strong>Question 1 — La mort</strong><br>
            <em>"Si vous appreniez aujourd\'hui que vous mourrez dans 1 an, qu\'est-ce que vous arrêteriez de faire immédiatement ? Et qu\'est-ce que vous commenceriez ?"</em><br><br>
            <strong>Question 2 — La liberté</strong><br>
            <em>"Dans quel domaine de votre vie dites-vous \'je n\'ai pas le choix\' — alors que vous avez bel et bien le choix, avec des conséquences que vous choisissez d\'éviter ?"</em><br><br>
            <strong>Question 3 — L\'isolement</strong><br>
            <em>"Qu\'est-ce que vous n\'avez jamais dit à personne — pas par honte, mais parce qu\'au fond vous savez que personne ne peut vraiment le comprendre ?"</em><br><br>
            <strong>Question 4 — Le sens</strong><br>
            <em>"Dans 30 ans, quelle est l\'histoire que vous voulez pouvoir vous raconter sur votre vie ?"</em><br><br>
            <em>Ces questions sont dites "éveillantes" par Yalom car elles dissolvent la trivialité du quotidien et remettent en contact avec ce qui compte vraiment.</em>', true
        );

        $ex2 = $this->exercice($teal, '②', 'La Boussole de Sens — PERMA × Valeurs × Impact (Seligman × Susan Wolf)',
            'Exercice de cartographie du sens personnel. 3 colonnes.<br><br>
            <strong>Colonne A — Ce qui me vivifie (PERMA)</strong><br>
            Listez 10 activités, contextes ou contributions dans lesquels vous ressentez au moins 3 des 5 dimensions PERMA. Ne pas filtrer — tout ce qui vient.<br><br>
            <strong>Colonne B — Ce que je valorise profondément</strong><br>
            Parmi vos 10 items, identifiez les 3 valeurs qui les traversent toutes. (Exemple : beauté, impact concret, transmission, vérité, soin des autres…)<br><br>
            <strong>Colonne C — Ce que ça crée pour les autres</strong><br>
            Susan Wolf (Johns Hopkins, "Meaning in Life", 2010) : le sens naît dans la contribution à quelque chose qui nous dépasse. Pour chaque valeur listée en B : <em>qui en bénéficie ? Comment ?</em><br><br>
            <strong>À la fin :</strong> formulez en une phrase votre boussole personnelle :<br>
            <em>"Je suis le plus vivant(e) quand je [action/qualité] pour [qui/quoi] — et ça crée [impact]."</em>'
        );

        $ecrit = $this->exercice($indigo, '③', 'Mon Épitaphe Vivante (Frankl × Bronnie Ware)',
            'Exercice inspiré de la logothérapie de Frankl et de la pratique de fin de vie de Bronnie Ware (autrice de "The Top 5 Regrets of the Dying").<br><br>
            Écrivez l\'éloge funèbre que vous voudriez qu\'on prononce à votre enterrement.<br><br>
            <strong>Structure :</strong><br>
            · "Ce que [votre prénom] a apporté à ceux qui l\'ont connu…" (5 lignes)<br>
            · "Ce qu\'il/elle n\'a pas eu peur de faire, dire, être…" (5 lignes)<br>
            · "Ce qui continuera de vivre après lui/elle…" (5 lignes)<br><br>
            Puis, sans l\'éloge ouvert, répondez à :<br>
            <em>"Suis-je en train de vivre d\'une façon qui rend cet éloge possible ?"</em><br><br>
            Si non : <em>"Qu\'est-ce qui devrait changer dans ma vie actuelle pour que oui ?"</em><br><br>
            <em>Cet exercice, pratiqué dans les retraites spirituelles et thérapeutiques du monde entier, est l\'un des plus puissants pour aligner le quotidien avec ce qui compte vraiment.</em>'
        );

        $meditation = $this->card($purple, 'Méditation guidée · 12 min', '🌬 Le Message du Futur — voyage existentiel (Frankl × visualisation thérapeutique)',
            'Cette pratique s\'inspire directement de la logothérapie de Viktor Frankl et des techniques de visualisation temporelle utilisées en thérapie cognitive. Elle vous emmène là où aucun exercice écrit ne peut aller : dans la <em>sensation incarnée</em> de ce qui aura compté.<br><br>
            <strong>Installez-vous.</strong> Allongé(e) ou assis(e) confortablement. Yeux fermés. Aucune interruption possible pour les 12 prochaines minutes.<br><br>
            <strong>Phase 1 — L\'ancrage dans le présent (3 min)</strong><br>
            Commencez par sentir votre corps là où il est maintenant. Le sol sous vous. La température de l\'air.<br>
            Trois cycles lents : inspirez 5 temps, retenez 2, expirez 8. Chaque expiration dépose quelque chose.<br>
            Nommez intérieurement 3 choses que vous percevez physiquement en ce moment — une sensation de contact, une sensation de température, un son.<br>
            Vous êtes ici. Vous êtes maintenant. Cet ancrage est le point de départ du voyage.<br><br>
            <strong>Phase 2 — Le voyage dans le temps (4 min)</strong><br>
            Laissez votre imagination vous emmener dans le futur.<br>
            Vous avez 80 ans — ou 75, ou 85 — l\'âge importe peu. Vous êtes assis(e) dans un endroit calme et familier : peut-être un fauteuil près d\'une fenêtre, peut-être dehors au soleil, peut-être sur un bord de mer.<br>
            Vous n\'êtes pas malade. Vous n\'êtes pas dans la souffrance. Vous êtes simplement <em>vieux et serein</em>.<br>
            Et depuis là, vous regardez en arrière sur votre vie entière.<br><br>
            Laissez venir les images naturellement :<br>
            · Les visages qui ont compté — ceux que vous avez aimés, ceux qui vous ont aimé.<br>
            · Les moments où vous vous êtes senti(e) complètement vivant(e).<br>
            · Les choses que vous avez créées, dites, données.<br>
            · Les fois où vous avez eu peur — et où vous avez avancé quand même.<br><br>
            Remarquez ce qui éclaire dans ce regard rétrospectif. Ce ne sont peut-être pas les accomplissements les plus bruyants. Ce sont souvent les moments les plus discrets — une conversation dans un couloir, un texte écrit à 2h du matin, une main tenue.<br><br>
            <strong>Phase 3 — Le message que vous vous envoyez (3 min)</strong><br>
            Ce vous de 80 ans a quelque chose à dire à vous d\'aujourd\'hui.<br>
            Il n\'a plus peur du regard des autres. Il ne cherche plus à impressionner. Il n\'a plus de temps à perdre dans les urgences du faux.<br>
            Il vous regarde — vous, maintenant, avec vos doutes et vos peurs et vos espoirs — et il veut que vous entendiez quelque chose.<br><br>
            Restez dans le silence. Laissez venir les mots, s\'ils viennent. Peut-être une phrase. Peut-être une image. Peut-être juste une sensation.<br>
            Certains entendent : <em>"C\'était déjà là — tu n\'avais pas besoin de courir autant."</em><br>
            D\'autres entendent : <em>"Dis-le maintenant. Ne laisse pas passer cette conversation."</em><br>
            D\'autres encore : <em>"Reste plus longtemps avec les gens que tu aimes."</em><br>
            Ce que vous entendez est juste. C\'est le vôtre.<br><br>
            <strong>Phase 4 — Le retour et l\'intention (2 min)</strong><br>
            Revenez doucement dans le présent. Sentez à nouveau votre corps.<br>
            Trois respirations lentes.<br>
            Avant d\'ouvrir les yeux, notez intérieurement — ou sur le papier à portée de main — la phrase ou l\'image la plus forte qui est venue.<br><br>
            Puis posez-vous une seule question :<br>
            <em>"Qu\'est-ce que je peux faire différemment aujourd\'hui — pas demain, pas quand les conditions seront meilleures — aujourd\'hui — pour que dans 40 ans, ce regard vers l\'arrière soit lumineux ?"</em><br><br>
            <em style="color:'.$purple.';">Victor Frankl (The Will to Meaning, 1969) : "Agis comme si tu vivais pour la seconde fois et que tu aies agi aussi mal que tu t\'apprêtes à agir maintenant." La projection temporelle est l\'un des outils les plus puissants de la logothérapie pour sortir du pilote automatique et retrouver la liberté de choix. Les études en neuropsychologie (Hershfield et al., 2011, Stanford) montrent que les personnes qui développent une connexion vive avec leur "moi futur" prennent des décisions plus alignées avec leurs valeurs profondes — dans les 30 jours suivant la pratique.</em>'
        );

        return [
            'description' => 'Viktor Frankl, Irvin Yalom, ikigai, PERMA — le sens n\'est pas une destination. C\'est une pratique quotidienne. Ce module vous donne les outils pour formuler votre raison d\'être et aligner votre vie avec elle.',
            'intro_text'  => "Il y a un moment — souvent après une crise, une perte, un cap — où la question monte de l'intérieur :\n\n« Pour quoi, exactement, est-ce que je vis ? »\n\nPas la question de la dépression — mais celle de la maturité.\nCelle qui arrive quand les masques sociaux ont fait leur temps,\nquand les objectifs atteints ne comblent plus,\nquand la vie demande quelque chose de plus vrai que la performance.\n\nViktor Frankl a survécu à Auschwitz parce qu'il avait une réponse à cette question.\nCe module vous invite à forger la vôtre.",
            'audio_path'  => 'formation/audio/36-sens-de-la-vie-fr.mp3',
            'activities'  => [
                ['type' => 'lecture',  'title' => 'Leçon 1 — La volonté de sens (Frankl) & les 4 préoccupations (Yalom)', 'duration' => '10 min', 'description' => 'Frankl : les 3 voies vers le sens. Yalom : mort, liberté, isolement, absurde — les 4 éveilleurs existentiels. La souffrance absurde brise ; la souffrance signifiante forge.', 'content' => $lec1],
                ['type' => 'lecture',  'title' => 'Leçon 2 — L\'ikigai réel (Mogi) & le PERMA (Seligman)',              'duration' => '7 min',  'description' => 'Ken Mogi : l\'ikigai n\'est pas une mission grandiose — c\'est la joie de l\'arrosoir du matin. Seligman : les 5 dimensions du flourishing. +7,5 ans d\'espérance de vie.', 'content' => $lec2],
                ['type' => 'exercice', 'title' => '① Les 4 Questions de Yalom — confrontation existentielle',            'duration' => '30 min', 'description' => 'Mort, liberté, isolement, sens — 4 questions éveillantes pour dissoudre la trivialité et retrouver ce qui compte vraiment. Pratique de Yalom à Stanford depuis 1980.', 'content' => $ex1],
                ['type' => 'exercice', 'title' => '② La Boussole de Sens — PERMA × Valeurs × Impact',                   'duration' => '25 min', 'description' => 'Cartographier ce qui vivifie · identifier les valeurs profondes · voir l\'impact créé pour les autres (Susan Wolf). Formuler sa boussole personnelle en une phrase.', 'content' => $ex2],
                ['type' => 'ecriture', 'title' => '③ Mon Épitaphe Vivante (Frankl × Bronnie Ware)',                      'duration' => '25 min', 'description' => 'Écrire l\'éloge funèbre que vous voudriez qu\'on prononce — puis vérifier si votre vie actuelle rend cet éloge possible. L\'un des exercices les plus transformants qui soit.', 'content' => $ecrit],
                ['type' => 'pratique', 'title' => '🌬 Le Message du Futur — méditation existentielle 12 min (Frankl)',  'duration' => '12 min', 'description' => 'Voyage dans le temps : vous avez 80 ans, vous regardez en arrière. Ce que vous avez créé, donné, aimé. Le message de ce vous futur à vous d\'aujourd\'hui. Hershfield (Stanford) : décisions plus alignées aux valeurs en 30 jours.', 'content' => $meditation, 'audio' => true],
            ],
            'activities_en' => [
                ['type' => 'lecture',  'title' => 'Lesson 1 — The will to meaning (Frankl) & the 4 concerns (Yalom)',    'duration' => '10 min', 'description' => 'Frankl: 3 paths to meaning. Yalom: death, freedom, isolation, absurdity — 4 existential awakeners. Absurd suffering breaks; meaningful suffering forges.'],
                ['type' => 'lecture',  'title' => 'Lesson 2 — The real ikigai (Mogi) & PERMA (Seligman)',                'duration' => '7 min',  'description' => 'Ken Mogi: ikigai is not a grand mission — it\'s the joy of watering plants. Seligman: the 5 flourishing dimensions. +7.5 years of life expectancy.'],
                ['type' => 'exercice', 'title' => '① Yalom\'s 4 Questions — existential confrontation',                  'duration' => '30 min', 'description' => 'Death, freedom, isolation, meaning — 4 awakening questions to dissolve triviality and return to what truly matters. Yalom\'s Stanford practice since 1980.'],
                ['type' => 'exercice', 'title' => '② The Meaning Compass — PERMA × Values × Impact',                    'duration' => '25 min', 'description' => 'Map what energizes · identify deep values · see impact created for others (Susan Wolf). Formulate your personal compass in one sentence.'],
                ['type' => 'ecriture', 'title' => '③ My Living Epitaph (Frankl × Bronnie Ware)',                          'duration' => '25 min', 'description' => 'Write the eulogy you\'d want delivered — then verify whether your current life makes that eulogy possible. One of the most transformative exercises that exists.'],
                ['type' => 'pratique', 'title' => '🌬 The Message from the Future — existential meditation 12 min (Frankl)', 'duration' => '12 min', 'description' => 'Time travel: you are 80 years old, looking back. What you created, gave, loved. The message of your future self to you today. Hershfield (Stanford): decisions aligned with values in 30 days.'],
            ],
        ];
    }

    // ─────────────────────────────────────────────────────────────────────────
    // RUN
    // ─────────────────────────────────────────────────────────────────────────

    public function run(): void
    {
        $track = \App\Models\FormationModule::TRACK_PARCOURS;

        $modules = [
            // ── Parcours 1 — Se Retrouver (10 modules) ──
            '07-je-prends-soin-de-moi'           => $this->m07_soin(),
            '08-gratitude-et-intention'           => $this->m08_gratitude(),
            '03-j-accepte-mes-limites'            => $this->m03_accepte_limites(),
            '04-je-reconnais-ce-qui-me-draine'    => $this->m04_drains_energie(),
            // ── Parcours 2 — Se Construire (13 modules) ──
            '09-mes-priorites-dabord'             => $this->m09_priorites(),
            '12-maitriser-son-temps'               => $this->m10b_maitriser_temps(),
            '13-gerer-ses-finances'                => $this->m10c_gerer_finances(),
            '10-interieur-propre-et-range'         => $this->m10_interieur(),
            '07-mouvement-et-posture'             => $this->m07(),
            '08-systeme-nerveux'                  => $this->m08(),
            '09-gestion-des-emotions'             => $this->m09(),
            '10-vivre-ici-et-maintenant'          => $this->m10_present(),
            '11-je-transmets-ma-transformation'   => $this->m11_transmettre(),
            '10-sommeil-et-recuperation'          => $this->m10(),
            '11-relation-alimentation'            => $this->m11(),
            '12-presence-a-soi'                   => $this->m12(),
            '13-confiance-corporelle'             => $this->m13(),
            '14-interactions-sociales'            => $this->m14(),
            '15-activite-physique'                => $this->m15(),
            '16-loisirs-et-vie'             => $this->m16(),
            '17-relation-a-lautre'          => $this->m17(),
            '18-intimite-et-energie'        => $this->m18(),
            '19-medecines-complementaires'  => $this->m19(),
            '20-vivre-choisir-reconstruire' => $this->m20(),
            '21-entretenir-nos-relations'    => $this->m21(),
            '22-nutrition-et-vitalite'       => $this->m22(),
            // Parcours 3 — modules de synthèse et programme quotidien
            '27-solitude-choisie'            => $this->m27_solitude_choisie(),
            '36-sens-de-la-vie'              => $this->m36_sens_de_la_vie(),
            '29-synthese-du-parcours'        => $this->m29_synthese(),
            '30-mon-programme-quotidien'     => $this->m30_rituel_quotidien(),
            '31-amour-ere-jetable'           => $this->m31_amour_jetable(),
            '32-pieges-ecrans'               => $this->m32_pieges_ecrans(),
            '33-education-sacrifiee'         => $this->m33_education_sacrifiee(),
        ];

        $count = 0;
        foreach ($modules as $slug => $data) {
            $updateFields = [
                'description' => $data['description'],
                'intro_text'  => $data['intro_text'] ?? null,
                'audio_path'  => $data['audio_path'] ?? null,
                'activities'  => json_encode($data['activities'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                'updated_at'  => now(),
            ];
            if (array_key_exists('activities_en', $data)) {
                $updateFields['activities_en'] = $data['activities_en'] !== null
                    ? json_encode($data['activities_en'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
                    : null;
            }
            $updated = \Illuminate\Support\Facades\DB::table('formation_modules')
                ->where('slug', $slug)
                ->where('track', $track)
                ->update($updateFields);

            if ($updated) {
                $count++;
            } else {
                $this->command?->warn("[SKIP] Module not found: {$slug} (track: {$track}) — run FormationModulesSeeder first.");
            }
        }

        $this->command?->info("[FormationWellbeingModulesSeeder] {$count}/".count($modules)." modules mis à jour.");

        // ─── PRATICIEN — modules sans contenu précédemment ───────────────────
        $praticienModules = [
            '08-je-renforce-ma-discipline' => $this->m08_discipline_praticien(),
            '09-je-transmets-le-rituel'    => $this->m12_rituel(),
        ];

        $praticienTrack = \App\Models\FormationModule::TRACK_PRATICIEN;
        $countPrat = 0;
        foreach ($praticienModules as $slug => $data) {
            $updated = \Illuminate\Support\Facades\DB::table('formation_modules')
                ->where('slug', $slug)
                ->where('track', $praticienTrack)
                ->update([
                    'description' => $data['description'],
                    'intro_text'  => $data['intro_text'] ?? null,
                    'audio_path'  => $data['audio_path'] ?? null,
                    'activities'  => json_encode($data['activities'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    'updated_at'  => now(),
                ]);

            if ($updated) {
                $countPrat++;
            } else {
                $this->command?->warn("[SKIP] Praticien module not found: {$slug}");
            }
        }

        $this->command?->info("[FormationWellbeingModulesSeeder] {$countPrat}/".count($praticienModules)." modules PRATICIEN mis à jour.");
    }
}
