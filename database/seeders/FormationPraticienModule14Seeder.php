<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * MODULE 14 — La Relation de Soin
 * Formation Praticien · Module de profondeur
 * Arc pédagogique : le praticien guérisseur · l'espace thérapeutique sacré ·
 *                   la blessure comme don · contenance · présence transformante
 */
class FormationPraticienModule14Seeder extends Seeder
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
        $intro = $this->card($gold, 'Module 14 · Praticien', 'Ce qui guérit vraiment',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Il y a un secret au cœur du soin.<br>
            Un secret que les diplômes n\'enseignent pas.<br>
            Que les protocoles ne transmettent pas.<br>
            Que la technique seule ne peut jamais remplacer.<br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.9rem 1.2rem;border:1px solid rgba(201,168,76,.18);margin:.75rem 0;">
            <strong>Ce n\'est pas votre méthode qui guérit votre client.</strong><br>
            C\'est la qualité de la relation que vous créez avec lui.<br><br>
            C\'est le fait qu\'il se sente, peut-être pour la première fois :<br>
            → vu sans jugement<br>
            → tenu sans être dirigé<br>
            → libre de s\'effondrer sans que vous perdiez pied<br><br>
            <em>C\'est cela, la relation de soin.</em>
            </div>
            Et voici le paradoxe central de ce module :<br><br>
            <strong>Vous pouvez offrir cela non pas parce que vous n\'avez jamais souffert —<br>
            mais précisément parce que vous avez traversé quelque chose.</strong><br><br>
            C\'est le paradigme du praticien blessé-guérisseur.<br>
            C\'est l\'épice qui manque dans beaucoup de formations.<br>
            C\'est ce module.
            </div>'
        );

        // ── LEÇON 1 : L'archétype du blessé-guérisseur ───────────────────────
        $blesse_guerisseur = $this->card($teal, 'Leçon 1', 'Le Blessé-Guérisseur — votre blessure est votre don',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Carl Gustav Jung a nommé un archétype fondamental du soin :<br>
            <strong>Le Wounded Healer — le Guérisseur Blessé.</strong><br><br>
            L\'idée est simple et bouleversante :<br>
            Les praticiens les plus efficaces sont ceux qui ont eux-mêmes traversé une profonde blessure<br>
            et qui ont fait le travail de la traverser, l\'intégrer, la transformer en sagesse.<br><br>
            <div style="background:rgba(20,184,166,.07);border-radius:10px;padding:.9rem 1.2rem;border:1px solid rgba(20,184,166,.18);margin:.75rem 0;display:flex;flex-direction:column;gap:.9rem;">
            <div>
            <strong style="color:rgba(20,184,166,.9);">Ce qui ne guérit PAS chez l\'autre :</strong><br>
            → Votre technique maîtrisée<br>
            → Vos heures de formation<br>
            → Votre savoir sur la neurobiologie du souffle<br>
            <em>(Ces éléments créent la crédibilité. Pas la guérison.)</em>
            </div>
            <div>
            <strong style="color:rgba(20,184,166,.9);">Ce qui guérit chez l\'autre :</strong><br>
            → Sentir que vous êtes une personne qui a traversé quelque chose<br>
            → Sentir que vous ne fuyez pas quand ça va mal<br>
            → Sentir que vous portez votre propre humanité avec dignité
            </div>
            <div>
            <strong style="color:rgba(20,184,166,.9);">La nuance essentielle :</strong><br>
            Il ne s\'agit pas de <em>parler de votre blessure</em> à vos clients.<br>
            Il s\'agit d\'avoir fait le travail de la traverser.<br>
            C\'est la différence entre un praticien qui transmet la paix<br>
            et un praticien qui cherche inconsciemment à se faire guérir à travers ses clients.
            </div>
            </div>
            <strong>Question à méditer :</strong><br>
            Quelle traversée personnelle vous a conduit sur ce chemin du soin ?<br>
            L\'avez-vous suffisamment intégrée pour qu\'elle devienne une ressource<br>
            plutôt qu\'une blessure encore vive ?
            </div>'
        );

        // ── LEÇON 2 : L'espace thérapeutique sacré ────────────────────────────
        $espace_sacre = $this->card($blue, 'Leçon 2', 'L\'Espace Thérapeutique — ce qui se passe dans la salle',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Il y a ce qui est visible dans une séance :<br>
            les respirations comptées, la progression du protocole, les instructions données.<br><br>
            Et il y a ce qui est invisible mais décisif :<br>
            <strong>l\'espace entre vous et votre client.</strong><br><br>
            <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.9rem 1.2rem;border:1px solid rgba(59,130,246,.18);margin:.75rem 0;">
            Cet espace — qu\'on appelle le <em>conteneur thérapeutique</em> — est ce que vous créez<br>
            avant même de dire un mot. Il a 5 dimensions :<br><br>
            <strong style="color:rgba(59,130,246,.9);">① La sécurité physique.</strong><br>
            L\'espace est ordonné, calme, prévisible. Le corps du client se désactive dès l\'entrée.<br><br>
            <strong style="color:rgba(59,130,246,.9);">② La sécurité émotionnelle.</strong><br>
            Votre regard, votre voix et votre corps disent : "ce qui vient peut venir".<br>
            Quoi qu\'il arrive ici — larmes, blocages, émotions — il n\'y a pas de faux pas.<br><br>
            <strong style="color:rgba(59,130,246,.9);">③ La clarté du cadre.</strong><br>
            Le client sait exactement ce qui va se passer et combien de temps. Pas de surprise.<br>
            L\'incertitude active le système de menace. La clarté l\'éteint.<br><br>
            <strong style="color:rgba(59,130,246,.9);">④ La constance du praticien.</strong><br>
            Vous ne paniquez pas quand ça devient difficile pour le client.<br>
            Votre calme est contagieux neurologiquement — c\'est de la co-régulation.<br><br>
            <strong style="color:rgba(59,130,246,.9);">⑤ La clôture rituelle.</strong><br>
            Chaque séance a une fin claire. Le client repart dans sa vie —<br>
            pas dans un entre-deux flottant. La clôture est aussi importante que l\'ouverture.
            </div>
            <strong>La question praticienne :</strong><br>
            Dans votre pratique actuelle — quelles dimensions avez-vous naturellement tendance à négliger ?
            </div>'
        );

        // ── LEÇON 3 : Contenance et co-régulation ─────────────────────────────
        $coregulation = $this->card($purple, 'Leçon 3', 'La Co-régulation — de quoi se régule le client',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            La neuroscience a confirmé ce que les guérisseurs ont toujours su :<br>
            <strong>Le système nerveux humain se régule au contact d\'autres systèmes nerveux calmes.</strong><br><br>
            C\'est la <em>co-régulation</em>.<br><br>
            <div style="display:flex;flex-direction:column;gap:.85rem;margin:.75rem 0;">
            <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(168,85,247,.4);">
            <strong style="color:rgba(168,85,247,.8);">Qu\'est-ce qui se transmet réellement ?</strong><br>
            Votre respiration → influe inconsciemment sur la respiration du client.<br>
            Votre rythme cardiaque → se synchronise progressivement avec le sien.<br>
            Votre état nerveux → est lu par son système limbique en moins de 200 ms.<br><br>
            <em>Un praticien dysrégulé — stressé, préoccupé, dans ses pensées — transmet sa dysrégulation.</em>
            </div>
            <div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(34,197,94,.4);">
            <strong style="color:rgba(34,197,94,.8);">Ce que cela implique concrètement :</strong><br>
            ① Votre propre pratique quotidienne de 5-5-5 n\'est pas optionnelle.<br>
            Elle calibre votre système nerveux pour qu\'il puisse calmer celui des autres.<br><br>
            ② La préparation avant séance (2 minutes de souffle) fait passer votre corps en état de cohérence.<br>
            Votre client entre alors dans un champ nerveux régulé.<br><br>
            ③ En séance difficile : si vous sentez votre propre stress monter —<br>
            quelques secondes de 5-5-5 silencieux suffisent à vous re-centrer.
            </div>
            <div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(249,115,22,.4);">
            <strong style="color:rgba(249,115,22,.8);">La règle fondamentale :</strong><br>
            Vous ne pouvez pas emmener quelqu\'un là où vous n\'êtes pas allé.<br>
            Vous ne pouvez pas le calmer si vous n\'êtes pas calme.<br>
            <em>C\'est pourquoi prendre soin de vous n\'est pas de l\'égoïsme. C\'est de la déontologie.</em>
            </div>
            </div>
            </div>'
        );

        // ── LEÇON 4 : Ce que les clients cherchent vraiment ───────────────────
        $besoin_reel = $this->card($orange, 'Leçon 4', 'Ce que les clients cherchent vraiment — au-delà de la demande',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Un client arrive en disant :<br>
            "Je veux réduire mon stress", "Je veux mieux dormir", "Je veux plus d\'énergie."<br><br>
            Ce sont les <em>demandes explicites</em>.<br><br>
            En dessous, presque toujours, il y a une demande plus profonde :<br>
            <strong>"Puis-je me faire confiance ?"<br>
            "Est-ce que je suis assez ?" <br>
            "Y a-t-il un endroit où je peux poser le poids ?"</strong><br><br>
            <div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.9rem 1.2rem;border:1px solid rgba(249,115,22,.18);margin:.75rem 0;">
            <strong>La pyramide des besoins dans l\'accompagnement corporel :</strong><br><br>
            <strong style="color:rgba(201,168,76,.9);">Niveau 1 — Besoin déclaré</strong><br>
            Ce qu\'ils disent vouloir. Ce pour quoi ils vous paient.<br>
            Votre travail : y répondre techniquement.<br><br>
            <strong style="color:rgba(20,184,166,.9);">Niveau 2 — Besoin ressenti</strong><br>
            Se sentir mieux, retrouver une qualité de vie.<br>
            Votre travail : le soutenir par votre présence.<br><br>
            <strong style="color:rgba(168,85,247,.9);">Niveau 3 — Besoin de fond</strong><br>
            Être vu. Être accepté. Savoir que quelqu\'un "tient" pendant qu\'ils s\'effondrent ou se reconstruisent.<br>
            Votre travail : être cette présence sans en faire un projet thérapeutique conscient.
            </div>
            Un praticien exceptionnel travaille tous les niveaux — souvent sans en parler explicitement.<br>
            Son souffle guide le niveau 1.<br>
            Sa présence nourrit le niveau 2.<br>
            Sa propre humanité atteint le niveau 3.
            </div>'
        );

        // ── LEÇON 5 : Ce qu'on ne met jamais dans un protocole ───────────────
        $silence_therapeutique = $this->card($green, 'Leçon 5', 'Le Silence — l\'outil le plus puissant de votre boîte',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Un protocole de souffle balisé peut durer 30 minutes.<br>
            Mais ce sont souvent <em>les 3 minutes de silence après le protocole</em><br>
            qui font le travail le plus profond.<br><br>
            <div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.9rem 1.2rem;border:1px solid rgba(34,197,94,.18);margin:.75rem 0;">
            <strong>Les 3 types de silence en séance :</strong><br><br>
            <strong style="color:rgba(34,197,94,.9);">① Le silence d\'accueil</strong><br>
            Au début de séance. Vous laissez le client arriver entièrement.<br>
            Vous ne remplissez pas les 30 premières secondes de paroles.<br>
            Un silence bienveillant dit : "Je n\'ai pas besoin que vous soyez différent pour que nous commencions."<br><br>
            <strong style="color:rgba(34,197,94,.9);">② Le silence de traitement</strong><br>
            Après une guidance profonde. Après un moment d\'intensité émotionnelle.<br>
            Ne pas combler. Le corps et le système nerveux intègrent dans le silence.<br>
            Résistez à l\'envie de demander "Ça va ?"<br><br>
            <strong style="color:rgba(34,197,94,.9);">③ Le silence de clôture</strong><br>
            La dernière minute de la séance, dans le silence.<br>
            Aucun mot. Juste : vous, votre présence, le client qui repose dans son corps.<br>
            C\'est dans ce silence que beaucoup de clients ont leurs insights les plus importants.
            </div>
            <strong>Exercice cette semaine :</strong><br>
            Dans votre prochaine séance — identifiez un moment où vous avez eu envie de parler.<br>
            Ne parlez pas. Restez en silence présent 10 secondes de plus que votre instinct vous le dit.<br>
            Observez ce qui se passe.
            </div>'
        );

        // ── MÉDITATION : Le conteneur ─────────────────────────────────────────
        $meditation = $this->card($gold, 'Méditation', 'Je deviens le conteneur — Pratique de présence profonde',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Cette pratique prépare votre corps et votre présence à accueillir l\'autre.<br>
            Elle dure 10 minutes. Revenez-y avant chaque séance importante.<br><br>
            <div style="background:rgba(201,168,76,.06);border-radius:10px;padding:.9rem 1.2rem;border:1px solid rgba(201,168,76,.15);margin:.75rem 0;">
            <strong>① Ancrage (2 min)</strong><br>
            Installez-vous. Pieds au sol. Dos aligné.<br>
            Trois respirations 5-5-5 : inspirez profondément... bloquez... relâchez.<br>
            Sentez votre corps devenir lourd, stable, ancré.<br><br>
            <strong>② Expansion (3 min)</strong><br>
            Imaginez un espace lumineux et calme qui rayonne depuis votre poitrine.<br>
            Avec chaque expiration, cet espace s\'agrandit.<br>
            Il n\'y a pas d\'urgence ici. Pas d\'attente. Juste de la place.<br>
            C\'est le conteneur que vous offrirez à votre client.<br><br>
            <strong>③ L\'intention de service (2 min)</strong><br>
            Pensez à la prochaine personne que vous allez accompagner.<br>
            Dites intérieurement : "Je suis là pour toi. Ce que tu apportes peut venir.<br>
            Tu es en sécurité ici. Je tiendrai l\'espace."<br><br>
            <strong>④ Retour (3 min)</strong><br>
            Revenez à votre propre souffle simple.<br>
            Notez dans votre journal de praticien : quel état intérieur portez-vous aujourd\'hui ?<br>
            Qu\'est-ce qui pourrait interférer avec votre présence ? Comment le traversez-vous ?
            </div>
            </div>'
        );

        // ── ACTIVITÉS ─────────────────────────────────────────────────────────
        $activities = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — Ce qui guérit vraiment',
                'duration'    => '10 min',
                'description' => 'Le secret au cœur du soin. Ce n\'est pas la technique qui guérit — c\'est la qualité de la relation. Le paradigme du guérisseur blessé.',
                'content'     => $intro,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 1 — Le Blessé-Guérisseur (Jung)',
                'duration'    => '25 min',
                'description' => 'L\'archétype fondamental du soignant. Votre blessure traversée et intégrée est votre plus grande qualification — non vos diplômes. La différence entre ressource et blessure encore vive.',
                'content'     => $blesse_guerisseur,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 2 — L\'Espace Thérapeutique (5 dimensions)',
                'duration'    => '25 min',
                'description' => 'Le conteneur thérapeutique : sécurité physique + émotionnelle · clarté de cadre · constance du praticien · clôture rituelle. Ce qui se construit avant même de parler.',
                'content'     => $espace_sacre,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 3 — La Co-régulation Nerveuse',
                'duration'    => '20 min',
                'description' => 'Neuroscience de la co-régulation : votre système nerveux calme le leur. Pourquoi votre propre pratique 5-5-5 est de la déontologie, pas du luxe.',
                'content'     => $coregulation,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 4 — Ce que les clients cherchent vraiment',
                'duration'    => '20 min',
                'description' => 'Les 3 niveaux de la demande client : besoin déclaré · besoin ressenti · besoin de fond (être vu, être accepté, être tenu). Comment travailler tous les niveaux.',
                'content'     => $besoin_reel,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 5 — Le Silence comme Outil Thérapeutique',
                'duration'    => '15 min',
                'description' => '3 types de silence : accueil · traitement · clôture. Résister à l\'impulsion de combler. L\'intégration se fait dans le silence.',
                'content'     => $silence_therapeutique,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Méditation — Je deviens le conteneur',
                'duration'    => '10 min',
                'description' => 'Pratique d\'ancrage et d\'expansion du conteneur intérieur. À réaliser avant chaque séance importante. Journal de praticien.',
                'content'     => $meditation,
            ],
            [
                'type'        => 'reflexion',
                'title'       => 'Exercice d\'intégration — Ma traversée comme ressource',
                'duration'    => '25 min',
                'description' => 'écriture libre : quelle blessure traversée vous a conduit ici ? Est-elle suffisamment intégrée pour être une ressource ? Que reste-t-il à traverser pour vous ? Ce que votre chemin rend possible pour vos clients.',
            ],
        ];

        // ── EN ACTIVITÉS ──────────────────────────────────────────────────────
        $activities_en = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — What Really Heals',
                'duration'    => '10 min',
                'description' => 'The secret at the heart of care. It is not technique that heals — it is the quality of the relationship. The wounded healer paradigm.',
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Lesson 1 — The Wounded Healer (Jung)',
                'duration'    => '25 min',
                'description' => 'The fundamental archetype of the healer. Your traversed wound is your greatest qualification. The difference between a resource and a still-open wound.',
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Lesson 2 — The Therapeutic Space (5 Dimensions)',
                'duration'    => '25 min',
                'description' => 'The therapeutic container: physical & emotional safety · frame clarity · practitioner consistency · ritual closure. What is built before you even speak.',
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Lesson 3 — Nervous System Co-regulation',
                'duration'    => '20 min',
                'description' => 'The neuroscience of co-regulation: your calm nervous system calms theirs. Why your own 5-5-5 practice is professional ethics, not luxury.',
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Lesson 4 — What Clients Really Seek',
                'duration'    => '20 min',
                'description' => '3 levels of client needs: stated · felt · deep (to be seen, accepted, held). How to work all levels.',
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Lesson 5 — Silence as a Therapeutic Tool',
                'duration'    => '15 min',
                'description' => '3 types of silence: welcome · processing · closure. Resisting the impulse to fill. Integration happens in silence.',
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Meditation — Becoming the Container',
                'duration'    => '10 min',
                'description' => 'Grounding and container-expansion practice. To be done before each important session.',
            ],
            [
                'type'        => 'reflexion',
                'title'       => 'Integration Exercise — My Crossing as Resource',
                'duration'    => '25 min',
                'description' => 'Free writing: which wound has brought you here? Is it sufficiently integrated? What your journey makes possible for your clients.',
            ],
        ];

        DB::table('formation_modules')->updateOrInsert(
            ['slug' => '14-la-relation-de-soin', 'track' => 'praticien'],
            [
                'slug'           => '14-la-relation-de-soin',
                'title'          => 'La Relation de Soin — Ce qui Guérit Vraiment',
                'title_en'       => 'The Relationship of Care — What Really Heals',
                'week_label'     => 'Module 14',
                'track'          => 'praticien',
                'order'          => 10,
                'is_active'      => true,
                'intro_text'     => "LA RELATION DE SOIN — Module Praticien 14\n\nIl y a un secret au cœur du soin que les diplômes n'enseignent pas : ce n'est pas votre technique qui guérit votre client. C'est la qualité de la relation que vous créez avec lui.\n\nCe module explore l'archétype du blessé-guérisseur (Jung), les 5 dimensions du conteneur thérapeutique, la co-régulation nerveuse, et ce que les clients cherchent vraiment au-delà de leur demande explicite.",
                'intro_text_en'  => "THE RELATIONSHIP OF CARE — Practitioner Module 14\n\nThere is a secret at the heart of healing that diplomas never teach: it is not your technique that heals your client. It is the quality of the relationship you create with them.\n\nThis module explores the wounded healer archetype (Jung), the 5 dimensions of the therapeutic container, nervous system co-regulation, and what clients truly seek beyond their stated request.",
                'description'    => "Archétype du Guérisseur Blessé · Le conteneur thérapeutique (5 dimensions) · Co-régulation nerveuse · Les 3 niveaux de la demande client · Le silence comme outil · Méditation 'Je deviens le conteneur'",
                'description_en' => "Wounded Healer Archetype · Therapeutic container (5 dimensions) · Nervous system co-regulation · 3 levels of client needs · Silence as a tool · Meditation 'Becoming the Container'",
                'activities'     => json_encode($activities),
                'activities_en'  => json_encode($activities_en),
                'audio_path'     => null,
                'audio_path_en'  => null,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]
        );

        $this->command->info('[FormationPraticienModule14Seeder] ✓ 8 activités — La Relation de Soin.');
    }
}
