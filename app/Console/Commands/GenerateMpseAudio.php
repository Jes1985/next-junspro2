<?php

namespace App\Console\Commands;

use App\Services\ElevenLabsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

/**
 * Génère les audios guidés FR et EN de la formation "Ma Pause Souffle"
 * Même architecture que GenerateFormationAudio : ElevenLabs + ffmpeg
 * Fichiers : storage/app/public/formation/audio/mps-{module}-{lang}.mp3
 */
class GenerateMpseAudio extends Command
{
    protected $signature   = 'formation:generate-mps-audio
                                {--module=01 : Module à générer : 01, 02, 03 ou all}
                                {--lang=all  : Langue : fr, en ou all}
                                {--force     : Forcer la régénération}';

    protected $description = 'Génère les audios guidés FR + EN pour Ma Pause Souffle (ElevenLabs + ffmpeg)';

    // ══════════════════════════════════════════════════════════
    //  SCRIPTS FR
    // ══════════════════════════════════════════════════════════

    private array $scriptsFr = [

        '01' => <<<'SCRIPT'
Bienvenue dans ce premier module.
[pause 5s]

Avant de commencer... installez-vous.
[pause 3s]
Assis... allongé... debout... peu importe la posture.
[pause 3s]
Ce qui compte... c'est que vous soyez présent.
[pause 4s]
Ici. Maintenant. Dans ce moment.
[pause 8s]

Ce module a un seul objectif.
[pause 4s]
Vous faire comprendre... en profondeur...
[pause 3s]
pourquoi une méthode aussi simple que le cinq-cinq-cinq...
[pause 3s]
peut changer la façon dont vous habitez votre métier.
[pause 8s]

Pas en théorie.
[pause 4s]
En pratique. Dans votre réalité. Dans votre univers.
[pause 8s]

Commençons par une question.
[pause 5s]

Qu'est-ce que vous faites... quand quelque chose vous dépasse ?
[pause 5s]
Quand le silence devient trop lourd...
[pause 3s]
quand l'énergie s'effondre...
[pause 3s]
quand le corps envoie des signaux que vous ignorez depuis trop longtemps ?
[pause 8s]

La plupart des gens... font une chose.
[pause 4s]
Ils continuent.
[pause 5s]
Ils continuent parce qu'ils ne savent pas quoi faire d'autre.
[pause 4s]
Parce qu'on ne leur a jamais donné un geste précis... universel... immédiatement disponible.
[pause 10s]

Ce geste... c'est la Pause Souffle.
[pause 5s]
Et sa structure... c'est le cinq-cinq-cinq.
[pause 8s]

Cinq secondes pour inspirer.
[pause 4s]
Cinq secondes pour bloquer.
[pause 4s]
Cinq secondes pour expirer.
[pause 8s]

C'est tout.
[pause 5s]
Rien de plus. Rien de moins.
[pause 8s]

Vous vous dites peut-être... c'est trop simple.
[pause 5s]
Et vous avez raison... c'est simple.
[pause 4s]
Mais simple ne veut pas dire superficiel.
[pause 5s]
Simple veut dire... disponible.
[pause 5s]
Simple veut dire... reproductible.
[pause 5s]
Simple veut dire... que vous pouvez le faire... maintenant... ici... dans n'importe quel contexte.
[pause 10s]

Laissez-moi vous expliquer ce qui se passe dans le corps.
[pause 5s]

Quand vous inspirez pendant cinq secondes...
[pause 3s]
vous activez le système nerveux parasympathique.
[pause 4s]
Le cerveau reçoit un signal : il n'y a pas de danger.
[pause 3s]
Le rythme cardiaque commence à ralentir.
[pause 4s]
Les muscles se relâchent légèrement.
[pause 8s]

Quand vous bloquez pendant cinq secondes...
[pause 3s]
vous maximisez l'échange d'oxygène.
[pause 4s]
Le dioxyde de carbone s'accumule juste ce qu'il faut...
[pause 3s]
pour déclencher une vague de calme dans le système nerveux.
[pause 8s]

Quand vous expirez pendant cinq secondes...
[pause 3s]
vous libérez.
[pause 4s]
Pas métaphoriquement. Chimiquement.
[pause 3s]
Le cortisol... l'adrénaline... la tension accumulée...
[pause 3s]
tout ce que le corps porte... commence à se déposer.
[pause 10s]

Et après seulement trois cycles...
[pause 4s]
le corps est dans un autre état.
[pause 5s]
Pas transformé. Pas guéri.
[pause 4s]
Mais disponible.
[pause 5s]
Disponible pour accueillir... pour créer... pour accompagner.
[pause 10s]

Voilà ce qu'est le cinq-cinq-cinq.
[pause 5s]
Un interrupteur neurologique.
[pause 5s]
Un geste qui dit au corps... tu peux poser.
[pause 8s]

Maintenant... parlons de votre univers.
[pause 5s]

C'est le deuxième pilier de cette formation.
[pause 5s]
Le cinq-cinq-cinq ne change pas selon votre métier.
[pause 4s]
Mais l'endroit où vous l'activez... lui... vous appartient entièrement.
[pause 8s]

Le potier l'active entre deux tournages.
[pause 4s]
Avant de toucher l'argile... il s'installe dans le souffle.
[pause 4s]
Les mains deviennent plus douces. La précision augmente.
[pause 8s]

L'enseignante l'active au seuil de la classe.
[pause 4s]
Avant d'entrer... elle fait une Pause Souffle.
[pause 4s]
Ses vingt élèves voient quelqu'un de présent... ancré.
[pause 4s]
Pas quelqu'un d'épuisé qui survit à sa journée.
[pause 8s]

Le manager l'active entre deux réunions.
[pause 4s]
Assis dans le couloir... trente secondes.
[pause 4s]
Il arrive avec une qualité d'attention que ses équipes ressentent.
[pause 8s]

Le soignant l'active avant chaque consultation.
[pause 4s]
Son patient entre dans un espace différent.
[pause 4s]
Un espace où quelqu'un a choisi d'être pleinement là.
[pause 10s]

Ce n'est pas une technique parmi d'autres.
[pause 5s]
C'est une manière d'être... à votre poste.
[pause 8s]

Dans quelques instants... nous allons pratiquer ensemble.
[pause 4s]
Dix cycles complets du cinq-cinq-cinq.
[pause 4s]
Pendant cette pratique... je vous demande une seule chose.
[pause 5s]
Pensez à votre univers.
[pause 4s]
À l'endroit où vous exercez.
[pause 4s]
À la personne que vous êtes... dans votre métier.
[pause 5s]
Laissez cette réalité être présente pendant que vous respirez.
[pause 8s]

Installez-vous.
[pause 4s]
Si vous êtes assis... allongez légèrement le dos.
[pause 3s]
Si vous êtes debout... ancrez vos pieds dans le sol.
[pause 4s]
Posez les épaules.
[pause 3s]
Fermez les yeux... si cela vous convient.
[pause 8s]

Nous commençons.

[BREATHING_CYCLES]

Bien.
[pause 8s]

Rouvrez les yeux... doucement.
[pause 5s]
Prenez un moment pour revenir.
[pause 4s]
Pour sentir l'espace autour de vous.
[pause 4s]
Pour remarquer ce que vous ressentez... maintenant.
[pause 10s]

C'est ça... la Pause Souffle.
[pause 5s]
Pas une méditation de vingt minutes.
[pause 4s]
Pas une session de yoga.
[pause 4s]
Un acte simple... précis... disponible.
[pause 5s]
Que vous pouvez greffer dans votre univers... dès aujourd'hui.
[pause 8s]

Dans les prochains modules... nous allons approfondir.
[pause 4s]
Explorer chaque famille de pratique.
[pause 4s]
Construire votre protocole personnel.
[pause 5s]
Trouver le moment exact... dans votre journée... où cette pause change tout.
[pause 8s]

Pour l'instant... retenez une seule chose.
[pause 5s]
Le souffle... vous appartient déjà.
[pause 5s]
Le cinq-cinq-cinq est juste une façon de lui donner une forme.
[pause 5s]
Et cette forme... elle s'adapte à vous.
[pause 5s]
Pas l'inverse.
[pause 10s]

À très bientôt... pour le module deux.
[pause 6s]
SCRIPT,
        '02' => <<<'SCRIPT'
Bienvenue dans ce deuxième module.
[pause 5s]

Dans le module précédent... vous avez découvert le principe.
[pause 4s]
Le cinq-cinq-cinq.
[pause 3s]
Cinq secondes d'inspiration... cinq secondes de rétention... cinq secondes d'expiration.
[pause 5s]
Un interrupteur neurologique. Un geste disponible.
[pause 8s]

Aujourd'hui... nous allons aller plus loin.
[pause 4s]
Plus précis. Plus personnel.
[pause 5s]
Parce qu'une méthode... même universelle...
[pause 4s]
doit s'ancrer dans votre réalité pour vraiment changer quelque chose.
[pause 8s]

Ce module porte un seul mot.
[pause 5s]
Reconnaissance.
[pause 8s]

Reconnaître... dans quel univers vous êtes.
[pause 4s]
Reconnaître... avec quelles personnes vous travaillez.
[pause 4s]
Reconnaître... le moment exact dans votre journée...
[pause 4s]
où une pause de trente secondes change la qualité de tout ce qui suit.
[pause 10s]

Pour cela... nous avons identifié sept familles de pratique.
[pause 5s]
Pas des catégories rigides.
[pause 4s]
Des territoires. Des paysages.
[pause 4s]
Des endroits où vous pouvez vous reconnaître... sans effort.
[pause 10s]

Écoutez chacune d'entre elles.
[pause 4s]
Laissez résonner.
[pause 4s]
Il n'y a pas de bonne réponse. Il n'y a que votre vérité.
[pause 10s]

La première famille... les Créateurs.
[pause 6s]

Potier... peintre... sculpteur... chanteur... musicien... danseur... artisan.
[pause 5s]
Ceux qui travaillent avec la matière. Avec le geste. Avec l'œuvre.
[pause 5s]
Ceux dont la qualité intérieure... se transfère directement dans ce qu'ils produisent.
[pause 6s]

Pour un créateur... le moment d'activation du cinq-cinq-cinq...
[pause 4s]
c'est avant de toucher la matière.
[pause 5s]
Mains posées. Yeux fermés. Un seul cycle.
[pause 4s]
La question intérieure : qu'est-ce que je veux que cette œuvre traverse ?
[pause 10s]

Ce que ça change... la matière reçoit votre intention avant votre technique.
[pause 5s]
Ceux qui reçoivent votre travail... le sentent.
[pause 5s]
Ils ne peuvent pas l'expliquer.
[pause 4s]
Mais quelque chose dans l'œuvre porte une présence différente.
[pause 10s]

La deuxième famille... les Soignants.
[pause 6s]

Massothérapeute... ostéopathe... psychologue... médecin... infirmier... kinésithérapeute... naturopathe.
[pause 5s]
Ceux dont le travail est l'humain.
[pause 4s]
Ceux qui portent les histoires... les corps... les douleurs de dizaines de personnes chaque semaine.
[pause 6s]

Pour un soignant... le moment d'activation...
[pause 4s]
c'est dans le couloir. Avant d'ouvrir la porte.
[pause 5s]
Trois secondes. Un cycle. Poser la main précédente. Entrer entier.
[pause 5s]
Ou... proposé ensemble au patient en début de séance.
[pause 4s]
Un souffle partagé. Une présence commune. Avant même le premier mot.
[pause 10s]

Ce que ça change... vous ne transférez plus le stress du patient précédent.
[pause 5s]
Chaque personne reçoit votre meilleure présence... pas ce qu'il reste de vous.
[pause 10s]

La troisième famille... les Enseignants.
[pause 6s]

Maternelle... primaire... collège... lycée... université... grandes écoles.
[pause 5s]
Ceux qui tiennent une salle.
[pause 4s]
Ceux dont la qualité d'énergie... définit la qualité des apprentissages.
[pause 5s]
Ceux qui savent... qu'une classe se règle sur son enseignant.
[pause 8s]

Pour un enseignant... le moment d'activation...
[pause 4s]
c'est au seuil de la salle. Avant d'entrer.
[pause 5s]
La main sur la poignée. Un cycle complet. Puis la porte s'ouvre.
[pause 5s]
Vingt... trente élèves... reçoivent quelqu'un d'ancré.
[pause 4s]
Pas quelqu'un d'épuisé qui survit à sa journée.
[pause 10s]

Ce que ça change... la salle se stabilise. L'attention augmente.
[pause 4s]
Pas parce que vous avez haussé la voix...
[pause 4s]
mais parce que vous avez habité le moment avant d'y entrer.
[pause 10s]

La quatrième famille... les Leaders.
[pause 6s]

Chef d'entreprise... manager... cadre... responsable des ressources humaines... coach... consultant... directeur... entrepreneur.
[pause 5s]
Ceux dont les décisions portent.
[pause 4s]
Ceux dont l'état intérieur... influence des équipes entières.
[pause 5s]
Ceux qui n'ont pas le luxe d'être absents à eux-mêmes... même sous pression.
[pause 8s]

Pour un leader... le moment d'activation...
[pause 4s]
c'est entre deux réunions. Dans le couloir. Dans l'ascenseur.
[pause 5s]
Assis trente secondes. Un cycle. Deux si possible.
[pause 4s]
Puis la porte de la salle s'ouvre.
[pause 5s]
Et quelqu'un entre... qui a choisi d'être là... pleinement.
[pause 10s]

Ce que ça change... les décisions prises dans cet état...
[pause 4s]
sont différentes qualitativement de celles prises sous l'adrénaline.
[pause 5s]
Les équipes ressentent la différence. Elles ne peuvent pas l'expliquer non plus.
[pause 10s]

La cinquième famille... les Éducateurs.
[pause 6s]

Formateur... éducateur spécialisé... animateur jeunesse... accompagnateur en développement personnel.
[pause 5s]
Ceux qui travaillent sur la transformation.
[pause 4s]
Ceux qui tiennent un espace pour que quelqu'un d'autre puisse changer.
[pause 5s]
Un espace qui demande de la solidité... de la douceur... et une présence constante.
[pause 8s]

Pour un éducateur... le moment d'activation...
[pause 4s]
c'est avant chaque session. Avant d'accueillir.
[pause 5s]
Un cycle complet. La question silencieuse : qui est cette personne... aujourd'hui... maintenant ?
[pause 4s]
Pas hier. Pas la dernière fois. Aujourd'hui.
[pause 10s]

Ce que ça change... vous arrivez disponible... pas expert.
[pause 4s]
L'autre se sent vu... pas analysé.
[pause 5s]
Et cette différence est immense dans la qualité de l'accompagnement.
[pause 10s]

La sixième famille... les Gardiens du Tout-Petit.
[pause 6s]

Nounous... assistantes maternelles... auxiliaires de puériculture... sages-femmes... puéricultrices.
[pause 5s]
Celles et ceux qui veillent sur les premières heures... les premiers mois... les premières années.
[pause 4s]
Ceux qui portent la vie dans ses formes les plus fragiles.
[pause 4s]
Ceux dont la présence... est le premier ancrage neurologique d'un être humain.
[pause 8s]

Pour les Gardiens du Tout-Petit... le moment d'activation...
[pause 4s]
c'est avant chaque change. Avant chaque biberon. Avant chaque portage qui doit apaiser.
[pause 5s]
Un cycle. Les mains calmes. Le souffle silencieux.
[pause 5s]
Parce qu'un nourrisson ressent votre tension... avant d'entendre votre voix.
[pause 4s]
Parce qu'un tout-petit se règle sur le corps qui le porte.
[pause 4s]
Sur votre rythme cardiaque. Sur votre tonus musculaire. Sur la qualité de votre présence.
[pause 10s]

Ce que ça change... vous offrez à ces enfants... dès le commencement...
[pause 4s]
un système nerveux qui rencontre le calme.
[pause 5s]
Pas une méthode. Pas un protocole.
[pause 4s]
Juste la qualité de votre présence... dans les premiers instants de leur vie.
[pause 5s]
L'ancrage le plus profond qui soit.
[pause 10s]

La septième famille... les Proches.
[pause 6s]

Parents... conjoints... maris... femmes... amis... femmes au foyer... personnes aidantes.
[pause 5s]
Ceux dont le lieu de pratique... c'est la maison.
[pause 4s]
Ceux qui accompagnent les enfants... les partenaires... les membres de leur famille...
[pause 4s]
sans titre... sans protocole... sans séance officielle.
[pause 5s]
Juste la vie. Au quotidien.
[pause 8s]

Pour les Proches... le moment d'activation...
[pause 4s]
c'est l'éclat de voix sur le point d'arriver.
[pause 5s]
C'est le moment où un enfant vous tend sa peur... et vous n'avez plus rien à donner.
[pause 4s]
C'est le soir... quand tout le monde est couché... et que vous êtes encore en tension.
[pause 6s]

Un seul cycle.
[pause 4s]
Pas pour être un parent parfait.
[pause 4s]
Pas pour être le conjoint idéal.
[pause 4s]
Mais pour revenir... juste une seconde... à vous-même.
[pause 5s]
Avant de répondre. Avant de réagir. Avant d'agir.
[pause 10s]

Ce que ça change... la qualité de ce que vous donnez aux vôtres.
[pause 4s]
Un parent qui respire... apprend à son enfant que la paix... c'est possible.
[pause 5s]
Sans le dire. Sans l'enseigner.
[pause 4s]
Juste en le vivant. Devant eux.
[pause 10s]

Voilà les sept familles.
[pause 6s]

Ces sept familles... ce n'est pas une liste close.
[pause 4s]
C'est un miroir.
[pause 5s]
Parce que le cinq-cinq-cinq appartient aussi à ceux qui n'ont pas de titre.
[pause 4s]
À la maman dans la voiture entre l'école et le supermarché.
[pause 4s]
À l'adolescent dans le couloir du lycée.
[pause 4s]
À la personne âgée seule dans son appartement.
[pause 4s]
À toute personne... en vie... qui respire... et qui peut choisir comment.
[pause 10s]

Maintenant... une question.
[pause 5s]
Pendant que vous écoutiez... est-ce qu'une famille vous a arrêté ?
[pause 5s]
Est-ce qu'un portrait vous a touché... vous a reconnu... vous a dit : c'est moi ?
[pause 8s]

Pas besoin de trancher définitivement.
[pause 4s]
Certaines personnes appartiennent à deux familles. À trois.
[pause 4s]
L'essentiel... c'est d'avoir un ancrage.
[pause 5s]
Un territoire concret où le cinq-cinq-cinq prend racine.
[pause 10s]

Dans quelques instants... nous allons pratiquer.
[pause 4s]
Dix cycles complets.
[pause 4s]
Et cette fois... je vous demande de faire quelque chose de précis.
[pause 6s]

Pendant que vous respirez...
[pause 4s]
visualisez le moment d'activation de votre famille.
[pause 5s]
Le couloir avant la porte.
[pause 4s]
Les mains posées sur la matière.
[pause 4s]
Le seuil de la salle.
[pause 4s]
L'ascenseur entre deux réunions.
[pause 4s]
Le silence avant d'accueillir.
[pause 4s]
Les mains calmes avant de porter le tout-petit.
[pause 4s]
La porte de la maison... avant d'entrer.
[pause 8s]

Laissez ce lieu être présent.
[pause 4s]
Laissez cette réalité respirer avec vous.
[pause 8s]

C'est ainsi que le cinq-cinq-cinq devient le vôtre.
[pause 5s]
Pas une technique apprise... mais un geste habité.
[pause 10s]

Installez-vous.
[pause 4s]
Dos allongé. Épaules posées. Pieds ancrés.
[pause 3s]
Si les yeux fermés vous convient... fermez-les.
[pause 8s]

Nous commençons.

[BREATHING_CYCLES]

Bien.
[pause 8s]

Demeurez encore un instant dans cet espace.
[pause 5s]
Sentez le lieu que vous avez visualisé... il vous appartient.
[pause 5s]
Ce n'est pas un exercice mental.
[pause 4s]
C'est un ancrage.
[pause 5s]
Une racine que vous pouvez activer... à n'importe quel moment de votre journée.
[pause 10s]

Rouvrez les yeux... doucement.
[pause 5s]
Prenez un moment pour revenir.
[pause 4s]
Pour mesurer la distance entre l'état d'avant... et celui d'après.
[pause 10s]

Dans le module suivant... nous allons construire votre protocole personnel.
[pause 5s]
Pas un protocole générique.
[pause 4s]
Le vôtre. Avec vos moments. Votre famille. Votre rythme.
[pause 6s]

Pour l'instant... une seule chose à faire avant le prochain module.
[pause 5s]
Activez une fois... dans votre univers réel.
[pause 4s]
Un seul moment. Un seul cycle.
[pause 4s]
Et observez ce que ça change.
[pause 8s]

À très bientôt... pour le module trois.
[pause 6s]
SCRIPT,
    ];

    // ══════════════════════════════════════════════════════════
    //  SCRIPTS EN
    // ══════════════════════════════════════════════════════════

    private array $scriptsEn = [

        '01' => <<<'SCRIPT'
Welcome to this first module.
[pause 5s]

Before we begin... settle in.
[pause 3s]
Sitting... lying down... standing... the posture doesn't matter.
[pause 3s]
What matters... is that you're present.
[pause 4s]
Here. Now. In this moment.
[pause 8s]

This module has a single purpose.
[pause 4s]
To help you understand... deeply...
[pause 3s]
why a method as simple as the five-five-five...
[pause 3s]
can change the way you inhabit your work.
[pause 8s]

Not in theory.
[pause 4s]
In practice. In your reality. In your universe.
[pause 8s]

Let's start with a question.
[pause 5s]

What do you do... when something overwhelms you?
[pause 5s]
When the silence becomes too heavy...
[pause 3s]
when your energy collapses...
[pause 3s]
when your body sends signals you've been ignoring for too long?
[pause 8s]

Most people... do one thing.
[pause 4s]
They keep going.
[pause 5s]
They keep going because they don't know what else to do.
[pause 4s]
Because no one ever gave them a precise... universal... immediately available gesture.
[pause 10s]

That gesture... is the Breathe Break.
[pause 5s]
And its structure... is the five-five-five.
[pause 8s]

Five seconds to breathe in.
[pause 4s]
Five seconds to hold.
[pause 4s]
Five seconds to breathe out.
[pause 8s]

That's all.
[pause 5s]
Nothing more. Nothing less.
[pause 8s]

You might think... that's too simple.
[pause 5s]
And you're right... it is simple.
[pause 4s]
But simple doesn't mean superficial.
[pause 5s]
Simple means... available.
[pause 5s]
Simple means... repeatable.
[pause 5s]
Simple means... you can do it now... here... in any context whatsoever.
[pause 10s]

Let me explain what happens in the body.
[pause 5s]

When you breathe in for five seconds...
[pause 3s]
you activate the parasympathetic nervous system.
[pause 4s]
The brain receives a signal: there is no danger.
[pause 3s]
The heart rate begins to slow.
[pause 4s]
The muscles release slightly.
[pause 8s]

When you hold for five seconds...
[pause 3s]
you maximize the oxygen exchange.
[pause 4s]
Carbon dioxide builds up just enough...
[pause 3s]
to trigger a wave of calm in the nervous system.
[pause 8s]

When you breathe out for five seconds...
[pause 3s]
you let go.
[pause 4s]
Not metaphorically. Chemically.
[pause 3s]
Cortisol... adrenaline... accumulated tension...
[pause 3s]
everything the body has been carrying... begins to settle.
[pause 10s]

And after just three cycles...
[pause 4s]
the body is in a different state.
[pause 5s]
Not transformed. Not healed.
[pause 4s]
But available.
[pause 5s]
Available to welcome... to create... to support others.
[pause 10s]

That is the five-five-five.
[pause 5s]
A neurological switch.
[pause 5s]
A gesture that tells the body... you can put it down.
[pause 8s]

Now... let's talk about your universe.
[pause 5s]

This is the second pillar of this program.
[pause 5s]
The five-five-five doesn't change based on your profession.
[pause 4s]
But where you activate it... that belongs entirely to you.
[pause 8s]

The potter activates it between two throwing sessions.
[pause 4s]
Before touching the clay... they settle into the breath.
[pause 4s]
The hands become softer. Precision increases.
[pause 8s]

The teacher activates it at the classroom threshold.
[pause 4s]
Before entering... one Breathe Break.
[pause 4s]
Twenty students see someone grounded... present.
[pause 4s]
Not someone exhausted just surviving their day.
[pause 8s]

The manager activates it between two meetings.
[pause 4s]
Sitting in the hallway... thirty seconds.
[pause 4s]
They arrive with a quality of attention their team can feel.
[pause 8s]

The caregiver activates it before each appointment.
[pause 4s]
Their patient enters a different space.
[pause 4s]
A space where someone has chosen to be fully there.
[pause 10s]

This is not a technique among others.
[pause 5s]
It's a way of being... at your post.
[pause 8s]

In a few moments... we'll practice together.
[pause 4s]
Ten complete cycles of the five-five-five.
[pause 4s]
During this practice... I ask only one thing of you.
[pause 5s]
Think of your universe.
[pause 4s]
Of the place where you work.
[pause 4s]
Of the person you are... in your field.
[pause 5s]
Let that reality be present while you breathe.
[pause 8s]

Settle in.
[pause 4s]
If you're sitting... gently lengthen your spine.
[pause 3s]
If you're standing... root your feet into the ground.
[pause 4s]
Release your shoulders.
[pause 3s]
Close your eyes... if that feels right.
[pause 8s]

We begin.

[BREATHING_CYCLES]

Good.
[pause 8s]

Open your eyes... gently.
[pause 5s]
Take a moment to come back.
[pause 4s]
To feel the space around you.
[pause 4s]
To notice what you feel... right now.
[pause 10s]

This is the Breathe Break.
[pause 5s]
Not a twenty-minute meditation.
[pause 4s]
Not a yoga session.
[pause 4s]
A simple... precise... available act.
[pause 5s]
That you can bring into your universe... starting today.
[pause 8s]

In the coming modules... we'll go deeper.
[pause 4s]
Explore each family of practice.
[pause 4s]
Build your personal protocol.
[pause 5s]
Find the exact moment... in your day... where this pause changes everything.
[pause 8s]

For now... hold on to one thing.
[pause 5s]
The breath... already belongs to you.
[pause 5s]
The five-five-five is simply a way to give it a shape.
[pause 5s]
And that shape... adapts to you.
[pause 5s]
Not the other way around.
[pause 10s]

See you soon... for module two.
[pause 6s]
SCRIPT,

        '02' => <<<'SCRIPT'
Welcome to this second module.
[pause 5s]

In the previous module... you discovered the principle.
[pause 4s]
The five-five-five.
[pause 3s]
Five seconds to breathe in... five seconds to hold... five seconds to breathe out.
[pause 5s]
A neurological switch. An available gesture.
[pause 8s]

Today... we'll go further.
[pause 4s]
More precise. More personal.
[pause 5s]
Because a method... even a universal one...
[pause 4s]
must be anchored in your reality to truly change something.
[pause 8s]

This module carries a single word.
[pause 5s]
Recognition.
[pause 8s]

Recognizing... which universe you inhabit.
[pause 4s]
Recognizing... with whom you work.
[pause 4s]
Recognizing... the exact moment in your day...
[pause 4s]
where a thirty-second pause changes the quality of everything that follows.
[pause 10s]

To do this... we've identified seven families of practice.
[pause 5s]
Not rigid categories.
[pause 4s]
Territories. Landscapes.
[pause 4s]
Places where you can recognize yourself... effortlessly.
[pause 10s]

Listen to each one.
[pause 4s]
Let them resonate.
[pause 4s]
There is no right answer. There is only your truth.
[pause 10s]

The first family... the Creators.
[pause 6s]

Potter... painter... sculptor... singer... musician... dancer... craftsperson.
[pause 5s]
Those who work with material. With gesture. With the work itself.
[pause 5s]
Those whose inner quality... transfers directly into what they produce.
[pause 6s]

For a Creator... the activation moment of the five-five-five...
[pause 4s]
is before touching the material.
[pause 5s]
Hands resting. Eyes closed. One single cycle.
[pause 4s]
The inner question: what do I want this work to carry?
[pause 10s]

What changes... the material receives your intention before your technique.
[pause 5s]
Those who receive your work... feel it.
[pause 5s]
They can't explain it.
[pause 4s]
But something in the work carries a different presence.
[pause 10s]

The second family... the Caregivers.
[pause 6s]

Massage therapist... osteopath... psychologist... doctor... nurse... physiotherapist... naturopath.
[pause 5s]
Those whose work is the human being.
[pause 4s]
Those who carry the stories... the bodies... the pain of dozens of people each week.
[pause 6s]

For a Caregiver... the activation moment...
[pause 4s]
is in the hallway. Before opening the door.
[pause 5s]
Three seconds. One cycle. Put down the previous hand. Enter whole.
[pause 5s]
Or... offered together to the patient at the start of the session.
[pause 4s]
A shared breath. A common presence. Before even the first word.
[pause 10s]

What changes... you no longer transfer the stress of the previous patient.
[pause 5s]
Each person receives your best presence... not what's left of you.
[pause 10s]

The third family... the Teachers.
[pause 6s]

Primary school... secondary school... university... professional training institutions.
[pause 5s]
Those who hold a room.
[pause 4s]
Those whose energy quality... defines the quality of learning.
[pause 5s]
Those who know... that a class calibrates itself to its teacher.
[pause 8s]

For a Teacher... the activation moment...
[pause 4s]
is at the threshold of the room. Before entering.
[pause 5s]
Hand on the handle. One complete cycle. Then the door opens.
[pause 5s]
Twenty... thirty students... receive someone who is grounded.
[pause 4s]
Not someone exhausted, just surviving their day.
[pause 10s]

What changes... the room stabilizes. Attention increases.
[pause 4s]
Not because you raised your voice...
[pause 4s]
but because you inhabited the moment before entering it.
[pause 10s]

The fourth family... the Leaders.
[pause 6s]

Business owner... manager... executive... HR director... coach... consultant... director... entrepreneur.
[pause 5s]
Those whose decisions carry weight.
[pause 4s]
Those whose inner state... influences entire teams.
[pause 5s]
Those who cannot afford to be absent from themselves... even under pressure.
[pause 8s]

For a Leader... the activation moment...
[pause 4s]
is between two meetings. In the hallway. In the elevator.
[pause 5s]
Sitting for thirty seconds. One cycle. Two if possible.
[pause 4s]
Then the meeting room door opens.
[pause 5s]
And someone enters... who has chosen to be fully there.
[pause 10s]

What changes... decisions made in this state...
[pause 4s]
are qualitatively different from those made under adrenaline.
[pause 5s]
Teams feel the difference. They can't explain it either.
[pause 10s]

The fifth family... the Educators.
[pause 6s]

Trainer... specialist educator... youth worker... personal development facilitator.
[pause 5s]
Those who work on transformation.
[pause 4s]
Those who hold a space so someone else can change.
[pause 5s]
A space that demands steadiness... gentleness... and constant presence.
[pause 8s]

For an Educator... the activation moment...
[pause 4s]
is before each session. Before welcoming someone in.
[pause 5s]
One complete cycle. The silent question: who is this person... today... right now?
[pause 4s]
Not yesterday. Not last time. Today.
[pause 10s]

What changes... you arrive available... not as an expert.
[pause 4s]
The other person feels seen... not analyzed.
[pause 5s]
And that difference is immense in the quality of the support.
[pause 10s]

The sixth family... the Guardians of the Very Young.
[pause 6s]

Childminders... nannies... nursery nurses... midwives... childcare workers in nurseries and maternity wards.
[pause 5s]
Those who watch over the first hours... the first months... the first years.
[pause 4s]
Those who carry life in its most fragile forms.
[pause 4s]
Those whose presence... is the first neurological anchor of a human being.
[pause 8s]

For the Guardians of the Very Young... the activation moment...
[pause 4s]
is before each nappy change. Before each bottle. Before each hold that must soothe.
[pause 5s]
One cycle. Calm hands. A silent breath.
[pause 5s]
Because a newborn feels your tension... before hearing your voice.
[pause 4s]
Because a small child calibrates to the body that holds them.
[pause 4s]
To your heartbeat. To your muscle tone. To the quality of your presence.
[pause 10s]

What changes... you offer these children... from the very beginning...
[pause 4s]
a nervous system that meets calm.
[pause 5s]
Not a method. Not a protocol.
[pause 4s]
Just the quality of your presence... in the first moments of their life.
[pause 5s]
The deepest anchor there is.
[pause 10s]

The seventh family... the Close Ones.
[pause 6s]

Parents... partners... husbands... wives... friends... homemakers... family caregivers.
[pause 5s]
Those whose place of practice... is home.
[pause 4s]
Those who support their children... their partners... their family members...
[pause 4s]
without a title... without a protocol... without an official session.
[pause 5s]
Just life. Every day.
[pause 8s]

For the Close Ones... the activation moment...
[pause 4s]
is the outburst that's about to happen.
[pause 5s]
It's the moment a child hands you their fear... and you have nothing left to give.
[pause 4s]
It's the evening... after everyone's in bed... and you're still holding tension.
[pause 6s]

One single cycle.
[pause 4s]
Not to be a perfect parent.
[pause 4s]
Not to be the ideal partner.
[pause 4s]
But to come back... just for a second... to yourself.
[pause 5s]
Before answering. Before reacting. Before acting.
[pause 10s]

What changes... the quality of what you give to those you love.
[pause 4s]
A parent who breathes... teaches their child that peace is possible.
[pause 5s]
Without saying it. Without teaching it.
[pause 4s]
Just by living it. In front of them.
[pause 10s]

Those are the seven families.
[pause 6s]

These seven families... this is not a closed list.
[pause 4s]
It's a mirror.
[pause 5s]
Because the five-five-five belongs to those without a title too.
[pause 4s]
To the mother in the car between school drop-off and the supermarket.
[pause 4s]
To the teenager in the school hallway.
[pause 4s]
To the elderly person alone in their home.
[pause 4s]
To every person... alive... who breathes... and who can choose how.
[pause 10s]

Now... a question.
[pause 5s]
As you were listening... did one family stop you?
[pause 5s]
Did one portrait touch you... recognize you... say: that's me?
[pause 8s]

No need to make a definitive choice.
[pause 4s]
Some people belong to two families. Or three.
[pause 4s]
What matters... is having an anchor.
[pause 5s]
A concrete territory where the five-five-five takes root.
[pause 10s]

In a few moments... we'll practice.
[pause 4s]
Ten complete cycles.
[pause 4s]
And this time... I'm asking you to do something specific.
[pause 6s]

While you breathe...
[pause 4s]
visualize the activation moment of your family.
[pause 5s]
The hallway before the door.
[pause 4s]
Hands resting on the material.
[pause 4s]
The threshold of the room.
[pause 4s]
The elevator between two meetings.
[pause 4s]
The silence before welcoming someone in.
[pause 4s]
Calm hands before holding the newborn.
[pause 4s]
The front door... before stepping inside.
[pause 8s]

Let that place be present.
[pause 4s]
Let that reality breathe with you.
[pause 8s]

This is how the five-five-five becomes yours.
[pause 5s]
Not a learned technique... but an inhabited gesture.
[pause 10s]

Settle in.
[pause 4s]
Lengthen your spine. Release your shoulders. Root your feet.
[pause 3s]
Close your eyes... if that feels right.
[pause 8s]

We begin.

[BREATHING_CYCLES]

Good.
[pause 8s]

Stay a moment longer in this space.
[pause 5s]
Feel the place you visualized... it belongs to you.
[pause 5s]
This is not a mental exercise.
[pause 4s]
It's an anchor.
[pause 5s]
A root you can activate... at any moment in your day.
[pause 10s]

Open your eyes... gently.
[pause 5s]
Take a moment to return.
[pause 4s]
To measure the distance between the state before... and the one after.
[pause 10s]

In the next module... we'll build your personal protocol.
[pause 5s]
Not a generic protocol.
[pause 4s]
Yours. With your moments. Your family. Your rhythm.
[pause 6s]

For now... one thing to do before the next module.
[pause 5s]
Activate once... in your real universe.
[pause 4s]
One moment. One cycle.
[pause 4s]
And notice what changes.
[pause 8s]

See you soon... for module three.
[pause 6s]
SCRIPT,

    ];

    // ══════════════════════════════════════════════════════════
    //  HANDLE
    // ══════════════════════════════════════════════════════════

    public function handle(): int
    {
        $this->info('🎙  Génération audio Ma Pause Souffle — ElevenLabs (Natasha)...');
        $this->newLine();

        $elevenLabs = new ElevenLabsService();
        Storage::disk('public')->makeDirectory('formation/audio');

        $moduleFilter = $this->option('module') ?? 'all';
        $langFilter   = $this->option('lang')   ?? 'all';
        $force        = (bool) $this->option('force');

        $modules = ($moduleFilter === 'all')
            ? array_keys(array_merge($this->scriptsFr, $this->scriptsEn))
            : [$moduleFilter];
        $modules = array_unique($modules);

        $langs = match($langFilter) {
            'fr'    => ['fr'],
            'en'    => ['en'],
            default => ['fr', 'en'],
        };

        foreach ($modules as $mod) {
            foreach ($langs as $lang) {
                $script = ($lang === 'fr')
                    ? ($this->scriptsFr[$mod] ?? null)
                    : ($this->scriptsEn[$mod] ?? null);

                if (!$script) {
                    $this->warn("  ⚠  Pas de script [{$lang}] module {$mod} — ignoré.");
                    continue;
                }

                $audioPath = "formation/audio/mps-{$mod}-{$lang}.mp3";

                if (!$force && Storage::disk('public')->exists($audioPath)) {
                    $this->line("  ⏭  [{$lang}] mps-{$mod} — déjà présent, utilisez --force pour régénérer.");
                    continue;
                }

                $this->line("  🔄  [{$lang}] mps-{$mod} — génération en cours...");

                try {
                    $mp3 = $this->buildFromScript($script, $elevenLabs, $lang);
                    Storage::disk('public')->put($audioPath, $mp3);
                    $this->info("  ✅  [{$lang}] mps-{$mod} → {$audioPath}");
                } catch (\Exception $e) {
                    $this->error("  ❌  [{$lang}] mps-{$mod} : " . $e->getMessage());
                    return self::FAILURE;
                }
            }
        }

        $this->newLine();
        $this->info('Terminé. Vérifiez storage:link si nécessaire.');

        return self::SUCCESS;
    }

    // ══════════════════════════════════════════════════════════
    //  Méthodes internes (même logique que GenerateFormationAudio)
    // ══════════════════════════════════════════════════════════

    private function buildFromScript(string $script, ElevenLabsService $elevenLabs, string $lang): string
    {
        $tmp     = sys_get_temp_dir();
        $id      = uniqid('mps_');
        $cleanup = [];
        $allParts = [];

        try {
            $hasBreathing = str_contains($script, '[BREATHING_CYCLES]');

            if ($hasBreathing) {
                [$introRaw, $outroRaw] = array_map('trim', explode('[BREATHING_CYCLES]', $script, 2));
            } else {
                $introRaw = trim($script);
                $outroRaw = null;
            }

            $allParts = array_merge($allParts, $this->scriptToFiles($introRaw, $elevenLabs, $tmp, $id . '_a', $cleanup, $lang));

            if ($hasBreathing) {
                $allParts = array_merge($allParts, $this->breathingFiles($elevenLabs, $tmp, $id, $cleanup, $lang));
            }

            if ($outroRaw) {
                $allParts = array_merge($allParts, $this->scriptToFiles($outroRaw, $elevenLabs, $tmp, $id . '_b', $cleanup, $lang));
            }

            $finalMp3  = "{$tmp}/{$id}_final.mp3";
            $cleanup[] = $finalMp3;
            $this->ffmpegConcat($allParts, $finalMp3, $tmp, $id);

            if (!file_exists($finalMp3) || filesize($finalMp3) < 1000) {
                throw new \Exception('buildFromScript : ffmpeg n\'a pas produit de fichier valide.');
            }

            return file_get_contents($finalMp3);

        } finally {
            foreach ($cleanup as $f) {
                if (file_exists($f)) @unlink($f);
            }
        }
    }

    private function scriptToFiles(string $script, ElevenLabsService $elevenLabs, string $tmp, string $id, array &$cleanup, string $lang = 'fr'): array
    {
        $parts    = [];
        $silCache = [];
        $idx      = 0;
        $buffer   = '';
        $MIN_SIL  = 4.0;
        $langCode = $lang === 'en' ? 'en' : 'fr';

        $segments = preg_split('/\[pause\s*(\d+(?:\.\d+)?)s\]/', $script, -1, PREG_SPLIT_DELIM_CAPTURE);

        $flush = function () use (&$buffer, &$parts, &$idx, &$cleanup, $tmp, $id, $elevenLabs, $langCode) {
            $clean = trim(preg_replace('/[ \t]{2,}/', ' ', $buffer));
            if ($clean === '') { $buffer = ''; return; }
            $f = "{$tmp}/{$id}_t{$idx}.mp3";
            file_put_contents($f, $elevenLabs->textToSpeech($clean, ElevenLabsService::DEFAULT_VOICE_ID, 0.88, 0.75, 0.0, $langCode));
            $parts[]   = $f;
            $cleanup[] = $f;
            $idx++;
            $buffer = '';
            sleep(1);
        };

        $isValue = true;
        foreach ($segments as $seg) {
            if ($isValue) {
                $buffer .= $seg;
            } else {
                $dur = (float) $seg;
                if ($dur >= $MIN_SIL) {
                    $flush();
                    $key = (int) round($dur);
                    if (!isset($silCache[$key])) {
                        $f = "{$tmp}/{$id}_sil{$key}s.mp3";
                        exec(sprintf('ffmpeg -y -f lavfi -i anullsrc=r=24000:cl=mono -t %d -codec:a libmp3lame -q:a 4 %s 2>&1', $key, escapeshellarg($f)));
                        $cleanup[]      = $f;
                        $silCache[$key] = $f;
                    }
                    $parts[] = $silCache[$key];
                } else {
                    $dots = str_repeat('.', max(2, (int) round($dur / 0.4)));
                    $buffer .= ' ' . $dots . ' ';
                }
            }
            $isValue = !$isValue;
        }
        $flush();

        return $parts;
    }

    private function breathingFiles(ElevenLabsService $elevenLabs, string $tmp, string $id, array &$cleanup, string $lang = 'fr'): array
    {
        $inspireS = 5;
        $blockS   = 5;
        $expireS  = 6;
        $leadIn   = 8;
        $trailOut = 10;
        $cycles   = 10;

        $wordMaps = [
            'fr' => [
                'inspirez'     => 'Inspirez... doucement.',
                'bloquez'      => 'Bloquez.',
                'expirez'      => 'Expirez... laissez aller.',
                'derniere'     => 'Dernière inspiration... doucement.',
                'expirez_lent' => 'Expirez... lentement.',
            ],
            'en' => [
                'inspirez'     => 'Breathe in... slowly.',
                'bloquez'      => 'Hold.',
                'expirez'      => 'Breathe out... let go.',
                'derniere'     => 'Last breath in... slowly.',
                'expirez_lent' => 'Breathe out... slowly.',
            ],
        ];

        $wordMap  = $wordMaps[$lang] ?? $wordMaps['fr'];
        $langCode = $lang === 'en' ? 'en' : 'fr';

        $wordFiles = [];
        foreach ($wordMap as $key => $text) {
            $f = "{$tmp}/{$id}_br_{$key}.mp3";
            file_put_contents($f, $elevenLabs->textToSpeech($text, ElevenLabsService::DEFAULT_VOICE_ID, 0.88, 0.75, 0.0, $langCode));
            $wordFiles[$key] = $f;
            $cleanup[]       = $f;
            sleep(1);
        }

        $silDurs  = array_unique([$leadIn, $inspireS, $blockS, $expireS, $trailOut]);
        $silFiles = [];
        foreach ($silDurs as $dur) {
            $f = "{$tmp}/{$id}_brsil{$dur}s.mp3";
            exec(sprintf('ffmpeg -y -f lavfi -i anullsrc=r=24000:cl=mono -t %d -codec:a libmp3lame -q:a 4 %s 2>&1', $dur, escapeshellarg($f)));
            $silFiles[$dur] = $f;
            $cleanup[]      = $f;
        }

        $parts = [$silFiles[$leadIn]];
        for ($i = 1; $i <= $cycles; $i++) {
            $isLast  = ($i === $cycles);
            $parts[] = $isLast ? $wordFiles['derniere']     : $wordFiles['inspirez'];
            $parts[] = $silFiles[$inspireS];
            $parts[] = $wordFiles['bloquez'];
            $parts[] = $silFiles[$blockS];
            $parts[] = $isLast ? $wordFiles['expirez_lent'] : $wordFiles['expirez'];
            $parts[] = $isLast ? $silFiles[$trailOut]       : $silFiles[$expireS];
        }

        return $parts;
    }

    private function ffmpegConcat(array $files, string $outFile, string $tmp, string $id): void
    {
        $listFile = "{$tmp}/{$id}_list.txt";
        $lines    = [];
        foreach ($files as $f) {
            if ($f && file_exists($f)) {
                $lines[] = "file '" . str_replace(['\\', "'"], ['/', "\\'"], $f) . "'";
            }
        }
        file_put_contents($listFile, implode("\n", $lines));
        exec(sprintf(
            'ffmpeg -y -f concat -safe 0 -i %s -codec:a libmp3lame -q:a 2 %s 2>&1',
            escapeshellarg($listFile),
            escapeshellarg($outFile)
        ));
        @unlink($listFile);
    }
}
