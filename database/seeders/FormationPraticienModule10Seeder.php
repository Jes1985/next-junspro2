<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * MODULE 10 — La Posture du Praticien
 * Formation Praticien · Module professionnel
 * Arc pédagogique : présence corporelle · voix thérapeutique · état interne · burn-out praticien
 */
class FormationPraticienModule10Seeder extends Seeder
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

        $intro = $this->card($gold, 'Module 10 · Praticien', 'La technique sans présence ne guérit pas',
            '<div style="font-size:.88rem;line-height:2.1;color:rgba(232,224,208,.82);">
            Vous pouvez maîtriser les 7 techniques. Connaître la neurobiologie du souffle.<br>
            Mais si votre client sent que vous êtes dans votre tête pendant la séance,<br>
            que votre voix est tendue, que votre corps trahit votre état interne —<br>
            <strong>aucune technique ne compensera.</strong><br><br>
            <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;border:1px solid rgba(201,168,76,.15);margin:.75rem 0;">
            Le corpo signifie : le thérapeute EST l\'outil.<br><br>
            Ce n\'est pas dans le guide qu\'on apprend ça.<br>
            Les 4 dimensions de la posture du praticien :<br><br>
            <strong>① La présence physique</strong> — ancrage, corps, regard<br>
            <strong>② La voix thérapeutique</strong> — rythme, chaleur, silences<br>
            <strong>③ L\'état interne</strong> — être là plutôt qu\'y être<br>
            <strong>④ La durabilité</strong> — éviter le burn-out du praticien
            </div>
            Ce module est une pratique avant d\'être une lecture.
            </div>'
        );

        $presence_physique = $this->card($teal, 'Leçon 1', 'La présence corporelle — l\'ancrage comme fondation',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            <strong>Votre corps parle avant que vous parliez.</strong><br>
            Un client en état de vulnérabilité lit votre corps en moins de 200 ms.<br><br>
            <div style="background:rgba(20,184,166,.07);border-radius:10px;padding:.85rem 1.1rem;display:flex;flex-direction:column;gap:.9rem;margin:.75rem 0;">
            <div>
            <strong style="color:rgba(20,184,166,.9);">La posture d\'ancrage :</strong><br>
            Pieds à plat · dos droit mais pas rigide · mains posées (pas croisées) · mâchoire détendue<br>
            Testez : inspirez profond. Si votre épaule monte, vous n\'êtes pas ancré.
            </div>
            <div>
            <strong style="color:rgba(20,184,166,.9);">Le regard :</strong><br>
            Pas le regard perçant. Pas le regard fuyant. Le regard "doux-présent" :<br>
            regarder l\'ensemble du visage, légèrement flou. Chaud. Accueillant.
            </div>
            <div>
            <strong style="color:rgba(20,184,166,.9);">La distance thérapeutique :</strong><br>
            Entre 1m et 1m50 pour la plupart des clients.<br>
            Demandez toujours : "Je vais poser ma main sur votre épaule — est-ce ok pour vous ?"<br>
            Le consentement corporel est non-négociable.
            </div>
            <div>
            <strong style="color:rgba(20,184,166,.9);">Avant chaque séance — Rituel des 2 minutes :</strong><br>
            Pieds au sol · 3 respirations 5-5 · Intention de présence pour ce client spécifiquement.<br>
            "Je suis là. Je suis disponible. Je reçois ce qui vient."
            </div>
            </div>
            <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(20,184,166,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;font-size:.75rem;color:rgba(232,224,208,.65);margin-top:.5rem;">
            🎙 <em>"Avant d\'ouvrir la porte pour accueillir votre client, prenez 30 secondes. Regardez vos pieds. Sentez le sol. Relâchez la mâchoire. Ce que vous transmettez commence ici — pas quand vous parlez."</em>
            </div>'
        );

        $voix = $this->card($blue, 'Leçon 2', 'La voix thérapeutique — rythme, silences et chaleur',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            La voix est la deuxième porte d\'entrée après le corps.<br>
            Dans un accompagnement corporel, la voix <strong>guide sans diriger</strong>.<br><br>
            <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.85rem 1.1rem;display:flex;flex-direction:column;gap:.9rem;margin:.75rem 0;">
            <div>
            <strong style="color:rgba(59,130,246,.9);">Rythme :</strong><br>
            Parlez <em>plus lentement que vous ne pensez devoir le faire.</em><br>
            Règle : si votre débit semble bizarre pour vous, c\'est probablement parfait pour votre client.<br>
            Le système nerveux parasympathique se régule sur une voix lente.
            </div>
            <div>
            <strong style="color:rgba(59,130,246,.9);">Les silences :</strong><br>
            Un silence de 5 secondes après une guidance, c\'est un cadeau.<br>
            Résistez à l\'impulsion de combler le vide. Le client travaille dans ces silences.
            </div>
            <div>
            <strong style="color:rgba(59,130,246,.9);">Hauteur et chaleur :</strong><br>
            Légèrement plus bas que votre register naturel. Pas de voix aiguë ou de questions (intonation montante).<br>
            Chaque phrase se termine en descendant légèrement — comme une invitation, pas un ordre.
            </div>
            <div>
            <strong style="color:rgba(59,130,246,.9);">Ce que vous ne dites pas :</strong><br>
            Pas de "c\'est bien !" comme validation pendant la séance.<br>
            À la place : "Oui... continuez..." "Je suis là... prenez votre temps."<br>
            La validation doit venir du client — pas de vous.
            </div>
            </div>
            <strong>Exercice :</strong> Enregistrez-vous en guidant une respiration. Écoutez.
            Notez : Est-ce que VOUS vous sentiriez en sécurité avec cette voix ?
            </div>'
        );

        $etat_interne = $this->card($purple, 'Leçon 3', 'L\'état interne du praticien — être là vraiment',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            La "présence pleine" n\'est pas un concept de développement personnel.<br>
            C\'est une <strong>compétence technique</strong> qui s\'apprend et se pratique.<br><br>
            <strong>Les 3 niveaux de présence du praticien :</strong><br><br>
            <div style="background:rgba(239,68,68,.07);border-radius:10px;padding:.75rem 1rem;margin:.5rem 0;border-left:3px solid rgba(239,68,68,.4);">
            <strong style="color:rgba(239,68,68,.8);">Niveau 1 — "Je pense à ma technique" :</strong><br>
            Je me demande si j\'ai dit ce qu\'il fallait. Je prépare ma prochaine phrase.<br>
            <em>→ Client sent quelque chose qui "coince". La connexion est froide.</em>
            </div>
            <div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.75rem 1rem;margin:.5rem 0;border-left:3px solid rgba(249,115,22,.4);">
            <strong style="color:rgba(249,115,22,.8);">Niveau 2 — "J\'accompagne" :</strong><br>
            J\'observe, je réagis. Je suis présent au contenu.<br>
            <em>→ Séance correcte. Client avance mais pas de profondeur particulière.</em>
            </div>
            <div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.75rem 1rem;margin:.5rem 0;border-left:3px solid rgba(34,197,94,.4);">
            <strong style="color:rgba(34,197,94,.8);">Niveau 3 — "Nous sommes là" :</strong><br>
            Je ressens le client dans mon propre corps. Je m\'adapte depuis l\'intérieur.<br>
            <em>→ Ce sont les séances dont les clients se souviennent des années après.</em>
            </div>
            <strong>Le contre-transfert corporel :</strong><br>
            Si vous sentez quelque chose de fort pendant la séance d\'un client —<br>
            c\'est de l\'information, pas une distraction.<br>
            Mais votre travail est de le traverser <em>pour lui</em>, pas de vous y perdre.<br><br>
            <em>C\'est pourquoi la supervision régulière n\'est pas un luxe — c\'est une exigence professionnelle.</em>
            </div>'
        );

        $burnout = $this->card($red, 'Leçon 4', 'Burn-out du praticien — repérer les signaux, durer dans le temps',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Les praticiens corporels sont <strong>particulièrement vulnérables au burn-out.</strong><br>
            Vous absorbez des émotions, des tensions, des douleurs. Sans protection, ça accumule.<br><br>
            <div style="display:flex;flex-direction:column;gap:.75rem;margin:.75rem 0;">
            <div style="background:rgba(239,68,68,.08);border-radius:10px;padding:.75rem 1rem;">
            <strong style="color:rgba(239,68,68,.8);">Les 5 signaux d\'alarme précoces :</strong><br>
            ① Appréhension avant les séances (vous qui aimiez ça)<br>
            ② Pensées intrusives sur les clients en dehors des séances<br>
            ③ Fatigue intense après chaque accompagnement<br>
            ④ Sentiment de ne "plus rien avoir à donner"<br>
            ⑤ Irritabilité ou émoussement émotionnel
            </div>
            <div style="background:rgba(34,197,94,.06);border-radius:10px;padding:.75rem 1rem;">
            <strong style="color:rgba(34,197,94,.8);">Les 4 pratiques de protection :</strong><br>
            ① <strong>Rituel de clôture après séance</strong> : se secouer les mains, 3 respirations, se dire "ce n\'est pas ma douleur"<br>
            ② <strong>Limitation du nombre de séances</strong> : maximum 4-5 séances profondes/jour pour la plupart<br>
            ③ <strong>Supervision mensuelle</strong> : avec un professionnel formé à la supervision<br>
            ④ <strong>Sa propre pratique</strong> : vous ne pouvez pas accompagner ce que vous ne faites plus vous-même
            </div>
            <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.75rem 1rem;">
            <strong style="color:rgba(59,130,246,.8);">La règle d\'or :</strong><br>
            Un avion en descente ne peut pas aider les autres passagers.<br>
            <em>Votre propre régulation est votre premier outil thérapeutique.</em>
            </div>
            </div>
            </div>'
        );

        $pratique_presence = $this->card($orange, 'Pratique', 'Rituel de présence — avant, pendant, après',
            '<div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.9rem 1.1rem;border:1px solid rgba(249,115,22,.12);">
            <strong>Avant la séance (2 min) :</strong><br>
            Pieds au sol · 3 respiration 5-5 · Intenion pour ce client<br>
            "Je suis disponible. Ce qui vient peut venir."<br><br>
            <strong>Pendant la séance (continu) :</strong><br>
            Check-in intérieur toutes les 5 min : où est mon corps ?<br>
            Pieds au sol · mâchoire · épaules · respiration<br><br>
            <strong>Après la séance (3 min) :</strong><br>
            Secouer les mains et les bras doucement<br>
            3 expirations longues (vider complètement)<br>
            Se dire mentalement : "Merci. C\'est complété. Je reprends ma propre vie."<br>
            Boire de l\'eau.<br><br>
            <em>Ce rituel n\'est pas symbolique. Il signale à votre système nerveux la fermeture du conteneur thérapeutique.</em>
            </div>'
        );

        $activities = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — La technique ne suffit pas',
                'duration'    => '10 min',
                'description' => 'Pourquoi le thérapeute est l\'outil principal. Les 4 dimensions de la posture. Ce module est une pratique avant d\'être une lecture.',
                'content'     => $intro,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 1 — La présence corporelle',
                'duration'    => '25 min',
                'description' => 'Ancrage · regard doux-présent · distance thérapeutique · rituel des 2 minutes avant séance. Le consentement corporel.',
                'content'     => $presence_physique,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 2 — La voix thérapeutique',
                'duration'    => '20 min',
                'description' => 'Rythme lent · silences comme outil · hauteur descendante · ne pas valider à la place du client. Exercice d\'auto-enregistrement.',
                'content'     => $voix,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 3 — L\'état interne du praticien',
                'duration'    => '25 min',
                'description' => 'Les 3 niveaux de présence. Le contre-transfert corporel. La supervision comme exigence professionnelle.',
                'content'     => $etat_interne,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 4 — Burn-out praticien',
                'duration'    => '20 min',
                'description' => '5 signaux d\'alarme précoces · 4 pratiques de protection · règle d\'or : sa propre régulation en premier.',
                'content'     => $burnout,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Pratique — Rituel de présence avant/pendant/après',
                'duration'    => '15 min',
                'description' => 'Installer le rituel de 2 min (avant) + check-in corps toutes les 5 min (pendant) + clôture de 3 min (après). À pratiquer dès la prochaine séance.',
                'content'     => $pratique_presence,
            ],
            [
                'type'        => 'exercice',
                'title'       => 'Auto-enregistrement voix — 5 minutes de guidance',
                'duration'    => '30 min',
                'description' => 'S\'enregistrer en guidant une cohérence cardiaque. Écouter et noter : rythme · silences · chaleur. Que ressentiriez-vous en tant que client ?',
            ],
        ];

        DB::table('formation_modules')->updateOrInsert(
            ['slug' => '10-la-posture-du-praticien', 'track' => 'praticien'],
            [
                'slug'        => '10-la-posture-du-praticien',
                'title'       => 'La Posture du Praticien — Présence, Voix & Durabilité',
                'week_label'  => 'Module 10',
                'track'       => 'praticien',
                'order'       => 6,
                'is_active'   => true,
                'intro_text'  => "LA POSTURE DU PRATICIEN — Module Praticien 10\n\nMaîtriser la technique est nécessaire. Être présent est indispensable.\n\nCe module couvre les 4 dimensions de la posture : présence corporelle · voix thérapeutique · état interne · durabilité et prévention du burn-out.",
                'description' => 'Ancrage & présence physique · voix thérapeutique (rythme, silences, chaleur) · les 3 niveaux de présence · burn-out praticien (5 signaux, 4 protections) · rituel avant/pendant/après séance.',
                'activities'  => json_encode($activities),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        );

        $this->command->info('[FormationPraticienModule10Seeder] ✓ 7 activités — La Posture du Praticien.');
    }
}
