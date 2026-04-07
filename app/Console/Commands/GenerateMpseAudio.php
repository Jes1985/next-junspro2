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

        '03' => <<<'SCRIPT'
Bienvenue dans ce troisième module.
[pause 5s]

Vous êtes arrivé ici.
[pause 4s]
Ce n'est pas anodin.
[pause 5s]
Cela veut dire que quelque chose a résonné.
[pause 4s]
Que le cinq-cinq-cinq a trouvé en vous... un endroit où s'ancrer.
[pause 8s]

Dans le premier module... vous avez compris le mécanisme.
[pause 4s]
Un interrupteur neurologique. Un geste disponible.
[pause 5s]
Dans le deuxième module... vous avez reconnu votre territoire.
[pause 4s]
Une famille. Une réalité. Un paysage dans lequel vous vous reconnaissez.
[pause 8s]

Ce troisième module porte un seul mot.
[pause 5s]
Protocole.
[pause 8s]

Pas une routine rigide.
[pause 4s]
Pas une liste de choses à faire.
[pause 5s]
Pas une discipline supplémentaire à ajouter à une journée déjà chargée.
[pause 8s]

Un protocole... au sens premier du terme...
[pause 4s]
c'est une architecture.
[pause 5s]
Une série de gestes pensés... placés aux bons endroits...
[pause 4s]
qui permettent à quelque chose d'essentiel de se produire...
[pause 4s]
sans effort... sans négociation... sans décision à prendre dans le moment.
[pause 10s]

Votre protocole personnel de Pause Souffle...
[pause 4s]
c'est la réponse à une seule question.
[pause 6s]

Quand... exactement... dans ma journée...
[pause 4s]
est-ce que j'active le cinq-cinq-cinq ?
[pause 10s]

Parce qu'une méthode sans moment précis... reste une intention.
[pause 5s]
Et une intention... même la plus sincère...
[pause 4s]
disparaît sous la pression du quotidien.
[pause 5s]
Sous les urgences. Sous les imprévus. Sous la fatigue.
[pause 8s]

Pour qu'un geste devienne un ancrage réel...
[pause 4s]
il doit être attaché à quelque chose qui existe déjà dans votre journée.
[pause 5s]
Pas à une heure abstraite.
[pause 4s]
À un événement concret.
[pause 5s]
Un déclencheur qui dit au corps : c'est maintenant.
[pause 10s]

Nous allons construire votre protocole autour de trois piliers.
[pause 6s]

Le premier pilier... l'ancrage du matin.
[pause 8s]

Le matin porte une qualité unique.
[pause 5s]
Avant que le flux commence... avant les messages... avant les décisions...
[pause 4s]
il y a un espace.
[pause 5s]
Court. Souvent ignoré.
[pause 4s]
Mais réel.
[pause 8s]

Cet espace... c'est le vôtre.
[pause 5s]
Un seul cycle du cinq-cinq-cinq.
[pause 4s]
Avant de regarder votre téléphone.
[pause 4s]
Avant le premier café.
[pause 4s]
Avant d'ouvrir la première application.
[pause 8s]

Pas cinq minutes. Pas dix.
[pause 4s]
Quinze secondes.
[pause 5s]
Un souffle d'intention.
[pause 5s]
Un geste qui dit au système nerveux : aujourd'hui... je choisis ma présence.
[pause 10s]

Certaines personnes l'activent au réveil.
[pause 4s]
Avant même de poser les pieds au sol.
[pause 5s]
Le corps encore dans le demi-sommeil... la journée pas encore commencée.
[pause 4s]
Un cycle. Les yeux fermés. Le souffle lent.
[pause 5s]
Et quelque chose se pose... avant même que rien n'ait commencé.
[pause 10s]

D'autres l'activent sous la douche.
[pause 4s]
Dans le silence chaud de l'eau.
[pause 5s]
Un cycle entre le savon et le rinçage.
[pause 4s]
Le bruit du monde tenu à distance encore quelques secondes.
[pause 8s]

D'autres encore... l'activent dans la voiture.
[pause 4s]
Avant de démarrer.
[pause 5s]
Assis. Ceinture bouclée. Moteur éteint encore une dizaine de secondes.
[pause 4s]
Les deux mains sur le volant.
[pause 4s]
Un cycle.
[pause 5s]
Puis démarrer.
[pause 10s]

Peu importe où.
[pause 4s]
L'essentiel... c'est que ce soit attaché à un geste qui existe déjà.
[pause 5s]
Un déclencheur automatique.
[pause 4s]
Quelque chose que vous faites tous les matins sans y penser.
[pause 5s]
Et à ce déclencheur... vous attachez un seul cycle.
[pause 10s]

Le deuxième pilier... l'ancrage de transition.
[pause 8s]

Votre journée n'est pas linéaire.
[pause 4s]
Elle est faite de passages.
[pause 5s]
De moments où vous quittez quelque chose pour entrer dans autre chose.
[pause 5s]
Un appel qui se termine et une réunion qui commence.
[pause 4s]
Une consultation et la suivante.
[pause 4s]
Un cours et le couloir.
[pause 4s]
Un repas et le retour au travail.
[pause 8s]

Ces passages... sont des portes.
[pause 5s]
Et une porte... on peut la franchir de deux façons.
[pause 6s]

La première façon : en transportant tout ce qui précède.
[pause 5s]
Le stress de la réunion... dans la consultation.
[pause 4s]
La fatigue du cours... dans le repas.
[pause 4s]
La tension de la journée... dans la soirée.
[pause 5s]
Jusqu'à ce que tout se cumule... jusqu'à ce que tout déborde.
[pause 8s]

La deuxième façon : poser.
[pause 5s]
Pas oublier. Pas nier.
[pause 4s]
Juste... poser.
[pause 5s]
Un cycle du cinq-cinq-cinq dans le passage.
[pause 4s]
Et franchir la porte avec ce qu'il faut... pas avec ce qu'il fallait.
[pause 10s]

L'ancrage de transition... c'est le moment d'activation que vous avez visualisé dans le module précédent.
[pause 5s]
Le couloir avant la porte.
[pause 4s]
L'ascenseur entre deux réunions.
[pause 4s]
Le seuil de la salle.
[pause 4s]
Le couloir avant d'ouvrir.
[pause 4s]
Les mains posées avant de toucher la matière.
[pause 8s]

Ce n'est pas un ajout à votre journée.
[pause 4s]
C'est une qualité différente dans les passages qui existent déjà.
[pause 10s]

Le troisième pilier... l'ancrage du soir.
[pause 8s]

Le soir porte une autre qualité.
[pause 5s]
La journée est derrière.
[pause 4s]
Mais souvent... elle n'est pas posée.
[pause 5s]
Elle continue de tourner. Dans les pensées. Dans le corps. Dans les épaules.
[pause 5s]
Longtemps après que les événements sont terminés.
[pause 8s]

L'ancrage du soir... c'est le geste de dépose.
[pause 5s]
Un cycle complet.
[pause 4s]
Pas pour effacer ce qui s'est passé.
[pause 4s]
Pour le laisser... là où il a eu lieu.
[pause 5s]
Dans la journée. Passée. Révolue.
[pause 8s]

Certaines personnes l'activent dans les transports du retour.
[pause 4s]
Assis. Les yeux ouverts ou fermés.
[pause 4s]
Un cycle entre le bureau et la maison.
[pause 5s]
Pour ne pas ramener l'intensité professionnelle dans l'espace domestique.
[pause 8s]

D'autres l'activent avant de dîner.
[pause 4s]
La main sur la poignée de la porte de la cuisine.
[pause 5s]
Un cycle. La journée reste dehors. La soirée commence ici.
[pause 8s]

D'autres encore l'activent au moment de se coucher.
[pause 4s]
Allongés. Dans l'obscurité.
[pause 5s]
Un cycle pour dire au système nerveux : c'est fini pour aujourd'hui.
[pause 4s]
Tu peux arrêter de surveiller.
[pause 4s]
Tu peux descendre.
[pause 10s]

Voilà les trois piliers.
[pause 6s]

Matin. Transition. Soir.
[pause 6s]

Trois moments. Trois cycles.
[pause 5s]
Quarante-cinq secondes au total... réparties dans la journée.
[pause 5s]
Et une qualité de présence... fondamentalement différente.
[pause 10s]

Maintenant... une question précise.
[pause 5s]

Pour vous... personnellement...
[pause 4s]
quel est le déclencheur du matin ? Quel geste quotidien peut porter ce premier cycle ?
[pause 8s]

Quel est votre moment de transition principal ?
[pause 5s]
Le passage dans votre journée qui nécessite le plus cette qualité d'ancrage ?
[pause 8s]

Et le soir... quel geste peut porter ce troisième cycle ?
[pause 5s]
Avant de rentrer. Avant de dîner. Avant de dormir.
[pause 8s]

Prenez le temps d'y répondre vraiment.
[pause 5s]
Pas une réponse idéale. Une réponse vraie.
[pause 5s]
Celle qui s'ajuste à votre réalité... telle qu'elle est.
[pause 10s]

Il y a une chose que la recherche en neurosciences confirme.
[pause 5s]
Ce n'est pas la durée qui crée un ancrage profond.
[pause 4s]
C'est la répétition dans un contexte stable.
[pause 6s]

Vingt activations dans votre contexte réel...
[pause 4s]
créent une trace neurologique mesurable.
[pause 5s]
Trente activations... et le geste commence à devenir automatique.
[pause 5s]
Cinquante activations... et votre système nerveux l'intègre comme une ressource permanente.
[pause 8s]

Pas cinquante minutes.
[pause 4s]
Cinquante gestes.
[pause 5s]
De quinze secondes chacun.
[pause 5s]
Attachés à des moments qui existent déjà dans votre vie.
[pause 10s]

C'est pour ça que votre protocole doit être réaliste.
[pause 5s]
Un geste que vous pouvez tenir... même les jours difficiles.
[pause 4s]
Même les jours où tout s'est décalé.
[pause 4s]
Même les jours où vous avez oublié le matin.
[pause 5s]
Un seul cycle dans la transition... et le fil est maintenu.
[pause 8s]

Le protocole n'est pas une performance.
[pause 5s]
C'est une fidélité.
[pause 5s]
Une fidélité douce à un geste qui vous appartient.
[pause 10s]

Dans quelques instants... nous allons pratiquer une dernière fois ensemble.
[pause 4s]
Dix cycles complets.
[pause 5s]
Et pendant cette pratique... je vous demande quelque chose de particulier.
[pause 6s]

Laissez défiler vos trois moments.
[pause 5s]
Le matin. La transition. Le soir.
[pause 5s]
Visualisez chacun d'eux... brièvement... sans effort.
[pause 4s]
Le déclencheur du matin.
[pause 4s]
Le passage de transition dans votre journée.
[pause 4s]
Le geste du soir.
[pause 8s]

Laissez ces trois moments se déposer dans le corps.
[pause 4s]
Pas dans la tête. Dans le corps.
[pause 5s]
Parce que c'est là que le protocole s'installe.
[pause 5s]
Pas dans les intentions. Dans la mémoire musculaire.
[pause 8s]

Installez-vous.
[pause 4s]
Dos allongé. Épaules relâchées. Pieds au sol.
[pause 3s]
Yeux fermés... si cela vous convient.
[pause 8s]

Nous commençons.

[BREATHING_CYCLES]

Bien.
[pause 8s]

Restez encore un instant dans cet espace.
[pause 5s]
Vos trois moments... vous les connaissez maintenant.
[pause 5s]
Pas comme une idée.
[pause 4s]
Comme un geste ancré dans le corps.
[pause 10s]

Rouvrez les yeux... doucement.
[pause 5s]
Prenez un moment pour sentir la qualité de votre présence.
[pause 5s]
Maintenant. Ici.
[pause 4s]
C'est ça... votre protocole... en action.
[pause 10s]

Vous avez tout ce qu'il faut.
[pause 5s]
La méthode. Le mécanisme. Votre famille. Vos trois ancrages.
[pause 6s]

Ce n'est pas une formation parmi d'autres.
[pause 4s]
C'est un outil vivant.
[pause 5s]
Qui grandit avec vous. Qui s'affine avec le temps.
[pause 5s]
Qui devient plus précis... plus profond... plus naturel.
[pause 5s]
À mesure que vous l'activez dans votre vie réelle.
[pause 10s]

Une dernière chose avant de vous laisser.
[pause 6s]

La Pause Souffle... ce n'est pas une solution à vos difficultés.
[pause 5s]
Ce n'est pas un remède à l'épuisement professionnel.
[pause 4s]
Ce n'est pas une réponse à tout.
[pause 8s]

C'est quelque chose de plus modeste... et de plus puissant à la fois.
[pause 5s]
C'est un geste qui dit : je suis encore là.
[pause 5s]
Je choisis d'être présent.
[pause 5s]
Pas parfait. Pas invincible.
[pause 4s]
Présent.
[pause 8s]

Et dans les métiers qui touchent à l'humain...
[pause 4s]
dans les maisons où des enfants grandissent...
[pause 4s]
dans les espaces où des personnes se soignent... se forment... se créent...
[pause 5s]
cette présence... est tout.
[pause 8s]

Merci d'avoir traversé ces trois modules.
[pause 5s]
Maintenant... allez activer votre protocole.
[pause 5s]
Dans votre univers. Dans votre réalité. Dans votre vie.
[pause 6s]
SCRIPT,

        // ── MODULE 04 : UN AUDIO PAR FAMILLE ──────────────────────

        '04-creatif' => <<<'SCRIPT'
L'argile ne ment pas.
[pause 6s]

Ni le bois. Ni la couleur. Ni la note.
[pause 5s]
La matière que vous travaillez... elle reçoit ce que vous êtes au moment où vous la touchez.
[pause 5s]
Pas ce que vous voulez être. Ce que vous êtes.
[pause 10s]

Vous avez probablement vu des œuvres qui sentent la tension.
[pause 5s]
Des tableaux qui pèsent. De la musique jouée avec des mains contractées. De la danse qui pousse au lieu de couler.
[pause 5s]
Et vous avez vu le contraire. Des œuvres qui respirent. Qui ont quelque chose que vous ne pouvez pas nommer... mais que vous ressentez immédiatement.
[pause 8s]
Ce quelque chose... c'est l'état de celui qui a créé.
[pause 5s]
Gravé dans le résultat. Invisible. Mais incontestable.
[pause 10s]

Ce que nous allons faire aujourd'hui... c'est apprendre à entrer délibérément dans l'état qui précède les œuvres qui respirent.
[pause 5s]
Pas par talent. Par protocole.
[pause 10s]

Voici ce qui se passe réellement quand vous commencez à travailler.
[pause 5s]
Votre main s'approche. Et dans cette main... tout ce que vous portez depuis ce matin.
[pause 5s]
Les mails non répondus. Le doute sur le projet. La question de l'argent. La comparaison avec d'autres. La fatigue.
[pause 5s]
Tout ça... dans vos doigts... au moment du premier contact.
[pause 8s]

Et la matière reçoit tout ça.
[pause 5s]
Sans filtre. Sans exception.
[pause 5s]
Elle amplifie même ce que vous portez.
[pause 4s]
L'impatience devient précipitation. La tension devient raideur. L'agitation devient dispersion dans le geste.
[pause 8s]
Vous travaillez contre vous-même. Sans le vouloir. Sans le savoir.
[pause 8s]

Il y a un moment que la plupart des créateurs ignorent.
[pause 5s]
Entre poser les outils sur la table... et toucher pour la première fois.
[pause 8s]

Ce moment n'a pas de nom.
[pause 5s]
Dans les ateliers, on l'appelle parfois l'installation. En danse, le temps de présence avant le premier mouvement. En musique, le silence avant la première note.
[pause 5s]
Les grands musiciens savent que ce silence est déjà de la musique. Que la qualité de ce silence... définit la qualité de tout ce qui suit.
[pause 10s]

Ce moment... c'est le vôtre. Et il vous attend. Chaque fois.
[pause 10s]

Visualisez votre espace de création. Avec précision.
[pause 4s]
La lumière. Les odeurs. La texture des surfaces. La matière qui attend.
[pause 5s]
Et vos mains. À quelques centimètres. Pas encore en contact.
[pause 8s]

Et dans ce passage... vous laissez monter une question. Une seule. Pas à voix haute. Juste en vous.
[pause 6s]

Qu'est-ce que je veux que cette œuvre traverse ?
[pause 10s]

Pas sa forme. Pas son contenu. Ce qu'elle traverse.
[pause 5s]
Quelle qualité invisible. Quelle intention silencieuse.
[pause 5s]
Quelle vérité de vous... est-ce que je veux que cette matière reçoive.
[pause 10s]

Cette question n'a pas besoin de réponse. Elle a besoin d'espace.
[pause 8s]

Installez-vous. Dos allongé. Épaules qui descendent. Mains posées. Pas sur la matière. Pas encore sur l'œuvre.
[pause 6s]
Fermez les yeux. Visualisez ce moment suspendu. Vos mains à quelques centimètres. La matière qui attend.
[pause 8s]

Nous allons faire dix cycles complets.
[pause 4s]
Pendant ces dix cycles... laissez tomber tout ce qui précède.
[pause 5s]
Les mails. Les doutes. La comparaison. La fatigue.
[pause 4s]
Pas en les combattant. En les laissant se déposer... comme un sédiment... au fond.
[pause 5s]
Et vous... vous remontez.
[pause 8s]

Nous commençons.

[BREATHING_CYCLES]

Bien.
[pause 8s]
Sentez vos mains. Leur tonus a changé. La pression dedans... a changé.
[pause 5s]
Ce que ces mains portent maintenant... c'est différent de ce qu'elles portaient il y a dix minutes.
[pause 10s]

Dans quelques instants... vous allez toucher. Et votre matière va recevoir ce que vous portez maintenant.
[pause 5s]
Pas la tension du matin. Pas le doute. Pas l'impatience.
[pause 6s]
Elle va recevoir... un créateur qui a choisi son état.
[pause 5s]
Qui a décidé d'entrer dans l'œuvre... depuis cet espace-là.
[pause 8s]

Ceux qui recevront votre travail un jour... ne sauront pas ce que vous avez fait avant de commencer.
[pause 4s]
Mais ils sentiront quelque chose. Une qualité dans le geste. Une présence dans le résultat.
[pause 4s]
Une trace invisible de l'état dans lequel vous avez créé.
[pause 8s]

C'est votre signature réelle. Plus profonde que votre style. Plus durable que votre technique.
[pause 5s]
Elle ne s'apprend pas. Elle se cultive. Exactement comme ça.
[pause 10s]

Rouvrez les yeux... doucement. Laissez revenir la lumière. Sentez le sol. Sentez l'espace.
[pause 5s]
Et vos mains. Regardez-les.
[pause 6s]
Elles savent déjà.
[pause 5s]
Approchez-vous de la matière. Elle vous attendait.
[pause 6s]
SCRIPT,

        '04-soin' => <<<'SCRIPT'
Il y a une porte entre vous et lui.
[pause 6s]

Dans quelques secondes, vous allez l'ouvrir.
[pause 5s]
Et de l'autre côté... quelqu'un attend. Quelqu'un qui a pris rendez-vous.
[pause 4s]
Qui a peut-être attendu des semaines. Qui a traversé une ville — ou une ville intérieure d'une complexité que vous ne mesurez pas encore.
[pause 5s]
Pour arriver jusqu'à cette chaise. En face de vous.
[pause 10s]

Ce que vous ne savez probablement pas... c'est que votre patient vous lit déjà.
[pause 5s]
Pas vos mots. Pas votre diplôme sur le mur. Votre état.
[pause 8s]

Son système nerveux analyse le vôtre... en quelques centièmes de seconde.
[pause 5s]
Est-ce que cette personne est vraiment là ? Est-ce qu'elle porte autre chose en ce moment ? Est-ce qu'il y a de la place... pour moi... ici ?
[pause 8s]

Ces questions ne sont pas conscientes.
[pause 5s]
Elles se passent en dessous des mots. En dessous de la politesse. Dans le corps.
[pause 5s]
Dans cette intelligence ancienne que tout être humain possède... et qui sait, avant la pensée, si quelqu'un est vraiment présent.
[pause 10s]

Voici la réalité de votre journée.
[pause 5s]
Vous travaillez avec des dizaines de personnes. Et chacune amène quelque chose.
[pause 5s]
Une douleur chronique que le corps porte depuis des années.
[pause 4s]
Une angoisse que les mots ne peuvent pas contenir.
[pause 4s]
Une histoire que vous serez peut-être le premier à entendre vraiment.
[pause 6s]

Et vous... vous tenez tout ça.
[pause 5s]
Vous le portez pendant la séance. Vous l'accompagnez.
[pause 4s]
Puis la porte se rouvre. Et quelqu'un d'autre entre.
[pause 8s]

Ce que vous ne vous autorisez peut-être pas à dire... c'est que ça pèse.
[pause 5s]
Que certains jours la dixième consultation arrive... et quelque chose en vous est plus étroit. Plus fatigué. Moins disponible.
[pause 8s]

Ce n'est pas un manque de vocation. C'est de la biologie.
[pause 5s]
Le système nerveux humain n'est pas conçu pour absorber sans déposer.
[pause 5s]
Sans rituel de transition. Sans moment où le chapitre se ferme... avant que le suivant s'ouvre.
[pause 10s]

Ce couloir...
[pause 6s]
ce couloir que vous traversez entre deux patients... est l'endroit le plus important de votre pratique.
[pause 8s]
Pas la salle de soin. Pas votre bureau. Ce couloir.
[pause 6s]
Vingt secondes. Un cycle.
[pause 5s]
La main pas encore posée sur la poignée suivante.
[pause 5s]
Et une question, une seule, que vous posez en silence :
[pause 6s]
Qui est cette personne... aujourd'hui... maintenant... dans ce moment de sa vie ?
[pause 10s]

Pas son dossier. Pas ses symptômes. Pas ce que vous savez d'elle depuis la dernière fois.
[pause 5s]
Qui est cette personne aujourd'hui.
[pause 5s]
Parce qu'elle a peut-être changé depuis la semaine dernière.
[pause 4s]
Parce que votre curiosité ouverte... est déjà une forme de soin.
[pause 10s]

Il y a aussi une autre possibilité.
[pause 5s]
Proposer cette respiration... ensemble. Au début de la séance. Un seul cycle partagé.
[pause 5s]
Avant le premier mot. Vous réglez votre système nerveux.
[pause 4s]
Et vous offrez à votre patient... un espace pour déposer ce qu'il a porté jusqu'ici.
[pause 5s]
La consultation peut alors commencer dans un état différent. Pour vous deux.
[pause 10s]

Maintenant. Installez-vous. Fermez les yeux.
[pause 4s]
Visualisez ce couloir. Sa longueur exacte. Le sol sous vos pieds. La lumière.
[pause 5s]
Et cette porte, devant vous. La main pas encore posée sur la poignée.
[pause 5s]
De l'autre côté... quelqu'un attend. Quelqu'un qui a besoin que vous soyez entier.
[pause 8s]

Dos ancré. Épaules qui descendent. Mâchoires desserrées. Pieds au sol.
[pause 8s]

Dix cycles. Pendant que vous respirez...
[pause 4s]
laissez se déposer ce qui précède. Pas l'effacer. Le laisser à sa place.
[pause 5s]
Dans le passé immédiat. Là où il appartient.
[pause 5s]
Et laissez l'espace se libérer... pour quelqu'un qui mérite votre meilleure présence.
[pause 8s]

Nous commençons.

[BREATHING_CYCLES]

Bien.
[pause 8s]
Sentez ce que vous portez maintenant. Ce n'est plus la séance précédente. Ce n'est plus la fatigue accumulée.
[pause 5s]
C'est une présence nette. Propre. Ouverte.
[pause 8s]

Quand vous ouvrirez cette porte dans quelques instants...
[pause 5s]
votre patient recevra quelqu'un d'entier. Quelqu'un qui a choisi d'être là. Pleinement. Pour cette personne. Pour cette heure.
[pause 8s]

Cela ne s'explique pas. Ça ne s'enseigne pas non plus. Ça se donne.
[pause 5s]
Vingt secondes dans ce couloir... pour que quelqu'un de l'autre côté reçoive la version entière de vous.
[pause 10s]

Cela préserve aussi quelque chose d'autre. Votre durabilité dans ce métier.
[pause 5s]
Ce rituel de transition... fait que vous ne vous videz pas. Vous vous régénérez.
[pause 4s]
Consultation après consultation. Pas parce que vous êtes invincible. Parce que vous avez un protocole.
[pause 10s]

Rouvrez les yeux... doucement. La main sur la poignée. Vous êtes prêt. Entrez.
[pause 6s]
SCRIPT,

        '04-enseignant' => <<<'SCRIPT'
Avant que vous entriez dans cette salle...
[pause 5s]
il se passe quelque chose. La salle vous attend.
[pause 8s]

Pas de façon poétique. De façon physiologique.
[pause 5s]
Les systèmes nerveux de vos élèves... vont s'ajuster au vôtre...
[pause 4s]
dans les premières secondes qui suivent votre entrée.
[pause 5s]
Avant même que vous ayez ouvert la bouche.
[pause 8s]

C'est ce qu'on appelle la co-régulation.
[pause 6s]
L'être humain est une espèce sociale.
[pause 4s]
Nos systèmes nerveux ne sont pas étanches. Ils se lisent. Se répondent. S'influencent.
[pause 5s]
C'est une nécessité ancienne : savoir rapidement dans quel état est l'autre... pour savoir si on peut baisser la garde. Si on peut apprendre. Si on est en sécurité.
[pause 8s]

Vos élèves font ça. En permanence. Avec vous.
[pause 8s]

Vous entrez tendu... la salle perçoit la tension.
[pause 5s]
Un signal diffus circule : quelque chose n'est pas entièrement sûr ici.
[pause 5s]
L'agitation monte. L'attention se fragmente. La résistance s'installe.
[pause 5s]
Pas consciemment. Automatiquement.
[pause 8s]

Vous entrez ancré... la salle le reçoit.
[pause 5s]
Un signal diffus circule également : quelqu'un de solide est entré. On peut poser ce qu'on portait. On peut être là. On peut apprendre.
[pause 8s]

Ce n'est pas de la magie. C'est de la neurobiologie.
[pause 8s]

Pensez à l'enseignant dont vous vous souvenez.
[pause 6s]
Vous en avez un. Quelqu'un dont vous vous rappelez encore la présence. Des années, parfois des décennies après.
[pause 5s]
Ce n'est pas le contenu de ses cours dont vous vous souvenez.
[pause 5s]
C'est comment vous vous sentiez dans sa classe. Ce qu'il était possible d'être... là.
[pause 8s]

Cet enseignant avait un protocole. Consciemment ou non.
[pause 5s]
Il entrait dans sa salle... d'une certaine façon. Il portait quelque chose que vous ressentiez avant d'entendre ce qu'il disait.
[pause 8s]

Ce quelque chose n'est pas un don inné. C'est un état. Et un état... se choisit. Se prépare. Se cultive.
[pause 10s]

Votre seuil... c'est la poignée de porte.
[pause 6s]
Ce moment où la main se pose dessus...
[pause 4s]
et où la porte n'est pas encore ouverte.
[pause 5s]
Ce moment de cinq à dix secondes... qui existe dans toutes les journées de tous les enseignants... et que presque aucun n'utilise.
[pause 8s]

Un cycle. La question silencieuse :
[pause 5s]
Dans quel état est-ce que je veux entrer ? Quelle qualité est-ce que je choisis d'amener dans cette salle ?
[pause 8s]

Et puis... la porte s'ouvre.
[pause 10s]

Fermez les yeux. Visualisez votre couloir. Votre école. Votre salle.
[pause 5s]
Vous êtes devant. La main sur la poignée.
[pause 4s]
Derrière cette porte... vos élèves attendent. Ils ne savent pas encore que vous êtes là.
[pause 5s]
Vous avez encore ce moment.
[pause 8s]

Ancrez vos pieds. Allongez votre dos. Posez vos épaules. Desserrez les mâchoires.
[pause 8s]

Dix cycles. Pendant que vous respirez...
[pause 4s]
laissez le couloir rester dans le couloir.
[pause 5s]
Les copies qui traînent. La réunion de la semaine. Le collègue difficile.
[pause 4s]
Tout ça reste derrière. Vous, vous passez. Léger. Ancré. Entier.
[pause 8s]

Nous commençons.

[BREATHING_CYCLES]

Bien.
[pause 8s]

Sentez l'état que vous portez maintenant. Ce n'est plus la fatigue. Ce n'est plus l'inquiétude.
[pause 5s]
C'est une solidité. Douce. Ancrée. Disponible.
[pause 10s]

Derrière cette porte... il y a peut-être des enfants difficiles. Des adolescents résistants. Des étudiants fatigués.
[pause 5s]
Ce n'est pas ça qui va changer. Ce qui va changer... c'est l'espace qu'ils rencontrent en entrant.
[pause 5s]
L'espace que vous créez. Par ce que vous portez. Par ce que vous êtes en entrant.
[pause 10s]

Certains de ces élèves... dans longtemps... se souviendront de vous.
[pause 5s]
Pas de ce que vous leur avez appris. De comment vous étiez. De ce que c'était... d'être dans votre classe.
[pause 8s]

Rouvrez les yeux... doucement. La main est sur la poignée. Ouvrez la porte.
[pause 6s]
SCRIPT,

        '04-leader' => <<<'SCRIPT'
Vos équipes vous lisent.
[pause 6s]

Avec une précision que vous sous-estimez probablement.
[pause 5s]
Pas vos mots. Votre état.
[pause 5s]
La micro-tension dans votre voix.
[pause 4s]
La qualité de votre regard en réunion. La vitesse avec laquelle vous vous asseyez.
[pause 4s]
La façon dont vous tenez votre stylo. Ils lisent tout ça.
[pause 5s]
Et ils ajustent tout en fonction.
[pause 8s]

Ce qu'ils ne peuvent pas toujours nommer... c'est précisément ce que leur corps sait.
[pause 5s]
Leur niveau de sécurité psychologique au travail... est corrélé à votre niveau de régulation.
[pause 5s]
Pas à votre compétence. À votre capacité à rester ancré sous pression.
[pause 8s]

Voici le paradoxe le plus cruel du leadership.
[pause 5s]
C'est précisément quand la pression est la plus intense... que votre état intérieur a le plus d'impact sur les autres. Et que cet état est le plus difficile à maîtriser.
[pause 8s]

Sous adrénaline... le cerveau rétrécit son champ de vision.
[pause 4s]
Il accélère le temps de réponse au détriment de la qualité de la réflexion.
[pause 5s]
Il cherche la solution immédiate. La décision rapide. L'action visible.
[pause 5s]
Et pendant ce temps... les équipes reçoivent l'urgence dans votre corps. Et elles s'y ajustent.
[pause 5s]
La panique se propage. Même silencieusement. Même involontairement.
[pause 8s]

Les leaders qui ont bien traversé les crises... ont tous une chose en commun.
[pause 5s]
Ils ont trouvé un moyen de créer une déconnexion consciente...
[pause 4s]
entre la pression de la situation... et l'état depuis lequel ils allaient répondre.
[pause 8s]

Pas en niant la gravité. Pas en simulant le calme.
[pause 5s]
En créant délibérément les conditions neurologiques... d'une décision de qualité.
[pause 8s]

Votre moment... c'est l'ascenseur.
[pause 6s]
Ou le couloir entre la réunion précédente et la suivante.
[pause 5s]
Ce moment de transition que presque tous les leaders passent... à consulter leur téléphone.
[pause 4s]
À préparer mentalement la prochaine battle.
[pause 5s]
À transporter la réunion précédente... dans l'espace de la suivante.
[pause 8s]

Téléphone dans la poche. Dos droit. Trente secondes. Un cycle.
[pause 5s]
Et une question.
[pause 5s]
Quel leader est-ce que je choisis d'être... dans trente secondes... pour ces personnes ?
[pause 10s]

Pas le leader idéal. Pas le leader invincible.
[pause 5s]
Celui qui a choisi son état. Consciemment. Dans cet ascenseur. Aujourd'hui.
[pause 10s]

Il y a aussi les décisions solitaires. Celles que vous prenez face à une page blanche.
[pause 5s]
Les décisions importantes. Celles dont vous savez qu'elles porteront. Longtemps.
[pause 8s]

Avant de trancher... posez une seule question.
[pause 5s]
Dans quel état est-ce que je prends cette décision en ce moment ?
[pause 8s]

Si la réponse est sous adrénaline... prenez un cycle. Un seul. Puis décidez.
[pause 5s]
La différence dans la qualité de la décision sera réelle. Mesurable.
[pause 5s]
Ressentie par tous ceux qui vivront avec cette décision.
[pause 10s]

Installez-vous. Fermez les yeux.
[pause 4s]
Visualisez votre ascenseur. Ou votre couloir.
[pause 5s]
Le bâtiment autour de vous. Les personnes qui attendent.
[pause 5s]
Et ce moment... rien qu'à vous. Trente secondes. Que personne ne vous réclame.
[pause 8s]

Ancrez-vous. Dos droit. Épaules posées. Mains qui s'ouvrent légèrement.
[pause 8s]

Dix cycles. Pendant que vous respirez... laissez monter la question.
[pause 5s]
Quel leader est-ce que je choisis d'être ? Dans quel état est-ce que je veux entrer dans cette pièce ?
[pause 8s]

Nous commençons.

[BREATHING_CYCLES]

Bien.
[pause 8s]

Sentez la différence. Entre l'état d'avant... et ce que vous portez maintenant.
[pause 8s]

Ce que vous allez apporter dans cette pièce... n'est pas votre expertise. Ils la connaissent.
[pause 5s]
C'est votre état. Et votre état... va déterminer ce qui est possible dans cette conversation.
[pause 5s]
Ce que les gens osent dire. Ce qu'ils osent proposer. La qualité du collectif que vous allez créer ensemble.
[pause 8s]

Certaines équipes se souviennent du leader qui a traversé la crise avec eux.
[pause 5s]
Non pas parce qu'il avait les meilleures solutions. Parce qu'il était ancré quand tout tremblait.
[pause 5s]
Parce que son état... disait : on peut traverser ça.
[pause 8s]

Vous pouvez être ce leader. Pas parce que vous êtes exceptionnel.
[pause 4s]
Parce que vous avez un protocole. Celui-là. Dans cet ascenseur. Aujourd'hui.
[pause 10s]

Rouvrez les yeux... doucement. La porte de la salle est devant vous. Vous êtes prêt.
[pause 6s]
SCRIPT,

        '04-educateur' => <<<'SCRIPT'
Vous ne pouvez pas forcer une transformation.
[pause 6s]
Vous le savez déjà. Vous l'avez vécu.
[pause 5s]
Ces séances où vous avez tout donné... et où rien ne s'est passé.
[pause 5s]
Ces groupes où le contenu était excellent... et où les participants sont partis exactement comme ils étaient arrivés.
[pause 8s]

Et puis il y a eu les autres fois.
[pause 5s]
Celles où quelque chose s'est produit. Où vous avez senti un déplacement.
[pause 4s]
Pas forcément spectaculaire. Quelque chose de discret.
[pause 5s]
Un regard qui change. Une question qui arrive de nulle part. Un silence différent.
[pause 5s]
Et vous savez que quelque chose vient de bouger.
[pause 8s]

La différence entre les deux... ce n'était pas votre contenu. C'était l'espace.
[pause 8s]

L'espace dans lequel quelqu'un peut se permettre de changer.
[pause 5s]
L'espace assez sûr pour essayer quelque chose de nouveau. Pour dire quelque chose qu'on n'avait jamais dit.
[pause 5s]
Pour questionner une croyance qu'on portait depuis des années.
[pause 6s]
Cet espace... vous seul pouvez le créer.
[pause 5s]
Et vous le créez avec ce que vous portez en entrant.
[pause 8s]

Il y a une tension particulière dans votre métier. Elle s'appelle l'expertise.
[pause 5s]
Vous avez construit quelque chose. Des connaissances. Des méthodes. Un regard formé.
[pause 4s]
Et cette expertise... parfois... vous précède. Elle entre dans la salle avant vous.
[pause 5s]
Elle installe une asymétrie. Je sais. Tu apprends. Je guide. Tu suis. Je transmets. Tu reçois.
[pause 8s]

Et dans cette asymétrie... la transformation devient difficile.
[pause 5s]
Parce que la transformation ne se passe pas dans la réception. Elle se passe dans la rencontre.
[pause 5s]
Dans l'espace entre deux personnes... où quelque chose d'inattendu peut se produire.
[pause 8s]

Arriver disponible... c'est suspendre l'expertise.
[pause 5s]
Pas la nier. La mettre au service d'une question plutôt que d'une réponse.
[pause 5s]
La mettre au service de la personne réelle qui est là... aujourd'hui... dans cet état... avec ce qu'elle porte.
[pause 10s]

Le cinq-cinq-cinq avant chaque session... ne vous rend pas moins expert.
[pause 5s]
Il vous rend plus humain. Et c'est cette humanité... qui crée l'espace dans lequel la transformation peut avoir lieu.
[pause 10s]

Votre moment d'activation... c'est la salle vide.
[pause 6s]
Ce moment avant que les participants arrivent. Quand la salle est encore silencieuse.
[pause 5s]
Les chaises. La lumière. Le tableau. Et ce vide qui attend d'être rempli.
[pause 5s]
Par qui vous allez être... pendant ces prochaines heures.
[pause 10s]

Fermez les yeux. Visualisez votre salle. Vide. Silencieuse. Les chaises qui attendent.
[pause 5s]
Dans quelques minutes... des personnes vont entrer. Elles viennent pour quelque chose. Quelque chose qui les dépasse peut-être.
[pause 5s]
Et vous êtes là pour tenir cet espace.
[pause 8s]

Ancrez-vous. Dos droit. Épaules posées. Pieds bien au sol.
[pause 8s]

Pendant ces dix cycles... déposez votre programme. Juste pour ces minutes.
[pause 5s]
Et laissez entrer la question : de quelle qualité de présence est-ce que je veux tenir cet espace ?
[pause 8s]

Nous commençons.

[BREATHING_CYCLES]

Bien.
[pause 8s]

Cette qualité que vous portez maintenant... c'est ce que la salle va recevoir.
[pause 5s]
Avant votre premier mot. Avant votre première question.
[pause 5s]
Vos participants vont entrer dans cet espace. Et quelque chose dans cet espace... va leur permettre d'être davantage eux-mêmes.
[pause 8s]

Vous ne verrez peut-être pas les effets aujourd'hui.
[pause 5s]
La transformation est rarement visible dans l'instant.
[pause 5s]
Mais quelque part... dans les semaines ou les mois qui viennent... quelqu'un se souviendra de quelque chose.
[pause 4s]
Une phrase. Un silence. Une permission. Quelque chose de ce que vous aviez dans les mains aujourd'hui.
[pause 8s]

L'espace est prêt. Vous l'êtes aussi. Accueillez.
[pause 6s]
SCRIPT,

        '04-bebe' => <<<'SCRIPT'
Cet être ne vous connaît pas encore.
[pause 5s]
Il vous lit déjà.
[pause 8s]

Pas avec ses yeux. Pas avec sa pensée.
[pause 5s]
Avec tout ce qu'il est. Avec sa peau. Avec son souffle.
[pause 5s]
Avec ce que la recherche en neurosciences appelle... la synchronie physiologique.
[pause 8s]

Un nouveau-né emprunte votre système nerveux.
[pause 6s]

Ce n'est pas une métaphore. Son cerveau n'est pas encore capable de se réguler seul.
[pause 5s]
Ses circuits de calme ne sont pas encore formés.
[pause 5s]
Pour descendre... pour s'apaiser... pour se sentir en sécurité...
[pause 4s]
il a besoin de votre rythme cardiaque. De votre tonus musculaire. De la qualité de votre respiration. De l'odeur chimique de votre calme.
[pause 8s]

Oui. Il reçoit la chimie de votre état.
[pause 5s]
Le cortisol dans votre corps... passe dans l'air. Il le respire.
[pause 4s]
Votre tension musculaire... il la sent dans vos bras.
[pause 4s]
Votre rythme cardiaque... il le perçoit à travers votre peau.
[pause 8s]

Vous n'êtes pas en train de garder un enfant.
[pause 5s]
Vous êtes en train d'offrir à un système nerveux humain en formation...
[pause 5s]
sa première expérience de ce que le calme est possible.
[pause 8s]

Cette première expérience... crée une empreinte.
[pause 5s]
Pas un souvenir. Une mémoire du corps.
[pause 5s]
Une réponse automatique qui s'inscrit dans les circuits... et qui restera. Pour des années. Parfois pour une vie.
[pause 10s]

Voici ce que vous faites réellement.
[pause 5s]
Vous fabriquez les fondations neurologiques de la sécurité.
[pause 6s]

Pas des jouets. Pas des calories.
[pause 4s]
La conviction profonde, viscérale, corporelle... que le monde peut être sûr.
[pause 4s]
Que quelqu'un peut être là. Que se laisser aller... est possible.
[pause 8s]

Cela commence dans vos bras. Avant le premier mot. Avant la première chanson.
[pause 5s]
Dans la qualité de vos mains... au moment où elles se posent.
[pause 10s]

Votre moment d'activation... c'est avant le contact.
[pause 6s]
Avant de le prendre. Avant le biberon. Avant le change. Avant le portage.
[pause 5s]
Ce dixième de seconde juste avant que vos mains touchent ce corps.
[pause 8s]

Un cycle. Mains qui s'ouvrent. Épaules qui descendent. Rythme cardiaque qui ralentit.
[pause 5s]
Et vos bras... qui deviennent ce que cet enfant cherche.
[pause 8s]

Je veux être honnête avec vous. Vous êtes fatigué parfois. Très fatigué.
[pause 5s]
Ce métier pèse. Ces enfants pèsent. Ces familles pèsent.
[pause 5s]
Et on ne vous dit pas assez souvent à quel point ce que vous faites est important.
[pause 8s]

Alors laissez-moi vous le dire clairement.
[pause 5s]
Ce que vous déposez dans ces bras... appartient à quelqu'un pour toujours.
[pause 5s]
Ces enfants ne sauront jamais votre nom dans dix ans.
[pause 4s]
Mais quelque chose dans leur système nerveux... portera la trace de votre calme.
[pause 5s]
De votre présence. De ces moments où vous avez choisi d'être ancré... pour eux.
[pause 10s]

Fermez les yeux. Visualisez vos mains. Ouvertes. À quelques centimètres d'un petit corps.
[pause 5s]
Pas encore en contact. Dans ce moment juste avant.
[pause 8s]

Relâchez tout. Les épaules. Les mâchoires. Les poings. La nuque.
[pause 5s]
Que votre rythme cardiaque descende. Laissez votre corps devenir ce dont cet être a besoin.
[pause 8s]

Dix cycles. Inspirez ce calme. Retenez-le. Expirez cette tension.
[pause 4s]
Et laissez vos mains devenir calmes. Vraiment calmes.
[pause 8s]

Nous commençons.

[BREATHING_CYCLES]

Bien.
[pause 8s]

Sentez vos mains. Leur tonus a changé. La tension qui les habitait... s'est déposée.
[pause 5s]
Elles sont prêtes maintenant. Prêtes à recevoir. Prêtes à porter.
[pause 5s]
Prêtes à donner ce que seules des mains calmes peuvent donner.
[pause 10s]

Ce que cet enfant va recevoir dans ces mains... il le portera.
[pause 5s]
Sans le savoir. Sans pouvoir le nommer.
[pause 5s]
Comme une certitude corporelle. Le calme est possible. La sécurité existe. Quelqu'un peut être là.
[pause 10s]

C'est le plus beau cadeau qu'un être humain puisse faire à un autre.
[pause 5s]
Et c'est ce que vous faites. Avec ces mains. Maintenant.
[pause 10s]

Rouvrez les yeux... Approchez-vous. Il vous attend.
[pause 6s]
SCRIPT,

        '04-proches' => <<<'SCRIPT'
Personne ne vous a donné ce titre.
[pause 6s]

Il n'y a pas de diplôme. Pas de cabinet. Pas de blouse. Pas de plaque sur la porte.
[pause 5s]
Juste votre maison. Votre cuisine. Votre voiture pleine de cartables. Votre canapé le soir.
[pause 8s]

Et pourtant.
[pause 8s]

Ce que vous faites là... dans la vie ordinaire... dans les couloirs de votre maison...
[pause 5s]
a plus d'impact que la plupart des professionnels ne l'auront jamais.
[pause 8s]

Parce que la personne la plus importante dans le développement d'un enfant... c'est vous.
[pause 5s]
Pas son professeur. Pas son pédiatre. Pas le meilleur thérapeute.
[pause 5s]
Vous. Le parent. Le proche. La personne qui est là tous les jours.
[pause 5s]
Dans les petits moments. Dans les moments ordinaires. Dans les moments où personne ne regarde.
[pause 10s]

Et voici ce que la recherche dit sans équivoque.
[pause 5s]
Ce que vos enfants apprennent de vous... ce n'est pas ce que vous leur dites.
[pause 5s]
C'est ce qu'ils vous voient vivre.
[pause 8s]

Pas "fais de ton mieux". Pas "sois courageux". Pas "calme-toi".
[pause 5s]
Comment vous gérez la frustration. Comment vous traversez la difficulté.
[pause 4s]
Comment vous répondez quand quelque chose vous dépasse.
[pause 8s]

Un parent qui respire... enseigne à son enfant que la régulation est possible.
[pause 5s]
Sans un mot. Juste par la façon d'être. Et cette leçon... est encodée dans le système nerveux. Elle reste. Pour des décennies.
[pause 10s]

Je veux parler d'un moment précis. Vous connaissez ce moment.
[pause 5s]
Vous rentrez. La journée a été longue. Difficile. Ou juste... épuisante.
[pause 5s]
Et à la seconde où vous ouvrez la porte... quelque chose commence immédiatement.
[pause 4s]
Des voix. Des demandes. Un conflit. Un besoin.
[pause 4s]
Et vous n'avez plus rien. Vraiment plus rien.
[pause 8s]

Vous savez ce qui se passe dans ces moments.
[pause 5s]
La voix qui monte. La patience qui craque. Les mots qu'on regrette.
[pause 5s]
Pas parce que vous êtes un mauvais parent. Parce que personne ne vous a donné trente secondes pour revenir à vous-même.
[pause 8s]

Ces trente secondes... elles existent.
[pause 5s]
Elles attendent dans votre voiture. Devant votre porte.
[pause 5s]
Dans ce court instant entre le bruit de la clé dans la serrure... et le moment où vous entrez.
[pause 8s]

Ce seuil...
[pause 6s]
c'est votre espace. Peut-être le seul qui vous appartient vraiment. Dans une journée entière.
[pause 10s]

Et dans ce seuil... une question.
[pause 6s]
Qui est-ce que je veux être pour eux ce soir ?
[pause 10s]

Pas parfait. Pas infini. Qui est-ce que je choisis d'être... avec ce que j'ai... dans cet état... ce soir.
[pause 10s]

Il y a aussi l'autre seuil. Celui d'avant l'éclat de voix.
[pause 5s]
La fraction de seconde... avant que les mots sortent. Avant que la voix monte.
[pause 5s]
Cet espace microscopique... qui existe même dans les moments les plus chargés.
[pause 8s]

Une seule expiration longue. Pas quinze secondes. Une expiration.
[pause 5s]
Et quelque chose change dans ce qui peut sortir ensuite. Pas toujours. Assez souvent pour que ça compte.
[pause 10s]

Fermez les yeux. Visualisez votre seuil.
[pause 4s]
Votre porte d'entrée. La clé dans la main. Pas encore entrée dans la serrure.
[pause 5s]
La journée derrière vous. Ceux que vous aimez... devant. Et vous... dans ce passage.
[pause 8s]

Dos droit. Épaules qui descendent. Mâchoires qui se desserrent. Mains qui s'ouvrent.
[pause 8s]

Dix cycles. Pendant que vous respirez...
[pause 4s]
laissez la journée rester dehors. Elle n'a pas besoin d'entrer avec vous.
[pause 5s]
Elle était. Elle a été. Ce qui vient maintenant est autre chose.
[pause 5s]
Et vous pouvez choisir comment vous y entrez.
[pause 8s]

Nous commençons.

[BREATHING_CYCLES]

Bien.
[pause 8s]

Sentez ce que vous portez maintenant. Ce n'est plus la réunion du matin. Ce n'est plus le trajet.
[pause 6s]
C'est une présence. Douce. Imparfaite. Réelle. Et choisie.
[pause 8s]

Ceux qui sont derrière cette porte... ne sauront jamais ce que vous venez de faire pour eux.
[pause 5s]
Mais ils recevront la différence. Dans votre voix. Dans votre regard.
[pause 4s]
Dans la façon dont vous allez traverser cette soirée avec eux.
[pause 8s]

Et quelque chose de plus profond encore.
[pause 5s]
Dans les années qui viennent... quand ils feront face à leurs propres difficultés...
[pause 5s]
ils feront peut-être ce que vous leur avez montré sans le dire.
[pause 5s]
Ils prendront un souffle. Avant de répondre. Avant de réagir. Avant d'entrer.
[pause 8s]

Ce n'est pas de la propagande. C'est de la neurologie.
[pause 5s]
Les enfants apprennent en observant. Et ce que vous vivez devant eux... devient leur répertoire.
[pause 8s]

Rouvrez les yeux... doucement. La clé dans la serrure. La porte qui s'ouvre. Bienvenue chez vous.
[pause 6s]
SCRIPT,

        // ── MODULE 05 : L'ANCRAGE EN PLEINE TURBULENCE ────────────

        '05-creatif' => <<<'SCRIPT'
Quelque chose ne vient pas.
[pause 6s]

Vous êtes là. La matière est là. Les outils sont là.
[pause 5s]
Tout est en place. Et pourtant... rien.
[pause 5s]
Le vide.
[pause 8s]

Pas l'absence d'idées. Quelque chose de plus opaque.
[pause 5s]
Une résistance sans forme. Un mur sans bords.
[pause 5s]
Vous recommencez. Vous effacez. Vous reprenez.
[pause 5s]
Et le résultat vous dit quelque chose que vous ne voulez pas entendre.
[pause 5s]
Ce n'est pas ça.
[pause 10s]

Ce moment a un nom dans tous les ateliers du monde.
[pause 5s]
Le blocage.
[pause 6s]

Et il est presque toujours interprété de la même façon.
[pause 5s]
Comme une défaillance. Un signe. Une preuve.
[pause 5s]
La preuve que ce projet était au-dessus de vous.
[pause 4s]
Que le talent a des limites. Que les autres ont quelque chose que vous n'avez pas.
[pause 5s]
Que peut-être vous n'êtes pas vraiment fait pour ça.
[pause 10s]

Ce que la science du cerveau dit de ce moment... est radicalement différent.
[pause 6s]

Quand vous êtes bloqué... votre cortex préfrontal est en surchauffe.
[pause 5s]
Il évalue. Il juge. Il compare. Il perfectionne.
[pause 5s]
Il travaille contre vous. À plein régime.
[pause 8s]

Et la créativité... ne vient pas de là.
[pause 5s]
Elle vient du réseau en mode par défaut. Le circuit qui s'active quand on ne force pas.
[pause 5s]
Quand on lâche. Quand on erre. Quand on ne cherche plus.
[pause 8s]

Le blocage n'est pas une absence de talent.
[pause 5s]
C'est trop de contrôle. Trop d'évaluation. Trop de cortex.
[pause 5s]
Et la solution n'est pas d'essayer plus fort.
[pause 5s]
C'est de créer une interruption. Consciente. Délibérée.
[pause 10s]

Voici ce qui se passe dans votre corps quand vous êtes bloqué.
[pause 5s]
Vos épaules sont remontées. Vos mâchoires sont serrées.
[pause 4s]
Votre regard est durci. Votre respiration est superficielle.
[pause 5s]
Votre corps est en mode surveillance. En mode menace.
[pause 5s]
Il défend quelque chose.
[pause 6s]
Votre image. Votre identité de créateur. L'idée que vous avez de votre valeur.
[pause 8s]

Et dans cet état... rien de vivant ne peut émerger.
[pause 5s]
Parce que ce qui est vivant ne nait pas dans la défense.
[pause 5s]
Il nait dans l'ouverture.
[pause 10s]

Le cinq-cinq-cinq dans le blocage... n'est pas une pause.
[pause 5s]
C'est un signal envoyé au cerveau.
[pause 5s]
La menace n'est pas réelle.
[pause 4s]
Tu peux arrêter de surveiller.
[pause 4s]
Tu peux lâcher le contrôle.
[pause 5s]
Et dans ce lâcher... quelque chose qui attendait peut enfin bouger.
[pause 10s]

Posez ce que vous tenez. Les outils. Le crayon. La tension.
[pause 6s]
Reculez légèrement. Ou quittez la matière des yeux.
[pause 5s]
Sentez le dossier de votre chaise. Ou le sol sous vos pieds.
[pause 8s]

Desserrez les mâchoires. Laissez tomber les épaules.
[pause 5s]
Ne cherchez rien. Ne résolvez rien.
[pause 5s]
Fermez les yeux.
[pause 8s]

Pendant les dix cycles... une seule consigne.
[pause 5s]
Ne pensez pas à l'œuvre. Ne cherchez pas la solution. Ne préparez pas la prochaine tentative.
[pause 5s]
Laissez le cerveau errer librement.
[pause 5s]
Sans destination. Sans performance.
[pause 8s]

Lui seul sait où chercher. Pas vous. Pas maintenant.
[pause 8s]

Nous commençons.

[BREATHING_CYCLES]

Bien.
[pause 10s]

Restez encore un moment sans regarder l'œuvre.
[pause 5s]
Laissez votre regard aller quelque part d'autre.
[pause 5s]
La fenêtre. Le sol. Un détail de l'espace autour de vous.
[pause 5s]
Laissez la pensée dériver encore un peu.
[pause 10s]

Quelque chose a changé dans le calme. Peut-être une image. Peut-être une sensation.
[pause 5s]
Peut-être rien de visible encore. Mais quelque chose s'est dénoué.
[pause 5s]
Une légère détente dans le système. Une permission.
[pause 8s]

Quand vous retournerez à la matière... retournez-y différemment.
[pause 5s]
Pas pour réussir. Pour voir ce qui vient.
[pause 5s]
Sans jugement sur le résultat. Sans évaluation dans la main.
[pause 5s]
Juste un geste. Et puis un autre.
[pause 8s]

Le blocage n'était pas votre ennemi.
[pause 5s]
Il était le signal que vous portiez trop. Que vous contrôliez trop.
[pause 5s]
Et ce signal... vous savez maintenant comment y répondre.
[pause 8s]

Rouvrez les yeux... doucement. Retournez à la matière. Sans hâte.
[pause 6s]
SCRIPT,

        '05-soin' => <<<'SCRIPT'
Quelque chose vous est resté de la dernière séance.
[pause 6s]

Ce n'est pas de la fatigue ordinaire. C'est plus précis que ça.
[pause 5s]
Une image. Un mot qui a été dit. Une douleur que vous avez tenue.
[pause 5s]
Quelque chose qui a traversé le cadre professionnel... et qui est encore là.
[pause 8s]

Ou peut-être c'est maintenant. Ici. Cette consultation-ci.
[pause 5s]
La personne en face de vous est en détresse.
[pause 4s]
Une détresse qui déborde. Qui vous regarde. Qui vous sollicite au-delà du protocole.
[pause 5s]
Et quelque chose en vous... commence à se contracter.
[pause 8s]

Ce que vous ressentez a un nom précis.
[pause 5s]
La résonance empathique.
[pause 6s]

Votre système nerveux est conçu pour se synchroniser avec celui de l'autre.
[pause 5s]
C'est une capacité remarquable. C'est ce qui fait de vous un soignant exceptionnel.
[pause 5s]
Et c'est aussi ce qui vous expose.
[pause 8s]

Car recevoir la souffrance de quelqu'un... sans protocole de protection...
[pause 5s]
ce n'est pas de l'empathie. C'est de la fusion.
[pause 5s]
Et dans la fusion... vous ne pouvez plus aider.
[pause 5s]
Vous portez avec. Au lieu d'accompagner depuis.
[pause 10s]

La différence entre les deux... c'est votre ancrage.
[pause 8s]

Un soignant ancré reçoit. Il entend. Il est touché.
[pause 5s]
Mais il reste debout.
[pause 5s]
Pas parce qu'il s'est protégé derrière une vitre.
[pause 5s]
Parce qu'il a un sol sous les pieds.
[pause 6s]
Et ce sol... se cultive. Délibérément. En temps réel.
[pause 10s]

Voici ce qui se passe dans votre corps quand une consultation pèse.
[pause 5s]
Votre respiration se raccourcit. Votre rythme cardiaque s'élève.
[pause 5s]
Vos épaules se contractent. Vos mains se ferment.
[pause 5s]
Votre attention se rétrécit autour de l'urgence de l'autre.
[pause 6s]
Et quelque part... vous n'êtes plus tout à fait là.
[pause 5s]
Votre corps est dans la pièce. Votre présence est dans sa détresse.
[pause 8s]

Le paradoxe : au moment où votre patient a le plus besoin que vous soyez là...
[pause 5s]
c'est précisément quand vous risquez d'être le moins présent.
[pause 10s]

Le cinq-cinq-cinq au cœur de la consultation...
[pause 5s]
n'est pas visible.
[pause 5s]
Ce n'est pas : "attendez, je dois respirer."
[pause 5s]
C'est un cycle silencieux. Intérieur. Pendant que vous écoutez.
[pause 5s]
Pendant qu'il parle. Pendant un silence.
[pause 5s]
Un seul cycle. Discret. Presque imperceptible.
[pause 8s]

Ce cycle fait quelque chose de précis.
[pause 5s]
Il vous repose dans votre corps.
[pause 5s]
Il rappelle à votre système nerveux qu'il y a un sol.
[pause 4s]
Que la détresse de l'autre est réelle. Et qu'elle lui appartient.
[pause 5s]
Que votre rôle est de tenir l'espace... pas de partager le poids.
[pause 10s]

Prenons un moment maintenant pour ancrer ça dans le corps.
[pause 5s]
Fermez les yeux. Visualisez une consultation difficile.
[pause 5s]
Pas la pire. Juste une qui a pesé.
[pause 5s]
La personne en face. Sa voix. Ce qu'elle portait.
[pause 8s]

Sentez ce que votre corps porte en ce moment en y pensant.
[pause 5s]
Les épaules. La poitrine. La mâchoire.
[pause 8s]

Maintenant... ancrez vos pieds au sol. Les deux. Complètement.
[pause 5s]
Sentez le dossier qui vous soutient. Votre dos qui existe.
[pause 5s]
Vous n'êtes pas dans sa détresse. Vous êtes dans votre corps. Ici.
[pause 8s]

Dix cycles. Pendant que vous respirez...
[pause 4s]
restez dans votre corps. Pas dans le scénario.
[pause 5s]
Chaque inspiration vous ramène ici.
[pause 5s]
Chaque expiration dépose ce qui ne vous appartient pas.
[pause 8s]

Nous commençons.

[BREATHING_CYCLES]

Bien.
[pause 10s]

Sentez la différence entre recevoir... et porter.
[pause 5s]
Vous pouvez recevoir la souffrance de quelqu'un... sans la porter dans votre corps.
[pause 5s]
Ce n'est pas de la distance. C'est de la présence solide.
[pause 8s]

La chose la plus utile que vous puissiez faire pour votre patient dans un moment difficile...
[pause 5s]
c'est rester debout. Ancré. Disponible. Sans vous effondrer avec lui.
[pause 5s]
Votre stabilité... est sa ressource la plus précieuse.
[pause 8s]

Et votre stabilité... ce n'est pas une qualité innée. C'est un geste.
[pause 5s]
Celui-là. Disponible. En temps réel. Dans la consultation elle-même.
[pause 10s]

Rouvrez les yeux... doucement. Pieds au sol. Dos ancré. Présence choisie.
[pause 6s]
SCRIPT,

        '05-enseignant' => <<<'SCRIPT'
Vous l'avez déjà vécu.
[pause 6s]

Ce moment où la salle vous échappe.
[pause 5s]
Pas progressivement. D'un coup.
[pause 5s]
Une conversation parasite qui enflamme. Un incident. Un élève qui défie.
[pause 5s]
Ou simplement cette énergie collective... ce bruit diffus...
[pause 5s]
qui monte, qui s'installe, et qui transforme trente individus en quelque chose d'ingérable.
[pause 8s]

Et vous. Debout. Au milieu.
[pause 5s]
Quelque chose monte en vous aussi.
[pause 5s]
De la frustration. De l'impuissance. Ou pire... de la colère.
[pause 8s]

Voici ce qui se passe neurobiologiquement dans cette salle.
[pause 6s]

Quand un groupe humain s'emballe... les systèmes nerveux se synchronisent dans le désordre.
[pause 5s]
L'un agite l'autre. L'autre amplifie le premier.
[pause 5s]
En quelques secondes... la salle entière est dans un état collectif d'activation.
[pause 8s]

Et votre voix... votre présence... vos mots...
[pause 5s]
ont un impact démesuré dans ce moment.
[pause 5s]
Ils peuvent amplifier. Ou ils peuvent interrompre.
[pause 5s]
Pas par ce que vous dites.
[pause 5s]
Par ce que vous êtes... dans les cinq secondes qui suivent.
[pause 10s]

C'est ici que tout se joue.
[pause 6s]

L'enseignant qui hausse la voix... envoie un signal de menace.
[pause 5s]
Le cortisol dans la salle monte. L'agitation se fige... ou s'intensifie.
[pause 5s]
Les élèves se souviennent de ce moment. Pas de la leçon.
[pause 8s]

L'enseignant qui s'arrête...
[pause 5s]
qui ralentit délibérément...
[pause 5s]
qui parle moins fort... plus lentement... plus posément...
[pause 5s]
envoie un signal radicalement différent.
[pause 5s]
Un signal qui dit : quelqu'un ici est encore debout. On peut descendre.
[pause 8s]

Et le groupe... se règle dessus. Pas immédiatement. Mais il se règle.
[pause 5s]
Parce que c'est ce que font les systèmes nerveux en groupe.
[pause 5s]
Ils cherchent le régulateur le plus stable dans la pièce.
[pause 5s]
Et ce régulateur... c'est vous.
[pause 10s]

La question n'est donc pas : comment je fais taire la salle ?
[pause 5s]
La question est : comment je reste le régulateur... quand tout tire dans l'autre sens ?
[pause 10s]

La réponse est physique avant d'être stratégique.
[pause 6s]

Avant de parler... vous respirez.
[pause 5s]
Un seul cycle. Silencieux. Invisible.
[pause 5s]
Pendant que la salle bruisse... vous faites une chose que personne ne voit.
[pause 5s]
Vous abaissez votre rythme cardiaque.
[pause 5s]
Vous ancrez vos pieds.
[pause 5s]
Vous choisissez votre état.
[pause 8s]

Et puis vous parlez. Lentement. Distinctement. Sans force.
[pause 5s]
Pas pour punir. Pour ramener.
[pause 5s]
Vous êtes le calme que la salle cherche sans le savoir.
[pause 10s]

Fermez les yeux. Visualisez cette salle perdue que vous connaissez.
[pause 5s]
Le bruit. L'agitation. Cette énergie collective qui déborde.
[pause 8s]

Sentez ce que ça fait dans votre corps. La montée. Le rétrécissement.
[pause 8s]

Maintenant. Ancrez.
[pause 5s]
Pieds au sol. Dos droit. Épaules qui s'abaissent.
[pause 5s]
Vous êtes encore debout.
[pause 8s]

Dix cycles. Pendant que vous respirez...
[pause 5s]
laissez descendre la pression de la salle.
[pause 5s]
Elle n'est pas en vous. Elle est devant vous. C'est différent.
[pause 5s]
Et vous... vous êtes le point fixe.
[pause 8s]

Nous commençons.

[BREATHING_CYCLES]

Bien.
[pause 10s]

Sentez la qualité de cette présence. Ancrée. Solide. Douce en même temps.
[pause 8s]

Ce n'est pas de l'autorité imposée.
[pause 5s]
C'est de la régulation offerte.
[pause 5s]
Une salle perdue a juste besoin de retrouver quelqu'un de stable pour se recalibrer.
[pause 5s]
Et vous... vous êtes capable de l'être.
[pause 5s]
Pas toujours parfaitement. Mais de plus en plus consciemment.
[pause 10s]

La prochaine fois que la salle s'emballe... vous savez quoi faire.
[pause 5s]
Pas hausser la voix. Pas forcer.
[pause 5s]
Un cycle. Silencieux. Et puis être ce point fixe.
[pause 5s]
La salle va se régler dessus.
[pause 8s]

Rouvrez les yeux... doucement. La salle vous regarde. Vous êtes prêt.
[pause 6s]
SCRIPT,

        '05-leader' => <<<'SCRIPT'
Il n'y a pas de bonne réponse.
[pause 6s]

Vous le savez. Vous avez cherché.
[pause 5s]
Vous avez retourné le problème dans tous les sens.
[pause 5s]
Vous avez regardé les chiffres, les avis, les précédents.
[pause 5s]
Et il n'y a toujours pas de bonne réponse.
[pause 5s]
Seulement des mauvaises de différentes natures.
[pause 8s]

Et on attend. On attend que vous tranchiez.
[pause 5s]
Aujourd'hui. Maintenant. Bientôt.
[pause 8s]

Ce moment a un nom.
[pause 5s]
La décision impossible.
[pause 6s]

Tout leader la rencontre. Plusieurs fois. À des niveaux différents.
[pause 5s]
Parfois c'est une réorganisation qui blesse des gens.
[pause 4s]
Parfois c'est un partenariat à rompre. Un projet à abandonner.
[pause 4s]
Une personne à ne pas garder. Une direction à changer.
[pause 5s]
Des choix où quoi que vous décidiez... quelque chose est perdu.
[pause 10s]

Voici ce que fait votre cerveau dans ce moment.
[pause 5s]
Il cherche la certitude. Il la veut absolue. Il refuse de trancher sans elle.
[pause 5s]
Et comme la certitude absolue n'existe pas...
[pause 5s]
il tourne. Il reporte. Il cherche encore.
[pause 5s]
Non par faiblesse. Par précision. Votre cerveau veut bien faire.
[pause 8s]

Mais il y a un coût.
[pause 5s]
Le cortisol monte. L'adrénaline tient les muscles en alerte.
[pause 5s]
Le sommeil se fragmente. Les décisions secondaires se dégradent.
[pause 5s]
Et la décision importante... continue d'attendre dans son propre siège.
[pause 8s]

Les leaders qui traversent ces moments avec le plus de clarté...
[pause 5s]
ne cherchent pas plus d'informations.
[pause 5s]
Ils cherchent un état.
[pause 6s]

Pas l'état de la certitude. Ils savent qu'elle ne viendra pas.
[pause 5s]
L'état de la clarté acceptable.
[pause 5s]
L'état dans lequel vous pouvez voir ce qui compte vraiment.
[pause 5s]
Pas tout. Ce qui compte.
[pause 5s]
Et trancher depuis là.
[pause 10s]

Ce que le cinq-cinq-cinq fait dans ce moment...
[pause 5s]
c'est activer le cortex préfrontal ventromédian.
[pause 5s]
Le siège du jugement moral. De la perspective à long terme. De l'alignement avec vos valeurs.
[pause 5s]
Ce circuit est inhibé sous l'adrénaline.
[pause 5s]
Il se réactive avec la respiration lente.
[pause 8s]

En d'autres termes : votre capacité à prendre une bonne décision dans l'incertitude...
[pause 5s]
est biologiquement liée à votre état respiratoire.
[pause 5s]
Pas à votre intelligence. Pas à votre expérience.
[pause 5s]
À votre respiration dans les trente secondes qui précèdent.
[pause 10s]

Posez tout. Ce dossier. Ce dilemme. Ces chiffres.
[pause 5s]
Pas pour les fuir. Pour les regarder de plus haut.
[pause 5s]
Installez-vous. Dos droit. Mains qui s'ouvrent.
[pause 6s]
Fermez les yeux.
[pause 8s]

Pendant les dix cycles... laissez une seule question être présente.
[pause 5s]
Pas : quelle est la bonne décision ?
[pause 5s]
Mais : à quoi je tiens vraiment dans cette situation ?
[pause 5s]
Quelle valeur est-ce que je veux que cette décision serve ?
[pause 8s]

Cette question n'a pas besoin de réponse immédiate.
[pause 5s]
Elle a besoin d'espace. Et nous allons lui en donner.
[pause 8s]

Nous commençons.

[BREATHING_CYCLES]

Bien.
[pause 10s]

Restez encore dans ce silence. Avec cette question.
[pause 8s]

Sentez ce qui a changé. Pas dans le problème.
[pause 5s]
Dans votre rapport au problème.
[pause 5s]
La même situation. Un regard légèrement différent.
[pause 5s]
Une légère distance entre vous et l'urgence.
[pause 8s]

Ce n'est pas de la désinvolture. C'est du recul.
[pause 5s]
Et dans ce recul... quelque chose de votre propre clarté refait surface.
[pause 5s]
Ce que vous savez. Ce qui compte. Ce que vous pouvez assumer.
[pause 10s]

Vous n'avez peut-être pas encore la décision.
[pause 5s]
Mais vous êtes dans un meilleur état pour la prendre.
[pause 5s]
Et ça... c'est tout ce que cette pause pouvait vous donner.
[pause 5s]
Le reste vous appartient.
[pause 8s]

Rouvrez les yeux... doucement. Le problème est toujours là. Et vous aussi.
[pause 6s]
SCRIPT,

        '05-educateur' => <<<'SCRIPT'
Le groupe résiste.
[pause 6s]

Vous le sentez depuis ce matin.
[pause 5s]
Les bras croisés. Les regards qui glissent. Les réponses courtes.
[pause 5s]
Ou pire — le silence poli mais vide.
[pause 5s]
Ces sourires de façade qui disent : on est là, on fait l'effort, mais non.
[pause 8s]

Et vous... vous avez préparé. Vous avez une méthode. Vous croyez en ce que vous faites.
[pause 5s]
Et pourtant — rien ne passe.
[pause 8s]

Ce moment est l'un des plus difficiles du métier d'éducateur.
[pause 5s]
Parce qu'il touche quelque chose de central.
[pause 5s]
L'identité.
[pause 8s]

Quand un groupe résiste... la première interprétation est presque toujours la même.
[pause 5s]
Je fais quelque chose de mal. Mon contenu n'est pas bon. Je ne suis pas à la hauteur.
[pause 5s]
Ils me rejettent. Moi.
[pause 8s]

Cette interprétation est souvent fausse.
[pause 5s]
Voici ce qu'est réellement la résistance dans un groupe.
[pause 6s]

La résistance est une information.
[pause 5s]
Elle dit : il y a quelque chose que ce groupe n'est pas encore prêt à traverser.
[pause 5s]
Pas parce qu'il ne veut pas. Parce qu'il n'a pas encore le sentiment d'être en sécurité.
[pause 6s]
La sécurité pour changer. Pour questionner. Pour lâcher quelque chose d'ancien.
[pause 8s]

Et la sécurité dans un groupe... ne vient pas du contenu.
[pause 5s]
Elle vient de la qualité de présence de celui qui tient l'espace.
[pause 8s]

Voici le paradoxe cruel de la résistance.
[pause 5s]
C'est précisément quand le groupe résiste...
[pause 5s]
que l'éducateur, sous pression, perd de sa présence.
[pause 5s]
Il force. Il accélère. Il tente de convaincre. Il se défend.
[pause 5s]
Et ce faisant... il réduit exactement ce dont le groupe a besoin.
[pause 5s]
L'espace sûr pour ne pas être convaincu tout de suite.
[pause 10s]

Ce que la résistance appelle... c'est plus de présence. Pas moins.
[pause 5s]
Pas plus de contenu. Pas plus d'arguments.
[pause 5s]
Plus d'ancrage. Plus de calme. Plus de solidité tranquille.
[pause 5s]
La capacité à tenir sans avoir besoin que ça marche maintenant.
[pause 10s]

Vous pouvez pratiquer ça maintenant.
[pause 5s]
Fermez les yeux. Visualisez ce groupe. Sa résistance. Ce silence qui pèse.
[pause 8s]

Sentez ce que ça crée dans votre corps.
[pause 5s]
L'inconfort. Le besoin de faire quelque chose. L'urgence de récupérer l'attention.
[pause 8s]

Maintenant... restez. Sans bouger. Sans résoudre.
[pause 5s]
Ancrez vos pieds. Allongez votre dos.
[pause 5s]
Laissez la résistance être là — sans que ça vous déplace.
[pause 8s]

Dix cycles. Pendant que vous respirez...
[pause 5s]
entrainez-vous à tenir sans besoin de résultat immédiat.
[pause 5s]
À être présent à ce qui est... plutôt qu'à ce qui devrait être.
[pause 8s]

Nous commençons.

[BREATHING_CYCLES]

Bien.
[pause 10s]

Sentez ce que vous portez maintenant.
[pause 5s]
Pas la nécessité que ça marche.
[pause 5s]
Juste la présence. Juste l'espace que vous êtes capable de tenir.
[pause 10s]

Quand vous retournerez face à ce groupe...
[pause 5s]
vous pouvez nommer ce qui se passe. Directement. Calmement.
[pause 5s]
Je sens que quelque chose ne circule pas facilement ce matin. C'est juste. Ce n'est pas un problème.
[pause 5s]
Prenez quelques secondes. Respirons ensemble si vous voulez.
[pause 8s]

Cette honnêteté tranquille... désamorce souvent plus que n'importe quelle technique.
[pause 5s]
Parce qu'elle dit au groupe : il n'y a pas de danger à ne pas être prêt.
[pause 5s]
Et dans cet espace-là... parfois quelque chose se déplace enfin.
[pause 10s]

Rouvrez les yeux... doucement. Le groupe vous attend. Vous êtes prêt à tenir.
[pause 6s]
SCRIPT,

        '05-bebe' => <<<'SCRIPT'
Il pleure depuis longtemps.
[pause 6s]

Vous avez tout fait. Vous avez changé, nourri, porté, bercé.
[pause 5s]
Vous avez vérifié la température, le ventre, les habits.
[pause 5s]
Vous avez chanté. Vous avez marché. Vous avez proposé tous les angles.
[pause 8s]

Et rien.
[pause 6s]

Les pleurs continuent.
[pause 5s]
Et quelque chose en vous commence à se fissurer.
[pause 8s]

Ce n'est pas de l'impuissance ordinaire.
[pause 5s]
C'est l'une des expériences les plus biologiquement intenses qui existent.
[pause 6s]

Les pleurs d'un nourrisson activent le cerveau de l'adulte avec une précision absolue.
[pause 5s]
Ils déclenchent une alarme dans l'amygdale.
[pause 5s]
Immédiate. Puissante. Difficile à éteindre.
[pause 5s]
Ce n'est pas de la faiblesse. C'est de la biologie évolutive.
[pause 5s]
Le cerveau humain est câblé pour répondre aux pleurs d'un enfant. Sans exception.
[pause 8s]

Et quand la réponse ne suffit pas... quand les pleurs continuent malgré tout...
[pause 5s]
cette alarme reste allumée. Et monte.
[pause 5s]
La frustration. L'inquiétude. L'épuisement.
[pause 5s]
L'impression de ne pas être à la hauteur.
[pause 5s]
Parfois... quelque chose qui ressemble à de la colère.
[pause 8s]

Ce que vous ne vous permettez peut-être pas de dire... c'est que ce moment vous dépasse.
[pause 5s]
Que vous ne savez plus. Que vous avez besoin d'aide. Que votre corps est à bout.
[pause 8s]

Je vais vous dire quelque chose d'important.
[pause 5s]
Votre état dans ce moment... est reçu par cet enfant.
[pause 5s]
Il peut vous entendre vous tenir. Ou vous sentir perdre pied.
[pause 5s]
Et quand il vous sent perdre pied... ses propres pleurs s'amplifient.
[pause 5s]
Pas pour vous blesser. Parce que son système nerveux cherche votre régulation.
[pause 5s]
Et il ne la trouve plus.
[pause 8s]

La chose la plus utile que vous puissiez faire pour lui en ce moment...
[pause 5s]
n'est pas de trouver une nouvelle technique.
[pause 5s]
C'est de revenir à vous-même.
[pause 5s]
D'interrompre l'alarme une dizaine de secondes.
[pause 5s]
Et de lui offrir à nouveau cette constante qu'il cherche.
[pause 5s]
Votre rythme cardiaque qui ralentit.
[pause 10s]

Posez-le en sécurité si c'est possible. Ou gardez-le dans vos bras... mais reculez d'un pas intérieur.
[pause 5s]
Sentez le sol sous vos pieds.
[pause 5s]
Desserrez vos mains.
[pause 5s]
Desserrez vos épaules.
[pause 5s]
Desserrez vos mâchoires.
[pause 8s]

Fermez les yeux une seconde.
[pause 5s]
Juste vous. Juste votre corps. Juste ce sol sous vos pieds.
[pause 8s]

Dix cycles. Pendant que vous respirez...
[pause 5s]
vous n'êtes pas en train d'abandonner. Vous êtes en train de revenir.
[pause 5s]
Revenir dans votre corps. Dans votre calme.
[pause 5s]
Pour lui redonner ce qu'il cherche.
[pause 8s]

Nous commençons.

[BREATHING_CYCLES]

Bien.
[pause 10s]

Sentez vos mains. Elles se sont ouvertes. Leur tonus a changé.
[pause 5s]
Sentez votre rythme cardiaque. Il a descendu.
[pause 5s]
Sentez vos épaules. Elles portent moins.
[pause 8s]

Maintenant... rapprochez-vous. Ou reprenez-le si vous l'avez posé.
[pause 5s]
Avec ces mains-là. Ce rythme cardiaque. Cette qualité de présence.
[pause 5s]
Il va le recevoir.
[pause 5s]
Pas immédiatement peut-être. Mais il va le recevoir.
[pause 8s]

Et si les pleurs continuent encore après ça...
[pause 5s]
c'est une autre conversation. Avec un médecin. Avec quelqu'un qui peut aider.
[pause 5s]
Vous n'êtes pas seul. Vous n'avez pas à porter ça sans ressource.
[pause 8s]

Mais dans ce moment... vous avez fait la chose la plus précieuse.
[pause 5s]
Vous avez choisi de revenir à vous. Pour lui.
[pause 5s]
C'est exactement ce que font les bons soignants de l'enfance.
[pause 8s]

Rouvrez les yeux... doucement. Vous êtes là. Il a besoin que vous soyez là.
[pause 6s]
SCRIPT,

        '05-proches' => <<<'SCRIPT'
Les mots sont sur le point de sortir.
[pause 6s]

Vous les sentez. Dans la gorge. Dans la poitrine.
[pause 5s]
Des mots que vous regretterez peut-être. Ou peut-être pas tout de suite.
[pause 5s]
Mais qui laisseront quelque chose.
[pause 5s]
Chez l'enfant qui vous regarde. Chez le conjoint qui attend.
[pause 5s]
Chez vous aussi.
[pause 8s]

Ce moment... vous le connaissez.
[pause 5s]
C'est le point de rupture.
[pause 6s]

Il arrive toujours à un endroit précis.
[pause 5s]
Pas après une grande catastrophe. Après l'accumulation silencieuse de petites choses.
[pause 5s]
La journée qui a été longue. La demande de trop. L'intonation mal choisie.
[pause 5s]
Le verre renversé. La troisième fois qu'on vous demande la même chose.
[pause 5s]
Quelque chose qui en soi ne mérite pas ce qui va sortir de vous.
[pause 8s]

Et pourtant. Quelque chose va sortir.
[pause 8s]

Voici ce qui se passe dans votre cerveau à ce moment précis.
[pause 6s]

L'amygdale a pris le contrôle.
[pause 5s]
Le circuit de la menace est activé.
[pause 5s]
Votre cortex préfrontal — celui qui évalue, qui relativise, qui choisit les mots — est en partie hors ligne.
[pause 6s]
Ce n'est pas un défaut de caractère.
[pause 5s]
C'est de la neurologie.
[pause 5s]
Et cela arrive à tous les humains. Sans exception.
[pause 8s]

Mais voici quelque chose de fondamental.
[pause 5s]
Entre l'impulsion... et l'action...
[pause 5s]
il y a un espace.
[pause 6s]
Pas toujours visible. Pas toujours facile à saisir.
[pause 5s]
Mais il est là.
[pause 6s]
Une fraction de seconde.
[pause 5s]
Parfois deux.
[pause 5s]
Et dans cet espace... vous pouvez faire quelque chose.
[pause 10s]

Pas tout. Pas un discours calme et parfait.
[pause 5s]
Juste une expiration longue.
[pause 5s]
Pas un cycle complet. Une expiration.
[pause 5s]
Lente. Contrôlée.
[pause 5s]
Qui dit à votre amygdale : la menace n'est pas physique.
[pause 5s]
Tu peux abaisser le niveau d'alerte.
[pause 8s]

Cette expiration change ce qui est possible dans les cinq secondes suivantes.
[pause 5s]
Pas toujours. Pas miraculeusement.
[pause 5s]
Mais suffisamment souvent pour que ce soit la compétence la plus importante que vous puissiez cultiver.
[pause 5s]
Dans votre maison. Avec vos proches.
[pause 10s]

Entraînons-nous à cette expiration maintenant.
[pause 5s]
Fermez les yeux. Pensez à ce moment. Celui que vous connaissez.
[pause 5s]
La tension qui monte. Le point de rupture.
[pause 8s]

Sentez-le dans le corps. Réellement.
[pause 5s]
La gorge. La poitrine. Les poings qui se ferment.
[pause 5s]
Ne le fuyez pas. Restez-y un moment.
[pause 8s]

Et maintenant. Une seule expiration longue.
[pause 5s]
Cinq secondes. Douce. Lente. Par le nez si possible.
[pause 5s]
Laissez la tension sortir avec.
[pause 8s]

Une autre. Si vous pouvez.
[pause 8s]

Et une troisième. Avec l'intention : je ne suis pas sous menace physique. Je peux choisir.
[pause 10s]

Maintenant les dix cycles complets. Pour ancrer ça dans le corps.
[pause 5s]
Pour que ce geste soit disponible automatiquement... au moment où vous en aurez besoin.
[pause 8s]

Nous commençons.

[BREATHING_CYCLES]

Bien.
[pause 10s]

Restez dans ce calme un instant.
[pause 5s]
Sentez ce qu'il y a de disponible dans cet état.
[pause 5s]
Le choix. La distance. La possibilité de parler différemment.
[pause 8s]

Vous ne serez pas parfait. Personne ne l'est.
[pause 5s]
Vous allez encore vous emporter parfois. C'est humain.
[pause 5s]
Ce que vous êtes en train de construire... ce n'est pas la perfection.
[pause 5s]
C'est un répertoire.
[pause 5s]
Une réponse de plus disponible dans votre corps... pour les moments difficiles.
[pause 8s]

Et ce répertoire... vos enfants l'observent.
[pause 5s]
Pas vos mots. Votre façon de gérer ce qui déborde.
[pause 5s]
Ce que vous leur montrez là... est plus profond que n'importe quelle leçon.
[pause 5s]
C'est leur futur répertoire à eux.
[pause 10s]

Rouvrez les yeux... doucement. La situation est toujours là. Et vous aussi. Autrement.
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

        '03' => <<<'SCRIPT'
Welcome to this third module.
[pause 5s]

You made it here.
[pause 4s]
That's not nothing.
[pause 5s]
It means something resonated.
[pause 4s]
That the five-five-five found a place in you... somewhere to take root.
[pause 8s]

In the first module... you understood the mechanism.
[pause 4s]
A neurological switch. An available gesture.
[pause 5s]
In the second module... you recognized your territory.
[pause 4s]
A family. A reality. A landscape where you could see yourself.
[pause 8s]

This third module carries a single word.
[pause 5s]
Protocol.
[pause 8s]

Not a rigid routine.
[pause 4s]
Not a to-do list.
[pause 5s]
Not one more discipline to add to an already packed day.
[pause 8s]

A protocol... in the true sense of the word...
[pause 4s]
is an architecture.
[pause 5s]
A series of considered gestures... placed at the right points...
[pause 4s]
that allow something essential to happen...
[pause 4s]
without effort... without negotiation... without a decision to make in the moment.
[pause 10s]

Your personal Breathe Break protocol...
[pause 4s]
is the answer to a single question.
[pause 6s]

When... exactly... in my day...
[pause 4s]
do I activate the five-five-five?
[pause 10s]

Because a method without a precise moment... remains an intention.
[pause 5s]
And an intention... however sincere...
[pause 4s]
disappears under the pressure of daily life.
[pause 5s]
Under urgencies. Under the unexpected. Under fatigue.
[pause 8s]

For a gesture to become a real anchor...
[pause 4s]
it must be attached to something that already exists in your day.
[pause 5s]
Not an abstract time.
[pause 4s]
A concrete event.
[pause 5s]
A trigger that tells the body: this is the moment.
[pause 10s]

We're going to build your protocol around three pillars.
[pause 6s]

The first pillar... the morning anchor.
[pause 8s]

The morning carries a unique quality.
[pause 5s]
Before the flow begins... before messages... before decisions...
[pause 4s]
there is a space.
[pause 5s]
Brief. Often overlooked.
[pause 4s]
But real.
[pause 8s]

That space... belongs to you.
[pause 5s]
One single cycle of the five-five-five.
[pause 4s]
Before looking at your phone.
[pause 4s]
Before the first coffee.
[pause 4s]
Before opening the first app.
[pause 8s]

Not five minutes. Not ten.
[pause 4s]
Fifteen seconds.
[pause 5s]
One breath of intention.
[pause 5s]
A gesture that says to the nervous system: today... I choose my presence.
[pause 10s]

Some people activate it when they wake up.
[pause 4s]
Before even putting their feet on the floor.
[pause 5s]
The body still in half-sleep... the day not yet started.
[pause 4s]
One cycle. Eyes closed. The breath slow.
[pause 5s]
And something settles... before anything has even begun.
[pause 10s]

Others activate it in the shower.
[pause 4s]
In the warm silence of the water.
[pause 5s]
One cycle between soaping up and rinsing off.
[pause 4s]
The noise of the world kept at a distance a few seconds longer.
[pause 8s]

Others activate it in the car.
[pause 4s]
Before starting the engine.
[pause 5s]
Seated. Seatbelt on. Engine still off for ten more seconds.
[pause 4s]
Both hands on the wheel.
[pause 4s]
One cycle.
[pause 5s]
Then start the car.
[pause 10s]

It doesn't matter where.
[pause 4s]
What matters... is that it's attached to a gesture that already exists.
[pause 5s]
An automatic trigger.
[pause 4s]
Something you do every morning without thinking.
[pause 5s]
And to that trigger... you attach one single cycle.
[pause 10s]

The second pillar... the transition anchor.
[pause 8s]

Your day isn't linear.
[pause 4s]
It's made of passages.
[pause 5s]
Moments where you leave one thing to enter another.
[pause 5s]
A call that ends and a meeting that begins.
[pause 4s]
One appointment and the next.
[pause 4s]
One class and the hallway.
[pause 4s]
Lunch and the return to work.
[pause 8s]

These passages... are doorways.
[pause 5s]
And a doorway... can be crossed in two ways.
[pause 6s]

The first way: carrying everything that came before.
[pause 5s]
The stress of the meeting... into the appointment.
[pause 4s]
The fatigue of the class... into the meal.
[pause 4s]
The tension of the day... into the evening.
[pause 5s]
Until everything accumulates... until everything spills over.
[pause 8s]

The second way: put it down.
[pause 5s]
Not forget. Not deny.
[pause 4s]
Just... put it down.
[pause 5s]
One cycle of the five-five-five in the passage.
[pause 4s]
And cross the doorway with what's needed... not with what was.
[pause 10s]

The transition anchor... is the activation moment you visualized in the previous module.
[pause 5s]
The hallway before the door.
[pause 4s]
The elevator between two meetings.
[pause 4s]
The threshold of the room.
[pause 4s]
The corridor before opening.
[pause 4s]
Hands resting before touching the material.
[pause 8s]

This is not an addition to your day.
[pause 4s]
It's a different quality in the passages that already exist.
[pause 10s]

The third pillar... the evening anchor.
[pause 8s]

The evening carries a different quality.
[pause 5s]
The day is behind you.
[pause 4s]
But often... it hasn't been put down.
[pause 5s]
It keeps turning. In thoughts. In the body. In the shoulders.
[pause 5s]
Long after the events are over.
[pause 8s]

The evening anchor... is the gesture of release.
[pause 5s]
One complete cycle.
[pause 4s]
Not to erase what happened.
[pause 4s]
To leave it... where it took place.
[pause 5s]
In the day. Past. Done.
[pause 8s]

Some people activate it on the commute home.
[pause 4s]
Seated. Eyes open or closed.
[pause 4s]
One cycle between the office and home.
[pause 5s]
So as not to bring the professional intensity into the domestic space.
[pause 8s]

Others activate it before dinner.
[pause 4s]
Hand on the kitchen door handle.
[pause 5s]
One cycle. The day stays outside. The evening begins here.
[pause 8s]

Others activate it when going to bed.
[pause 4s]
Lying down. In the dark.
[pause 5s]
One cycle to tell the nervous system: it's over for today.
[pause 4s]
You can stop watching.
[pause 4s]
You can come down.
[pause 10s]

Those are the three pillars.
[pause 6s]

Morning. Transition. Evening.
[pause 6s]

Three moments. Three cycles.
[pause 5s]
Forty-five seconds in total... spread across the day.
[pause 5s]
And a fundamentally different quality of presence.
[pause 10s]

Now... a precise question.
[pause 5s]

For you... personally...
[pause 4s]
what is the morning trigger? What daily gesture can carry that first cycle?
[pause 8s]

What is your main transition moment?
[pause 5s]
The passage in your day that most needs this anchoring quality?
[pause 8s]

And in the evening... what gesture can carry that third cycle?
[pause 5s]
Before arriving home. Before dinner. Before sleep.
[pause 8s]

Take the time to answer genuinely.
[pause 5s]
Not an ideal answer. A true one.
[pause 5s]
One that fits your reality... as it actually is.
[pause 10s]

There is something that neuroscience research confirms.
[pause 5s]
It's not the duration that creates a deep anchor.
[pause 4s]
It's repetition in a stable context.
[pause 6s]

Twenty activations in your real context...
[pause 4s]
create a measurable neurological trace.
[pause 5s]
Thirty activations... and the gesture begins to become automatic.
[pause 5s]
Fifty activations... and your nervous system integrates it as a permanent resource.
[pause 8s]

Not fifty minutes.
[pause 4s]
Fifty gestures.
[pause 5s]
Of fifteen seconds each.
[pause 5s]
Attached to moments that already exist in your life.
[pause 10s]

That's why your protocol needs to be realistic.
[pause 5s]
A gesture you can maintain... even on difficult days.
[pause 4s]
Even on days when everything has shifted.
[pause 4s]
Even on days when you forgot in the morning.
[pause 5s]
One single cycle in the transition... and the thread is kept.
[pause 8s]

The protocol is not a performance.
[pause 5s]
It's a faithfulness.
[pause 5s]
A gentle faithfulness to a gesture that belongs to you.
[pause 10s]

In a few moments... we'll practice together one last time.
[pause 4s]
Ten complete cycles.
[pause 5s]
And during this practice... I'm asking something particular of you.
[pause 6s]

Let your three moments pass through you.
[pause 5s]
Morning. Transition. Evening.
[pause 5s]
Visualize each one briefly... effortlessly.
[pause 4s]
The morning trigger.
[pause 4s]
The transition passage in your day.
[pause 4s]
The evening gesture.
[pause 8s]

Let these three moments settle in the body.
[pause 4s]
Not in the mind. In the body.
[pause 5s]
Because that's where the protocol takes hold.
[pause 5s]
Not in intentions. In muscle memory.
[pause 8s]

Settle in.
[pause 4s]
Lengthen your spine. Release your shoulders. Ground your feet.
[pause 3s]
Close your eyes... if that feels right.
[pause 8s]

We begin.

[BREATHING_CYCLES]

Good.
[pause 8s]

Stay a moment longer in this space.
[pause 5s]
Your three moments... you know them now.
[pause 5s]
Not as an idea.
[pause 4s]
As a gesture anchored in the body.
[pause 10s]

Open your eyes... gently.
[pause 5s]
Take a moment to feel the quality of your presence.
[pause 5s]
Right now. Here.
[pause 4s]
This is your protocol... in action.
[pause 10s]

You have everything you need.
[pause 5s]
The method. The mechanism. Your family. Your three anchors.
[pause 6s]

This is not a program among others.
[pause 4s]
It's a living tool.
[pause 5s]
That grows with you. That refines over time.
[pause 5s]
That becomes more precise... more profound... more natural.
[pause 5s]
As you activate it in your real life.
[pause 10s]

One last thing before I let you go.
[pause 6s]

The Breathe Break... is not a solution to your difficulties.
[pause 5s]
It's not a cure for professional burnout.
[pause 4s]
It's not an answer to everything.
[pause 8s]

It's something more modest... and more powerful at the same time.
[pause 5s]
It's a gesture that says: I'm still here.
[pause 5s]
I choose to be present.
[pause 5s]
Not perfect. Not invincible.
[pause 4s]
Present.
[pause 8s]

And in the professions that touch the human...
[pause 4s]
in the homes where children are growing...
[pause 4s]
in the spaces where people heal... learn... create...
[pause 5s]
that presence... is everything.
[pause 8s]

Thank you for completing these three modules.
[pause 5s]
Now... go activate your protocol.
[pause 5s]
In your universe. In your reality. In your life.
[pause 6s]
SCRIPT,

        // ── MODULE 04 EN ──────────────────────────────────────

        '04-creatif' => <<<'SCRIPT'
Welcome.
[pause 4s]
You are a creator.
[pause 3s]
That means something specific — and demanding.
[pause 5s]
It means your state before you begin... shapes what you make.
[pause 6s]
Not partially. Entirely.
[pause 8s]

The first touch is never neutral.
[pause 5s]
The first brushstroke. The first word. The first chord.
[pause 4s]
It carries the state you arrived in.
[pause 8s]

So the question this module asks is simple.
[pause 5s]
What state do you want to bring to your creative threshold?
[pause 8s]

This is what we call the before.
[pause 5s]
The moment between the world... and the work.
[pause 4s]
It costs nothing. It changes everything.
[pause 8s]

Let's do it now. Together.
[pause 5s]
Settle into your posture.
[pause 4s]
Put your hands where they'll be when you create.
[pause 5s]
Feel the contact. The weight. The temperature.
[pause 8s]

Inhale... for five seconds.
[BREATHING_CYCLES]

Notice what's different in your hands now.
[pause 5s]
In your vision. In your pace.
[pause 6s]
That state... is available before every session.
[pause 5s]
Every time. Without exception.
[pause 8s]

Your creative practice deserves this entrance.
[pause 5s]
Give it one — starting today.
[pause 6s]
SCRIPT,

        '04-soin' => <<<'SCRIPT'
Welcome.
[pause 4s]
You work in care.
[pause 3s]
Which means you carry things.
[pause 5s]
Other people's pain. Their fear. Their weight.
[pause 6s]
And yours — that you've learned to set aside.
[pause 8s]

The hallway between two consultations is not wasted time.
[pause 5s]
It is the space where you can reset.
[pause 4s]
Where you can choose who you want to be... for the next person who walks through that door.
[pause 10s]

This module gives that space a content.
[pause 5s]
One cycle. One breath. One question.
[pause 8s]

Take a moment now.
[pause 4s]
Close your eyes if you can.
[pause 4s]
Place both feet flat on the floor.
[pause 5s]
Feel the solidity beneath you.
[pause 8s]

Inhale... for five seconds.
[BREATHING_CYCLES]

That's what it feels like... to arrive.
[pause 5s]
Not rushed. Not already inside the next patient's story.
[pause 6s]
Present. Available. Solid.
[pause 8s]

Every person you care for... deserves this version of you.
[pause 5s]
And so do you.
[pause 6s]
SCRIPT,

        '04-enseignant' => <<<'SCRIPT'
Welcome.
[pause 4s]
You teach.
[pause 3s]
Which means every morning... before a single word is spoken...
[pause 4s]
your state is already teaching something.
[pause 8s]

The way you walk through that door.
[pause 4s]
The pace of your first steps.
[pause 4s]
The quality of your first glance.
[pause 6s]
Students feel this before you speak.
[pause 8s]

The doorknob moment is not a detail.
[pause 5s]
It is the foundation of what follows.
[pause 8s]

Stand now — or sit upright.
[pause 4s]
Feel your feet on the ground.
[pause 4s]
Your hands resting.
[pause 5s]
And let the breath do what it knows how to do.
[pause 8s]

Inhale... for five seconds.
[BREATHING_CYCLES]

That's the state you can bring into every classroom.
[pause 5s]
Not as a performance. As a choice.
[pause 6s]
A choice you make... before the door opens.
[pause 8s]
SCRIPT,

        '04-leader' => <<<'SCRIPT'
Welcome.
[pause 4s]
You lead.
[pause 3s]
Which means before every meeting... every decision... every difficult conversation...
[pause 4s]
the state you're in... sets the tone for everyone in the room.
[pause 8s]

Your nervous system... is the thermostat.
[pause 5s]
When you're regulated... they regulate.
[pause 4s]
When you're scattered... they scatter.
[pause 4s]
Whether you know it or not. Whether you intend it or not.
[pause 8s]

The elevator. The hallway. The thirty seconds before you open the door.
[pause 5s]
That's your moment.
[pause 5s]
Use it.
[pause 8s]

Put your phone in your pocket now.
[pause 4s]
Two feet on the floor.
[pause 4s]
One breath — chosen, not automatic.
[pause 8s]

Inhale... for five seconds.
[BREATHING_CYCLES]

The leader who walks in from that state...
[pause 4s]
makes better decisions.
[pause 3s]
Listens more deeply.
[pause 3s]
Holds the room without effort.
[pause 8s]

That leader is you.
[pause 5s]
Choose it — every time.
[pause 6s]
SCRIPT,

        '04-educateur' => <<<'SCRIPT'
Welcome.
[pause 4s]
You train. You facilitate. You hold space.
[pause 5s]
Which means your presence before the group begins...
[pause 4s]
is already part of the program.
[pause 8s]

An empty room before participants arrive is not empty.
[pause 5s]
It's full of your preparation. Your intention. Your state.
[pause 6s]
What you bring into that space... becomes the container.
[pause 8s]

This module gives that moment a structure.
[pause 5s]
A breath. A question. A reset.
[pause 8s]

Stand in your space — real or imagined.
[pause 4s]
Feel the floor beneath you.
[pause 4s]
The air in the room.
[pause 5s]
The silence before it begins.
[pause 8s]

Inhale... for five seconds.
[BREATHING_CYCLES]

You are now the container.
[pause 5s]
Stable. Present. Open.
[pause 4s]
Whatever the group brings... you won't be moved.
[pause 5s]
You'll hold.
[pause 8s]
SCRIPT,

        '04-bebe' => <<<'SCRIPT'
Welcome.
[pause 4s]
You work with the very beginning of life.
[pause 4s]
With infants. With newborns. With the smallest humans.
[pause 6s]
Who feel everything.
[pause 5s]
Before words. Before concepts. Before explanation.
[pause 8s]

Your hands are not just hands.
[pause 5s]
They are the first language this child encounters.
[pause 6s]
And they speak your state.
[pause 8s]

The tension in your arms.
[pause 3s]
The rhythm of your breathing.
[pause 3s]
The quality of your attention.
[pause 5s]
All of it... arrives before you do.
[pause 8s]

Before you pick up a child... pause now.
[pause 5s]
Hands a few centimetres from your body.
[pause 4s]
Feel them. The weight. The warmth.
[pause 8s]

Inhale... for five seconds.
[BREATHING_CYCLES]

Those hands are different now.
[pause 5s]
Softer. More present. More available.
[pause 6s]
That's what the child will receive.
[pause 6s]
SCRIPT,

        '04-proches' => <<<'SCRIPT'
Welcome.
[pause 4s]
You are returning home.
[pause 4s]
Or you're about to.
[pause 5s]
And between the day you've carried... and the door you're about to open...
[pause 5s]
there is a threshold.
[pause 8s]

What you bring through that door... matters.
[pause 5s]
Not just for you. For them.
[pause 5s]
The people you love most in the world...
[pause 4s]
are waiting for a version of you.
[pause 8s]

This module is about choosing which version that is.
[pause 6s]
Not from guilt. Not from performance.
[pause 5s]
From presence.
[pause 8s]

Wherever you are now — car, train, sidewalk, staircase —
[pause 4s]
stop for a moment.
[pause 4s]
One hand on the door. Or just still, wherever you are.
[pause 8s]

Inhale... for five seconds.
[BREATHING_CYCLES]

That's who walks through the door.
[pause 5s]
Not the meeting. Not the deadline. Not the traffic.
[pause 5s]
You.
[pause 5s]
Present. Warm. Here.
[pause 8s]
SCRIPT,

        // ── MODULE 05 EN ──────────────────────────────────────

        '05-creatif' => <<<'SCRIPT'
Welcome back.
[pause 4s]
You're mid-process.
[pause 4s]
Or you've been derailed from one.
[pause 5s]
Either way — something is in motion. And something is resisting.
[pause 8s]

Creative turbulence is not a problem to solve.
[pause 5s]
It's a signal to read.
[pause 6s]
The block. The doubt. The empty page. The abandoned canvas.
[pause 5s]
They're not failures. They're thresholds.
[pause 8s]

And thresholds... have a single requirement.
[pause 5s]
Presence. Not technique. Not willpower. Not inspiration.
[pause 5s]
Presence.
[pause 8s]

Feel what's here right now.
[pause 5s]
The tension in your jaw. Your shoulders. Your hands.
[pause 5s]
Don't try to release it. Just notice it.
[pause 8s]

Inhale... for five seconds.
[BREATHING_CYCLES]

The resistance hasn't disappeared.
[pause 5s]
But you're no longer inside it.
[pause 5s]
You're alongside it. Watching it.
[pause 6s]
From there... the next gesture becomes possible.
[pause 8s]
SCRIPT,

        '05-soin' => <<<'SCRIPT'
Welcome back.
[pause 4s]
You're in the middle of a difficult consultation.
[pause 4s]
Or you've just come out of one.
[pause 5s]
The weight is still there — in your chest, your shoulders, your thoughts.
[pause 8s]

This is what carrying someone looks like.
[pause 5s]
It's not a weakness. It's the cost of real presence.
[pause 6s]
And it needs a moment of discharge.
[pause 8s]

Right now — still in the hallway, or at your desk, or sitting in your car —
[pause 4s]
you have thirty seconds.
[pause 5s]
That's enough.
[pause 8s]

Let the weight be acknowledged first.
[pause 5s]
Don't push it away. Name it silently.
[pause 5s]
Then breathe.
[pause 8s]

Inhale... for five seconds.
[BREATHING_CYCLES]

What belonged to them... stays here.
[pause 5s]
What's yours... you carry wisely.
[pause 5s]
You are not their pain. You are their witness.
[pause 6s]
That distinction... sustains a career.
[pause 8s]
SCRIPT,

        '05-enseignant' => <<<'SCRIPT'
Welcome back.
[pause 4s]
The class was difficult.
[pause 4s]
Or you walked in depleted — and it showed.
[pause 5s]
Or something happened that shifted the room... and you followed it.
[pause 8s]

Teaching in turbulence is a skill.
[pause 5s]
Not learned in training programs.
[pause 5s]
Learned in the hallway. In the doorway. In the breath before you speak.
[pause 8s]

You are the point of stability in that room.
[pause 5s]
Not because you have all the answers.
[pause 4s]
Because you have an anchor.
[pause 5s]
And you choose to use it — even when it's hard.
[pause 8s]

Find that anchor now.
[pause 5s]
Two feet on the ground. One breath chosen, not automatic.
[pause 8s]

Inhale... for five seconds.
[BREATHING_CYCLES]

That state is the one they need from you.
[pause 5s]
Not perfection. Not calm.
[pause 4s]
Just — present.
[pause 5s]
Unmoved.
[pause 8s]
SCRIPT,

        '05-leader' => <<<'SCRIPT'
Welcome back.
[pause 4s]
The pressure is real.
[pause 4s]
The decision is urgent. The meeting went sideways. The team is watching.
[pause 6s]
And you're still expected to be the one who holds it together.
[pause 8s]

Leadership under pressure is not about suppressing the pressure.
[pause 5s]
It's about not transmitting it.
[pause 5s]
There's a difference.
[pause 8s]

One breath. Before you respond.
[pause 5s]
Before you re-enter the room.
[pause 4s]
Before you make the call.
[pause 8s]

That one breath... is not a pause.
[pause 5s]
It's a choice.
[pause 5s]
A choice about who leads in the next thirty seconds.
[pause 8s]

Make it now.
[pause 5s]

Inhale... for five seconds.
[BREATHING_CYCLES]

The version of you that just breathed...
[pause 4s]
makes better calls.
[pause 3s]
Steadier decisions.
[pause 3s]
More trust in the room.
[pause 6s]
That's the one they need. Go be that one.
[pause 6s]
SCRIPT,

        '05-educateur' => <<<'SCRIPT'
Welcome back.
[pause 4s]
The group is resisting.
[pause 4s]
Or you are. Both happen.
[pause 5s]
The energy has shifted — and you can feel it.
[pause 8s]

Resistance in a group is rarely about the content.
[pause 5s]
It's about safety. Trust. The quality of the container.
[pause 6s]
And the container... is you.
[pause 8s]

When the container is regulated... the group feels it.
[pause 5s]
Not always consciously. But in their bodies.
[pause 5s]
They soften. They open. They risk.
[pause 8s]

So before you intervene... regulate first.
[pause 5s]
Silently. Internally. Completely invisible to the group.
[pause 8s]

Inhale... for five seconds.
[BREATHING_CYCLES]

Now you can hold the resistance without reacting to it.
[pause 5s]
Name it. Sit with it. Let the group find their way through it.
[pause 6s]
That's not passivity. That's mastery.
[pause 8s]
SCRIPT,

        '05-bebe' => <<<'SCRIPT'
Welcome back.
[pause 4s]
The baby won't stop crying.
[pause 4s]
Or the feeding went badly. Or the night was brutal.
[pause 5s]
And your reserves are running low.
[pause 8s]

The hardest thing about caring for an infant...
[pause 5s]
is that they absorb your state.
[pause 5s]
There's nowhere to hide.
[pause 5s]
They feel the tension before your hands even touch them.
[pause 8s]

So the most effective thing you can do — right now —
[pause 4s]
is not try harder.
[pause 5s]
It's breathe first.
[pause 8s]

Hands near the child. Or resting on your own lap.
[pause 5s]
Jaw unclenched. Shoulders dropped.
[pause 5s]
One full cycle.
[pause 8s]

Inhale... for five seconds.
[BREATHING_CYCLES]

Different hands now.
[pause 5s]
Different signal to the nervous system — yours, and theirs.
[pause 6s]
From this state... something can shift.
[pause 8s]
SCRIPT,

        '05-proches' => <<<'SCRIPT'
Welcome back.
[pause 4s]
Something happened at home.
[pause 4s]
The evening escalated. A word landed wrong. The tension is still in the room.
[pause 6s]
And you're not sure what to do next.
[pause 8s]

The people we love most... are also the ones who can reach us the deepest.
[pause 5s]
That's not a flaw in the relationship.
[pause 5s]
That's the nature of closeness.
[pause 8s]

But you don't have to respond from the place of impact.
[pause 5s]
You have a choice.
[pause 5s]
A thirty-second choice.
[pause 8s]

Step back — physically if you can.
[pause 4s]
Or inward, if the space doesn't allow it.
[pause 5s]
Feel your feet. Feel your hands.
[pause 5s]
And breathe.
[pause 8s]

Inhale... for five seconds.
[BREATHING_CYCLES]

From here... you can choose your words.
[pause 5s]
From here... the conversation can change direction.
[pause 5s]
Not because the problem is solved.
[pause 4s]
Because you are no longer inside the reaction.
[pause 6s]
You are beside it. And that changes everything.
[pause 8s]
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
