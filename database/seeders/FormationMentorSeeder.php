<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Formation Mentor — 9 modules complets
 * Track : mentor | 80% en ligne · 20% en visio
 * Valeur fondatrice : Le Leader est un Serviteur (Marc 10:43-45)
 * Style : inspirant · impactant · intuitif · attractif · premium
 */
class FormationMentorSeeder extends Seeder
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

    private function verse(): string
    {
        return '<div style="background:rgba(201,168,76,.06);border-left:3px solid rgba(201,168,76,.5);border-radius:0 10px 10px 0;padding:.85rem 1.25rem;margin:1rem 0;">'
            .'<div style="font-size:.62rem;text-transform:uppercase;letter-spacing:.14em;color:rgba(201,168,76,.55);margin-bottom:.4rem;">Fondement · Marc 10:43-45</div>'
            .'<p style="font-size:.82rem;font-family:Georgia,serif;font-style:italic;color:rgba(232,224,208,.8);line-height:1.85;margin:0;">'
            .'« Celui qui voudra devenir grand parmi vous sera votre serviteur, et celui qui voudra être le premier sera l\'esclave de tous. Car le Fils de l\'homme n\'est pas venu pour être servi, mais pour servir. »'
            .'</p>'
            .'</div>';
    }

    // ══════════════════════════════════════════════════════
    // MODULE 01 — L'Identité du Mentor
    // ══════════════════════════════════════════════════════
    private function module01(): array
    {
        $gold = 'rgba(201,168,76,.9)'; $blue = 'rgba(59,130,246,.8)'; $purple = 'rgba(168,85,247,.8)'; $green = 'rgba(34,197,94,.8)';

        $intro = $this->card($gold, 'Module 01 · Mentor', 'Qui je suis avant ce que je transmets',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            Un mentor qui ne sait pas qui il est transmet sa confusion.<br>
            Un mentor qui se connaît transmet sa clarté.<br><br>
            Ce module pose la question fondatrice : <strong>qui es-tu, toi qui oses accompagner ?</strong><br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;border:1px solid rgba(201,168,76,.15);margin:.75rem 0;">
            <strong style="color:rgba(201,168,76,.9);">Le paradoxe du mentor :</strong><br><br>
            Tu n\'accompagnes personne plus loin que toi-même.<br>
            Ta limite est la limite de ton voyage intérieur.<br>
            Mais ta profondeur... est exactement ce dont quelqu\'un a besoin.
            </div>'
            .$this->verse()
            .'<em style="color:rgba(201,168,76,.8);">À la fin de ce module : vous rédigez votre Identité de Mentor — une boussole qui ne mentira jamais.</em>
            </div>'
        );

        $valeurs = $this->card($blue, 'Leçon 1', 'Vos valeurs fondatrices — ce qui reste quand tout le reste part',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            Les valeurs ne sont pas des idées que vous admirez.<br>
            Ce sont des lignes que vous ne franchissez pas — même sous pression.<br><br>
            <strong style="color:rgba(59,130,246,.9);">Exercice des valeurs en 3 temps :</strong><br><br>
            <strong>① Repérez :</strong> Quand avez-vous ressenti une colère profonde ? (Une valeur était bafouée.)<br>
            <strong>② Nommez :</strong> Choisissez vos 3 valeurs-socles parmi : Intégrité · Liberté · Courage · Service · Vérité · Amour · Discipline · Justice · Croissance · Paix<br>
            <strong>③ Testez :</strong> Pour chaque valeur — "Est-ce que j\'y vis réellement, ou est-ce juste beau à dire ?"<br><br>
            <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.75rem 1rem;margin-top:.75rem;">
            <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(59,130,246,.55);margin-bottom:.5rem;">─ La question qui tranche ─</div>
            Si vous ne pouviez garder qu\'une seule valeur — et devoir construire toute votre vie de mentor autour d\'elle — laquelle choisissez-vous ?<br><br>
            <em>C\'est votre valeur fondatrice.</em>
            </div>
            </div>'
        );

        $blessures = $this->card($purple, 'Leçon 2', 'Vos blessures traversées — votre matière première',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            Le monde a des coachs certifiés qui n\'ont rien traversé.<br>
            Et des mentors sans diplôme qui ont sauvé des vies.<br><br>
            La différence : <strong>la profondeur de ce qui a été vécu, traversé, intégré.</strong><br><br>
            <strong style="color:rgba(168,85,247,.9);">Le retournement mentor :</strong><br><br>
            ① Ma blessure principale : ___<br>
            ② Ce qu\'elle m\'a coûté : ___<br>
            ③ Ce qu\'elle m\'a appris que rien d\'autre n\'aurait pu m\'apprendre : ___<br>
            ④ Pour qui cette blessure est-elle devenue une clé ? : ___<br><br>
            <em style="color:rgba(168,85,247,.7);">"Votre cicatrice n\'est pas ce qui vous disqualifie. C\'est exactement ce qui vous qualifie."</em>
            </div>'
        );

        $pratique = $this->card($green, 'Méditation guidée · 20 min', 'Scan de l\'identité profonde',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            Fermez les yeux. 3 souffles profonds, 5-5-5.<br><br>
            Posez cette question à votre corps : <em>"Qui suis-je quand personne ne regarde ?"</em><br><br>
            Restez dans le silence. Laissez venir sans chercher.<br>
            Observez les images. Les mots. Les sensations.<br><br>
            Puis posez : <em>"Qu\'est-ce que j\'ai à donner que personne d\'autre ne peut donner ?"</em><br><br>
            Notez ce qui émerge — sans censure — dans votre carnet de mentor.
            </div>'
        );

        $activities = [
            ['type'=>'lecture','title'=>'Introduction — Qui je suis avant ce que je transmets','duration'=>'15 min','description'=>'Le paradoxe du mentor. Pourquoi l\'identité précède la méthode. Le verset fondateur (Marc 10:43-45).','content'=>$intro],
            ['type'=>'lecture','title'=>'Leçon 1 — Vos valeurs fondatrices','duration'=>'20 min','description'=>'Identifier les 3 valeurs-socles. L\'exercice en 3 temps : repérer, nommer, tester. La valeur fondatrice unique.','content'=>$valeurs],
            ['type'=>'lecture','title'=>'Leçon 2 — Vos blessures comme matière première','duration'=>'20 min','description'=>'Le retournement mentor. Transformer ce qui a été traversé en ressource active pour les autres.','content'=>$blessures],
            ['type'=>'pratique','title'=>'Méditation guidée — Scan de l\'identité profonde','duration'=>'20 min','description'=>'Méditation sonore guidée. La question centrale : qui suis-je quand personne ne regarde ?','content'=>$pratique],
            ['type'=>'exercice','title'=>'Exercice — Mon Identité de Mentor','duration'=>'25 min','description'=>'Rédiger son identité en 5 phrases : valeur fondatrice · blessure traversée · force singulière · mission · engagement.'],
            ['type'=>'reflexion','title'=>'Intégration — Lettre à mon futur accompagné','duration'=>'15 min','description'=>'"Je ne suis pas qui tu crois. Je suis quelqu\'un qui a traversé ce que tu vis. Et voici ce que j\'ai appris..."'],
        ];

        $activitiesEn = [
            ['type'=>'lecture','title'=>'Introduction — Who I am before what I transmit','duration'=>'15 min','description'=>'The mentor paradox. Why identity precedes method. The founding verse (Mark 10:43-45).'],
            ['type'=>'lecture','title'=>'Lesson 1 — Your founding values','duration'=>'20 min','description'=>'Identifying the 3 core values. The 3-step exercise: spot, name, test. Your single founding value.'],
            ['type'=>'lecture','title'=>'Lesson 2 — Your wounds as raw material','duration'=>'20 min','description'=>'The mentor reversal. Transforming what was endured into an active resource for others.'],
            ['type'=>'pratique','title'=>'Guided meditation — Deep identity scan','duration'=>'20 min','description'=>'Guided audio meditation. The central question: who am I when nobody is watching?'],
            ['type'=>'exercice','title'=>'Exercise — My Mentor Identity','duration'=>'25 min','description'=>'Write your identity in 5 sentences: founding value · wound traversed · singular strength · mission · commitment.'],
            ['type'=>'reflexion','title'=>'Integration — Letter to my future mentee','duration'=>'15 min','description'=>'"I am not who you think. I am someone who has been through what you are living. And here is what I learned..."'],
        ];

        return compact('activities', 'activitiesEn');
    }

    // ══════════════════════════════════════════════════════
    // MODULE 02 — La Posture du Serviteur
    // ══════════════════════════════════════════════════════
    private function module02(): array
    {
        $gold = 'rgba(201,168,76,.9)'; $teal = 'rgba(20,184,166,.8)'; $red = 'rgba(239,68,68,.8)'; $green = 'rgba(34,197,94,.8)';

        $intro = $this->card($gold, 'Module 02 · Mentor', 'Le paradoxe de la force dans l\'humilité',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            Le monde confond autorité et leadership.<br>
            Il croit que commander, c\'est être grand.<br>
            Le mentor sait le contraire : <strong>c\'est en se mettant au service que l\'on devient inoubliable.</strong><br><br>
            '.$this->verse().'
            <em style="color:rgba(201,168,76,.8);">La posture du serviteur n\'est pas de la faiblesse. C\'est la forme la plus rare de courage.</em>
            </div>'
        );

        $posture = $this->card($teal, 'Leçon 1', 'Les 3 postures du mentor — distinguer pour choisir',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            <strong style="color:rgba(239,68,68,.8);">① Le formateur-autorité</strong> — Sait, enseigne, évalue. Relation verticale. Résultat : dépendance.<br><br>
            <strong style="color:rgba(201,168,76,.9);">② Le coach-expert</strong> — Guide, questionne, structure. Relation professionnelle. Résultat : performance.<br><br>
            <strong style="color:rgba(20,184,166,.8);">③ Le mentor-serviteur</strong> — Précède, protège, libère. Relation de vie. Résultat : autonomie durable.<br><br>
            <div style="background:rgba(20,184,166,.07);border-radius:10px;padding:.75rem 1rem;margin-top:.75rem;">
            La question que se pose le mentor-serviteur avant chaque échange :<br>
            <em>"Est-ce que cette interaction le/la rapproche de moi — ou de lui/elle-même ?"</em><br><br>
            Si la réponse est "de moi" : vous êtes en train de construire une dépendance, pas un mentor.
            </div>
            </div>'
        );

        $pieges = $this->card($red, 'Leçon 2', 'Les 4 pièges du mentor non-serviteur',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            <strong>① Le besoin de validation</strong> — Vous accompagnez pour être admiré. Signe : vous cherchez l\'approbation dans les yeux de vos accompagnés.<br><br>
            <strong>② Le contrôle déguisé en aide</strong> — Vous "guidez" vers là où vous voulez aller. Signe : vous êtes déçu quand ils ne suivent pas vos conseils.<br><br>
            <strong>③ L\'urgence de réparer</strong> — Vous voulez résoudre trop vite. Signe : vous interrompez pour donner des solutions avant d\'avoir vraiment compris.<br><br>
            <strong>④ L\'empreinte excessive</strong> — Vous voulez qu\'ils vous ressemblent. Signe : vous vous sentez menacé quand ils développent leur propre style.<br><br>
            <em style="color:rgba(239,68,68,.7);">L\'antidote : revenir au verset. Servir — pas briller.</em>
            </div>'
        );

        $pratique = $this->card($green, 'Méditation guidée · 20 min', 'La méditation du service pur',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            Installez-vous. 3 souffles 5-5-5.<br><br>
            Visualisez quelqu\'un que vous avez accompagné — ou que vous allez accompagner.<br>
            Observez votre intention profonde : <em>est-ce pour eux, ou pour vous ?</em><br><br>
            Sans jugement. Juste l\'honnêteté.<br><br>
            Posez : <em>"Si personne ne le savait jamais, est-ce que je ferais quand même ce que je fais ?"</em><br><br>
            Respirez avec cette réponse.
            </div>'
        );

        $activities = [
            ['type'=>'lecture','title'=>'Introduction — Le paradoxe de la force dans l\'humilité','duration'=>'15 min','description'=>'Formateur vs Coach vs Mentor-serviteur. Comment le service crée une influence durable.','content'=>$intro],
            ['type'=>'lecture','title'=>'Leçon 1 — Les 3 postures du mentor','duration'=>'20 min','description'=>'Autorité, expertise, service. Choisir consciemment sa posture selon chaque situation.','content'=>$posture],
            ['type'=>'lecture','title'=>'Leçon 2 — Les 4 pièges du mentor non-serviteur','duration'=>'20 min','description'=>'Validation, contrôle, urgence de réparer, empreinte excessive. Les reconnaître et les désamorcer.','content'=>$pieges],
            ['type'=>'pratique','title'=>'Méditation guidée — Le service pur','duration'=>'20 min','description'=>'Méditation de clarification de l\'intention profonde. Suis-je là pour eux ou pour moi ?','content'=>$pratique],
            ['type'=>'exercice','title'=>'Exercice — Journal du serviteur','duration'=>'20 min','description'=>'7 jours d\'observation : noter chaque soir une interaction du jour — était-ce centré sur l\'autre ou sur moi ?'],
            ['type'=>'reflexion','title'=>'Intégration — Mon engagement de service','duration'=>'10 min','description'=>'Rédiger une phrase d\'engagement : "En tant que mentor, je me engage à servir en..."'],
        ];

        $activitiesEn = [
            ['type'=>'lecture','title'=>'Introduction — The paradox of strength in humility','duration'=>'15 min','description'=>'Trainer vs Coach vs Servant-mentor. How service creates lasting influence.'],
            ['type'=>'lecture','title'=>'Lesson 1 — The 3 mentor postures','duration'=>'20 min','description'=>'Authority, expertise, service. Consciously choosing your posture in each situation.'],
            ['type'=>'lecture','title'=>'Lesson 2 — The 4 traps of the non-servant mentor','duration'=>'20 min','description'=>'Validation-seeking, hidden control, urgency to fix, excessive imprint. Recognize and disarm them.'],
            ['type'=>'pratique','title'=>'Guided meditation — Pure service','duration'=>'20 min','description'=>'Clarifying your deep intention: am I here for them or for myself?'],
            ['type'=>'exercice','title'=>'Exercise — The servant journal','duration'=>'20 min','description'=>'7 days of observation: note each evening one interaction — was it centered on the other or on me?'],
            ['type'=>'reflexion','title'=>'Integration — My service commitment','duration'=>'10 min','description'=>'Write a commitment sentence: "As a mentor, I commit to serve by..."'],
        ];

        return compact('activities', 'activitiesEn');
    }

    // ══════════════════════════════════════════════════════
    // MODULE 03 — L'Écoute Active
    // ══════════════════════════════════════════════════════
    private function module03(): array
    {
        $gold = 'rgba(201,168,76,.9)'; $blue = 'rgba(59,130,246,.8)'; $teal = 'rgba(20,184,166,.8)'; $green = 'rgba(34,197,94,.8)';

        $intro = $this->card($gold, 'Module 03 · Mentor', 'Être présent sans projeter — guider sans diriger',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            La plupart des gens n\'écoutent pas — ils attendent leur tour pour parler.<br>
            Le mentor écoute avec tout son être.<br><br>
            <strong>L\'écoute active n\'est pas une technique. C\'est un état.</strong><br>
            Cet état de présence totale où l\'autre se sent — pour la première fois peut-être — <em>vraiment compris</em>.<br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;border:1px solid rgba(201,168,76,.15);margin:.75rem 0;">
            Ce que ressent quelqu\'un qui est vraiment écouté :<br>
            "Il m\'a compris sans me juger. Je ne savais pas que j\'allais dire ça. Mais en le disant à voix haute... j\'ai compris."<br><br>
            <em>Voilà ce que vous créez quand vous écoutez vraiment.</em>
            </div>
            </div>'
        );

        $niveaux = $this->card($blue, 'Leçon 1', 'Les 5 niveaux d\'écoute — où êtes-vous vraiment ?',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            <strong>Niveau 1 — Écoute superficielle</strong><br>
            Vous entendez les mots. Votre esprit est ailleurs.<br><br>
            <strong>Niveau 2 — Écoute partielle</strong><br>
            Vous captez les grandes lignes. Vous préparez votre réponse.<br><br>
            <strong>Niveau 3 — Écoute active</strong><br>
            Vous suivez le fil. Vous posez des questions de clarification.<br><br>
            <strong>Niveau 4 — Écoute empathique</strong><br>
            Vous ressentez l\'émotion derrière les mots. Vous reflétiez avant de répondre.<br><br>
            <strong style="color:rgba(20,184,166,.9);">Niveau 5 — Écoute générative</strong><br>
            Vous écoutez ce qui n\'est pas encore dit. Ce que la personne cherche à formuler. Vous créez l\'espace pour que ça emerge.<br><br>
            <em style="color:rgba(59,130,246,.7);">Le mentor vise le niveau 5.</em>
            </div>'
        );

        $questions = $this->card($teal, 'Leçon 2', 'L\'art des questions — ouvrir sans orienter',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            Une question fermée ferme.<br>
            Une question ouverte ouvre.<br>
            Une question puissante transforme.<br><br>
            <strong style="color:rgba(20,184,166,.9);">Questions qui ouvrent :</strong><br>
            "Qu\'est-ce qui se passe vraiment ?" · "Qu\'est-ce qui ferait que ce soit parfait ?" · "Si tu savais déjà la réponse ?"<br><br>
            <strong>Questions à éviter (elles orientent) :</strong><br>
            "Ne penses-tu pas que..." · "Tu ne devrais pas..." · "Et si tu essayais..."<br><br>
            <div style="background:rgba(20,184,166,.07);border-radius:10px;padding:.75rem 1rem;margin-top:.75rem;">
            <strong>La règle d\'or :</strong><br>
            Après chaque question — taisez-vous. Complètement.<br>
            Comptez jusqu\'à 10 si nécessaire.<br>
            Le silence est souvent plus puissant que votre meilleure question.
            </div>
            </div>'
        );

        $pratique = $this->card($green, 'Méditation guidée · 20 min', 'La méditation du silence intérieur',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            Installez-vous. Fermez les yeux. 5-5-5.<br><br>
            Pendant 10 minutes, ne faites rien qu\'observer vos propres pensées sans les suivre.<br>
            C\'est la base de l\'écoute : d\'abord apprendre à écouter notre propre mental.<br><br>
            Quand une pensée vient, notez-la mentalement : "pensée". Et revenez au souffle.<br><br>
            <em>Un mentor qui ne sait pas faire le silence intérieur ne peut pas créer le silence accueillant pour l\'autre.</em>
            </div>'
        );

        $activities = [
            ['type'=>'lecture','title'=>'Introduction — L\'écoute qui transforme','duration'=>'15 min','description'=>'Pourquoi la vraie écoute est rare et précieuse. Ce que ressent quelqu\'un qui est vraiment entendu.','content'=>$intro],
            ['type'=>'lecture','title'=>'Leçon 1 — Les 5 niveaux d\'écoute','duration'=>'20 min','description'=>'De l\'écoute superficielle à l\'écoute générative. Auto-diagnostic : à quel niveau êtes-vous ?','content'=>$niveaux],
            ['type'=>'lecture','title'=>'Leçon 2 — L\'art des questions puissantes','duration'=>'20 min','description'=>'Ouvrir sans orienter. Questions qui ouvrent vs questions qui ferment. La règle du silence.','content'=>$questions],
            ['type'=>'pratique','title'=>'Méditation guidée — Le silence intérieur','duration'=>'20 min','description'=>'Observer ses pensées sans les suivre. La base de toute présence à l\'autre.','content'=>$pratique],
            ['type'=>'exercice','title'=>'Exercice — L\'écoute sans interruption','duration'=>'30 min','description'=>'Exercice en binôme ou journal : écouter quelqu\'un pendant 10 min sans interrompre, sans conseiller, sans juger.'],
            ['type'=>'reflexion','title'=>'Intégration — Mes habitudes d\'écoute','duration'=>'15 min','description'=>'Repérer ses 3 principales habitudes d\'écoute qui parasitent la présence. Comment les transformer.'],
        ];

        $activitiesEn = [
            ['type'=>'lecture','title'=>'Introduction — The listening that transforms','duration'=>'15 min','description'=>'Why real listening is rare and precious. What it feels like to be truly heard.'],
            ['type'=>'lecture','title'=>'Lesson 1 — The 5 levels of listening','duration'=>'20 min','description'=>'From surface listening to generative listening. Self-diagnosis: at which level are you?'],
            ['type'=>'lecture','title'=>'Lesson 2 — The art of powerful questions','duration'=>'20 min','description'=>'Open without directing. Questions that open vs questions that close. The silence rule.'],
            ['type'=>'pratique','title'=>'Guided meditation — Inner silence','duration'=>'20 min','description'=>'Observe thoughts without following them. The foundation of all presence to the other.'],
            ['type'=>'exercice','title'=>'Exercise — Listening without interruption','duration'=>'30 min','description'=>'In pairs or journal: listen to someone for 10 min without interrupting, advising, or judging.'],
            ['type'=>'reflexion','title'=>'Integration — My listening habits','duration'=>'15 min','description'=>'Identify 3 listening habits that parasitize presence. How to transform them.'],
        ];

        return compact('activities', 'activitiesEn');
    }

    // ══════════════════════════════════════════════════════
    // MODULE 04 — La Transmission Vivante
    // ══════════════════════════════════════════════════════
    private function module04(): array
    {
        $gold = 'rgba(201,168,76,.9)'; $orange = 'rgba(249,115,22,.8)'; $teal = 'rgba(20,184,166,.8)'; $green = 'rgba(34,197,94,.8)';

        $intro = $this->card($gold, 'Module 04 · Mentor', 'Partager par l\'exemple, pas par l\'autorité',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            Un discours instruit. Une vie vécue inspire.<br><br>
            La transmission vivante, c\'est quand </strong>ce que vous dites et ce que vous êtes</strong> sont alignés.<br>
            Quand il n\'y a aucun écart entre le mentor devant le groupe et l\'être humain à 23h dans sa cuisine.<br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;border:1px solid rgba(201,168,76,.15);margin:.75rem 0;">
            Gandhi disait : "Soyez le changement que vous voulez voir dans le monde."<br>
            Le mentor dit : "Je suis déjà en train de vivre ce que je vous enseigne."<br><br>
            <em>Ce n\'est pas de la perfection qu\'on vous demande. C\'est de l\'alignement.</em>
            </div>
            </div>'
        );

        $storytelling = $this->card($orange, 'Leçon 1', 'Le storytelling de l\'expérience — raconter pour transformer',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            Une histoire vraie est plus puissante que 10 théories.<br>
            Mais il y a une différence entre une histoire qui impressionne et une histoire qui libère.<br><br>
            <strong style="color:rgba(249,115,22,.9);">Structure d\'une histoire de transmission :</strong><br><br>
            <strong>① Le moment de basculement</strong> — "Il y a X ans, j\'étais..."<br>
            <strong>② La descente</strong> — "Et puis... quelque chose s\'est effondré."<br>
            <strong>③ La traversée</strong> — "J\'ai dû faire face à..."<br>
            <strong>④ L\'apprentissage</strong> — "Ce que j\'ai compris à ce moment-là..."<br>
            <strong>⑤ Le pont</strong> — "Et c\'est exactement pourquoi je vous parle de ça aujourd\'hui."<br><br>
            <em style="color:rgba(249,115,22,.7);">La règle : ne racontez pas une histoire pour briller. Racontez pour que l\'autre se reconnaisse.</em>
            </div>'
        );

        $alignement = $this->card($teal, 'Leçon 2', 'L\'alignement vie-enseignement — vivre ce qu\'on enseigne',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            On ne peut transmettre durablement que ce qu\'on pratique.<br>
            Les étudiants ne vous font pas confiance parce que vous êtes certifié.<br>
            <strong>Ils vous font confiance parce qu\'ils sentent que vous vivez ce que vous dites.</strong><br><br>
            <strong style="color:rgba(20,184,166,.9);">Audit d\'alignement mentor (honnêteté radicale) :</strong><br><br>
            Pour chaque valeur ou pratique que vous enseignez :<br>
            ✓ Est-ce que je pratique cela quotidiennement ?<br>
            ✓ Est-ce que je le fais quand c\'est difficile, pas seulement quand c\'est facile ?<br>
            ✓ Est-ce que ma famille / mes proches voient la cohérence ?<br><br>
            <em style="color:rgba(20,184,166,.6);">Là où l\'alignement est incomplet : c\'est là que vous grandissez. Pas une faiblesse — une invitation.</em>
            </div>'
        );

        $pratique = $this->card($green, 'Méditation guidée · 20 min', 'La méditation de l\'alignement',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            Installez-vous. 3 souffles 5-5-5.<br><br>
            Visualisez-vous en train d\'enseigner quelque chose qui vous tient à cœur.<br>
            Ressentez-vous de l\'alignement — ou de l\'imposteur ?<br><br>
            Où dans votre corps vous sentez-vous le plus vrai ?<br>
            Où sentez-vous l\'écart ?<br><br>
            Respirez à cet endroit. Pas pour le résoudre. Pour l\'honorer.<br><br>
            <em>"Je suis en chemin. Et mon chemin m\'équipe."</em>
            </div>'
        );

        $activities = [
            ['type'=>'lecture','title'=>'Introduction — La transmission qui transforme','duration'=>'15 min','description'=>'L\'alignement vie-enseignement. Pourquoi l\'expérience est plus persuasive que la théorie.','content'=>$intro],
            ['type'=>'lecture','title'=>'Leçon 1 — Le storytelling de l\'expérience','duration'=>'25 min','description'=>'Structure en 5 étapes pour raconter une histoire qui libère (pas qui impressionne).','content'=>$storytelling],
            ['type'=>'lecture','title'=>'Leçon 2 — L\'alignement vie-enseignement','duration'=>'20 min','description'=>'Audit d\'alignement. Vivre ce qu\'on enseigne — pas la perfection mais la cohérence.','content'=>$alignement],
            ['type'=>'pratique','title'=>'Méditation guidée — La cohérence intérieure','duration'=>'20 min','description'=>'Ressentir les zones d\'alignement et les zones d\'écart. Les honorer sans les fuir.','content'=>$pratique],
            ['type'=>'exercice','title'=>'Exercice — Mon histoire fondatrice de mentor','duration'=>'30 min','description'=>'Rédiger son histoire en 5 étapes (basculement, descente, traversée, apprentissage, pont). 300-500 mots.'],
            ['type'=>'reflexion','title'=>'Intégration — Mon audit d\'alignement','duration'=>'20 min','description'=>'Pour les 3-5 sujets que vous allez enseigner : évaluer l\'alignement actuel. Identifier 1 engagement concret.'],
        ];

        $activitiesEn = [
            ['type'=>'lecture','title'=>'Introduction — The transmission that transforms','duration'=>'15 min','description'=>'Life-teaching alignment. Why experience is more persuasive than theory.'],
            ['type'=>'lecture','title'=>'Lesson 1 — The storytelling of experience','duration'=>'25 min','description'=>'5-step structure to tell a story that liberates (not impresses).'],
            ['type'=>'lecture','title'=>'Lesson 2 — Life-teaching alignment','duration'=>'20 min','description'=>'Alignment audit. Living what you teach — not perfection but coherence.'],
            ['type'=>'pratique','title'=>'Guided meditation — Inner coherence','duration'=>'20 min','description'=>'Feel zones of alignment and zones of gap. Honor them without fleeing.'],
            ['type'=>'exercice','title'=>'Exercise — My founding mentor story','duration'=>'30 min','description'=>'Write your story in 5 steps (turning point, descent, crossing, learning, bridge). 300-500 words.'],
            ['type'=>'reflexion','title'=>'Integration — My alignment audit','duration'=>'20 min','description'=>'For the 3-5 topics you will teach: assess current alignment. Identify 1 concrete commitment.'],
        ];

        return compact('activities', 'activitiesEn');
    }

    // ══════════════════════════════════════════════════════
    // MODULE 05 — Les Résistances
    // ══════════════════════════════════════════════════════
    private function module05(): array
    {
        $gold = 'rgba(201,168,76,.9)'; $red = 'rgba(239,68,68,.8)'; $purple = 'rgba(168,85,247,.8)'; $green = 'rgba(34,197,94,.8)';

        $intro = $this->card($gold, 'Module 05 · Mentor', 'Transformer les blocages en leviers de croissance',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            Dans chaque groupe, dans chaque accompagnement individuel, vous rencontrerez des résistances.<br>
            Celles de vos accompagnés — et les vôtres.<br><br>
            <strong>Le mentor non-préparé vit les résistances comme des échecs.</strong><br>
            Le mentor expérimenté les lit comme des messages.<br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;border:1px solid rgba(201,168,76,.15);margin:.75rem 0;">
            Une résistance dit toujours quelque chose :<br>
            "J\'ai peur." · "Je n\'y crois pas." · "J\'ai déjà été déçu." · "Ce n\'est pas le bon moment." · "Je ne me sens pas capable."<br><br>
            <em>Votre travail n\'est pas de supprimer la résistance. C\'est de l\'entendre.</em>
            </div>
            </div>'
        );

        $types = $this->card($red, 'Leçon 1', 'Les 5 types de résistance — lire ce qui se passe vraiment',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            <strong>① La résistance par peur</strong> — "Et si ça ne marchait pas ?" Signe : questionnement excessif, procrastination.<br><br>
            <strong>② La résistance par blessure passée</strong> — "J\'ai déjà essayé, ça n\'a pas marché." Signe : cynisme, fermeture.<br><br>
            <strong>③ La résistance par croyance limitante</strong> — "Je ne suis pas fait pour ça." Signe : minimisation systématique de soi.<br><br>
            <strong>④ La résistance par déni</strong> — "Je n\'ai pas vraiment de problème." Signe : changement de sujet, rationalisation.<br><br>
            <strong>⑤ La résistance par timing</strong> — "Pas maintenant, plus tard." Signe : reportage répété. Peut être légitime — ou un évitement.
            </div>'
        );

        $protocole = $this->card($purple, 'Leçon 2', 'Le protocole de transformation des résistances',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            <strong style="color:rgba(168,85,247,.9);">Étape 1 — Accueillir sans corriger</strong><br>
            "Je t\'entends. Cette résistance est là. C\'est valide."<br><br>
            <strong style="color:rgba(168,85,247,.9);">Étape 2 — Nommer sans diagnostiquer</strong><br>
            "Je perçois quelque chose qui ressemble à de la peur. Est-ce que ça résonne ?"<br><br>
            <strong style="color:rgba(168,85,247,.9);">Étape 3 — Explorer avec curiosité</strong><br>
            "Qu\'est-ce qui se passerait si cette peur avait raison ? Et si elle avait tort ?"<br><br>
            <strong style="color:rgba(168,85,247,.9);">Étape 4 — Chercher la ressource dans la résistance</strong><br>
            "Qu\'est-ce que cette résistance protège ? Qu\'est-ce qui a besoin d\'être respecté ici ?"<br><br>
            <strong style="color:rgba(168,85,247,.9);">Étape 5 — Proposer un tout petit pas</strong><br>
            "Pas tout. Pas maintenant. Juste 1% de mouvement."
            </div>'
        );

        $pratique = $this->card($green, 'Méditation guidée · 20 min', 'La méditation des nœuds intérieurs',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            Fermez les yeux. 5-5-5.<br><br>
            Pensez à une résistance que vous avez vous-même en ce moment.<br>
            Pas celle de vos accompagnés — la vôtre.<br><br>
            Localisez-la dans le corps. Donnez-lui une forme, une couleur, une texture.<br>
            Posez-lui la question : <em>"Qu\'est-ce que tu protèges ?"</em><br><br>
            Écoutez sans défense. Sans chercher à la résoudre.<br>
            Juste la rencontrer.<br><br>
            <em>"Toute résistance que vous avez traversée vous équipe pour accompagner celle de l\'autre."</em>
            </div>'
        );

        $activities = [
            ['type'=>'lecture','title'=>'Introduction — Lire les résistances comme des messages','duration'=>'15 min','description'=>'Résistances de l\'accompagné et du mentor. La résistance comme information, pas comme échec.','content'=>$intro],
            ['type'=>'lecture','title'=>'Leçon 1 — Les 5 types de résistance','duration'=>'20 min','description'=>'Peur, blessure, croyance limitante, déni, timing. Reconnaître ce qui se passe vraiment.','content'=>$types],
            ['type'=>'lecture','title'=>'Leçon 2 — Protocole de transformation en 5 étapes','duration'=>'25 min','description'=>'Accueillir · Nommer · Explorer · Chercher la ressource · Proposer un petit pas.','content'=>$protocole],
            ['type'=>'pratique','title'=>'Méditation guidée — Les nœuds intérieurs','duration'=>'20 min','description'=>'Explorer une résistance personnelle. La localiser, l\'écouter, comprendre ce qu\'elle protège.','content'=>$pratique],
            ['type'=>'exercice','title'=>'Exercice — Carte des résistances','duration'=>'25 min','description'=>'Lister 5 résistances fréquentes dans votre domaine d\'accompagnement. Pour chacune : type + réponse mentor adaptée.'],
            ['type'=>'reflexion','title'=>'Intégration — Ma propre résistance principale','duration'=>'15 min','description'=>'Identifier sa résistance personnelle la plus présente en ce moment. Appliquer le protocole à soi-même.'],
        ];

        $activitiesEn = [
            ['type'=>'lecture','title'=>'Introduction — Reading resistance as messages','duration'=>'15 min','description'=>'Resistance of the mentee and the mentor. Resistance as information, not failure.'],
            ['type'=>'lecture','title'=>'Lesson 1 — The 5 types of resistance','duration'=>'20 min','description'=>'Fear, wound, limiting belief, denial, timing. Recognizing what is really happening.'],
            ['type'=>'lecture','title'=>'Lesson 2 — 5-step transformation protocol','duration'=>'25 min','description'=>'Welcome · Name · Explore · Find the resource · Propose a small step.'],
            ['type'=>'pratique','title'=>'Guided meditation — Inner knots','duration'=>'20 min','description'=>'Explore a personal resistance. Locate it, listen to it, understand what it protects.'],
            ['type'=>'exercice','title'=>'Exercise — Resistance map','duration'=>'25 min','description'=>'List 5 frequent resistances in your mentoring field. For each: type + adapted mentor response.'],
            ['type'=>'reflexion','title'=>'Integration — My main personal resistance','duration'=>'15 min','description'=>'Identify your most present personal resistance. Apply the protocol to yourself.'],
        ];

        return compact('activities', 'activitiesEn');
    }

    // ══════════════════════════════════════════════════════
    // MODULE 06 — L'Énergie du Mentor
    // ══════════════════════════════════════════════════════
    private function module06(): array
    {
        $gold = 'rgba(201,168,76,.9)'; $orange = 'rgba(249,115,22,.8)'; $blue = 'rgba(59,130,246,.8)'; $green = 'rgba(34,197,94,.8)';

        $intro = $this->card($gold, 'Module 06 · Mentor', 'Se ressourcer pour rayonner durablement',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            Un mentor épuisé n\'accompagne plus — il survit.<br>
            Et dans la survie, il prend inconsciemment de l\'énergie à ses accompagnés au lieu d\'en donner.<br><br>
            <strong>La gestion de votre énergie n\'est pas du confort. C\'est de l\'éthique.</strong><br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;border:1px solid rgba(201,168,76,.15);margin:.75rem 0;">
            Un praticien qui ne prend pas soin de lui transmet son épuisement, sa frustration, son manque.<br>
            Un praticien qui rayonne transmet sa vitalité, sa paix, sa présence.<br><br>
            <em>Vous ne pouvez pas donner ce que vous n\'avez pas.</em>
            </div>
            </div>'
        );

        $sources = $this->card($orange, 'Leçon 1', 'Vos 4 sources d\'énergie — les alimenter consciemment',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            <strong>① Énergie physique</strong><br>
            Sommeil · Mouvement · Nutrition · Pause Souffle quotidienne.<br>
            Indicateur : votre corps est-il un allié ou une charge ?<br><br>
            <strong>② Énergie émotionnelle</strong><br>
            Traitement des émotions non résolues. Relations nourrissantes vs vampirisantes.<br>
            Indicateur : avez-vous des conversations qui vous alourdissent ou qui vous allègent ?<br><br>
            <strong>③ Énergie mentale</strong><br>
            Clarté d\'intention. Absence de dissonnance entre ce que vous pensez et ce que vous faites.<br>
            Indicateur : avez-vous des pensées intrusives récurrentes ? Des décisions non prises ?<br><br>
            <strong>④ Énergie spirituelle</strong><br>
            Connexion à votre sens profond. Sentiment que votre vie a une direction.<br>
            Indicateur : vous levez-vous le matin avec un sentiment de mission — ou d\'obligation ?
            </div>'
        );

        $rituel = $this->card($blue, 'Leçon 2', 'Le Rituel quotidien du Mentor — 5-5-5 Édition Mentor',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            <strong style="color:rgba(59,130,246,.9);">Matin (15 min) :</strong><br>
            ① 5 min — Pause Souffle 5-5-5 (inspiration 5s · rétention 5s · expiration 5s)<br>
            ② 5 min — Intention du jour de mentor : "Aujourd\'hui, je sers en..."<br>
            ③ 5 min — Lecture ou écoute d\'une phrase inspirante / verset de référence<br><br>
            <strong style="color:rgba(59,130,246,.9);">Avant chaque session d\'accompagnement (2 min) :</strong><br>
            Check-in corporel · État émotionnel · Intention centrée sur l\'autre<br><br>
            <strong style="color:rgba(59,130,246,.9);">Soir (10 min) :</strong><br>
            ① Qu\'est-ce que j\'ai bien servi aujourd\'hui ?<br>
            ② Où est-ce que je me suis laissé drainer — et pourquoi ?<br>
            ③ Qu\'est-ce que j\'emporte de positif de cette journée ?
            </div>'
        );

        $pratique = $this->card($green, 'Méditation guidée · 20 min', 'Méditation de rechargement — La fontaine intérieure',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            Installez-vous. 5-5-5 × 3 fois.<br><br>
            Imaginez une source lumineuse au centre de votre poitrine.<br>
            À chaque inspiration, elle grandit. À chaque expiration, elle rayonne vers l\'extérieur.<br><br>
            Visualisez vos 4 sources d\'énergie se remplir progressivement :<br>
            Corps · Émotions · Mental · Sens<br><br>
            Restez dans cet état de plénitude pendant 10 minutes.<br><br>
            <em>"Je me nourris pour nourrir. Je me ressource pour ressourcer."</em>
            </div>'
        );

        $activities = [
            ['type'=>'lecture','title'=>'Introduction — L\'énergie comme éthique','duration'=>'15 min','description'=>'Pourquoi la gestion de l\'énergie du mentor est une responsabilité envers ses accompagnés.','content'=>$intro],
            ['type'=>'lecture','title'=>'Leçon 1 — Vos 4 sources d\'énergie','duration'=>'20 min','description'=>'Physique · Émotionnelle · Mentale · Spirituelle. Diagnostic et axes d\'alimentation.','content'=>$sources],
            ['type'=>'lecture','title'=>'Leçon 2 — Le Rituel quotidien du Mentor','duration'=>'20 min','description'=>'5-5-5 Édition Mentor. Rituel matin (15 min) + pré-session (2 min) + soir (10 min).','content'=>$rituel],
            ['type'=>'pratique','title'=>'Méditation guidée — La fontaine intérieure','duration'=>'20 min','description'=>'Méditation de rechargement profond des 4 sources d\'énergie.','content'=>$pratique],
            ['type'=>'exercice','title'=>'Exercice — Mon bilan énergétique','duration'=>'20 min','description'=>'Évaluer ses 4 sources (0-10). Identifier la plus déficiente. Définir 1 action concrète pour la nourrir cette semaine.'],
            ['type'=>'reflexion','title'=>'Intégration — Mon engagement de ressourcement','duration'=>'10 min','description'=>'"Je prends soin de moi parce que..." — Rédiger son engagement personnel de ressourcement en 3 phrases.'],
        ];

        $activitiesEn = [
            ['type'=>'lecture','title'=>'Introduction — Energy as ethics','duration'=>'15 min','description'=>'Why the mentor\'s energy management is a responsibility towards those they accompany.'],
            ['type'=>'lecture','title'=>'Lesson 1 — Your 4 energy sources','duration'=>'20 min','description'=>'Physical · Emotional · Mental · Spiritual. Diagnosis and nourishing strategies.'],
            ['type'=>'lecture','title'=>'Lesson 2 — The daily Mentor Ritual','duration'=>'20 min','description'=>'5-5-5 Mentor Edition. Morning ritual (15 min) + pre-session (2 min) + evening (10 min).'],
            ['type'=>'pratique','title'=>'Guided meditation — The inner fountain','duration'=>'20 min','description'=>'Deep recharge meditation for all 4 energy sources.'],
            ['type'=>'exercice','title'=>'Exercise — My energy assessment','duration'=>'20 min','description'=>'Rate your 4 sources (0-10). Identify the most deficient. Define 1 concrete action to nourish it this week.'],
            ['type'=>'reflexion','title'=>'Integration — My recharging commitment','duration'=>'10 min','description'=>'"I take care of myself because..." — Write your personal recharging commitment in 3 sentences.'],
        ];

        return compact('activities', 'activitiesEn');
    }

    // ══════════════════════════════════════════════════════
    // MODULE 07 — Le Cadre Sacré
    // ══════════════════════════════════════════════════════
    private function module07(): array
    {
        $gold = 'rgba(201,168,76,.9)'; $teal = 'rgba(20,184,166,.8)'; $blue = 'rgba(59,130,246,.8)'; $green = 'rgba(34,197,94,.8)';

        $intro = $this->card($gold, 'Module 07 · Mentor', 'Créer l\'espace où les autres osent être vrais',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            Un cadre sacré n\'est pas un lieu. C\'est une <strong>qualité de présence</strong>.<br>
            C\'est ce qui fait que quelqu\'un entre dans une salle — ou dans une conversation — et sent instinctivement : <em>"Ici, je peux être moi-même."</em><br><br>
            Les gens passent des années sans jamais avoir cet espace.<br>
            Le mentor le crée intentionnellement.<br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;border:1px solid rgba(201,168,76,.15);margin:.75rem 0;">
            Ce qui se dit dans le cadre doit rester dans le cadre.<br>
            Ce qui se vit dans le cadre ne s\'oublie pas.<br><br>
            <em>Votre travail de mentor : créer cet espace, le maintenir, le défendre.</em>
            </div>
            </div>'
        );

        $elements = $this->card($teal, 'Leçon 1', 'Les 5 éléments d\'un cadre sacré',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            <strong style="color:rgba(20,184,166,.9);">① La confidentialité totale</strong><br>
            Ce qui se partage ici ne sort pas d\'ici. C\'est la condition première de la confiance.<br><br>
            <strong style="color:rgba(20,184,166,.9);">② L\'absence de jugement</strong><br>
            Ce n\'est pas l\'approbation de tout. C\'est l\'accueil de tout.<br>
            "Je t\'écoute sans te juger" — et le vivre dans chaque micro-réaction.<br><br>
            <strong style="color:rgba(20,184,166,.9);">③ La présence totale</strong><br>
            Téléphone rangé. Regard posé. Corps tourné. Esprit disponible.<br>
            Le cadre sacré exige votre présence complète — pas 80%.<br><br>
            <strong style="color:rgba(20,184,166,.9);">④ La permission d\'être incomplet</strong><br>
            "Tu n\'as pas à avoir les réponses ici. Tu as juste à être honnête."<br><br>
            <strong style="color:rgba(20,184,166,.9);">⑤ La ritualisation de l\'espace</strong><br>
            Une ouverture, un souffle partagé, un mot d\'intention. Le corps comprend que c\'est différent.
            </div>'
        );

        $violations = $this->card($blue, 'Leçon 2', 'Ce qui brise le cadre — et comment le réparer',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            <strong>Violations les plus fréquentes :</strong><br><br>
            ① Un commentaire non-solliicité qui juge (même bien intentionné)<br>
            ② Une confidence partagée hors du groupe<br>
            ③ Un manque de présence perçu par le groupe<br>
            ④ Une réaction de surprise ou de malaise visible du mentor face à ce qui est partagé<br>
            ⑤ Un favoritisme / une attention disproportionnée vers certains<br><br>
            <strong style="color:rgba(59,130,246,.9);">Comment réparer :</strong><br>
            Nommer la violation avec sincérité. Sans chercher à se défendre.<br>
            "J\'ai dit quelque chose qui a brisé la confiance. Je veux réparer. Voici comment."<br><br>
            <em style="color:rgba(59,130,246,.6);">La réparation honnête renforce souvent le cadre plus que s\'il n\'avait jamais été violé.</em>
            </div>'
        );

        $pratique = $this->card($green, 'Méditation guidée · 20 min', 'Méditation de l\'espace d\'accueil',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            Installez-vous. 5-5-5 × 3 fois.<br><br>
            Imaginez l\'espace que vous allez créer pour ceux que vous accompagnez.<br>
            Pas la salle. Pas le décor. La <em>qualité de présence</em> que vous apportez.<br><br>
            Visualisez quelqu\'un qui entre dans cet espace et se détend.<br>
            Qui baisse la garde. Qui respire différemment.<br><br>
            Que ressentez-vous dans votre corps quand vous voyez cela ?<br><br>
            <em>"Je suis cet espace. Je le porte en moi. Il commence par ma propre paix."</em>
            </div>'
        );

        $activities = [
            ['type'=>'lecture','title'=>'Introduction — Le cadre qui libère','duration'=>'15 min','description'=>'Qu\'est-ce qu\'un cadre sacré. Pourquoi il est si rare. Ce qu\'il permet.','content'=>$intro],
            ['type'=>'lecture','title'=>'Leçon 1 — Les 5 éléments du cadre sacré','duration'=>'20 min','description'=>'Confidentialité · Absence de jugement · Présence totale · Permission d\'être incomplet · Ritualisation.','content'=>$elements],
            ['type'=>'lecture','title'=>'Leçon 2 — Violations et réparations','duration'=>'20 min','description'=>'Ce qui brise la confiance. Comment réparer authentiquement. La réparation comme renforcement.','content'=>$violations],
            ['type'=>'pratique','title'=>'Méditation guidée — L\'espace d\'accueil','duration'=>'20 min','description'=>'Visualiser et incarner la qualité de présence qui crée un espace de confiance.','content'=>$pratique],
            ['type'=>'exercice','title'=>'Exercice — Mon rituel d\'ouverture de session','duration'=>'25 min','description'=>'Créer un rituel d\'ouverture (3-5 min) pour toutes ses sessions : souffle partagé, mot d\'intention, accord de groupe.'],
            ['type'=>'reflexion','title'=>'Intégration — Mon contrat de cadre','duration'=>'15 min','description'=>'Rédiger son "contrat de cadre" : les 3-5 engagements non-négociables qu\'il tiendra dans chaque accompagnement.'],
        ];

        $activitiesEn = [
            ['type'=>'lecture','title'=>'Introduction — The frame that liberates','duration'=>'15 min','description'=>'What a sacred frame is. Why it is so rare. What it makes possible.'],
            ['type'=>'lecture','title'=>'Lesson 1 — The 5 elements of the sacred frame','duration'=>'20 min','description'=>'Confidentiality · No judgment · Total presence · Permission to be incomplete · Ritualization.'],
            ['type'=>'lecture','title'=>'Lesson 2 — Violations and repairs','duration'=>'20 min','description'=>'What breaks trust. How to repair authentically. Repair as reinforcement.'],
            ['type'=>'pratique','title'=>'Guided meditation — The welcoming space','duration'=>'20 min','description'=>'Visualize and embody the quality of presence that creates a trust space.'],
            ['type'=>'exercice','title'=>'Exercise — My session opening ritual','duration'=>'25 min','description'=>'Create an opening ritual (3-5 min) for all sessions: shared breath, intention word, group agreement.'],
            ['type'=>'reflexion','title'=>'Integration — My frame contract','duration'=>'15 min','description'=>'Write your "frame contract": the 3-5 non-negotiable commitments held in every accompaniment.'],
        ];

        return compact('activities', 'activitiesEn');
    }

    // ══════════════════════════════════════════════════════
    // MODULE 08 — L'Art du Lâcher-Prise
    // ══════════════════════════════════════════════════════
    private function module08(): array
    {
        $gold = 'rgba(201,168,76,.9)'; $purple = 'rgba(168,85,247,.8)'; $teal = 'rgba(20,184,166,.8)'; $green = 'rgba(34,197,94,.8)';

        $intro = $this->card($gold, 'Module 08 · Mentor', 'Accompagner sans retenir — guider sans contrôler',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            Le mentor accomplit sa mission quand son accompagné n\'a plus besoin de lui.<br><br>
            C\'est le paradoxe final : <strong>plus votre travail est réussi, plus ils s\'éloignent.</strong><br>
            Et c\'est exactement ça, la victoire.<br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;border:1px solid rgba(201,168,76,.15);margin:.75rem 0;">
            Un parent réussi lève des enfants autonomes.<br>
            Un thérapeute réussi clôture sa relation thérapeutique.<br>
            Un mentor réussi crée d\'autres mentors.<br><br>
            '.$this->verse().'
            </div>
            </div>'
        );

        $attachement = $this->card($purple, 'Leçon 1', 'L\'attachement du mentor — le reconnaître honnêtement',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            L\'attachement mentor peut prendre des formes subtiles :<br><br>
            <strong>① L\'attachement au rôle</strong> — "J\'ai besoin qu\'ils aient besoin de moi."<br>
            Signe : malaise quand un accompagné progresse trop vite et devient autonome.<br><br>
            <strong>② L\'attachement aux résultats</strong> — "Leur succès prouve ma valeur."<br>
            Signe : déception personnelle quand quelqu\'un abandonne, même si c\'est son choix.<br><br>
            <strong>③ L\'attachement affectif</strong> — La relation dépasse le cadre du mentorat.<br>
            Signe : difficulté à maintenir les limites professionnelles.<br><br>
            <em style="color:rgba(168,85,247,.7);">Reconnaître son attachement n\'est pas une honte. C\'est le premier acte du lâcher-prise.</em>
            </div>'
        );

        $pratique_lacher = $this->card($teal, 'Leçon 2', 'Les 3 pratiques du lâcher-prise mentor',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            <strong style="color:rgba(20,184,166,.9);">① La clôture rituelle</strong><br>
            À la fin de chaque session : "Je te confie à toi-même."<br>
            Symboliquement remettre la responsabilité à l\'autre. Couper l\'énergie du contrôle.<br><br>
            <strong style="color:rgba(20,184,166,.9);">② La délégation à plus grand que soi</strong><br>
            "Ce chemin n\'est pas le mien à porter. Je fais ce que je peux et je confie le reste."<br>
            (Version spirituelle pour ceux qui ont une pratique de foi.)<br><br>
            <strong style="color:rgba(20,184,166,.9);">③ Le bilan sans jugement</strong><br>
            Après chaque accompagnement terminé — bien ou mal — : "Qu\'est-ce que j\'ai appris ? Qu\'est-ce que je lâche ?"<br>
            Un cahier de clôture. Deux pages. Et on tourne.
            </div>'
        );

        $meditation = $this->card($green, 'Méditation guidée · 20 min', 'Méditation du détachement bienveillant',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            Installez-vous. 5-5-5 × 3 fois.<br><br>
            Pensez à quelqu\'un que vous accompagnez ou avez accompagné.<br>
            Ressentez si vous portez quelque chose pour eux qui leur appartient.<br><br>
            Visualisez cette charge — et imaginez la leur remettre avec amour.<br>
            "Ceci est à toi. Je te le rends. Je reste là. Mais c\'est toi qui portes."<br><br>
            Ressentez le soulagement dans votre corps.<br>
            La légèreté du mentor qui ne porte pas ce qui ne lui appartient pas.<br><br>
            <em>"Je suis présent. Je ne suis pas responsable de leur chemin. Je suis là pour éclairer, pas pour porter."</em>
            </div>'
        );

        $activities = [
            ['type'=>'lecture','title'=>'Introduction — Le paradoxe final du mentor','duration'=>'15 min','description'=>'Le mentor réussi crée l\'autonomie, pas la dépendance. Lâcher pour libérer.','content'=>$intro],
            ['type'=>'lecture','title'=>'Leçon 1 — L\'attachement du mentor','duration'=>'20 min','description'=>'3 formes d\'attachement : au rôle, aux résultats, affectif. Les reconnaître honnêtement.','content'=>$attachement],
            ['type'=>'lecture','title'=>'Leçon 2 — Les 3 pratiques du lâcher-prise','duration'=>'20 min','description'=>'Clôture rituelle · Délégation à plus grand que soi · Bilan sans jugement.','content'=>$pratique_lacher],
            ['type'=>'pratique','title'=>'Méditation guidée — Détachement bienveillant','duration'=>'20 min','description'=>'Remettre à l\'autre ce qui lui appartient. La légèreté qui suit le lâcher-prise.','content'=>$meditation],
            ['type'=>'exercice','title'=>'Exercice — Mes accompagnements en cours','duration'=>'25 min','description'=>'Pour chaque personne accompagnée actuellement : suis-je attaché(e) ? De quel type ? Quel est un acte de lâcher-prise possible ?'],
            ['type'=>'reflexion','title'=>'Intégration — Mon rituel de clôture','duration'=>'15 min','description'=>'Créer son rituel personnel de clôture de session. Ce qui symbolise "je remets, je me libère, je reste disponible."'],
        ];

        $activitiesEn = [
            ['type'=>'lecture','title'=>'Introduction — The mentor\'s ultimate paradox','duration'=>'15 min','description'=>'The successful mentor creates autonomy, not dependence. Release to liberate.'],
            ['type'=>'lecture','title'=>'Lesson 1 — The mentor\'s attachment','duration'=>'20 min','description'=>'3 forms of attachment: to role, to results, emotional. Recognizing them honestly.'],
            ['type'=>'lecture','title'=>'Lesson 2 — The 3 letting-go practices','duration'=>'20 min','description'=>'Closing ritual · Delegation to something greater · Non-judgmental review.'],
            ['type'=>'pratique','title'=>'Guided meditation — Compassionate detachment','duration'=>'20 min','description'=>'Return to the other what belongs to them. The lightness that follows letting go.'],
            ['type'=>'exercice','title'=>'Exercise — My current accompaniments','duration'=>'25 min','description'=>'For each person currently being accompanied: am I attached? What type? What is one possible letting-go act?'],
            ['type'=>'reflexion','title'=>'Integration — My closing ritual','duration'=>'15 min','description'=>'Create your personal session closing ritual. What symbolizes "I release, I free myself, I remain available."'],
        ];

        return compact('activities', 'activitiesEn');
    }

    // ══════════════════════════════════════════════════════
    // MODULE 09 — Ma Signature de Mentor
    // ══════════════════════════════════════════════════════
    private function module09(): array
    {
        $gold = 'rgba(201,168,76,.9)'; $orange = 'rgba(249,115,22,.8)'; $green = 'rgba(34,197,94,.8)'; $purple = 'rgba(168,85,247,.8)';

        $intro = $this->card($gold, 'Module 09 · Mentor', 'Mon style, mes valeurs, mon empreinte durable',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            Vous êtes arrivé au dernier module.<br>
            Neuf semaines de transformation intérieure. Neuf éclairages sur qui vous êtes en tant que mentor.<br><br>
            Ce module n\'est pas un résumé. C\'est une <strong>synthèse vivante</strong>.<br>
            La question n\'est plus "qu\'est-ce qu\'un bon mentor ?"<br>
            Elle est : <em>"Quel mentor unique es-tu, toi ?"</em><br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;border:1px solid rgba(201,168,76,.15);margin:.75rem 0;">
            Personne ne peut être vous.<br>
            Votre combinaison de blessures + forces + valeurs + style est unique sur cette planète.<br><br>
            Ce que vous allez créer en sortant d\'ici ne ressemblera à aucun autre mentor.<br>
            Et c\'est exactement ce dont le monde a besoin.
            </div>
            '.$this->verse().'
            </div>'
        );

        $signature = $this->card($orange, 'Leçon 1', 'Votre signature de mentor — les 5 dimensions',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            <strong style="color:rgba(249,115,22,.9);">① Votre ton</strong><br>
            Direct ou doux ? Provocateur ou enveloppant ? Solennel ou joyeux ?<br>
            Ce n\'est pas ce que vous choisissez — c\'est ce que vous êtes quand vous êtes à l\'aise.<br><br>
            <strong style="color:rgba(249,115,22,.9);">② Votre approche</strong><br>
            Structurée (plan clair, étapes, outils) ou intuitive (fluide, au feeling de la personne) ?<br><br>
            <strong style="color:rgba(249,115,22,.9);">③ Votre force première</strong><br>
            Écoute · Présence · Clarté · Provocation bienveillante · Transmission d\'expérience · ...<br><br>
            <strong style="color:rgba(249,115,22,.9);">④ Votre public naturel</strong><br>
            Qui vous cherche naturellement ? Qui vous trouve sans que vous ayez à forcer ?<br><br>
            <strong style="color:rgba(249,115,22,.9);">⑤ Votre empreinte</strong><br>
            Dans 10 ans, que veulent dire les personnes que vous avez accompagnées quand elles parlent de vous ?
            </div>'
        );

        $manifeste = $this->card($purple, 'Leçon 2', 'Le Manifeste du Mentor — votre déclaration durable',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            Un manifeste n\'est pas une biographie. Ce n\'est pas un CV.<br>
            C\'est une <strong>déclaration de qui vous êtes et pour quoi vous vous battez</strong>.<br><br>
            <strong style="color:rgba(168,85,247,.9);">Structure du Manifeste (7 phrases) :</strong><br><br>
            ① "Je crois que..." (votre conviction fondatrice)<br>
            ② "J\'ai traversé..." (votre blessure transformée en force)<br>
            ③ "J\'ai appris que..." (votre sagesse principale)<br>
            ④ "Ma mission est de..." (ce pour quoi vous êtes là)<br>
            ⑤ "Je sers..." (votre public, votre communauté)<br>
            ⑥ "Je m\'engage à..." (vos 3 valeurs d\'action)<br>
            ⑦ "Mon empreinte durera si..." (ce que vous voulez laisser)<br><br>
            <em style="color:rgba(168,85,247,.7);">Ce manifeste, vous l\'afficherez. Vous le relirez. Il vous rappellera pourquoi — surtout les jours où vous oubliez.</em>
            </div>'
        );

        $pratique = $this->card($green, 'Méditation guidée · 20 min', 'Méditation de synthèse et d\'engagement',
            '<div style="line-height:2;color:rgba(232,224,208,.82);">
            Installez-vous. Prenez le temps. 5-5-5 × 3 fois.<br><br>
            Laissez défiler les 8 modules précédents comme des images.<br>
            Votre identité. Votre posture. Votre écoute. Votre transmission.<br>
            Vos résistances traversées. Votre énergie. Votre cadre. Votre lâcher-prise.<br><br>
            Qui êtes-vous maintenant que vous ne pouvez plus vous ignorer ?<br><br>
            Posez votre main sur votre cœur.<br>
            Respirez.<br>
            Et dites à voix haute ou dans votre tête :<br><br>
            <em>"Je suis [prénom]. Je suis mentore/mentor. Je ser en [votre valeur]. Et mon empreinte commence maintenant."</em>
            </div>'
        );

        $activities = [
            ['type'=>'lecture','title'=>'Introduction — La synthèse vivante','duration'=>'15 min','description'=>'Au-delà du résumé : la question unique "Quel mentor unique es-tu, toi ?"','content'=>$intro],
            ['type'=>'lecture','title'=>'Leçon 1 — Votre signature de mentor','duration'=>'25 min','description'=>'Les 5 dimensions : ton, approche, force première, public naturel, empreinte souhaitée.','content'=>$signature],
            ['type'=>'lecture','title'=>'Leçon 2 — Le Manifeste du Mentor','duration'=>'20 min','description'=>'Structure en 7 phrases. Votre déclaration durable de qui vous êtes et pour quoi vous servez.','content'=>$manifeste],
            ['type'=>'pratique','title'=>'Méditation guidée — Synthèse et engagement','duration'=>'25 min','description'=>'Traverser les 8 modules en images. Se rencontrer comme mentor. Prononcer son engagement.','content'=>$pratique],
            ['type'=>'exercice','title'=>'Exercice — Mon Manifeste du Mentor','duration'=>'40 min','description'=>'Rédiger son Manifeste complet en 7 phrases. Le lire à voix haute. Le noter. Le poster.'],
            ['type'=>'reflexion','title'=>'Intégration — Ma prochaine étape concrète','duration'=>'20 min','description'=>'Définir ses 3 premières actions de mentor pour les 30 prochains jours. À qui vas-je proposer mes premières sessions ?'],
        ];

        $activitiesEn = [
            ['type'=>'lecture','title'=>'Introduction — The living synthesis','duration'=>'15 min','description'=>'Beyond summary: the unique question "What unique mentor are you?"'],
            ['type'=>'lecture','title'=>'Lesson 1 — Your mentor signature','duration'=>'25 min','description'=>'The 5 dimensions: tone, approach, primary strength, natural audience, desired legacy.'],
            ['type'=>'lecture','title'=>'Lesson 2 — The Mentor Manifesto','duration'=>'20 min','description'=>'7-sentence structure. Your lasting declaration of who you are and what you serve.'],
            ['type'=>'pratique','title'=>'Guided meditation — Synthesis and commitment','duration'=>'25 min','description'=>'Travel through the 8 modules in images. Meet yourself as a mentor. Pronounce your commitment.'],
            ['type'=>'exercice','title'=>'Exercise — My Mentor Manifesto','duration'=>'40 min','description'=>'Write your complete Manifesto in 7 sentences. Read it aloud. Record it. Post it.'],
            ['type'=>'reflexion','title'=>'Integration — My next concrete step','duration'=>'20 min','description'=>'Define your first 3 mentor actions for the next 30 days. To whom will you offer your first sessions?'],
        ];

        return compact('activities', 'activitiesEn');
    }

    // ══════════════════════════════════════════════════════
    // SEED PRINCIPAL
    // ══════════════════════════════════════════════════════
    public function run(): void
    {
        $modules = [
            [
                'slug'        => 'mentor-01-identite-du-mentor',
                'title'       => 'L\'Identité du Mentor',
                'description' => 'Valeurs fondatrices · Blessures transformées · Singularité du mentor · Identité avant la méthode',
                'week_label'  => 'Module 01',
                'order'       => 1,
                'intro_text'  => "L'IDENTITÉ DU MENTOR — Module 01\n\nUn mentor qui ne sait pas qui il est transmet sa confusion.\nUn mentor qui se connaît transmet sa clarté.\n\nCe module pose la question fondatrice : qui es-tu, toi qui oses accompagner ?\nValeurs fondatrices · Blessures traversées · Force singulière · La boussole qui ne ment jamais.\n\nFondement : Marc 10:43-45 — Le Leader est un Serviteur.",
                'intro_text_en' => "THE MENTOR'S IDENTITY — Module 01\n\nA mentor who does not know who they are transmits their confusion.\nA mentor who knows themselves transmits their clarity.\n\nThis module asks the founding question: who are you, you who dare to accompany?\nFounding values · Wounds traversed · Singular strength · The compass that never lies.\n\nFoundation: Mark 10:43-45 — The Leader is a Servant.",
                'content'     => $this->module01(),
            ],
            [
                'slug'        => 'mentor-02-posture-du-serviteur',
                'title'       => 'La Posture du Serviteur',
                'description' => 'Les 3 postures du mentor · Les 4 pièges · Service vs Autorité · Influence durable',
                'week_label'  => 'Module 02',
                'order'       => 2,
                'intro_text'  => "LA POSTURE DU SERVITEUR — Module 02\n\nLe monde confond autorité et leadership.\nIl croit que commander, c'est être grand.\nLe mentor sait le contraire : c'est en se mettant au service que l'on devient inoubliable.\n\nFormateur-autorité vs Coach-expert vs Mentor-serviteur.\nFondement : Marc 10:43-45.",
                'intro_text_en' => "THE SERVANT POSTURE — Module 02\n\nThe world confuses authority and leadership.\nIt believes commanding is greatness.\nThe mentor knows the opposite: it is by serving that one becomes unforgettable.\n\nAuthoritative trainer vs Expert coach vs Servant-mentor.\nFoundation: Mark 10:43-45.",
                'content'     => $this->module02(),
            ],
            [
                'slug'        => 'mentor-03-ecoute-active',
                'title'       => 'L\'Écoute Active',
                'description' => 'Les 5 niveaux d\'écoute · Questions puissantes · Présence sans projection · L\'art du silence',
                'week_label'  => 'Module 03',
                'order'       => 3,
                'intro_text'  => "L'ÉCOUTE ACTIVE — Module 03\n\nLa plupart des gens n'écoutent pas — ils attendent leur tour pour parler.\nLe mentor écoute avec tout son être.\n\nDe l'écoute superficielle (niveau 1) à l'écoute générative (niveau 5).\nQuestions qui ouvrent · Le pouvoir du silence · Présence sans projection.",
                'intro_text_en' => "ACTIVE LISTENING — Module 03\n\nMost people don't listen — they wait for their turn to speak.\nThe mentor listens with their whole being.\n\nFrom surface listening (level 1) to generative listening (level 5).\nOpening questions · The power of silence · Presence without projection.",
                'content'     => $this->module03(),
            ],
            [
                'slug'        => 'mentor-04-transmission-vivante',
                'title'       => 'La Transmission Vivante',
                'description' => 'Storytelling de l\'expérience · Alignement vie-enseignement · Transmettre par l\'exemple',
                'week_label'  => 'Module 04',
                'order'       => 4,
                'intro_text'  => "LA TRANSMISSION VIVANTE — Module 04\n\nUn discours instruit. Une vie vécue inspire.\nLa transmission vivante, c'est quand ce que vous dites et ce que vous êtes sont alignés.\n\nStructure en 5 étapes pour raconter ce qui libère (pas ce qui impressionne).\nAudit d'alignement vie-enseignement.",
                'intro_text_en' => "LIVING TRANSMISSION — Module 04\n\nA speech instructs. A lived life inspires.\nLiving transmission is when what you say and who you are are aligned.\n\n5-step structure to tell what liberates (not impresses).\nLife-teaching alignment audit.",
                'content'     => $this->module04(),
            ],
            [
                'slug'        => 'mentor-05-les-resistances',
                'title'       => 'Les Résistances',
                'description' => 'Lire les résistances · 5 types · Protocole de transformation en 5 étapes · Outil du mentor',
                'week_label'  => 'Module 05',
                'order'       => 5,
                'intro_text'  => "LES RÉSISTANCES — Module 05\n\nDans chaque accompagnement, vous rencontrerez des résistances.\nCelles de vos accompagnés — et les vôtres.\n\nLe mentor non-préparé vit les résistances comme des échecs.\nLe mentor expérimenté les lit comme des messages.\n\n5 types de résistance · Protocole de transformation en 5 étapes.",
                'intro_text_en' => "RESISTANCES — Module 05\n\nIn every accompaniment, you will encounter resistance.\nYour mentees' — and your own.\n\nThe unprepared mentor experiences resistance as failure.\nThe experienced mentor reads them as messages.\n\n5 types of resistance · 5-step transformation protocol.",
                'content'     => $this->module05(),
            ],
            [
                'slug'        => 'mentor-06-energie-du-mentor',
                'title'       => 'L\'Énergie du Mentor',
                'description' => 'Les 4 sources d\'énergie · Rituel 5-5-5 Mentor · Ressourcement comme éthique',
                'week_label'  => 'Module 06',
                'order'       => 6,
                'intro_text'  => "L'ÉNERGIE DU MENTOR — Module 06\n\nUn mentor épuisé n'accompagne plus — il survit.\nLa gestion de votre énergie n'est pas du confort. C'est de l'éthique.\n\n4 sources d'énergie : physique · émotionnelle · mentale · spirituelle.\nRituel quotidien 5-5-5 Édition Mentor.",
                'intro_text_en' => "THE MENTOR'S ENERGY — Module 06\n\nAn exhausted mentor no longer accompanies — they survive.\nManaging your energy is not comfort. It is ethics.\n\n4 energy sources: physical · emotional · mental · spiritual.\nDaily ritual 5-5-5 Mentor Edition.",
                'content'     => $this->module06(),
            ],
            [
                'slug'        => 'mentor-07-cadre-sacre',
                'title'       => 'Le Cadre Sacré',
                'description' => 'Les 5 éléments du cadre · Confidentialité · Présence totale · Rituel d\'ouverture · Réparation',
                'week_label'  => 'Module 07',
                'order'       => 7,
                'intro_text'  => "LE CADRE SACRÉ — Module 07\n\nUn cadre sacré n'est pas un lieu. C'est une qualité de présence.\nC'est ce qui fait que quelqu'un sent instinctivement : « Ici, je peux être moi-même. »\n\nLes 5 éléments : confidentialité · absence de jugement · présence totale · permission d'être incomplet · ritualisation.\nViolations fréquentes et comment réparer.",
                'intro_text_en' => "THE SACRED FRAME — Module 07\n\nA sacred frame is not a place. It is a quality of presence.\nIt is what makes someone feel instinctively: \"Here, I can be myself.\"\n\nThe 5 elements: confidentiality · no judgment · total presence · permission to be incomplete · ritualization.\nCommon violations and how to repair them.",
                'content'     => $this->module07(),
            ],
            [
                'slug'        => 'mentor-08-art-du-lacher-prise',
                'title'       => 'L\'Art du Lâcher-Prise',
                'description' => 'Attachement du mentor · Clôture rituelle · Délégation · Détachement bienveillant',
                'week_label'  => 'Module 08',
                'order'       => 8,
                'intro_text'  => "L'ART DU LÂCHER-PRISE — Module 08\n\nLe mentor accomplit sa mission quand son accompagné n'a plus besoin de lui.\nC'est le paradoxe final : plus votre travail est réussi, plus ils s'éloignent.\nEt c'est exactement ça, la victoire.\n\n3 formes d'attachement · 3 pratiques du lâcher-prise · Rituel de clôture.",
                'intro_text_en' => "THE ART OF LETTING GO — Module 08\n\nThe mentor fulfills their mission when their mentee no longer needs them.\nThis is the ultimate paradox: the more successful your work, the more they move away.\nAnd that is exactly the victory.\n\n3 forms of attachment · 3 letting-go practices · Closing ritual.",
                'content'     => $this->module08(),
            ],
            [
                'slug'        => 'mentor-09-signature-de-mentor',
                'title'       => 'Ma Signature de Mentor',
                'description' => 'Les 5 dimensions · Manifeste du Mentor · Empreinte durable · Engagement final',
                'week_label'  => 'Module 09',
                'order'       => 9,
                'intro_text'  => "MA SIGNATURE DE MENTOR — Module 09\n\nVous êtes arrivé au dernier module.\nLa question n'est plus \"qu'est-ce qu'un bon mentor ?\" — elle est : Quel mentor unique es-tu, toi ?\n\nVotre signature en 5 dimensions · Le Manifeste du Mentor en 7 phrases · Votre engagement durable.\nFondement : Marc 10:43-45 — le Leader est un Serviteur.",
                'intro_text_en' => "MY MENTOR SIGNATURE — Module 09\n\nYou have reached the last module.\nThe question is no longer \"what is a good mentor?\" — it is: What unique mentor are you?\n\nYour signature in 5 dimensions · The Mentor Manifesto in 7 sentences · Your lasting commitment.\nFoundation: Mark 10:43-45 — the Leader is a Servant.",
                'content'     => $this->module09(),
            ],
        ];

        foreach ($modules as $m) {
            DB::table('formation_modules')->updateOrInsert(
                ['slug' => $m['slug'], 'track' => 'mentor'],
                [
                    'slug'          => $m['slug'],
                    'title'         => $m['title'],
                    'description'   => $m['description'],
                    'week_label'    => $m['week_label'],
                    'track'         => 'mentor',
                    'order'         => $m['order'],
                    'is_active'     => true,
                    'intro_text'    => $m['intro_text'],
                    'intro_text_en' => $m['intro_text_en'],
                    'activities'    => json_encode($m['content']['activities']),
                    'activities_en' => json_encode($m['content']['activitiesEn']),
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]
            );

            $this->command->info('[FormationMentorSeeder] ✓ Module '.$m['week_label'].' — '.$m['title']);
        }

        $this->command->info('[FormationMentorSeeder] ✓ 9 modules Mentor insérés avec succès.');
    }
}
