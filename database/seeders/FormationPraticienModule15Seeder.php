<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * MODULE 15 — La Signature du Praticien
 * Formation Praticien · Module final
 * Arc pédagogique : intégration complète · style unique · offre professionnelle ·
 *                   engagement éthique · déclaration de praticien
 */
class FormationPraticienModule15Seeder extends Seeder
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
        $intro = $this->card($gold, 'Module 15 · Final', 'Vous êtes arrivé. Maintenant — qui êtes-vous vraiment ?',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Ce module ne vous apprend rien de nouveau.<br>
            Il vous aide à <strong>voir ce que vous êtes devenu</strong>.<br><br>
            Depuis le module 00 jusqu\'ici, vous avez :<br>
            → Compris le corps et le souffle dans sa dimension neurobiologique<br>
            → Traversé vos propres blessures et ressources<br>
            → Maîtrisé les outils et les protocoles<br>
            → Intégré la posture, la voix, l\'état interne<br>
            → Compris ce qui guérit vraiment<br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.9rem 1.2rem;border:1px solid rgba(201,168,76,.18);margin:.75rem 0;">
            Il reste une étape.<br>
            La plus difficile pour beaucoup.<br><br>
            <strong>Incarner tout cela comme VOTRE propre signature.</strong><br><br>
            Pas la copie d\'un autre praticien.<br>
            Pas le clone d\'un modèle admirable.<br>
            <em>Vous — unique, imparfait, vivant, singulier.</em>
            </div>
            La signature du praticien, c\'est ce que les clients reconnaissent<br>
            avant même que vous parliez.<br>
            C\'est l\'empreinte que vous laissez quand vous êtes pleinement vous-même.
            </div>'
        );

        // ── LEÇON 1 : Les 5 dimensions de la signature ────────────────────────
        $cinq_dimensions = $this->card($teal, 'Leçon 1', 'Les 5 dimensions de votre signature de praticien',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            <div style="display:flex;flex-direction:column;gap:.95rem;margin:.75rem 0;">
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(201,168,76,.6);">
            <strong style="color:rgba(201,168,76,.9);">① Votre tonalité naturelle</strong><br>
            Êtes-vous chaleureux ou structuré ? Intuitif ou méthodique ? Silencieux ou guidant ?<br>
            Ce n\'est pas ce que vous choisissez de montrer. C\'est ce qui émerge quand vous êtes à l\'aise.<br>
            <em>Votre tonalité est juste. Elle s\'affine. Elle ne se remplace pas.</em>
            </div>
            <div style="background:rgba(20,184,166,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(20,184,166,.6);">
            <strong style="color:rgba(20,184,166,.9);">② Votre public naturel</strong><br>
            Qui vient vers vous spontanément ? Qui se sent immédiatement à l\'aise avec vous ?<br>
            Ce sont les personnes que vous êtes le mieux équipé pour accompagner.<br>
            Non pas les seules — mais les premières. Ceux pour qui vous avez une résonance particulière.<br>
            <em>Servir son public naturel d\'abord, c\'est choisir l\'efficacité avant l\'universalité.</em>
            </div>
            <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(59,130,246,.6);">
            <strong style="color:rgba(59,130,246,.9);">③ Votre outil de prédilection</strong><br>
            Parmi tout ce que vous avez appris — où êtes-vous le plus naturellement à l\'aise ?<br>
            La cohérence cardiaque guidée ? Les cycles de libération émotionnelle ?<br>
            Le travail sur le corps endormi ? L\'accompagnement de la transition ?<br>
            <em>Maîtriser un outil en profondeur vaut plus que de savoir dix techniques à la surface.</em>
            </div>
            <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(168,85,247,.6);">
            <strong style="color:rgba(168,85,247,.9);">④ Votre promesse implicite</strong><br>
            Pas votre accroche marketing. La promesse que votre présence fait sans que vous la formuliez.<br>
            "Avec cet praticien, je vais être en sécurité."<br>
            "Avec cet praticien, je vais être challengé à aller plus loin."<br>
            "Avec cet praticien, je vais enfin être compris."<br>
            <em>Connaître votre promesse implicite permet de la tenir consciemment.</em>
            </div>
            <div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(249,115,22,.6);">
            <strong style="color:rgba(249,115,22,.9);">⑤ Votre valeur fondatrice</strong><br>
            La valeur que vous ne sacrifiez jamais dans votre pratique.<br>
            L\'intégrité ? L\'authenticité ? La profondeur ? La douceur ? La vérité nommée ?<br>
            C\'est le fil conducteur de tout ce que vous faites.<br>
            <em>Quand vous prenez une décision difficile dans votre pratique, c\'est cette valeur qui tranche.</em>
            </div>
            </div>
            </div>'
        );

        // ── LEÇON 2 : Construire son offre de praticien ───────────────────────
        $offre = $this->card($blue, 'Leçon 2', 'Construire une offre juste — ni trop peu ni trop vaste',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Beaucoup de praticiens sabotent eux-mêmes leur pratique professionnelle<br>
            en ayant une offre soit trop floue, soit trop large, soit trop complexe.<br><br>
            <div style="background:rgba(239,68,68,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(239,68,68,.4);margin:.75rem 0;">
            <strong style="color:rgba(239,68,68,.8);">Ce qui ne fonctionne pas :</strong><br>
            "J\'accompagne tout le monde avec plusieurs approches pour différents besoins."<br>
            → Personne ne sait si c\'est pour lui. Personne ne se reconnaît.<br>
            → Vous vous épuisez à vous adapter à tout et à tous.
            </div>
            <div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.85rem 1.1rem;border-left:3px solid rgba(34,197,94,.4);margin:.75rem 0;">
            <strong style="color:rgba(34,197,94,.8);">Ce qui fonctionne :</strong><br>
            <strong>Une offre principale · Un public précis · Une transformation claire.</strong><br><br>
            <em>Exemple concret :</em><br>
            "J\'accompagne des femmes de 35 à 55 ans en période de reconstruction<br>
            (divorce, deuil, burn-out) à retrouver un ancrage corporel stable<br>
            grâce au souffle et à la cohérence cardiaque.<br>
            En 8 séances, elles retrouvent un sommeil régulier, une clarté d\'esprit<br>
            et une relation au corps redevenue alliée."<br><br>
            Ce n\'est pas restrictif. C\'est lisible.
            </div>
            <strong>La structure d\'une offre juste (3 éléments) :</strong><br><br>
            <strong style="color:rgba(201,168,76,.9);">① Pour qui :</strong> un profil précis (pas une population entière)<br>
            <strong style="color:rgba(20,184,166,.9);">② A partir de quoi :</strong> une situation de départ concrète<br>
            <strong style="color:rgba(59,130,246,.9);">③ Vers quoi :</strong> une transformation mesurable<br><br>
            <em>Tout le reste — la méthode, les outils, les séances — est au service de ces 3 éléments.</em>
            </div>'
        );

        // ── LEÇON 3 : L'éthique du praticien ─────────────────────────────────
        $ethique = $this->card($red, 'Leçon 3', 'L\'Éthique du Praticien — ce que vous vous engagez à ne jamais faire',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            La formation vous a transmis des outils puissants.<br>
            Des outils qui accèdent aux couches profondes du système nerveux.<br>
            Qui déverrouillent des émotions. Qui touchent aux blessures primaires.<br><br>
            <strong>Ce pouvoir s\'accompagne d\'une responsabilité absolue.</strong><br><br>
            <div style="display:flex;flex-direction:column;gap:.85rem;margin:.75rem 0;">
            <div style="background:rgba(239,68,68,.08);border-radius:10px;padding:.85rem 1.1rem;">
            <strong style="color:rgba(239,68,68,.8);">① Je ne dépasse jamais mes compétences.</strong><br>
            Si un client présente des symptômes qui dépassent l\'accompagnement bien-être<br>
            (crises dissociatives, idées suicidaires, psychose active) —<br>
            je l\'oriente immédiatement vers un professionnel de santé mentale.<br>
            Ce n\'est pas un aveu de faiblesse. C\'est de la déontologie.
            </div>
            <div style="background:rgba(249,115,22,.08);border-radius:10px;padding:.85rem 1.1rem;">
            <strong style="color:rgba(249,115,22,.8);">② Je ne crée pas de dépendance.</strong><br>
            Mon travail réussit quand mon client a moins besoin de moi —<br>
            quand il pratique seul, quand il porte ses propres outils.<br>
            Si je sens que je cherche à le garder, je supervise cela avec un pair.
            </div>
            <div style="background:rgba(59,130,246,.08);border-radius:10px;padding:.85rem 1.1rem;">
            <strong style="color:rgba(59,130,246,.8);">③ Je protège le cadre de la relation.</strong><br>
            Pas de relation personnelle, amicale ou intime avec un client en cours de suivi.<br>
            Pas de confidences sortant du cadre. Pas d\'exceptions "parce qu\'il/elle est spécial(e)".<br>
            Le cadre protège le client. Il vous protège aussi.
            </div>
            <div style="background:rgba(168,85,247,.08);border-radius:10px;padding:.85rem 1.1rem;">
            <strong style="color:rgba(168,85,247,.8);">④ Je continue de me former et de me superviser.</strong><br>
            Un praticien qui arrête d\'apprendre stagne. Son efficacité baisse.<br>
            La supervision (au moins mensuelle) n\'est pas un signe que ça va mal —<br>
            c\'est le signe que vous prenez votre pratique au sérieux.
            </div>
            <div style="background:rgba(34,197,94,.08);border-radius:10px;padding:.85rem 1.1rem;">
            <strong style="color:rgba(34,197,94,.8);">⑤ Je reste moi-même.</strong><br>
            Je ne joue pas un rôle de "thérapeute". Je ne performe pas la sagesse.<br>
            Ma singularité — mes doutes inclus — est ma plus grande force.<br>
            <em>Un praticien authentique imparfait vaut mille fois plus qu\'un praticien parfait joué.</em>
            </div>
            </div>
            </div>'
        );

        // ── MÉDITATION FINALE : Déclaration du Praticien ─────────────────────
        $declaration = $this->card($gold, 'Méditation Finale', 'Ma Déclaration de Praticien',
            '<div style="font-size:.88rem;line-height:2.3;color:rgba(232,224,208,.82);">
            Cette pratique est le cœur de ce module.<br>
            Ne la lisez pas. Vivez-la.<br><br>
            <div style="background:rgba(201,168,76,.06);border-radius:10px;padding:1.1rem 1.3rem;border:1px solid rgba(201,168,76,.2);margin:.75rem 0;">
            <strong>① Installez-vous (2 min)</strong><br>
            Position droite, pieds au sol.<br>
            Trois respirations 5-5-5 : inspirez profondément... bloquez... relâchez.<br>
            Laissez l\'espace se calmer complètement.<br><br>
            <strong>② L\'inventaire (5 min)</strong><br>
            Traversez mentalement tout ce que vous avez appris depuis le module 00.<br>
            Pas pour vous en souvenir — juste pour laisser défiler.<br>
            Vos moments de doute. Vos moments de clarté.<br>
            Ce qui était facile. Ce qui vous a résisté.<br><br>
            <strong>③ La déclaration (3 min)</strong><br>
            Posez votre main droite sur votre cœur.<br>
            Dites à voix haute, ou intérieurement avec toute votre présence :<br><br>
            <em style="line-height:2.8;display:block;">"Je m\'appelle [votre prénom].<br>
            Je suis praticien du souffle.<br>
            Je sers en transmettant ce que j\'ai moi-même traversé.<br>
            Ma présence est mon premier outil.<br>
            Ma blessure intégrée est ma qualification la plus profonde.<br>
            Je ne prétends pas être parfait — je m\'engage à être présent.<br>
            Et à rester présent — pour ceux que j\'accompagne,<br>
            et pour moi-même."</em><br><br>
            <strong>④ L\'engagement écrit (5 min)</strong><br>
            Dans votre journal de praticien, écrivez votre propre version de cette déclaration.<br>
            En vos mots. Avec votre voix.<br>
            Ce texte est votre boussole pour les années qui viennent.
            </div>
            </div>'
        );

        // ── INTÉGRATION : Les 10 engagements ─────────────────────────────────
        $engagements = $this->card($purple, 'Synthèse', 'Les 10 engagements du Praticien Pause Souffle',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            <div style="display:flex;flex-direction:column;gap:.65rem;margin:.5rem 0;">
            <div style="background:rgba(0,0,0,.2);border-radius:8px;padding:.7rem 1rem;border-left:2px solid rgba(201,168,76,.5);">
            <strong style="color:rgba(201,168,76,.9);">①</strong> Je pratique moi-même quotidiennement — pas pour l\'exemple, pour ma propre santé.
            </div>
            <div style="background:rgba(0,0,0,.2);border-radius:8px;padding:.7rem 1rem;border-left:2px solid rgba(20,184,166,.5);">
            <strong style="color:rgba(20,184,166,.9);">②</strong> Je crée un espace sûr pour chaque client — avant, pendant et après chaque séance.
            </div>
            <div style="background:rgba(0,0,0,.2);border-radius:8px;padding:.7rem 1rem;border-left:2px solid rgba(59,130,246,.5);">
            <strong style="color:rgba(59,130,246,.9);">③</strong> Je me connais suffisamment pour distinguer ma blessure de celle de mon client.
            </div>
            <div style="background:rgba(0,0,0,.2);border-radius:8px;padding:.7rem 1rem;border-left:2px solid rgba(168,85,247,.5);">
            <strong style="color:rgba(168,85,247,.9);">④</strong> Je ne dépasse pas mes compétences — et j\'oriente sans honte quand nécessaire.
            </div>
            <div style="background:rgba(0,0,0,.2);border-radius:8px;padding:.7rem 1rem;border-left:2px solid rgba(249,115,22,.5);">
            <strong style="color:rgba(249,115,22,.9);">⑤</strong> Je construis une pratique à mon image — pas une copie d\'un autre modèle.
            </div>
            <div style="background:rgba(0,0,0,.2);border-radius:8px;padding:.7rem 1rem;border-left:2px solid rgba(34,197,94,.5);">
            <strong style="color:rgba(34,197,94,.9);">⑥</strong> Je me supervise régulièrement — c\'est ma déontologie, pas ma faiblesse.
            </div>
            <div style="background:rgba(0,0,0,.2);border-radius:8px;padding:.7rem 1rem;border-left:2px solid rgba(239,68,68,.5);">
            <strong style="color:rgba(239,68,68,.9);">⑦</strong> Je protège le cadre thérapeutique — il protège le client et me protège moi.
            </div>
            <div style="background:rgba(0,0,0,.2);border-radius:8px;padding:.7rem 1rem;border-left:2px solid rgba(201,168,76,.5);">
            <strong style="color:rgba(201,168,76,.9);">⑧</strong> Je continue de me former — un praticien qui arrête d\'apprendre stagne.
            </div>
            <div style="background:rgba(0,0,0,.2);border-radius:8px;padding:.7rem 1rem;border-left:2px solid rgba(20,184,166,.5);">
            <strong style="color:rgba(20,184,166,.9);">⑨</strong> Mon objectif est l\'autonomie de mes clients — pas leur dépendance.
            </div>
            <div style="background:rgba(0,0,0,.2);border-radius:8px;padding:.7rem 1rem;border-left:2px solid rgba(168,85,247,.5);">
            <strong style="color:rgba(168,85,247,.9);">⑩</strong> Je reste moi-même — imparfait, présent, vivant. C\'est ma plus grande force.
            </div>
            </div>
            </div>'
        );

        // ── ACTIVITÉS ─────────────────────────────────────────────────────────
        $activities = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — Vous êtes arrivé. Qui êtes-vous ?',
                'duration'    => '10 min',
                'description' => 'Le module final ne vous apprend rien — il vous aide à voir ce que vous êtes devenu. L\'enjeu : incarner votre signature unique.',
                'content'     => $intro,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 1 — Les 5 dimensions de votre signature',
                'duration'    => '30 min',
                'description' => 'Tonalité naturelle · public naturel · outil de prédilection · promesse implicite · valeur fondatrice. Cartographier ce qui est déjà là.',
                'content'     => $cinq_dimensions,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 2 — Construire une offre juste',
                'duration'    => '25 min',
                'description' => 'Pourquoi les offres "pour tout le monde" ne fonctionnent pas. La structure en 3 éléments : pour qui · à partir de quoi · vers quoi. Exemple concret.',
                'content'     => $offre,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 3 — L\'Éthique du Praticien',
                'duration'    => '20 min',
                'description' => '5 engagements éthiques fondamentaux : ne pas dépasser ses compétences · ne pas créer de dépendance · protéger le cadre · continuer à se former · rester soi-même.',
                'content'     => $ethique,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Synthèse — Les 10 Engagements du Praticien Pause Souffle',
                'duration'    => '10 min',
                'description' => 'La charte vivante qui traversera toute votre pratique. À relire régulièrement — pas comme une règle, comme un rappel de qui vous avez choisi d\'être.',
                'content'     => $engagements,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Méditation Finale — Ma Déclaration de Praticien',
                'duration'    => '15 min',
                'description' => 'Ancrage · inventaire du chemin parcouru · déclaration à voix haute · rédaction dans le journal de praticien. Le moment le plus important de cette formation.',
                'content'     => $declaration,
            ],
            [
                'type'        => 'exercice',
                'title'       => 'Exercice — Rédiger ma Signature en 3 phrases',
                'duration'    => '30 min',
                'description' => 'Formuler en 3 phrases votre signature complète : pour qui vous êtes fait · ce que vous apportez · ce qui vous rend unique. À partager dans la communauté des praticiens Pause Souffle.',
            ],
            [
                'type'        => 'reflexion',
                'title'       => 'Réflexion finale — Ce que ce chemin a changé',
                'duration'    => '20 min',
                'description' => 'Qui étiez-vous avant le module 00 ? Qui êtes-vous maintenant ? Qu\'est-ce que vous allez faire de tout cela ? Écriture libre sans censure.',
            ],
        ];

        // ── EN ACTIVITÉS ──────────────────────────────────────────────────────
        $activities_en = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — You Have Arrived. Who Are You?',
                'duration'    => '10 min',
                'description' => 'The final module teaches nothing new — it helps you see what you have become. The challenge: embodying your unique signature.',
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Lesson 1 — The 5 Dimensions of Your Signature',
                'duration'    => '30 min',
                'description' => 'Natural tone · natural audience · preferred tool · implicit promise · founding value. Mapping what is already there.',
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Lesson 2 — Building a Fair Offer',
                'duration'    => '25 min',
                'description' => 'Why "for everyone" offerings don\'t work. The 3-element structure: for whom · starting from what · toward what.',
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Lesson 3 — The Practitioner\'s Ethics',
                'duration'    => '20 min',
                'description' => '5 fundamental ethical commitments: don\'t exceed your competence · don\'t create dependence · protect the frame · keep learning · remain yourself.',
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Synthesis — The 10 Commitments of the Pause Souffle Practitioner',
                'duration'    => '10 min',
                'description' => 'The living charter for your entire practice. To be revisited regularly — not as a rule, but as a reminder of who you have chosen to be.',
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Final Meditation — My Practitioner Declaration',
                'duration'    => '15 min',
                'description' => 'Grounding · inventory of the journey · declaration aloud · writing in the practitioner journal. The most important moment of this training.',
            ],
            [
                'type'        => 'exercice',
                'title'       => 'Exercise — Write My Signature in 3 Sentences',
                'duration'    => '30 min',
                'description' => 'Formulating in 3 sentences your complete signature: for whom you are made · what you bring · what makes you unique.',
            ],
            [
                'type'        => 'reflexion',
                'title'       => 'Final Reflection — What This Path Has Changed',
                'duration'    => '20 min',
                'description' => 'Who were you before module 00? Who are you now? What will you do with all this? Free writing without censorship.',
            ],
        ];

        DB::table('formation_modules')->updateOrInsert(
            ['slug' => '15-signature-du-praticien', 'track' => 'praticien'],
            [
                'slug'           => '15-signature-du-praticien',
                'title'          => 'La Signature du Praticien — Qui Êtes-Vous Vraiment ?',
                'title_en'       => 'The Practitioner\'s Signature — Who Are You Really?',
                'week_label'     => 'Module 15 · Final',
                'track'          => 'praticien',
                'order'          => 11,
                'is_active'      => true,
                'intro_text'     => "LA SIGNATURE DU PRATICIEN — Module Final\n\nVous êtes arrivé. Ce module ne vous apprend rien de nouveau — il vous aide à voir ce que vous êtes devenu.\n\nLes 5 dimensions de votre signature. Construire une offre juste. L'éthique du praticien. Les 10 engagements. La déclaration finale.",
                'intro_text_en'  => "THE PRACTITIONER'S SIGNATURE — Final Module\n\nYou have arrived. This module teaches nothing new — it helps you see what you have become.\n\nThe 5 dimensions of your signature. Building a fair offer. Practitioner ethics. The 10 commitments. The final declaration.",
                'description'    => "5 dimensions de la signature · Offre juste (pour qui · à partir de quoi · vers quoi) · Éthique du praticien (5 engagements) · Les 10 engagements du Praticien Pause Souffle · Méditation de déclaration finale",
                'description_en' => "5 signature dimensions · Fair offer structure · Practitioner ethics (5 commitments) · The 10 Practitioner commitments · Final declaration meditation",
                'activities'     => json_encode($activities),
                'activities_en'  => json_encode($activities_en),
                'audio_path'     => null,
                'audio_path_en'  => null,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]
        );

        $this->command->info('[FormationPraticienModule15Seeder] ✓ 8 activités — La Signature du Praticien.');
    }
}
