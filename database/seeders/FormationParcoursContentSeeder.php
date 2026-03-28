<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Contenu PERSONNEL pour les modules 01–06 du Parcours
 * (voyage intérieur, connaissance de soi, sans référence au «praticien»)
 */
class FormationParcoursContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedModule01();
        $this->seedModule02();
        $this->seedModule03();
        $this->seedModule04();
        $this->seedModule05();
        $this->seedModule06();

        $this->command->info('[FormationParcoursContentSeeder] Contenus personnels Parcours 01–06 mis à jour.');
    }

    /* ─────────────────────────────────────────────────────── MODULE 01 ─── */
    private function seedModule01(): void
    {
        $activities = [
            [
                'type'    => 'lecture',
                'title'   => 'Introduction — L\'art de se rencontrer',
                'content' => '<div style="border-left:3px solid rgba(201,168,76,.9);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(201,168,76,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(201,168,76,.9);margin:0 0 .5rem">PROMESSE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Ce que ce module t\'apporte</p></div>
<p>Ce module n\'est pas un test psychologique. Ce n\'est pas une thérapie.</p>
<p>C\'est un rendez-vous avec toi-même. À travers le corps, pas dans la tête.</p>
<p>Se rencontrer c\'est apprendre à s\'observer : reconnaître ses tensions, ses envies, ses résistances — avant de les interpréter.</p>
<p><strong>Ce que tu vas faire ici :</strong></p>
<ul>
<li>Apprendre à lire les signaux de ton corps</li>
<li>Distinguer une sensation d\'une émotion, une émotion d\'une pensée</li>
<li>Développer une écoute intérieure fine — le début de tout changement réel</li>
</ul>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 1 — L\'écoute de soi',
                'content' => '<div style="border-left:3px solid rgba(20,184,166,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(20,184,166,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(20,184,166,.8);margin:0 0 .5rem">LEÇON 1</p>
<p style="font-size:.95rem;font-weight:600;margin:0">L\'écoute de soi — s\'observer sans juger</p></div>
<p>La plupart des gens vivent dans leur tête. Ils analysent, jugent, comparent — mais n\'écoutent presque jamais ce que leur corps ressent réellement.</p>
<p>S\'écouter, c\'est poser ton attention sur ce qui se passe en toi : une tension dans les épaules, un serrement dans la poitrine, une légèreté dans le ventre.</p>
<p><strong>La règle d\'or :</strong> Observer d\'abord. Interpréter ensuite.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 2 — Les signaux du corps',
                'content' => '<div style="border-left:3px solid rgba(59,130,246,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(59,130,246,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(59,130,246,.8);margin:0 0 .5rem">LEÇON 2</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Les signaux du corps — ton corps te parle déjà</p></div>
<p>Le corps communique en permanence. Avant les mots, avant les pensées — il y a une sensation.</p>
<p><strong>3 types de signaux :</strong></p>
<ul>
<li><strong>Tension / crispation</strong> → résistance, peur, surcharge</li>
<li><strong>Légèreté / expansion</strong> → accord intérieur, alignement</li>
<li><strong>Neutralité / vide</strong> → fatigue, dissociation, besoin de repos</li>
</ul>
<p>Chaque signal est une information précieuse sur ton état réel — pas sur ce que tu veux ressentir.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 3 — Les émotions comme informations',
                'content' => '<div style="border-left:3px solid rgba(168,85,247,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(168,85,247,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(168,85,247,.8);margin:0 0 .5rem">LEÇON 3</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Les émotions comme informations</p></div>
<p>Une émotion n\'est pas un problème. C\'est une information.</p>
<p>Joie → expansion · légèreté · envie d\'avancer</p>
<p>Peur → contraction · alerte · besoin de protection</p>
<p>Colère → énergie bloquée · frontière transgressée</p>
<p>Tristesse → perte · besoin d\'intégration</p>
<p>Accueillir une émotion ne signifie pas la laisser dicter tes actes. Cela signifie la laisser exister — et lire le message qu\'elle porte.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 4 — Le miroir intérieur',
                'content' => '<div style="border-left:3px solid rgba(249,115,22,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(249,115,22,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(249,115,22,.8);margin:0 0 .5rem">LEÇON 4</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Le miroir intérieur — s\'observer sans se juger</p></div>
<p>L\'auto-observation n\'est pas de l\'égocentrisme. C\'est l\'art de se voir tel qu\'on est — sans résistance, sans embellissement.</p>
<p>Observer → nommer → accepter → choisir.</p>
<p>Cette séquence simple est le fondement de tout changement durable.</p>',
            ],
            [
                'type'    => 'pratique',
                'title'   => 'Pratique — Le scan corporel complet',
                'content' => '<div style="border-left:3px solid rgba(34,197,94,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(34,197,94,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(34,197,94,.8);margin:0 0 .5rem">PRATIQUE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Le scan corporel complet — 10 minutes</p></div>
<p><strong>─ Protocole ─</strong></p>
<p>Minute 1–2 : Installation. Assis ou allongé. 3 respirations profondes.</p>
<p>Minute 3–5 : Scanne du bas vers le haut. Pieds → chevilles → mollets → genoux → cuisses → bassin → ventre → poitrine → épaules → cou → visage.</p>
<p>Minute 6–8 : Note 3 zones où tu ressens quelque chose. Nomme la sensation sans l\'expliquer.</p>
<p>Minute 9–10 : Pose la main sur la zone la plus forte. Respire dessus 3 fois.</p>',
            ],
            [
                'type'    => 'exercice',
                'title'   => 'Outil quotidien — Le journal de bord du corps',
                'content' => '<div style="border-left:3px solid rgba(99,102,241,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(99,102,241,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(99,102,241,.8);margin:0 0 .5rem">PRATIQUE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Le journal de bord du corps — outil quotidien</p></div>
<p>Chaque matin ou soir, 5 minutes :</p>
<p>Question 1 → Quelle zone de mon corps a retenu mon attention aujourd\'hui ?</p>
<p>Question 2 → Quelle sensation y était présente ? (tension, légèreté, douleur, chaleur…)</p>
<p>Question 3 → Quelle émotion ou pensée y est associée ?</p>
<p>Question 4 → De quoi cette sensation est-elle peut-être le signal ?</p>',
            ],
            [
                'type'    => 'exercice',
                'title'   => 'Intégration — Mon portrait corporel',
                'content' => '<p>Dessine (même grossièrement) une silhouette. Colorie les zones selon :</p>
<ul>
<li>Rouge = tension / résistance</li>
<li>Bleu = légèreté / bien-être</li>
<li>Gris = fatigue / vide</li>
</ul>
<p>Ce portrait est ton point de départ. Il évoluera au fil du parcours.</p>',
            ],
            [
                'type'    => 'pratique',
                'title'   => '🌬 Pause Souffle — Rencontre intérieure (5 min)',
                'content' => '<div style="border-left:3px solid rgba(20,184,166,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(20,184,166,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(20,184,166,.8);margin:0 0 .5rem">MÉDITATION GUIDÉE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">🌬 Pause Souffle — Rencontre intérieure (5 min)</p></div>
<p><strong>Installation :</strong> Assieds-toi confortablement, dos droit sans être rigide. Pose les mains sur les cuisses. Ferme les yeux.</p>
<p><strong>PHASE 1 — Observation du souffle naturel (1 min)</strong><br>Ne change rien. Observe simplement comment tu respires en ce moment. Rapide ou lent ? Haut ou bas ? Tendu ou libre ? Tu n\'analyses pas — tu remarques.</p>
<p><strong>PHASE 2 — Scan corps-souffle (3 min)</strong><br>À chaque inspiration, porte l\'attention sur une zone du corps :<br>Cycle 1 → pieds et jambes. Tu les habites.<br>Cycle 2 → ventre et poitrine. Tu sens les mouvements du souffle.<br>Cycle 3 → épaules, cou, visage. Tu les laisses fondre à l\'expiration.<br>Cycle 4 → tout le corps en même temps. Tu es là. Tu te rencontres.</p>
<p><strong>PHASE 3 — Fermeture (1 min)</strong><br>Inspiration profonde par le nez. Rétention douce 3 secondes. Expiration lente par la bouche.<br>Répète 3 fois.<br>Pose intérieurement : <em>"Je me rencontre. Je suis là."</em><br><em>⏱ Durée totale : 5 min · Ouvre doucement les yeux avant d\'écrire ta lettre.</em>',
            ],
            [
                'type'    => 'reflexion',
                'title'   => 'Lettre à mon corps — clôture du module',
                'content' => '<p>Prends 10 minutes pour écrire une lettre courte à ton corps.</p>
<p>Commence par : <em>"Aujourd\'hui, je t\'écoute vraiment. Ce que j\'entends c\'est…"</em></p>
<p>Pas besoin d\'être poétique. Sois honnête.</p>',
            ],
        ];

        $this->updateModule('parcours', '01-je-me-rencontre', [
            'intro_text' => "JE ME RENCONTRE — Voyage Intérieur\n\nSe rencontrer, c'est apprendre à s'observer.\nÀ reconnaître ses signaux corporels, ses humeurs, ses tensions.\nPas une thérapie. Un rendez-vous avec soi — à travers le corps.\n\nCette formation n'est pas née dans une bibliothèque. Elle est née de quelqu'un qui a cherché à comprendre depuis l'intérieur — en vivant ce qu'elle décrit, en portant les questions jusqu'à trouver les réponses. 'Cherchez et vous trouverez' — non comme promesse abstraite, mais comme description précise de ce qui s'est passé. Le savoir et l'expérience vécue ne sont pas opposés. Souvent, l'un naît de l'autre.",
            'description' => '4 leçons · Scan corporel · Journal de bord · Portrait corporel · Lettre au corps. L\'écoute de soi comme fondation de tout changement.',
        ], $activities);
    }

    /* ─────────────────────────────────────────────────────── MODULE 02 ─── */
    private function seedModule02(): void
    {
        $activities = [
            [
                'type'    => 'lecture',
                'title'   => 'Introduction — Le corps qui se souvient',
                'content' => '<div style="border-left:3px solid rgba(201,168,76,.9);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(201,168,76,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(201,168,76,.9);margin:0 0 .5rem">PROMESSE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Ce que ce module t\'apprend à faire</p></div>
<p>Le corps se souvient de tout. D\'une peur subie à 7 ans. D\'une honte portée pendant des années. D\'une perte jamais pleurée.</p>
<p>Ce module n\'est pas là pour rouvrir des plaies. Il est là pour t\'aider à reconnaître ce qui est là — déjà en toi.</p>
<p>La reconnaissance est la première étape de la libération.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 1 — Les 5 blessures fondamentales',
                'content' => '<div style="border-left:3px solid rgba(20,184,166,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(20,184,166,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(20,184,166,.8);margin:0 0 .5rem">LEÇON 1</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Les 5 blessures fondamentales — ce que le corps porte</p></div>
<p>Ces 5 blessures universelles ont été identifiées par Lise Bourbeau et enrichies par la recherche somatique :</p>
<ol>
<li><strong>Le rejet</strong> — "je ne mérite pas d\'être ici"</li>
<li><strong>L\'abandon</strong> — "je suis seul(e) avec tout ça"</li>
<li><strong>L\'humiliation</strong> — "je suis honteux/honteuse"</li>
<li><strong>La trahison</strong> — "on ne peut pas compter sur les autres"</li>
<li><strong>L\'injustice</strong> — "ce n\'est jamais équitable"</li>
</ol>
<p>Chacune laisse une empreinte dans le corps. Non pour te définir — mais pour te donner une piste de compréhension.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 2 — La mémoire du corps',
                'content' => '<div style="border-left:3px solid rgba(59,130,246,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(59,130,246,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(59,130,246,.8);margin:0 0 .5rem">LEÇON 2</p>
<p style="font-size:.95rem;font-weight:600;margin:0">La mémoire du corps — comment les blessures s\'installent</p></div>
<p>Peter Levine (Waking the Tiger) l\'a démontré : le corps garde la trace des expériences non intégrées.</p>
<p>Une tension chronique dans le ventre, une épaule qui "remonte" tout seule, une mâchoire serrée la nuit — ce sont des empreintes de ce que le corps n\'a pas encore pu relâcher.</p>
<p>Reconnaître ces empreintes, c\'est commencer à leur permettre de se transformer.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 3 — Les armures corporelles',
                'content' => '<div style="border-left:3px solid rgba(168,85,247,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(168,85,247,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(168,85,247,.8);margin:0 0 .5rem">LEÇON 3</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Les armures corporelles — protections devenues prisons</p></div>
<p>Wilhelm Reich a découvert le concept d\'armure musculaire : des tensions chroniques qui protègent d\'une douleur ancienne, mais qui finissent par limiter la vie elle-même.</p>
<p>Exemples communs :</p>
<ul>
<li>Épaules hautes → protection, anticipation du danger</li>
<li>Ventre rentré → honte, protection du centre</li>
<li>Mâchoire serrée → colère retenue, mots non dits</li>
</ul>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 4 — Reconnaître sans juger',
                'content' => '<div style="border-left:3px solid rgba(249,115,22,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(249,115,22,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(249,115,22,.8);margin:0 0 .5rem">LEÇON 4</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Reconnaître sans juger — la blessure vue, pas portée</p></div>
<p>La blessure reconnue perd déjà une partie de son emprise.</p>
<p>Règle d\'or : observer la blessure comme un fait, pas comme une identité.</p>
<p>"J\'ai vécu ça" est différent de "je suis comme ça pour toujours".</p>
<p>Ce module ne cherche pas à te guérir en une session. Il cherche à t\'aider à voir — avec douceur.</p>',
            ],
            [
                'type'    => 'pratique',
                'title'   => 'Pratique — Cartographie de mes tensions personnelles',
                'content' => '<div style="border-left:3px solid rgba(34,197,94,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(34,197,94,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(34,197,94,.8);margin:0 0 .5rem">PRATIQUE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Localisation de mes tensions — cartographie personnelle</p></div>
<p><strong>─ Exercice ─</strong></p>
<p>Prends une feuille. Dessine un corps (très simple). Évalue chaque zone sur 0–10 selon l\'intensité de la sensation présente.</p>
<p>Pour chaque zone notée ≥ 5 : note la sensation (ex : "nœud", "chaud", "serré") et l\'émotion associée si elle se présente.</p>
<p>Pas besoin de tout expliquer. Nomme simplement ce qui est là.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Note — Aller à son rythme',
                'content' => '<div style="border-left:3px solid rgba(239,68,68,.7);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(239,68,68,.05);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(239,68,68,.7);margin:0 0 .5rem">NOTE IMPORTANTE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Marcher avec précaution — reconnaître sans forcer</p></div>
<p>Ce module touche des zones sensibles. Ce parcours respecte ton rythme.</p>
<p>Si une réflexion fait surgir quelque chose d\'intense, tu peux te donner le droit de :</p>
<ul>
<li>Faire une pause</li>
<li>Revenir plus tard</li>
<li>Chercher un soutien extérieur si nécessaire</li>
</ul>
<p>La reconnaissance ne force pas. Elle invite doucement.</p>',
            ],
            [
                'type'    => 'exercice',
                'title'   => 'Intégration — Ma carte des blessures reconnues',
                'content' => '<p>Sur ta cartographie, entoure en doux (pas en rouge vif) les zones liées aux 5 blessures que tu reconnais le mieux.</p>
<p>Écris une phrase courte à côté : "Ici, il y a peut-être…"</p>
<p>Garde cette carte. Elle deviendra une référence pour la suite du parcours.</p>',
            ],
            [
                'type'    => 'pratique',
                'title'   => '🌬 Pause Souffle — Souffle de bienveillance (7 min)',
                'content' => '<div style="border-left:3px solid rgba(201,168,76,.9);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(201,168,76,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(201,168,76,.9);margin:0 0 .5rem">MÉDITATION GUIDÉE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">🌬 Pause Souffle — Souffle de bienveillance (7 min)</p></div>
<p><strong>Installation :</strong> Assieds-toi ou allonge-toi. Une main sur le cœur, l\'autre sur le ventre. Ferme les yeux.</p>
<p><strong>PHASE 1 — Centrage (2 min)</strong><br>Respiration naturelle. À chaque expiration, laisse ton corps s\'alourdir un peu plus.<br>Dis intérieurement : <em>"Je suis en sécurité. Je suis avec moi."</em><br>4 cycles lents.</p>
<p><strong>PHASE 2 — Souffle sur la blessure reconnue (4 min)</strong><br>Rappelle doucement la blessure que tu as identifiée dans ce module — juste son nom ou son image.<br>Ne la revois pas dans les détails. Sache simplement qu\'elle est là.<br>Inspiration 5s : tu envoies un souffle chaud et doux vers cet endroit du corps.<br>Expiration 7s : tu libères ce qui se contracte, sans forcer.<br>5 cycles.<br>À chaque cycle, dis intérieurement : <em>"Je te reconnais. Tu as fait ce que tu pouvais. Je t\'accueille maintenant."</em></p>
<p><strong>PHASE 3 — Retour (1 min)</strong><br>Porte toute l\'attention sur la main posée sur ton cœur. Sens le battement.<br>Inspiration profonde. Expiration longue.<br>Tu n\'as pas à tout guérir maintenant. Tu as osé regarder. C\'est suffisant.<br><em>⏱ Durée totale : 7 min · Reste un moment dans ce silence avant d\'écrire ta lettre.</em>',
            ],
            [
                'type'    => 'reflexion',
                'title'   => 'Lettre — À la blessure que je reconnais',
                'content' => '<p>Écris une lettre courte à la blessure que tu identifies le mieux en toi.</p>
<p>Commence par : <em>"Je t\'ai vue. Tu m\'as protégé(e) pendant longtemps. Aujourd\'hui, je reconnais ta présence sans en avoir peur."</em></p>',
            ],
        ];

        $this->updateModule('parcours', '02-je-reconnais-mes-blessures', [
            'intro_text' => "JE RECONNAIS MES BLESSURES — La Mémoire du Corps\n\nLe corps se souvient de tout. D'une peur, d'une honte, d'une perte.\nCe module apprend à reconnaître — pas à rouvrir.\nLa reconnaissance est la première étape de la libération.",
            'description' => '4 leçons · Cartographie des tensions personnelles · Les 5 blessures · Intégration douce. Comprendre la mémoire du corps pour mieux l\'habiter.',
        ], $activities);
    }

    /* ─────────────────────────────────────────────────────── MODULE 03 ─── */
    private function seedModule03(): void
    {
        $activities = [
            [
                'type'    => 'lecture',
                'title'   => 'Introduction — Le choix d\'aller aussi vers ce qui est bien',
                'content' => '<div style="border-left:3px solid rgba(201,168,76,.9);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(201,168,76,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(201,168,76,.9);margin:0 0 .5rem">PROMESSE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Ce que ce module t\'apprend</p></div>
<p>La plupart des approches de développement personnel passent tout leur temps sur les problèmes. Le Parcours Pause Souffle fait le choix inverse : aller aussi vers ce qui fonctionne, ce qui ressource, ce qui donne de la vie.</p>
<p>Décrire ton bonheur avec précision, ce n\'est pas de la pensée positive superficielle. C\'est un acte de connaissance de soi.</p>
<p>Pas en idées — en sensations corporelles.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 1 — Ce que ton corps connaît déjà du bonheur',
                'content' => '<div style="border-left:3px solid rgba(20,184,166,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(20,184,166,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(20,184,166,.8);margin:0 0 .5rem">LEÇON 1</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Ce que ton corps connaît déjà du bonheur</p></div>
<p>Le bonheur n\'est pas une idée abstraite. C\'est une expérience corporelle.</p>
<p>Souviens-toi d\'un moment où tu t\'es senti(e) vraiment vivant(e). Qu\'est-ce que tu ressentais physiquement ? Légèreté ? Chaleur dans la poitrine ? Énergie fluide ?</p>
<p>Ton corps connaît déjà ces états. Il s\'agit d\'apprendre à les reconnaître et à les décrire avec précision.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 2 — Les ressources intérieures',
                'content' => '<div style="border-left:3px solid rgba(59,130,246,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(59,130,246,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(59,130,246,.8);margin:0 0 .5rem">LEÇON 2</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Les ressources intérieures — ce que tu as déjà</p></div>
<p>Une ressource intérieure est une qualité, une force, une capacité que tu possèdes déjà — et que tu utilises peut-être sans le savoir.</p>
<p>Exemples : calme dans les crises · créativité sous pression · écoute naturelle · capacité à rebondir · sens de l\'humour comme régulateur.</p>
<p>Les identifier te permet de les mobiliser consciemment quand tu en as besoin.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 3 — La posture du bonheur',
                'content' => '<div style="border-left:3px solid rgba(168,85,247,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(168,85,247,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(168,85,247,.8);margin:0 0 .5rem">LEÇON 3</p>
<p style="font-size:.95rem;font-weight:600;margin:0">La posture du bonheur — le corps qui se redresse</p></div>
<p>Amy Cuddy (Harvard) a montré que la posture modifie la biochimie : choisir une posture expansive pendant 2 minutes change le taux de cortisol et de testostérone.</p>
<p>La posture n\'est pas la conséquence de l\'état — elle en est aussi la cause.</p>
<p>Essaie : redresse-toi, ouvre ta poitrine, lève légèrement le menton. Note ce qui change en quelques secondes.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 4 — Décrire son bonheur avec précision',
                'content' => '<div style="border-left:3px solid rgba(249,115,22,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(249,115,22,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(249,115,22,.8);margin:0 0 .5rem">LEÇON 4</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Décrire son bonheur — la précision qui ancre</p></div>
<p>"Je suis heureux/heureuse" n\'ancre pas.</p>
<p>"Je me sens léger(e) dans la poitrine, ma respiration est ample, mes épaules sont basses et mes bras se sentent ouverts" — ça ancre.</p>
<p>Plus la description est précise et corporelle, plus elle devient un repère réel auquel tu peux revenir.</p>',
            ],
            [
                'type'    => 'pratique',
                'title'   => 'Pratique — Le scan des joies',
                'content' => '<div style="border-left:3px solid rgba(34,197,94,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(34,197,94,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(34,197,94,.8);margin:0 0 .5rem">PRATIQUE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Le scan des joies — retrouver les îlots de bien-être</p></div>
<p><strong>─ Protocole ─</strong></p>
<p>Étape 1 → Réécris 5 moments où tu t\'es senti(e) vraiment vivant(e).</p>
<p>Étape 2 → Pour chaque moment : décris en 2–3 phrases corporelles ce que tu ressentais.</p>
<p>Étape 3 → Identifie la ressource intérieure mobilisée dans chaque moment.</p>
<p>Étape 4 → Choisis 1 ressource et décris comment tu peux la retrouver maintenant.</p>',
            ],
            [
                'type'    => 'exercice',
                'title'   => 'Intégration — Mon manifeste du bonheur',
                'content' => '<p>Complète ces phrases de façon honnête et précise :</p>
<p>Mon bonheur ressemble physiquement à…</p>
<p>Les ressources intérieures que j\'ai identifiées sont…</p>
<p>Une situation récente où j\'ai accédé à cette joie corporelle c\'était…</p>
<p>Je peux y revenir en faisant…</p>',
            ],
            [
                'type'    => 'pratique',
                'title'   => '🌬 Pause Souffle — Respiration du bonheur (5 min)',
                'content' => '<div style="border-left:3px solid rgba(99,102,241,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(99,102,241,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(99,102,241,.8);margin:0 0 .5rem">MÉDITATION GUIDÉE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">🌬 Pause Souffle — Respiration du bonheur (5 min)</p></div>
<p><strong>Installation :</strong> Assieds-toi, les mains ouvertes sur les cuisses, paumes vers le haut. Ferme les yeux. Laisse venir un léger sourire — pas pour faire bien, juste pour activer les muscles de la joie.</p>
<p><strong>PHASE 1 — Rappel d\'une scène de bonheur (2 min)</strong><br>Rappelle une des scènes de bonheur que tu as identifiées dans ce module.<br>Vois-la en détail : où étais-tu ? Qu\'est-ce que tu voyais ? Qu\'est-ce que tu entendais ?<br>Laisse la sensation s\'installer dans le corps — poitrine, ventre, épaules.<br>C\'est là. C\'est réel. C\'est <em>toi</em>.</p>
<p><strong>PHASE 2 — Respiration ancrée dans la joie (3 min)</strong><br>Inspire 5 secondes — imagine que tu inspires cette sensation de plénitude.<br>Expire 5 secondes — laisse cette sensation se diffuser de la tête aux pieds.<br>5 cycles complets.<br>La joie n\'est pas à construire — elle est à <em>retrouver</em>. Ce souffle te relie à elle.<br><em>⏱ Durée totale : 5 min · Dans cet état, écris ta lettre à ta version heureuse.</em>',
            ],
            [
                'type'    => 'reflexion',
                'title'   => 'Lettre — À la version heureuse de moi',
                'content' => '<p>Écris une courte lettre à la version de toi qui se sent pleinement vivant(e).</p>
<p>Commence par : <em>"Quand tu es là, je remarque que mon corps…"</em></p>',
            ],
        ];

        $this->updateModule('parcours', '03-je-decris-mon-bonheur', [
            'intro_text' => "JE DÉCRIS MON BONHEUR — Mes Ressources Intérieures\n\nLe corps connaît aussi la joie, l'expansion, la légèreté.\nDécrire son bonheur avec précision est un acte de connaissance de soi.\nPas en idées — en sensations corporelles.",
            'description' => '4 leçons · Scan des joies · Ressources intérieures · Manifeste personnel. Aller aussi vers ce qui est bien en soi.',
        ], $activities);
    }

    /* ─────────────────────────────────────────────────────── MODULE 04 ─── */
    private function seedModule04(): void
    {
        $activities = [
            [
                'type'    => 'lecture',
                'title'   => 'Introduction — Le souffle, ton outil essentiel',
                'content' => '<div style="border-left:3px solid rgba(201,168,76,.9);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(201,168,76,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(201,168,76,.9);margin:0 0 .5rem">PROMESSE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Le souffle : l\'outil le plus puissant que tu possèdes</p></div>
<p>Le souffle est le seul système autonome que tu peux contrôler consciemment.</p>
<p>Cœur, digestion, hormones — tu ne peux pas les commander directement. Mais le souffle, si. Et en l\'influençant, tu influences tout le reste.</p>
<p><strong>Ce module t\'apprend à :</strong></p>
<ul>
<li>Reconnaître ton souffle naturel</li>
<li>Comprendre 3 types de respiration</li>
<li>Maîtriser 5 techniques pour réguler ton état</li>
<li>Créer ton propre protocole de souffle quotidien</li>
</ul>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 1 — Les 3 types de respiration',
                'content' => '<div style="border-left:3px solid rgba(20,184,166,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(20,184,166,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(20,184,166,.8);margin:0 0 .5rem">LEÇON 1</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Les 3 types de respiration — anatomie du souffle</p></div>
<p>① <strong>Respiration thoracique (haute)</strong> · Mouvement : poitrine monte et descend · Signal : stress, anxiété, vigilance</p>
<p>② <strong>Respiration abdominale (basse)</strong> · Mouvement : ventre se gonfle et se dégonfle · Signal : détente, récupération</p>
<p>③ <strong>Respiration complète (cohérente)</strong> · Mouvement : vague du ventre à la poitrine · Signal : équilibre nerveux, présence</p>
<p>Observe ton souffle en ce moment. Lequel est actif ?</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 2 — La cohérence cardiaque',
                'content' => '<div style="border-left:3px solid rgba(59,130,246,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(59,130,246,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(59,130,246,.8);margin:0 0 .5rem">LEÇON 2</p>
<p style="font-size:.95rem;font-weight:600;margin:0">La cohérence cardiaque — 5 minutes qui changent tout</p></div>
<p>La cohérence cardiaque est l\'état de synchronisation entre le rythme cardiaque et la respiration. Elle active la branche parasympathique du système nerveux — celle qui calme, régénère, recentre.</p>
<p><strong>Le protocole 365 :</strong></p>
<p>3 fois par jour · 6 respirations par minute · 5 secondes inspire / 5 secondes expire · pendant 5 minutes</p>
<p>Effets mesurés : réduction du cortisol, amélioration de la concentration, régulation émotionnelle.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 3 — Les 5 techniques de souffle',
                'content' => '<div style="border-left:3px solid rgba(168,85,247,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(168,85,247,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(168,85,247,.8);margin:0 0 .5rem">LEÇON 3</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Les 5 techniques — ta boîte à outils du souffle</p></div>
<p>① <strong>4-7-8 (Dr Weil)</strong> — Anti-anxiété : Inspire 4s · Retiens 7s · Expire 8s</p>
<p>② <strong>Respiration carrée</strong> — Équilibre : 4s inspire · 4s retenir · 4s expire · 4s vide</p>
<p>③ <strong>Cohérence cardiaque 5-5</strong> — Recentrage : 5s inspire · 5s expire (6 cycles/min)</p>
<p>④ <strong>Souffle de feu (Kapalabhati)</strong> — Énergie : Expirations courtes et rythmées du ventre</p>
<p>⑤ <strong>Respiration alternée (Nadi Shodhana)</strong> — Clarté mentale : Alterne narines gauche/droite</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 4 — Le souffle avec intention',
                'content' => '<div style="border-left:3px solid rgba(249,115,22,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(249,115,22,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(249,115,22,.8);margin:0 0 .5rem">LEÇON 4</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Le souffle avec intention — au-delà de la technique</p></div>
<p>Une technique sans intention est un exercice de gym. Un souffle avec intention devient une pratique de transformation.</p>
<p>L\'intention, c\'est savoir POURQUOI tu respires ainsi maintenant. "Je veux me calmer." "Je veux me centrer." "Je veux me préparer à quelque chose d\'important."</p>
<p>Pose l\'intention avant de commencer. Elle oriente l\'état que tu crées.</p>',
            ],
            [
                'type'    => 'pratique',
                'title'   => 'Pratique — Les 5 souffles en 30 minutes',
                'content' => '<div style="border-left:3px solid rgba(34,197,94,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(34,197,94,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(34,197,94,.8);margin:0 0 .5rem">PRATIQUE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Les 5 souffles en pratique — 30 minutes de terrain</p></div>
<p><strong>─ Séquence pratique ─</strong></p>
<p>① 3 min → Observation : quel est mon souffle naturel en ce moment ?</p>
<p>② 5 min → 4-7-8, 6 cycles. Note l\'effet sur ton état.</p>
<p>③ 5 min → Respiration carrée, 6 cycles. Note l\'effet.</p>
<p>④ 5 min → Cohérence cardiaque 5-5. Note l\'effet.</p>
<p>⑤ 2 min → Kapalabhati doux (20 cycles). Note l\'effet.</p>
<p>⑥ 5 min → Nadi Shodhana, 6 cycles. Note l\'effet.</p>
<p>⑦ 5 min → Retour au souffle naturel. Qu\'est-ce qui a changé ?</p>',
            ],
            [
                'type'    => 'exercice',
                'title'   => 'Intégration — Mon protocole souffle personnel',
                'content' => '<p>Construis ton protocole en répondant à ces questions :</p>
<p>La technique que j\'utilise pour me calmer rapidement : …</p>
<p>La technique que j\'utilise pour me donner de l\'énergie : …</p>
<p>La technique que j\'utilise pour me centrer avant quelque chose d\'important : …</p>
<p>Mon rituel quotidien de souffle : … (technique, durée, moment)</p>',
            ],
            [
                'type'    => 'pratique',
                'title'   => 'Pratique — Explorer le souffle conscient en binôme',
                'content' => '<p>Si tu as un proche disponible, propose-lui 5 minutes de respiration guidée.</p>
<p>Observe ce qui se passe quand tu guides quelqu\'un — et ce que cela t\'apprend sur ta propre présence.</p>
<p><em>Cette pratique est optionnelle. Elle prépare le terrain pour ceux qui souhaitent partager la méthode.</em></p>',
            ],
            [
                'type'    => 'pratique',
                'title'   => '🌬 Pause Souffle — Cohérence cardiaque guidée (5 min)',
                'content' => '<div style="border-left:3px solid rgba(34,197,94,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(34,197,94,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(34,197,94,.8);margin:0 0 .5rem">MÉDITATION GUIDÉE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">🌬 Pause Souffle — Cohérence cardiaque guidée (5 min)</p></div>
<p><strong>C\'est ce module dans sa forme la plus pure.</strong></p>
<p><strong>Installation :</strong> Assieds-toi, dos droit, mains sur les cuisses. Ferme les yeux. Tu viens de pratiquer 5 techniques. Maintenant, tu intègres.</p>
<p><strong>Cohérence cardiaque 5-5 · 5 minutes · 6 cycles par minute</strong></p>
<p><strong>Inspire 5 secondes</strong> — ventre qui se gonfle en premier, poitrine qui suit.<br><strong>Expire 5 secondes</strong> — ventre qui rentre doucement, tout le corps qui relâche.</p>
<p>Pose une intention silencieuse au début : <em>"Je calme mon système nerveux. Je crée de la cohérence."</em></p>
<p>À chaque cycle, laisse l\'attention descendre vers ton cœur. Sens les battements ralentir.<br>À chaque expiration, une pensée passe — tu ne la suis pas. Tu reviens au souffle.<br>6 cycles = 1 min. Répète 5 fois pour 5 minutes totales.</p>
<p>En ouvrant les yeux : note l\'état que tu ressens. C\'est la cohérence cardiaque — <em>ton outil, pour toujours</em>.<br><em>⏱ Durée totale : 5 min · Tu viens de pratiquer la technique la plus documentée de régulation du système nerveux.</em>',
            ],
            [
                'type'    => 'reflexion',
                'title'   => 'Lettre — Ce que le souffle m\'a appris sur moi',
                'content' => '<p>Après avoir pratiqué ces 5 techniques, écris une courte réflexion :</p>
<p>Commence par : <em>"En apprenant à maîtriser mon souffle, j\'ai découvert que je…"</em></p>',
            ],
        ];

        $this->updateModule('parcours', '04-j-ecoute-mon-souffle', [
            'intro_text' => "J'ÉCOUTE MON SOUFFLE INTÉRIEUR — La Maîtrise du Souffle\n\nLe souffle est le seul système autonome que tu peux contrôler consciemment.\nEn l'influençant, tu influences tout le reste.\n\n3 types de respiration · Cohérence cardiaque · 5 techniques · Ton protocole.",
            'description' => '4 leçons · Cohérence cardiaque · 5 techniques · Protocole personnel. Maîtriser son souffle pour réguler son état intérieur.',
        ], $activities);
    }

    /* ─────────────────────────────────────────────────────── MODULE 05 ─── */
    private function seedModule05(): void
    {
        $activities = [
            [
                'type'    => 'lecture',
                'title'   => 'Introduction — Ta mission change tout',
                'content' => '<div style="border-left:3px solid rgba(201,168,76,.9);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(201,168,76,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(201,168,76,.9);margin:0 0 .5rem">PROMESSE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Pourquoi ce module change tout</p></div>
<p>Quelqu\'un qui ne sait pas pourquoi il fait ce qu\'il fait finit par s\'épuiser.</p>
<p>Quelqu\'un qui connaît sa mission — sa vraie raison d\'être — tient sur la durée. Il agit avec clarté. Il attire naturellement ce qui lui correspond.</p>
<p><strong>Ce module t\'aide à :</strong></p>
<ul>
<li>Identifier tes valeurs profondes</li>
<li>Reconnaître tes dons naturels</li>
<li>Formuler ta mission unique en une phrase</li>
</ul>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 1 — Tes valeurs profondes',
                'content' => '<div style="border-left:3px solid rgba(20,184,166,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(20,184,166,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(20,184,166,.8);margin:0 0 .5rem">LEÇON 1</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Tes valeurs profondes — le socle de ta vie</p></div>
<p>Les valeurs ne sont pas des idéaux abstraits. Ce sont des réalités vécues dans le corps.</p>
<p>Quand tu vis en accord avec tes valeurs → légèreté, clarté, énergie.</p>
<p>Quand tu trahis tes valeurs → tension, honte, épuisement.</p>
<p>Exercice : liste 10 valeurs importantes pour toi. Puis réduis à 3. Pour chaque valeur, note : "Quand est-ce que je l\'ai vécu dans mon corps ?"</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 2 — Tes dons naturels',
                'content' => '<div style="border-left:3px solid rgba(59,130,246,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(59,130,246,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(59,130,246,.8);margin:0 0 .5rem">LEÇON 2</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Tes dons naturels — ce que tu fais sans effort</p></div>
<p>Un don naturel est une compétence qui te coûte peu d\'énergie mais qui en apporte beaucoup aux autres.</p>
<p>Souvent, on ne les voit pas car on les trouve "trop simples" — "tout le monde peut faire ça".</p>
<p>Non. Ce sont tes dons propres.</p>
<p>Demande à 3 personnes proche de toi : "À quoi je suis naturellement doué(e) selon toi ?"</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 3 — L\'Ikigai — ta raison d\'être',
                'content' => '<div style="border-left:3px solid rgba(168,85,247,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(168,85,247,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(168,85,247,.8);margin:0 0 .5rem">LEÇON 3</p>
<p style="font-size:.95rem;font-weight:600;margin:0">L\'Ikigai — l\'intersection de ta raison d\'être</p></div>
<p>L\'Ikigai japonais : la raison d\'être se trouve à l\'intersection de 4 cercles.</p>
<p>① Ce que tu aimes faire · ② Ce dans quoi tu es doué(e) · ③ Ce dont le monde a besoin · ④ Ce pour quoi tu peux être reconnu(e)</p>
<p>L\'Ikigai n\'est pas forcément professionnel. Il peut être dans ta façon d\'être, de créer, d\'accompagner naturellement les gens autour de toi.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 4 — La mission ancrée dans le corps',
                'content' => '<div style="border-left:3px solid rgba(249,115,22,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(249,115,22,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(249,115,22,.8);margin:0 0 .5rem">LEÇON 4</p>
<p style="font-size:.95rem;font-weight:600;margin:0">La mission ancrée dans le corps — pas dans la tête</p></div>
<p>Une mission intellectuelle ne résiste pas aux jours difficiles. Une mission ancrée dans le corps — ressentie, reconnue physiquement — tient.</p>
<p>Comment tester si ta mission est juste : quand tu la penses, ton corps s\'ouvre ou se ferme ?</p>
<p>Légèreté = alignement. Oppression = pas encore la bonne formulation.</p>',
            ],
            [
                'type'    => 'pratique',
                'title'   => 'Pratique — L\'exercice Ikigai en 4 étapes',
                'content' => '<div style="border-left:3px solid rgba(34,197,94,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(34,197,94,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(34,197,94,.8);margin:0 0 .5rem">PRATIQUE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">L\'exercice Ikigai en 4 étapes — 45 minutes</p></div>
<p><strong>─ Séquence ─</strong></p>
<p>Étape 1 (10 min) → Liste 10 choses que tu aimes vraiment faire. Pas ce que tu devrais aimer — ce qui te met réellement en vie.</p>
<p>Étape 2 (10 min) → Liste 5–7 dons naturels reconnus par toi et les autres.</p>
<p>Étape 3 (10 min) → Liste 3–5 besoins du monde auxquels tu te sens appelé(e) à répondre.</p>
<p>Étape 4 (15 min) → Cherche les intersections. Formule une phrase-mission.</p>',
            ],
            [
                'type'    => 'exercice',
                'title'   => 'Intégration — Ma mission en une phrase',
                'content' => '<p>Structure de la phrase :</p>
<p>"Je suis là pour [contribution] · à travers [mes dons] · pour que [impact/transformation]."</p>
<p>Exemples :</p>
<ul>
<li>"Je suis là pour créer de la beauté à travers les mots pour que les gens se sentent moins seuls."</li>
<li>"Je suis là pour apporter de la clarté à travers l\'écoute pour que les autres trouvent leur propre chemin."</li>
</ul>
<p>Écris ta version. Teste-la dans ton corps. Ajuste jusqu\'à ce qu\'elle sonne juste.</p>',
            ],
            [
                'type'    => 'pratique',
                'title'   => '🌬 Pause Souffle — Souffle de mission (7 min)',
                'content' => '<div style="border-left:3px solid rgba(168,85,247,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(168,85,247,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(168,85,247,.8);margin:0 0 .5rem">MÉDITATION GUIDÉE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">🌬 Pause Souffle — Souffle de mission (7 min)</p></div>
<p><strong>Installation :</strong> Assieds-toi, pose une main sur le cœur. Ferme les yeux.</p>
<p><strong>PHASE 1 — Centrage (2 min)</strong><br>Inspiration 5s — expiration 7s. 4 cycles. Laisse le corps s\'apaiser.<br>Dis intérieurement : <em>"Je me centre. Je suis prêt(e) à entendre."</em></p>
<p><strong>PHASE 2 — Ancrer la mission dans le corps (4 min)</strong><br>Rappelle la phrase-mission que tu as formulée dans ce module.<br>Si elle n\'est pas encore parfaite, utilise une version approchante.<br>Dis-la intérieurement — doucement — à chaque inspiration :<br><em>"Je suis là pour… à travers… pour que…"</em><br>Laisse résonner. Que ressens-tu dans le corps en la disant ?<br>Légèreté → alignement. Résistance → garde-la quand même, elle s\'affinera.<br>4 cycles, inspirant la phrase, expirant ce qui résiste.</p>
<p><strong>PHASE 3 — Engager (1 min)</strong><br>Inspiration profonde. En expirant, pose intérieurement :<br><em>"Je choisis d\'agir depuis cette mission — maintenant, et chaque jour."</em><br>Une dernière respiration. Ouvre les yeux.<br><em>⏱ Durée totale : 7 min · Ta mission n\'est pas une idée. C\'est une direction que tu viens d\'ancrer dans ton corps.</em>',
            ],
            [
                'type'    => 'reflexion',
                'title'   => 'Lettre — À la personne que j\'aide naturellement',
                'content' => '<p>Écris une lettre courte à la personne à qui tu contribues naturellement dans ta vie.</p>
<p>Commence par : <em>"Ce que j\'espère t\'apporter quand je suis vraiment moi, c\'est…"</em></p>',
            ],
        ];

        $this->updateModule('parcours', '05-je-decouvre-ma-mission', [
            'intro_text' => "JE DÉCOUVRE MA MISSION UNIQUE — Ma Raison d'Être\n\nConnaître sa mission, c'est tenir sur la durée.\nC'est choisir une direction qui nous ressemble vraiment.\n\nValeurs profondes · Dons naturels · Ikigai · Mission en une phrase.",
            'description' => '4 leçons · Valeurs · Dons naturels · Ikigai personnel · Mission en une phrase. Découvrir sa raison d\'être profonde.',
        ], $activities);
    }

    /* ─────────────────────────────────────────────────────── MODULE 06 ─── */
    private function seedModule06(): void
    {
        $activities = [
            [
                'type'    => 'lecture',
                'title'   => 'Introduction — La vision qui prend tenue',
                'content' => '<div style="border-left:3px solid rgba(201,168,76,.9);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(201,168,76,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(201,168,76,.9);margin:0 0 .5rem">PROMESSE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Ce module donne à votre vision une tenue intérieure</p></div>
<p>Vous avez appris à écouter votre corps, à reconnaître vos blessures, à sentir ce qui vous rend vivant·e, à rencontrer votre souffle, à entendre votre mission.</p>
<p>Il reste maintenant une question plus exigeante que l\'inspiration elle-même : comment faire d\'une vision une direction suffisamment juste pour qu\'elle change réellement une vie ?</p>
<p>Ce module n\'est ni un collage d\'intentions, ni un exercice de pensée positive. C\'est un travail de justesse intérieure.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 1 — La vision incarnée',
                'content' => '<div style="border-left:3px solid rgba(20,184,166,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(20,184,166,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(20,184,166,.8);margin:0 0 .5rem">LEÇON 1</p>
<p style="font-size:.95rem;font-weight:600;margin:0">La vision incarnée — une direction qui se laisse habiter</p></div>
<p>Une vraie vision n\'est pas une liste d\'envies. C\'est une scène intérieure suffisamment précise pour que le corps la reconnaisse.</p>
<p>Une vision incarnée, ça ressemble à quoi ? Vous pouvez la décrire en sensations corporelles, pas seulement en mots.</p>
<p>"Quand je pense à cette vie, je ressens… dans ma poitrine. Mes épaules sont… Ma respiration devient…"</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 2 — L\'obstacle intérieur',
                'content' => '<div style="border-left:3px solid rgba(59,130,246,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(59,130,246,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(59,130,246,.8);margin:0 0 .5rem">LEÇON 2</p>
<p style="font-size:.95rem;font-weight:600;margin:0">L\'obstacle intérieur — ce qui dévie la trajectoire sans bruit</p></div>
<p>Penser positivement ne suffit pas. Quand une vision reste lointaine, instable ou inaccessible — il y a souvent un obstacle intérieur non nommé.</p>
<p>Ce peut être une croyance, une peur, une loyauté inconsciente, une blessure ancienne que vous avez rencontrée dans le module 02.</p>
<p>Nommer l\'obstacle n\'est pas pessimiste. C\'est honnête — et c\'est ce qui permet de le traverser.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 3 — Des images aux preuves',
                'content' => '<div style="border-left:3px solid rgba(168,85,247,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(168,85,247,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(168,85,247,.8);margin:0 0 .5rem">LEÇON 3</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Des images aux preuves — installer la crédibilité intérieure</p></div>
<p>Une vision devient crédible quand elle commence à laisser des traces dans la réalité.</p>
<p>Petites preuves = grandes ancrages. Chaque action alignée avec ta vision — même minuscule — est une preuve que cette direction est possible pour toi.</p>
<p>Ton cerveau a besoin de preuves pour y croire. Commence par en produire une aujourd\'hui.</p>',
            ],
            [
                'type'    => 'pratique',
                'title'   => 'Pratique — Le protocole 5-5-5 vision, obstacle, action',
                'content' => '<div style="border-left:3px solid rgba(34,197,94,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(34,197,94,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(34,197,94,.8);margin:0 0 .5rem">PRATIQUE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Le protocole Pause Souffle 5-5-5 — Clarifier, rencontrer, ancrer</p></div>
<p>Vous connaissez déjà le souffle 5-5-5. Ici, vous l\'utilisez pour relier votre vision à votre corps.</p>
<p><strong>─ Séquence ─</strong></p>
<p>① 5 min de souffle 5-5 → Centrage. Posez l\'intention : "Je veux voir ma vision clairement."</p>
<p>② 5 min → Visualisation incarnée : décrivez la scène dans votre corps (pas dans votre tête).</p>
<p>③ 5 min → Nommez l\'obstacle intérieur. Respirez dessus. Puis posez la première action concrète.</p>',
            ],
            [
                'type'    => 'exercice',
                'title'   => 'Mission — 7 jours pour donner de la tenue à ma vision',
                'content' => '<p>Votre mission n\'est pas de rêver plus fort.</p>
<p>Votre mission est de rendre votre vision crédible — en produisant une preuve par jour pendant 7 jours.</p>
<p><strong>Structure :</strong></p>
<p>Jour 1–7 : Chaque soir, notez <strong>une action</strong> que vous avez faite dans la direction de votre vision.</p>
<p>Aussi petite soit-elle, une action alignée = une preuve intérieure.</p>
<p>Au bout de 7 jours : relisez. Que voyez-vous ?</p>',
            ],
            [
                'type'    => 'pratique',
                'title'   => '🌬 Pause Souffle — Incarnation de la vision (8 min)',
                'content' => '<div style="border-left:3px solid rgba(249,115,22,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(249,115,22,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(249,115,22,.8);margin:0 0 .5rem">MÉDITATION GUIDÉE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">🌬 Pause Souffle — Incarnation de la vision (8 min)</p></div>
<p><strong>Installation :</strong> Assieds-toi ou allonge-toi. Bras le long du corps, paumes vers le haut. Ferme les yeux.</p>
<p><strong>PHASE 1 — Centrage (2 min)</strong><br>Inspiration 5s — expiration 5s. 4 cycles. Laisse toutes les pensées sur la vision, les obstacles, les plans — les poser de côté pour l\'instant.<br>Tu n\'es plus en train d\'analyser. Tu es en train de <em>ressentir</em>.</p>
<p><strong>PHASE 2 — Entrer dans la scène (4 min)</strong><br>Rappelle ta vision — non pas comme une liste de choses à atteindre, mais comme une <strong>scène de vie déjà vécue</strong>.<br>Où es-tu dans cette scène ? Quel est l\'espace autour de toi ?<br>Que vois-tu ? Que sens-tu physiquement — lumière, température, texture ?<br>Qui est là avec toi, ou quelle est la qualité de la solitude ?<br><br>À chaque inspiration, entre un peu plus dans cette scène.<br>À chaque expiration, note dans le corps : légèreté, expansion, chaleur dans le sternum — ou résistance, contraction, doute.<br>Ni bon, ni mauvais. Juste <em>vrai</em>.<br><br>Reste dans la scène. Respire depuis l\'intérieur de cette vie.</p>
<p><strong>PHASE 3 — Identité (2 min)</strong><br>Sans quitter la scène, pose intérieurement :<br><em>"Qui suis-je, dans cette vie ?"</em><br>Laisse venir une réponse en une phrase. Pas réfléchie — ressentie.<br>Inspiration profonde. Expiration longue.<br>Dis intérieurement : <em>"Je suis déjà en chemin."</em><br>Trois respirations. Ouvre les yeux lentement.<br><em>⏱ Durée totale : 8 min · Ce n\'est pas un rêve. C\'est une direction. Elle est déjà en toi.</em>',
            ],
        ];

        $this->updateModule('parcours', '06-je-visualise-ma-vie', [
            'intro_text' => "J'INCARNE MA VISION — Clarté, Courage & Direction\n\nVous avez appris à écouter votre corps, à reconnaître vos blessures,\nà sentir ce qui vous rend vivant·e, à maîtriser votre souffle, à entendre votre mission.\n\nIl reste maintenant une question : comment faire d'une vision une direction qui tient réellement ?",
            'description' => '3 leçons · Vision incarnée · Obstacle intérieur · Protocole 5-5-5 · Mission 7 jours. Transformer une vision en direction durable.',
        ], $activities);
    }

    /* ─────────────────────────────────────────────── Méthode helper ─────── */
    private function updateModule(string $track, string $slug, array $fields, array $activities): void
    {
        $data = array_merge($fields, [
            'activities'  => json_encode($activities, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT),
            'updated_at'  => now(),
        ]);

        $updated = DB::table('formation_modules')
            ->where('track', $track)
            ->where('slug', $slug)
            ->update($data);

        $this->command->info("  [$track] $slug → " . ($updated ? 'mis à jour' : '⚠️  non trouvé'));
    }
}
