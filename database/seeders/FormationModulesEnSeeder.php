<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\FormationModule;

/**
 * Traductions anglaises (title_en, description_en, activities_en) pour les 22 modules PARCOURS existants.
 * M29 et M30 ont leur traduction inline dans FormationWellbeingModulesSeeder.
 */
class FormationModulesEnSeeder extends Seeder
{
    // ── Micro-helpers HTML (copie légère des helpers du seeder FR) ────────────
    private function card(string $color, string $badge, string $title, string $body): string
    {
        return '<div style="border-left:3px solid '.$color.';padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(0,0,0,.15);border-radius:0 10px 10px 0;">'
            .'<h4 style="color:#fff;font-size:.87rem;font-weight:700;margin:0 0 .5rem;display:flex;align-items:center;gap:.6rem;">'
            .'<span style="font-size:.68rem;color:'.$color.';background:rgba(0,0,0,.35);border:1px solid '.$color.';border-radius:6px;padding:.1rem .4rem;flex-shrink:0;">'.$badge.'</span>'
            .$title.'</h4>'
            .'<div style="font-size:.8rem;color:rgba(232,224,208,.72);line-height:1.85;">'.$body.'</div>'
            .'</div>';
    }

    private function ex(string $color, string $num, string $title, string $body): string
    {
        return '<div style="background:rgba(0,0,0,.2);border:1px solid '.$color.'22;border-radius:12px;padding:1.1rem 1.3rem;margin-bottom:.75rem;">'
            .'<div style="display:flex;align-items:center;gap:.65rem;margin-bottom:.55rem;">'
            .'<span style="width:28px;height:28px;border-radius:50%;background:'.$color.'22;border:1.5px solid '.$color.';display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:800;color:'.$color.';flex-shrink:0;">'.$num.'</span>'
            .'<span style="font-size:.88rem;font-weight:700;color:#fff;">'.$title.'</span>'
            .'</div>'
            .'<div style="font-size:.79rem;color:rgba(232,224,208,.75);line-height:1.9;padding-left:2.1rem;">'.$body.'</div>'
            .'</div>';
    }

    // ─────────────────────────────────────────────────────────────────────────
    public function run(): void
    {
        $modules    = $this->modules();
        $introTexts = $this->introTextsEn();
        $track      = FormationModule::TRACK_PARCOURS;
        $count      = 0;

        foreach ($modules as $slug => $data) {
            $fields = [
                'title_en'       => $data['title_en'],
                'description_en' => $data['description_en'],
                'activities_en'  => json_encode($data['activities_en'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                'updated_at'     => now(),
            ];
            if (isset($introTexts[$slug])) {
                $fields['intro_text_en'] = $introTexts[$slug];
            }
            $updated = DB::table('formation_modules')
                ->where('slug', $slug)
                ->where('track', $track)
                ->update($fields);
            if ($updated) {
                $count++;
            } else {
                $this->command?->warn("[SKIP] {$slug} (parcours) not found — run FormationModulesSeeder first.");
            }
        }

        $this->command?->info("[FormationModulesEnSeeder] {$count}/".count($modules)." modules updated with English content.");

        // Also push intro_text_en for slugs only in introTextsEn (M29, M30 handled by WellbeingSeeder)
        foreach ($introTexts as $slug => $introTextEn) {
            if (!isset($modules[$slug])) {
                DB::table('formation_modules')
                    ->where('slug', $slug)
                    ->where('track', $track)
                    ->update(['intro_text_en' => $introTextEn, 'updated_at' => now()]);
            }
        }
    }

    // ─────────────────────────────────────────────────────────────────────────
    // INTRO TEXTS EN — short narrative intro paragraph per module
    // ─────────────────────────────────────────────────────────────────────────
    private function introTextsEn(): array
    {
        return [
            '06-je-visualise-ma-vie' =>
                "You have learned to listen to your body, recognise your wounds, sense what makes you feel alive, encounter your breath, hear your mission.\n\nOne more demanding question remains: how do you turn a vision into a direction precise enough to genuinely change a life?\n\nThis module is not a vision board or a positive-thinking exercise. It is a work of inner precision — clarifying the right scene, inhabiting the right identity, and choosing the discipline to become, day by day, the person you have already seen in your mind's eye.",

            '07-je-prends-soin-de-moi' =>
                "MODULE 7 — Caring for Myself First\n\nIn a turbulent aircraft, you put on your own mask before helping others. Not out of selfishness — out of logic.\n\nYet in our lives, we do the opposite. We give without stopping, and wonder why we are empty.\n\nThis module reclaims self-care as the foundation of everything: your presence, your energy, your love for others. You cannot be generous from depletion.",

            '08-gratitude-et-intention' =>
                "MODULE 8 — Gratitude & Intention\n\nGratitude is not positive thinking. It is a neurological technology that literally rewires the brain.\n\nThis module gives you two precise rituals: the evening review (closing the day with awareness) and the morning intention (opening tomorrow with direction). Together, they form the architecture of an awakened life.",

            '09-mes-priorites-dabord' =>
                "MODULE 9 — My Priorities First\n\n\"If you don't build your own dreams, someone else will hire you to build theirs.\" — Tony Gaskins\n\nThis module is a sovereignty tool. It gives you the means to identify your real priorities (not the ones others assigned you), audit where your time actually goes, and block concrete time slots for what matters most.",

            '10-interieur-propre-et-range' =>
                "MODULE 10 — A Clean & Ordered Space\n\n\"If you want to change the world, start by making your bed.\" — Admiral McRaven, Navy SEALs\n\nA disordered space creates a disordered mind. Science measures it. A bed made each morning is the first victory of the day — and it calls all the others forward.\n\nThis module gives you a simple, weekly, concrete system to maintain your space the way you maintain your relationships: with care and regularity.",

            '07-mouvement-et-posture' =>
                "MODULE 7 — Movement & Posture\n\nMovement is not sport. It is a silent conversation with your nervous system. Every posture you adopt sends a signal to the brain — of openness or contraction, of safety or threat.\n\nThis module gives you the tools to move with intelligence and inhabit your body differently.",

            '08-systeme-nerveux' =>
                "MODULE 8 — The Nervous System\n\nEverything you feel passes through it. Stress, calm, fatigue, energy — your nervous system orchestrates all of it.\n\nThis module explains how this invisible conductor works, and more importantly, how to take back the baton rather than remain at its mercy.",

            '09-gestion-des-emotions' =>
                "MODULE 9 — Emotional Regulation\n\nAn emotion is not a weakness — it is a signal. Anger, fear, sadness, joy: each one informs you of something essential.\n\nThis module teaches you to listen to these messengers rather than flee them, and to stay within your window of tolerance even when facing the most intense emotions.",

            '10-vivre-ici-et-maintenant' =>
                "MODULE 10 — Living Here and Now\n\nYou have traversed nine modules. You know how to meet yourself, regulate your emotions, move with awareness.\n\nOne fundamental question remains: where are you during all of this?\n\nHarvard measured that we spend 46.9% of our lives thinking about something other than what we are doing. And people at the end of life do not regret having worked too little. They regret not having been fully present.\n\nThis module is the capstone of your presence practice.",

            '10-sommeil-et-recuperation' =>
                "MODULE 10 — Sleep & Recovery\n\nWe recover at night. We consolidate learning, repair cells, regulate hormones. Without quality sleep, nothing functions correctly — not the body, not emotions, not concentration.\n\nThis module gives you the tools to transform your nights — and through them, every waking hour.",

            '11-relation-alimentation' =>
                "MODULE 11 — Relationship with Food\n\nEating is not a rule to follow. It is a relationship to build — with your body, its signals, and what it genuinely needs.\n\nThis module returns you to the natural intelligence of hunger and satiety that modern life has caused most of us to forget.",

            '15-activite-physique' =>
                "MODULE 15 — Physical Activity\n\nMovement is not a punishment. It is a medicine. 21 minutes of moderate activity per day is enough to transform your neurochemistry, your sleep, and your mood.\n\nThis module helps you find the movement that brings you pleasure — not suffering.",

            '22-nutrition-et-vitalite' =>
                "MODULE 22 — Nutrition & Vitality\n\nNutrition is not a diet. It is a relationship.\n\nThis module gives you the essential biochemistry: macronutrients, micronutrients, chronic inflammation, the brain-food connection — to choose with awareness, not by rule.\n\nA well-nourished body thinks better, recovers faster, resists stress more effectively. Vitality is not an aesthetic goal: it is your energetic substrate for everything else.",

            '19-medecines-complementaires' =>
                "MODULE 19 — Complementary Medicines\n\nThere are no miracle solutions. There are serious complementary approaches — and alternatives that can cost a life. This module gives you the tools of discernment: knowing what is documented, asking the right questions, and deciding from clarity — not from fear.",

            '12-presence-a-soi' =>
                "MODULE 12 — Present to Myself\n\nYour brain spends 47% of its time wandering outside the present moment. This is not a flaw — it is a habit.\n\nThis module gives you the tools to return: into your body, into the instant, into your life as it actually is.",

            '13-confiance-corporelle' =>
                "MODULE 13 — Self-Acceptance & Body Confidence\n\nYour body is not a problem to solve. It is the home you live in.\n\nThis module guides you toward a reconciliation — not with an ideal of beauty — but with the living reality of your body as it is.",

            '14-interactions-sociales' =>
                "MODULE 14 — Social Connections\n\nYour nervous system needs eyes that truly see you. Not an algorithm. Human connection is a biological need — not an option.\n\nThis module helps you audit your relationships, practise active listening, and create connections that go deeper.",

            '16-loisirs-et-vie' =>
                "MODULE 16 — Leisure & Living Fully\n\nLeisure is not wasted time. It is a neuro-psychological necessity. Without pleasure, without play, without empty time — the brain atrophies.\n\nThis module helps you reintroduce pleasure as a priority, not as a reward.",

            '17-relation-a-lautre' =>
                "MODULE 17 — Relationship with Others\n\nYou cannot give what you do not have. The quality of your relationships depends directly on your relationship with yourself.\n\nThis module gives you concrete tools: setting boundaries, communicating without harm, understanding your attachment style, and repairing after conflict.",

            '18-intimite-et-energie' =>
                "MODULE 18 — Relational Energy & Intimacy\n\nIntimacy is not a technique. It is the convergence of everything you have built: body presence, self-trust, emotional regulation, communication.\n\nThis module guides you toward deeper connection — grounded in safety and presence, not performance.",

            '20-vivre-choisir-reconstruire' =>
                "MODULE 20 — Living, Choosing, Rebuilding\n\nThis module exists for the most difficult moments. When the body changes. When an impossible choice presents itself. It prescribes nothing — it accompanies.\n\nWith respect, without judgment, with the conviction that as long as there is life, there are possibilities.",

            '21-entretenir-nos-relations' =>
                "MODULE 21 — Nurturing Our Relationships\n\nCreating a bond is accessible to almost everyone. Sustaining it over time — that is where most relationships quietly fade.\n\nThis module gives you the tools to consciously nourish the relationships that matter: love languages, emotional bank account, rituals of reconnection.",

            '11-je-transmets-ma-transformation' =>
                "MODULE 11 — Transmitting My Transformation\n\nYou have traversed eleven modules. What you have built does not belong only to you.\n\nHarvard measured that your happiness influences the people around you up to 3 degrees of separation. You do not need to explain, convince, or teach anyone anything.\n\nYour way of being — calm, present, grounded — settles into the relational field around you.",

            '29-synthese-du-parcours' =>
                "MODULE 29 — Synthesising My Journey\n\n28 modules. Hundreds of hours of inner work. Practices, awakenings, ruptures, and anchors.\n\nThis module is not a conclusion — it is a consolidation. Before turning the page, let us return to what you have traversed. Not to relive it, but to measure the distance — and never forget who you have become.",

            '30-mon-programme-quotidien' =>
                "MODULE 30 — My Daily Programme\n\nThis is not a schedule. It is an architecture.\n\nEvery step is connected to a module you have lived through. Every practice is calibrated for a real day — not an ideal day that never exists.\n\nThe full programme takes 45 minutes in the morning and 30 in the evening. It has a 20-minute version for heavy days. It comes in 4 configurations for different life situations. And it includes a 21-day contract to anchor it permanently.",
        ];
    }

    // ─────────────────────────────────────────────────────────────────────────
    // ALL 22 MODULES — English translations
    // ─────────────────────────────────────────────────────────────────────────
    private function modules(): array
    {
        $gold   = 'rgba(201,168,76,.9)';
        $teal   = 'rgba(20,184,166,.8)';
        $indigo = 'rgba(99,102,241,.85)';
        $green  = 'rgba(34,197,94,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $amber  = 'rgba(245,158,11,.85)';
        $blue   = 'rgba(59,130,246,.8)';
        $coral  = 'rgba(251,113,133,.85)';

        return [

            // ── P1 MODULE 01 ──────────────────────────────────────────────
            '01-je-me-rencontre' => [
                'title_en'       => 'Meeting Myself',
                'description_en' => 'The first inner encounter — without mask, without judgment. Conscious breathing as a doorway into self-awareness and genuine presence.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '🌱 Introduction — Meeting Yourself', 'duration' => '5 min',
                     'description' => 'Why this is the most important starting point — and what happens when you stop running.',
                     'content' => $this->card($gold, 'Why', 'The pause as an entry point',
                        'Most of us have been running — from obligation to obligation, notification to notification, thought to thought.<br><br>
                        We have forgotten how to simply <strong>be with ourselves</strong>.<br><br>
                        This module is an invitation to stop. Not to fix anything. Not to evaluate. Just to <em>meet</em> — the person you have become, the feelings you carry, the life you are actually living.<br><br>
                        <strong>The Pause Souffle Ritual</strong> begins here: in this first encounter with yourself.')],
                    ['type' => 'lecture',  'title' => 'Lesson — Who am I, right now?', 'duration' => '6 min',
                     'description' => 'The difference between the public self, the social self, and the inner self. Why most people have never truly met themselves.',
                     'content' => $this->card($teal, 'The 3 selves', 'Which one do you usually show?',
                        '<strong>The public self</strong> — the version others see: performance, role, status.<br>
                        <strong>The social self</strong> — the version adapted to groups: likeable, agreeable, safe.<br>
                        <strong>The inner self</strong> — the version that exists when no one is watching.<br><br>
                        Most personal development works on the first two. This Journey works on the third.<br><br>
                        <em style="color:'.$teal.';">This module is your first honest appointment with your inner self.</em>')],
                    ['type' => 'pratique', 'title' => '🌬 Anchor Breath — cardiac coherence 5 min', 'duration' => '5 min',
                     'description' => 'Your first conscious breathing practice: 5 cycles of 5-5-5. The foundation of everything that follows.'],
                    ['type' => 'ecriture', 'title' => '✍️ Who am I? — free writing 10 min', 'duration' => '10 min',
                     'description' => 'Without filtering. Without correcting. Who are you right now, at this point in your life?'],
                    ['type' => 'reflexion', 'title' => '🔍 What am I running from?', 'duration' => '8 min',
                     'description' => 'One question to sit with: what have you been avoiding feeling or acknowledging for the past few months?'],
                ],
            ],

            // ── P1 MODULE 02 ──────────────────────────────────────────────
            '02-je-reconnais-mes-blessures' => [
                'title_en'       => 'Recognising My Wounds',
                'description_en' => 'The 5 core wounds (Lise Bourbeau). See instead of flee. Understanding how past wounds silently shape present behaviour.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 The 5 Core Wounds — Bourbeau', 'duration' => '8 min',
                     'description' => 'Rejection, abandonment, humiliation, betrayal, injustice: how each wound creates a mask and drives unconscious behaviour.',
                     'content' => $this->card($purple, 'The 5 wounds', 'Lise Bourbeau — "Heal Your Wounds and Find Your True Self"',
                        '<strong>Rejection</strong> — "I am not wanted." Mask: the fugitive. Withdraws, isolates, seeks invisibility.<br>
                        <strong>Abandonment</strong> — "I am alone." Mask: the dependent. Clings, fears being left, seeks constant reassurance.<br>
                        <strong>Humiliation</strong> — "I am shameful." Mask: the masochist. Diminishes self, serves others before self, carries guilt.<br>
                        <strong>Betrayal</strong> — "I cannot trust." Mask: the controller. Needs to be right, dominates, struggles to delegate.<br>
                        <strong>Injustice</strong> — "I am not treated fairly." Mask: the rigid. Perfectionist, cold, critical of self and others.<br><br>
                        <em style="color:'.$purple.';">Recognising a wound is not a label — it is a liberation.</em>')],
                    ['type' => 'exercice', 'title' => 'My dominant wound', 'duration' => '15 min',
                     'description' => 'Identify your dominant wound(s). Look at the situations that provoke the strongest emotional reactions — they point to the wound.',
                     'content' => $this->ex($purple, '①', 'Which wound resonates most?',
                        'Read through the 5 wounds. Which one triggers the strongest recognition — a mix of discomfort and relief?<br><br>
                        Ask yourself: <em>In which situations do I feel the smallest, most reactive, most defended?</em><br><br>
                        Write 3 situations from your life where this wound was activated. Be specific.<br><br>
                        <em style="color:'.$purple.';">There is no shame in having wounds. Every human being carries them. The difference is whether you are aware of yours.</em>')],
                    ['type' => 'ecriture', 'title' => '✍️ Letter of compassion to my wounded self', 'duration' => '15 min',
                     'description' => 'Write 10 lines to the child or younger version of you who first experienced this wound. With kindness, not pity.'],
                    ['type' => 'pratique', 'title' => '🌬 Compassion breath — body scan', 'duration' => '8 min',
                     'description' => 'A guided body scan to sense where the wound lives in the body. Breathe into that place without trying to change it.'],
                ],
            ],

            // ── P1 MODULE 03 ──────────────────────────────────────────────
            '03-je-decris-mon-bonheur' => [
                'title_en'       => 'Describing My Happiness',
                'description_en' => 'Your inner compass. What does happiness mean for YOU — not your parents, not society, not your social feed?',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 What is happiness — really?', 'duration' => '6 min',
                     'description' => 'The difference between pleasure (fleeting), satisfaction (earned), and meaning (lasting). Why most people pursue the wrong thing.',
                     'content' => $this->card($gold, 'The 3 types', 'Not all happiness is the same',
                        '<strong>Pleasure</strong> — immediate, sensory, short-lived. The brain\'s reward circuit (dopamine spike).<br>
                        <strong>Satisfaction</strong> — earned through effort, mastery, or contribution. Lasts longer.<br>
                        <strong>Meaning</strong> — being aligned with your values and your reason for being. The most durable form.<br><br>
                        Most modern culture sells pleasure. This module helps you define what meaning looks like for you.<br><br>
                        <em style="color:'.$gold.';">Your compass is your own — borrowed happiness never fits.</em>')],
                    ['type' => 'exercice', 'title' => 'My 3 scenes of happiness', 'duration' => '15 min',
                     'description' => 'Visualise 3 moments in your life where you felt genuinely happy (not just pleased). What was present? What was absent? Who were you with?',
                     'content' => $this->ex($gold, '①', 'The 3 scenes',
                        'Close your eyes. Travel mentally to 3 moments when you felt genuinely well — not performed happiness, but the quiet real kind.<br><br>
                        For each scene, write:<br>
                        → Where were you? Who with? What were you doing?<br>
                        → What need was being met? (freedom, connection, contribution, peace, creativity...)<br>
                        → What was absent? (pressure, comparison, noise, obligation...)<br><br>
                        <em>These 3 scenes are the raw data of your happiness compass.</em>')],
                    ['type' => 'ecriture', 'title' => 'My happiness definition — 1 paragraph', 'duration' => '10 min',
                     'description' => 'Write your personal definition of happiness (1 paragraph, in your own words). It must be yours — no borrowed answers.'],
                    ['type' => 'reflexion', 'title' => '🔍 What have I been confusing with happiness?', 'duration' => '8 min',
                     'description' => 'What have you been pursuing that looks like happiness from the outside but leaves you empty once you achieve it?'],
                ],
            ],

            // ── P1 MODULE 04 ──────────────────────────────────────────────
            '04-j-ecoute-mon-souffle' => [
                'title_en'       => 'Listening to My Breath',
                'description_en' => 'Cardiac coherence. The science of conscious breathing and its direct impact on the nervous system, emotions and mental clarity.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 The science of conscious breathing', 'duration' => '7 min',
                     'description' => 'How deliberately slowing your breath activates the parasympathetic nervous system and creates measurable physiological calm.',
                     'content' => $this->card($teal, 'The science', 'Why breathing changes everything',
                        'When you <strong>slow your exhale</strong>, the vagus nerve sends a "safety" signal to the brain. The amygdala (threat detection) quiets down. The prefrontal cortex (rational thinking) comes back online.<br><br>
                        <strong>Cardiac coherence</strong> (5-5-5 rhythm: 5 sec in / 5 sec hold / 5 sec out) creates a measurable synchronisation between heart rate variability (HRV) and respiratory rate.<br><br>
                        Benefits confirmed by research (HeartMath Institute, Dr. David Servan-Schreiber):<br>
                        → Cortisol drops 23% after 1 session<br>
                        → DHEA (vitality hormone) increases<br>
                        → Emotional reactivity decreases within 5 minutes<br><br>
                        <em style="color:'.$teal.';">5 minutes of conscious breath = 5 hours of inner calm. This is not metaphor. This is physiology.</em>')],
                    ['type' => 'pratique', 'title' => '🌬 Cardiac coherence — 5-5-5 (5 min)', 'duration' => '5 min',
                     'description' => 'Your first full cardiac coherence practice. Breathe in 5 sec → hold 5 sec → breathe out 5 sec. 5 full cycles. Eyes closed.'],
                    ['type' => 'exercice', 'title' => 'Finding your anchors', 'duration' => '10 min',
                     'description' => 'Identify the 3 moments in your day where conscious breathing will have the most impact. Schedule them now.',
                     'content' => $this->ex($teal, '①', 'My 3 daily breath windows',
                        'Research shows that 3 practice sessions per day (morning, early afternoon, before bed) create the most durable nervous system regulation.<br><br>
                        Choose your 3 windows — make them specific (not "when I remember"):<br>
                        1. Morning: ________ (e.g. right after getting up, before phone)<br>
                        2. Midday: ________ (e.g. before lunch, at my desk)<br>
                        3. Evening: ________ (e.g. before sleep, after children are in bed)<br><br>
                        <em>Attach each practice to an existing anchor (a habit that already exists) — this is habit stacking (James Clear).</em>')],
                    ['type' => 'reflexion', 'title' => '🔍 When do I hold my breath?', 'duration' => '8 min',
                     'description' => 'When during your day do you notice tension, breath-holding, or shallow breathing? These are the places where practice matters most.'],
                ],
            ],

            // ── P1 MODULE 05 ──────────────────────────────────────────────
            '05-je-decouvre-ma-mission' => [
                'title_en'       => 'Discovering My Unique Mission',
                'description_en' => 'The ikigai — your reason for being. The intersection of what you love, what you are good at, what the world needs, and what you can be valued for.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 The ikigai — more than a diagram', 'duration' => '7 min',
                     'description' => 'Understanding the real meaning of ikigai beyond its viral oversimplification — and why mission is not the same as job title.',
                     'content' => $this->card($gold, 'Ikigai', 'Japanese concept of reason for being',
                        'The word <strong>ikigai</strong> (生き甲斐) literally means "that which makes life worth living".<br><br>
                        It lives at the intersection of 4 circles:<br>
                        🟡 <strong>What you love</strong> — activities that create flow and joy<br>
                        🟢 <strong>What you are good at</strong> — natural skills + developed mastery<br>
                        🔵 <strong>What the world needs</strong> — a real contribution, not just a career<br>
                        🔴 <strong>What you can be valued for</strong> — sustainable, viable<br><br>
                        <strong>Important:</strong> Your mission is not your job. It can be expressed through a job, relationship, community, or art — but it is larger than any one role.<br><br>
                        <em style="color:'.$gold.';">Your mission is not something you invent. It is something you uncover.</em>')],
                    ['type' => 'exercice', 'title' => 'My ikigai — the 4 circles', 'duration' => '20 min',
                     'description' => 'Fill in each of the 4 circles with at least 5 answers each. Look for the overlaps — they point toward your mission.',
                     'content' => $this->ex($gold, '①', 'Fill your 4 circles',
                        '<strong>Circle 1 — What I LOVE:</strong> List activities that make you lose track of time (flow state). At least 5.<br><br>
                        <strong>Circle 2 — What I am GOOD AT:</strong> Skills others recognise in you + things that come naturally. At least 5.<br><br>
                        <strong>Circle 3 — What the WORLD NEEDS:</strong> Problems you care about. People you want to help. Changes you want to see. At least 5.<br><br>
                        <strong>Circle 4 — What I can be VALUED FOR:</strong> What would someone pay for, seek your help with, or recognise you for? At least 5.<br><br>
                        <em>Now look at each overlap. What shows up in 3 or all 4 circles? That is your starting point.</em>')],
                    ['type' => 'ecriture', 'title' => 'My mission in 1 sentence', 'duration' => '10 min',
                     'description' => 'Write your current mission statement: "My mission is to [action] for [who] so that [impact]." Imperfect is fine — it is a living statement.'],
                    ['type' => 'reflexion', 'title' => 'What am I here to give?', 'duration' => '8 min',
                     'description' => 'If you knew you could not fail, and money was not an issue — what would you spend the next 10 years doing?'],
                ],
            ],

            // ── P1 MODULE 06 ──────────────────────────────────────────────
            '06-je-visualise-ma-vie' => [
                'title_en'       => 'Embodying My Vision — Clarity, Courage & Discipline',
                'description_en' => 'A vision without discipline is a dream. This module turns mental images into an embodied identity — and identity into daily action.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 Vision is not a poster — it is an identity', 'duration' => '7 min',
                     'description' => 'The neuroscience of identity-based change (James Clear). Why "who you are" always overrides "what you want".',
                     'content' => $this->card($indigo, 'Identity before action', 'James Clear — Atomic Habits',
                        'Most people set goals: <em>"I want to lose 10 kg."</em><br>
                        Effective people shift identity: <em>"I am someone who moves their body every day."</em><br><br>
                        The difference is profound. Goals point outward — results. Identity points inward — who you are becoming.<br><br>
                        <strong>Identity-based change process:</strong><br>
                        1. Decide the person you want to become<br>
                        2. Take small actions that prove it to yourself (votes)<br>
                        3. Your identity gradually shifts based on evidence<br><br>
                        Every time you do your breathing practice, you cast a vote for the identity: <em>"I am someone who takes care of myself."</em><br><br>
                        <em style="color:'.$indigo.';">Your vision is not what you want. It is who you are becoming — and every small action is proof.</em>')],
                    ['type' => 'exercice', 'title' => 'My vision in 5 dimensions', 'duration' => '20 min',
                     'description' => 'Write your clear vision for each dimension of life in 3 years: health, work/mission, relationships, finances, inner life.',
                     'content' => $this->ex($indigo, '①', 'My 3-year vision — 5 dimensions',
                        'For each area, write 3-5 sentences in the <strong>present tense</strong> as if it is already real:<br><br>
                        🟢 <strong>Health & Body:</strong> How do you feel? How do you move? What does your energy look like?<br>
                        🟡 <strong>Work & Mission:</strong> What are you doing? What impact are you creating? How do you feel about it?<br>
                        🔴 <strong>Relationships:</strong> Who is in your life? How do you communicate? What is the quality of your connections?<br>
                        🔵 <strong>Finances & Environment:</strong> Where do you live? What does freedom mean for you concretely?<br>
                        🟣 <strong>Inner Life:</strong> How do you feel inside — calm, clear, aligned? What practices sustain you?<br><br>
                        <em>Write in present tense. Use "I am", "I have", "I feel" — not "I want" or "I will".</em>')],
                    ['type' => 'ecriture', 'title' => 'My identity statement', 'duration' => '10 min',
                     'description' => 'Complete 5 times: "I am someone who..." — based on the person in your vision. Present tense. Concrete actions.'],
                    ['type' => 'pratique', 'title' => '🌬 Visualisation breath — 5 min', 'duration' => '5 min',
                     'description' => 'Cardiac coherence 5-5-5 while holding your vision. See yourself as the person you are becoming.'],
                ],
            ],

            // ── P1 MODULE 07 ──────────────────────────────────────────────
            '07-je-prends-soin-de-moi' => [
                'title_en'       => 'Caring for Myself First — the Oxygen Mask',
                'description_en' => 'You cannot pour from an empty cup. This module reframes self-care from selfishness to strategy — and creates a sustainable daily care practice.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 The oxygen mask principle', 'duration' => '6 min',
                     'description' => 'Why putting yourself last does not make you more generous — it makes you less effective and more resentful.',
                     'content' => $this->card($teal, 'The principle', 'Oxygen mask — every flight, every time',
                        '"In the event of a loss of cabin pressure, please put on your own oxygen mask before assisting others."<br><br>
                        This instruction applies to life.<br><br>
                        <strong>Burnout research (Maslach, 1981)</strong> shows that caregivers, helpers, parents and high performers do not collapse from giving too much — they collapse from <em>refilling too little</em>.<br><br>
                        Self-care is not indulgence. It is the <strong>biological prerequisite</strong> for sustainable performance, stable emotions, and genuine generosity.<br><br>
                        <em style="color:'.$teal.';">A depleted giver gives depleted energy. A nourished giver gives nourishing energy.</em>')],
                    ['type' => 'exercice', 'title' => 'My 5 care domains', 'duration' => '15 min',
                     'description' => 'Audit your energy in 5 domains: physical, mental/emotional, social, creative, spiritual. Where are you overdrawn?',
                     'content' => $this->ex($teal, '①', 'Energy audit — 5 domains',
                        'Score each domain from 1 (critically depleted) to 10 (fully nourished), then identify 1 small action per depleted domain:<br><br>
                        🟢 <strong>Physical</strong> — sleep, movement, nutrition, rest<br>
                        🔵 <strong>Mental/Emotional</strong> — space to think, feel, process<br>
                        🟡 <strong>Social</strong> — quality connections, honest conversation<br>
                        🟣 <strong>Creative</strong> — play, beauty, expression not tied to output<br>
                        🔴 <strong>Spiritual/Meaning</strong> — connection to purpose, stillness, nature<br><br>
                        <em>The lowest score is your most urgent priority. Start there.</em>')],
                    ['type' => 'exercice', 'title' => 'My 3 non-negotiable weekly self-care appointments', 'duration' => '10 min',
                     'description' => 'Schedule 3 recurring appointments with yourself in your calendar. Non-negotiable, like a meeting with your most important client.'],
                    ['type' => 'reflexion', 'title' => 'What guilt do I carry around self-care?', 'duration' => '8 min',
                     'description' => 'What beliefs or messages (from family, culture, religion) have told you that taking care of yourself is selfish? Where did they come from?'],
                ],
            ],

            // ── P1 MODULE 08 ──────────────────────────────────────────────
            '08-gratitude-et-intention' => [
                'title_en'       => 'Gratitude & Intention — evening review, morning momentum',
                'description_en' => 'The 3-3-1 protocol: 3 gratitudes + 3 acknowledgements + 1 intention. How daily gratitude practice reshapes the brain\'s default negative bias.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 The neuroscience of gratitude', 'duration' => '6 min',
                     'description' => 'Emmons & McCullough (2003): daily gratitude practice increases wellbeing, reduces depression, improves sleep quality.',
                     'content' => $this->card($gold, 'The science', 'Emmons & McCullough, 2003 — Journal of Personality & Social Psychology',
                        'Study participants who wrote 3 gratitudes per week for 10 weeks reported:<br>
                        → 25% higher subjective wellbeing<br>
                        → Better sleep quality<br>
                        → Fewer physical symptoms<br>
                        → Greater optimism about the coming week<br><br>
                        <strong>Why it works:</strong> The brain has a negativity bias (negativity bias, Baumeister 2001) — threats register 5× more strongly than positive events. Gratitude practice is a <em>deliberate counterweight</em>: you train attention to notice what is working, not only what is broken.<br><br>
                        <em style="color:'.$gold.';">After 21 days of daily practice, the brain\'s default scanning mode begins to change. What you look for, you find more of.</em>')],
                    ['type' => 'exercice', 'title' => 'The 3-3-1 Protocol', 'duration' => '10 min',
                     'description' => 'Learn and practice the 3-3-1 evening protocol. 3 gratitudes + 3 self-acknowledgements + 1 intention for tomorrow.',
                     'content' => $this->ex($gold, '①', 'The 3-3-1 protocol — evening',
                        '<strong>Every evening before bed, in a physical notebook:</strong><br><br>
                        <strong>3 things I am grateful for today</strong> — be specific. Not "my health" but "the 10-min walk I took that cleared my head".<br><br>
                        <strong>3 things I acknowledge in myself today</strong> — not achievements: qualities. "I was patient when it was hard." "I asked for help instead of pretending."<br><br>
                        <strong>1 intention for tomorrow</strong> — one sentence. How do you want to show up? What quality do you want to embody?<br><br>
                        <em>Physical notebook — not phone. The act of writing by hand activates deeper encoding in the brain.</em>')],
                    ['type' => 'pratique', 'title' => '🌬 Gratitude breath — 5 min', 'duration' => '5 min',
                     'description' => 'Cardiac coherence 5-5-5 while holding in mind something you are genuinely grateful for. HRV coherence amplifies positive affect.'],
                    ['type' => 'reflexion', 'title' => 'What am I taking for granted?', 'duration' => '8 min',
                     'description' => 'List 10 things you have in your life right now that you would miss terribly if they were gone. Notice the gap between having and noticing.'],
                ],
            ],

            // ── P2 MODULE 09 ──────────────────────────────────────────────
            '09-mes-priorites-dabord' => [
                'title_en'       => 'My Priorities First',
                'description_en' => 'Pareto 80/20 + Buffett 2-list + Eisenhower matrix. Do less, better, with full clarity. Reclaim your time and your life.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 The tyranny of the urgent', 'duration' => '6 min',
                     'description' => 'Why busy people often make no real progress — and the 3 tools that cut through the noise.',
                     'content' => $this->card($gold, 'The problem', 'Activity vs. results',
                        'Most people are extremely <em>busy</em> and make very little <em>progress</em>.<br><br>
                        This is because urgency and importance are not the same thing — and most people confuse them.<br><br>
                        <strong>Pareto principle (80/20):</strong> 20% of your activities produce 80% of your results. Identify and protect that 20%.<br><br>
                        <strong>Buffett\'s 2-list method:</strong> Write your top 25 goals. Circle your top 5. The other 20 are your "avoid at all costs" list — not because they are bad, but because they dilute your focus from what matters most.<br><br>
                        <strong>Eisenhower matrix:</strong><br>
                        Q1 (urgent + important) = do now<br>
                        Q2 (not urgent + important) = schedule — this is where growth lives<br>
                        Q3 (urgent + not important) = delegate<br>
                        Q4 (not urgent + not important) = eliminate<br><br>
                        <em style="color:'.$gold.';">Real priorities are protected from everything else. Not managed alongside everything else.</em>')],
                    ['type' => 'exercice', 'title' => 'My Buffett 2-list — this month', 'duration' => '15 min',
                     'description' => 'Write 25 things you want to do or achieve this month. Circle the 5 highest-leverage ones. The other 20 go on your "avoid" list.'],
                    ['type' => 'exercice', 'title' => 'My Eisenhower matrix — this week', 'duration' => '15 min',
                     'description' => 'Place every current task or project into the 4 quadrants. What can you delegate? Eliminate? What needs a scheduled time block?'],
                    ['type' => 'ecriture', 'title' => 'My 90-day north star', 'duration' => '10 min',
                     'description' => 'What is the ONE outcome that, if achieved in the next 90 days, would make everything else easier or less necessary?'],
                ],
            ],

            // ── P2 MODULE 10 ──────────────────────────────────────────────
            '10-interieur-propre-et-range' => [
                'title_en'       => 'A Clean & Ordered Space — the discipline that begins at home',
                'description_en' => 'McRaven\'s first rule, the broken windows theory, Marie Kondo. Your physical space is a direct reflection of — and influence on — your mental state.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 Why your space shapes your mind', 'duration' => '6 min',
                     'description' => 'Princeton IRM research, the broken windows theory, and McRaven\'s challenge: why the first act of discipline is making your bed.',
                     'content' => $this->card($gold, 'The science', 'Disorder costs cognitive resources',
                        '<strong>Princeton Neuroscience Institute (2011):</strong> Cluttered visual environments constantly activate the brain\'s attentional system, reducing capacity for focused work.<br><br>
                        <strong>Broken Windows Theory (Kelling & Wilson, 1982):</strong> Small signs of disorder signal that standards are low — this gives unconscious permission for further disorder (in your environment and in yourself).<br><br>
                        <strong>McRaven — "Make Your Bed" (2014):</strong> The first act of discipline every morning sets the tone. It signals to the brain: <em>"I am someone who completes what I start."</em><br><br>
                        <em style="color:'.$gold.';">A clean space is not a luxury — it is a cognitive tool. A signal to the nervous system that you are in control.</em>')],
                    ['type' => 'exercice', 'title' => 'The 10-minute daily sweep', 'duration' => '10 min',
                     'description' => 'The cornerstone practice: 10 minutes of active tidying every day. Not a big clean — just returning everything to its place.',
                     'content' => $this->ex($gold, '①', '10-min daily sweep — the rules',
                        '1. Set a timer for 10 minutes.<br>
                        2. Move through your space with one rule: <strong>everything goes back to its place</strong>. No exceptions.<br>
                        3. Do not start organising — that comes separately. This session is only about returning things to where they belong.<br>
                        4. Do this every day at the same time (e.g. before starting work, after dinner).<br><br>
                        This practice compounds: after 21 days, your space maintains itself with very little effort — because you never let entropy accumulate.')],
                    ['type' => 'exercice', 'title' => 'My trigger zone', 'duration' => '20 min',
                     'description' => 'Identify the one area of your home or workspace that generates the most visual stress. Spend 20 focused minutes on only that area today.'],
                    ['type' => 'reflexion', 'title' => 'What does my space say about my inner state?', 'duration' => '8 min',
                     'description' => 'Walk through your home as if you were visiting someone else. What does the state of each room tell you about the person who lives there?'],
                ],
            ],

            // ── P2 MODULE 11 (mouvement) ──────────────────────────────────
            '07-mouvement-et-posture' => [
                'title_en'       => 'Moving with Awareness',
                'description_en' => 'Posture is neurological, not aesthetic. The 3 axes of movement, the sitting epidemic, and how 5 minutes of conscious movement rewires your nervous system.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 Movement is medicine — not sport', 'duration' => '6 min',
                     'description' => 'Why stillness is not rest for the body — and how conscious movement speaks directly to the nervous system.',
                     'content' => $this->card($teal, 'The 3 axes', 'How the body organises in space',
                        '<strong>① Vertical axis (flexion/extension)</strong> — bending forward, straightening up. Core muscles: spinal erectors, psoas, deep abdominals.<br>
                        <strong>② Horizontal axis (rotation)</strong> — twisting the torso, head, pelvis. Core muscles: multifidus, lumbar rotators.<br>
                        <strong>③ Lateral axis (side-bending)</strong> — leaning sideways, hip opening. Core muscles: quadratus lumborum, scalenes.<br><br>
                        A body that does not use all 3 axes during the day accumulates one-sided tension.<br><br>
                        <em style="color:'.$teal.';">5 minutes of conscious movement across all 3 axes activates the nervous system more effectively than 30 passive minutes of sitting.</em>')],
                    ['type' => 'pratique', 'title' => 'Morning mobility — 5-10 min', 'duration' => '10 min',
                     'description' => '5 minutes of gentle mobility across the 3 axes: forward folds, spinal rotations, side stretches. No performance — only activation.'],
                    ['type' => 'exercice', 'title' => 'Posture audit — 5 checkpoints', 'duration' => '10 min',
                     'description' => 'Learn the 5 reference points of standing posture (feet, knees, pelvis, shoulders, head). Video yourself or use a mirror to check each one.',
                     'content' => $this->ex($teal, '①', '5 posture checkpoints',
                        '1. <strong>Feet</strong> — parallel, hip-width apart, weight on 3 points (heel, 1st and 5th metatarsal)<br>
                        2. <strong>Knees</strong> — soft unlock, never hyperextended<br>
                        3. <strong>Pelvis</strong> — neutral (not tilted forward or tucked under)<br>
                        4. <strong>Shoulders</strong> — released, slightly back, not raised toward ears<br>
                        5. <strong>Head</strong> — as if suspended from the crown, chin gently in<br><br>
                        Hold this alignment and breathe. Notice where tension immediately returns.')],
                    ['type' => 'reflexion', 'title' => 'How does my body carry my stress?', 'duration' => '8 min',
                     'description' => 'Where in your body do you feel held tension right now? Jaw? Shoulders? Lower back? These are your stress signatures.'],
                ],
            ],

            // ── P2 MODULE 12 (système nerveux) ────────────────────────────
            '08-systeme-nerveux' => [
                'title_en'       => 'Understanding My Nervous System',
                'description_en' => 'The window of tolerance, vagus nerve, SNS/PNS balance. Understanding your nervous system is the prerequisite for regulating it.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 Fight, flight, freeze — and rest', 'duration' => '8 min',
                     'description' => 'The autonomic nervous system: SNS (mobilise), PNS (restore). The window of tolerance (Siegel). How trauma narrows the window.',
                     'content' => $this->card($blue, 'The nervous system', 'Your biology of safety and threat',
                        '<strong>Sympathetic (SNS) — mobilise:</strong> threat detected → adrenaline + cortisol → heart rate up, digestion paused, muscles tensed. Essential for genuine emergencies.<br><br>
                        <strong>Parasympathetic (PNS) — restore:</strong> safety signal → vagus nerve activated → heart rate down, digestion resumes, immune system functions.<br><br>
                        <strong>Window of tolerance (Siegel, 1999):</strong> the zone between hyper-arousal (SNS overdrive — anxiety, rage, overwhelm) and hypo-arousal (PNS shutdown — numbness, dissociation, depression).<br><br>
                        <strong>Widening the window:</strong> every time you consciously regulate through breath, movement, or connection, you expand your capacity to handle stress without collapsing or exploding.<br><br>
                        <em style="color:'.$blue.';">Understanding your nervous system is step 1. You cannot regulate what you cannot name.</em>')],
                    ['type' => 'exercice', 'title' => 'My SNS/PNS triggers', 'duration' => '15 min',
                     'description' => 'Create your personal map: what activates your sympathetic response? What activates your parasympathetic? Your early warning signs for each.',
                     'content' => $this->ex($blue, '①', 'My personal nervous system map',
                        '<strong>My SNS activators (what triggers my stress response):</strong><br>
                        Physical: _______ / Emotional: _______ / Environmental: _______<br><br>
                        <strong>My SNS early signals (before I lose control):</strong><br>
                        Body: _______ / Mind: _______ / Behaviour: _______<br><br>
                        <strong>My PNS activators (what brings me back to calm):</strong><br>
                        Physical: _______ / Sensory: _______ / Social: _______<br><br>
                        <em>This map is your personal regulation toolkit. The earlier you catch the SNS signal, the easier the return to the window.</em>')],
                    ['type' => 'pratique', 'title' => '🌬 Vagal breath — extended exhale (5 min)', 'duration' => '5 min',
                     'description' => 'Extended exhale (4 in / 8 out): the fastest way to activate the vagus nerve and shift from SNS to PNS.'],
                    ['type' => 'reflexion', 'title' => 'My default mode under stress', 'duration' => '8 min',
                     'description' => 'Do you tend toward fight (conflict, control), flight (escape, avoidance), freeze (shutdown, numbness), or fawn (appeasement)? Where did this pattern originate?'],
                ],
            ],

            // ── P2 MODULE 13 (émotions) ───────────────────────────────────
            '09-gestion-des-emotions' => [
                'title_en'       => 'Regulating My Emotions',
                'description_en' => 'STOP, TIPP, co-regulation. Emotions are information — not commands. Learn to respond instead of react.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 Emotions are data, not commands', 'duration' => '6 min',
                     'description' => 'The difference between feeling an emotion and being controlled by it. The 90-second rule (Jill Bolte Taylor).',
                     'content' => $this->card($amber, 'The 90-second rule', 'Jill Bolte Taylor — neuroscientist',
                        'The physiological component of any emotion lasts approximately <strong>90 seconds</strong> in the body.<br><br>
                        After 90 seconds, if you are still feeling the emotion, it is because you are <em>actively re-stimulating it</em> with your thoughts.<br><br>
                        <strong>What this means:</strong> you have 90 seconds to surf the wave — and then a choice. React from the emotion, or respond from your values.<br><br>
                        <strong>The STOP technique:</strong><br>
                        <strong>S</strong>top — pause physically<br>
                        <strong>T</strong>ake a breath — 1-3 conscious breaths<br>
                        <strong>O</strong>bserve — what am I feeling? Where in my body?<br>
                        <strong>P</strong>roceed — respond from choice, not reaction<br><br>
                        <em style="color:'.$amber.';">Emotions are messengers. The message matters. The explosion does not.</em>')],
                    ['type' => 'exercice', 'title' => 'The TIPP technique — emergency regulation', 'duration' => '10 min',
                     'description' => 'Temperature + Intense exercise + Paced breathing + Paired muscle relaxation. Used in DBT for acute emotional overwhelm.',
                     'content' => $this->ex($amber, '①', 'TIPP — when you are over the edge',
                        'When emotional intensity exceeds your window of tolerance, logic does not work. Use body physiology instead:<br><br>
                        <strong>T — Temperature:</strong> Ice on wrists/face or cold water. Activates the dive reflex (instant PNS activation).<br>
                        <strong>I — Intense exercise:</strong> 2 minutes of vigorous movement (jumping jacks, running in place) burns off the adrenaline.<br>
                        <strong>P — Paced breathing:</strong> Exhale longer than inhale (4 in / 8 out) for 5 cycles.<br>
                        <strong>P — Paired muscle relaxation:</strong> Tense muscle group for 7 sec, release for 30 sec. Work up the body.<br><br>
                        <em>TIPP is a first-aid technique. It reduces intensity enough to make the STOP technique possible.</em>')],
                    ['type' => 'ecriture', 'title' => 'My emotional vocabulary', 'duration' => '15 min',
                     'description' => 'Most people use 3-5 emotion words (good, bad, stressed, fine). Expanding your vocabulary expands your emotional intelligence. Write 20 emotion words and when you feel each one.'],
                    ['type' => 'reflexion', 'title' => 'Which emotion do I suppress most?', 'duration' => '8 min',
                     'description' => 'Which emotion do you find hardest to feel, show, or acknowledge? What do you do instead? What would change if you could let it move through you?'],
                ],
            ],

            // ── P2 MODULE 14 (présence) ───────────────────────────────────
            '10-vivre-ici-et-maintenant' => [
                'title_en'       => 'Living Here and Now',
                'description_en' => 'MBSR (Mindfulness-Based Stress Reduction), the 5-4-3-2-1 grounding technique, and the science of present-moment awareness.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 The wandering mind is an unhappy mind', 'duration' => '6 min',
                     'description' => 'Harvard study (Killingsworth & Gilbert, 2010): mind-wandering and unhappiness. What presence actually feels like — and how to train it.',
                     'content' => $this->card($teal, 'The research', 'Killingsworth & Gilbert, 2010 — Science',
                        'A large-scale Harvard study found that <strong>people spend 46.9% of their waking hours</strong> thinking about something other than what they are doing.<br><br>
                        And: <em>"A wandering mind is an unhappy mind."</em> Regardless of what people were doing, they were significantly less happy when their mind was wandering.<br><br>
                        <strong>Presence is a trainable skill.</strong> MBSR (Jon Kabat-Zinn) has been validated across thousands of clinical trials:<br>
                        → Reduces anxiety (58% decrease in 8 weeks)<br>
                        → Reduces chronic pain perception<br>
                        → Strengthens immune response<br>
                        → Improves emotional regulation<br><br>
                        <em style="color:'.$teal.';">You cannot change the past or control the future. But you can fully inhabit this moment — and that changes everything.</em>')],
                    ['type' => 'pratique', 'title' => '🌬 5-4-3-2-1 grounding technique', 'duration' => '5 min',
                     'description' => 'Name 5 things you see / 4 you hear / 3 you can touch / 2 you smell / 1 you taste. Anchor yourself to the present sensory moment.',
                     'content' => $this->ex($teal, '①', '5-4-3-2-1 — sensory anchor',
                        'Useful when the mind is racing, anxious, or scattered:<br><br>
                        👁 <strong>5 things I see</strong> right now (notice specific details — colours, textures, light)<br>
                        👂 <strong>4 things I hear</strong> (near sounds, far sounds, ambient sounds)<br>
                        ✋ <strong>3 things I can touch</strong> (texture, temperature, pressure)<br>
                        👃 <strong>2 things I smell</strong> (or can imagine smelling)<br>
                        👅 <strong>1 thing I taste</strong> (or notice in my mouth)<br><br>
                        <em>This exercise takes 2-3 minutes and immediately shifts attention from internal rumination to external reality.</em>')],
                    ['type' => 'exercice', 'title' => 'Mindful activity — 10 min of full presence', 'duration' => '10 min',
                     'description' => 'Choose any ordinary activity (washing dishes, making tea, walking) and do it with 100% attention: every sensation, every movement, every sound.'],
                    ['type' => 'ecriture', 'title' => 'What am I missing by not being present?', 'duration' => '8 min',
                     'description' => 'Reflect on the moments you are most mentally absent. What are you missing? What is the cost?'],
                ],
            ],

            // ── P2 MODULE 15 (sommeil) ────────────────────────────────────
            '10-sommeil-et-recuperation' => [
                'title_en'       => 'Sleep & Recovery',
                'description_en' => 'Chronotypes, sleep architecture, sleep hygiene. Sleep is not a passive state — it is an active restoration process. Everything depends on it.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 Sleep is not rest — it is repair', 'duration' => '7 min',
                     'description' => 'Sleep architecture (cycles of 90 min), REM vs deep sleep, glymphatic system. What actually happens while you sleep.',
                     'content' => $this->card($indigo, 'Sleep science', 'Matthew Walker — "Why We Sleep"',
                        '<strong>Sleep architecture:</strong> Each 90-min cycle contains light sleep → deep sleep (SWS) → REM. Deep sleep is for physical repair; REM is for emotional processing and memory consolidation.<br><br>
                        <strong>The glymphatic system:</strong> During deep sleep, the brain literally flushes out metabolic waste products (including beta-amyloid, linked to Alzheimer\'s). This process only works during sleep.<br><br>
                        <strong>After one night under 7 hours:</strong><br>
                        → Cortisol 15-20% higher<br>
                        → Emotional reactivity increases (amygdala 60% more reactive)<br>
                        → Cognitive performance equal to legal intoxication<br>
                        → Immune function significantly impaired<br><br>
                        <em style="color:'.$indigo.';">Sleep is the most powerful human performance-enhancing tool available. And it is free.</em>')],
                    ['type' => 'exercice', 'title' => 'My sleep hygiene audit', 'duration' => '15 min',
                     'description' => 'Audit your current sleep habits across 10 factors. Identify your 3 biggest disruptors and create a specific plan to address them.',
                     'content' => $this->ex($indigo, '①', '10 sleep hygiene factors — audit',
                        'Score each factor (0 = never / 1 = sometimes / 2 = consistently):<br><br>
                        □ Same bedtime every night (±30 min)<br>
                        □ No screens 30 min before bed<br>
                        □ Room temperature 16-19°C<br>
                        □ Room completely dark (blackout)<br>
                        □ No caffeine after 2pm<br>
                        □ No alcohol (disrupts REM cycles)<br>
                        □ Wind-down routine (not work until sleep)<br>
                        □ 7-9 hours in bed consistently<br>
                        □ No vigorous exercise within 2h of bed<br>
                        □ Morning light exposure within 1h of waking<br><br>
                        <em>Your 3 lowest scores are your immediate targets.</em>')],
                    ['type' => 'pratique', 'title' => '🌬 4-7-8 sleep breath', 'duration' => '5 min',
                     'description' => 'Inhale 4 sec → hold 7 sec → exhale 8 sec. 4 cycles. This breathing pattern activates the parasympathetic nervous system and facilitates sleep onset.'],
                    ['type' => 'ecriture', 'title' => 'My ideal evening routine', 'duration' => '10 min',
                     'description' => 'Design your personal wind-down routine for the 45 minutes before bed. Write it as a sequence of specific actions.'],
                ],
            ],

            // ── P2 MODULE 16 (alimentation) ───────────────────────────────
            '11-relation-alimentation' => [
                'title_en'       => 'Eating with Awareness',
                'description_en' => 'Mindful Eating, hunger/satiety signals, eating without screens. Transform your relationship with food from habit to consciousness.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 The difference between hungry and eating', 'duration' => '6 min',
                     'description' => 'Physical hunger vs emotional hunger. Satiety signals and why most people override them without knowing it.',
                     'content' => $this->card($green, 'Hunger signals', 'Physical vs emotional',
                        '<strong>Physical hunger</strong> — builds gradually, can wait 20-30 min, almost any food satisfies, stops when full.<br>
                        <strong>Emotional hunger</strong> — sudden, urgent, targets specific foods (comfort foods), does not stop when physically full, followed by guilt.<br><br>
                        <strong>Why we override fullness signals:</strong><br>
                        → Eating while distracted (screens, conversation, driving) delays gastric signals by 15-20 minutes<br>
                        → Speed of eating: brain needs 15-20 min to receive "I am full" signals<br>
                        → Ultra-processed foods are engineered to override satiety<br><br>
                        <em style="color:'.$green.';">Mindful Eating is not a diet. It is restoring your ability to listen to your body.</em>')],
                    ['type' => 'pratique', 'title' => 'The raisin exercise — full presence in 1 bite', 'duration' => '10 min',
                     'description' => 'Take one small piece of food. Spend 5 minutes exploring it with all senses before eating it. The classic MBSR mindful eating exercise.',
                     'content' => $this->ex($green, '①', 'Mindful bite — instructions',
                        '1. Place one small piece of food in your hand. Look at it for 30 seconds.<br>
                        2. Notice its colour, texture, shape. What is unusual about it?<br>
                        3. Bring it to your nose. What does it smell like?<br>
                        4. Place it on your tongue — do not chew yet. Notice the sensation, the taste beginning to unfold.<br>
                        5. Now slowly chew. Notice each change in texture, flavour, sensation.<br>
                        6. Swallow consciously. Feel it move.<br><br>
                        <em>Most people eat an entire meal in the time this exercise takes for one bite. That is how absent we have become from eating.</em>')],
                    ['type' => 'exercice', 'title' => 'Screen-free meals — 5 days', 'duration' => '5 min',
                     'description' => 'Commit to 5 consecutive days of eating at least 1 meal per day with no screens, no reading, no distractions. Just food. Notice everything.'],
                    ['type' => 'reflexion', 'title' => 'My emotional eating triggers', 'duration' => '10 min',
                     'description' => 'When do you eat without physical hunger? What emotions or situations trigger it? What need is the food trying to meet?'],
                ],
            ],

            // ── P2 MODULE 17 (activité physique) ─────────────────────────
            '15-activite-physique' => [
                'title_en'       => 'Moving — Physical Activity & Well-being',
                'description_en' => 'The irrefutable evidence base for regular physical activity and its impact on mood, cognition, hormonal balance, and longevity.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 Movement is the most powerful antidepressant', 'duration' => '6 min',
                     'description' => 'Meta-analysis: exercise as effective as medication for mild/moderate depression. The neuroscience of BDNF, endorphins, and mood.',
                     'content' => $this->card($green, 'The evidence', '150 years of research condensed',
                        'A 2023 meta-analysis in the British Journal of Sports Medicine (97 reviews, 1,039 trials) confirmed that exercise <strong>reduces depression symptoms 1.5× more effectively than medication or therapy alone</strong>.<br><br>
                        <strong>Why it works:</strong><br>
                        → BDNF (brain-derived neurotrophic factor): exercise promotes neuroplasticity — the brain\'s ability to form new connections<br>
                        → Endorphins + endocannabinoids: natural mood elevators released after 20+ min of moderate exercise<br>
                        → Cortisol clearance: stress hormones are metabolised through movement (not through thinking)<br>
                        → Serotonin + dopamine: regulated through regular aerobic activity<br><br>
                        <em style="color:'.$green.';">You are not just moving your body. You are medicating your brain — without side effects.</em>')],
                    ['type' => 'exercice', 'title' => 'My movement baseline', 'duration' => '10 min',
                     'description' => 'Audit your current weekly movement. Design a realistic, sustainable movement plan starting from where you actually are — not where you think you should be.',
                     'content' => $this->ex($green, '①', 'My movement plan — 4 weeks',
                        '<strong>Current baseline:</strong> How many minutes of intentional movement per week? Be honest.<br><br>
                        <strong>Week 1 target:</strong> Baseline + 20 min/week (e.g. 2 x 10 min walks added)<br>
                        <strong>Week 2 target:</strong> + another 20 min<br>
                        <strong>Week 3-4:</strong> Build toward 150 min/week moderate activity (WHO recommendation)<br><br>
                        <strong>Format matters less than frequency:</strong> Walking, cycling, dance, yoga, swimming, climbing — all count. The best exercise is the one you will actually do consistently.')],
                    ['type' => 'pratique', 'title' => '🌬 Movement + breath — 10 min walk with presence', 'duration' => '10 min',
                     'description' => 'Take a 10-minute conscious walk: breathe with the rhythm of your steps, notice 5 things around you, keep the phone in your pocket.'],
                    ['type' => 'reflexion', 'title' => 'What does my body enjoy?', 'duration' => '8 min',
                     'description' => 'Which forms of movement have you genuinely enjoyed in your life — not felt obligated to do, but actually looked forward to? Go back to those.'],
                ],
            ],

            // ── P2 MODULE 18 (nutrition) ──────────────────────────────────
            '22-nutrition-et-vitalite' => [
                'title_en'       => 'Nutrition & Vitality',
                'description_en' => 'Macronutrients, key micronutrients, chronic inflammation and the gut-brain axis. Nourish the body intelligently — without rules, with awareness.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 Food as information', 'duration' => '6 min',
                     'description' => 'How food communicates with your genes, gut microbiome, and brain — beyond calories and macros.',
                     'content' => $this->card($green, 'Beyond nutrition', 'Food as signalling system',
                        'Every meal you eat sends thousands of molecular signals to your cells, your gut bacteria, and your brain.<br><br>
                        <strong>Macronutrients:</strong><br>
                        Proteins (0.8-1.6g/kg): building blocks for muscle, neurotransmitters, hormones.<br>
                        Complex carbohydrates: fuel for brain and muscles. Avoid glycemic spikes.<br>
                        Quality fats: omega-3 (EPA/DHA) are essential for brain health, anti-inflammatory.<br><br>
                        <strong>Chronic inflammation</strong> (the silent driver of most modern disease) is strongly influenced by diet:<br>
                        → Pro-inflammatory: refined sugar, seed oils, ultra-processed food, trans fats<br>
                        → Anti-inflammatory: colourful vegetables, oily fish, berries, olive oil, fermented foods<br><br>
                        <em style="color:'.$green.';">You are not what you eat. You are what you absorb — which depends on your nervous system state at the time of eating.</em>')],
                    ['type' => 'pratique', 'title' => 'The Pause Souffle plate model', 'duration' => '5 min',
                     'description' => 'The visual 4-zone plate: ½ vegetables, ¼ quality protein, ¼ complex carbs, + a drizzle of good fat. No weighing, no counting.',
                     'content' => $this->ex($green, '①', 'Build your plate — 4 zones',
                        '🟢 <strong>½ plate — vegetables</strong> (cooked or raw, varied, colourful)<br>
                        🔴 <strong>¼ plate — protein</strong> (fish, eggs, legumes, poultry, meat)<br>
                        🔵 <strong>¼ plate — quality carbs</strong> (wholegrains, legumes, root vegetables)<br>
                        🟡 <strong>Drizzle — good fat</strong> (olive oil, avocado, handful of nuts)<br><br>
                        No counting. No weighing. Just the visual reference of proportions.')],
                    ['type' => 'exercice', 'title' => 'My 7-day anti-inflammatory addition', 'duration' => '10 min',
                     'description' => 'Add — do not remove. Each day for 7 days, add one anti-inflammatory element to your diet. List your 7 daily additions now.',
                     'content' => $this->ex($green, '②', '7 additions — one per day',
                        'Monday: handful of walnuts / Tuesday: portion of broccoli or kale / Wednesday: 1 tsp turmeric in a dish / Thursday: green tea without sugar / Friday: extra handful of berries / Saturday: portion of oily fish (sardines, mackerel) / Sunday: 1 tbsp olive oil on food (not for high-heat cooking)<br><br>
                        <em>Adding without removing is the only sustainable nutritional change for most people. Stop trying to eliminate everything at once.</em>')],
                    ['type' => 'reflexion', 'title' => 'My relationship with food', 'duration' => '10 min',
                     'description' => 'What inherited rules around food do you carry (parents, culture, past diets)? Which ones serve you? Which ones no longer belong to you?'],
                ],
            ],

            // ── P2 MODULE 19 (médecines) ──────────────────────────────────
            '19-medecines-complementaires' => [
                'title_en'       => 'Choosing with Discernment — complementary medicines & health',
                'description_en' => 'How to navigate the vast landscape of complementary health practices with clarity and critical thinking — without dismissal or naivety.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 A framework for complementary health', 'duration' => '6 min',
                     'description' => 'The 3-tier evidence framework: well-validated, promising but limited, not yet proven. How to choose without being manipulated.',
                     'content' => $this->card($teal, 'A discernment framework', '3 levels of evidence',
                        '<strong>Well-validated (strong evidence):</strong> Acupuncture (chronic pain, nausea), osteopathy (musculoskeletal), meditation/MBSR (anxiety, chronic pain), therapeutic massage (tension, circulation).<br><br>
                        <strong>Promising but limited evidence:</strong> Herbal medicine (some), aromatherapy (stress support), naturopathy (varying quality).<br><br>
                        <strong>Limited/no evidence, use with caution:</strong> Most miracle supplements, anti-vaccine protocols, energy practices with unverified claims.<br><br>
                        <strong>3 questions before trying any practice:</strong><br>
                        1. What is the quality of evidence (peer-reviewed, anecdote, or sales pitch)?<br>
                        2. What is the risk (financial, physical, opportunity cost of replacing proven treatment)?<br>
                        3. Does this practitioner encourage or discourage me from seeing my doctor?<br><br>
                        <em style="color:'.$teal.';">Complementary means alongside conventional medicine — not instead of it.</em>')],
                    ['type' => 'exercice', 'title' => 'My health ecosystem audit', 'duration' => '15 min',
                     'description' => 'Map every health practice you currently use (conventional + complementary). Evaluate each on evidence, cost, and benefit. Keep what works. Let go of the rest.'],
                    ['type' => 'reflexion', 'title' => 'My health beliefs', 'duration' => '10 min',
                     'description' => 'Where do your health beliefs come from? Which ones are based on evidence, and which on family tradition, fear, or marketing?'],
                ],
            ],

            // ── P3 MODULE 20 (présence à soi) ─────────────────────────────
            '12-presence-a-soi' => [
                'title_en'       => 'Present to Myself',
                'description_en' => 'Full presence to self as the starting point for all authentic connection. You cannot truly meet another person if you have not first met yourself.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 Presence is the foundation', 'duration' => '6 min',
                     'description' => 'What it means to be truly present to yourself — beyond mindfulness as a buzzword — and how it transforms every relationship you have.',
                     'content' => $this->card($teal, 'Presence', 'The rarest quality in modern life',
                        'Being present to yourself means: knowing what you feel, what you need, what is true for you — in real time, not retrospectively.<br><br>
                        Most people run from themselves: work, scrolling, busyness, noise. The discomfort of inner silence has become so unfamiliar that stillness feels like threat.<br><br>
                        <strong>Paradox:</strong> the more deeply you can be with yourself, the more deeply you can be with others. Presence is not selfish — it is the most generous thing you can offer.<br><br>
                        <em style="color:'.$teal.';">You cannot give what you do not have. Presence given to others begins with presence given to yourself.</em>')],
                    ['type' => 'pratique', 'title' => '🌬 20-min silent presence practice', 'duration' => '20 min',
                     'description' => 'No phone. No music. No podcast. 20 minutes of being with yourself: breathe, observe, let thoughts pass without following them. Just be present to what is here.'],
                    ['type' => 'ecriture', 'title' => 'What am I present to right now?', 'duration' => '10 min',
                     'description' => 'Write for 10 minutes about what is alive in you right now: feelings, sensations, thoughts. Without filtering or correcting.'],
                    ['type' => 'reflexion', 'title' => 'When do I disappear from myself?', 'duration' => '8 min',
                     'description' => 'In which situations, relationships, or environments do you lose touch with yourself — your feelings, your needs, your truth?'],
                ],
            ],

            // ── P3 MODULE 21 (confiance) ──────────────────────────────────
            '13-confiance-corporelle' => [
                'title_en'       => 'Self-Acceptance — Confidence & Self-Image',
                'description_en' => 'The inner gaze before the outer one. Building genuine self-confidence from the inside out — not performance, not image, not approval.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 Confidence is not arrogance — it is relationship with self', 'duration' => '6 min',
                     'description' => 'The difference between self-esteem (global self-evaluation) and self-efficacy (belief in specific capacity). How both are built.',
                     'content' => $this->card($indigo, 'Two types', 'Self-esteem vs Self-efficacy',
                        '<strong>Self-esteem (Rosenberg, 1965):</strong> your general sense of worth as a person. Built through: being loved unconditionally, accomplishing things, belonging to a group you respect.<br><br>
                        <strong>Self-efficacy (Bandura, 1977):</strong> your belief in your ability to handle specific situations. Built through: mastery experiences (small wins), vicarious learning (modelling), verbal encouragement, physical state management.<br><br>
                        <strong>Important distinction:</strong> Self-confidence is not telling yourself you are great. It is having enough evidence from your own life that you can handle challenges.<br><br>
                        <em style="color:'.$indigo.';">The most powerful self-confidence builder: do the thing you are afraid of, small version, repeatedly.</em>')],
                    ['type' => 'exercice', 'title' => 'My evidence bank', 'duration' => '15 min',
                     'description' => 'List 20 things you have overcome, achieved, survived, or learned in your life. These are evidence of your capability — not luck.',
                     'content' => $this->ex($indigo, '①', '20 pieces of evidence',
                        'Make a list of 20 experiences from your life where you showed strength, resilience, creativity, or courage — big and small.<br><br>
                        <em>Examples: learned to drive, survived a difficult period, raised a child, changed career, set a boundary, asked for help, admitted you were wrong, started something from scratch...</em><br><br>
                        This list is your <strong>evidence bank</strong>. When self-doubt arises, draw from it.')],
                    ['type' => 'pratique', 'title' => '🌬 Compassion breath — self-acceptance', 'duration' => '5 min',
                     'description' => 'Cardiac coherence 5-5-5 while placing a hand on your heart. Say internally: "I am enough as I am. I am doing the best I can. I am worthy of care."'],
                    ['type' => 'reflexion', 'title' => 'From whose gaze do I want to be free?', 'duration' => '10 min',
                     'description' => 'Whose approval are you still seeking? Whose disapproval do you most fear? What would you do differently if that gaze disappeared?'],
                ],
            ],

            // ── P3 MODULE 22 (interactions sociales) ─────────────────────
            '14-interactions-sociales' => [
                'title_en'       => 'Creating Connection',
                'description_en' => 'Conscious social interactions. How to connect authentically without losing yourself — the balance between openness and boundary.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 Connection vs approval', 'duration' => '6 min',
                     'description' => 'The difference between seeking connection (authentic) and seeking approval (anxious). Why the second makes genuine connection impossible.',
                     'content' => $this->card($coral, 'Connection', 'Brené Brown — The Gifts of Imperfection',
                        'Brené Brown defines connection as: <em>"the energy that exists between people when they feel seen, heard, and valued."</em><br><br>
                        This energy cannot exist when we are performing, hiding, or managing others\' perceptions of us.<br><br>
                        <strong>Approval-seeking</strong> creates transactions: I will show you this version of me → please like me.<br>
                        <strong>Connection-seeking</strong> takes risk: this is who I am → can you meet me here?<br><br>
                        The paradox: vulnerability (showing who you really are) is both the obstacle and the doorway to genuine connection.<br><br>
                        <em style="color:'.$coral.';">You cannot connect from behind a mask. Connection requires contact — real contact.</em>')],
                    ['type' => 'exercice', 'title' => 'My social energy audit', 'duration' => '10 min',
                     'description' => 'List the 10 people you spend most time with. For each: does spending time with them energise or deplete you? What is the quality of contact?',
                     'content' => $this->ex($coral, '①', 'Energy audit — your social environment',
                        'For each person on your list, answer honestly:<br>
                        → After spending time with them, do I feel more or less like myself?<br>
                        → Do I feel I can be honest with this person?<br>
                        → Is this relationship something I chose, or something I inherited/tolerate?<br>
                        → What would a healthier version of this relationship look like?<br><br>
                        <em>You are the average of the 5 people you spend most time with (Rohn). Choose consciously.</em>')],
                    ['type' => 'ecriture', 'title' => 'A relationship I want to deepen', 'duration' => '10 min',
                     'description' => 'Choose one relationship you want to invest more intentionally in. Write what authentic connection with this person would look like. What would you need to risk?'],
                    ['type' => 'reflexion', 'title' => 'Which connections have I been postponing?', 'duration' => '8 min',
                     'description' => 'Which important conversations, visits, or reconnections have you been putting off for months? What is the real reason?'],
                ],
            ],

            // ── P3 MODULE 23 (loisirs) ────────────────────────────────────
            '16-loisirs-et-vie' => [
                'title_en'       => 'Living Fully — Leisure, Outings & Travel',
                'description_en' => 'Play is serious. Rest is productive. Leisure is not the absence of work — it is the presence of life. This module gives you permission to live fully.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 Rest is not laziness — it is recovery', 'duration' => '6 min',
                     'description' => 'The neuroscience of leisure, the default mode network, and why doing "nothing" is cognitively essential for creativity, insight, and wellbeing.',
                     'content' => $this->card($amber, 'Rest science', 'The default mode network',
                        'When you are in a state of relaxed, undirected mental rest, your brain activates the <strong>Default Mode Network (DMN)</strong> — a set of brain regions responsible for:<br>
                        → Autobiographical memory consolidation<br>
                        → Creative problem solving (sudden insights)<br>
                        → Social cognition and empathy<br>
                        → Sense of self and narrative<br><br>
                        <strong>Constant productivity kills the DMN.</strong> The "aha moments" we call creativity mostly arise during or after rest — not during intense work.<br><br>
                        <em style="color:'.$amber.';">Leisure is not the reward for work. It is the condition that makes good work possible.</em>')],
                    ['type' => 'exercice', 'title' => 'My joy inventory', 'duration' => '15 min',
                     'description' => 'List 20 activities that bring you genuine joy — not productive or goal-oriented. When did you last do each one? Schedule 3 in the next 2 weeks.',
                     'content' => $this->ex($amber, '①', '20 joy activities — when last done?',
                        'Write 20 activities that bring you joy (not guilty pleasure — actual, wholesome joy).<br><br>
                        For each one: write approximately when you last did it.<br><br>
                        Then: choose 3 that you have not done in more than a month. <strong>Schedule each one with a specific date in the next 2 weeks.</strong><br><br>
                        <em>Joy deferred indefinitely is joy discarded. Treat it with the same seriousness as a medical appointment.</em>')],
                    ['type' => 'ecriture', 'title' => 'My vision for this year — experiences', 'duration' => '10 min',
                     'description' => 'Write 10 experiences (not things to buy — experiences to live) that you want to have this year. Outings. Trips. Creations. Connections.'],
                    ['type' => 'reflexion', 'title' => 'When did I last play — really play?', 'duration' => '8 min',
                     'description' => 'Think back to the last time you did something just for the joy of it — no utility, no outcome, no audience. How long ago was that?'],
                ],
            ],

            // ── P3 MODULE 24 (communication) ──────────────────────────────
            '17-relation-a-lautre' => [
                'title_en'       => 'Communicating — Relationship with Others',
                'description_en' => 'Active listening, NVC (Non-Violent Communication), assertiveness. Speak truth. Hear fully. Stay connected even in difficulty.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 Most arguments are not about the argument', 'duration' => '6 min',
                     'description' => 'The iceberg model of communication: surface content vs underlying needs (NVC, Rosenberg). Why listening is more powerful than speaking.',
                     'content' => $this->card($blue, 'NVC framework', 'Marshall Rosenberg — Non-Violent Communication',
                        'Most conflicts are not about what is being said — they are about unmet needs underneath.<br><br>
                        <strong>The NVC 4-step formula:</strong><br>
                        1. <strong>Observation</strong> — describe the behaviour, not the person: "When you arrive 30 min late..."<br>
                        2. <strong>Feeling</strong> — express your feeling without blame: "...I feel frustrated and invisible..."<br>
                        3. <strong>Need</strong> — name the unmet need: "...because I need reliability and respect for my time."<br>
                        4. <strong>Request</strong> — a specific, actionable request: "Would you be willing to text me if you\'ll be late?"<br><br>
                        <em>The request is not a demand. If it cannot be refused, it is a demand.</em><br><br>
                        <em style="color:'.$blue.';">NVC does not guarantee agreement. It guarantees honest contact — which is all any real relationship can be built on.</em>')],
                    ['type' => 'exercice', 'title' => 'A difficult conversation in NVC', 'duration' => '20 min',
                     'description' => 'Choose one situation in your life where something unsaid is creating tension. Write the NVC script: observation → feeling → need → request.',
                     'content' => $this->ex($blue, '①', 'My NVC script',
                        'Choose a real situation with someone important to you where something has been left unsaid.<br><br>
                        Draft the 4-step message:<br>
                        "When _______ (observation, verifiable fact, no judgment)<br>
                        I feel _______ (pure feeling, not "I feel that you...")<br>
                        Because I need _______ (universal need: safety, trust, respect, connection...)<br>
                        Would you be willing to _______ (specific, possible action)?"<br><br>
                        <em>You do not have to send or say this. But writing it clarifies your own truth first.</em>')],
                    ['type' => 'pratique', 'title' => '🌬 Presence breath before a difficult conversation', 'duration' => '3 min',
                     'description' => '3 cycles of 5-5-5 breath before any important conversation. Activate the PNS — your nervous system in parasympathetic mode communicates better.'],
                    ['type' => 'reflexion', 'title' => 'What do I avoid saying — and why?', 'duration' => '10 min',
                     'description' => 'What truths are you withholding from the important people in your life? What are you afraid would happen if you said them?'],
                ],
            ],

            // ── P3 MODULE 25 (intimité) ───────────────────────────────────
            '18-intimite-et-energie' => [
                'title_en'       => 'Relational Energy & Intimacy',
                'description_en' => 'The quality of your most intimate relationships reflects the quality of your relationship with yourself. This module explores relational energy and conscious intimacy.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 Intimacy begins with self-disclosure', 'duration' => '6 min',
                     'description' => 'The intimacy gradient: from social contact to true vulnerability. What blocks intimacy and what makes it safe to deepen.',
                     'content' => $this->card($coral, 'Intimacy', 'More than physical closeness',
                        'Intimacy (Latin: <em>intimus</em> — innermost) is the state of being deeply known by another and of deeply knowing them.<br><br>
                        <strong>The intimacy gradient (from surface to depth):</strong><br>
                        Social contact → shared activities → shared thoughts → shared feelings → shared vulnerabilities → existential sharing (fears, dreams, meaning)<br><br>
                        Most relationships stall at the first 2 levels. Not because both people do not want more — but because one or both do not feel safe enough to go deeper.<br><br>
                        <strong>What creates safety for intimacy:</strong><br>
                        → Non-judgment (what I say is received, not evaluated)<br>
                        → Reciprocity (both people move toward depth)<br>
                        → Consistency over time<br>
                        → Repair after rupture (conflict handled well builds trust)<br><br>
                        <em style="color:'.$coral.';">You cannot be fully intimate with another person while wearing a mask. Even a comfortable one.</em>')],
                    ['type' => 'exercice', 'title' => 'My relational energy map', 'duration' => '15 min',
                     'description' => 'For each close relationship: where on the intimacy gradient are you? Where would you like to be? What is one small move toward greater depth?',
                     'content' => $this->ex($coral, '①', 'Intimacy gradient — my 3 closest relationships',
                        'For each of your 3 most important relationships:<br><br>
                        Current level of intimacy (1=social contact, 6=existential sharing): ___<br>
                        Desired level: ___<br>
                        What blocks going deeper: ___<br>
                        One small step toward more depth: ___<br><br>
                        <em>Intimacy does not jump from 2 to 6. It builds one honest conversation at a time.</em>')],
                    ['type' => 'ecriture', 'title' => 'What do I need to be truly intimate?', 'duration' => '10 min',
                     'description' => 'Write about the conditions under which you feel safe enough to be fully yourself with another person. What do you need? What breaks that safety?'],
                    ['type' => 'reflexion', 'title' => 'Am I fully known by anyone?', 'duration' => '8 min',
                     'description' => 'Is there anyone in your life who knows the real you — not the role, not the performance? What would it mean if there was not? What would it cost to change that?'],
                ],
            ],

            // ── P3 MODULE 26 (reconstruire) ───────────────────────────────
            '20-vivre-choisir-reconstruire' => [
                'title_en'       => 'Living, Choosing, Rebuilding',
                'description_en' => 'Navigating ruptures, loss, transitions, and rebuilding from within. Viktor Frankl, post-traumatic growth, and the choice available in every storm.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 Between stimulus and response — there is a choice', 'duration' => '7 min',
                     'description' => 'Viktor Frankl\'s insight from the concentration camps. Post-traumatic growth (Tedeschi & Calhoun). How humans find meaning after crisis.',
                     'content' => $this->card($purple, 'Frankl', 'Between stimulus and response, there is a space. In that space lies our power and our freedom.',
                        'Viktor Frankl survived Auschwitz and Dachau. In "Man\'s Search for Meaning" (1946), he wrote:<br><br>
                        <em>"Everything can be taken from a man but one thing: the last of the human freedoms — to choose one\'s attitude in any given set of circumstances."</em><br><br>
                        <strong>Post-traumatic growth (Tedeschi & Calhoun, 1996):</strong> Research shows that 60-70% of survivors of major adversity report positive psychological changes in the aftermath — including:<br>
                        → Deepened relationships<br>
                        → New possibilities<br>
                        → Increased personal strength<br>
                        → Spiritual growth<br>
                        → Greater appreciation for life<br><br>
                        <em style="color:'.$purple.';">The crisis does not cause the growth. The meaning you make of it does.</em>')],
                    ['type' => 'exercice', 'title' => 'Mapping my ruptures', 'duration' => '15 min',
                     'description' => 'Draw your life timeline with its 5 most difficult moments. For each: what did you lose? What did you discover? What strength showed up?',
                     'content' => $this->ex($purple, '①', 'Rupture inventory',
                        'For each of your 5 hardest life experiences:<br>
                        → What happened (brief)<br>
                        → What did I lose or let go of?<br>
                        → What unexpected strength or quality emerged in me?<br>
                        → What do I know now that I did not know before?<br><br>
                        <em>This is not toxic positivity ("everything happens for a reason"). This is honest archaeology: finding what was built in the rubble.</em>')],
                    ['type' => 'ecriture', 'title' => 'The meaning I choose to make', 'duration' => '15 min',
                     'description' => 'Choose your most significant difficulty. Write about the meaning you choose to draw from it — not the meaning imposed, the one you actively create.'],
                    ['type' => 'pratique', 'title' => '🌬 Resilience breath — 5 min grounding', 'duration' => '5 min',
                     'description' => 'Cardiac coherence 5-5-5 while feeling the ground beneath you. You survived. You are here. You are rebuilding.'],
                ],
            ],

            // ── P3 MODULE 27 (entretenir relations) ───────────────────────
            '21-entretenir-nos-relations' => [
                'title_en'       => 'Nurturing Our Relationships — the duration of the bond',
                'description_en' => 'Relational rituals, affective maintenance, the 5 love languages. Long-term relationships do not sustain themselves — they require intentional tending.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 All relationships have entropy', 'duration' => '6 min',
                     'description' => 'Why relationships naturally drift toward distance if not actively maintained — the research on relational investment and its returns.',
                     'content' => $this->card($blue, 'Relational entropy', 'Without input, systems decay',
                        'The Second Law of Thermodynamics applies to relationships: without ongoing energy input, all systems move toward disorder.<br><br>
                        <strong>Gottman (40 years of research):</strong> Couples and close friendships that last have demonstrably different patterns than those that dissolve:<br>
                        → 5:1 ratio of positive to negative interactions<br>
                        → Regular small gestures of affection (turning toward)<br>
                        → Repair attempts after conflict (and acceptance of them)<br>
                        → Continued curiosity about each other (love maps)<br><br>
                        <strong>The 5 Love Languages (Chapman, 1992):</strong><br>
                        Words of affirmation / Quality time / Acts of service / Physical touch / Receiving gifts<br><br>
                        <em style="color:'.$blue.';">A relationship does not die from one crisis. It dies from a thousand small neglects.</em>')],
                    ['type' => 'exercice', 'title' => 'My relational rituals', 'duration' => '15 min',
                     'description' => 'Design 3 regular relational rituals for your most important relationship(s). Weekly, monthly, and annual. Small, specific, and scheduled.',
                     'content' => $this->ex($blue, '①', '3 relational rituals to implement',
                        '<strong>Weekly ritual</strong> (e.g. one shared dinner without screens, one "how are we really doing?" check-in):<br>
                        _______________________________________<br><br>
                        <strong>Monthly ritual</strong> (e.g. one experience together outside the routine):<br>
                        _______________________________________<br><br>
                        <strong>Annual ritual</strong> (e.g. a shared review of the year + celebration + intentions for next year):<br>
                        _______________________________________<br><br>
                        <em>Rituals are not romance. They are structural investment in the most important things in your life.</em>')],
                    ['type' => 'reflexion', 'title' => 'Which relationship needs me to show up differently?', 'duration' => '10 min',
                     'description' => 'Which of your important relationships is running on autopilot or slowly drifting? What one specific gesture would signal: "You matter. I have not forgotten."'],
                ],
            ],

            // ── P3 MODULE 28 (transmettre) ────────────────────────────────
            '11-je-transmets-ma-transformation' => [
                'title_en'       => 'Transmitting My Transformation — Personal Radiance',
                'description_en' => 'Your transformation does not end with you. Personal radiance is not performance — it is the natural overflow of an aligned life, shared with the world.',
                'activities_en'  => [
                    ['type' => 'lecture',  'title' => '📖 Transmission is not teaching', 'duration' => '6 min',
                     'description' => 'The difference between transmitting who you have become and performing transformation for an audience. Why living it is more powerful than explaining it.',
                     'content' => $this->card($gold, 'Transmission', 'What you live, you offer',
                        'There is a fundamental difference between:<br>
                        → <strong>Performing</strong> transformation (showing others how changed you are)<br>
                        → <strong>Being</strong> transformation (simply living the change, which others sense naturally)<br><br>
                        Personal radiance is not brightness turned outward. It is the quality of energy you emanate when you are genuinely aligned — with your values, your body, your relationships, your purpose.<br><br>
                        People who have done the inner work are <em>felt</em> before they are seen.<br>
                        Their presence is calming. Their words carry weight. Their questions open doors.<br><br>
                        <em style="color:'.$gold.';">You do not need to teach anyone anything. Live the change visibly, and you become an invitation.</em>')],
                    ['type' => 'exercice', 'title' => 'My spheres of influence', 'duration' => '15 min',
                     'description' => 'Map your natural spheres of influence: family, friends, work, community, online. In which of these is your transformation most visible? Where is it most needed?',
                     'content' => $this->ex($gold, '①', 'Where is my transformation most useful?',
                        'Draw 5 concentric circles (you at the centre):<br>
                        1. Your intimate sphere (partner, closest friends, children if any)<br>
                        2. Your social sphere (friends, extended family, colleagues)<br>
                        3. Your professional sphere (clients, team, organisation)<br>
                        4. Your community sphere (local, neighbourhood, associations)<br>
                        5. Your extended sphere (social media, writing, teaching, public)<br><br>
                        For each sphere: Where are you currently showing up? Where could you contribute more authentically?')],
                    ['type' => 'ecriture', 'title' => 'What I want to transmit to the world', 'duration' => '15 min',
                     'description' => 'Write what you most want to contribute — not in terms of career or goals, but in terms of quality, energy, and meaning. What do you want to leave behind?'],
                    ['type' => 'pratique', 'title' => '🌬 Transmission breath — 10 min presence', 'duration' => '10 min',
                     'description' => 'Hold in your awareness: what you have received in this Journey. Feel where it lives in your body. Breathe it out as an offering — not to anyone in particular, just into the world.'],
                ],
            ],

        ]; // end modules()
    } // end modules method
} // end class
