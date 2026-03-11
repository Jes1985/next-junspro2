<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormationModuleContentSeeder extends Seeder
{
    private array $content = [
        '01-je-me-rencontre' => [
            'intro_text' => "Il y a quelque chose d'étrange dans notre époque : nous sommes constamment en mouvement, constamment connectés, constamment occupés — et pourtant, quelque chose en nous reste sans réponse.\n\nCe n'est pas un manque de volonté. Ce n'est pas non plus un manque de travail.\nC'est l'absence d'une chose simple, presque oubliée : **se rencontrer soi-même.**\n\nCe module ne vous demande pas de changer. Il vous demande d'abord de **voir** — honnêtement, sans défense, sans jugement.",
            'description' => 'Premier pas vers vous-même. Comprendre pourquoi vous courez, et découvrir qui vous êtes quand vous vous arrêtez.',
            'activities' => [
                ['type' => 'lecture',  'title' => 'La science de la course',         'duration' => '10 min', 'description' => 'Le système nerveux autonome entre sympathique et parasympathique. Pourquoi le corps s\'épuise et comment 5 minutes de souffle conscient changent tout.'],
                ['type' => 'exercice', 'title' => 'L\'inventaire honnête',           'duration' => '15 min', 'description' => 'Trois questions sans censure : Je cours après quoi ? Qu\'est-ce que j\'évite ? Si je m\'arrêtais vraiment — qu\'est-ce qui serait encore là ?'],
                ['type' => 'pratique', 'title' => 'La première Pause Souffle 5-5-5', 'duration' => '5 min',  'description' => 'Inspirer 5s · Retenir 5s · Expirer 5s. 5 cycles. Remarquer une sensation et la noter.'],
                ['type' => 'ecriture', 'title' => 'La lettre au moi qui courait',    'duration' => '20 min', 'description' => 'Écrire 10 à 20 lignes adressées à la version de vous qui courait le plus vite. Commencer par : "Je te vois. Et je comprends pourquoi tu courais..."'],
            ],
            'conclusion' => 'Infiniment + présent(e) à vous-même qu\'au début de cette semaine.',
        ],
        '02-je-reconnais-mes-blessures' => [
            'intro_text' => "Nous portons tous des blessures. Des mots entendus trop tôt. Des absences mal interprétées. Des deuils qu'on n'a pas eu le droit de faire.\n\nLe corps garde tout — longtemps avant que la tête comprenne.\n\nCes blessures ne sont pas des défauts. Elles sont des cartes. Elles indiquent où vous avez eu besoin de protection. Et où vous pouvez aujourd'hui commencer à guérir.\n\nLa première étape n'est pas de guérir. C'est de **voir**.",
            'description' => 'Reconnaître sans se condamner. Le corps comme mémoire. Transformer la honte en compréhension.',
            'activities' => [
                ['type' => 'lecture',  'title' => 'Comment le corps porte les blessures',   'duration' => '15 min', 'description' => 'Les travaux de Peter Levine (Somatic Experiencing) et Bessel van der Kolk (Le corps n\'oublie rien). Le traumatisme non exprimé s\'installe dans le système nerveux.'],
                ['type' => 'exercice', 'title' => 'La cartographie du corps',               'duration' => '15 min', 'description' => 'Scanner le corps de la tête aux pieds. Identifier trois zones de tension. Nommer ce que chaque zone pourrait porter sans chercher à l\'analyser.'],
                ['type' => 'pratique', 'title' => 'Respirer vers la tension',              'duration' => '8 min',  'description' => 'Identifier une zone tendue. Inspirer vers elle 5s, expirer en relâchant 5s. Lui dire intérieurement : "Je te vois." Répéter 5 cycles.'],
                ['type' => 'ecriture', 'title' => 'Lettre à la blessure',                  'duration' => '20 min', 'description' => 'Écrire une lettre à la version blessée de vous-même. Pas pour guérir — pour témoigner. Commencer par : "Je te vois. Et je comprends pourquoi tu t\'es protégé(e)."'],
                ['type' => 'reflexion','title' => 'Ce que la blessure m\'a appris',        'duration' => '10 min', 'description' => 'Compléter : "Cette blessure m\'a appris à... Elle m\'a coûté... Mais elle m\'a aussi donné..."'],
            ],
            'conclusion' => 'Infiniment + proche de vous-même dans votre vérité.',
        ],
        '03-je-decris-mon-bonheur' => [
            'intro_text' => "Beaucoup de personnes savent précisément ce qu'elles ne veulent plus. Mais très peu savent décrire ce qu'elles veulent vraiment.\n\nLe bonheur n'est pas une destination abstraite. Il est fait de moments concrets. De sensations. De mots. D'odeurs. De relations.\n\nSi vous ne savez pas à quoi ressemble votre bonheur — vous ne pouvez pas le reconnaître quand il arrive.",
            'description' => 'Passer de "ce que je ne veux plus" à "ce que je veux vraiment". La boussole intérieure.',
            'activities' => [
                ['type' => 'lecture',  'title' => 'Le bonheur est dans les détails',       'duration' => '10 min', 'description' => 'La psychologie positive (Martin Seligman, PERMA) : le bonheur durable est fait d\'engagement, de sens, de relations — pas de plaisir immédiat.'],
                ['type' => 'exercice', 'title' => 'Le souvenir boussole',                  'duration' => '15 min', 'description' => 'Retrouver un souvenir où vous vous êtes senti(e) pleinement vivant(e). Quel âge ? Où ? Que faisiez-vous ? Qu\'est-ce que vous ressentiez dans le corps ? Ce souvenir est votre référence.'],
                ['type' => 'pratique', 'title' => 'Ancrage dans la joie — Pause Souffle',  'duration' => '5 min',  'description' => 'Tenir le souvenir boussole en tête pendant 5 cycles 5-5-5. Laisser la sensation du souvenir amplifier la respiration.'],
                ['type' => 'ecriture', 'title' => 'Mon bonheur en 5 phrases concrètes',    'duration' => '15 min', 'description' => 'Décrire le bonheur avec des détails vrais. Pas de grands idéaux. Exemple : "Je suis heureuse quand je prends un café le matin en silence avant que tout le monde se réveille."'],
            ],
            'conclusion' => 'Infiniment + proche de votre propre boussole intérieure.',
        ],
        '04-j-ecoute-mon-souffle' => [
            'intro_text' => "Le souffle est le seul système du corps qui soit à la fois automatique et conscient. Vous pouvez laisser votre cœur battre sans y penser. Mais vous pouvez aussi décider de respirer autrement — maintenant — et transformer votre état intérieur en quelques minutes.\n\nC'est là que réside un pouvoir extraordinaire.\n\nPas le pouvoir de contrôler les autres. Pas le pouvoir de dominer le monde.\n\n**Le pouvoir de revenir à vous-même.**",
            'description' => 'Le cœur de la formation. Maîtriser la cohérence cardiaque et comprendre la physiologie du souffle.',
            'activities' => [
                ['type' => 'lecture',  'title' => 'La physiologie du souffle',             'duration' => '20 min', 'description' => 'Le nerf vague, la cohérence cardiaque (Institut HeartMath), les fréquences respiratoires. Pourquoi 5,5 respirations/minute est la fréquence de résonance du corps humain.'],
                ['type' => 'pratique', 'title' => 'Cohérence cardiaque 5-5 — 5 minutes',  'duration' => '5 min',  'description' => 'Inspirer 5s, expirer 5s. Maintenir pendant 5 minutes (30 cycles). Observer la différence avant/après sur l\'état émotionnel.'],
                ['type' => 'pratique', 'title' => 'Souffle carré — 4-4-4-4',              'duration' => '5 min',  'description' => 'Inspirer 4s · Retenir 4s · Expirer 4s · Retenir 4s. Technique des forces spéciales (Box Breathing). Idéal pour le stress intense.'],
                ['type' => 'pratique', 'title' => 'Souffle apaisant — 4-7-8',             'duration' => '5 min',  'description' => 'Inspirer 4s · Retenir 7s · Expirer 8s. Technique du Dr Andrew Weil. Active le système parasympathique en 4 cycles.'],
                ['type' => 'reflexion','title' => 'Journal du souffle — 7 jours',         'duration' => '7 j',    'description' => 'Pratiquer la cohérence cardiaque 5 minutes chaque matin pendant 7 jours. Noter chaque jour : état avant / état après / une observation.'],
            ],
            'conclusion' => 'Infiniment + à l\'écoute de votre souffle intérieur.',
        ],
        '05-je-decouvre-ma-mission' => [
            'intro_text' => "Il existe une question que peu de gens se posent vraiment.\n\nPas : qu'est-ce que je veux faire ?\nMais : **pourquoi je suis là ?**\n\nVotre mission n'est pas dans un diplôme. Elle n'est pas dans un titre. Elle est dans l'intersection de trois choses : ce que vous avez traversé... ce qui vous vient naturellement... et ce dont le monde a besoin.",
            'description' => 'Trouver l\'intersection entre votre vécu, vos dons naturels et le besoin du monde. Le concept d\'Ikigaï appliqué à la pratique.',
            'activities' => [
                ['type' => 'lecture',  'title' => 'L\'Ikigaï et la raison d\'être',       'duration' => '15 min', 'description' => 'Le concept japonais d\'Ikigaï : ce que vous aimez / ce pour quoi vous êtes fait(e) / ce dont le monde a besoin / ce pour quoi vous pouvez être payé(e). Leur intersection est votre mission.'],
                ['type' => 'exercice', 'title' => 'Votre carte de mission',                'duration' => '30 min', 'description' => 'Dessiner les 4 cercles de l\'Ikigaï. Remplir chaque cercle honnêtement. Observer les intersections. La mission n\'a pas besoin d\'être parfaite — elle se révèle en marchant.'],
                ['type' => 'pratique', 'title' => 'Pause Souffle de clarté',              'duration' => '7 min',  'description' => '5 cycles 5-5-5. Puis poser la question intérieure : "Ce que j\'ai traversé peut servir à..." Laisser venir les réponses sans les forcer.'],
                ['type' => 'ecriture', 'title' => 'Ma phrase de mission',                 'duration' => '20 min', 'description' => 'Compléter : "Ma présence dans la vie des autres permet à [qui] de [faire quoi] pour [quel résultat]." Écrire 3 versions. Garder celle qui vous émeut.'],
            ],
            'conclusion' => 'Infiniment + proche de votre raison d\'être.',
        ],
        '06-je-pratique-le-rituel' => [
            'intro_text' => "Vous avez parcouru un chemin.\n\nVous vous êtes rencontré(e). Vous avez reconnu vos blessures. Vous avez décrit votre bonheur. Vous avez écouté votre souffle. Vous avez touché votre mission.\n\nMaintenant, il est temps de **transmettre**.\n\nParce que ce que vous avez vécu ici — d'autres personnes en ont besoin.\n\nLe Rituel Pause Souffle que vous allez guider n'est pas une technique. C'est une **présence**.",
            'description' => 'Intégrer tous les outils et apprendre à guider une séance complète. De praticant(e) à Praticien(ne) certifié(e).',
            'activities' => [
                ['type' => 'lecture',  'title' => 'L\'éthique du praticien',              'duration' => '15 min', 'description' => 'Cadre déontologique : confidentialité, limites de la pratique, orientation vers les professionnels de santé. Ce que le Rituel Pause Souffle est — et ce qu\'il n\'est pas.'],
                ['type' => 'pratique', 'title' => 'Protocole séance 30 minutes',          'duration' => '30 min', 'description' => 'Structure complète d\'une séance guidée : accueil (5 min) · scan corporel (5 min) · pratique respiratoire principale (15 min) · intégration et clôture (5 min). Pratiquer sur soi-même d\'abord.'],
                ['type' => 'pratique', 'title' => 'Protocole séance 60 minutes',          'duration' => '60 min', 'description' => 'Version étendue avec approfondissement : accueil · scan · exercice d\'ancrage · cohérence cardiaque · visualisation guidée · journal rapide · clôture.'],
                ['type' => 'exercice', 'title' => 'Séance témoin — guider quelqu\'un',   'duration' => '45 min', 'description' => 'Guider une première séance complète avec un proche volontaire. Observer, puis noter : ce qui s\'est bien passé, ce qui peut s\'améliorer, ce que vous avez ressenti en transmettant.'],
                ['type' => 'reflexion','title' => 'Ma déclaration de praticien(ne)',     'duration' => '15 min', 'description' => 'Écrire en une page : qui vous étiez avant, ce que cette formation a transformé, et comment vous comptez transmettre le Rituel Pause Souffle.'],
            ],
            'conclusion' => 'J\'ai couru très longtemps. J\'ai tout arrêté. Et c\'est là que j\'ai tout trouvé — et infiniment plus. ∞+',
        ],
    ];

    private array $contentEn = [
        '01-je-me-rencontre' => [
            'title_en'       => 'I Meet Myself',
            'description_en' => 'The first step toward yourself. Understanding why you run, and discovering who you are when you stop.',
            'intro_text_en'  => "There is something strange about our time: we are constantly in motion, constantly connected, constantly busy — and yet, something inside us remains unanswered.\n\nIt is not a lack of willpower. It is not a lack of hard work.\nIt is the absence of one simple, almost forgotten thing: **meeting yourself.**\n\nThis module does not ask you to change. It first asks you to **see** — honestly, without defense, without judgment.",
            'activities_en'  => [
                ['type' => 'lecture',  'title' => 'The science of running',             'duration' => '10 min', 'description' => 'The autonomic nervous system: sympathetic vs. parasympathetic. Why the body burns out, and how 5 minutes of conscious breathing changes everything.'],
                ['type' => 'exercise', 'title' => 'The honest inventory',               'duration' => '15 min', 'description' => 'Three uncensored questions: What am I chasing? What am I avoiding feeling? If I truly stopped — what would still be there?'],
                ['type' => 'practice', 'title' => 'The first Pause Souffle 5-5-5',     'duration' => '5 min',  'description' => 'Inhale 5s · Hold 5s · Exhale 5s. 5 cycles. Notice a sensation and write it down.'],
                ['type' => 'writing',  'title' => 'Letter to the self who was running', 'duration' => '20 min', 'description' => 'Write 10–20 lines addressed to the version of you who was running fastest. Begin with: "I see you. And I understand why you were running..."'],
            ],
        ],
        '02-je-reconnais-mes-blessures' => [
            'title_en'       => 'I Recognize My Wounds',
            'description_en' => 'Recognizing without self-judgment. The body as memory. Transforming shame into understanding.',
            'intro_text_en'  => "We all carry wounds. Words heard too early. Absences we misunderstood. Griefs we were not allowed to feel.\n\nThe body holds everything — long before the mind understands.\n\nThese wounds are not flaws. They are maps. They show where you needed protection. And where you can begin to heal today.\n\nThe first step is not to heal. It is to **see**.",
            'activities_en'  => [
                ['type' => 'lecture',  'title' => 'How the body carries wounds',        'duration' => '15 min', 'description' => 'The work of Peter Levine (Somatic Experiencing) and Bessel van der Kolk (The Body Keeps the Score). Unexpressed trauma settles in the nervous system.'],
                ['type' => 'exercise', 'title' => 'Body mapping',                        'duration' => '15 min', 'description' => 'Scan the body from head to toe. Identify three areas of tension. Name what each area might be holding without trying to analyze it.'],
                ['type' => 'practice', 'title' => 'Breathing toward the tension',       'duration' => '8 min',  'description' => 'Find a tense area. Inhale toward it for 5s, exhale releasing for 5s. Say inwardly: "I see you." Repeat 5 cycles.'],
                ['type' => 'writing',  'title' => 'Letter to the wound',                'duration' => '20 min', 'description' => 'Write a letter to your wounded self. Not to heal — to witness. Begin with: "I see you. And I understand why you protected yourself."'],
                ['type' => 'reflection', 'title' => 'What the wound taught me',        'duration' => '10 min', 'description' => 'Complete: "This wound taught me... It cost me... But it also gave me..."'],
            ],
        ],
        '03-je-decris-mon-bonheur' => [
            'title_en'       => 'I Describe My Happiness',
            'description_en' => 'Moving from "what I no longer want" to "what I truly want." The inner compass.',
            'intro_text_en'  => "Many people know exactly what they no longer want. But very few can describe what they truly want.\n\nHappiness is not an abstract destination. It is made of concrete moments. Sensations. Words. Smells. Relationships.\n\nIf you don't know what your happiness looks like — you cannot recognize it when it arrives.",
            'activities_en'  => [
                ['type' => 'lecture',  'title' => 'Happiness is in the details',         'duration' => '10 min', 'description' => 'Positive psychology (Martin Seligman, PERMA): lasting happiness is built on engagement, meaning, and relationships — not immediate pleasure.'],
                ['type' => 'exercise', 'title' => 'The compass memory',                  'duration' => '15 min', 'description' => 'Find a memory where you felt fully alive. How old were you? Where? What were you doing? What did you feel in your body? This memory is your reference.'],
                ['type' => 'practice', 'title' => 'Anchoring in joy — Pause Souffle',   'duration' => '5 min',  'description' => 'Hold the compass memory in mind during 5 cycles of 5-5-5. Let the feeling of the memory amplify your breath.'],
                ['type' => 'writing',  'title' => 'My happiness in 5 concrete sentences','duration' => '15 min', 'description' => 'Describe happiness with true details. No grand ideals. Example: "I am happy when I have a morning coffee in silence before everyone wakes up."'],
            ],
        ],
        '04-j-ecoute-mon-souffle' => [
            'title_en'       => 'I Listen to My Inner Breath',
            'description_en' => 'The heart of the training. Mastering cardiac coherence and understanding the physiology of breath.',
            'intro_text_en'  => "The breath is the only system in the body that is both automatic and conscious. You can let your heart beat without thinking about it. But you can also decide to breathe differently — right now — and transform your inner state in just a few minutes.\n\nThat is where an extraordinary power lies.\n\nNot the power to control others. Not the power to dominate the world.\n\n**The power to return to yourself.**",
            'activities_en'  => [
                ['type' => 'lecture',  'title' => 'The physiology of breath',            'duration' => '20 min', 'description' => 'The vagus nerve, cardiac coherence (HeartMath Institute), respiratory frequencies. Why 5.5 breaths per minute is the resonance frequency of the human body.'],
                ['type' => 'practice', 'title' => 'Cardiac coherence 5-5 — 5 minutes', 'duration' => '5 min',  'description' => 'Inhale 5s, exhale 5s. Maintain for 5 minutes (30 cycles). Observe the difference in your emotional state before and after.'],
                ['type' => 'practice', 'title' => 'Box breathing — 4-4-4-4',            'duration' => '5 min',  'description' => 'Inhale 4s · Hold 4s · Exhale 4s · Hold 4s. Special forces technique. Ideal for intense stress.'],
                ['type' => 'practice', 'title' => 'Calming breath — 4-7-8',             'duration' => '5 min',  'description' => 'Inhale 4s · Hold 7s · Exhale 8s. Dr. Andrew Weil technique. Activates the parasympathetic system in 4 cycles.'],
                ['type' => 'reflection', 'title' => 'Breath journal — 7 days',          'duration' => '7 days', 'description' => 'Practice cardiac coherence 5 minutes each morning for 7 days. Note each day: state before / state after / one observation.'],
            ],
        ],
        '05-je-decouvre-ma-mission' => [
            'title_en'       => 'I Discover My Unique Mission',
            'description_en' => 'Finding the intersection of your lived experience, natural gifts, and the world\'s need. The Ikigai applied to practice.',
            'intro_text_en'  => "There is a question very few people truly ask themselves.\n\nNot: what do I want to do?\nBut: **why am I here?**\n\nYour mission is not in a diploma. It is not in a title. It is in the intersection of three things: what you have been through... what comes naturally to you... and what the world needs.",
            'activities_en'  => [
                ['type' => 'lecture',  'title' => 'Ikigai and reason for being',        'duration' => '15 min', 'description' => 'The Japanese concept of Ikigai: what you love / what you are good at / what the world needs / what you can be paid for. Their intersection is your mission.'],
                ['type' => 'exercise', 'title' => 'Your mission map',                   'duration' => '30 min', 'description' => 'Draw the 4 Ikigai circles. Fill each one honestly. Observe the intersections. The mission does not need to be perfect — it reveals itself as you walk.'],
                ['type' => 'practice', 'title' => 'Clarity Pause Souffle',              'duration' => '7 min',  'description' => '5 cycles of 5-5-5. Then ask inwardly: "What I have been through can serve..." Let answers come without forcing them.'],
                ['type' => 'writing',  'title' => 'My mission statement',               'duration' => '20 min', 'description' => 'Complete: "My presence in the lives of others allows [who] to [do what] for [what result]." Write 3 versions. Keep the one that moves you.'],
            ],
        ],
        '06-je-pratique-le-rituel' => [
            'title_en'       => 'I Practice the Pause Souffle Ritual',
            'description_en' => 'Integrating all tools and learning to guide a complete session. From practitioner-in-training to Certified Pause Souffle Practitioner.',
            'intro_text_en'  => "You have traveled a path.\n\nYou have met yourself. You have recognized your wounds. You have described your happiness. You have listened to your breath. You have touched your mission.\n\nNow it is time to **transmit**.\n\nBecause what you have lived here — other people need it.\n\nThe Pause Souffle Ritual you are going to guide is not a technique. It is a **presence**.",
            'activities_en'  => [
                ['type' => 'lecture',  'title' => 'The practitioner\'s ethics',        'duration' => '15 min', 'description' => 'Ethical framework: confidentiality, limits of practice, referral to healthcare professionals. What the Pause Souffle Ritual is — and what it is not.'],
                ['type' => 'practice', 'title' => '30-minute session protocol',        'duration' => '30 min', 'description' => 'Complete guided session structure: welcome (5 min) · body scan (5 min) · main breathing practice (15 min) · integration and closing (5 min). Practice on yourself first.'],
                ['type' => 'practice', 'title' => '60-minute session protocol',        'duration' => '60 min', 'description' => 'Extended version: welcome · scan · anchoring exercise · cardiac coherence · guided visualization · quick journal · closing.'],
                ['type' => 'exercise', 'title' => 'Witness session — guide someone',   'duration' => '45 min', 'description' => 'Guide a first complete session with a willing friend or family member. Then note: what went well, what can improve, what you felt while transmitting.'],
                ['type' => 'reflection', 'title' => 'My practitioner declaration',     'duration' => '15 min', 'description' => 'Write one page: who you were before, what this training transformed, and how you intend to share the Pause Souffle Ritual.'],
            ],
        ],
    ];

    public function run(): void
    {
        foreach ($this->content as $slug => $data) {
            $enData = $this->contentEn[$slug] ?? [];
            DB::table('formation_modules')
                ->where('slug', $slug)
                ->update([
                    'description'    => $data['description'],
                    'intro_text'     => $data['intro_text'],
                    'activities'     => json_encode($data['activities']),
                    'title_en'       => $enData['title_en'] ?? null,
                    'description_en' => $enData['description_en'] ?? null,
                    'intro_text_en'  => $enData['intro_text_en'] ?? null,
                    'activities_en'  => isset($enData['activities_en']) ? json_encode($enData['activities_en']) : null,
                    'updated_at'     => now(),
                ]);
        }

        $this->command->info('[FormationModuleContentSeeder] Contenu bilingue FR + EN des 6 modules mis à jour.');
    }
}
