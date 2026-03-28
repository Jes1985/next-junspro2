<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * MODULE 06 — J'incarne ma Vision — Clarté, Courage & Discipline
 * Arc pédagogique : vision incarnée · obstacle intérieur · crédibilité par les preuves
 *                   protocole Pause Souffle 5-5-5 appliqué à la vision
 *                   discipline d'intégration · pont vers la maîtrise praticien (Module 08)
 * Position : Module final du Parcours — dernier module avant Formation Praticien
 */
class FormationModule06VisualisationSeeder extends Seeder
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

        $intro = $this->card($gold, 'Promesse', 'Ce module donne à votre vision une tenue intérieure',
            '<div style="font-size:.88rem;line-height:2.1;color:rgba(232,224,208,.82);">
            Vous avez appris à écouter votre corps, à reconnaître vos blessures, à sentir ce qui vous rend vivant·e, à rencontrer votre souffle, à entendre votre mission.<br><br>
            Il reste maintenant une question plus exigeante que l\'inspiration elle-même :<br><br>
            <strong>comment faire d\'une vision une direction suffisamment juste pour qu\'elle change réellement une vie ?</strong><br><br>
            Beaucoup savent désirer.<br>
            Peu savent <strong>tenir une direction</strong> avec assez de clarté, de courage et de constance pour qu\'elle transforme le quotidien.<br><br>
            Ce module n\'est ni un collage d\'intentions, ni un exercice de pensée positive.<br>
            C\'est un travail de justesse intérieure : clarifier la scène juste, reconnaître ce qui la contrarie, produire des preuves fines, installer une discipline élégante et tenable.<br><br>
            Gabriele Oettingen a montré qu\'une vision devient féconde lorsqu\'elle rencontre l\'obstacle intérieur réel.<br>
            Maxwell Maltz rappelait qu\'une image mentale n\'agit qu\'à la mesure de sa compatibilité avec l\'image que l\'on a de soi.<br><br>
            Ici, vous reliez ces deux dimensions à la méthode Pause Souffle 5-5-5.<br>
            Non pour rêver plus fort.<br>
            Pour devenir plus aligné·e, plus lisible, plus habité·e.<br><br>
            <em style="color:rgba(201,168,76,.8);">Le Module 08 de la Formation Praticien vous emmènera ensuite vers la maîtrise immersive et la transmission à l\'autre.</em>
            </div>'
        );

        $vision = $this->card($teal, 'Leçon 1', 'La vision incarnée — une direction qui se laisse habiter',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Une vraie vision n\'est pas une liste d\'envies.<br>
            C\'est une scène intérieure suffisamment claire pour réorienter votre attention, votre corps et vos décisions.<br><br>
            <strong style="color:rgba(20,184,166,.9);">Les 3 critères d\'une vision habitable :</strong><br><br>
            <div style="background:rgba(20,184,166,.07);border-radius:10px;padding:.85rem 1.1rem;display:flex;flex-direction:column;gap:.75rem;margin:.75rem 0;">
            <div><strong>① Elle est située</strong><br>Où êtes-vous ? Avec qui ? Dans quel rythme de vie ? Dans quelle qualité d\'espace ?</div>
            <div><strong>② Elle est ressentie</strong><br>Que se passe-t-il dans votre poitrine, votre ventre, votre visage, votre posture lorsque vous habitez cette scène ?</div>
            <div><strong>③ Elle appelle une conduite</strong><br>Une vision juste ne laisse pas immobile. Elle suggère une manière plus nette de parler, de choisir, d\'habiter vos journées.</div>
            </div>
            <strong style="color:rgba(20,184,166,.9);">L\'erreur la plus fréquente :</strong><br>
            visualiser des résultats sans visualiser <em>la personne capable de les soutenir</em>.<br><br>
            Ici, vous ne cherchez pas seulement ce que vous voulez.<br>
            Vous cherchez <strong>qui vous devenez quand cela devient vrai</strong>.<br><br>
            Un support visuel peut aider : carnet, image, moodboard, note vocale, page écrite.<br>
            Mais le cœur du travail n\'est pas le support. Le cœur du travail, c\'est la qualité d\'état intérieur qu\'il déclenche.
            </div>'
        );

        $obstacle = $this->card($purple, 'Leçon 2', 'L\'obstacle intérieur — ce qui dévie la trajectoire sans bruit',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Penser positivement ne suffit pas.<br>
            Quand une vision reste lointaine, instable ou sans effet durable, c\'est souvent qu\'un obstacle intérieur n\'a pas encore été nommé.<br><br>
            <strong style="color:rgba(168,85,247,.9);">La méthode WOOP, simplifiée pour Pause Souffle :</strong><br><br>
            <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.85rem 1.1rem;display:flex;flex-direction:column;gap:.75rem;margin:.75rem 0;">
            <div><strong>W · Wish</strong> : quelle direction vous appelle vraiment ?</div>
            <div><strong>O · Outcome</strong> : qu\'est-ce que cela change concrètement dans votre vie et dans votre corps ?</div>
            <div><strong>O · Obstacle</strong> : qu\'est-ce qui, en vous, vous éloigne le plus souvent de cette direction ?</div>
            <div><strong>P · Plan</strong> : quand cet obstacle revient, que faites-vous immédiatement ?</div>
            </div>
            <strong>Les obstacles intérieurs les plus fréquents :</strong><br>
            · La dispersion : tout vouloir à la fois<br>
            · Le doute d\'identité : "ce n\'est pas vraiment pour moi"<br>
            · La culpabilité de réussir ou d\'être vu·e<br>
            · L\'habitude du report : attendre d\'être prêt·e<br>
            · La fidélité inconsciente à l\'ancien soi<br><br>
            <div style="background:rgba(201,168,76,.08);border-radius:10px;padding:.8rem 1rem;border:1px solid rgba(201,168,76,.16);">
            <strong style="color:rgba(201,168,76,.9);">Question-clé :</strong><br>
            "Quand ma vision devient proche, qu\'est-ce que je fais pour la tenir à distance ?"
            </div><br>
            La tenue d\'une vision dépend moins de son intensité que de votre capacité à répondre à cette question avec honnêteté.
            </div>'
        );

        $preuves = $this->card($blue, 'Leçon 3', 'Des images aux preuves — installer la crédibilité intérieure',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Une vision devient crédible quand elle commence à laisser des traces dans le réel.<br>
            Ce sont ces traces qui recalibrent l\'image de soi et apaisent la distance entre ce que l\'on désire et ce que l\'on croit possible.<br><br>
            <strong style="color:rgba(59,130,246,.9);">Le principe :</strong><br>
            ne pas attendre la grande preuve finale.<br>
            Chercher des <strong>preuves intermédiaires</strong> : un geste, une décision, une synchronicité, une action tenue, une peur traversée.<br><br>
            <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.85rem 1.1rem;display:flex;flex-direction:column;gap:.75rem;margin:.75rem 0;">
            <div><strong>① La preuve comportementale</strong><br>Je pose aujourd\'hui un acte qu\'aurait posé la version accomplie de moi.</div>
            <div><strong>② La preuve environnementale</strong><br>Je transforme un détail visible de mon espace pour qu\'il soutienne ma direction.</div>
            <div><strong>③ La preuve relationnelle</strong><br>J\'ose une parole, une demande, une limite ou une présence nouvelle.</div>
            <div><strong>④ La preuve symbolique</strong><br>Je remarque les signes concrets qui confirment que mon attention change réellement.</div>
            </div>
            <strong>Le journal de preuves :</strong><br>
            chaque soir, notez seulement 3 lignes :<br>
            · ce que j\'ai visualisé<br>
            · l\'obstacle rencontré aujourd\'hui<br>
            · la preuve, même minuscule, que quelque chose bouge<br><br>
            <em>Les preuves fines, répétées et tenues transforment plus durablement qu\'un grand moment isolé.</em>
            </div>'
        );

        $pratique = $this->card($orange, 'Pratique', 'Le protocole Pause Souffle 5-5-5 — Clarifier, rencontrer, ancrer',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            Vous connaissez déjà le souffle 5-5-5.<br>
            Ici, vous l\'utilisez pour relier vision, obstacle et action.<br><br>
            <strong style="color:rgba(249,115,22,.9);">Le protocole en 4 temps :</strong><br><br>
            <div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.85rem 1.1rem;display:flex;flex-direction:column;gap:.8rem;margin:.75rem 0;">
            <div><strong>① Inspirer · Je clarifie la scène</strong><br>5 secondes. J\'entre dans la scène la plus juste de ma vision et je m\'y installe.</div>
            <div><strong>② Retenir · Je ressens l\'état</strong><br>5 secondes. Je laisse monter l\'émotion exacte : paix, fierté, gratitude, clarté.</div>
            <div><strong>③ Expirer · Je regarde l\'obstacle</strong><br>5 secondes. J\'observe sans jugement ce qui, d\'habitude, me fait reculer.</div>
            <div><strong>④ Reprendre · J\'ancre le plan</strong><br>Au souffle suivant, je nomme une action simple : "si l\'obstacle revient, alors je fais cela".</div>
            </div>
            Faites 5 cycles complets.<br>
            Pas plus. Mais avec exactitude, chaque jour pendant une semaine.<br><br>
            <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(249,115,22,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
            🎙 <strong style="color:rgba(249,115,22,.8);">Script audio ElevenLabs ·</strong>
            <em>"Inspirez et entrez dans la scène. Retenez et sentez qui vous devenez ici. Expirez et regardez avec douceur ce qui vous freine d\'habitude. Au souffle suivant, choisissez votre réponse. Une seule. Simple. Faisable. Répétez. Votre vision cesse d\'être une image. Elle devient une tenue intérieure."</em>
            </div>
            </div>'
        );

        $mission = $this->card($green, 'Mission', '7 jours pour donner de la tenue à votre vision',
            '<div style="font-size:.88rem;line-height:2.2;color:rgba(232,224,208,.82);">
            <strong>Votre mission n\'est pas de rêver plus fort.</strong><br>
            Votre mission est de rendre votre vision crédible pour votre corps, votre esprit et votre quotidien.<br><br>
            <strong style="color:rgba(34,197,94,.9);">Le protocole des 7 jours :</strong><br><br>
            <div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.85rem 1.1rem;display:flex;flex-direction:column;gap:.75rem;margin:.75rem 0;">
            <div><strong>Jour 1</strong><br>J\'écris ma scène de vision en 10 lignes maximum.</div>
            <div><strong>Jour 2</strong><br>J\'identifie mon obstacle intérieur principal et sa forme concrète.</div>
            <div><strong>Jour 3</strong><br>Je définis mon plan de réponse : "si ..., alors ...".</div>
            <div><strong>Jour 4</strong><br>Je transforme un détail de mon environnement pour soutenir ma direction.</div>
            <div><strong>Jour 5</strong><br>Je pose une action visible que l\'ancien moi aurait évitée.</div>
            <div><strong>Jour 6</strong><br>Je note trois preuves réelles que mon attention a changé.</div>
            <div><strong>Jour 7</strong><br>Je relis tout et je choisis mon rituel de maintien pour les 21 prochains jours.</div>
            </div>
            Support libre : carnet, feuille, tableau, document, note vocale, collage visuel si cela vous aide.<br>
            Le support n\'est pas l\'objectif. Il est simplement au service de l\'incarnation.<br><br>
            <div style="background:rgba(99,102,241,.07);border-radius:10px;padding:.85rem 1.1rem;border:1px solid rgba(99,102,241,.15);">
            <strong style="color:rgba(99,102,241,.8);">Pont vers la suite</strong><br><br>
            Dans la Formation Praticien, le Module 08 vous apprendra à aller plus loin :<br>
            · immersion sensorielle complète<br>
            · discipline sur 66 jours<br>
            · posture de version accomplie<br>
            · transmission de la visualisation en séance<br><br>
            <em style="color:rgba(201,168,76,.8);">Ici, vous donnez de la tenue à votre vision. Là-bas, vous apprendrez à la maîtriser et à la transmettre.</em>
            </div>
            </div>'
        );

        $activities = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — La vision qui prend tenue',
                'duration'    => '5 min',
                'description' => 'Pourquoi ce module n\'est ni un simple exercice de pensée positive, ni un tableau de plus. Vision, obstacle intérieur, image de soi et méthode Pause Souffle 5-5-5.',
                'content'     => $intro,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 1 — La vision incarnée',
                'duration'    => '8 min',
                'description' => 'Transformer une envie floue en direction habitable. Les 3 critères : située, ressentie, conductrice de choix.',
                'content'     => $vision,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 2 — L\'obstacle intérieur',
                'duration'    => '10 min',
                'description' => 'WOOP adapté à Pause Souffle : wish, outcome, obstacle, plan. Identifier ce qui dévie la trajectoire de l\'intérieur.',
                'content'     => $obstacle,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Leçon 3 — Des images aux preuves',
                'duration'    => '8 min',
                'description' => 'Installer la crédibilité intérieure par des preuves intermédiaires : comportementales, environnementales, relationnelles, symboliques.',
                'content'     => $preuves,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Pratique — Le protocole 5-5-5 vision, obstacle, action',
                'duration'    => '15 min',
                'description' => 'Utiliser le souffle Pause Souffle pour clarifier la vision, ressentir l\'état, rencontrer l\'obstacle et ancrer une réponse simple.',
                'content'     => $pratique,
            ],
            [
                'type'        => 'exercice',
                'title'       => 'Mission — 7 jours pour donner de la tenue à ma vision',
                'duration'    => '7 jours',
                'description' => 'Une séquence progressive pour écrire sa vision, nommer l\'obstacle, installer un plan, obtenir des preuves et choisir un rituel de maintien.',
                'content'     => $mission,
            ],
        ];

        DB::table('formation_modules')
            ->where('slug', '06-je-visualise-ma-vie')
            ->update([
                'title'       => "J'incarne ma Vision — Clarté, Courage & Discipline",
                'week_label'  => 'Semaine 7',
                'intro_text'  => "Vous avez appris à écouter votre corps, à reconnaître vos blessures, à sentir ce qui vous rend vivant·e, à rencontrer votre souffle, à entendre votre mission.\n\nIl reste maintenant une question plus exigeante que l'inspiration elle-même : comment faire d'une vision une direction suffisamment juste pour qu'elle change réellement une vie ?\n\nCe module n'est ni un collage d'intentions, ni un exercice de pensée positive. C'est un travail de justesse intérieure : clarifier la scène juste, reconnaître ce qui la contrarie, produire des preuves fines, installer une discipline élégante et tenable.\n\nIci, vous reliez la vision, l'obstacle intérieur et l'image de soi à la méthode Pause Souffle 5-5-5. Non pour rêver plus fort. Pour devenir plus aligné·e, plus lisible, plus habité·e.\n\nLe Module 08 de la Formation Praticien vous emmènera ensuite vers la maîtrise immersive et la transmission à l'autre.",
                'description' => '3 leçons + 2 pratiques · Vision incarnée · Obstacle intérieur (WOOP) · Crédibilité intérieure par les preuves · Protocole Pause Souffle 5-5-5 appliqué · Mission de 7 jours pour donner de la tenue à sa vision.',
                'activities'  => json_encode($activities),
                'updated_at'  => now(),
            ]);

        $this->command->info('[FormationModule06VisualisationSeeder] ✓ 6 activités — J\'incarne ma Vision · Module 06 Parcours.');
    }
}
