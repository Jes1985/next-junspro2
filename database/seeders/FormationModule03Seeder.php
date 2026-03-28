<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * MODULE 3 — Je décris mon bonheur
 * Arc pédagogique : ressources intérieures · vision positive · ancrage somatique du désirable
 */
class FormationModule03Seeder extends Seeder
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
        $indigo = 'rgba(99,102,241,.8)';
        $yellow = 'rgba(234,179,8,.8)';

        $intro =
            $this->card($gold, 'Promesse', 'Ce que ce module t\'apprend',
                '<div style="font-size:.88rem;line-height:2.1;color:rgba(232,224,208,.82);">
                La plupart des formations thérapeutiques passent tout leur temps sur les problèmes.<br><br>
                Pause Souffle fait le choix inverse :<br>
                <strong>aller aussi vers ce qui est bien.</strong><br><br>
                Pas nier les blessures — le module précédent était là pour ça.<br>
                Mais reconnaître que le corps connaît aussi la joie, l\'expansion, la légèreté.<br><br>
                Et que <strong>décrire son bonheur</strong> est un acte thérapeutique en soi.<br><br>
                <em style="color:rgba(201,168,76,.8);">Martin Seligman (psychologie positive) : "Ce que nous répétons se renforce. Ancrer le bon aussi est une compétence qui s\'apprend."</em>
                </div>'
            );

        $corps_joie =
            $this->card($yellow, 'Leçon 1', 'Ce que ton corps connaît déjà du bonheur',
                '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
                Le bonheur n\'est pas une idée abstraite.<br>
                C\'est une <strong>expérience corporelle</strong>.<br><br>
                Souviens-toi d\'un moment où tu t\'es senti vraiment bien :<br>
                → Où était cette sensation dans le corps ?<br>
                → Comment respirais-tu ?<br>
                → Quelle était la qualité de ta présence ?<br><br>
                Ces moments ont laissé une empreinte positive.<br>
                Ton travail : les retrouver, les amplifier, les ancrer.
                </div>
                <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(234,179,8,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
                🎙 <strong style="color:rgba(234,179,8,.8);">Script audio ElevenLabs ·</strong>
                <em>"Fermez les yeux. Retournez à un moment dans votre vie où vous vous êtes senti vraiment bien. Pas forcément une grande occasion. Peut-être un matin de printemps, une conversation qui a tout changé, un repas avec des proches… Où est cette sensation dans votre corps ? Laissez-la s\'installer."</em>
                </div>'
            );

        $ressources =
            $this->card($green, 'Leçon 2', 'Les ressources intérieures — ce que tu as déjà',
                '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
                Une ressource intérieure est une qualité, une force, une capacité que tu possèdes déjà.<br><br>
                Elles se trouvent dans :<br>
                <strong>· Les moments de dépassement</strong> → "j\'ai réussi malgré la peur"<br>
                <strong>· Les qualités reconnues par l\'entourage</strong> → ce qu\'on dit de toi en bien<br>
                <strong>· Les activités où le temps disparaît</strong> → l\'état de flow<br>
                <strong>· Les moments de calme profond</strong> → quand tu te sens à ta place<br><br>
                En séance, accéder aux ressources du client <strong>avant</strong> d\'aborder les difficultés.<br>
                Ça construit le terrain sécurisant.
                </div>
                <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(34,197,94,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
                🎙 <strong style="color:rgba(34,197,94,.8);">Script audio ElevenLabs ·</strong>
                <em>"Pensez à un moment où vous avez été fier·e de vous. Pas forcément une grande épreuve. Peut-être un geste simple fait avec soin. Sentez dans votre corps cette fierté… où est-elle ? Dans la poitrine ? Dans le dos qui se redresse ? Restez là un moment."</em>
                </div>'
            );

        $posture =
            $this->card($teal, 'Leçon 3', 'La posture du bonheur — le corps qui se redresse',
                '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
                Amy Cuddy (Harvard) a montré que la posture modifie la biochimie :<br>
                <strong>choisir une posture expansive pendant 2 minutes → baisse du cortisol.</strong><br><br>
                Les marqueurs corporels du bonheur :<br>
                · Tête droite, regard horizontal<br>
                · Épaules basses et ouvertes<br>
                · Poitrine légèrement ouverte<br>
                · Respiration abdominale<br>
                · Pieds bien posés au sol<br><br>
                Ce n\'est pas forcer un sourire.<br>
                C\'est <strong>laisser le corps s\'orienter vers ce qu\'il connaît de bon.</strong>
                </div>
                <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(20,184,166,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
                🎙 <strong style="color:rgba(20,184,166,.8);">Script audio ElevenLabs ·</strong>
                <em>"Doucement, laissez les épaules s\'ouvrir. Sentez la poitrine s\'élargir légèrement. Rien de forcé. Juste un peu plus d\'espace. Comment est votre respiration maintenant ?"</em>
                </div>'
            );

        $description =
            $this->card($purple, 'Leçon 4', 'Décrire son bonheur — la précision qui ancre',
                '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
                "Je suis heureux" n\'ancre pas.<br>
                <strong>"Je me sens léger dans la poitrine, ma respiration est ample, j\'ai envie de sourire"</strong> — ça, ça ancre.<br><br>
                La précision crée la présence.<br>
                La présence crée l\'ancrage.<br>
                L\'ancrage crée la ressource durable.<br><br>
                Exercice pour le client : lui demander de décrire son bonheur en <strong>sensations corporelles</strong>.<br>
                Pas en idées. Pas en images. En <em>ce que le corps ressent precísément</em>.
                </div>'
            );

        $scan_joie =
            $this->card($orange, 'Pratique', 'Le scan des joies — retrouver les îlots de bien-être',
                '<div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.85rem 1.1rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(249,115,22,.55);margin-bottom:.5rem;">─ Protocole ─</div>
                <strong>Étape 1</strong> → Réécris 5 moments où tu t\'es senti vraiment vivant. (5 min)<br>
                <strong>Étape 2</strong> → Pour chaque moment : quel était le lieu ? les personnes ? l\'activité ? <br>
                <strong>Étape 3</strong> → Identifie le dénominateur commun. Qu\'est-ce que ces moments avaient en commun ?<br>
                <strong>Étape 4</strong> → Ferme les yeux. Reviens à l\'un de ces moments. Où est-il dans ton corps ?<br>
                <strong>Étape 5</strong> → Respire sur cette zone. Laisse la sensation se déposer.<br><br>
                <em>Ces "îlots de joie" sont tes ancres positives. Tu pourras les utiliser en séance.</em>
                </div>'
            );

        $manifeste =
            $this->card($indigo, 'Intégration', 'Mon manifeste du bonheur — ce que je sais maintenant',
                '<div style="font-size:.85rem;line-height:2.2;color:rgba(232,224,208,.82);">
                Complète ces phrases de façon honnête et précise :<br><br>
                <strong>Mon bonheur ressemble physiquement à :</strong> ___<br>
                <strong>Je me sens vraiment vivant·e quand :</strong> ___<br>
                <strong>La ressource intérieure dont je suis le plus conscient·e est :</strong> ___<br>
                <strong>La posture de mon bonheur est :</strong> ___<br>
                <strong>Ce que je vais apporter d\'unique à mes clients, c\'est :</strong> ___<br><br>
                <em style="color:rgba(99,102,241,.8);">Un praticien qui connaît son bonheur peut aider l\'autre à reconnaître le sien.</em>
                </div>'
            );

        $activities = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — Le choix d\'aller aussi vers ce qui est bien',
                'duration'    => '~15 min',
                'description' => 'La psychologie positive appliquée au corps. Pas nier les blessures — aller aussi vers les ressources. Décrire son bonheur est un acte thérapeutique.',
                'content'     => $intro,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 1 — Ce que ton corps connaît déjà du bonheur',
                'duration'    => '~20 min',
                'description' => 'Le bonheur comme expérience corporelle. Retrouver les moments de bien-être passés, localiser leur empreinte dans le corps.',
                'content'     => $corps_joie,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 2 — Les ressources intérieures',
                'duration'    => '~20 min',
                'description' => 'Identifier les forces déjà présentes. Accéder aux ressources avant les difficultés — le principe fondateur de la séance Pause Souffle.',
                'content'     => $ressources,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 3 — La posture du bonheur',
                'duration'    => '~20 min',
                'description' => 'La posture expansive et ses effets biochimiques (Cuddy). Les marqueurs corporels du bien-être. Laisser le corps s\'orienter vers ce qu\'il connaît de bon.',
                'content'     => $posture,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 4 — Décrire son bonheur avec précision',
                'duration'    => '~15 min',
                'description' => 'La description en sensations corporelles comme technique d\'ancrage. Pas en idées — en ressentis précis.',
                'content'     => $description,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Pratique — Le scan des joies',
                'duration'    => '~30 min',
                'description' => '5 moments où tu t\'es senti vraiment vivant. Dénominateur commun. Ancrage corporel. Ces îlots de joie deviennent tes ressources en séance.',
                'content'     => $scan_joie,
            ],
            [
                'type'        => 'exercice',
                'title'       => 'Intégration — Mon manifeste du bonheur',
                'duration'    => '~25 min',
                'description' => '5 phrases précises sur ton bonheur. Ce que tu es, ce que tu ressens, ce que tu apportes. Un praticien qui connaît son bonheur peut aider l\'autre à reconnaître le sien.',
                'content'     => $manifeste,
            ],
            [
                'type'        => 'reflexion',
                'title'       => 'Lettre — À la version heureuse de moi',
                'duration'    => '~20 min',
                'description' => 'Commence par : "Je te retrouve. Tu as toujours été là, sous les couches de fatigue et de doute. Voici ce que je sais de toi maintenant…"',
            ],
        ];

        DB::table('formation_modules')
            ->where('slug', '03-je-decris-mon-bonheur')
            ->update([
                'intro_text'  => "JE DÉCRIS MON BONHEUR — Les Ressources Intérieures\n\nLe corps connaît aussi la joie, l'expansion, la légèreté.\n\nDécrire son bonheur avec précision est un acte thérapeutique.\nPas en idées — en sensations corporelles.",
                'description' => '4 leçons · Scan des joies · Posture du bonheur · Manifeste personnel. Ancrer le positif aussi est une compétence qui s\'apprend.',
                'activities'  => json_encode($activities),
                'updated_at'  => now(),
            ]);

        $this->command->info('[FormationModule03Seeder] ✓ 8 activités — Je décris mon bonheur.');
    }
}
