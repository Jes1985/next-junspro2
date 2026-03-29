<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * MODULE 08 — Je maîtrise la Vision — Pratique Avancée & Transmission
 * Formation Praticien Pause Souffle · Module 08 (Module final)
 * Arc pédagogique :
 *   · Visualisation immersive aux 5 sens + émotion (6ème dimension)
 *   · Protocoles de discipline : 1× / 3× / 5× par semaine (règle des 66 jours)
 *   · Le Quantum Self (Dr. Joe Dispenza) — être la version accomplie avant de l'avoir
 *   · Guider la visualisation en séance praticien
 *   · Session immersive 20 minutes complète
 *   · Protocole personnalisé et engagement écrit
 */
class FormationModule08Seeder extends Seeder
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
        $pink   = 'rgba(236,72,153,.8)';

        // ─── INTRODUCTION ──────────────────────────────────────────────────────
        $intro = $this->card($gold, 'Module Final', 'Tu connais l\'initiation. Voici la maîtrise.',
            '<div style="font-size:.88rem;line-height:2.1;color:rgba(232,224,208,.82);">
            Au Module 06 du Parcours, vous avez appris à tenir une direction.<br>
            Vous avez discerné l\'obstacle intérieur qui la freine.<br>
            Vous avez commencé à rendre votre vision crédible dans le réel.<br>
            Quelque chose s\'est ouvert.<br><br>
            Maintenant c\'est la <strong>maîtrise</strong>.<br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;border:1px solid rgba(201,168,76,.15);margin:.75rem 0;">
            <strong style="color:rgba(201,168,76,.9);">La différence entre initiation et maîtrise :</strong><br><br>
            <strong>Initiation</strong> · Je clarifie une direction et je commence à l\'habiter.<br>
            <strong>Maîtrise</strong> · Je vis dans ma vision. Tous les sens. Le contexte entier.<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Les détails qui n\'ont l\'air de rien — et qui sont tout.
            </div>
            Ce module est le sommet de la Formation Praticien.<br>
            C\'est aussi le plus personnel.<br>
            Car votre vision ne ressemble à celle de personne d\'autre.<br><br>
            Et votre discipline — la fréquence, le rituel, le moment de la journée —<br>
            <strong>c\'est vous qui la construisez ici.</strong><br><br>
            <em style="color:rgba(201,168,76,.8);">À la fin de ce module : vous êtes un praticien qui maîtrise la visualisation. Et qui sait la transmettre.</em>
            </div>'
        );

        // ─── LEÇON 1 — IMMERSION SENSORIELLE ─────────────────────────────────
        $immersion = $this->card($teal, 'Leçon 1', 'Visualisation immersive — les 5 sens + la 6ème dimension',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            La plupart des gens visualisent comme des <em>spectateurs</em>.<br>
            Le praticien maître visualise comme un <strong>acteur pleinement présent dans la scène</strong>.<br><br>
            <strong style="color:rgba(20,184,166,.9);">Les 5 sens — enrichir chaque dimension :</strong><br><br>
            <div style="background:rgba(20,184,166,.07);border-radius:10px;padding:.85rem 1.1rem;display:flex;flex-direction:column;gap:.7rem;margin:.75rem 0;">
            <div>
            <strong>① Visuel</strong><br>
            Où êtes-vous exactement ? Quelle est la lumière — naturelle ou artificielle ? La couleur des murs, du ciel, des vêtements ? Les textures visibles ? Les distances ? Le mouvement autour de vous ?
            </div>
            <div>
            <strong>② Auditif</strong><br>
            Qu\'entendez-vous ? Des voix — lesquelles, à quelle distance ? De la musique ? Du silence total ? La nature ? La ville ? Le son de vos pas sur ce sol ?
            </div>
            <div>
            <strong>③ Kinesthésique</strong><br>
            Que touchez-vous ? La température de l\'air sur votre peau ? La texture sous vos mains vos pieds ? Êtes-vous en mouvement ou immobile ? Quelle est la qualité du sol sous vous ?
            </div>
            <div>
            <strong>④ Olfactif</strong><br>
            Quelle est l\'odeur de ce moment ? Café ? Bois ? Air marin ? Parfum d\'une personne ? La terre après la pluie ? Les odeurs sont les capteurs mnésiques les plus puissants du cerveau.
            </div>
            <div>
            <strong>⑤ Gustatif</strong><br>
            Si pertinent — que goûtez-vous ? Un repas partagé ? Un champagne ? L\'air frais du matin sur les lèvres ?
            </div>
            </div>
            <strong style="color:rgba(201,168,76,.9);">⑥ L\'émotion — la 6ème dimension, la plus puissante</strong><br><br>
            Dr Joe Dispenza : <em>"L\'émotion est le signe que le corps expérimente ce que l\'esprit vient d\'imaginer."</em><br>
            L\'émotion est le signal électromagnétique que votre cœur envoie au champ quantique.<br><br>
            → Quelle émotion EXACTEMENT dans cette scène ?<br>
            → Joie ? Fierté ? Paix profonde ? Gratitude ? Soulagement ? Amour ?<br>
            → Amplifiez-la. Laissez-la monter dans la poitrine, les bras, le visage.<br><br>
            <em>Plus l\'émotion est intense et sincère — plus le signal est puissant et précis.</em>
            </div>
            <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(20,184,166,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
            🎙 <strong style="color:rgba(20,184,166,.8);">Script audio ElevenLabs ·</strong>
            <em>"Fermez les yeux. Choisissez la scène la plus forte de votre vision. Entrez dedans. Regardez autour de vous… qu\'est-ce que vous voyez ? Écoutez attentivement… qu\'entendez-vous ? Sentez sous vos mains… la texture de cet espace. Respirez l\'air de cet endroit. Et maintenant — quelle est cette émotion ? Nommez-la. Amplifiez-la. Laissez-la remplir votre corps entier."</em>
            </div>'
        );

        // ─── LEÇON 2 — LES PROTOCOLES DE DISCIPLINE ──────────────────────────
        $discipline = $this->card($blue, 'Leçon 2', 'Les protocoles de discipline — 1× · 3× · 5× par semaine',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            La visualisation fonctionne comme l\'épargne :<br>
            <strong>la régularité surpasse toujours l\'intensité.</strong><br><br>
            Une séance de 7 minutes par jour fait infiniment plus<br>
            qu\'une session de 2 heures une fois par mois.<br><br>
            <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.85rem 1.1rem;display:flex;flex-direction:column;gap:1rem;margin:.75rem 0;">
            <div>
            <strong style="color:#93c5fd;">Protocole 1× · Le Dimanche Visionnaire</strong><br>
            <em>20 minutes · Tableau complet · 1 thématique approfondie · Carnet de vision</em><br>
            Pour qui : débutants ou vies très chargées. Mieux que rien — bien mieux.
            </div>
            <div>
            <strong style="color:#93c5fd;">Protocole 3× · La Cadence de Croissance</strong><br>
            <em>Lun/Mer/Ven · 10 minutes · Rotation par territoire :</em><br>
            Lun → Santé &amp; Corps · Mer → Mission &amp; Prospérité · Ven → Relations &amp; Épanouissement<br>
            Pour qui : praticiens en activité avec une discipline déjà installée.
            </div>
            <div>
            <strong style="color:#93c5fd;">Protocole 5× · L\'Immersion Quotidienne</strong><br>
            <em>Chaque matin · 7 minutes minimum · Un territoire par jour sur 5 jours</em><br>
            Le 5ème jour : revue complète du Tableau · 15 min · Carnet de gratitude des signes reçus<br>
            Pour qui : praticiens en phase d\'accélération ou de transformation profonde.
            </div>
            </div>
            <strong style="color:rgba(59,130,246,.9);">Les moments d\'or :</strong><br>
            · Au <strong>réveil</strong> : entre l\'état thêta et alpha — le cerveau est en mode réceptif maximal<br>
            · Avant de <strong>dormir</strong> : le subconscient travaille pendant le sommeil sur ce qu\'il reçoit en dernier<br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.75rem 1rem;border:1px solid rgba(201,168,76,.15);">
            <strong style="color:rgba(201,168,76,.9);">La règle des 66 jours · Phillippa Lally (UCL, 2010)</strong><br>
            Une habitude s\'installe en 18 à 254 jours selon sa complexité. La médiane : <strong>66 jours</strong>.<br>
            Engagez-vous sur 66 jours. Pas 21. Pas 30. <strong>66.</strong><br>
            C\'est le seuil au-delà duquel la pratique devient automatique — naturelle — la vôtre.
            </div>
            </div>
            <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(59,130,246,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
            🎙 <strong style="color:rgba(59,130,246,.8);">Script audio ElevenLabs ·</strong>
            <em>"La discipline de la vision ne se mesure pas à l\'intensité d\'une séance. Elle se mesure à la constance du rituel. Un petit feu entretenu chaque jour réchauffe mieux qu\'un grand feu allumé une fois par mois. Choisissez votre protocole. Notez votre engagement. Commencez demain matin."</em>
            </div>'
        );

        // ─── LEÇON 3 — LE QUANTUM SELF ────────────────────────────────────────
        $quantum_self = $this->card($purple, 'Leçon 3', 'Le Quantum Self — devenir la version accomplie avant de l\'avoir',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Voici ce que la plupart des gens font sans s\'en rendre compte :<br>
            Ils visualisent leur avenir depuis l\'état de <strong>manque</strong>.<br>
            <em>"Je veux ceci — que je n\'ai pas encore."</em><br>
            Et ce signal de manque est précisément ce que leur cerveau émet en permanence.<br><br>
            <strong>Le Quantum Self renverse entièrement cette logique.</strong><br><br>
            <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;border:1px solid rgba(168,85,247,.12);">
            <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(168,85,247,.55);margin-bottom:.5rem;">─ Le principe Dr. Joe Dispenza ─</div>
            <em>"Nous maintenons l\'état de manque tant que nous nous définissons par ce que nous n\'avons pas encore."</em><br><br>
            La maîtrise consiste à s\'identifier <strong>maintenant</strong> avec la version qui a déjà accompli.<br>
            Pas "je vais avoir" — mais <strong>"je suis déjà la personne qui…"</strong>
            </div>
            <strong style="color:rgba(168,85,247,.9);">Pratiquer le Quantum Self :</strong><br><br>
            <strong>① Les 10 affirmations présentes</strong><br>
            Écrivez 10 phrases commençant par "Je suis déjà la personne qui…"<br>
            <em>Ex : "Je suis déjà la personne qui accompagne ses clients avec maîtrise et calme."</em><br>
            <em>Ex : "Je suis déjà la personne qui vit dans un environnement beau et inspirant."</em><br><br>
            <strong>② La congruence corps — esprit — action (les 3 niveaux)</strong><br>
            · <strong>Corps</strong> : adopter la posture, la respiration, le mouvement de la version accomplie<br>
            · <strong>Esprit</strong> : les pensées, les décisions, les priorités de cette version<br>
            · <strong>Action</strong> : ce que cette version fait — que vous commencez à faire <em>maintenant</em><br><br>
            <strong>③ La question de calibrage du matin</strong><br>
            <em>"Que ferait aujourd\'hui la version accomplie de moi ?"</em><br>
            Puis faites au moins une de ces choses — aujourd\'hui.
            </div>
            <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(168,85,247,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
            🎙 <strong style="color:rgba(168,85,247,.8);">Script audio ElevenLabs ·</strong>
            <em>"Imaginez que vous êtes dans 3 ans. Vous avez accompli ce que vous visualisez. Regardez-vous dans cette version. Comment respirez-vous ? Quel est votre état intérieur ? Comment vous déplacez-vous dans une pièce ? Cette personne vous regarde maintenant. Elle vous dit : tu y es presque. Commence à marcher comme si tu l\'étais déjà."</em>
            </div>'
        );

        // ─── LEÇON 4 — VISUALISATION EN SÉANCE PRATICIEN ─────────────────────
        $seance_praticien = $this->card($indigo, 'Leçon 4', 'La visualisation guidée en séance — transmettre l\'outil',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Vous maîtrisez votre propre pratique.<br>
            Maintenant : <strong>transmettre cet outil à vos clients.</strong><br><br>
            La visualisation guidée en fin de séance est un des outils les plus puissants<br>
            du praticien Pause Souffle. Utilisée au bon moment — elle transforme<br>
            une séance corporelle en expérience réellement intégratrice.<br><br>
            <strong style="color:rgba(99,102,241,.9);">Quand l\'utiliser :</strong><br>
            · Après la phase d\'intégration corporelle<br>
            · Quand l\'espace est calme et le client en état réceptif (yeux doux, respiration apaisée)<br>
            · Jamais directement après une exploration émotionnelle intense (le client est trop vulnérable)<br>
            · Toujours sur proposition — jamais en imposition :<br>
            <em>"Je vous propose quelque chose si vous êtes d\'accord…"</em><br><br>
            <strong style="color:rgba(99,102,241,.9);">Le protocole en 5 temps :</strong><br><br>
            <div style="background:rgba(99,102,241,.07);border-radius:10px;padding:.85rem 1.1rem;display:flex;flex-direction:column;gap:.6rem;margin:.75rem 0;">
            <div><strong>① Ancrer</strong> · 3 souffles 5-5-5 ensemble · "Installez-vous confortablement. Fermez doucement les yeux."</div>
            <div><strong>② Ouvrir l\'espace</strong> · "Laissez votre corps se détendre complètement. Votre respiration est libre."</div>
            <div><strong>③ Inviter l\'image</strong> · "Si une image de ce que vous souhaitez vivrait en vous en ce moment — quelle serait-elle ?"<br>
            <em style="font-size:.75rem;color:rgba(232,224,208,.55);">Ne donnez pas l\'image. Invitez le client à trouver la sienne.</em></div>
            <div><strong>④ Enrichir les sens</strong> · Si le client partage : "Qu\'est-ce que vous voyez ? Entendez ? Ressentez dans le corps ?"</div>
            <div><strong>⑤ Ancrer dans le corps</strong> · "Installez cette sensation dans votre cœur. Dans vos mains. Cette clarté reste avec vous."</div>
            </div>
            <strong>Durée idéale :</strong> 5 à 10 minutes en toute fin de séance<br>
            <strong>Après :</strong> silence. Pas de commentaire du praticien. L\'espace reste ouvert et sacré.
            </div>
            <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(99,102,241,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
            🎙 <strong style="color:rgba(99,102,241,.8);">Script praticien complet ElevenLabs ·</strong>
            <em>"Laissez votre respiration revenir à son propre rythme. Quand vous vous sentez prêt·e — je vous invite à accueillir une image. Une seule. Celle de comment vous souhaitez vous sentir à partir d\'aujourd\'hui. Pas une chose à obtenir — un état à habiter. Laissez cette image venir naturellement… ne la cherchez pas… attendez-la."</em>
            </div>'
        );

        // ─── SESSION IMMERSIVE 20 MINUTES ─────────────────────────────────────
        $session_immersive = $this->card($orange, 'Pratique', 'Session immersive — 20 minutes de maîtrise complète',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            <div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.9rem 1.1rem;border:1px solid rgba(249,115,22,.12);">
            <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(249,115,22,.55);margin-bottom:.75rem;">─ Protocole complet · 20 minutes ─</div>
            <div style="display:flex;flex-direction:column;gap:.85rem;">
            <div>
            <strong style="color:rgba(249,115,22,.9);">Phase 1 — Ancrage Pause Souffle · 3 min</strong><br>
            3 cycles 5-5-5. Pieds au sol. Épaules relâchées. Yeux fermés.<br>
            Intention intérieure : <em>"Je suis prêt·e à voir avec tous mes sens."</em>
            </div>
            <div>
            <strong style="color:rgba(249,115,22,.9);">Phase 2 — Descente en état alpha · 2 min</strong><br>
            Comptez mentalement de 10 à 1, lentement.<br>
            À chaque chiffre : un peu plus de calme, un peu plus de présence.<br>
            À 1 : état alpha. Réceptif. Prêt. Portes ouvertes.
            </div>
            <div>
            <strong style="color:rgba(249,115,22,.9);">Phase 3 — Survol des territoires · 3 min</strong><br>
            Passez rapidement sur vos 5 territoires de vie. Juste les scènes, sans vous arrêter.<br>
            Laissez un territoire "appeler" plus fort que les autres. Faites-lui confiance.
            </div>
            <div>
            <strong style="color:rgba(249,115,22,.9);">Phase 4 — Immersion territoire 1 · 5 min</strong><br>
            Entrez dans la scène la plus forte de ce territoire.<br>
            Tous les sens. Enrichissez chaque détail. Amplifiez l\'émotion.<br>
            3 cycles 5-5-5 depuis l\'intérieur de cette scène.
            </div>
            <div>
            <strong style="color:rgba(249,115,22,.9);">Phase 5 — Immersion territoire 2 · 5 min</strong><br>
            Choisissez un second territoire. Même protocole sensoriel complet.<br>
            Laissez les deux scènes se relier naturellement si elles le font.
            </div>
            <div>
            <strong style="color:rgba(249,115,22,.9);">Phase 6 — Intégration et ancrage final · 2 min</strong><br>
            Revenez au corps entier. 3 souffles de gratitude.<br>
            <em>"Ce que j\'ai vu est déjà en chemin."</em><br>
            Ouvrez les yeux. Notez une phrase dans votre carnet.
            </div>
            </div>
            </div>
            <br>
            <em>Faites cette session seul·e d\'abord.<br>
            Puis enregistrez votre voix guide pour la proposer à vos clients (adaptation 10 min).</em>
            </div>'
        );

        // ─── ENGAGEMENT — MON PROTOCOLE PERSONNALISÉ ──────────────────────────
        $protocole_perso = $this->card($green, 'Engagement Final', 'Ma discipline de vision — l\'engagement qui change tout',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            La maîtrise n\'est pas un état qu\'on atteint une fois.<br>
            C\'est une <strong>pratique que l\'on choisit de maintenir</strong>.<br><br>
            <strong style="color:rgba(34,197,94,.9);">Je définis mon protocole maintenant :</strong><br><br>
            <div style="background:rgba(34,197,94,.06);border-radius:10px;padding:.85rem 1.1rem;margin:.75rem 0;">
            <strong>Ma fréquence :</strong><br>
            ☐ 1× par semaine — Le Dimanche Visionnaire (20 min)<br>
            ☐ 3× par semaine — La Cadence de Croissance (10 min)<br>
            ☐ 5× par semaine — L\'Immersion Quotidienne (7-15 min)<br><br>
            <strong>Mon moment de la journée :</strong><br>
            ☐ Le matin, avant de regarder mon téléphone<br>
            ☐ Le soir, dans les dernières minutes avant de dormir<br>
            ☐ Les deux — matin court (7 min) + soir long (15 min) les jours choisis<br><br>
            <strong>Mon lieu :</strong><br>
            Un endroit fixe, si possible toujours le même.<br>
            Le cerveau s\'y associe plus vite et entre en état plus facilement.
            </div>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.9rem 1.1rem;border:1px solid rgba(201,168,76,.2);margin-top:.75rem;">
            <strong style="color:rgba(201,168,76,.9);">Mon engagement écrit · 66 jours :</strong><br><br>
            <em style="font-size:.83rem;line-height:1.9;">"Je m\'engage à pratiquer la visualisation [ma fréquence]
            pendant 66 jours à partir du [date].<br>
            À chaque séance, j\'utilise la méthode Pause Souffle 5-5-5.<br>
            Je note dans mon carnet au moins une phrase après chaque session.<br>
            Je relis mon carnet à 21 jours et à 66 jours."</em><br><br>
            Signez. Datez. Photographiez cet engagement.
            </div>
            <br>
            <div style="background:linear-gradient(135deg,rgba(201,168,76,.12),rgba(201,168,76,.04));border-radius:14px;padding:1.2rem 1.4rem;border:1.5px solid rgba(201,168,76,.3);margin-top:.75rem;">
            <strong style="color:rgba(201,168,76,.95);font-size:.95rem;">Formation Praticien Pause Souffle · Module 08 — Terminé</strong><br><br>
            Vous avez parcouru 9 modules.<br>
            <em>Anatomie · Soi · Blessures · Bonheur · Souffle · Mission ·<br>
            Vision (initiation) · Rituel du praticien · Vision (maîtrise).</em><br><br>
            Vous n\'êtes plus seulement quelqu\'un qui se transforme.<br>
            Vous êtes quelqu\'un qui <strong>accompagne la transformation.</strong><br><br>
            <em style="color:rgba(201,168,76,.75);font-size:.82rem;">"Le praticien le plus puissant n\'est pas celui qui a le plus de techniques.<br>
            C\'est celui qui a fait le voyage lui-même —<br>
            et qui sait maintenant comment traverser avec l\'autre."</em>
            </div>
            </div>'
        );

        // ─── ACTIVITÉS ────────────────────────────────────────────────────────
        $activities = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — De l\'initiation à la maîtrise',
                'duration'    => '5 min',
                'description' => 'Ce qui sépare voir de vivre dans sa vision. La différence entre spectateur et acteur de sa vision. Ce que ce module final de la Formation Praticien va ancrer pour toujours.',
                'content'     => $intro,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 1 — Visualisation immersive · Les 5 sens + l\'émotion',
                'duration'    => '10 min',
                'description' => 'Visuel · Auditif · Kinesthésique · Olfactif · Gustatif · L\'émotion comme 6ème dimension (signal électromagnétique le plus puissant selon Dispenza) · Passer du spectateur à l\'acteur dans sa vision.',
                'content'     => $immersion,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 2 — Les protocoles de discipline · 1× · 3× · 5× par semaine',
                'duration'    => '8 min',
                'description' => 'La régularité > l\'intensité · Protocole Dimanche Visionnaire · Cadence de Croissance · Immersion Quotidienne · Les moments d\'or (réveil/sommeil) · La règle des 66 jours (Phillippa Lally, UCL 2010).',
                'content'     => $discipline,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 3 — Le Quantum Self · Être la version accomplie avant de l\'avoir',
                'duration'    => '10 min',
                'description' => 'Visualiser depuis le manque (erreur) vs depuis l\'état accompli (maîtrise) · Dr Joe Dispenza : être la personne avant d\'avoir la chose · Les 10 affirmations présentes · Congruence corps-esprit-action · La question de calibrage du matin.',
                'content'     => $quantum_self,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 4 — La visualisation guidée en séance · Transmettre l\'outil',
                'duration'    => '10 min',
                'description' => 'Quand l\'utiliser (et quand ne PAS l\'utiliser) · Le protocole en 5 temps · Inviter — jamais imposer · Script praticien complet · Durée idéale (5-10 min en fin de séance) · Le silence après.',
                'content'     => $seance_praticien,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Session immersive — 20 minutes de maîtrise complète',
                'duration'    => '20 min',
                'description' => 'Protocole en 6 phases : Ancrage 5-5-5 (3min) · Descente en état alpha (2min) · Survol des territoires (3min) · Immersion territoire 1 (5min) · Immersion territoire 2 (5min) · Intégration et ancrage final (2min).',
                'content'     => $session_immersive,
            ],
            [
                'type'        => 'exercice',
                'title'       => 'Engagement — Mon protocole personnalisé sur 66 jours',
                'duration'    => '20 min',
                'description' => 'Choisir sa fréquence (1×/3×/5× par semaine) · Choisir son moment (matin/soir) · Définir son lieu de pratique · Rédiger son engagement écrit sur 66 jours · Signer, dater, photographier · Module final de la Formation Praticien.',
                'content'     => $protocole_perso,
            ],
        ];

        // ─── INSERTION EN BASE ────────────────────────────────────────────────
        DB::table('formation_modules')
            ->where('slug', '07-je-maitrise-la-vision')
            ->update([
                'title'       => 'Je maîtrise la Vision — Pratique Avancée & Transmission',
                'week_label'  => 'Praticien · Module 07',
                'intro_text'  => "Au Module 06 du Parcours, vous avez appris à tenir une direction.\nVous avez discerné l'obstacle intérieur qui la freine. Vous avez commencé à rendre votre vision crédible dans le réel.\nQuelque chose s'est ouvert.\n\nMaintenant c'est la maîtrise.\n\nLa différence entre initiation et maîtrise en visualisation :\n— Initiation : je clarifie une direction et je commence à l'habiter.\n— Maîtrise : je vis dans ma vision. Tous les sens. Le contexte entier.\n                Les détails qui n'ont l'air de rien — et qui sont tout.\n\nCe module est le sommet de la Formation Praticien.\nC'est aussi le plus personnel.\nCar votre vision ne ressemble à celle de personne d'autre.\n\nEt votre discipline — la fréquence, le rituel, le moment de la journée —\nc'est vous qui la construisez ici.",
                'description' => '4 leçons + 2 exercices · Immersion sensorielle 5 sens + émotion (6ème dimension) · Protocoles 1×-3×-5×/semaine (règle 66 jours) · Quantum Self (Dr. Joe Dispenza) · Visualisation guidée en séance praticien · Session immersive 20 min · Protocole personnalisé 66 jours.',
                'activities'  => json_encode($activities),
                'updated_at'  => now(),
            ]);

        $this->command->info('[FormationModule08Seeder] ✓ 7 activités — Je maîtrise la Vision · Module 08 Formation Praticien.');
    }
}
