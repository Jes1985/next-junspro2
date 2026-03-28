<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Contenu PROFESSIONNEL pour les modules 01–06 de la Formation (track praticien)
 * Orienté : devenir praticien Pause Souffle — transmission, posture professionnelle, accompagnement client.
 */
class FormationProContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedModule01();
        $this->seedModule02();
        $this->seedModule03();
        $this->seedModule04();
        $this->seedModule05();
        $this->seedModule06();

        $this->command->info('[FormationProContentSeeder] Contenus pro Formation 01–06 mis à jour.');
    }

    /* ─────────────────────────────────────────────────────── MODULE 01 ─── */
    private function seedModule01(): void
    {
        $activities = [
            [
                'type'    => 'lecture',
                'title'   => 'Introduction — Pourquoi se rencontrer avant d\'accompagner',
                'content' => '<div style="border-left:3px solid rgba(201,168,76,.9);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(201,168,76,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(201,168,76,.9);margin:0 0 .5rem">PROMESSE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Ce que ce module t\'apprend</p></div>
<p>Ce module n\'est pas un test psychologique. Ce n\'est pas une thérapie.</p>
<p>C\'est le point de départ de toute pratique professionnelle sérieuse.</p>
<p><strong>Avant d\'accompagner quelqu\'un, tu dois avoir fait ce voyage toi-même.</strong></p>
<p>Un praticien qui ne s\'est pas rencontré projette. Un praticien qui se connaît — écoute vraiment.</p>
<ul>
<li>Développer une écoute intérieure fine — le premier outil du praticien</li>
<li>Distinguer ses propres sensations de celles du client</li>
<li>Établir la posture d\'observation neutre qui fonde la pratique</li>
</ul>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 1 — L\'écoute de soi, premier outil du praticien',
                'content' => '<div style="border-left:3px solid rgba(20,184,166,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(20,184,166,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(20,184,166,.8);margin:0 0 .5rem">LEÇON 1</p>
<p style="font-size:.95rem;font-weight:600;margin:0">L\'écoute de soi — le premier outil du praticien</p></div>
<p>La plupart des gens vivent dans leur tête. Un praticien Pause Souffle vit dans son corps.</p>
<p>L\'écoute de soi, c\'est la capacité à percevoir instantanément ton propre état interne — et à ne pas le confondre avec ce que vit ton client.</p>
<p><strong>Les 2 registres du praticien :</strong></p>
<ul>
<li>Registre interne : Qu\'est-ce que je ressens, moi, maintenant ?</li>
<li>Registre externe : Qu\'est-ce que j\'observe chez l\'autre ?</li>
</ul>
<p>Ne jamais mélanger ces deux registres est la base de la pratique éthique.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 2 — Les signaux du corps comme instrument de lecture',
                'content' => '<div style="border-left:3px solid rgba(59,130,246,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(59,130,246,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(59,130,246,.8);margin:0 0 .5rem">LEÇON 2</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Les signaux du corps — instrument de lecture du praticien</p></div>
<p>Le corps du praticien est un instrument de lecture du client. Quand tu ressens une contraction pendant une séance — est-ce le tien ou le reflet de celui du client ?</p>
<p>Cette compétence s\'apprend par la pratique régulière de l\'auto-observation.</p>
<p><strong>3 types de signaux à maîtriser :</strong></p>
<ul>
<li><strong>Résonance</strong> → ton corps "répond" à celui du client (empathie somatique)</li>
<li><strong>Projection</strong> → ton propre état non réglé s\'exprime</li>
<li><strong>Intuition</strong> → un signal clair, sans contexte émotionnel chargé</li>
</ul>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 3 — Les émotions du praticien pendant la séance',
                'content' => '<div style="border-left:3px solid rgba(168,85,247,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(168,85,247,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(168,85,247,.8);margin:0 0 .5rem">LEÇON 3</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Les émotions du praticien pendant la séance</p></div>
<p>Pendant une séance, tu peux ressentir des émotions. C\'est normal. La question est : que fais-tu avec ?</p>
<p><strong>Règle d\'or :</strong> Une émotion perçue pendant une séance informe. Elle ne s\'exprime pas.</p>
<p>Tu l\'accueilles. Tu l\'identifies. Tu l\'utilises comme signal — pas comme réaction.</p>
<p>Joie → le client est en expansion → accompagne le mouvement.<br>
Résistance → quelque chose se ferme → ralentis, respecte le rythme.<br>
Malaise → une limite est approchée → arrête et reformule.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 4 — Le miroir intérieur du praticien',
                'content' => '<div style="border-left:3px solid rgba(249,115,22,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(249,115,22,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(249,115,22,.8);margin:0 0 .5rem">LEÇON 4</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Le miroir intérieur — la compétence la plus rare</p></div>
<p>L\'auto-observation n\'est pas de l\'égocentrisme. C\'est la compétence la plus rare d\'un praticien corporel.</p>
<p>Observer → nommer → ne pas réagir → choisir la réponse.</p>
<p>Cette séquence est ce qui distingue une pratique professionnelle d\'une intervention émotionnelle non maîtrisée.</p>
<p>Elle se développe par la supervision, la pratique personnelle régulière, et l\'auto-débrief après chaque séance.</p>',
            ],
            [
                'type'    => 'pratique',
                'title'   => 'Pratique — Le scan corporel du praticien',
                'content' => '<div style="border-left:3px solid rgba(34,197,94,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(34,197,94,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(34,197,94,.8);margin:0 0 .5rem">PRATIQUE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Le scan corporel du praticien — avant chaque séance</p></div>
<p>Ce protocole de 5 minutes se pratique avant chaque séance client.</p>
<p><strong>─ Protocole ─</strong></p>
<p>Min 1 : 3 respirations profondes. Je me centre.</p>
<p>Min 2 : Scan du bas vers le haut. Je note mon état réel (pas l\'état idéal).</p>
<p>Min 3 : J\'identifie toute tension ou perturbation. Je lui donne un nom.</p>
<p>Min 4 : Je "pose" cet état en dehors de la séance. Pas nié — mis de côté temporairement.</p>
<p>Min 5 : Intent de la séance. Qu\'est-ce que j\'apporte ? Présence. Sécurité. Clarté.</p>',
            ],
            [
                'type'    => 'exercice',
                'title'   => 'Outil pro — Le journal de bord du praticien',
                'content' => '<div style="border-left:3px solid rgba(99,102,241,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(99,102,241,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(99,102,241,.8);margin:0 0 .5rem">OUTIL PRO</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Le journal de bord du praticien — auto-débrief post-séance</p></div>
<p>Après chaque séance client, 5 minutes :</p>
<p>Q1 → Qu\'est-ce que j\'ai ressenti pendant la séance ?</p>
<p>Q2 → Était-ce le mien ou le reflet du client ?</p>
<p>Q3 → Y a-t-il eu un moment où j\'ai perdu ma neutralité ?</p>
<p>Q4 → Qu\'est-ce que je ferai différemment la prochaine fois ?</p>',
            ],
            [
                'type'    => 'exercice',
                'title'   => 'Intégration — Mon portrait corporel en tant que praticien',
                'content' => '<p>Réalise un bilan de ton état corporel actuel en tant que praticien en formation.</p>
<p>Zone de force : quelle zone de ton corps exprime ta présence, ton calme, ta solidité ?</p>
<p>Zone de vigilance : quelle zone porte encore quelque chose que tu devras surveiller pendant les séances ?</p>
<p>Ce portrait évolue. Note-le. Reviens-y dans 30 jours.</p>',
            ],
            [
                'type'    => 'reflexion',
                'title'   => 'Lettre — À la personne que je vais accompagner',
                'content' => '<p>Prends 10 minutes pour écrire une lettre à ton futur client.</p>
<p>Commence par : <em>"Quand tu seras en face de moi, ce que je veux t\'apporter c\'est… Ce que je m\'engage à être pour toi c\'est…"</em></p>',
            ],
        ];

        $this->updateModule('praticien', '01-je-me-rencontre', [
            'intro_text' => "JE ME RENCONTRE — Le Voyage Intérieur du Praticien\n\nAvant d'accompagner quelqu'un, tu dois avoir fait ce voyage toi-même.\nSe rencontrer, s'observer, reconnaître ses signaux corporels.\nPas une thérapie. Un rendez-vous avec soi — pour mieux être là pour l'autre.\n\nCette formation n'est pas née dans une bibliothèque. Elle est née de quelqu'un qui a cherché à comprendre depuis l'intérieur — en vivant ce qu'elle décrit, en portant les questions jusqu'à trouver les réponses. Accompagner les autres depuis ce qu'on a traversé soi-même — c'est ce qui fonde une pratique vraie. Le savoir et l'expérience vécue ne sont pas opposés. Souvent, l'un naît de l'autre.",
            'description' => '4 leçons · Scan corporel du praticien · Journal post-séance · Portrait corporel professionnel. L\'auto-connaissance comme fondation de la pratique.',
        ], $activities);
    }

    /* ─────────────────────────────────────────────────────── MODULE 02 ─── */
    private function seedModule02(): void
    {
        $activities = [
            [
                'type'    => 'lecture',
                'title'   => 'Introduction — Le corps qui se souvient, leçon pour le praticien',
                'content' => '<div style="border-left:3px solid rgba(201,168,76,.9);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(201,168,76,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(201,168,76,.9);margin:0 0 .5rem">PROMESSE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Ce que ce module t\'apprend en tant que praticien</p></div>
<p>Le corps se souvient de tout. Le tien d\'abord — et celui de tes clients ensuite.</p>
<p>Ce module te donne les clés pour reconnaître les blessures corporelles, respecter le rythme de l\'autre, et ne jamais forcer ce que le temps doit prendre.</p>
<p>Reconnaître sans rouvrir : c\'est l\'éthique du praticien Pause Souffle.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 1 — Les 5 blessures fondamentales',
                'content' => '<div style="border-left:3px solid rgba(20,184,166,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(20,184,166,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(20,184,166,.8);margin:0 0 .5rem">LEÇON 1</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Les 5 blessures fondamentales — ce que le corps de ton client porte</p></div>
<p>Ces 5 blessures universelles (Lise Bourbeau, enrichies par la recherche somatique) se manifestent corporellement :</p>
<ol>
<li><strong>Le rejet</strong> → corps replié, épaules en avant, regard fuyant</li>
<li><strong>L\'abandon</strong> → hypotonicité, affaissement, voix peu portée</li>
<li><strong>L\'humiliation</strong> → ventre rentré, épaules basses, retenue du souffle</li>
<li><strong>La trahison</strong> → mâchoire serrée, tensions cervicales, hypervigilance</li>
<li><strong>L\'injustice</strong> → rigidité, tensions diffuses, perfectionnisme corporel</li>
</ol>
<p>Ces patterns sont des pistes — jamais des diagnostics. Le praticien observe, accompagne, ne plaque pas d\'étiquettes.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 2 — La mémoire du corps — ce que la recherche enseigne',
                'content' => '<div style="border-left:3px solid rgba(59,130,246,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(59,130,246,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(59,130,246,.8);margin:0 0 .5rem">LEÇON 2</p>
<p style="font-size:.95rem;font-weight:600;margin:0">La mémoire du corps — ce que la recherche enseigne</p></div>
<p>Peter Levine (Waking the Tiger), Bessel van der Kolk (Le corps n\'oublie rien), Wilhelm Reich : tous confirment que les expériences non intégrées restent encodées dans les tensions corporelles.</p>
<p>Pour le praticien, cette connaissance est un outil de lecture — pas d\'interprétation.</p>
<p>Tu observes un pattern. Tu l\'accompagnes avec le souffle et la présence. Tu ne psychanalyses pas.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 3 — Les armures corporelles — lire sans décoder',
                'content' => '<div style="border-left:3px solid rgba(168,85,247,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(168,85,247,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(168,85,247,.8);margin:0 0 .5rem">LEÇON 3</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Les armures corporelles — lire sans décoder</p></div>
<p>Wilhelm Reich : les armures musculaires sont des protections qui deviennent des prisons.</p>
<p>Ton rôle en tant que praticien : créer un espace de sécurité où l\'armure peut se déposer — jamais la forcer.</p>
<p>La règle d\'or : la sécurité précède l\'ouverture. Un client qui ne se sent pas en sécurité ne peut pas lâcher prises.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 4 — La posture éthique face à la blessure du client',
                'content' => '<div style="border-left:3px solid rgba(249,115,22,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(249,115,22,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(249,115,22,.8);margin:0 0 .5rem">LEÇON 4</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Posture éthique — accompagner sans plonger</p></div>
<p>La blessure reconnue perd déjà une partie de son emprise.</p>
<p>Règle d\'or du praticien face à la blessure d\'un client :</p>
<ul>
<li>Observer sans absorber</li>
<li>Valider sans interpréter</li>
<li>Proposer le souffle — jamais la solution</li>
</ul>
<p>Si un client pleure, tremble ou s\'effondre : ta présence calme est le premier soin. Le souffle est le deuxième. Les mots sont le troisième.</p>',
            ],
            [
                'type'    => 'pratique',
                'title'   => 'Pratique — Cartographie des tensions émotionnelles',
                'content' => '<div style="border-left:3px solid rgba(34,197,94,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(34,197,94,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(34,197,94,.8);margin:0 0 .5rem">PRATIQUE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Cartographie des tensions — exercice praticien</p></div>
<p><strong>Étape 1 ─</strong> Fais une cartographie de TES propres tensions (comme dans le Parcours). C\'est ton point de départ professionnel.</p>
<p><strong>Étape 2 ─</strong> Simule une lecture du corps d\'un client fictif que tu as déjà accompagné ou imaginé. Dessine sa cartographie hypothétique.</p>
<p><strong>Étape 3 ─</strong> Identifie les zones de résonance (où vos tensons se rencontrent). Ce sont tes zones de vigilance professionnelle.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Sécurité praticien — Les limites de la pratique Pause Souffle',
                'content' => '<div style="border-left:3px solid rgba(239,68,68,.7);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(239,68,68,.05);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(239,68,68,.7);margin:0 0 .5rem">SÉCURITÉ PRATICIEN</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Ce que tu ne feras jamais avec les blessures d\'un client</p></div>
<p>⛔ Ne pas rouvrir une blessure sans filet.</p>
<p>⛔ Ne pas forcer une confrontation que le client ne demande pas.</p>
<p>⛔ Ne pas analyser ni diagnostiquer — ce n\'est pas ton rôle.</p>
<p>✅ Si un client pleure : accueille. Respire avec lui. Reste présent.</p>
<p>✅ Si l\'intensité est trop forte : utilise le souffle 5-5-5 pour recentrer.</p>
<p>✅ Si tu sens que la situation dépasse la pratique : oriente vers un professionnel de santé.</p>',
            ],
            [
                'type'    => 'exercice',
                'title'   => 'Intégration — Ma carte des blessures reconnues (praticien)',
                'content' => '<p>Sur ta cartographie personnelle, entoure les zones liées aux 5 blessures que tu as déjà traversées toi-même.</p>
<p>Ces zones sont tes zones de résonance professionnelle. Là où tu seras le plus sensible — et potentiellement le plus utile.</p>
<p>Écris une phrase par zone : "Ici, j\'ai vécu… — ce qui me permet maintenant de reconnaître chez les autres…"</p>',
            ],
            [
                'type'    => 'reflexion',
                'title'   => 'Lettre — À la blessure que j\'ai traversée',
                'content' => '<p>Écris une lettre à la blessure que tu as le mieux travaillée dans ta propre vie.</p>
<p>Commence par : <em>"C\'est parce que je t\'ai rencontrée que je peux aujourd\'hui être là pour quelqu\'un qui vit quelque chose de similaire. Tu m\'as appris…"</em></p>',
            ],
        ];

        $this->updateModule('praticien', '02-je-reconnais-mes-blessures', [
            'intro_text' => "JE RECONNAIS MES BLESSURES — La Mémoire Corporelle\n\nLe corps se souvient de tout. Le tien — et celui de tes clients.\nCe module apprend à reconnaître — pas à rouvrir.\nLa posture éthique du praticien face aux blessures de l'autre.",
            'description' => '4 leçons · Cartographie des tensions · Sécurité praticien · Intégration. Comprendre la mémoire du corps pour mieux accompagner.',
        ], $activities);
    }

    /* ─────────────────────────────────────────────────────── MODULE 03 ─── */
    private function seedModule03(): void
    {
        $activities = [
            [
                'type'    => 'lecture',
                'title'   => 'Introduction — Ancrer le bien-être pour le transmettre',
                'content' => '<div style="border-left:3px solid rgba(201,168,76,.9);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(201,168,76,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(201,168,76,.9);margin:0 0 .5rem">PROMESSE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Ce que ce module t\'apprend en tant que praticien</p></div>
<p>La plupart des formations de praticiens passent tout leur temps sur les problèmes. La Formation Pause Souffle fait le choix inverse : ancrer d\'abord le bien-être, les ressources, ce qui fonctionne.</p>
<p>Pour transmettre à un client l\'expérience du bonheur corporel, tu dois l\'avoir vécu toi-même — et savoir le guider vers ce ressenti.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 1 — Les états ressources du praticien et du client',
                'content' => '<div style="border-left:3px solid rgba(20,184,166,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(20,184,166,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(20,184,166,.8);margin:0 0 .5rem">LEÇON 1</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Les états ressources — ton outil de guidance</p></div>
<p>Un état ressource est un état interne positif (calme, confiance, joie, expansion) que tu peux aider le client à retrouver et ancrer grâce au souffle.</p>
<p>En tant que praticien, tu dois d\'abord connaître tes propres états ressources pour pouvoir guider le client vers les siens.</p>
<p>La question clé : "Quel est l\'état de bien-être que ce client cherche à retrouver ?" C\'est lui, pas toi, qui le définit.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 2 — Les ressources intérieures du client',
                'content' => '<div style="border-left:3px solid rgba(59,130,246,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(59,130,246,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(59,130,246,.8);margin:0 0 .5rem">LEÇON 2</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Les ressources intérieures du client — les révéler, pas les inventer</p></div>
<p>Ton rôle n\'est pas d\'apporter les ressources au client. C\'est de l\'aider à reconnaître celles qu\'il a déjà — souvent enfouies sous la tension, la fatigue, l\'habitude de souffrir.</p>
<p>Technique clé du praticien : demander "Dis-moi un moment de ta vie où tu t\'es senti(e) vraiment vivant(e)" — puis guider la description corporelle de ce souvenir.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 3 — La posture corporelle comme outil thérapeutique',
                'content' => '<div style="border-left:3px solid rgba(168,85,247,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(168,85,247,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(168,85,247,.8);margin:0 0 .5rem">LEÇON 3</p>
<p style="font-size:.95rem;font-weight:600;margin:0">La posture — outil d\'accompagnement actif</p></div>
<p>Amy Cuddy (Harvard) : la posture modifie la biochimie. En tant que praticien, tu peux inviter ton client à adopter une posture d\'expansion pour modifier son état interne.</p>
<p>C\'est un outil d\'intervention simple et puissant — utilisable dans les 2 premières minutes d\'une séance pour créer un espace d\'ouverture.</p>
<p>Protocole praticien : "Je t\'invite à redresser légèrement la colonne, ouvrir légèrement les bras, respirer dans cette ouverture."</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 4 — Guider la description précise du bien-être',
                'content' => '<div style="border-left:3px solid rgba(249,115,22,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(249,115,22,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(249,115,22,.8);margin:0 0 .5rem">LEÇON 4</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Guider la description précise du bien-être</p></div>
<p>Le praticien ne se contente pas de demander "comment tu vas". Il guide une description corporelle précise.</p>
<p>"Décris ce ressenti dans ton corps — quelle zone, quelle sensation, quelle qualité ?"</p>
<p>Plus la description est précise, plus l\'ancrage est profond. Le langage corporel précis est l\'outil de consolidation du changement.</p>',
            ],
            [
                'type'    => 'pratique',
                'title'   => 'Pratique — Le scan des joies du praticien',
                'content' => '<div style="border-left:3px solid rgba(34,197,94,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(34,197,94,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(34,197,94,.8);margin:0 0 .5rem">PRATIQUE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Le scan des joies — ancrer pour transmettre</p></div>
<p><strong>Phase 1 : Pour toi (praticien)</strong></p>
<p>Réécris 5 moments où tu t\'es senti(e) vraiment vivant(e). Décris-les en sensations corporelles.</p>
<p><strong>Phase 2 : Pour la pratique</strong></p>
<p>Entraîne-toi à guider un proche dans cette même exploration. Utilise les questions : "Décris où tu le sens dans le corps.", "Quelle qualité a cette sensation ?"</p>',
            ],
            [
                'type'    => 'exercice',
                'title'   => 'Intégration — Mon manifeste du bien-être praticien',
                'content' => '<p>Complète ces phrases :</p>
<p>L\'état de bien-être que j\'apporte à mes clients ressemble corporellement à…</p>
<p>La ressource intérieure que je transmets le plus naturellement c\'est…</p>
<p>La phrase que j\'utiliserai pour guider un client vers ses ressources : "…"</p>',
            ],
            [
                'type'    => 'reflexion',
                'title'   => 'Lettre — À la version de moi qui aide naturellement',
                'content' => '<p>Écris une courte lettre à la version de toi qui accompagne quelqu\'un vers son propre bien-être.</p>
<p>Commence par : <em>"Quand je suis dans ma pleine présence de praticien, je sens dans mon corps… et ce que j\'apporte à l\'autre c\'est…"</em></p>',
            ],
        ];

        $this->updateModule('praticien', '03-je-decris-mon-bonheur', [
            'intro_text' => "JE DÉCRIS MON BONHEUR — Les Ressources Intérieures\n\nLe corps connaît aussi la joie, l'expansion, la légèreté.\nDécrire son bonheur avec précision est un acte de connaissance de soi — et un outil d'accompagnement.\nPas en idées — en sensations corporelles.",
            'description' => '4 leçons · Scan des joies · Ressources du client · Posture d\'accompagnement. Ancrer le bien-être pour le transmettre.',
        ], $activities);
    }

    /* ─────────────────────────────────────────────────────── MODULE 04 ─── */
    private function seedModule04(): void
    {
        $activities = [
            [
                'type'    => 'lecture',
                'title'   => 'Introduction — Le souffle, outil principal du praticien',
                'content' => '<div style="border-left:3px solid rgba(201,168,76,.9);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(201,168,76,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(201,168,76,.9);margin:0 0 .5rem">PROMESSE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Le souffle : l\'outil le plus puissant du praticien</p></div>
<p>Le souffle est le seul système autonome que tu peux contrôler consciemment.</p>
<p>En tant que praticien, le souffle est ton outil principal — pour toi et pour le client.</p>
<p><strong>Ce module te forme à :</strong></p>
<ul>
<li>Maîtriser 5 techniques de souffle sur toi-même</li>
<li>Guider un client dans chaque technique</li>
<li>Construire le protocole souffle d\'une séance type</li>
<li>Lire les signaux du souffle du client pendant la séance</li>
</ul>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 1 — Les 3 types de respiration — lecture diagnostique',
                'content' => '<div style="border-left:3px solid rgba(20,184,166,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(20,184,166,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(20,184,166,.8);margin:0 0 .5rem">LEÇON 1</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Les 3 types de respiration — lecture diagnostique</p></div>
<p>Dès l\'arrivée du client, observe son souffle avant de parler. C\'est le premier diagnostic.</p>
<p>① <strong>Thoracique (haute)</strong> → client stressé, hyperactif · Action : guider vers l\'abdominale d\'abord</p>
<p>② <strong>Abdominale (basse)</strong> → client détendu, ancré · Situation : idéale pour aller plus loin</p>
<p>③ <strong>Complète (cohérente)</strong> → client équilibré, présent · Situation : prêt pour un travail profond</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 2 — La cohérence cardiaque — protocole d\'ouverture',
                'content' => '<div style="border-left:3px solid rgba(59,130,246,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(59,130,246,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(59,130,246,.8);margin:0 0 .5rem">LEÇON 2</p>
<p style="font-size:.95rem;font-weight:600;margin:0">La cohérence cardiaque — protocole d\'ouverture de séance</p></div>
<p>5 minutes de cohérence cardiaque en début de séance conditionnent le système nerveux du client pour recevoir le travail.</p>
<p><strong>Script d\'ouverture :</strong> "Je t\'invite à inspirer pendant 5 secondes… et expirer pendant 5 secondes… Laisse ton ventre se gonfler à chaque inspire… Laisse-le se dégonfler complètement à chaque expire…"</p>
<p>La voix du praticien est un outil. Rythme calme. Volume bas. Pause entre les phrases.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 3 — Les 5 techniques thérapeutiques — quand les utiliser',
                'content' => '<div style="border-left:3px solid rgba(168,85,247,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(168,85,247,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(168,85,247,.8);margin:0 0 .5rem">LEÇON 3</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Les 5 techniques — quand et comment les introduire</p></div>
<p>① <strong>4-7-8</strong> → client anxieux en début de séance · dose : 3–4 cycles</p>
<p>② <strong>Respiration carrée</strong> → client agité, mental occupé · dose : 5 cycles</p>
<p>③ <strong>Cohérence cardiaque 5-5</strong> → ouverture et clôture de séance · dose : 5 min</p>
<p>④ <strong>Kapalabhati doux</strong> → client en fatigue, manque d\'énergie · dose : 20–30 cycles</p>
<p>⑤ <strong>Nadi Shodhana</strong> → client dispersé, manque de clarté · dose : 6–8 cycles</p>
<p>Principe : toujours proposer, jamais imposer. Observer la réaction. Ajuster.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 4 — Le souffle guidé — la voix et la présence',
                'content' => '<div style="border-left:3px solid rgba(249,115,22,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(249,115,22,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(249,115,22,.8);margin:0 0 .5rem">LEÇON 4</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Le souffle guidé — la voix et la présence du praticien</p></div>
<p>Guider le souffle est un art. La technique seule ne suffit pas — c\'est la présence et la voix du praticien qui créent l\'espace sécurisé.</p>
<p><strong>Les 4 qualités de voix du praticien :</strong></p>
<ul>
<li>Volume bas → invite à se centrer</li>
<li>Rythme lent → régule le système nerveux</li>
<li>Pauses intentionnelles → laissent le corps intégrer</li>
<li>Intonation descendante → ancre, sécurise</li>
</ul>',
            ],
            [
                'type'    => 'pratique',
                'title'   => 'Pratique — Les 5 souffles maîtrisés et guidés',
                'content' => '<div style="border-left:3px solid rgba(34,197,94,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(34,197,94,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(34,197,94,.8);margin:0 0 .5rem">PRATIQUE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Les 5 souffles en pratique — maîtrise et guidance</p></div>
<p><strong>─ Phase 1 : Maîtrise personnelle (30 min) ─</strong></p>
<p>Pratique chacune des 5 techniques sur toi-même. Note l\'effet et le ressenti.</p>
<p><strong>─ Phase 2 : Guidance en binôme (30 min) ─</strong></p>
<p>Avec un proche ou en pratique simulée, guide chaque technique avec ta voix. Utilise les scripts des leçons. Observe ce qui se passe chez l\'autre.</p>
<p>Débriefe après : qu\'as-tu observé ? Qu\'aurais-tu fait différemment ?</p>',
            ],
            [
                'type'    => 'exercice',
                'title'   => 'Intégration — Mon protocole souffle de séance type',
                'content' => '<p>Construis la séquence souffle d\'une séance type de 60 minutes :</p>
<p>Ouverture (5 min) : technique choisie → …</p>
<p>Diagnostic initial (2 min) : observation du souffle du client</p>
<p>Corps de séance (45 min) : technique(s) adaptées selon l\'état du client</p>
<p>Clôture (5 min) : technique choisie → … · Script de clôture : "…"</p>
<p>Débrief (3 min) : "Qu\'est-ce que tu ressens maintenant ?"</p>',
            ],
            [
                'type'    => 'pratique',
                'title'   => 'Pratique avancée — Guider le souffle d\'un autre',
                'content' => '<p>Mise en situation complète : 20 minutes de séance souffle guidé avec une personne réelle (proche, pair en formation).</p>
<p>Utilise ton protocole de séance type. Adapte en temps réel selon ce que tu observes.</p>
<p>Auto-débrief post-séance : 5 minutes avec le journal du praticien.</p>',
            ],
            [
                'type'    => 'reflexion',
                'title'   => 'Lettre — Ce que le souffle m\'a appris sur ma pratique',
                'content' => '<p>Après avoir guidé quelqu\'un dans une pratique de souffle, écris une courte réflexion :</p>
<p>Commence par : <em>"En guidant le souffle de quelqu\'un d\'autre, j\'ai découvert que…"</em></p>',
            ],
        ];

        $this->updateModule('praticien', '04-j-ecoute-mon-souffle', [
            'intro_text' => "J'ÉCOUTE MON SOUFFLE INTÉRIEUR — La Maîtrise du Souffle Thérapeutique\n\nLe souffle est le seul système autonome que tu peux contrôler consciemment.\nEn l'influençant, tu influences tout le reste.\n\n3 types de respiration · Cohérence cardiaque · 5 techniques · Guider le souffle du client.",
            'description' => '4 leçons · 5 techniques thérapeutiques · Guidance du souffle · Protocole de séance. Maîtriser le souffle pour l\'utiliser avec les clients.',
        ], $activities);
    }

    /* ─────────────────────────────────────────────────────── MODULE 05 ─── */
    private function seedModule05(): void
    {
        $activities = [
            [
                'type'    => 'lecture',
                'title'   => 'Introduction — Ta mission de praticien change tout',
                'content' => '<div style="border-left:3px solid rgba(201,168,76,.9);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(201,168,76,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(201,168,76,.9);margin:0 0 .5rem">PROMESSE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Pourquoi ce module change tout</p></div>
<p>Un praticien qui ne sait pas pourquoi il fait ce qu\'il fait finit par s\'épuiser.</p>
<p>Un praticien qui connaît sa mission de praticien tient sur la durée. Il rayonne. Il attire les bons clients. Il transforme les vies.</p>
<p><strong>Ce module te donne :</strong></p>
<ul>
<li>Tes valeurs profondes ancrées dans le corps</li>
<li>Ta proposition de valeur en tant que praticien</li>
<li>Ta mission en une phrase — le cœur de ta pratique</li>
</ul>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 1 — Les valeurs du praticien',
                'content' => '<div style="border-left:3px solid rgba(20,184,166,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(20,184,166,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(20,184,166,.8);margin:0 0 .5rem">LEÇON 1</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Les valeurs du praticien — le socle de ta pratique</p></div>
<p>Les valeurs ne sont pas des idéaux abstraits. Ce sont des réalités vécues dans le corps.</p>
<p>Un praticien qui agit en accord avec ses valeurs est cohérent — and les clients le ressentent.</p>
<p>Exemples de valeurs de praticien : Présence · Bienveillance sans fusion · Rigueur · Humilité · Liberté · Transmission · Impact.</p>
<p>Quelles sont les tiennes ? Quand les as-tu vécues dans ton corps pendant la pratique ?</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 2 — Tes dons naturels de praticien',
                'content' => '<div style="border-left:3px solid rgba(59,130,246,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(59,130,246,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(59,130,246,.8);margin:0 0 .5rem">LEÇON 2</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Tes dons naturels de praticien — ta proposition de valeur</p></div>
<p>Certains praticiens calment naturellement. D\'autres dynamisent. D\'autres clarifient. D\'autres ancrent.</p>
<p>Ton don naturel est ce que les clients ressentent avec toi — sans que tu aies à le forcer.</p>
<p>C\'est la base de ta proposition de valeur unique en tant que praticien Pause Souffle.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 3 — L\'Ikigai adapté au praticien Pause Souffle',
                'content' => '<div style="border-left:3px solid rgba(168,85,247,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(168,85,247,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(168,85,247,.8);margin:0 0 .5rem">LEÇON 3</p>
<p style="font-size:.95rem;font-weight:600;margin:0">L\'Ikigai adapté au praticien Pause Souffle</p></div>
<p>L\'Ikigai japonais : la raison d\'être se trouve à l\'intersection de 4 cercles.</p>
<p>① Ce que tu aimes faire · ② Ce dans quoi tu es naturellement doué(e) en tant que praticien · ③ Ce dont tes clients ont besoin · ④ Ce qui peut devenir une pratique professionnelle viable</p>
<p>Pour le praticien Pause Souffle, cela devient : Quelle transformation unique puis-je apporter, avec mes dons, à qui exactement ?</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 4 — La mission ancrée dans le corps du praticien',
                'content' => '<div style="border-left:3px solid rgba(249,115,22,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(249,115,22,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(249,115,22,.8);margin:0 0 .5rem">LEÇON 4</p>
<p style="font-size:.95rem;font-weight:600;margin:0">La mission du praticien ancrée dans le corps</p></div>
<p>Une mission intellectuelle ne résiste pas aux jours difficiles.</p>
<p>Une mission de praticien ancrée dans le corps — ressentie, reconnue physiquement quand tu l\'énonces — tient dans le temps.</p>
<p>Test : énonce ta mission à voix haute. Ton corps s\'ouvre ou se ferme ? Légèreté = alignement. Oppression = reformuler.</p>',
            ],
            [
                'type'    => 'pratique',
                'title'   => 'Pratique — L\'exercice Ikigai praticien en 4 étapes',
                'content' => '<div style="border-left:3px solid rgba(34,197,94,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(34,197,94,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(34,197,94,.8);margin:0 0 .5rem">PRATIQUE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">L\'exercice Ikigai praticien — 45 minutes</p></div>
<p><strong>─ Séquence ─</strong></p>
<p>Étape 1 (10 min) → Liste 10 choses que tu aimes faire dans ta pratique ou dans l\'accompagnement humain.</p>
<p>Étape 2 (10 min) → Liste 5–7 dons naturels que tu as dans la relation d\'aide.</p>
<p>Étape 3 (10 min) → Liste 3–5 besoins de tes clients potentiels auxquels tu te sens appelé(e) à répondre.</p>
<p>Étape 4 (15 min) → Formule ta mission de praticien en une phrase.</p>',
            ],
            [
                'type'    => 'exercice',
                'title'   => 'Intégration — Ma mission de praticien en une phrase',
                'content' => '<p>Structure de la phrase du praticien :</p>
<p>"J\'accompagne [qui] à [quoi] grâce à [comment] pour que [transformation vécue]."</p>
<p>Exemples :</p>
<ul>
<li>"J\'accompagne les personnes épuisées à retrouver leur ancrage corporel grâce au souffle pour qu\'elles reprennent confiance dans leur propre corps."</li>
<li>"J\'accompagne les femmes en transition de vie à identifier leur mission unique grâce au traitement somatique pour qu\'elles avancent avec clarté."</li>
</ul>
<p>Écris ta version. Teste-la dans ton corps. Partage-la à voix haute devant un miroir.</p>',
            ],
            [
                'type'    => 'reflexion',
                'title'   => 'Lettre — À la personne que j\'accompagne',
                'content' => '<p>Écris une lettre courte à ton client idéal.</p>
<p>Commence par : <em>"Je suis là pour toi si tu vis…, si tu cherches…, si tu as besoin de… Ce que je t\'apporte que personne d\'autre ne peut t\'apporter exactement comme moi, c\'est…"</em></p>',
            ],
        ];

        $this->updateModule('praticien', '05-je-decouvre-ma-mission', [
            'intro_text' => "JE DÉCOUVRE MA MISSION UNIQUE — La Raison d'Être du Praticien\n\nUn praticien qui connaît sa mission tient sur la durée.\nIl rayonne. Il attire les bons clients. Il transforme les vies.\n\nValeurs profondes · Dons naturels · Ikigai corporel · Mission en une phrase.",
            'description' => '4 leçons · Valeurs praticien · Dons naturels · Ikigai praticien · Mission en une phrase. Définir sa raison d\'être professionnelle.',
        ], $activities);
    }

    /* ─────────────────────────────────────────────────────── MODULE 06 ─── */
    private function seedModule06(): void
    {
        $activities = [
            [
                'type'    => 'lecture',
                'title'   => 'Introduction — La vision du praticien qui prend tenue',
                'content' => '<div style="border-left:3px solid rgba(201,168,76,.9);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(201,168,76,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(201,168,76,.9);margin:0 0 .5rem">PROMESSE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Ce module donne à votre pratique une direction durable</p></div>
<p>Vous avez appris à vous connaître, à lire les blessures et les ressources, à maîtriser le souffle et à le guider, à formuler votre mission.</p>
<p>Il reste maintenant la question la plus exigeante : comment construire une pratique de praticien suffisamment juste pour que vous puissiez la tenir dans la durée — et la transmettre ?</p>
<p>Le Module 07 vous FormationTrackMirrorSeeder ensuite vers la transmission directe du Rituel Pause Souffle à vos clients.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 1 — La vision incarnée du praticien',
                'content' => '<div style="border-left:3px solid rgba(20,184,166,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(20,184,166,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(20,184,166,.8);margin:0 0 .5rem">LEÇON 1</p>
<p style="font-size:.95rem;font-weight:600;margin:0">La vision incarnée du praticien</p></div>
<p>Une vraie vision de pratique n\'est pas un business plan. C\'est une scène intérieure précise : je me vois en train d\'accompagner des clients, dans quel contexte, avec quelle énergie, produisant quelle transformation.</p>
<p>La rendre corporelle — la sentir dans le corps avant de la planifier dans la tête — est ce qui la rend réelle.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 2 — L\'obstacle intérieur du praticien',
                'content' => '<div style="border-left:3px solid rgba(59,130,246,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(59,130,246,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(59,130,246,.8);margin:0 0 .5rem">LEÇON 2</p>
<p style="font-size:.95rem;font-weight:600;margin:0">L\'obstacle intérieur du praticien</p></div>
<p>Les obstacles les plus fréquents des praticiens en formation :</p>
<ul>
<li>"Je ne suis pas encore assez compétent(e)"</li>
<li>"Qui suis-je pour accompagner les autres ?"</li>
<li>"Et si le client ne ressent rien ?"</li>
<li>"Je ne veux pas paraître bizarre"</li>
</ul>
<p>Chacun de ces obstacles a une signature corporelle. Retrouve la tienne — et utilise le souffle pour la traverser.</p>',
            ],
            [
                'type'    => 'lecture',
                'title'   => 'Leçon 3 — Produire des preuves de pratique professionnelle',
                'content' => '<div style="border-left:3px solid rgba(168,85,247,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(168,85,247,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(168,85,247,.8);margin:0 0 .5rem">LEÇON 3</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Produire des preuves — la crédibilité du praticien</p></div>
<p>Une pratique devient crédible quand elle commence à produire des résultats observables.</p>
<p>Chaque séance réalisée = une preuve que tu es capable de le faire.</p>
<p>L\'objectif de ce module : réaliser au moins 3 séances de pratique (proches, pairs, bénévoles) avant de passer au module 07.</p>',
            ],
            [
                'type'    => 'pratique',
                'title'   => 'Pratique — Le protocole 5-5-5 vision praticien',
                'content' => '<div style="border-left:3px solid rgba(34,197,94,.8);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(34,197,94,.06);border-radius:0 6px 6px 0">
<p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;color:rgba(34,197,94,.8);margin:0 0 .5rem">PRATIQUE</p>
<p style="font-size:.95rem;font-weight:600;margin:0">Le protocole Pause Souffle 5-5-5 — vision praticien</p></div>
<p>Vous connaissez le souffle 5-5-5. Ici, vous l\'utilisez pour ancrer votre vision de praticien.</p>
<p>① 5 min de souffle 5-5 → Centrage. Intention : "Je veux voir clairement ma pratique."</p>
<p>② 5 min → Visualisation incarnée : vous vous voyez en séance avec un client type. Descrivisez la scène corporelement.</p>
<p>③ 5 min → Identifiez l\'obstacle intérieur. Respirez dessus. Engagement : quelle est la première séance que vous allez réaliser ?</p>',
            ],
            [
                'type'    => 'exercice',
                'title'   => 'Mission — 3 séances de pratique avant le module 07',
                'content' => '<p>Votre mission avant de passer au module 07 :</p>
<p><strong>Réaliser 3 séances de pratique</strong> avec des proches, des pairs en formation, ou des personnes volontaires.</p>
<p>Pour chaque séance :</p>
<p>① Préparez votre protocole de séance type (module 04)</p>
<p>② Réalisez la séance en conscience</p>
<p>③ Complétez le journal du praticien post-séance</p>
<p>Ces 3 séances sont vos premières preuves de pratique. Elles vous donneront plus de confiance que 10 heures de théorie.</p>',
            ],
        ];

        $this->updateModule('praticien', '06-je-visualise-ma-vie', [
            'intro_text' => "J'INCARNE MA VISION — Clarté, Courage & Discipline du Praticien\n\nVous avez appris à vous connaître, à lire les blessures, à guider le souffle, à formuler votre mission.\nIl reste maintenant une question : comment construire une pratique professionnelle qui tient réellement ?\n\nLe Module 07 vous emmènera vers la transmission directe du Rituel Pause Souffle.",
            'description' => '3 leçons · Vision du praticien · Obstacle intérieur · Protocole 5-5-5 · Mission 3 séances. Ancrer la vision professionnelle avant la transmission.',
        ], $activities);
    }

    /* ─────────────────────────────────────────────────────── Helper ─────── */
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
