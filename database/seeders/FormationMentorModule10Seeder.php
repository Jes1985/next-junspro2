<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * MODULE MENTOR 10 — La Transmission Invisible
 * Formation Mentor · Module final (compte rond)
 * Arc pédagogique : curriculum invisible · cohérence vie-enseignement ·
 *                   echec comme matière pédagogique · beginner mind permanent ·
 *                   la lignée vivante
 */
class FormationMentorModule10Seeder extends Seeder
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
        $intro = $this->card($gold, 'Module 10 · Le Feu d\'Artifice', 'Ce que vous transmettez sans jamais l\'avoir enseigné',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Ce module est différent des autres.<br>
            Il ne vous donne pas de nouvelles techniques.<br>
            Il vous demande de regarder quelque chose que peu de mentors ont le courage de regarder en face.<br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.9rem 1.2rem;border:1px solid rgba(201,168,76,.18);margin:.75rem 0;">
            <strong>Une vérité dérangeante :</strong><br><br>
            Vos étudiants n\'apprennent pas ce que vous <em>enseignez</em>.<br>
            Ils apprennent ce que vous <em>êtes</em>.<br><br>
            Pas consciemment. Par mimétisme neurologique profond.<br>
            Leur système nerveux observe et capture votre façon d\'être<br>
            en relation avec votre propre pratique,<br>
            avec l\'incertitude, avec vos erreurs, avec votre corps,<br>
            avec l\'argent, avec le conflit, avec le silence.\n\n
            <em>C\'est ce que j\'appelle le Curriculum Invisible.</em>
            </div>
            Ce module de clôture est le plus rare des enseignements :<br>
            celui que les meilleurs transmetteurs appliquent<br>
            sans jamais l\'avoir nommé.\n\n
            Préparez-vous à vous voir différemment.
            </div>'
        );

        // ── LEÇON 1 : Le Curriculum Invisible ────────────────────────────────
        $curriculum = $this->card($teal, 'Leçon 1', 'Le Curriculum Invisible — les 5 choses que vous transmettez sans le savoir',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            <div style="display:flex;flex-direction:column;gap:.95rem;margin:.75rem 0;">
            <div style="background:rgba(20,184,166,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(20,184,166,.6);">
            <strong style="color:rgba(20,184,166,.9);">① Votre relation à votre propre pratique</strong><br>
            Est-ce que vous faites toujours vous-même ce que vous enseignez ?<br>
            Vos étudiants le voient — pas dans vos mots, dans votre corps.<br>
            Un mentor qui enseigne la cohérence cardiaque et qui vibre d\'impatience en cours...<br>
            transmet l\'impatience, pas la cohérence cardiaque.
            </div>
            <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(59,130,246,.6);">
            <strong style="color:rgba(59,130,246,.9);">② Votre relation à vos propres erreurs</strong><br>
            Quand vous vous trompez devant eux — que se passe-t-il en vous ?<br>
            Vous couvrez ? Vous justifiez ? Vous assumez ?<br>
            Un mentor qui assume ses erreurs avec grâce enseigne plus sur la résilience<br>
            en 30 secondes que 5 modules entiers sur le sujet.
            </div>
            <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(168,85,247,.6);">
            <strong style="color:rgba(168,85,247,.9);">③ Votre relation à l\'incertitude</strong><br>
            Savez-vous dire "je ne sais pas" ?<br>
            Ou est-ce que l\'incertitude vous force à combler chaque silence avec une réponse ?<br>
            Un mentor qui tient l\'incertitude avec sérénité transmet que L\'INCERTITUDE EST TENABLE.<br>
            C\'est l\'un des apprentissages les plus libérateurs pour un étudiant.
            </div>
            <div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(249,115,22,.6);">
            <strong style="color:rgba(249,115,22,.9);">④ Votre relation au conflit</strong><br>
            Quand un étudiant vous contredit — comment réagissez-vous réellement ?<br>
            La façon dont vous accueillez l\'opposition est la façon dont ils apprendront<br>
            à accueillir l\'opposition de leurs propres clients et étudiants.
            </div>
            <div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(34,197,94,.6);">
            <strong style="color:rgba(34,197,94,.9);">⑤ Votre relation à votre propre limite</strong><br>
            Savez-vous quand vous êtes fatigué, hors-présence, pas au mieux de vous-même ?<br>
            Et osez-vous le nommer — ou jouez-vous toujours le mentor disponible et inébranlable ?<br>
            <em>La vulnérabilité nommée transmet la permission d\'être humain.</em><br>
            C\'est l\'un des cadeaux les plus rares qu\'un mentor puisse offrir.
            </div>
            </div>
            </div>'
        );

        // ── LEÇON 2 : L'Échec comme Matière Pédagogique ──────────────────────
        $echec = $this->card($red, 'Leçon 2', 'L\'Échec comme Matière Pédagogique — votre plus beau cadeau',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Demandez à n\'importe quel adulte de vous rappeler une leçon qui a changé sa vie.<br>
            Dans 9 cas sur 10, ce n\'est pas quand le mentor a brillé.<br>
            C\'est quand il a <strong>chuté — et s\'est relevé devant eux.</strong><br><br>
            <div style="background:rgba(239,68,68,.07);border-radius:10px;padding:.9rem 1.2rem;border:1px solid rgba(239,68,68,.18);margin:.75rem 0;">
            <strong>Pourquoi l\'échec partagé est plus puissant que la réussite partagée :</strong><br><br>
            → La réussite crée de l\'admiration — et souvent de la distance.<br>
            "C\'est pour lui. Pas pour moi."<br><br>
            → L\'échec partagé avec grâce crée de l\'identification.<br>
            "Si lui a traversé ça et continué — moi aussi, je peux."<br><br>
            → La réussite transmet un résultat. L\'échec transmet <em>un chemin.</em>
            </div>
            <strong>Les 3 règles du partage d\'échec qui transforme :</strong><br><br>
            <strong style="color:rgba(239,68,68,.8);">① Nommez l\'échec précisément</strong> — pas "j\'ai traversé des choses difficiles".<br>
            "J\'avais 12 étudiants inscrit à ma deuxième formation. 4 sont venus."<br><br>
            <strong style="color:rgba(249,115,22,.8);">② Nommez ce que vous avez ressenti</strong> — vraiment.<br>
            Pas la version édulcorée. La version qui fait mal encore un peu en la disant.<br><br>
            <strong style="color:rgba(34,197,94,.8);">③ Nommez ce que ça a changé</strong> — en quoi cet échec a affiné votre pratique, votre humilité, votre service.<br><br>
            Ce n\'est pas de la faiblesse.<br>
            C\'est de la <strong>transmission vivante</strong>.
            </div>'
        );

        // ── LEÇON 3 : Rester Étudiant Permanent ──────────────────────────────
        $etudiant = $this->card($blue, 'Leçon 3', 'Le Paradoxe du Maître — rester étudiant permanent',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Il y a un piège discret qui attend les mentors à succès.<br>
            Il arrive lentement, presque sans se faire remarquer.<br>
            On l\'appelle la <strong>crystallisation du savoir</strong>.<br><br>
            <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.9rem 1.2rem;border:1px solid rgba(59,130,246,.18);margin:.75rem 0;">
            Le jour où vous enseignez la même chose<br>
            de la même façon<br>
            avec la même certitude<br>
            depuis trop longtemps...<br><br>
            vous avez arrêté de transmettre du <em>vivant</em>.<br>
            Vous transmettez une <em>archive</em>.
            </div>
            Les étudiants le ressentent. Même s\'ils ne savent pas le nommer.<br>
            Il y a une différence palpable entre un mentor qui <em>récite</em> et un mentor qui <em>découvre en enseignant</em>.<br><br>
            <strong>Les 4 pratiques du perpétuel étudiant :</strong><br><br>
            <strong style="color:rgba(59,130,246,.8);">① Pratiquez vous-même — toujours</strong><br>
            Pas pour l\'exemple. Pour votre propre découverte continue.<br>
            Un mentor qui arrête de pratiquer commence à transmettre de la mémoire, pas de la présence.<br><br>
            <strong style="color:rgba(20,184,166,.8);">② Cherchez activement les gens qui vous contredisent</strong><br>
            Pas pour les convaincre. Pour vous laisser questionner.<br>
            La friction intellectuelle est ce qui empêche la solidification.<br><br>
            <strong style="color:rgba(168,85,247,.8);">③ Servez-vous de vos étudiants comme enseignants</strong><br>
            Ils voient des choses que vous ne voyez plus.<br>
            Leurs questions naïves sont souvent les plus profondes.<br>
            "Je ne sais pas — explorons ça ensemble" est une des phrases les plus puissantes d\'un mentor.<br><br>
            <strong style="color:rgba(201,168,76,.9);">④ Tenez un journal de vos propres découvertes récentes</strong><br>
            Si vous n\'avez rien de nouveau à noter depuis 3 mois... c\'est un signal d\'alarme.
            </div>'
        );

        // ── LEÇON 4 : La Lignée Vivante ───────────────────────────────────────
        $lignee = $this->card($purple, 'Leçon 4', 'La Lignée Vivante — ce que vous envoyez dans le futur sans le savoir',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Voici une réalité rarement contemplée par les mentors :<br><br>
            <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.9rem 1.2rem;border:1px solid rgba(168,85,247,.18);margin:.75rem 0;font-size:.9rem;line-height:2.4;">
            Vos étudiants vont, un jour, transmettre à d\'autres.<br>
            Ces autres vont transmettre à d\'autres encore.<br>
            Dans 20 ans, des gens qui ne vous ont jamais rencontré<br>
            seront influencés par la façon dont vous vous êtes comporté<br>
            avec vos étudiants d\'aujourd\'hui.
            </div>
            Ce n\'est pas une métaphore. C\'est de la transmission du comportement.<br>
            Comme un virus — bienveillant ou toxique — qui se propage dans le temps.<br><br>
            <strong>Ce que les grands transmetteurs savent :</strong><br><br>
            → Ils ne transmettent pas <em>leur</em> méthode. Ils transmettent l\'amour de la méthode.<br>
            → Ils ne veulent pas des copies d\'eux-mêmes. Ils veulent des versions différentes qui continuent le feu.<br>
            → Leur victoire la plus haute est un étudiant qui <em>les dépasse</em> et qui célèbre cela avec eux.<br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.9rem 1.2rem;border:1px solid rgba(201,168,76,.18);margin:.75rem 0;">
            <strong>La question que chaque mentor devrait se poser une fois par an :</strong><br><br>
            <em>"Est-ce que mes étudiants, en observant ma vie, apprennent ce que je veux qu\'ils apprennent ?"</em>
            </div>
            Si la réponse est "je ne suis pas sûr" — c\'est là que le travail commence.
            </div>'
        );

        // ── PRATIQUE : L'Inventaire du Curriculum Invisible ───────────────────
        $pratique = $this->card($orange, 'Pratique Finale', 'L\'Inventaire du Curriculum Invisible — 20 minutes qui changent tout',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Prenez votre journal de mentor.<br>
            Installez-vous dans un endroit calme.<br>
            Prenez le temps de trois respirations 5-5-5 complètes.<br><br>
            <div style="background:rgba(249,115,22,.07);border-radius:10px;padding:1rem 1.2rem;border:1px solid rgba(249,115,22,.18);margin:.75rem 0;">
            <strong>Répondez honnêtement — pas la version idéale, la version vraie :</strong><br><br>
            <strong style="color:rgba(201,168,76,.9);">① Votre pratique personnelle :</strong><br>
            Dans les 30 derniers jours — avez-vous pratiqué les outils que vous enseignez pour vous-même ?<br>
            Si oui : quelle découverte récente pourriez-vous partager que vous n\'avez pas encore partagée ?<br>
            Si non : qu\'est-ce que cela dit de ce que vous transmettez réellement ?<br><br>
            <strong style="color:rgba(20,184,166,.9);">② Votre dernier échec visible :</strong><br>
            Quel est le dernier raté que vous avez eu dans votre rôle de mentor ?<br>
            Avez-vous pu en parler à vos étudiants ? Pourquoi oui ou non ?<br>
            Qu\'aurait-il été possible de transmettre si vous l\'aviez partagé ?<br><br>
            <strong style="color:rgba(59,130,246,.9);">③ Votre zone de crystallisation :</strong><br>
            Y a-t-il un enseignement que vous donnez sur "pilotage automatique" depuis trop longtemps ?<br>
            Quelle question neuve pourrait le rouvrir ?<br><br>
            <strong style="color:rgba(168,85,247,.9);">④ Votre curriculum invisible actuel :</strong><br>
            Si vos étudiants devaient vous décrire à des inconnus — pas votre enseignement, VOUS —<br>
            qu\'est-ce qu\'ils diraient selon vous ?<br>
            Est-ce ce que vous souhaitez transmettre ?<br><br>
            <strong style="color:rgba(34,197,94,.9);">⑤ Votre héritage :</strong><br>
            Citez 3 comportements ou façons d\'être que vous espérez voir chez vos étudiants dans 10 ans.<br>
            Est-ce que VOUS incarnez ces 3 choses aujourd\'hui ?<br>
            Où est l\'écart ?
            </div>
            Ce n\'est pas un examen. C\'est une boussole.<br>
            Revenir à cet inventaire une fois par an est l\'acte le plus honnête d\'un mentor.
            </div>'
        );

        // ── ACTIVITÉS ─────────────────────────────────────────────────────────
        $activities = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — Ce que vous transmettez sans l\'avoir enseigné',
                'duration'    => '10 min',
                'description' => 'La vérité que peu de mentors ont le courage de regarder : vos étudiants n\'apprennent pas ce que vous enseignez — ils apprennent ce que vous êtes. Le Curriculum Invisible.',
                'content'     => $intro,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 1 — Les 5 choses que vous transmettez sans le savoir',
                'duration'    => '30 min',
                'description' => 'Votre relation à la pratique · à vos erreurs · à l\'incertitude · au conflit · à vos limites. Le diagnostic que tout mentor devrait faire.',
                'content'     => $curriculum,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 2 — L\'Échec comme Matière Pédagogique',
                'duration'    => '25 min',
                'description' => 'Pourquoi vos échecs partagés sont plus puissants que vos réussites. Les 3 règles du partage d\'échec qui transforme vraiment. L\'art de tomber devant ses étudiants avec grâce.',
                'content'     => $echec,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 3 — Le Paradoxe du Maître : rester étudiant permanent',
                'duration'    => '20 min',
                'description' => 'La crystallisation du savoir — le piège silencieux. Différence entre réciter et découvrir. Les 4 pratiques du perpétuel étudiant.',
                'content'     => $etudiant,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 4 — La Lignée Vivante',
                'duration'    => '15 min',
                'description' => 'Ce que vous envoyez dans le futur sans le savoir. Dans 20 ans, des gens que vous n\'avez jamais rencontrés porteront la façon dont vous vous comportez avec vos étudiants aujourd\'hui.',
                'content'     => $lignee,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Pratique Finale — L\'Inventaire du Curriculum Invisible',
                'duration'    => '20 min',
                'description' => '5 questions honnêtes sur votre pratique réelle, votre dernier échec visible, votre zone de crystallisation, ce que vous transmettez vraiment, et l\'héritage que vous construisez.',
                'content'     => $pratique,
            ],
            [
                'type'        => 'reflexion',
                'title'       => 'Engagement — Ma Lettre au Mentor que je veux Être',
                'duration'    => '30 min',
                'description' => 'Écrire une lettre à votre futur vous dans 5 ans. Pas sur vos objectifs — sur la façon d\'être. Qu\'est-ce que vous voulez transmettre sans parler ? Là est votre vrai héritage.',
            ],
        ];

        // ── EN ACTIVITÉS ──────────────────────────────────────────────────────
        $activities_en = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — What You Transmit Without Having Taught It',
                'duration'    => '10 min',
                'description' => 'The truth few mentors have the courage to face: your students don\'t learn what you teach — they learn what you are. The Invisible Curriculum.',
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Lesson 1 — The 5 Things You Transmit Without Knowing It',
                'duration'    => '30 min',
                'description' => 'Your relationship to your practice · your errors · uncertainty · conflict · your limits. The diagnosis every mentor should perform.',
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Lesson 2 — Failure as Pedagogical Material',
                'duration'    => '25 min',
                'description' => 'Why your shared failures are more powerful than your shared successes. The 3 rules of transformative failure sharing. The art of falling in front of your students with grace.',
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Lesson 3 — The Master\'s Paradox: Remaining a Permanent Student',
                'duration'    => '20 min',
                'description' => 'Knowledge crystallisation — the silent trap. The difference between reciting and discovering. The 4 practices of the perpetual student.',
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Lesson 4 — The Living Lineage',
                'duration'    => '15 min',
                'description' => 'What you send into the future without knowing it. In 20 years, people you\'ve never met will carry the way you behave with your students today.',
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Final Practice — The Invisible Curriculum Inventory',
                'duration'    => '20 min',
                'description' => '5 honest questions about your real practice, your last visible failure, your crystallisation zone, what you\'re really transmitting, and the legacy you\'re building.',
            ],
            [
                'type'        => 'reflexion',
                'title'       => 'Commitment — My Letter to the Mentor I Want to Be',
                'duration'    => '30 min',
                'description' => 'Write a letter to your future self in 5 years. Not about your goals — about your way of being. What do you want to transmit without speaking? There lies your true legacy.',
            ],
        ];

        DB::table('formation_modules')->updateOrInsert(
            ['slug' => 'mentor-10-transmission-invisible', 'track' => 'mentor'],
            [
                'slug'           => 'mentor-10-transmission-invisible',
                'title'          => 'La Transmission Invisible — Ce que tu Transmets Sans Parler',
                'title_en'       => 'The Invisible Transmission — What You Transmit Without Speaking',
                'week_label'     => 'Module 10 · Final',
                'track'          => 'mentor',
                'order'          => 10,
                'is_active'      => true,
                'intro_text'     => "LA TRANSMISSION INVISIBLE — Module Final\n\nLe module le plus rare. Celui que personne n'enseigne.\n\nVos étudiants n'apprennent pas ce que vous enseignez — ils apprennent ce que vous êtes.\nLe Curriculum Invisible. L'Échec comme Matière Pédagogique. Rester un Étudiant Permanent.\nLa Lignée Vivante. L'Inventaire final du Mentor.",
                'intro_text_en'  => "THE INVISIBLE TRANSMISSION — Final Module\n\nThe rarest module. The one nobody teaches.\n\nYour students don't learn what you teach — they learn what you are.\nThe Invisible Curriculum. Failure as Pedagogical Material. Remaining a Permanent Student.\nThe Living Lineage. The Mentor's Final Inventory.",
                'description'    => "Curriculum invisible (5 dimensions) · Échec comme matière pédagogique · Paradoxe du maître-étudiant · Crystallisation du savoir · La lignée vivante · Inventaire final",
                'description_en' => "Invisible curriculum (5 dimensions) · Failure as pedagogical material · Master-student paradox · Knowledge crystallisation · The living lineage · Final inventory",
                'activities'     => json_encode($activities),
                'activities_en'  => json_encode($activities_en),
                'audio_path'     => null,
                'audio_path_en'  => null,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]
        );

        $this->command->info('[FormationMentorModule10Seeder] ✓ 7 activités — La Transmission Invisible.');
    }
}
